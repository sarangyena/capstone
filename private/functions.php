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
            echo '<div class="alert alert-info my-auto" role="alert">
                            '.$result['last'].', '.$result['first'].' <strong>('.$result['uid'].')</strong> '.'
                    </div>';
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
function adminId(){
    require (__DIR__ . '/database.php');
    $year = date('y');
    $stmt = $conn->prepare('SELECT * FROM admin');
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $rows = $stmt->rowCount();
    $id = str_pad($rows, 5, '0', STR_PAD_LEFT);

    $uniqueID = "ADMIN-$year-$id";
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
function tableEmp(){
    require (__DIR__ . '/database.php');
    $stmt = $conn->prepare('SELECT * FROM employee');
    if($stmt->execute()){
        $result = $stmt->rowCount();
        if($result == 0){
            echo '<div class="alert alert-info mt-3" role="alert">
            No data to be displayed.
        </div>';
        }else{
            if(isset($_SESSION['empBar']) && (isset($_SESSION['empFilter']))){
                $search = $_SESSION['empBar'];
                $filter = $_SESSION['empFilter'];
                unset($_SESSION['empBar']);
                unset($_SESSION['empFilter']);
                searchEmp($search, $filter);
            }else{
                echo '<div class="table-responsive text-center" style="width: 1039px;">
                <table class="table table-sm table-striped table-success table-hover table-bordered mt-3">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">HIRED</th>
                            <th scope="col">LAST</th>
                            <th scope="col">FIRST</th>
                            <th scope="col">MIDDLE</th>
                            <th scope="col">SUFFIX</th>
                            <th scope="col">BIRTHDAY</th>
                            <th scope="col">AGE</th>
                            <th scope="col">GENDER</th>
                            <th scope="col">EMAIL</th>
                            <th scope="col">PHONE</th>
                            <th scope="col">STATUS</th>
                            <th scope="col">SSS</th>
                            <th scope="col">PHILHEALTH</th>
                            <th scope="col">JOB</th>
                            <th scope="col">RATE</th>
                            <th scope="col">ADDRESS</th>
                            <th scope="col">ENAME</th>
                            <th scope="col">EPHONE</th>
                            <th scope="col">EADD</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider text-center">
                        <tr>';
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
                                echo '<tr>';
                            }
                        }
                    echo '</tr>
                </tbody>
            </table>
        </div>';
        }
    }
}
function searchEmp($search, $filter){
    require (__DIR__ . '/database.php');
    $stmt = $conn->prepare('SELECT * FROM employee WHERE '.$filter.' LIKE :search');
    if($stmt->execute(['search' => '%'.$search.'%'])){
        $result = $stmt->rowCount();
        if($result == 0){
            echo '<div class="alert alert-info mt-3" role="alert">
            No data to be displayed.
        </div>';
        }else{
            echo '<div class="table-responsive text-center" style="width: 1039px;">
                <table class="table table-sm table-striped table-success table-hover table-bordered mt-3">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">HIRED</th>
                            <th scope="col">LAST</th>
                            <th scope="col">FIRST</th>
                            <th scope="col">MIDDLE</th>
                            <th scope="col">SUFFIX</th>
                            <th scope="col">BIRTHDAY</th>
                            <th scope="col">AGE</th>
                            <th scope="col">GENDER</th>
                            <th scope="col">EMAIL</th>
                            <th scope="col">PHONE</th>
                            <th scope="col">STATUS</th>
                            <th scope="col">SSS</th>
                            <th scope="col">PHILHEALTH</th>
                            <th scope="col">JOB</th>
                            <th scope="col">RATE</th>
                            <th scope="col">ADDRESS</th>
                            <th scope="col">ENAME</th>
                            <th scope="col">EPHONE</th>
                            <th scope="col">EADD</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider text-center">
                        <tr>';
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
            echo '</tr>
                </tbody>
            </table>
        </div>';
        }
    }
}
function dispEmp(){
    require (__DIR__ . '/database.php');
    $stmt = $conn->prepare('SELECT uid, last, first FROM employee');
    if($stmt->execute()){
        while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
            echo '<option value="'.$result['uid'].'">'.$result['first'].' '.$result['last'].' ('.$result['uid'].')</option>';
        }
    }
}
function searchPayroll($search, $filter){
    require (__DIR__ . '/database.php');
    $stmt = $conn->prepare('SELECT * FROM payroll WHERE '.$filter.' LIKE :search');
    if($stmt->execute(['search' => '%'.$search.'%'])){
        $result = $stmt->rowCount();
        if($result == 0){
            echo '<div class="alert alert-info mt-3" role="alert">
            No data to be displayed.
        </div>';
        }else{
            echo '<div class="table-responsive text-center" style="width: 1063px;">
                <table class="table table-sm table-striped table-success table-hover table-bordered mt-3">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">NAME</th>
                            <th scope="col">DATE</th>
                            <th scope="col">JOB</th>
                            <th scope="col">NO. OF DAYS</th>
                            <th scope="col">LATE</th>
                            <th scope="col">RATE</th>
                            <th scope="col">SALARY</th>
                            <th scope="col">RATE PER HOUR</th>
                            <th scope="col">NO. OF HOURS</th>
                            <th scope="col">OVERTIME PAY</th>
                            <th scope="col">HOLIDAY</th>
                            <th scope="col">ALLOWANCES</th>
                            <th scope="col">PHILHEALTH</th>
                            <th scope="col">SSS</th>
                            <th scope="col">ADVANCE</th>
                            <th scope="col">AMOUNT</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider text-center">
                        <tr>';
            while ($result = $stmt->fetch(PDO::FETCH_ASSOC)){
                echo '<tr>';
                echo '<td>'.$result['uid'].'</td>';
                echo '<td>'.$result['name'].'</td>';
                echo '<td>'.$result['date'].'</td>';
                echo '<td>'.$result['job'].'</td>';
                echo '<td>'.$result['days'].'</td>';
                echo '<td>'.$result['late'].'</td>';
                echo '<td>'.$result['rate'].'</td>';
                echo '<td>'.$result['salary'].'</td>';
                echo '<td>'.$result['rph'].'</td>';
                echo '<td>'.$result['hours'].'</td>';
                echo '<td>'.$result['otPay'].'</td>';
                echo '<td>'.$result['holiday'].'</td>';
                echo '<td>'.$result['allowances'].'</td>';
                echo '<td>'.$result['philHealth'].'</td>';
                echo '<td>'.$result['sss'].'</td>';
                echo '<td>'.$result['advance'].'</td>';
                echo '<td>'.$result['amount'].'</td>';
                echo '</tr>';
            }
            echo '</tr>
                </tbody>
            </table>
        </div>';
        }
    }
}
function tablePayroll(){
    require (__DIR__ . '/database.php');
    $stmt = $conn->prepare('SELECT * FROM payroll');
    if($stmt->execute()){
        $result = $stmt->rowCount();
        if($result == 0){
            echo '<div class="alert alert-info mt-3" role="alert">
            No data to be displayed.
        </div>';
        }else{
            if(isset($_SESSION['payrollBar']) && (isset($_SESSION['payrollFilter']))){
                $search = $_SESSION['payrollBar'];
                $filter = $_SESSION['payrollFilter'];
                unset($_SESSION['payrollBar']);
                unset($_SESSION['filter']);
                searchPayroll($search, $filter);
            }else{
                echo '<div class="table-responsive text-center" style="width: 1063px;">
                <table class="table table-sm table-striped table-success table-hover table-bordered mt-3">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">NAME</th>
                            <th scope="col">DATE</th>
                            <th scope="col">JOB</th>
                            <th scope="col">NO. OF DAYS</th>
                            <th scope="col">LATE</th>
                            <th scope="col">RATE</th>
                            <th scope="col">SALARY</th>
                            <th scope="col">RATE PER HOUR</th>
                            <th scope="col">NO. OF HOURS</th>
                            <th scope="col">OVERTIME PAY</th>
                            <th scope="col">HOLIDAY</th>
                            <th scope="col">ALLOWANCES</th>
                            <th scope="col">PHILHEALTH</th>
                            <th scope="col">SSS</th>
                            <th scope="col">ADVANCE</th>
                            <th scope="col">AMOUNT</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider text-center">
                        <tr>';
                while ($result = $stmt->fetch(PDO::FETCH_ASSOC)){
                    echo '<tr>';
                    echo '<td>'.$result['uid'].'</td>';
                    echo '<td>'.$result['name'].'</td>';
                    echo '<td>'.$result['date'].'</td>';
                    echo '<td>'.$result['job'].'</td>';
                    echo '<td>'.$result['days'].'</td>';
                    echo '<td>'.$result['late'].'</td>';
                    echo '<td>'.$result['rate'].'</td>';
                    echo '<td>'.$result['salary'].'</td>';
                    echo '<td>'.$result['rph'].'</td>';
                    echo '<td>'.$result['hours'].'</td>';
                    echo '<td>'.$result['otPay'].'</td>';
                    echo '<td>'.$result['holiday'].'</td>';
                    echo '<td>'.$result['allowances'].'</td>';
                    echo '<td>'.$result['philHealth'].'</td>';
                    echo '<td>'.$result['sss'].'</td>';
                    echo '<td>'.$result['advance'].'</td>';
                    echo '<td>'.$result['amount'].'</td>';
                    echo '</tr>';
                }
                echo '</tr>
                </tbody>
            </table>
        </div>';
            }
        }
    }
}
function totalSalary(){
    require (__DIR__ . '/database.php');
    $username = $_SESSION['user_id'];
    $stmt=$conn->prepare('SELECT amount FROM payroll WHERE uid = :id');
    $stmt->bindParam(':id', $username, PDO::PARAM_STR);
    if($stmt->execute()){
        $total = 0;
        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)){
            $total = $total + $result['amount'];
        }
        echo '<div class="alert alert-info my-auto" role="alert">
                    <h1 class="text-black text-center my-auto">₱ '.$total.'</h1>
                </div>';
    }else{
        echo '<div class="alert alert-danger my-auto" role="alert">
                Error.
                </div>';
    }
}
function allowance(){
    require (__DIR__ . '/database.php');
    $username = $_SESSION['user_id'];
    $stmt=$conn->prepare('SELECT allowances FROM payroll WHERE uid = :id');
    $stmt->bindParam(':id', $username, PDO::PARAM_STR);
    if($stmt->execute()){
        $total = 0;
        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)){
            $total = $total + $result['allowances'];
        }
        echo '<div class="alert alert-info my-auto" role="alert">
                    <h1 class="text-black text-center my-auto">₱ '.$total.'</h1>
                </div>';
    }else{
        echo '<div class="alert alert-danger my-auto" role="alert">
                Error.
                </div>';
    }
}
function reportEmp(){
    require (__DIR__ . '/database.php');
    $username = $_SESSION['user_id'];
    $stmt = $conn->prepare('SELECT * FROM payroll WHERE uid = :id');
    $stmt->bindParam(':id', $username, PDO::PARAM_STR);
    if($stmt->execute()){
        $result = $stmt->rowCount();
        if($result == 0){
            echo '<div class="alert alert-info mt-3" role="alert">
            No data to be displayed.
        </div>';
        }else{
            echo '<div class="table-responsive text-center" style="width: 1063px;">
                <table class="table table-sm table-striped table-success table-hover table-bordered mt-3">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">NAME</th>
                            <th scope="col">DATE</th>
                            <th scope="col">JOB</th>
                            <th scope="col">NO. OF DAYS</th>
                            <th scope="col">LATE</th>
                            <th scope="col">RATE</th>
                            <th scope="col">SALARY</th>
                            <th scope="col">RATE PER HOUR</th>
                            <th scope="col">NO. OF HOURS</th>
                            <th scope="col">OVERTIME PAY</th>
                            <th scope="col">HOLIDAY</th>
                            <th scope="col">ALLOWANCES</th>
                            <th scope="col">PHILHEALTH</th>
                            <th scope="col">SSS</th>
                            <th scope="col">ADVANCE</th>
                            <th scope="col">AMOUNT</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider text-center">
                        <tr>';
                while ($result = $stmt->fetch(PDO::FETCH_ASSOC)){
                    echo '<tr>';
                    echo '<td>'.$result['uid'].'</td>';
                    echo '<td>'.$result['name'].'</td>';
                    echo '<td>'.$result['date'].'</td>';
                    echo '<td>'.$result['job'].'</td>';
                    echo '<td>'.$result['days'].'</td>';
                    echo '<td>'.$result['late'].'</td>';
                    echo '<td>'.$result['rate'].'</td>';
                    echo '<td>'.$result['salary'].'</td>';
                    echo '<td>'.$result['rph'].'</td>';
                    echo '<td>'.$result['hours'].'</td>';
                    echo '<td>'.$result['otPay'].'</td>';
                    echo '<td>'.$result['holiday'].'</td>';
                    echo '<td>'.$result['allowances'].'</td>';
                    echo '<td>'.$result['philHealth'].'</td>';
                    echo '<td>'.$result['sss'].'</td>';
                    echo '<td>'.$result['advance'].'</td>';
                    echo '<td>'.$result['amount'].'</td>';
                    echo '</tr>';
                }
                echo '</tr>
                </tbody>
            </table>
        </div>';
        }
    }
}

