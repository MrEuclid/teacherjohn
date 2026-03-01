<?php
// connectTeacherJohn.php

$server = 'localhost';
$username = 'euclid_test';
$password = 'pythagoras1950'; 
$database = 'euclid_test';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    // This will now work perfectly because $username and $database are identical!
    $dbServer = new mysqli($server, $username, $password, $database);
    $dbServer->set_charset("utf8mb4");
} catch (Exception $e) {
    error_log($e->getMessage());
    exit("Database connection failed. Please contact the administrator.");
}
?>