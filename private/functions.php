<?php
function checkAuthentication(){
    if (!isset($_SESSION['user_id'])) {
        $_SESSION['auth'] = false;
        echo header('Location: ../../index.php');
    }
}
function displayName(){
    require (__DIR__ . '/database.php');
    $username = $_SESSION['user_id'];
    $role = $_SESSION['role'];
    if($role == 'ADMIN'){
        $stmt=$conn->prepare('SELECT uid, first, last FROM admin WHERE uid = ?');
        $stmt->bindParam(1, $username, PDO::PARAM_STR);
        if($stmt->execute()){
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            echo '<div class="alert alert-info my-auto" role="alert">
                            '.$result['last'].', '.$result['first'].' <strong>('.$result['uid'].')</strong> '.'
                    </div>';
        }
    }else if($role == 'EMP'){
        $stmt=$conn->prepare('SELECT uid, first, last FROM employee WHERE uid = ?');
        $stmt->bindParam(1, $username, PDO::PARAM_STR);
        if($stmt->execute()){
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            foreach ($result as $row){
                echo '<div class="alert alert-success my-auto" role="alert">
                        WELCOME'.$row['last'].', '.$row['first'].' ('.$row['uid'].') '.'
                    </div>';
            }
        }
    }
}
function empId(){
    require (__DIR__ . '/database.php');
    $year = date('y');
    $stmt = $conn->prepare('SELECT * FROM employee');
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $rows = $stmt->rowCount();
    $id = str_pad($rows, 5, '0', STR_PAD_LEFT);

    $uniqueID = "EMP-$year-$id";
    return $uniqueID;
}
function countData(){
    require (__DIR__ . '/database.php');
    $role = $_SESSION['role'];
    if($role == 'ADMIN'){
        $stmt = $conn->prepare('SELECT * FROM employee');
        if($stmt->execute()){
            $result = $stmt->rowCount();
            echo '<div class="alert alert-info my-auto" role="alert">
                    <h1 class="text-black text-center my-auto">'.$result.'</h1>
                </div>';
        }
    }else if ($role == 'EMP'){
        $stmt = $conn->prepare('SELECT * FROM employee');
        if($stmt->execute()){
            $result = $stmt->rowCount();
            return $result;
        }
    }
}
function tableData(){
    require (__DIR__ . '/database.php');
    $stmt = $conn->prepare('SELECT * FROM employee');
    if($stmt->execute()){
        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)){
            echo '<tr>';
            echo '<td>'.$result['uid'].'</td>';
            echo '<td>'.$result['hired'].'</td>';
            echo '<td>'.$result['last'].'</td>';
            echo '<td>'.$result['first'].'</td>';
            echo '<td>'.$result['middle'].'</td>';
            echo '<td>'.$result['suffix'].'</td>';
            echo '<td>'.$result['birthday'].'</td>';
            echo '<td>'.$result['age'].'</td>';
            echo '<td>'.$result['gender'].'</td>';
            echo '<td>'.$result['email'].'</td>';
            echo '<td>'.$result['phone'].'</td>';
            echo '<td>'.$result['status'].'</td>';
            echo '<td>'.$result['sss'].'</td>';
            echo '<td>'.$result['philHealth'].'</td>';
            echo '<td>'.$result['job'].'</td>';
            echo '<td>'.$result['rate'].'</td>';
            echo '<td>'.$result['address'].'</td>';
            echo '<td>'.$result['eName'].'</td>';
            echo '<td>'.$result['ePhone'].'</td>';
            echo '<td>'.$result['eAdd'].'</td>';
            echo '</tr>';
        }
    }
}
function search($search, $filter){
    require (__DIR__ . '/database.php');
    $stmt = $conn->prepare('SELECT * FROM employee WHERE '.$filter.' LIKE :search');
    if($stmt->execute(['search' => '%'.$search.'%'])){
        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)){
            echo '<tr>';
            echo '<td>'.$result['uid'].'</td>';
            echo '<td>'.$result['hired'].'</td>';
            echo '<td>'.$result['last'].'</td>';
            echo '<td>'.$result['first'].'</td>';
            echo '<td>'.$result['middle'].'</td>';
            echo '<td>'.$result['suffix'].'</td>';
            echo '<td>'.$result['birthday'].'</td>';
            echo '<td>'.$result['age'].'</td>';
            echo '<td>'.$result['gender'].'</td>';
            echo '<td>'.$result['email'].'</td>';
            echo '<td>'.$result['phone'].'</td>';
            echo '<td>'.$result['status'].'</td>';
            echo '<td>'.$result['sss'].'</td>';
            echo '<td>'.$result['philHealth'].'</td>';
            echo '<td>'.$result['job'].'</td>';
            echo '<td>'.$result['rate'].'</td>';
            echo '<td>'.$result['address'].'</td>';
            echo '<td>'.$result['eName'].'</td>';
            echo '<td>'.$result['ePhone'].'</td>';
            echo '<td>'.$result['eAdd'].'</td>';
            echo '</tr>';
        }
    }
}
?>