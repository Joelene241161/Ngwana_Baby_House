<?php
require_once '../config.php';

// Fetch active supply requests where received = 0
$result = $conn->query("SELECT * FROM supplyrequest WHERE received = 0 ORDER BY created_at DESC");
if (!$result) {
    die("SQL Error: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width-device-width, initial-scale-1.0">

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

    <!-- <?php include "../Components/sidebar.php";?> -->
     <?php include "../Components/disclaimerModal.php";?>

    <div class="main">

    <!-- nav links -->
  <div style="display: flex">
    <div> <a href="#" class="linkText">
        <h5 class="navLinks activeLink">Tasks</h5>
    </a></div>
    <div> <a href="homeSupplies.php" class="linkText">
        <h5 class="navLinks">Supplies</h5>
    </a></div>
</div>

        <div class="welcomeBackBanner">
            <h1 class="modernLove"> Welcome back! </h1>
            <p>The little things you plan today become big moments in a child’s tomorrow.</p>
        </div>


<div style="display: flex">
    <div class="col-6">
    <div class="visitFeedback">
        <h3 class="minionPro"> Visit Feedback </h3>
        <p>Write feedback from the Ngwana family to a volunteer.</p>
        <a href="volunteers.php" class="invisibleLink" style="color: black"><button class="whiteButton buttonText">Write feedback</button></a>
    </div>

    <div class="careRequests">
        <div style="display: flex">
            <h4 class="h4Bold"> Active care requests </h4>
            <a href="homeSupplies.php" class="invisibleLink marginLeftSmall" style="width: 240px"><button class="tertiaryButton buttonText">Create a request &#10140;</button></a>
        </div>
        <div>
           
    <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                
                <?php
                    // Map category to the correct image and name
                    $category = strtolower($row['category']);
                    $imgPath = '../Assets/wipes.png'; // default
                    $displayName = ucfirst($category);
                    
                    if ($category === 'nappies') {
                        $imgPath = '../Assets/diaper.png';
                        $displayName = "Nappies (Size " . htmlspecialchars($row['size']) . ")";
                    } elseif ($category === 'wipes') {
                        $imgPath = '../Assets/wipes.png';
                        $displayName = "Wipes (" . htmlspecialchars($row['wipe']) . ")";
                    } elseif ($category === 'toys') {
                        $imgPath = '../Assets/toys.png';
                        $displayName = "Toys (" . htmlspecialchars($row['toy']) . ", Age " . htmlspecialchars($row['age']) . ")";
                    } elseif ($category === 'formula') {
                        $imgPath = '../Assets/formula.png';
                        $displayName = "Formula (Stage " . htmlspecialchars($row['stage']) . ", " . htmlspecialchars($row['formula']) . ")";
                    }
                ?>

                <!-- One care request -->
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px">
                    <div>
                        <img src="<?php echo $imgPath; ?>" alt="<?php echo $category; ?>" style="width: 44px" class="imagePaddingTop">
                    </div>
                    <div> 
                        <p class="pLight careSuppliesText"><?php echo $displayName; ?></p>
                    </div>
                </div>

            <?php endwhile; ?>
        <?php else: ?>
            <p class="pLight" style="color: #6b7280; margin-top: 10px;">No active care requests found.</p>
        <?php endif; ?>
    
        </div>
    </div>

    </div>

    <div>
        <h6 class="visith6"> Today </h6>
            <div class="upcomingVisits">
            <h3> Volunteer Name <span class="badge rounded-pill text-bg-light"><h6>Arrived</h6></span></h3>
            <p>10 April, 10:00am-11:00am</p>
            <a href="volunteers.php" class="invisibleLink"><button class="secondaryButton buttonText marginTopSmall">View visit details</button></a>
            </div>
        
    </div>

</div> <!-- flex container -->


    </div> <!-- main -->
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>
</html>