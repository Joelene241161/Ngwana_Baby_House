<?php
// Strict environment variable check for AWS RDS
$db_host = getenv('DB_HOST') ?: ($_ENV['DB_HOST'] ?? null);
$db_user = getenv('DB_USER') ?: ($_ENV['DB_USER'] ?? null);
$db_pass = getenv('DB_PASS') ?: ($_ENV['DB_PASS'] ?? null);
$db_name = getenv('DB_NAME') ?: ($_ENV['DB_NAME'] ?? null);
$db_port = getenv('DB_PORT') ?: ($_ENV['DB_PORT'] ?? 3306);

if (!$db_host || !$db_user || !$db_pass || !$db_name) {
    die("Critical Error: Database environment variables are missing in AWS EC2.");
}

// Initialize MySQL
$conn = mysqli_init();

@mysqli_real_connect($conn, $db_host, $db_user, $db_pass, $db_name, (int)$db_port, NULL, 0);

// Check connection
if (mysqli_connect_errno()) {
    error_log("Database Connection Failed: " . mysqli_connect_error());
    die("Database connection failed. Please check your AWS security groups and credentials.");
}

// Set charset
mysqli_set_charset($conn, "utf8mb4");

// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>