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

     <h3 class="minionPro paddingTopMedium"> Manage volunteer bookings </h3>


<div style="display: flex; gap: 40px">
    <div class="col-5">
    
    <div class="calendar-container">
    <label for="event-date"><h4>Select Date</h4></label>
    <input type="date" id="event-date" class="marginTopTiny">
    </div>

    <div class="scheduleControls">
        <h4 class="paddingBottomTiny">Schedule Controls</h4>
        <h6 class="pLight">Manage bookings for the selected time block</h6>

        <div class="selectedTime">
            <h6>10:00am-11:00am - Fully Booked</h6>
        </div>

<div style="display: flex">
    <div class="marginRightTiny">
    <h6 class="marginTopMedium">Capacity limit</h6>
        <button type="button" class="capacity-btn" onclick="changeQty(-1)"> <h3>&minus;</h3> </button>
          <input type="number" id="qty" name="quantity" value="1" min="1" max="8" class="smallInput">
          <button type="button" class="capacity-btn" onclick="changeQty(1)"> <h3>&plus;</h3></button>
    <p class="pLight marginRightTiny">Maximum visitors</p>
    </div>

    <button style="display: flex" class="blockSlotButton marginLeftSmall">
        <div class="marginRightTiny"><span style='font-size:33px;'>&#10754;</span></div>
        <div>
            <h6 class="marginBottom0">Block Slot</h6>
            <p class="pLight marginBottom0">Prevent further bookings</p>
        </div>
    </button>

</div>

<button class="tertiaryButton buttonText col-12">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
  <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
  <circle cx="12" cy="7" r="4"></circle>
</svg>
 View who is booked</button>
    </div>
</div>

<!-- day time slots -->
<div class="timeSlotsContainer col-6">
    <div  style="display: flex; gap: 20%">
    <div><h4>Tuesday, April 8</h4></div>
    <div>
        <p class="pLight">Daily capacity: 32/52</p>
        <?php include "../Components/progressBar.php";?>
    </div>
    </div> <!-- header end -->

    <!-- table start -->
    <div>
        <table>
    <thead>
        <tr>
            <th>Time</th>
            <th>Status</th>
            <th>Capacity</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>9:00am-10:00am</td>
            <td>Open</td>
            <td>2 / 8</td>
            <td><button class="tertiaryButton tertiaryGhost buttonText">View</button></td>
        </tr>
        <tr>
            <td>10:00am-11:00am</td>
            <td>Full</td>
            <td>8 / 8</td>
            <td><button class="tertiaryButton tertiaryGhost buttonText">View</button></td>
        </tr>
        <tr>
            <td>11:00am-12:00pm</td>
            <td>Limited</td>
            <td>6 / 8</td>
            <td><button class="tertiaryButton tertiaryGhost buttonText">View</button></td>
        </tr>
        <tr>
            <td>12:00pm-1:00pm</td>
            <td>Lockout</td>
            <td>Nap time</td>
            <td><button class="tertiaryButton tertiaryGhostDisabled buttonText">Locked</button></td>
        </tr>
        <tr>
            <td>1:00pm-2:00pm</td>
            <td>Open</td>
            <td>3 / 8</td>
            <td><button class="tertiaryButton tertiaryGhost buttonText">View</button></td>
        </tr>
    </tbody>
</table>
    </div> <!-- table end -->

</div> <!-- day time slots end-->

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