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

    <!-- nav links -->
  <div style="display: flex">
    <div> <a href="home.php" class="linkText">
        <h5 class="navLinks">Tasks</h5>
    </a></div>
    <div> <a href="#" class="linkText">
        <h5 class="navLinks activeLink">Supplies</h5>
    </a></div>
</div>
            <h3 class="minionPro"> Create care requests to inform volunteers </h3>


<div style="display: flex">
    <div class="col-4">
    <div class="selectRequests">
        <h4> Select a category </h4>

        <div class="row">
        <!-- nappies -->
        <button style="display: flex" class="supplyCategory" data-bs-toggle="modal" data-bs-target="#supplies" data-category="Nappies">
        <div><img src="../Assets/diaper.png" alt="diapers" style="width: 44px"></div>
        <div> <p class="pLight">Nappies</p> </div>
        </button>

        <!-- wet wipes -->
          <button style="display: flex" class="supplyCategory" data-bs-toggle="modal" data-bs-target="#supplies" data-category="Wipes">
        <div><img src="../Assets/wipes.png" alt="wet wipes" style="width: 44px"></div>
        <div> <p class="pLight">Wipes</p> </div>
        </button>

        <!-- toys -->
          <button style="display: flex" class="supplyCategory" data-bs-toggle="modal" data-bs-target="#supplies" data-category="Toys">
        <div><img src="../Assets/toys.png" alt="toys" style="width: 44px"></div>
        <div> <p class="pLight">Toys</p> </div>
        </button>

        <!-- formula -->
          <button style="display: flex" class="supplyCategory" data-bs-toggle="modal" data-bs-target="#supplies" data-category="Formula">
        <div><img src="../Assets/formula.png" alt="formula" style="width: 44px"></div>
        <div> <p class="pLight">Formula</p> </div>
        </button>

    </div>
    
    </div>
</div>

<div class="supplyRequests col-8">
            <h4 class="h4Bold"> Active care requests </h4>
        <div>
           
    <!-- one care requests -->
    <div style="display: flex">
        <div><img src="../Assets/formula.png" alt="formula" style="width: 44px" class="imagePaddingTop"></div>
        <div> <p class="pLight careSuppliesText">Name of request</p> </div>

        <!-- Received request -->
        <button class="goodSemanticButton">
           <img src="../Assets/icons/received.png" alt="received supply" style="width: 25px">
        </button>
        
        <!-- Remove request -->
          <button class="goodSemanticButton badSemanticButton">
        <img src="../Assets/icons/trash-2.png" alt="formula" style="width: 25px">
        </button>
        
    </div>
    </div>

    </div>

</div> <!-- flex container -->


    </div> <!-- main -->
    
   <?php include "../Components/supplyModal.php";?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>
</html>