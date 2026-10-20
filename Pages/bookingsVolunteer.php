<?php
// logic file
include "../Components/volunteerBookingLogic.php";

require_once '../config.php';

$supplyRequests = [];
if (isset($conn) && $conn instanceof mysqli && $conn->ping()) {
    $res = $conn->query("SELECT * FROM supplyrequest WHERE received = 0 ORDER BY created_at DESC");
    if ($res) {
        $supplyRequests = $res->fetch_all(MYSQLI_ASSOC);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../Components/googleAnalytics.php'; ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width-device-width, initial-scale-1.0">
    <meta property="og:description" content="Ngwana Baby House volunteer dashboard. Volunteers can see real-time needs and volunteer to help. Staff can manage their volunteers and get insights.">

    <meta name="author" content="Joelene du Toit 241161">
    <meta name="keywords" content="Ngwana Baby House NGO">
    <title>
        Volunteer bookings
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
        <?php include "../Components/sidebarVolunteer.php";?>
    </div>

    <!-- Mobile navbar -->
    <div class="d-block d-md-none">
        <?php include "../Components/mobileNavVolunteer.php";?>
    </div>

<div class="main">
    <?php if (!empty($successMessage)): ?>
        <div class="alert alert-success"><?php echo $successMessage; ?></div>
    <?php endif; ?>
    <?php if (!empty($errorMessage)): ?>
        <div class="alert alert-danger"><?php echo $errorMessage; ?></div>
    <?php endif; ?>

    <form method="POST" action="bookingsVolunteer.php?date=<?php echo $selectedDate; ?>">
        <div style="display: flex; gap: 40px;flex-wrap: wrap;">
            <div class="col-5">
                <h3 class="minionPro marginTopLarge">Book a session</h3>
                <h4>Select your visitation slot</h4>

                <div class="calendar-container" style="flex: 1 1 280px; min-width: 280px;">
                    <label for="event-date"><h4>Select a date</h4></label>
                    <input type="date" id="event-date" name="date" class="marginTopTiny" value="<?php echo $selectedDate; ?>" onchange="location.href='bookingsVolunteer.php?date='+this.value">
                </div>

                <div class="scheduleControls" style="flex: 1 1 280px; min-width: 280px;">
                    <h4>Care board</h4>
                    <h5>I’d love to help with...</h5>

                    <div class="radio-group">
                        <label class="radio-button">
                            <input type="radio" name="task" value="cuddle" checked>
                            <span class="radio-icon"></span>
                            <img src="../Assets/care.png" alt="cuddle therapy" style="width: 40px" class="marginRightTiny">
                            <span class="radio-label">Cuddles & Support</span>
                        </label>

                        <label class="radio-button">
                            <input type="radio" name="task" value="tummy">
                            <span class="radio-icon"></span>
                            <img src="../Assets/tummy.png" alt="tummy time" style="height: 40px" class="marginRightTiny">
                            <span class="radio-label">Tummy Time</span>
                        </label>

                        <label class="radio-button">
                            <input type="radio" name="task" value="play">
                            <span class="radio-icon"></span>
                            <img src="../Assets/toys.png" alt="play and learn" style="width: 40px" class="marginRightTiny">
                            <span class="radio-label">Play & Learn</span>
                        </label>

                        <label class="radio-button">
                            <input type="radio" name="task" value="reading">
                            <span class="radio-icon"></span>
                            <img src="../Assets/read.png" alt="reading and stories" style="height: 40px" class="marginRightTiny">
                            <span class="radio-label">Reading & Stories</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- day time slots -->
            <div class="col-6">
                <div class="timeContainer" style="flex: 1 1 280px; min-width: 280px;">
                    <h4>Select an available time</h4>

                    <div class="time-group marginTop15">
                        <?php 
    $availableSlotsCount = 0;
    if (!empty($slotTables)):
        foreach ($slotTables as $key => $slot): 
            // hide locked slots or slots at/over capacity limit
            if ($slot['locked'] == 1 || $slot['capacity'] >= $slot['capacityLimit']) {
                continue;
            }
            $availableSlotsCount++;
    ?>
            <label class="timeButton">
                <input type="radio" name="slot_key" value="<?php echo $key; ?>" <?php echo ($availableSlotsCount === 1) ? 'checked' : ''; ?>>
                <span class="radio-label"><?php echo $slot['label']; ?></span>
            </label>
    <?php 
        endforeach; 
    endif;
    
    if ($availableSlotsCount === 0):
    ?>
        <p class="text-danger mt-3">No available time slots for this date. Please select another day.</p>
    <?php endif; ?>
                    </div>
                </div>

                <div class="volunteerSupplyNeeds" style="flex: 1 1 280px; min-width: 280px;">
                    <h4>View supply needs</h4>
                    <p class="pLight">If you want to go the extra mile; you can bring supplies with you on your next visit, but remember that your time and love is more than enough.</p>
                    <div style="display: flex; gap: 20px; flex-wrap: wrap;">
                        <div><img src="../Assets/diaper.png" alt="diapers" style="width: 30px"></div>
                        <div><img src="../Assets/wipes.png" alt="wet wipes" style="height: 30px"></div>
                        <div><img src="../Assets/toys.png" alt="toys" style="width: 30px"></div>
                        <div><img src="../Assets/formula.png" alt="formula" style="width: 30px"></div>
                        <button type="button" class="secondaryButton buttonText" style="height: fit-content" data-bs-toggle="modal" data-bs-target="#supplyNeedsModal">View supply list</button>
                    </div>
                </div>

                <div class="confirmBooking" style="flex: 1 1 280px; min-width: 280px;">
                    <h3 class="minionPro" style="font-size: 35px">Almost there!</h3>
                    <span class="blueBgText">Check everything looks right before confirming your visit.</span>
                    <h5 class="marginTopMedium">Personal details: <?php echo htmlspecialchars($userName); ?></h5>
                    <h5>Date: <?php echo date('l, j F Y', strtotime($selectedDate)); ?></h5>
                    <p>Please arrive 5–10 minutes early.</p>

                    <div style="display: flex; gap: 10px; margin-left: auto;" class="marginTopMedium">
                        <div><button type="reset" class="primaryButton primaryGhost buttonText">Cancel</button></div>
                        <div><button type="submit" name="book_visit" value="1" class="primaryButton buttonText" <?php echo ($availableSlotsCount === 0) ? 'disabled' : ''; ?>>Schedule visit</button></div>
                    </div>
                </div>
            </div> <!-- right side end-->
        </div> <!-- flex container -->
    </form>
</div> <!-- main -->

<div style="margin-bottom: 75px"></div>

 <?php include "../Components/supplyNeedsModal.php";?>

    <!-- Quantity selector -->
 <script>
function changeQty(delta) {
    let qty = document.getElementById('qty');
    let newVal = parseInt(qty.value) + delta;
    if (newVal >= parseInt(qty.min) && newVal <= parseInt(qty.max)) {
        qty.value = newVal;
    }
}
</script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>
</html>