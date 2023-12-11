<?php
session_start();
require ('../private/database.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = file_get_contents('php://input');    // Optionally, you can send a response back to the JavaScript
    $role = explode("-", $username);
    $role = trim($role[0]);
    if(!isset($_SESSION['record'])){
        $_SESSION['record'] = array();
    } 
    if($role === 'ADMIN'){
        $stmt=$conn->prepare('SELECT last, first FROM admin WHERE uid = :id');
        $stmt->bindParam(':id', $username, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);         
        if($result){
            $name = $result['last'].', '.$result['first'];
            if(!isset($_SESSION['record'][$username])){
                $_SESSION['record'][$username] = true;
                $stmt=$conn->prepare('INSERT INTO record (uid, name, dateIn, timeIn) VALUES (:id, :name, NOW(), NOW())');
                $stmt->bindParam(':id', $username, PDO::PARAM_STR);
                $stmt->bindParam(':name', $name, PDO::PARAM_STR);
                $stmt->execute();
                $_SESSION['in'] = true;            
                echo json_encode(['in' => $_SESSION['record']]);
            }else{
                $stmt=$conn->prepare('UPDATE record SET dateOut = NOW(), timeOut = NOW() WHERE uid = :id ORDER BY timeIn DESC LIMIT 1');
                $stmt->bindParam(':id', $username, PDO::PARAM_STR);
                $stmt->execute();
                unset($_SESSION['record'][$username]);
                $_SESSION['out'] = true;
                echo json_encode(['out' => $_SESSION['record']]);
            }
        }else{
            $_SESSION['error'] = true;
        }
    }else if($role === 'EMP'){
        $stmt=$conn->prepare('SELECT last, first FROM employee WHERE uid = :id');
        $stmt->bindParam(':id', $username, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);         
        if($result){
            $name = $result['last'].', '.$result['first'];
            if(!isset($_SESSION['record'][$username])){
                $_SESSION['record'][$username] = true;
                $stmt=$conn->prepare('INSERT INTO record (uid, name, dateIn, timeIn) VALUES (:id, :name, NOW(), NOW())');
                $stmt->bindParam(':id', $username, PDO::PARAM_STR);
                $stmt->bindParam(':name', $name, PDO::PARAM_STR);
                $stmt->execute();
                $_SESSION['in'] = true;            
                echo json_encode(['in' => $_SESSION['record']]);
            }else{
                $stmt=$conn->prepare('UPDATE record SET dateOut = NOW(), timeOut = NOW() WHERE uid = :id ORDER BY timeIn DESC LIMIT 1');
                $stmt->bindParam(':id', $username, PDO::PARAM_STR);
                $stmt->execute();
                unset($_SESSION['record'][$username]);
                $_SESSION['out'] = true;
                echo json_encode(['out' => $_SESSION['record']]);
            }
        }else{
            $_SESSION['error'] = true;
        }
    }
}
?>