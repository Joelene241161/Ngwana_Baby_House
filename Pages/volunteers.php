<?php
require_once '../config.php';

// Makes sure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$currentUserId = $_SESSION['user_id'];

// Send a message to a volunteer
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send_message'])) {
    $recipientId = intval($_POST['recipient_id']);
    $content = trim($_POST['content']);

    if (!empty($content) && $recipientId > 0) {
        $msgStmt = $conn->prepare("INSERT INTO message (recipient_id, sender_id, content) VALUES (?, ?, ?)");
        $msgStmt->bind_param("iis", $recipientId, $currentUserId, $content);
        $msgStmt->execute();
        $msgStmt->close();
    }
    header("Location: " . $_SERVER['PHP_SELF'] . (isset($_GET['booking_id']) ? '?booking_id=' . intval($_GET['booking_id']) : ''));
    exit();
}

// Status updates
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_booking_status'])) {
    $bookingId = intval($_POST['booking_id']);
    $action = $_POST['action']; // check in or out

    if ($action === 'check_in') {
        $upd = $conn->prepare("UPDATE bookings SET status = 'arrived', CheckIn_at = NOW() WHERE booking_id = ?");
        $upd->bind_param("i", $bookingId);
        $upd->execute();
        $upd->close();
    } elseif ($action === 'check_out') {
        $upd = $conn->prepare("UPDATE bookings SET CheckOut_at = NOW() WHERE booking_id = ?");
        $upd->bind_param("i", $bookingId);
        $upd->execute();
        $upd->close();
    }
    
    header("Location: " . $_SERVER['PHP_SELF'] . '?booking_id=' . $bookingId);
    exit();
}

// Fetch only today's bookings, joined with user details
$bookingsQuery = "SELECT b.*, u.username, u.email, u.telephoneNumber, u.profilePicture 
                  FROM bookings b 
                  JOIN users u ON b.user_id = u.user_id 
                  WHERE DATE(b.createdFor) = CURDATE() 
                  ORDER BY b.createdFor ASC";
$result = $conn->query($bookingsQuery);
$bookings = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $bookings[] = $row;
    }
}

// selected booking for details view
$selectedBooking = null;
if (isset($_GET['booking_id'])) {
    $bId = intval($_GET['booking_id']);
    foreach ($bookings as $b) {
        if ($b['booking_id'] == $bId) {
            $selectedBooking = $b;
            break;
        }
    }
}
// Default to the first booking if none are selected
if (!$selectedBooking && !empty($bookings)) {
    $selectedBooking = $bookings[0];
}

