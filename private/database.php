<?php
date_default_timezone_set('Asia/Manila');
$_SESSION['time'] = date('h:i A');
$_SESSION['date'] = date('Y-m-d');

$hostname = "localhost";
$username = "root";
$password = "";
$database = "payroll";

try {
    $conn = new PDO('mysql:host=localhost;dbname=payroll', $username, $password);
} catch (PDOException $e) {
// Handle connection error
    $error_code = $e->getCode();

    if($error_code == 1049) {
        // Handle unknown database error
        echo 'Database does not exist';
    } elseif ($error_code == 2002) {  
        // Handle connection refused error
        echo 'Connection failed - check credentials';
    } else {
        // Handle other errors
        echo 'Connection failed with error '.$error_code; 
    }
}
?>