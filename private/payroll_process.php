<?php
session_start();
require ('database.php');

if(isset($_POST['compute'])){
    date_default_timezone_set('Asia/Manila');
    $username = $_POST['select'];
    $date = date('Y-m-d H:i:s');
    for($i = 1; $i <= 13; $i++){
        ${'compute'.$i} = $_POST['compute'.$i];
    }
    $stmt = $conn->prepare('SELECT last, first, job FROM employee WHERE uid = :id');
    $stmt->bindParam(":id", $username, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if($result){
        $name = $result['last'].', '.$result['first'];
        $job = $result['job'];
    }
    $stmt = $conn->prepare('INSERT INTO payroll (uid, name, date, job, days, late, rate, salary, rph, hours, otPay, holiday, allowances, philHealth, sss, advance, amount) VALUES (:id, :name, :date, :job, :compute1, :compute2,:compute3, :compute4, :compute5, :compute6, :compute7, :compute8, :compute9, :compute10, :compute11, :compute12, :compute13)');
    $stmt->bindParam(':id', $username, PDO::PARAM_STR);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':date', $date, PDO::PARAM_STR);
    $stmt->bindParam(':job', $job, PDO::PARAM_STR);
    for($i = 1; $i <= 13; $i++){
        $stmt->bindParam(':compute'.$i, ${'compute'.$i}, PDO::PARAM_STR);
    }
    if($stmt->execute()){
        $_SESSION['success'] = true;
        echo header('Location: ../public/admin/payroll.php');
        exit();
    }else{
        $_SESSION['error'] = true;
        echo header('Location: ../public/admin/payroll.php');
        exit();
    }
}
?>