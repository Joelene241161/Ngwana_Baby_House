<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../Components/googleAnalytics.php'; ?>
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

        <!-- Desktop sidebar -->
    <div class="d-none d-md-block">
        <?php include "../Components/sidebarVolunteer.php";?>
    </div>

    <!-- Mobile navbar -->
    <div class="d-block d-md-none">
        <?php include "../Components/mobileNavVolunteer.php";?>
    </div>

    <div class="main">

        <div class="welcomeBanner">
            <h1 class="minionPro"> Welcome back to <span class="textColour">Ngwana Babyhouse</span> </h1>
            <h5 class="marginTopMedium">Together we can change little lives.</h5>
        </div>


<div style="display: flex; flex-wrap: wrap; gap: 20px;">
    
    <!-- Card 1 -->
    <div class="chooseDate" style="flex: 1 1 280px; min-width: 280px;">
        <div class="circle-number">1</div>
        <h3 class="marginTopLarge"> Select a time </h3>
        <p>Pick a volunteering date that works for you.</p>
        <button class="secondaryButton secondaryGhost buttonText"><a href="bookingsVolunteer.php" class="linkTextYellow">View dates</a></button>
    </div>

    <!-- Card 2 -->
    <div class="chooseDate chooseDateBlue" style="flex: 1 1 280px; min-width: 280px;">
        <div class="circle-number circle-number-blue">2</div>
        <h3 class="marginTopLarge"> Select a time </h3>
        <p>Choose an available time slot.</p>
        <button class="tertiaryButton tertiaryGhost buttonText"><a href="bookingsVolunteer.php" class="linkTextBlue">Review time slots</a></button>
    </div>

    <!-- Card 3 -->
    <div class="chooseDate chooseDateRed" style="flex: 1 1 280px; min-width: 280px;">
        <div class="circle-number circle-number-Red">3</div>
        <h3 class="marginTopLarge"> Confirm your visit </h3>
        <p>Contribute with your love and time.</p>
        <button class="primaryButton primaryGhost buttonText"><a href="bookingsVolunteer.php" class="linkTextRed">Make a change</a></button>
    </div>

</div> <!-- flex container -->


    </div> <!-- main -->

    <div style="margin-bottom: 75px"></div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>
</html>