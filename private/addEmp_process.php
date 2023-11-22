<?php
session_start();
require ('../private/database.php');
require ('../private/functions.php');

if(isset($_POST['add'])){
    if(isset($_FILES['image'])){
        date_default_timezone_set('Asia/Manila');
        $username = empId();
        $hired = date('Y-m-d H:i:s');
        for($i = 2; $i < 20; $i++){
            ${'add'.$i} = $_POST['add'.$i];
        }
        $hashed = password_hash($add2, PASSWORD_BCRYPT);
        $stmt = $conn->prepare('INSERT INTO employee (uid, hired, last, first, middle, suffix, birthday, age, gender, email, phone, status, sss, philHealth, job, rate, address, eName, ePhone, eAdd, hashed) VALUES (:uid, :hired, :add2, :add3, :add4, :add5, :add6, :add7, :add8, :add9, :add10, :add11, :add12, :add13, :add14, :add15, :add16, :add17, :add18, :add19, :hashed)');
        for($i = 0; $i < 21; $i++){
            if ($i == 0){
                $stmt->bindParam(':uid', $username, PDO::PARAM_STR);
            }else if ($i == 1){
                $stmt->bindParam(':hired', $hired, PDO::PARAM_STR);
            }else if ($i == 20){
                $stmt->bindParam(':hashed', $hashed, PDO::PARAM_STR);
            }else{
                $stmt->bindParam(':add'.$i, ${'add'.$i}, PDO::PARAM_STR);
            }
        }
        $stmt->execute();

        //Upload Image
        $file = $_FILES['image'];
        $name = $file['name'];
        $extension = pathinfo($name, PATHINFO_EXTENSION);
        $uniqueName = $username.'.'.$extension;
        $tmp_name = $file['tmp_name'];
        $size = $file['size'];
        $type = $file['type'];
        if($size > 5000000) {
            $_SESSION['error1'] = 'error';
            echo header('Location: ../public/admin/addEmp.php');
            exit();
        } else if(!in_array($type, ['image/jpg', 'image/png', 'image/jpeg'])) {
            $_SESSION['error2'] = 'error';
            echo header('Location: ../public/admin/addEmp.php');
            exit();
        } else {
            $filename = $uniqueName;
            $directory = '../private/images/empImage/'; 
            $uploadPath = $directory . $filename;
            if(move_uploaded_file($tmp_name, $uploadPath)) {
            $stmt= $conn->prepare("INSERT INTO image (uid, name, size, type, path) VALUES (?,?,?,?,?)");
            $stmt->bindParam(1, $username, PDO::PARAM_STR);
            $stmt->bindParam(2, $uniqueName, PDO::PARAM_STR);
            $stmt->bindParam(3, $size, PDO::PARAM_STR);
            $stmt->bindParam(4, $type, PDO::PARAM_STR);
            $stmt->bindParam(5, $uploadPath, PDO::PARAM_STR);
            if($stmt->execute()){
                $_SESSION['success'] = 'success';
                echo header('Location: ../public/admin/addEmp.php');
                exit();
            }else{
                $_SESSION['error5'] = 'error';
                echo header('Location: ../public/admin/addEmp.php');
                exit();
            }
            } else {
                $_SESSION['error3'] = 'error';
                echo header('Location: ../public/admin/addEmp.php');
                exit();
            }
        }
    }else{
        echo header('Location: ../public/admin/addEmp.php');
        exit();
    }
}
?>