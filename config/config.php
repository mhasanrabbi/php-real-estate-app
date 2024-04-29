<?php

$dbhost = 'localhost';
$dbname = 'php_real_estate';
$dbuser = 'root';
$dbpass = '';
try {
    $pdo = new PDO("mysql:host={$dbhost};dbname={$dbname}", $dbuser, $dbpass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch( PDOException $exception ) {
    echo "Connection error :" . $exception->getMessage();
}

define("BASE_URL", "http://localhost/php_real_estate/");
define("ADMIN_URL", BASE_URL . "admin/");

define("SMTP_HOST", "sandbox.smtp.mailtrap.io");
define("SMTP_PORT", "2525");
define("SMTP_USERNAME", "302fd4aa1e98a0");
define("SMTP_PASSWORD", "c0dcea3a4d3607");