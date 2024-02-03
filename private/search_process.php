<?php
session_start();
require ('../private/database.php');
if(isset($_POST['empBar']) && (isset($_POST['empFilter']))){
    $search = $_POST['empBar'];
    $filter = $_POST['empFilter'];
    $_SESSION['empBar'] = $search;
    $_SESSION['empFilter'] = $filter;
    echo header('Location: ../public/admin/viewEmp.php');
    exit();
}else if(isset($_POST['onCallBar']) && (isset($_POST['onCallFilter']))){
    $search = $_POST['onCallBar'];
    $filter = $_POST['onCallFilter'];
    $_SESSION['onCallBar'] = $search;
    $_SESSION['onCallFilter'] = $filter;
    echo header('Location: ../public/admin/viewOnCall.php');
    exit();
}else if(isset($_POST['payrollBar']) && (isset($_POST['payrollFilter']))){
    $search = $_POST['payrollBar'];
    $filter = $_POST['payrollFilter'];
    $_SESSION['payrollBar'] = $search;
    $_SESSION['payrollFilter'] = $filter;
    echo header('Location: ../public/admin/payroll.php');
    exit();
}else if(isset($_POST['homepageBar']) && (isset($_POST['homepageFilter']))){
    $search = $_POST['homepageBar'];
    $filter = $_POST['homepageFilter'];
    $_SESSION['homepageBar'] = $search;
    $_SESSION['homepageFilter'] = $filter;
    echo header('Location: ../public/admin/homepage.php');
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