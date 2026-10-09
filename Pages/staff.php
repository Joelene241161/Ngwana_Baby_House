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

     <h3 class="minionPro paddingTopMedium"> Staff & Access </h3>
     <p class="pLight">Manage who can access the internal Ngwana Huis staff dashboard.</p>

<!-- start of flex container -->
    <div style="display: flex; gap: 40px">
    <!-- table start -->
    <div class="recentActivityContainer staffTable">
        <h4>Recent Sign Up’s</h4>
        <table class="tablePadding">
    <thead>
        <tr>
            <th>Volunteer</th>
            <th>Email</th>
            <th>Staff dashboard</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Name</td>
            <td>gmail.com</td>
            <td><button class="primaryButton primaryGhost buttonText">Give Access</button></td>
        </tr>
        <tr>
            <td>Name</td>
            <td>gmail.com</td>
            <td><button class="primaryButton primaryGhost buttonText">Give Access</button></td>
        </tr>
        <tr>
            <td>Name</td>
            <td>gmail.com</td>
            <td><button class="primaryButton primaryGhost buttonText">Give Access</button></td>
        </tr>
        <tr>
            <td>Name</td>
            <td>gmail.com</td>
            <td><button class="primaryButton primaryGhost buttonText">Give Access</button></td>
        </tr>
        <tr>
            <td>Name</td>
            <td>gmail.com</td>
            <td><button class="primaryButton primaryGhost buttonText">Give Access</button></td>
        </tr>
    </tbody>
</table>
    </div> <!-- table end -->

    <div class="staffAccess">
        <h4>Grant staff access</h4>

        <div style="display: flex; gap: 20px" class="userDetails">
            <div><img src="../Assets/icons/account.png" alt="home" class="icon"></div>
            <div>
                <h5>User's name</h5>
                <p class="pLight marginBottom0">Email address</p>
                <div style="display: flex; gap: 10px">
                    <div>
                        <label class="accessCategory">Public View<label>
                    </div>
                    <div>
                        <p class="pLight marginTop15">Current access</p>
                    </div>
                </div>
            </div>
        </div>

        <h5 class="marginTopMedium">Assign staff role</h5>
        <p class="pLight">Choose the role they will fulfill</p>

        <div class="radio-group">
  <label class="radio-button">
    <input type="radio" name="custom-radio" value="1" checked>
    <span class="radio-icon"></span>
    <span class="radio-label">Nursery caregiver</span>
  </label>

  <label class="radio-button">
    <input type="radio" name="custom-radio" value="2">
    <span class="radio-icon"></span>
    <span class="radio-label">Volunteer coordinator</span>
  </label>

  <label class="radio-button">
    <input type="radio" name="custom-radio" value="3">
    <span class="radio-icon"></span>
    <span class="radio-label">Administrator</span>
  </label>
</div>

<div style="display: flex; gap: 10px" class="marginTopMedium">
    <div> <button class="primaryButton primaryGhost buttonText">Cancel</button></div>
    <div> <button class="primaryButton buttonText">Grant staff access</button></div>
</div>

    </div>

 </div> <!-- end of flex container -->

    <!-- table start -->
    <div class="recentActivityContainer staffTable">
        <h4>Your staff</h4>
        <table class="tablePadding">
    <thead>
        <tr>
            <th>Volunteer</th>
            <th>Email</th>
            <th>Staff dashboard</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Name</td>
            <td>gmail.com</td>
            <td><button class="primaryButton primaryGhost buttonText">Edit Access</button></td>
        </tr>
        <tr>
            <td>Name</td>
            <td>gmail.com</td>
            <td><button class="primaryButton primaryGhost buttonText">Edit Access</button></td>
        </tr>
        <tr>
            <td>Name</td>
            <td>gmail.com</td>
            <td><button class="primaryButton primaryGhost buttonText">Edit Access</button></td>
        </tr>
        <tr>
            <td>Name</td>
            <td>gmail.com</td>
            <td><button class="primaryButton primaryGhost buttonText">Edit Access</button></td>
        </tr>
        <tr>
            <td>Name</td>
            <td>gmail.com</td>
            <td><button class="primaryButton primaryGhost buttonText">Edit Access</button></td>
        </tr>
    </tbody>
</table>
    </div> <!-- table end -->

<div style="display: flex; gap: 40px">


</div> <!-- flex container -->


    </div> <!-- main -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>
</html>