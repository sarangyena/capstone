<?php
session_start();
require ('../private/database.php');
require ('../private/functions.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jsonData = file_get_contents('php://input');
    $data = json_decode($jsonData, true);
    $username = $data['user'];
    $role = $username[0];
    days($username);
    late($username);
    otHours($username);
    $userLatitude = $data['latitude'];
    $userLongitude = $data['longitude'];
    $specific = $userLatitude.', '.$userLongitude;
    $latitude = 14.8443;
    $longitude = 120.810204;
    if($userLatitude == $latitude && $userLongitude == $longitude){
        $location = "AL DAWAH PRODUCERS COOPERATIVE";
    }else{
        $location = "OTHER LOCATION";
    }
    $logOut = 0;
    $logIn = 1;
    $time = date('h:i A');
    $date = date('Y-m-d');
    $unix = time();

    if($role == 'E'){
        $stmt = $conn->prepare('SELECT last, first, middle, job FROM employee WHERE id = :id');
        $stmt->bindParam(':id', $username, PDO::PARAM_STR);
        $stmt->execute();
        $rows = $stmt->rowCount();
        if($rows === 1 ){
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
            $stmt->execute();
            $result = $stmt->rowCount();
            if($result === 0){
                $stmt = $conn->prepare('INSERT INTO log (id, name, job, dateIn, timeIn, location, specificLocation log, updateTime) VALUES (:id, :name, :job, :date, :time, :location, :specific, :log, :update)');
                $stmt->bindParam(':id', $username, PDO::PARAM_STR);
                $stmt->bindParam(':name', $name, PDO::PARAM_STR);
                $stmt->bindParam(':job', $job, PDO::PARAM_STR);
                $stmt->bindParam(':date', $date, PDO::PARAM_STR);
                $stmt->bindParam(':time', $time, PDO::PARAM_STR);
                $stmt->bindParam(':location', $location, PDO::PARAM_STR);
                $stmt->bindParam(':specific', $specific, PDO::PARAM_STR);
                $stmt->bindParam(':log', $logIn, PDO::PARAM_BOOL);
                $stmt->bindParam(':update', $unix, PDO::PARAM_STR);
                if($stmt->execute()){
                    $stmt = $conn->prepare('UPDATE dashboard SET dateIn = :date, timeIn = :time, status = "ACTIVE" WHERE id = :id');
                    $stmt->bindParam(':id', $username, PDO::PARAM_STR);
                    $stmt->bindParam(':date', $date, PDO::PARAM_STR);
                    $stmt->bindParam(':time', $time, PDO::PARAM_STR);
                    if($stmt->execute()){
                        $_SESSION['success'] = true;
                    }else{
                        $_SESSION['fail'] = true;
                    }
                }else{
                    $_SESSION['fail'] = true;
                }
            }else if($result === 1){
                $stmt = $conn->prepare('UPDATE log SET dateOut = :date, timeOut = :time, location = :location, specificLocation = :specific, log = :log, updateTime = :update WHERE id = :id AND log = :logIn');
                $stmt->bindParam(':id', $username, PDO::PARAM_STR);
                $stmt->bindParam(':date', $date, PDO::PARAM_STR);
                $stmt->bindParam(':time', $time, PDO::PARAM_STR);
                $stmt->bindParam(':location', $location, PDO::PARAM_STR);
                $stmt->bindParam(':specific', $specific, PDO::PARAM_STR);
                $stmt->bindParam(':log', $logOut, PDO::PARAM_BOOL);
                $stmt->bindParam(':logIn', $logIn, PDO::PARAM_BOOL);
                $stmt->bindParam(':update', $unix, PDO::PARAM_STR);
                if($stmt->execute()){
                    $stmt = $conn->prepare('UPDATE dashboard SET dateOut = :date, timeOut = :time, status = "ACTIVE" WHERE id = :id');
                    $stmt->bindParam(':id', $username, PDO::PARAM_STR);
                    $stmt->bindParam(':date', $date, PDO::PARAM_STR);
                    $stmt->bindParam(':time', $time, PDO::PARAM_STR);
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
        }else{
            $_SESSION['fail'] = true;
        }
    }else if($role == 'O'){
        $stmt = $conn->prepare('SELECT last, first, middle, job FROM oncall WHERE id = :id');
        $stmt->bindParam(':id', $username, PDO::PARAM_STR);
        $stmt->execute();
        $rows = $stmt->rowCount();
        if($rows === 1 ){
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
            $stmt->execute();
            $result = $stmt->rowCount();
            if($result === 0){
                $stmt = $conn->prepare('INSERT INTO log (id, name, job, dateIn, timeIn, location, specificLocation log, updateTime) VALUES (:id, :name, :job, :date, :time, :location, :specific, :log, :update)');
                $stmt->bindParam(':id', $username, PDO::PARAM_STR);
                $stmt->bindParam(':name', $name, PDO::PARAM_STR);
                $stmt->bindParam(':job', $job, PDO::PARAM_STR);
                $stmt->bindParam(':date', $date, PDO::PARAM_STR);
                $stmt->bindParam(':time', $time, PDO::PARAM_STR);
                $stmt->bindParam(':location', $location, PDO::PARAM_STR);
                $stmt->bindParam(':specific', $specific, PDO::PARAM_STR);
                $stmt->bindParam(':log', $logIn, PDO::PARAM_BOOL);
                $stmt->bindParam(':update', $unix, PDO::PARAM_STR);
                if($stmt->execute()){
                    $stmt = $conn->prepare('UPDATE dashboard SET dateIn = :date, timeIn = :time, status = "ACTIVE" WHERE id = :id');
                    $stmt->bindParam(':id', $username, PDO::PARAM_STR);
                    $stmt->bindParam(':date', $date, PDO::PARAM_STR);
                    $stmt->bindParam(':time', $time, PDO::PARAM_STR);
                    if($stmt->execute()){
                        $_SESSION['success'] = true;
                    }else{
                        $_SESSION['fail'] = true;
                    }
                }else{
                    $_SESSION['fail'] = true;
                }
            }else if($result === 1){
                $stmt = $conn->prepare('UPDATE log SET dateOut = :date, timeOut = :time, location = :location, specificLocation = :specific, log = :log, updateTime = :update WHERE id = :id AND log = :logIn');
                $stmt->bindParam(':id', $username, PDO::PARAM_STR);
                $stmt->bindParam(':date', $date, PDO::PARAM_STR);
                $stmt->bindParam(':time', $time, PDO::PARAM_STR);
                $stmt->bindParam(':location', $location, PDO::PARAM_STR);
                $stmt->bindParam(':specific', $specific, PDO::PARAM_STR);
                $stmt->bindParam(':log', $logOut, PDO::PARAM_BOOL);
                $stmt->bindParam(':logIn', $logIn, PDO::PARAM_BOOL);
                $stmt->bindParam(':update', $unix, PDO::PARAM_STR);
                if($stmt->execute()){
                    $stmt = $conn->prepare('UPDATE dashboard SET dateOut = :date, timeOut = :time, status = "ACTIVE" WHERE id = :id');
                    $stmt->bindParam(':id', $username, PDO::PARAM_STR);
                    $stmt->bindParam(':date', $date, PDO::PARAM_STR);
                    $stmt->bindParam(':time', $time, PDO::PARAM_STR);
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
        }else{
            $_SESSION['fail'] = true;
        }
    }
}

?>