function recordTable(){
    require (__DIR__ . '/database.php');
    $stmt = $conn->prepare('SELECT * FROM record');
    if($stmt->execute()){
        $result = $stmt->rowCount();
        if($result == 0){
            echo '<div class="alert alert-info mt-3" role="alert">
            No data to be displayed.
        </div>';
        }else{
            echo '<div class="table-responsive text-center">
            <table class="table table-sm table-striped table-success table-hover table-bordered mt-3">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">NAME</th>
                        <th scope="col">DATE-IN</th>
                        <th scope="col">TIME-IN</th>
                        <th scope="col">DATE-OUT</th>
                        <th scope="col">TIME-OUT</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider text-center">
                    <tr>';
            while ($result = $stmt->fetch(PDO::FETCH_ASSOC)){
                echo '<tr>';
                echo '<td>'.$result['uid'].'</td>';
                echo '<td>'.$result['name'].'</td>';
                echo '<td>'.$result['dateIn'].'</td>';
                echo '<td>'.$result['timeIn'].'</td>';
                echo '<td>'.$result['dateOut'].'</td>';
                echo '<td>'.$result['timeOut'].'</td>';
                echo '</tr>';
            }
            echo '</tr>
            </tbody>
        </table>
    </div>';
        }
    }
}
function recordEmp(){
    require (__DIR__ . '/database.php');
    $username = $_SESSION['user_id'];
    $stmt = $conn->prepare('SELECT * FROM record WHERE uid = :id');
    $stmt->bindParam(':id', $username, PDO::PARAM_STR);
    if($stmt->execute()){
        $result = $stmt->rowCount();
        if($result == 0){
            echo '<div class="alert alert-info mt-3" role="alert">
            No data to be displayed.
        </div>';
        }else{
            echo '<div class="table-responsive text-center">
            <table class="table table-sm table-striped table-success table-hover table-bordered mt-3">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">NAME</th>
                        <th scope="col">DATE-IN</th>
                        <th scope="col">TIME-IN</th>
                        <th scope="col">DATE-OUT</th>
                        <th scope="col">TIME-OUT</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider text-center">
                    <tr>';
            while ($result = $stmt->fetch(PDO::FETCH_ASSOC)){
                echo '<tr>';
                echo '<td>'.$result['uid'].'</td>';
                echo '<td>'.$result['name'].'</td>';
                echo '<td>'.$result['dateIn'].'</td>';
                echo '<td>'.$result['timeIn'].'</td>';
                echo '<td>'.$result['dateOut'].'</td>';
                echo '<td>'.$result['timeOut'].'</td>';
                echo '</tr>';
            }
            echo '</tr>
            </tbody>
        </table>
    </div>';
        }
    }
}
function timedIn(){
    require (__DIR__ . '/database.php');
    if(isset($_SESSION['record'])){
        $count = count($_SESSION['record']);
        echo '<div class="alert alert-info my-auto" role="alert">
        <h1 class="text-black text-center my-auto">'.$count.'</h1>
    </div>';    }
}
?>