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

    <div class="main">
    
    <h3 class="minionPro paddingTopMedium"> Today’s volunteer schedule  </h3>


<div style="display: flex">

<div class="col-6">
<!-- One volunteer -->
<button style="display: flex" class="listedVolunteer">
    <div>
        <h4> Volunteer Name</h4>
        <p>10 April, 10:00am-11:00am</p>
    </div>
    <div>
        <span class="badge badgeStyling  badgeArrived rounded-pill text-bg-light"><h5>Arrived</h5></span>
    </div>
</button>

<!-- One volunteer -->
<button style="display: flex" class="listedVolunteer listedVolunteerInactive">
    <div>
        <h4> Volunteer Name</h4>
        <p>10 April, 10:00am-11:00am</p>
    </div>
    <div>
        <span class="badge badgeStyling badgeArrived rounded-pill"><h5>Arrived</h5></span>
    </div>
</button>

<!-- One volunteer -->
<button style="display: flex" class="listedVolunteer listedVolunteerInactive">
    <div>
        <h4> Volunteer Name</h4>
        <p>10 April, 10:00am-11:00am</p>
    </div>
    <div>
        <span class="badge badgeExpected badgeStyling rounded-pill"><h5>Expected</h5></span>
    </div>
</button>

<!-- One volunteer -->
<button style="display: flex" class="listedVolunteer listedVolunteerInactive">
    <div>
        <h4> Volunteer Name</h4>
        <p>10 April, 10:00am-11:00am</p>
    </div>
    <div>
        <span class="badge badgeLate badgeStyling rounded-pill"><h5>Late</h5></span>
    </div>
</button>

 </div> <!-- end volunteers list -->

 <!-- selected volunteers details -->
    <div class="volunteerDetails col-5">
        <h4>Volunteer name</h4>
        <p>10 April, 10:00am-11:00am</p>
        <h5>Donations: <p class="marginTopTiny">Nappies size 2</p><h5>

        <h5 class="marginTopMedium">Selected Cares:</h5>

        <div style="display: flex">
            <div class="SelectedCares">
                <h6>Feeding</h6>
            </div>
            <div class="SelectedCares">
                <h6>Cuddle therapy</h6>
            </div>
        </div>

        <h5 class="marginTopMedium">Contact: <p class="marginTopTiny">000 000 0000</p><h5>
        
    <div style="display: flex">
        <div>
        <textarea placeholder="Write a message to volunteer..."></textarea>
        </div>
        <div>
        <button class="primaryButton buttonText sendButton">send</button>
        </div>
    </div>

    </div>

</div> <!-- flex container end -->

<div style="display: flex">
    
    <div class="col-4 volunteerStatus">
        <h4 class="minionProMedium"> Volunteer Status </h4>
        <p class="pLight">Update status of volunteer</p>
        <h5>Volunteer name</h5>

            <div style="display: flex" class="marginTopMedium">
                <div>
                    <button class="secondaryButton buttonText marginRightTiny">Check in</button>
                </div>
                <div>
                    <button class="secondaryButton secondaryGhost buttonText">Check out</button>
                </div>
             </div><!--end of button group -->

        <div class="timeStamp">
            <h6>Time-stamped visit log</h6>
            <p class="pLight">12:05 - checked in </p>
        </div>
     </div> <!-- End of one volunteer -->

     <!-- Start of new volunteer -->
      <div class="col-4 volunteerStatus">
        <h4 class="minionProMedium"> Volunteer Status </h4>
        <p class="pLight">Update status of volunteer</p>
        <h5>Volunteer name</h5>

            <div style="display: flex" class="marginTopMedium">
                <div>
                    <button class="secondaryButton buttonText marginRightTiny">Check in</button>
                </div>
                <div>
                    <button class="secondaryButton secondaryGhost buttonText">Check out</button>
                </div>
             </div><!--end of button group -->

        <div class="timeStamp">
            <h6>Time-stamped visit log</h6>
            <p class="pLight">12:05 - checked in </p>
        </div>
     </div> <!-- End of one volunteer -->

</div>


    </div> <!-- main -->
    
   <?php include "../Components/supplyModal.php";?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>
</html>