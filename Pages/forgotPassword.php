<?php
require_once '../config.php';

$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);

    $stmt = $conn->prepare("SELECT user_id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $userId = $row['user_id'];
        
        // Generates random token and expiry (1 hour from now)
        $token = bin2hex(random_bytes(32));
        $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));

        $updateStmt = $conn->prepare("UPDATE users SET reset_token = ?, token_expiry = ? WHERE user_id = ?");
        $updateStmt->bind_param("ssi", $token, $expiry, $userId);
        $updateStmt->execute();
        $updateStmt->close();

        // display the link directly on screen:
        $resetLink = "resetPassword.php?token=" . $token;
        $message = "Password reset link generated! <a href='$resetLink'>Click here to reset your password</a> (In production, email this link to the user).";
    } else {
        // Generic message for security
        $message = "If that email exists in our system, a reset link has been generated.";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../Components/googleAnalytics.php'; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:description" content="Ngwana Baby House volunteer dashboard. Volunteers can see real-time needs and volunteer to help. Staff can manage their volunteers and get insights.">
    <title>Forgot Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../main.css">
</head>
<body class="background">
<section class="backgroundImageSignup">
    <div class="block">
        <h2>Reset Password</h2>
        <h5 class="signupH5">Enter your email to receive a password reset link.</h5>

        <?php if (!empty($message)): ?>
            <div class="alert alert-info"><?php echo $message; ?></div>
        <?php endif; ?>

        <form class="formSignUp" method="POST" action="">
            <label for="email">Email address:</label><br>
            <input type="email" id="email" name="email" placeholder="Enter your email" required class="form-control mb-3"><br>
            <button type="submit" class="primaryButton buttonText landingButton w-100">Send Reset Link</button>
        </form>

        <p class="landingButton mt-3"><a href="login.php" class="linkText">Back to Login</a></p>
    </div>
</section>
</body>
</html>