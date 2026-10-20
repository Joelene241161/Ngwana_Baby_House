<?php
require_once '../config.php';

$token = $_GET['token'] ?? '';
$error = '';
$success = '';

if (empty($token)) {
    die("Invalid password reset link.");
}

// Verify token validity and expiration
$stmt = $conn->prepare("SELECT user_id FROM users WHERE reset_token = ? AND token_expiry >= NOW()");
$stmt->bind_param("s", $token);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $userId = $row['user_id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $newPassword = $_POST['password'];
        $confirmPassword = $_POST['confirm_password'];

        if ($newPassword === $confirmPassword) {
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            // Update password and clear reset token
            $update = $conn->prepare("UPDATE users SET password_hash = ?, reset_token = NULL, token_expiry = NULL WHERE user_id = ?");
            $update->bind_param("si", $hashedPassword, $userId);
            if ($update->execute()) {
                $success = "Password successfully updated! You can now <a href='login.php'>log in</a>.";
            } else {
                $error = "Error updating password. Please try again.";
            }
            $update->close();
        } else {
            $error = "Passwords do not match.";
        }
    }
} else {
    $error = "This password reset link is invalid or has expired.";
}
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:description" content="Ngwana Baby House volunteer dashboard. Volunteers can see real-time needs and volunteer to help. Staff can manage their volunteers and get insights.">
    <title>Set New Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../main.css">
</head>
<body class="background">
<section class="backgroundImageSignup">
    <div class="block">
        <h2>Create New Password</h2>
        <h5 class="signupH5">Please enter your new password below.</h5>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php elseif (empty($error) || isset($_POST['password'])): ?>
            <form class="formSignUp" method="POST" action="">
                <label for="password">New Password:</label><br>
                <input type="password" id="password" name="password" required class="form-control mb-3"><br>

                <label for="confirm_password">Confirm Password:</label><br>
                <input type="password" id="confirm_password" name="confirm_password" required class="form-control mb-3"><br>

                <button type="submit" class="primaryButton buttonText landingButton w-100">Update Password</button>
            </form>
        <?php endif; ?>
    </div>
</section>
</body>
</html>