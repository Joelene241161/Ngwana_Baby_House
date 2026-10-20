<?php
ob_start();
require_once '../config.php';

// If they have logged in before, check their role and redirect accordingly
if (isset($_SESSION['user_id'])) {
    if (isset($_SESSION['role']) && $_SESSION['role'] === 'volunteer') {
        header("Location: homeVolunteer.php");
    } else {
        header("Location: home.php");
    }
    exit();
}

$error = null;

// Handle login form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password_hash'] ?? '';
    
    $stmt = $conn->prepare("SELECT user_id, email, password_hash, role FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($user = $result->fetch_assoc()) {
        // verify password
        if (password_verify($password, $user['password_hash'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];

            // redirect based on role
            if ($user['role'] === 'volunteer') {
                header("Location: homeVolunteer.php");
            } else {
                header("Location: home.php");
            }
            exit();
        } else {
            $error = "Invalid email or password";
        }
    } else {
        $error = "Invalid email or password";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="author" content="Joelene du Toit 241161">
    <meta name="keywords" content="Ngwana Baby House NGO">
    <meta property="og:description" content="Ngwana Baby House volunteer dashboard. Volunteers can see real-time needs and volunteer to help. Staff can manage their volunteers and get insights.">
    <title>Log in page</title>

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

    <?php if (isset($_SESSION['success'])): ?>
        <div class="success" style="color: green; background: rgba(255,255,255,0.8); padding: 10px; margin: 10px; border-radius: 5px;">
            <?php echo htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?>
        </div>
    <?php endif; ?>
    
    <?php if (isset($error)): ?>
        <div class="error" style="color: red; background: rgba(255,255,255,0.8); padding: 10px; margin: 10px; border-radius: 5px;">
            <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <div class="block">
        <h2>Welcome back!</h2>
        <h5 class="signupH5">Fill in your details to access your account.</h5>

        <form class="formSignUp" method="POST" action="login.php" enctype="multipart/form-data">
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" placeholder="Email address" required value=""><br>

            <label for="password_hash" class="spaceBetween">Password:</label><br>
            <input type="password" id="password_hash" name="password_hash" required><br>

            <div class="paddingTopTiny">
                <a href="forgotPassword.php" class="linkText" style="font-size: 14px;">Forgot password?</a>
            </div>

            <input type="submit" class="primaryButton buttonText landingButton" value="Log in" name="Submit">
        </form>

        <p class="landingButton">Don’t have an account? <a href="signup.php" class="linkText">SIGN UP</a></p>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
<script src="script.js"></script>
</body>
</html>