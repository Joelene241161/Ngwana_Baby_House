<?php
// Composer's autoloader for the AWS SDK
require_once __DIR__ . '/vendor/autoload.php';

use Aws\Ssm\SsmClient;
use Aws\Exception\AwsException;

// environment variable
$db_host = getenv('DB_HOST') ?: ($_ENV['DB_HOST'] ?? null);
$db_user = getenv('DB_USER') ?: ($_ENV['DB_USER'] ?? null);
$db_name = getenv('DB_NAME') ?: ($_ENV['DB_NAME'] ?? null);
$db_port = getenv('DB_PORT') ?: ($_ENV['DB_PORT'] ?? 3306);
$db_pass = getenv('DB_PASS') ?: ($_ENV['DB_PASS'] ?? null);

if (!$db_pass) {
    try {
        $ssmClient = new SsmClient([
            'version' => 'latest',
            'region'  => 'eu-north-1',
        ]);

        // Fetch parameters
        $result = $ssmClient->getParameter([
            'Name'           => '/production/db/password',
            'WithDecryption' => true,
        ]);

        $db_pass = $result['Parameter']['Value'];
    } catch (AwsException $e) {
        error_log("AWS SSM Error: " . $e->getMessage());
    }
}

if (!$db_host || !$db_user || !$db_pass || !$db_name) {
    die("Critical Error: Database configuration or AWS Parameter Store credentials are missing.");
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