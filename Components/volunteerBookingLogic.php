<?php
require_once '../config.php';

// user is logged in (user_id 1 if not set)
$user_id = $_SESSION['user_id'] ?? 1;

// logged-in user's details for confirmation display
$userStmt = $conn->prepare("SELECT username FROM users WHERE user_id = ?");
$userStmt->bind_param("i", $user_id);
$userStmt->execute();
$userData = $userStmt->get_result()->fetch_assoc();
$userName = $userData['username'] ?? 'Volunteer';
$userStmt->close();

// Selected Date (default to today)
$selectedDate = $_GET['date'] ?? date('Y-m-d');

// Check if an entry exists for this date, otherwise create it
$stmt = $conn->prepare("SELECT day_id FROM scheduledday WHERE DATE(date_at) = ?");
$stmt->bind_param("s", $selectedDate);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $day_id = $row['day_id'];
} else {
    $insertDay = $conn->prepare("INSERT INTO scheduledday (date_at) VALUES (?)");
    $insertDay->bind_param("s", $selectedDate);
    $insertDay->execute();
    $day_id = $insertDay->insert_id;
    $insertDay->close();
}
$stmt->close();

// Define all time slot tables, form values, and display labels
$slotTables = [
    '9to10'   => ['label' => '09 AM', 'table' => '9to10'],
    '10to11'  => ['label' => '10 AM', 'table' => '10to11'],
    '11to12'  => ['label' => '11 AM', 'table' => '11to12'],
    '12to1'   => ['label' => '12 PM', 'table' => '12to1'],
    '1to2'    => ['label' => '1 PM',  'table' => '1to2'],
    '2to3'    => ['label' => '2 PM',  'table' => '2to3'],
    '3to4'    => ['label' => '3 PM',  'table' => '3to4'],
    '4to5'    => ['label' => '4 PM',  'table' => '4to5'],
    '5to6'    => ['label' => '5 PM',  'table' => '5to6']
];

// Ensure all slot tables have a row for this day_id
foreach ($slotTables as $key => $info) {
    $table = $info['table'];
    $check = $conn->prepare("SELECT slot_id, locked, capacityLimit, capacity FROM $table WHERE day_id = ?");
    $check->bind_param("i", $day_id);
    $check->execute();
    $res = $check->get_result();
    
    if ($res->num_rows === 0) {
        $defaultLocked = ($table === '12to1') ? 1 : 0;
        $defaultLimit = 8; 
        $defaultCurrent = 0;
        
        $ins = $conn->prepare("INSERT INTO $table (day_id, locked, capacityLimit, capacity) VALUES (?, ?, ?, ?)");
        $ins->bind_param("iiii", $day_id, $defaultLocked, $defaultLimit, $defaultCurrent);
        $ins->execute();
        $ins->close();
        
        $slotTables[$key]['locked'] = $defaultLocked;
        $slotTables[$key]['capacityLimit'] = $defaultLimit;
        $slotTables[$key]['capacity'] = $defaultCurrent;
    } else {
        $slotData = $res->fetch_assoc();
        $slotTables[$key]['locked'] = $slotData['locked'];
        $slotTables[$key]['capacityLimit'] = $slotData['capacityLimit'];
        $slotTables[$key]['capacity'] = $slotData['capacity'];
    }
    $check->close();
}

//  Form submission
$successMessage = '';
$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['book_visit'])) {
    $selectedTask = $_POST['task'] ?? 'cuddle';
    $selectedSlotKey = $_POST['slot_key'] ?? '';
    
    if (array_key_exists($selectedSlotKey, $slotTables)) {
        $targetTable = $slotTables[$selectedSlotKey]['table'];
        $isLocked = $slotTables[$selectedSlotKey]['locked'];
        $currentCap = $slotTables[$selectedSlotKey]['capacity'];
        $maxCap = $slotTables[$selectedSlotKey]['capacityLimit'];
        
        if ($isLocked == 1) {
            $errorMessage = 'Selected time slot is locked.';
        } elseif ($currentCap >= $maxCap) {
            $errorMessage = 'Selected time slot is fully booked.';
        } else {
            // Insert into bookings table
            $bookingStmt = $conn->prepare("INSERT INTO bookings (user_id, day_id, task, status) VALUES (?, ?, ?, 'expected')");
            $bookingStmt->bind_param("iis", $user_id, $day_id, $selectedTask);
            
            if ($bookingStmt->execute()) {
                // Increment slot capacity
                $updateCap = $conn->prepare("UPDATE $targetTable SET capacity = capacity + 1 WHERE day_id = ?");
                $updateCap->bind_param("i", $day_id);
                $updateCap->execute();
                $updateCap->close();
                
                // Redirect to avoid form resubmission
                header("Location: bookingsVolunteer.php?date=$selectedDate&success=1");
                exit;
            } else {
                $errorMessage = 'Error recording booking: ' . $bookingStmt->error;
            }
            $bookingStmt->close();
        }
    }
}

if (isset($_GET['success'])) {
    $successMessage = 'Visit scheduled successfully!';
}

?>