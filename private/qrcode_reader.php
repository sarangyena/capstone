<?php
session_start();
require ('../private/database.php');
require ('../private/functions.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $qr = file_get_contents('php://input');
    $_SESSION['qrId'] = $qr;
    echo json_encode($_SESSION['qrId']);
}else{
    // Prepare a SQL query to retrieve the file path of the image
    $stmt = $conn->prepare("SELECT name, path FROM qrcode WHERE id = :id");
    $stmt->bindParam(':id', $_SESSION['qrId'], PDO::PARAM_STR);
    $stmt->execute();

    // Fetch the result
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($result) {
        // Output appropriate headers
        header("Content-Type: image/png");
        header("Content-Disposition: attachment; filename=\"" . basename($result['name']) . "\"");
        header("Content-Length: " . filesize($result['path']));

        // Output the image file contents
        readfile($result['path']);
        exit;
    }
}

?>