<?php
session_start();
require ('../private/database.php');
if(isset($_POST['bar']) && (isset($_POST['filter']))){
    $search = $_POST['bar'];
    $filter = $_POST['filter'];
    $_SESSION['bar'] = $search;
    $_SESSION['filter'] = $filter;
    echo header('Location: ../public/admin/viewEmp.php');
    exit();
}else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Access the sent data using $_POST superglobal
    $username = file_get_contents('php://input');    // Optionally, you can send a response back to the JavaScript
    $stmt = $conn->prepare('SELECT job, rate FROM employee WHERE uid = :id');
    $stmt->bindParam(':id', $username, PDO::PARAM_STR);
    if($stmt->execute()){
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result){
            $job = $result['job'];
            $rate = $result['rate'];
            $combinedData = [
                'job' => $job,
                'rate' => $rate
            ];
            echo json_encode($combinedData);
        }else{
            $_SESSION['error'] = true;
        }
    }
} else {
    echo 'No data received.';
}

?>