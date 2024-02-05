<?php
require ('../private/database.php');
require ('../private/functions.php');
$stmt = $conn->prepare('SELECT * FROM dashboard');
$stmt->execute();
while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
    $id = $result['id'];
    $dateOut = $result['dateIn'];
    $date = new DateTime($dateOut);
    $current = new DateTime();
    $interval = $current->diff($date);
    $days = $interval->days;
    if ($days > 30) {
        $stmt = $conn->prepare('UPDATE dashboard SET status = "INACTIVE" WHERE id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
    }
}
?>