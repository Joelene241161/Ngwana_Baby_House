<?php
require_once '../config.php';

// Selected date (default to today or GET parameter)
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

// define all time slot tables and their display labels
$slotTables = [
    '9to10'   => '9:00am-10:00am',
    '10to11'  => '10:00am-11:00am',
    '11to12'  => '11:00am-12:00pm',
    '12to1'   => '12:00pm-1:00pm',
    '1to2'    => '1:00pm-2:00pm',
    '2to3'    => '2:00pm-3:00pm',
    '3to4'    => '3:00pm-4:00pm',
    '4to5'    => '4:00pm-5:00pm',
    '5to6'    => '5:00pm-6:00pm'
];

// Ensure all slot tables have a row for this day_id
foreach ($slotTables as $table => $label) {
    $check = $conn->prepare("SELECT slot_id FROM $table WHERE day_id = ?");
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
    }
    $check->close();
}

// Updates (Lock/unlock or capacity change)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action_slot'])) {
    $targetTable = $_POST['action_slot'];
    if (array_key_exists($targetTable, $slotTables)) {
        if (isset($_POST['toggle_lock'])) {
            $conn->query("UPDATE $targetTable SET locked = NOT locked WHERE day_id = $day_id");
        }
        if (isset($_POST['new_capacity_limit'])) {
            $newLimit = intval($_POST['new_capacity_limit']);
            $stmtUp = $conn->prepare("UPDATE $targetTable SET capacityLimit = ? WHERE day_id = ?");
            $stmtUp->bind_param("ii", $newLimit, $day_id);
            $stmtUp->execute();
            $stmtUp->close();
        }
    }
    header("Location: bookings.php?date=$selectedDate&slot=$targetTable");
    exit;
}

// Fetch active slot for controls
$activeSlotTable = $_GET['slot'] ?? '9to10';
if (!array_key_exists($activeSlotTable, $slotTables)) {
    $activeSlotTable = '9to10';
}

$activeQuery = $conn->prepare("SELECT * FROM $activeSlotTable WHERE day_id = ?");
$activeQuery->bind_param("i", $day_id);
$activeQuery->execute();
$activeData = $activeQuery->get_result()->fetch_assoc();
$activeQuery->close();

// Gather all slots data for; table rendering and daily capacity summary
$allSlotsData = [];
$totalDailyCapacity = 0;
$totalDailyCurrent = 0;

foreach ($slotTables as $table => $label) {
    $q = $conn->prepare("SELECT * FROM $table WHERE day_id = ?");
    $q->bind_param("i", $day_id);
    $q->execute();
    $data = $q->get_result()->fetch_assoc();
    $q->close();
    
    // Status math
    $status = 'Open';
    if ($data['locked'] == 1) {
        $status = 'Lockout';
    } elseif ($data['capacity'] >= $data['capacityLimit']) {
        $status = 'Full';
    } elseif ($data['capacity'] >= ($data['capacityLimit'] * 0.75)) {
        $status = 'Limited';
    }
    
    $allSlotsData[$table] = [
        'label' => $label,
        'locked' => $data['locked'],
        'capacityLimit' => $data['capacityLimit'],
        'capacity' => $data['capacity'],
        'status' => $status
    ];
    
    if ($data['locked'] == 0) {
        $totalDailyCapacity += $data['capacityLimit'];
        $totalDailyCurrent += $data['capacity'];
    }
}
$conn->close();
?>