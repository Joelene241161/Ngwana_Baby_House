<?php
require_once '../config.php';

// check if they are logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$currentUserId = $_SESSION['user_id'];

// volunteer actions (cancel booking or mark as late)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action_type'])) {
    $bookingId = intval($_POST['booking_id']);
    $actionType = $_POST['action_type'];

    if ($actionType === 'cancel') {
        $cancelStmt = $conn->prepare("DELETE FROM bookings WHERE booking_id = ? AND user_id = ?");
        $cancelStmt->bind_param("ii", $bookingId, $currentUserId);
        $cancelStmt->execute();
        $cancelStmt->close();
    } elseif ($actionType === 'late') {
        $lateStmt = $conn->prepare("UPDATE bookings SET status = 'late' WHERE booking_id = ? AND user_id = ?");
        $lateStmt->bind_param("ii", $bookingId, $currentUserId);
        $lateStmt->execute();
        $lateStmt->close();
    }

    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// all upcoming scheduled visits, that haven't been checked out yet
$bookingsQuery = "SELECT * FROM bookings 
                  WHERE user_id = ? 
                  AND createdFor >= NOW() 
                  AND CheckOut_at IS NULL 
                  ORDER BY createdFor ASC";
$bStmt = $conn->prepare($bookingsQuery);
$bStmt->bind_param("i", $currentUserId);
$bStmt->execute();
$bookingsResult = $bStmt->get_result();
$scheduledVisits = [];
if ($bookingsResult) {
    while ($row = $bookingsResult->fetch_assoc()) {
        $scheduledVisits[] = $row;
    }
}
$bStmt->close();

// feedback messages sent to this volunteer
$feedbackQuery = "SELECT m.*, u.username AS staff_name 
                  FROM message m 
                  JOIN users u ON m.sender_id = u.user_id 
                  WHERE m.recipient_id = ? 
                  ORDER BY m.created_at DESC";
$fStmt = $conn->prepare($feedbackQuery);
$fStmt->bind_param("i", $currentUserId);
$fStmt->execute();
$feedbackResult = $fStmt->get_result();
$feedbacks = [];
if ($feedbackResult) {
    while ($row = $feedbackResult->fetch_assoc()) {
        $feedbacks[] = $row;
    }
}
$fStmt->close();

// calculate total volunteer hours for care history
$hoursQuery = "SELECT SUM(TIMESTAMPDIFF(SECOND, CheckIn_at, CheckOut_at)) / 3600 AS total_hours 
               FROM bookings 
               WHERE user_id = ? AND CheckIn_at IS NOT NULL AND CheckOut_at IS NOT NULL";
$hStmt = $conn->prepare($hoursQuery);
$hStmt->bind_param("i", $currentUserId);
$hStmt->execute();
$hoursRes = $hStmt->get_result()->fetch_assoc();
$totalHours = round($hoursRes['total_hours'] ?? 0, 1);
$hStmt->close();

// completed care history rows for this volunteer
$historyQuery = "SELECT task, CheckIn_at, CheckOut_at, 
                 ROUND(TIMESTAMPDIFF(SECOND, CheckIn_at, CheckOut_at) / 3600, 1) AS hours_worked 
                 FROM bookings 
                 WHERE user_id = ? AND CheckIn_at IS NOT NULL AND CheckOut_at IS NOT NULL 
                 ORDER BY CheckIn_at DESC";
$histStmt = $conn->prepare($historyQuery);
$histStmt->bind_param("i", $currentUserId);
$histStmt->execute();
$historyResult = $histStmt->get_result();
$careHistory = [];
if ($historyResult) {
    while ($row = $historyResult->fetch_assoc()) {
        $careHistory[] = $row;
    }
}
$histStmt->close();

