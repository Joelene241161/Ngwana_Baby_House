<?php
// Strict environment variable check for Azure MySQL Flexible Server
$db_host = getenv('DB_HOST') ?: ($_ENV['DB_HOST'] ?? null);
$db_user = getenv('DB_USER') ?: ($_ENV['DB_USER'] ?? null);
$db_pass = getenv('DB_PASS') ?: ($_ENV['DB_PASS'] ?? null);
$db_name = getenv('DB_NAME') ?: ($_ENV['DB_NAME'] ?? null);

if (!$db_host || !$db_user || !$db_pass || !$db_name) {
    die("Critical Error: Database environment variables are missing in Azure App Service.");
}

// Path to Azure's SSL certificate
$ssl_cert = __DIR__ . '/DigiCertGlobalRootG2.crt.pem';

// Initialize MySQL with SSL enabled for Azure
$conn = mysqli_init();

if (file_exists($ssl_cert)) {
    mysqli_ssl_set($conn, NULL, NULL, $ssl_cert, NULL, NULL);
}

// Connect using Azure variables
@mysqli_real_connect($conn, $db_host, $db_user, $db_pass, $db_name, $db_port, NULL, MYSQLI_CLIENT_SSL);

// Check connection
if (mysqli_connect_errno()) {
    error_log("Database Connection Failed: " . mysqli_connect_error());
    die("Database connection failed. Please check your SSL certificate and firewall settings.");
}

// Set charset
mysqli_set_charset($conn, "utf8mb4");

// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>