<?php
require_once '../config.php';

// Unset all session variables
$_SESSION = array();

// delete the session cookie.
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

session_destroy();

// Redirect the user to the log in page
header("Location: ../Pages/login.php");
exit();
?>