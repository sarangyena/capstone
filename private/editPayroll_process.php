<?php
session_start();
require ('../private/database.php');
require ('../private/functions.php');


if(isset($_POST['editPayroll'])){
    $rate = $_POST['rate'];
    $holiday = $_POST['holiday'];
    $philhealth = $_POST['philhealth'];
    $sss = $_POST['sss'];
    $advance = $_POST['advance'];
    $stmt = $conn->prepare('UPDATE payroll SET rate = :rate, holiday = :holiday, philhealth = :philhealth, sss = :sss, advance = :advance WHERE id = :id');
    $stmt->bindParam(':rate', $rate, PDO::PARAM_INT);
    $stmt->bindParam(':holiday', $holiday, PDO::PARAM_INT);
    $stmt->bindParam(':philhealth', $philhealth, PDO::PARAM_INT);
    $stmt->bindParam(':sss', $sss, PDO::PARAM_INT);
    $stmt->bindParam(':advance', $advance, PDO::PARAM_INT);
    $stmt->bindParam(':id', $_SESSION['rowId'], PDO::PARAM_STR);
    if($stmt->execute()){
        $_SESSION['success'] = true;
        echo header('Location: ../public/admin/payroll.php');
    }else{
        $_SESSION['error'] = true;
        echo header('Location: ../public/admin/payroll.php');   
    }
}else{
    $data = file_get_contents('php://input');
    $_SESSION['rowId'] = $data;
    $stmt = $conn->prepare('SELECT * FROM payroll WHERE id = :id');
    $stmt->bindParam(':id', $_SESSION['rowId'], PDO::PARAM_STR);
    if($stmt->execute()){
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $oldRate = $result['rate']; 
        $oldHoliday = $result['holiday'];    
        $oldPhilhealth = $result['philhealth'];    
        $oldSSS = $result['sss'];    
        $oldAdvance = $result['advance'];   
        $payrollData = [
            'rate' => $oldRate,
            'holiday' => $oldHoliday,
            'philhealth' => $oldPhilhealth,
            'sss' => $oldSSS,
            'advance' => $oldAdvance
        ];
        echo json_encode($payrollData);
    }
}
?>