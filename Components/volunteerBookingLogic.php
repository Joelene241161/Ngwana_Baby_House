<?php
require_once '../config.php';

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$currentUserId = $_SESSION['user_id'];
$successMessage = '';
$errorMessage = '';

// Fetch user's name for confirmation display
$userStmt = $conn->prepare("SELECT username FROM users WHERE user_id = ?");
$userStmt->bind_param("i", $currentUserId);
$userStmt->execute();
$userData = $userStmt->get_result()->fetch_assoc();
$userName = $userData['username'] ?? 'Volunteer';
$userStmt->close();

// Selected date
$selectedDate = date('Y-m-d');
if (isset($_GET['date']) && !empty($_GET['date'])) {
    $selectedDate = $_GET['date'];
} elseif (isset($_POST['date']) && !empty($_POST['date'])) {
    $selectedDate = $_POST['date'];
}

// Define all time slot tables and their display labels & start times
$slotTables = [
    '9to10'   => ['label' => '9:00am',   'time' => '09:00:00'],
    '10to11'  => ['label' => '10:00am',  'time' => '10:00:00'],
    '11to12'  => ['label' => '11:00am',  'time' => '11:00:00'],
    '12to1'   => ['label' => '12:00pm',   'time' => '12:00:00'],
    '1to2'    => ['label' => '1:00pm',    'time' => '13:00:00'],
    '2to3'    => ['label' => '2:00pm',    'time' => '14:00:00'],
    '3to4'    => ['label' => '3:00pm',    'time' => '15:00:00'],
    '4to5'    => ['label' => '4:00pm',    'time' => '16:00:00'],
    '5to6'    => ['label' => '5:00pm',    'time' => '17:00:00']
];

// Check or create record for this date
$dayStmt = $conn->prepare("SELECT day_id FROM scheduledday WHERE DATE(date_at) = ?");
$dayStmt->bind_param("s", $selectedDate);
$dayStmt->execute();
$dayRes = $dayStmt->get_result();

if ($dayRes->num_rows > 0) {
    $dayRow = $dayRes->fetch_assoc();
    $day_id = $dayRow['day_id'];
} else {
    $insDay = $conn->prepare("INSERT INTO scheduledday (date_at) VALUES (?)");
    $insDay->bind_param("s", $selectedDate);
    $insDay->execute();
    $day_id = $insDay->insert_id;
    $insDay->close();
}
$dayStmt->close();

// time slots for the selected date
foreach ($slotTables as $table => &$info) {
    $q = $conn->prepare("SELECT * FROM $table WHERE day_id = ?");
    if ($q) {
        $q->bind_param("i", $day_id);
        $q->execute();
        $res = $q->get_result();
        if ($res->num_rows > 0) {
            $slotData = $res->fetch_assoc();
            $info['locked'] = $slotData['locked'];
            $info['capacityLimit'] = $slotData['capacityLimit'];
            $info['capacity'] = $slotData['capacity'];
        } else {
            // Default fallbacks if row doesn't exist yet
            $info['locked'] = ($table === '12to1') ? 1 : 0;
            $info['capacityLimit'] = 8;
            $info['capacity'] = 0;
        }
        $q->close();
    }
}
unset($info);

// Booking form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['book_visit'])) {
    $selectedTask = $_POST['task'] ?? 'cuddle';
    $selectedSlotKey = $_POST['slot_key'] ?? '';

    if (array_key_exists($selectedSlotKey, $slotTables)) {
        $slotInfo = $slotTables[$selectedSlotKey];

        // full datetime string for createdFor
        $fullDateTime = $selectedDate . ' ' . $slotInfo['time'];

        $bookStmt = $conn->prepare("INSERT INTO bookings (user_id, day_id, createdFor, task, status) VALUES (?, ?, ?, ?, 'pending')");
        if ($bookStmt) {
            $bookStmt->bind_param("iiss", $currentUserId, $day_id, $fullDateTime, $selectedTask);
            if ($bookStmt->execute()) {
                $bookStmt->close();

                // Increment capacity count in the specific slot table
                $updCap = $conn->prepare("UPDATE $selectedSlotKey SET capacity = capacity + 1 WHERE day_id = ?");
                if ($updCap) {
                    $updCap->bind_param("i", $day_id);
                    $updCap->execute();
                    $updCap->close();
                }

                $successMessage = "Your visit has been successfully scheduled for " . date('l, j F Y', strtotime($selectedDate)) . " at " . $slotInfo['label'] . "!";
            } else {
                $errorMessage = "Error saving booking. Please try again.";
                $bookStmt->close();
            }
        }
    } else {
        $errorMessage = "Please select a valid time slot.";
    }
}
?>