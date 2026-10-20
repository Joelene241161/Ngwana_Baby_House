<?php
ob_start();
require_once '../config.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password_hash'] ?? '';
    $role     = 'volunteer'; 

    if (empty($username)) $errors[] = "Your name is required";
    if (empty($email)) $errors[] = "Email is required";
    if (strlen($password) < 6) $errors[] = "Password must be at least 6 characters";

    if (empty($errors)) {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO users (username, email, password_hash, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $email, $password_hash, $role);

        if ($stmt->execute()) {
            $_SESSION['user_id'] = $stmt->insert_id;
            $_SESSION['email'] = $email;
            $_SESSION['role'] = $role;
            $_SESSION['success'] = "Registration successful! Welcome aboard.";

            header("Location: homeVolunteer.php");
            exit();
        } else {
            if ($conn->errno == 1062 || strpos($stmt->error, 'Duplicate') !== false) {
                $errors[] = "Username or email already exists";
            } else {
                $errors[] = "Registration failed: " . $stmt->error;
            }
        }
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
    <title>Sign up</title>
    
    <link rel="icon" type="image/x-icon" href="../Assets/favicon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="../main.css">
</head>   
<body class="background">
<section class="backgroundImageSignup">

    <?php if (!empty($errors)): ?>
        <div class="error" style="color: red; background: rgba(255,255,255,0.8); padding: 10px; margin: 10px; border-radius: 5px;">
            <?php foreach ($errors as $err) echo htmlspecialchars($err) . "<br>"; ?>
        </div>
    <?php endif; ?>

    <nav>
        <h2 style="opacity: 0;">space</h2>
    </nav>

    <div class="block">
        <h2>Sign Up Now</h2>
        <h5 class="signupH5">Fill in your details so that we can recognise and contact you.</h5>

        <form class="formSignUp" method="POST" action="signup.php" enctype="multipart/form-data">
            <label for="username">Your name:</label><br>
            <input type="text" id="username" name="username" placeholder="First and last name" required value=""><br>

            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" placeholder="Email address" required value=""><br>

            <label for="password_hash" class="spaceBetween">Password:</label><br>
            <input type="password" id="password_hash" name="password_hash" required><br>

            <input type="submit" class="primaryButton buttonText landingButton" value="Create Account" name="Submit">
        </form>

        <p class="landingButton">I already have an account <a href="login.php" class="linkText">LOG IN</a></p>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
<script src="script.js"></script>
</body>
</html>