// maps tasks to display names and asset icons
function getTaskDetails($taskKey) {
    $map = [
        'cuddle'  => ['name' => 'Cuddle therapy', 'icon' => '../Assets/care.png'],
        'tummy'   => ['name' => 'Tummy time', 'icon' => '../Assets/care.png'],
        'feed'    => ['name' => 'Feeding support', 'icon' => '../Assets/feed.png'],
        'play'    => ['name' => 'Play time', 'icon' => '../Assets/play.png'],
        'reading' => ['name' => 'Reading & stories', 'icon' => '../Assets/play.png']
    ];
    return isset($map[$taskKey]) ? $map[$taskKey] : ['name' => ucfirst($taskKey), 'icon' => '../Assets/care.png'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="author" content="Joelene du Toit 241161">
    <meta name="keywords" content="Ngwana Baby House NGO">
    <title>Ngwana Baby House</title>

    <link rel="icon" type="image/x-icon" href="../Assets/favicon.ico">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.typekit.net/jep6hre.css">
    <link rel="stylesheet" href="../main.css">
</head>   

<body class="background">

    <!-- Desktop sidebar -->
    <div class="d-none d-md-block">
        <?php include "../Components/sidebarVolunteer.php";?>
    </div>

    <!-- Mobile navbar -->
    <div class="d-block d-md-none">
        <?php include "../Components/mobileNavVolunteer.php";?>
    </div>

    <div class="main">

    <div class="scheduledVisits">
        <h1 class="minionPro">Your scheduled visits</h1>
        
        <?php if (empty($scheduledVisits)): ?>
            <p class="pLight marginTopMedium">You have no upcoming scheduled visits.</p>
        <?php else: ?>
            <?php foreach ($scheduledVisits as $visit): 
                $taskInfo = getTaskDetails($visit['task']);
            ?>
                <div style="display: flex; gap: 20px; align-items: center; margin-bottom: 20px; border-bottom: 1px solid #eee; padding-bottom: 15px;">
                    <div>
                        <img src="../Assets/icons/calendar.png" alt="calendar" style="width: 70px" class="imagePaddingTop">
                    </div>
                    <div>
                        <h4 class="marginTopMedium"><?php echo date('l, F j', strtotime($visit['createdFor'])); ?></h4>
                        <p class="pLight marginBottom0">
                            <?php echo date('g:ia', strtotime($visit['createdFor'])); ?> - <?php echo date('g:ia', strtotime($visit['createdFor'] . ' +1 hour')); ?>
                        </p>
                        <p class="linkTextBlue">
                            <?php echo htmlspecialchars($taskInfo['name']); ?> 
                            <?php if ($visit['status'] === 'late') echo '<span class="badge bg-warning text-dark ms-2">Marked Late</span>'; ?>
                        </p>
                    </div>
                    <div style="display: flex; gap: 10px; margin-left: auto; flex-wrap: wrap;" class="marginTopMedium">
                        <form action="" method="POST" style="display:inline;">
                            <input type="hidden" name="booking_id" value="<?php echo $visit['booking_id']; ?>">
                            <input type="hidden" name="action_type" value="cancel">
                            <button type="submit" class="secondaryButton buttonText secondaryButtonWidth">Cancel</button>
                        </form>
                        <form action="" method="POST" style="display:inline;">
                            <input type="hidden" name="booking_id" value="<?php echo $visit['booking_id']; ?>">
                            <input type="hidden" name="action_type" value="late">
                            <button type="submit" class="primaryButton buttonText secondaryButtonWidth">I'm Late</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

<div style="display: flex; gap: 20px; flex-wrap: wrap;">
    <div class="feedbackVolunteer col-7" style="flex: 1 1 280px; min-width: 280px;">
        <h4 class="minionPro">Visit feedback</h4>
        <h5 class="paddingBottomTiny">Feedback from your Ngwana family</h5>

        <?php if (empty($feedbacks)): ?>
            <p class="pLight">No feedback messages received yet.</p>
        <?php else: ?>
            <?php foreach ($feedbacks as $fb): ?>
                <div class="feedbackContainer">
                    <h4 class="redText"><?php echo htmlspecialchars($fb['staff_name']); ?></h4>
                    <p><?php echo date('j F Y, g:ia', strtotime($fb['created_at'])); ?></p>
                    <p class="pLight"><?php echo htmlspecialchars($fb['content']); ?></p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

    </div>

    <div class="careHistory col-4" style="flex: 1 1 280px; min-width: 280px;">
        <h3>Your care history</h3>

        <div class="hoursContainer">
            <h5> <span class="minionPro textBig"><?php echo $totalHours; ?></span> hrs total</h5>
            <p>Thank you for your time and care!</p>
        </div>

        <div class="scroll-container">
            <?php if (empty($careHistory)): ?>
                <p class="pLight p-3">No completed care history recorded yet.</p>
            <?php else: ?>
                <?php foreach ($careHistory as $history): 
                    $tDetails = getTaskDetails($history['task']);
                ?>
                    <div class="row align-items-center mb-2">
                        <div class="col"><img src="<?php echo $tDetails['icon']; ?>" alt="icon" style="height: 40px"></div>
                        <div class="col"><?php echo htmlspecialchars($tDetails['name']); ?></div>
                        <div class="col"><?php echo $history['hours_worked']; ?> hrs</div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

    </div>
</div> <!-- flex container -->

    </div> <!-- main -->

    <div style="margin-bottom: 75px"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>
</html>