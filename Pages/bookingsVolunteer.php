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

    <?php include "../Components/sidebarVolunteer.php";?>

    <div class="main">

<div style="display: flex; gap: 40px">
    <div class="col-5">

    <h3 class="minionPro marginTopLarge"> Book a session </h3>
    <h4> Select your visitation slot </h4>

    <div class="calendar-container">
    <label for="event-date"><h4>Select a date</h4></label>
    <input type="date" id="event-date" class="marginTopTiny">
    </div>

    <div class="scheduleControls">
        <h4>Care board</h4>
        <h5>I’d love to help with...</h5>

        <!-- selected care task -->
         <div class="radio-group">
  <label class="radio-button">
    <input type="radio" name="custom-radio" value="1" checked>
    <span class="radio-icon"></span>
    <img src="../Assets/care.png" alt="caregiver illustration" style="width: 40px" class="marginRightTiny">
    <span class="radio-label">Cuddles & Support</span>
  </label>

  <label class="radio-button">
    <input type="radio" name="custom-radio" value="2">
    <span class="radio-icon"></span>
    <img src="../Assets/tummy.png" alt="caregiver illustration" style="height: 40px" class="marginRightTiny">
    <span class="radio-label">Tummy Time</span>
  </label>

  <label class="radio-button">
    <input type="radio" name="custom-radio" value="3">
    <span class="radio-icon"></span>
    <img src="../Assets/toys.png" alt="caregiver illustration" style="width: 40px" class="marginRightTiny">
    <span class="radio-label">Play & Learn</span>
  </label>

  <label class="radio-button">
    <input type="radio" name="custom-radio" value="3">
    <span class="radio-icon"></span>
    <img src="../Assets/read.png" alt="caregiver illustration" style="height: 40px" class="marginRightTiny">
    <span class="radio-label">Reading & Stories</span>
  </label>
</div>
    </div>


</div>

<!-- day time slots -->
<div class="col-6">
    <div class="timeContainer">
    <h4>Select a time</h4>

        <!-- selected time slot -->
         <div class="time-group marginTop15">
  <label class="timeButton">
    <input type="radio" name="custom-radio" value="9" checked>
    <span class="radio-label">09 AM</span>
  </label>

  <label class="timeButton">
    <input type="radio" name="custom-radio" value="10">
    <span class="radio-label">10 AM</span>
  </label>

  <label class="timeButton">
    <input type="radio" name="custom-radio" value="11">
    <span class="radio-label">11 AM</span>
  </label>

  <label class="timeButton">
    <input type="radio" name="custom-radio" value="12">
    <span class="radio-label">12 AM</span>
  </label>

  <label class="timeButton">
    <input type="radio" name="custom-radio" value="1">
    <span class="radio-label">1 PM</span>
  </label>

  <label class="timeButton">
    <input type="radio" name="custom-radio" value="2">
    <span class="radio-label">2 PM</span>
  </label>

  <label class="timeButton">
    <input type="radio" name="custom-radio" value="3">
    <span class="radio-label">3 PM</span>
  </label>

  <label class="timeButton">
    <input type="radio" name="custom-radio" value="4">
    <span class="radio-label">4 PM</span>
  </label>

  <label class="timeButton">
    <input type="radio" name="custom-radio" value="5">
    <span class="radio-label">5 PM</span>
  </label>
</div><!-- end of time slot radio group -->

</div>

<div class="volunteerSupplyNeeds">
<h4>View supply needs</h4>
<p class="pLight">If you want to go the extra mile; you can bring supplies with you on your next visit, but remember that your time and love is more than enough.</p>
<div style="display: flex; gap: 20px">
    <div><img src="../Assets/diaper.png" alt="diapers" style="width: 60px"></div>
    <div><img src="../Assets/wipes.png" alt="wet wipes" style="height: 60px"></div>
    <div><img src="../Assets/toys.png" alt="toys" style="width: 60px"></div>
    <div><img src="../Assets/formula.png" alt="formula" style="width: 60px"></div>
    <button class="secondaryButton buttonText" style="height: fit-content">View supply list</button>
</div>
</div>

<div class="confirmBooking">
    <h3 class="minionPro" style="font-size: 35px"> Almost there! </h3>
    <span class="blueBgText">Check everything looks right before confirming your visit.</span>
    <h5 class="marginTopMedium">Personal details: Mia T.</h5>
    <h5>Activity added: Cuddle therapy</h5>
    <h5>Date & time: Monday, 8 April, 10:00 AM</h5>
    <p>Please arrive 5–10 minutes early.</p>

    <div style="display: flex; gap: 10px; margin-left: auto;" class="marginTopMedium">
        <div> <button class="primaryButton primaryGhost buttonText">Cancel</button></div>
        <div> <button class="primaryButton buttonText">Schedule visit</button></div>
        </div>
</div>

</div> <!-- right side end-->

</div> <!-- flex container -->


    </div> <!-- main -->

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