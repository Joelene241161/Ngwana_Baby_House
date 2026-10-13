<?php
require_once '../config.php';
header('Content-Type: application/json');

$user_id = $_POST['user_id'] ?? ($_SESSION['user_id'] ?? 1);
$username = trim($_POST['username'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['telephoneNumber'] ?? '');
$password = $_POST['password'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? '';

if (empty($username) || empty($email) || empty($phone)) {
    echo json_encode(['success' => false, 'message' => 'Name, email, and phone number are required.']);
    exit;
}

// parameters for query
$params = [$username, $email, $phone];
$types = "sss";
$profilePictureClause = "";
$passwordClause = "";

// handle profile picture upload
if (isset($_FILES['profilePicture']) && $_FILES['profilePicture']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['profilePicture']['tmp_name'];
    $fileName = $_FILES['profilePicture']['name'];
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
    if (in_array($fileExtension, $allowedExtensions)) {
        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
        $uploadFileDir = '../uploads/';
        
        if (!is_dir($uploadFileDir)) {
            mkdir($uploadFileDir, 0755, true);
        }
        
        if(move_uploaded_file($fileTmpPath, $uploadFileDir . $newFileName)) {
            $profilePictureClause = ", profilePicture = ?";
            $params[] = $newFileName;
            $types .= "s";
        }
    }
}

// handle password change
if (!empty($password)) {
    if ($password !== $confirm_password) {
        echo json_encode(['success' => false, 'message' => 'Passwords do not match.']);
        exit;
    }
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $passwordClause = ", password_hash = ?";
    $params[] = $passwordHash;
    $types .= "s";
}

// add user_id to parameters for the WHERE
$params[] = $user_id;
$types .= "i";

$sql = "UPDATE users SET username = ?, email = ?, telephoneNumber = ?" . $profilePictureClause . $passwordClause . " WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param($types, ...$params);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Account updated successfully!']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error updating record: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>