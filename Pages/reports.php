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

     <h3 class="minionPro paddingTopMedium"> Reporting hub </h3>

    <!-- table start -->
    <div class="recentActivityContainer">
        <h4>Recent volunteer activity</h4>
        <p class="pLight">Latest activity logged by volunteers</p>
        <table class="tablePadding">
    <thead>
        <tr>
            <th>Volunteer</th>
            <th>Activity</th>
            <th>Date & Time</th>
            <th> Hours Logged </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Name</td>
            <td><label class="tertiaryButton tertiaryGhost">Cuddle therapy</label></td>
            <td>Today, 10:00 AM</td>
            <td>1.5 hrs</td>
        </tr>
        <tr>
            <td>Name</td>
            <td><label class="tertiaryButton tertiaryGhost">Cuddle therapy</label></td>
            <td>Today, 1:00 PM</td>
            <td>1.5 hrs</td>
        </tr>
        <tr>
            <td>Name</td>
            <td><label class="tertiaryButton tertiaryGhost">Cuddle therapy</label></td>
            <td>Yesterday, 10:00 AM</td>
            <td>2 hrs</td>
        </tr>
        <tr>
            <td>Name</td>
            <td><label class="tertiaryButton tertiaryGhost">Cuddle therapy</label></td>
            <td>Yesterday, 9:00 AM</td>
            <td>1 hr</td>
        </tr>
        <tr>
            <td>Name</td>
            <td><label class="tertiaryButton tertiaryGhost">Cuddle therapy</label></td>
            <td>April 7, 4:00 PM</td>
            <td>1.5 hrs</td>
        </tr>
    </tbody>
</table>
    </div> <!-- table end -->

<div style="display: flex; gap: 40px">
    <!-- graph -->
    <div class="hoursGraphContainer col-4">
        <h4 class="paddingBottomTiny">Volunteer hours counted</h4>
        <div class="hoursCounter">
            <h3 class="marginBottom0">142 hrs</h3>
        </div>

        <?php include "../Components/graph.php";?>
    </div>

    <div class="col-6 materialsSourced">
        <h4>Donated items</h4>
        <p class="pLight marginBottom0">Recorded daily </p>

<div style="display: flex; gap: 10%; align-items: center">

    <div>
        <img src="../Assets/basket.png" alt="wet wipes" style="width: 90px">
    </div>
    <div><h3 class="pLight"><strong>36</strong> items</h3></div>

    <div>
        <table class="custom-grid-table">
    <tr>
        <td>Nappies</td>
        <td>16</td>
    </tr>
    <tr>
        <td>Wipes</td>
        <td>12</td>
    </tr>
    <tr>
        <td>Formula</td>
        <td>10</td>
    </tr>
    <tr>
        <td>Toys</td>
        <td>0</td>
    </tr>
</table>
    </div>

</div> <!-- end of flex container -->

<div class="col">
    <div class="row marginTopMedium">
<button class="primaryButton buttonText"><a href="homeSupplies.php" class="invisibleLink">Request more items &#10140;</a></button>
    </div>

    <div class="row marginTopTiny">
<button class="secondaryButton buttonText">Download this month's report &#10515;</button>
</div>

</div>
    </div>

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