// maps task enum to display text
function getTaskDisplayName($taskKey) {
    $map = [
        'cuddle'  => 'Cuddle therapy',
        'tummy'   => 'Tummy time',
        'feed'    => 'Feeding support',
        'play'    => 'Play time',
        'reading' => 'Reading & stories'
    ];
    return isset($map[$taskKey]) ? $map[$taskKey] : ucfirst($taskKey);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../Components/googleAnalytics.php'; ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="author" content="Joelene du Toit 241161">
    <meta name="keywords" content="Ngwana Baby House NGO">
    <title>
        Ngwana Baby House
    </title>

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
        <?php include "../Components/sidebar.php";?>
    </div>

    <!-- Mobile navbar -->
    <div class="d-block d-md-none">
        <?php include "../Components/mobileNav.php";?>
    </div>

    <div class="main">
    
    <h3 class="minionPro paddingTopMedium"> Today’s volunteer schedule  </h3>


<div style="display: flex; flex-wrap: wrap;">

<div class="col-6">
    <?php if (empty($bookings)): ?>
        <p class="pLight">No scheduled bookings for today.</p>
    <?php else: ?>
        <?php foreach ($bookings as $booking): 
            $isActive = ($selectedBooking && $selectedBooking['booking_id'] == $booking['booking_id']);
            $inactiveClass = $isActive ? '' : 'listedVolunteerInactive';
            
            // badge class based on status
            $statusClass = 'badgeExpected';
            if ($booking['status'] === 'arrived') $statusClass = 'badgeArrived';
            elseif ($booking['status'] === 'late') $statusClass = 'badgeLate';
        ?>
            <!-- One volunteer -->
            <a href="?booking_id=<?php echo $booking['booking_id']; ?>" style="display: flex; text-decoration: none; color: inherit;" class="listedVolunteer <?php echo $inactiveClass; ?>">
                <div>
                    <h4><?php echo htmlspecialchars($booking['username']); ?></h4>
                    <p><?php echo date('d F, g:ia', strtotime($booking['createdFor'])); ?></p>
                </div>
                <div>
                    <span class="badge badgeStyling <?php echo $statusClass; ?> rounded-pill"><h5><?php echo ucfirst($booking['status']); ?></h5></span>
                </div>
            </a>
        <?php endforeach; ?>
    <?php endif; ?>

 </div> <!-- end volunteers list -->

 <!-- selected volunteers details -->
    <div class="volunteerDetails col-5">
        <h4><?php echo $selectedBooking ? htmlspecialchars($selectedBooking['username']) : 'Select a volunteer'; ?></h4>
        <p><?php echo $selectedBooking ? date('d F, g:ia', strtotime($selectedBooking['createdFor'])) : '-'; ?></p>

        <h5 class="marginTopMedium">Selected Cares:</h5>

        <div style="display: flex; gap: 10px; flex-wrap: wrap;">
            <?php if ($selectedBooking): ?>
                <div class="SelectedCares">
                    <h6><?php echo htmlspecialchars(getTaskDisplayName($selectedBooking['task'])); ?></h6>
                </div>
            <?php else: ?>
                <p class="pLight">No task selected.</p>
            <?php endif; ?>
        </div>

        <h5 class="marginTopMedium">Contact: <p class="marginTopTiny"><?php echo $selectedBooking ? htmlspecialchars($selectedBooking['telephoneNumber']) : '000 000 0000'; ?></p><h5>
        
        <form action="" method="POST">
            <input type="hidden" name="send_message" value="1">
            <input type="hidden" name="recipient_id" value="<?php echo $selectedBooking ? $selectedBooking['user_id'] : ''; ?>">
            <div style="display: flex;">
                <div>
                    <textarea name="content" placeholder="Write a message to volunteer..." required></textarea>
                </div>
                <div>
                    <button type="submit" class="primaryButton buttonText sendButton">send</button>
                </div>
            </div>
        </form>

    </div>

</div> <!-- flex container end -->

<div style="display: flex; gap: 20px; flex-wrap: wrap;" class="marginTopMedium">
    
    <?php if (empty($bookings)): ?>
        <p class="pLight">No volunteer status cards to display.</p>
    <?php else: ?>
        <?php foreach ($bookings as $booking): ?>
        <div class="col-4 volunteerStatus">
            <h4 class="minionProMedium"> Volunteer Status </h4>
            <p class="pLight">Update status of volunteer</p>
            <h5><?php echo htmlspecialchars($booking['username']); ?></h5>

            <form action="" method="POST" class="marginTopMedium">
                <input type="hidden" name="update_booking_status" value="1">
                <input type="hidden" name="booking_id" value="<?php echo $booking['booking_id']; ?>">
                
                <div style="display: flex">
                    <div>
                        <button type="submit" name="action" value="check_in" class="secondaryButton buttonText marginRightTiny secondaryButtonWidth">Check in</button>
                    </div>
                    <div>
                        <button type="submit" name="action" value="check_out" class="secondaryButton secondaryGhost buttonText secondaryButtonWidth">Check out</button>
                    </div>
                 </div><!--end of button group -->
            </form>

            <div class="timeStamp marginTopMedium">
                <h6>Time-stamped visit log</h6>
                <p class="pLight">
                    <?php if (!empty($booking['CheckIn_at'])): ?>
                        Checked in: <?php echo date('H:i', strtotime($booking['CheckIn_at'])); ?>
                    <?php else: ?>
                        Not checked in yet
                    <?php endif; ?>
                    <?php if (!empty($booking['CheckOut_at']) && $booking['CheckOut_at'] !== $booking['CheckIn_at']): ?>
                        <br>Checked out: <?php echo date('H:i', strtotime($booking['CheckOut_at'])); ?>
                    <?php endif; ?>
                </p>
            </div>
         </div> <!-- end of one volunteer -->
         <?php endforeach; ?>
    <?php endif; ?>

</div>


    </div> <!-- main -->

    <div style="margin-bottom: 75px"></div>
    
   <?php include "../Components/supplyModal.php";?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>
</html>