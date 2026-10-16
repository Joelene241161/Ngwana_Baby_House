<?php
require_once '../config.php';


if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $currentUserId = intval($_SESSION['user_id']);

    $conn->begin_transaction();

    try {
        // Remove associated bookings
        $delBookings = $conn->prepare("DELETE FROM bookings WHERE user_id = ?");
        $delBookings->bind_param("i", $currentUserId);
        $delBookings->execute();
        $delBookings->close();

        // Remove associated messages
        $delMessages = $conn->prepare("DELETE FROM message WHERE sender_id = ? OR recipient_id = ?");
        $delMessages->bind_param("ii", $currentUserId, $currentUserId);
        $delMessages->execute();
        $delMessages->close();

        // Delete user account
        $delUser = $conn->prepare("DELETE FROM users WHERE user_id = ?");
        $delUser->bind_param("i", $currentUserId);
        $delUser->execute();
        $delUser->close();

        // Commit transaction
        $conn->commit();

        // Destroy session and redirect to login page
        $_SESSION = array();
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(), 
                '', 
                time() - 42000,
                $params["path"], 
                $params["domain"],
                $params["secure"], 
                $params["httponly"]
            );
        }
        session_destroy();

        header("Location: ../Pages/login.php?msg=account_deleted");
        exit();

    } catch (Exception $e) {
        $conn->rollback();
        header("Location: " . $_SERVER['HTTP_REFERER'] . "?error=delete_failed");
        exit();
    }
} else {
    header("Location: ../index.php");
    exit();
}
?>