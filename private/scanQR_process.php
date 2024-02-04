<?php
session_start();
require ('../private/database.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jsonData = file_get_contents('php://input');
    $data = json_decode($jsonData, true);
    $username = $data['user'];
    if($data['latitude'] = '14.8443' && $data['longitude'] = '120.810204'){
        $location = "Al Dawah Producers Cooperative";
    }else{
        $location = "Other Location";
    }
    $logOut = 0;
    $logIn = 1;
    $status = 'ACTIVE';
    $time = date('h:i A');
    $date = date('Y-m-d');
    $unix = time();

    $stmt = $conn->prepare('SELECT last, first, middle, job FROM employee WHERE id = :id');
    $stmt->bindParam(':id', $username, PDO::PARAM_STR);
    if($stmt->execute()){
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $job = $result['job'];
        $initial = substr($result['middle'], 0, 1);
        if ($initial){
            $name = $result['last'].', '.$result['first'].' '.$initial.'.';
        }else{
            $name = $result['last'].', '.$result['first'];
        }

        $stmt = $conn->prepare('SELECT * FROM log WHERE id = :id AND log = :log');
        $stmt->bindParam(':id', $username, PDO::PARAM_STR);
        $stmt->bindParam(':log', $logIn, PDO::PARAM_BOOL);
        if($stmt->execute()){
            $result = $stmt->rowCount();
            if($result === 0){
                $stmt = $conn->prepare('INSERT INTO log (id, name, job, dateIn, timeIn, location, log, updateTime) VALUES (:id, :name, :job, :date, :time, :location, :log, :update)');
                $stmt->bindParam(':id', $username, PDO::PARAM_STR);
                $stmt->bindParam(':name', $name, PDO::PARAM_STR);
                $stmt->bindParam(':job', $job, PDO::PARAM_STR);
                $stmt->bindParam(':date', $date, PDO::PARAM_STR);
                $stmt->bindParam(':time', $time, PDO::PARAM_STR);
                $stmt->bindParam(':location', $location, PDO::PARAM_STR);
                $stmt->bindParam(':log', $logIn, PDO::PARAM_BOOL);
                $stmt->bindParam(':update', $unix, PDO::PARAM_STR);
                if($stmt->execute()){
                    $stmt = $conn->prepare('UPDATE dashboard SET dateIn = :date, timeIn = :time, status = :status WHERE id = :id');
                    $stmt->bindParam(':id', $username, PDO::PARAM_STR);
                    $stmt->bindParam(':date', $date, PDO::PARAM_STR);
                    $stmt->bindParam(':time', $time, PDO::PARAM_STR);
                    $stmt->bindParam(':status', $status, PDO::PARAM_STR);
                    if($stmt->execute()){
                        $_SESSION['success'] = true;
                    }else{
                        $_SESSION['fail'] = true;
                    }
                }else{
                    $_SESSION['fail'] = true;
                }
            }else if($result === 1){
                $stmt = $conn->prepare('UPDATE log SET dateOut = :date, timeOut = :time, log = :log, updateTime = :update WHERE id = :id AND log = :logIn');
                $stmt->bindParam(':id', $username, PDO::PARAM_STR);
                $stmt->bindParam(':date', $date, PDO::PARAM_STR);
                $stmt->bindParam(':time', $time, PDO::PARAM_STR);
                $stmt->bindParam(':log', $logOut, PDO::PARAM_BOOL);
                $stmt->bindParam(':logIn', $logIn, PDO::PARAM_BOOL);
                $stmt->bindParam(':update', $unix, PDO::PARAM_STR);
                if($stmt->execute()){
                    $stmt = $conn->prepare('UPDATE dashboard SET dateOut = :date, timeOut = :time, status = :status WHERE id = :id');
                    $stmt->bindParam(':id', $username, PDO::PARAM_STR);
                    $stmt->bindParam(':date', $date, PDO::PARAM_STR);
                    $stmt->bindParam(':time', $time, PDO::PARAM_STR);
                    $stmt->bindParam(':status', $status, PDO::PARAM_STR);
                    if($stmt->execute()){
                        $_SESSION['success'] = true;
                    }else{
                        $_SESSION['fail'] = true;
                    }
                }else{
                    $temp = false;
                    echo json_encode($temp);
                }
            }
        }

    }else{
        //No id exist.
        $_SESSION['fail'] = true;
    }

    
}
    /*$stmt = $conn->prepare('SELECT last, first, middle, job FROM employee1 WHERE id = :id');
    $stmt->bindParam(':id', $username, PDO::PARAM_STR);
    if($stmt->execute()){
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $job = $result['job'];
        $initial = substr($result['middle'], 0, 1);
        if ($initial){
            $name = $result['last'].', '.$result['first'].' '.$initial.'.';
        }else{
            $name = $result['last'].', '.$result['first'];
        }

        $stmt = $stmt->prepare('INSERT INTO record1 (id, name, )')
    }
    
    
    
    
    
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
    }*/
?>