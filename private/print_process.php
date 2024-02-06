<?php
session_start();
ob_start();
require ('database.php');
require '../vendor/autoload.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $print = file_get_contents('php://input');
    $_SESSION['printId'] = $print;
    echo json_encode($_SESSION['printId']);
}else{
    $dompdf = new Dompdf\Dompdf(['isRemoteEnabled' => true]);
    include("document.php");
    $html = ob_get_contents();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'potrait');
    $dompdf->render();
    ob_get_clean();
    $dompdf->stream("", array("Attachment" => false));
}
?>