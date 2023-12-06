<?php
session_start();
require ('database.php');
require ('functions.php');

if(isset($_POST['change'])){
    $username = $_SESSION['user_id'];
    $role = $_SESSION['role'];
    $old = $_POST['old'];
    $new = $_POST['new'];
    if($role == 'EMP'){
        $stmt = $conn->prepare('SELECT hashed FROM employee WHERE uid = :id');
        $stmt->bindParam(':id', $username, PDO::PARAM_STR);
        if($stmt->execute()){
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if($result){
                $hashed = $result['hashed'];
                if(password_verify($old, $hashed)){
                    if($old == $new){
                        $_SESSION['error2'] = true;
                        echo header('Location: ../public/employee/changePass.php');
                        exit();
                    }else{
                        $hashed = password_hash($new, PASSWORD_BCRYPT);
                        $stmt = $conn->prepare('UPDATE employee SET hashed = :password WHERE uid = :id');
                        $stmt->bindParam(':password', $hashed, PDO::PARAM_STR);
                        $stmt->bindParam(':id', $username, PDO::PARAM_STR);
                        if($stmt->execute()){
                            $_SESSION['success'] = true;
                            echo header('Location: ../public/employee/changePass.php');
                            exit();
                        }else{
                            $_SESSION['error'] = true;
                            echo header('Location: ../public/employee/changePass.php');
                            exit();
                        }
                    }
                }else{
                    $_SESSION['error1'] = true;
                    echo header('Location: ../public/employee/changePass.php');
                    exit();
                }
            }
        }else{
            $_SESSION['error'] = true;
            echo header('Location: ../public/employee/changePass.php');
            exit();
        }
    }else if($role == 'ADMIN'){
        $stmt = $conn->prepare('SELECT hashed FROM admin WHERE uid = :id');
        $stmt->bindParam(':id', $username, PDO::PARAM_STR);
        if($stmt->execute()){
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if($result){
                $hashed = $result['hashed'];
                if(password_verify($old, $hashed)){
                    if($old == $new){
                        $_SESSION['error2'] = true;
                        echo header('Location: ../public/admin/changePass.php');
                        exit();
                    }else{
                        $hashed = password_hash($new, PASSWORD_BCRYPT);
                        $stmt = $conn->prepare('UPDATE admin SET hashed = :password WHERE uid = :id');
                        $stmt->bindParam(':password', $hashed, PDO::PARAM_STR);
                        $stmt->bindParam(':id', $username, PDO::PARAM_STR);
                        if($stmt->execute()){
                            $_SESSION['success'] = true;
                            echo header('Location: ../public/admin/changePass.php');
                            exit();
                        }else{
                            $_SESSION['error'] = true;
                            echo header('Location: ../public/admin/changePass.php');
                            exit();
                        }
                    }
                }else{
                    $_SESSION['error1'] = true;
                    echo header('Location: ../public/admin/changePass.php');
                    exit();
                }
            }
        }else{
            $_SESSION['error'] = true;
            echo header('Location: ../public/admin/changePass.php');
            exit();
        }
    }
    

}
?>