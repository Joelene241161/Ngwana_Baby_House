<?php
// Composer's autoloader for the AWS SDK
require_once __DIR__ . '/vendor/autoload.php';

use Aws\Ssm\SsmClient;
use Aws\Exception\AwsException;

// database details
$db_host = 'volunteerhouse.c74ukksqond2.eu-north-1.rds.amazonaws.com';
$db_user = 'adminGorilla';                                            
$db_name = 'ngwana_baby_house';                                       
$db_port = 3306;
$db_pass = null;

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