<?php
session_start();
require ('../private/database.php');
require ('../private/phpqrcode/qrlib.php');
include('../private/phpqrcode/qrconfig.php');


    // how to save PNG codes to server
    
    $tempDir = '../private/images/qrcode/';
    
    $codeContents = 'This Goes From File';
    
    // we need to generate filename somehow, 
    // with md5 or with database ID used to obtains $codeContents...
    $fileName = '003_file_'.md5($codeContents).'.png';
    
    $pngAbsoluteFilePath = $tempDir.$fileName;
    $urlRelativeFilePath = $tempDir.$fileName;
    
    // generating
    if (!file_exists($pngAbsoluteFilePath)) {
        QRcode::png($codeContents, $pngAbsoluteFilePath);
        echo 'File generated!';
        echo '<hr />';
    } else {
        echo 'File already generated! We can use this cached file to speed up site on common codes!';
        echo '<hr />';
    }
    
    echo 'Server PNG File: '.$pngAbsoluteFilePath;
    echo '<hr />';
    
    // displaying
    echo '<img src="'.$urlRelativeFilePath.'" />';
/*$stmt = $conn->prepare('SELECT imageData FROM qrcode WHERE id = "temp1"');
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result) {
    // Send headers to indicate image download
    header("Content-Type: image/png"); // Adjust the Content-Type based on the image format
    header("Content-Disposition: attachment; filename=\"downloaded_qrcode.png\"");
    header("Content-Length: " . strlen($result['imageData']));

    // Output image content
    echo $result['imageData'];
} else {
    echo "QR code image not found.";
}
/*$image_info = getimagesize('qrcode.png');
if ($image_info !== false) {
    $width = $image_info[0];
    $height = $image_info[1];
    $mime_type = $image_info['mime'];

    echo "Image width: $width pixels<br>";
    echo "Image height: $height pixels<br>";
    echo "MIME type: $mime_type<br>";
} else {
    echo "Failed to get image information.";
}*/

// Close the PDO connection
$pdo = null;
?>