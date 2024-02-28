<?php
session_start();
require ('../private/database.php');
require ('../private/functions.php');
require_once '../private/phpqrcode/qrlib.php';

if(isset($_POST['add'])){
    if(isset($_FILES['image'])){
        date_default_timezone_set('Asia/Manila');
        $username = empId();
        $hired = date('Y-m-d H:i:s');
        for($i = 1; $i <= 15; $i++){
            ${'add'.$i} = $_POST['add'.$i];
        }
        $path = 'images/qrcode/';
        $pathname = $path.$username.".png";
        $filename = $username.".png";
        $data = $username;


        QRcode::png($data, $pathname, 'H', 4, 4);
        $path1 = '../private/images/qrcode/'.$username.'.png';

        if(file_exists($path1)){
            $targetDir = '../private/images/uploads/';
            $fileName = uniqid() . '_' . basename($path1);
            $targetFile = $targetDir . $fileName;

            if (copy($path1, $targetFile)) {
                $stmtQr = $conn->prepare('INSERT INTO qrcode (id, name, path) VALUES (:id, :name, :path)');
                $stmtQr->bindParam(':id', $username, PDO::PARAM_STR);
                $stmtQr->bindParam(':name', $fileName, PDO::PARAM_STR);
                $stmtQr->bindParam(':path', $targetFile, PDO::PARAM_STR);
                $stmtQr->execute();
            }
        }

        
        $initial = substr($add3, 0, 1);
        if ($initial){
            $name = $add1.', '.$add2.' '.$initial.'.';
        }else{
            $name = $add1.', '.$add2;
        }
        $hashed = password_hash($add1, PASSWORD_BCRYPT);
        $stmt = $conn->prepare('INSERT INTO employee (id, last, first, middle, status, email, phone, job, sss, philhealth, pagibig, rate, address, eName, ePhone, eAddress, hired, hashed) VALUES (:id, :add1, :add2, :add3, :add4, :add5, :add6, :add7, :add8, :add9, :add10, :add11, :add12, :add13, :add14, :add15, :hired, :hashed)');
        for($i = 0; $i <= 17; $i++){
            if ($i == 0){
                $stmt->bindParam(':id', $username, PDO::PARAM_STR);
            }else if ($i == 16){
                $stmt->bindParam(':hired', $hired, PDO::PARAM_STR);
            }else if ($i == 17){
                $stmt->bindParam(':hashed', $hashed, PDO::PARAM_STR);
            }else{
                $stmt->bindParam(':add'.$i, ${'add'.$i}, PDO::PARAM_STR);
            }
        }
        $stmt->execute();

        $status = 'NEW';
        $stmt = $conn->prepare('INSERT INTO dashboard (id, name, job, status) VALUES (:id, :name, :job, :status)');
        $stmt->bindParam(':id', $username, PDO::PARAM_STR);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':job', $add7, PDO::PARAM_STR);
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        $stmt->execute();
        
        $startDate = date('F d', strtotime('monday this week'));
        $currentWeek = $startDate.' - '.date('d').' ('.date('Y').')';

        $stmt = $conn->prepare('INSERT INTO payroll (id, week, name, job, rate) VALUES (:id, :week, :name, :job, :rate)');
        $stmt->bindParam(':id', $username, PDO::PARAM_STR);
        $stmt->bindParam(':week', $currentWeek, PDO::PARAM_STR);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':job', $add7, PDO::PARAM_STR);
        $stmt->bindParam(':rate', $add11, PDO::PARAM_STR);
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
            $directory = '../private/images/employee/'; 
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