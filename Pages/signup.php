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

<link rel="stylesheet" href="../main.css">

</head>   

<body class="background">
<section class="backgroundImageSignup">

    <nav>
        <h2 style="opacity: 0;">space</h2>
    </nav>

<div class="block">
        <h2>Sign Up Now</h2>
        <h5 class="signupH5">Fill in your details so that we can recognise and contact you.</h5>

        <form class="formSignUp" method="POST" action="" enctype="multipart/form-data">
        
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" placeholder="Email address" required="" value=""><br>

        <label for="passwordHash" class="spaceBetween">Password:</label><br>
        <input type="password" id="passwordHash" name="passwordHash" required="">
        <br>

        <label for="userName" name="userName" class="spaceBetween">Your name:</label><br>
        <input type="text" id="userName" name="userName" placeholder="First and last name" required="" value=""><br>

        <input type="submit" class="primaryButton buttonText landingButton" value="Create Account" name="Submit">
        </form>

        <p class="landingButton">I already have an account<a href="login.php" class="linkText">LOG IN</a></p>

    </div>
</section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>
</html>