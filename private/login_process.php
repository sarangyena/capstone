<?php
session_start();
require ('database.php');

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $type = $username[0];
    if($type === 'E'){
        $_SESSION['role'] = 'E';
        $stmt = $conn->prepare('SELECT hashed FROM employee WHERE id = :id');
        $stmt->bindParam(':id', $username, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result){
            $hashed = $result['hashed'];
            if(password_verify($password, $hashed)){
                $_SESSION['user_id'] = $username;
                echo header ('Location: ../public/employee/homepage.php');
                exit();
            }else{
                $_SESSION['alert'] = true;
                echo header ('Location: ../index.php');
                exit();
            }
        }else{
            $_SESSION['alert'] = true;
            echo header ('Location: ../index.php');
            exit();
        }
    }else if($type === 'O'){
        $_SESSION['role'] = 'O';
        $stmt = $conn->prepare('SELECT hashed FROM onCall WHERE id = :id');
        $stmt->bindParam(':id', $username, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result){
            $hashed = $result['hashed'];
            if(password_verify($password, $hashed)){
                $_SESSION['user_id'] = $username;
                echo header ('Location: ../public/employee/homepage.php');
                exit();
            }else{
                $_SESSION['alert'] = true;
                echo header ('Location: ../index.php');
                exit();
            }
        }else{
            $_SESSION['alert'] = true;
            echo header ('Location: ../index.php');
            exit();
        }
    }else if($username === 'admin'){
        $stmt = $conn->prepare('SELECT hashed FROM superadmin WHERE username = :id');
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
                $_SESSION['alert'] = true;
                echo header ('Location: ../index.php');
                exit();
            }
        }else{
            $_SESSION['alert'] = true;
            echo header ('Location: ../index.php');
            exit();
        }
    }else{
        $_SESSION['error'] = true;
        echo header ('Location: ../index.php');
        exit();
    }
    

    
}
?>