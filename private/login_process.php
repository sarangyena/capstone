<?php
session_start();
require ('database.php');

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = explode("-", $username);
    $role = trim($role[0]);
    $_SESSION['role'] = $role;

    if($role === 'ADMIN'){
        $stmt = $conn->prepare('SELECT hashed FROM admin WHERE uid = :id');
        $stmt->bindParam(':id', $username, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result){
            $hashed = $result['hashed'];
            if(password_verify($password, $hashed)){
                $_SESSION['user_id'] = $username;
                echo header ('Location: ../public/admin/homepage.php');
                exit();
            }else{
                $_SESSION['alert'] = "Failed";
                echo header ('Location: ../index.php');
                exit();
            }
        }else{
            $_SESSION['alert'] = "Failed";
            echo header ('Location: ../index.php');
            exit();
        }
    }else if($role === 'EMP'){
        $stmt = $conn->prepare('SELECT hashed FROM employee WHERE uid = :id');
        $stmt->bindParam(':id', $username, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result){
            $hashed = $result['hashed'];
            if(password_verify($password, $hashed)){
                $_SESSION['user_id'] = $username;
                echo header ('Location: ../public/admin/homepage.php');
                exit();
            }else{
                $_SESSION['alert'] = "Failed";
                echo header ('Location: ../index.php');
                exit();
            }
        }else{
            $_SESSION['alert'] = "Failed";
            echo header ('Location: ../index.php');
            exit();
        }
    }else{
        $_SESSION['alert'] = "Failed";
        echo header ('Location: ../index.php');
        exit();
    }
}
?>