<?php
function checkAuthentication(){
    if (!isset($_SESSION['user_id'])) {
        $_SESSION['auth'] = false;
        echo header('Location: ../../index.php');
    }
}
function checkLogIn(){
    if(isset($_SESSION['user_id'])){
        echo header('Location: public/admin/homepage.php');
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
    $stmt = $conn->prepare('SELECT * FROM employee');
    $stmt->execute();
    $rows = $stmt->rowCount();
    $id = str_pad($rows, 3, '0', STR_PAD_LEFT);

    $uniqueID = "E-$id";
    return $uniqueID;
}
function onCallId(){
    require (__DIR__ . '/database.php');
    $stmt = $conn->prepare('SELECT * FROM oncall');
    $stmt->execute();
    $rows = $stmt->rowCount();
    $id = str_pad($rows, 3, '0', STR_PAD_LEFT);

    $uniqueID = "O-$id";
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
    $stmt = $conn->prepare('SELECT * FROM admin');
    $stmt->execute();
    $admin = $stmt->rowCount();
    $stmt = $conn->prepare('SELECT * FROM employee');
    $stmt->execute();
    $employee = $stmt->rowCount();
    $_SESSION['total'] = $admin + $employee;
    echo '<div class="alert alert-info my-auto" role="alert">
                    <h1 class="text-black text-center my-auto">'.$_SESSION['total'].'</h1>
                </div>';
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
                echo '<div class="table-responsive text-center print-container" style="width: 1039px;">
                <table class="table table-sm table-striped table-success table-hover table-bordered mt-3">
                    <thead>
                        <tr>
                            <th scope="col">QR</th>
                            <th scope="col">ID</th>
                            <th scope="col">LAST</th>
                            <th scope="col">FIRST</th>
                            <th scope="col">MIDDLE</th>
                            <th scope="col">STATUS</th>
                            <th scope="col">EMAIL</th>
                            <th scope="col">PHONE</th>
                            <th scope="col">JOB</th>
                            <th scope="col">SSS</th>
                            <th scope="col">PHILHEALTH</th>
                            <th scope="col">PAG-IBIG</th>
                            <th scope="col">RATE</th>
                            <th scope="col">ADDRESS</th>
                            <th scope="col">ENAME</th>
                            <th scope="col">EPHONE</th>
                            <th scope="col">EADDRESS</th>
                            <th scope="col">HIRED</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider text-center">
                        <tr>';
                            while ($result = $stmt->fetch(PDO::FETCH_ASSOC)){
                                echo '<tr>';
                                echo '<td><button class="btn" onclick="qr(`'.$result['id'].'`)"><i class="fa-solid fa-qrcode""></i></button></td>';
                                echo '<td>'.$result['id'].'</td>';
                                echo '<td>'.$result['last'].'</td>';
                                echo '<td>'.$result['first'].'</td>';
                                echo '<td>'.$result['middle'].'</td>';
                                echo '<td>'.$result['status'].'</td>';
                                echo '<td>'.$result['email'].'</td>';
                                echo '<td>'.$result['phone'].'</td>';
                                echo '<td>'.$result['job'].'</td>';
                                echo '<td>'.$result['sss'].'</td>';
                                echo '<td>'.$result['philhealth'].'</td>';
                                echo '<td>'.$result['pagibig'].'</td>';
                                echo '<td>'.$result['rate'].'</td>';
                                echo '<td>'.$result['address'].'</td>';
                                echo '<td>'.$result['eName'].'</td>';
                                echo '<td>'.$result['ePhone'].'</td>';
                                echo '<td>'.$result['eAddress'].'</td>';
                                echo '<td>'.$result['hired'].'</td>';
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
function tableOnCall(){
    require (__DIR__ . '/database.php');
    $stmt = $conn->prepare('SELECT * FROM oncall');
    if($stmt->execute()){
        $result = $stmt->rowCount();
        if($result == 0){
            echo '<div class="alert alert-info mt-3" role="alert">
            No data to be displayed.
        </div>';
        }else{
            if(isset($_SESSION['onCallBar']) && (isset($_SESSION['onCallFilter']))){
                $search = $_SESSION['onCallBar'];
                $filter = $_SESSION['onCallFilter'];
                unset($_SESSION['onCallBar']);
                unset($_SESSION['onCallFilter']);
                searchOnCall($search, $filter);
            }else{
                echo '<div class="table-responsive text-center print-container" style="width: 1039px;">
                <table class="table table-sm table-striped table-success table-hover table-bordered mt-3">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">LAST</th>
                            <th scope="col">FIRST</th>
                            <th scope="col">MIDDLE</th>
                            <th scope="col">STATUS</th>
                            <th scope="col">EMAIL</th>
                            <th scope="col">PHONE</th>
                            <th scope="col">JOB</th>
                            <th scope="col">SSS</th>
                            <th scope="col">PHILHEALTH</th>
                            <th scope="col">PAG-IBIG</th>
                            <th scope="col">RATE</th>
                            <th scope="col">ADDRESS</th>
                            <th scope="col">ENAME</th>
                            <th scope="col">EPHONE</th>
                            <th scope="col">EADDRESS</th>
                            <th scope="col">HIRED</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider text-center">
                        <tr>';
                            while ($result = $stmt->fetch(PDO::FETCH_ASSOC)){
                                echo '<tr>';
                                echo '<td>'.$result['id'].'</td>';
                                echo '<td>'.$result['last'].'</td>';
                                echo '<td>'.$result['first'].'</td>';
                                echo '<td>'.$result['middle'].'</td>';
                                echo '<td>'.$result['status'].'</td>';
                                echo '<td>'.$result['email'].'</td>';
                                echo '<td>'.$result['phone'].'</td>';
                                echo '<td>'.$result['job'].'</td>';
                                echo '<td>'.$result['sss'].'</td>';
                                echo '<td>'.$result['philhealth'].'</td>';
                                echo '<td>'.$result['pagibig'].'</td>';
                                echo '<td>'.$result['rate'].'</td>';
                                echo '<td>'.$result['address'].'</td>';
                                echo '<td>'.$result['eName'].'</td>';
                                echo '<td>'.$result['ePhone'].'</td>';
                                echo '<td>'.$result['eAddress'].'</td>';
                                echo '<td>'.$result['hired'].'</td>';
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
                            <th scope="col">LAST</th>
                            <th scope="col">FIRST</th>
                            <th scope="col">MIDDLE</th>
                            <th scope="col">STATUS</th>
                            <th scope="col">EMAIL</th>
                            <th scope="col">PHONE</th>
                            <th scope="col">JOB</th>
                            <th scope="col">SSS</th>
                            <th scope="col">PHILHEALTH</th>
                            <th scope="col">PAG-IBIG</th>
                            <th scope="col">RATE</th>
                            <th scope="col">ADDRESS</th>
                            <th scope="col">ENAME</th>
                            <th scope="col">EPHONE</th>
                            <th scope="col">EADDRESS</th>
                            <th scope="col">HIRED</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider text-center">
                        <tr>';
                        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)){
                            echo '<tr>';
                            echo '<td>'.$result['id'].'</td>';
                            echo '<td>'.$result['hired'].'</td>';
                            echo '<td>'.$result['last'].'</td>';
                            echo '<td>'.$result['first'].'</td>';
                            echo '<td>'.$result['middle'].'</td>';
                            echo '<td>'.$result['status'].'</td>';
                            echo '<td>'.$result['email'].'</td>';
                            echo '<td>'.$result['phone'].'</td>';
                            echo '<td>'.$result['job'].'</td>';
                            echo '<td>'.$result['sss'].'</td>';
                            echo '<td>'.$result['philhealth'].'</td>';
                            echo '<td>'.$result['pagibig'].'</td>';
                            echo '<td>'.$result['rate'].'</td>';
                            echo '<td>'.$result['address'].'</td>';
                            echo '<td>'.$result['eName'].'</td>';
                            echo '<td>'.$result['ePhone'].'</td>';
                            echo '<td>'.$result['eAddress'].'</td>';
                            echo '<td>'.$result['hired'].'</td>';
                            echo '<tr>';
                        }
                echo '</tr>
                </tbody>
            </table>
        </div>';
        }
    }
}
function searchOnCall($search, $filter){
    require (__DIR__ . '/database.php');
    $stmt = $conn->prepare('SELECT * FROM oncall WHERE '.$filter.' LIKE :search');
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
                            <th scope="col">LAST</th>
                            <th scope="col">FIRST</th>
                            <th scope="col">MIDDLE</th>
                            <th scope="col">STATUS</th>
                            <th scope="col">EMAIL</th>
                            <th scope="col">PHONE</th>
                            <th scope="col">JOB</th>
                            <th scope="col">SSS</th>
                            <th scope="col">PHILHEALTH</th>
                            <th scope="col">PAG-IBIG</th>
                            <th scope="col">RATE</th>
                            <th scope="col">ADDRESS</th>
                            <th scope="col">ENAME</th>
                            <th scope="col">EPHONE</th>
                            <th scope="col">EADDRESS</th>
                            <th scope="col">HIRED</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider text-center">
                        <tr>';
                        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)){
                            echo '<tr>';
                            echo '<td>'.$result['id'].'</td>';
                            echo '<td>'.$result['hired'].'</td>';
                            echo '<td>'.$result['last'].'</td>';
                            echo '<td>'.$result['first'].'</td>';
                            echo '<td>'.$result['middle'].'</td>';
                            echo '<td>'.$result['status'].'</td>';
                            echo '<td>'.$result['email'].'</td>';
                            echo '<td>'.$result['phone'].'</td>';
                            echo '<td>'.$result['job'].'</td>';
                            echo '<td>'.$result['sss'].'</td>';
                            echo '<td>'.$result['philhealth'].'</td>';
                            echo '<td>'.$result['pagibig'].'</td>';
                            echo '<td>'.$result['rate'].'</td>';
                            echo '<td>'.$result['address'].'</td>';
                            echo '<td>'.$result['eName'].'</td>';
                            echo '<td>'.$result['ePhone'].'</td>';
                            echo '<td>'.$result['eAddress'].'</td>';
                            echo '<td>'.$result['hired'].'</td>';
                            echo '<tr>';
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
                <table class="table table-sm table-striped table-success table-hover table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">NAME</th>
                            <th scope="col">JOB</th>
                            <th scope="col">RATE</th>
                            <th scope="col">NO. OF DAYS</th>
                            <th scope="col">LATE</th>
                            <th scope="col">SALARY</th>
                            <th scope="col">RATE PER HOUR</th>
                            <th scope="col">NO. OF HOURS</th>
                            <th scope="col">OVERTIME PAY</th>
                            <th scope="col">HOLIDAY</th>
                            <th scope="col">PHILHEALTH</th>
                            <th scope="col">SSS</th>
                            <th scope="col">ADVANCE</th>
                            <th scope="col">AMOUNT</th>
                            <th scope="col">EDIT</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider text-center">
                        <tr>';
                while ($result = $stmt->fetch(PDO::FETCH_ASSOC)){
                    echo '<tr>';
                    echo '<td>'.$result['id'].'</td>';
                    echo '<td>'.$result['name'].'</td>';
                    echo '<td>'.$result['job'].'</td>';
                    echo '<td class="text-decoration-underline">'.$result['rate'].'</td>';
                    echo '<td>'.$result['days'].'</td>';
                    echo '<td>'.$result['late'].'</td>';
                    echo '<td>'.$result['salary'].'</td>';
                    echo '<td>'.$result['rph'].'</td>';
                    echo '<td>'.$result['hrs'].'</td>';
                    echo '<td>'.$result['ot'].'</td>';
                    echo '<td class="text-decoration-underline">'.$result['holiday'].'</td>';
                    echo '<td class="text-decoration-underline">'.$result['philhealth'].'</td>';
                    echo '<td class="text-decoration-underline">'.$result['sss'].'</td>';
                    echo '<td class="text-decoration-underline">'.$result['advance'].'</td>';
                    echo '<td>'.$result['total'].'</td>';
                    echo '<td><button class="btn fa-solid fa-pen" data-bs-toggle="modal" data-bs-target="#payroll1" onclick="getRowId(`'.$result['id'].'`)"></button></td>';
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

function logTable(){
    require (__DIR__ . '/database.php');
    $stmt = $conn->prepare('SELECT * FROM log ORDER BY updateTime DESC');
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
                            <th scope="col">JOB</th>
                            <th scope="col">TIMED-IN (DATE)</th>
                            <th scope="col">TIMED-IN (TIME)</th>
                            <th scope="col">TIMED-OUT (DATE)</th>
                            <th scope="col">TIMED-OUT (TIME)</th>
                            <th scope="col">LOCATION</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider text-center">
                        <tr>';
                while ($result = $stmt->fetch(PDO::FETCH_ASSOC)){
                    echo '<tr>';
                    echo '<td>'.$result['id'].'</td>';
                    echo '<td>'.$result['name'].'</td>';
                    echo '<td>'.$result['job'].'</td>';
                    echo '<td>'.$result['dateIn'].'</td>';
                    echo '<td>'.$result['timeIn'].'</td>';
                    echo '<td>'.$result['dateOut'].'</td>';
                    echo '<td>'.$result['timeOut'].'</td>';
                    echo '<td>'.$result['location'].'</td>';
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
        $_SESSION['countTimed'] = $count;
        if($count === null){
            echo '<div class="alert alert-info my-auto" role="alert">
            <h1 class="text-black text-center my-auto">0</h1>
        </div>';    
        }else{
            echo '<div class="alert alert-info my-auto" role="alert">
            <h1 class="text-black text-center my-auto">'.$count.'</h1>
        </div>';  
        }
    }else{
        echo '<div class="alert alert-info my-auto" role="alert">
            <h1 class="text-black text-center my-auto">0</h1>
        </div>'; 
    }
}
function timedOut(){
    require (__DIR__ . '/database.php');
    $total = $_SESSION['total'];
    if(!isset($_SESSION['countTimed']) || $_SESSION['countTimed'] === 0){
        echo '<div class="alert alert-info my-auto" role="alert">
        <h1 class="text-black text-center my-auto">'.$total.'</h1>
    </div>';  
    }else{
        $out = $total-$_SESSION['countTimed'];
        echo '<div class="alert alert-info my-auto" role="alert">
            <h1 class="text-black text-center my-auto">'.$out.'</h1>
        </div>';  
    }
}
function checkAdmin(){
    require (__DIR__ . '/database.php');
    $stmt = $conn->prepare('SELECT * FROM admin');
    $stmt->execute();
    $result = $stmt->rowCount();
    if($result === 0){
        echo header('Location: 0_admin.php');
        exit();
    }
}
function deductions(){
    require (__DIR__ . '/database.php');
    $username = $_SESSION['user_id'];
    $stmt=$conn->prepare('SELECT philHealth, sss, advance FROM payroll WHERE uid = :id');
    $stmt->bindParam(':id', $username, PDO::PARAM_STR);
    if($stmt->execute()){
        $total = 0;
        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)){
            $total = $total + $result['philHealth'] + $result['sss'] + $result['advance'];
        }
        echo '<div class="alert alert-info my-auto" role="alert">
                    <h1 class="text-black text-center my-auto">₱ -'.$total.'</h1>
                </div>';
    }else{
        echo '<div class="alert alert-danger my-auto" role="alert">
                Error.
                </div>';
    }
}
function dashboard(){
    require (__DIR__ . '/database.php');
    $stmt = $conn->prepare('SELECT * FROM dashboard');
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
                echo '<div class="table-responsive text-center">
                <table class="table table-sm table-striped table-success table-hover table-bordered mt-3">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">NAME</th>
                            <th scope="col">JOB</th>
                            <th scope="col">LAST TIMED-IN (DATE)</th>
                            <th scope="col">LAST TIMED-IN (TIME)</th>
                            <th scope="col">LAST TIMED-OUT (DATE)</th>
                            <th scope="col">LAST TIMED-OUT (TIME)</th>
                            <th scope="col">STATUS</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider text-center">
                        <tr>';
                while ($result = $stmt->fetch(PDO::FETCH_ASSOC)){
                    echo '<tr>';
                    echo '<td>'.$result['id'].'</td>';
                    echo '<td>'.$result['name'].'</td>';
                    echo '<td>'.$result['job'].'</td>';
                    echo '<td>'.$result['dateIn'].'</td>';
                    echo '<td>'.$result['timeIn'].'</td>';
                    echo '<td>'.$result['dateOut'].'</td>';
                    echo '<td>'.$result['timeOut'].'</td>';
                    echo '<td>'.$result['status'].'</td>';
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

/*function status(){
    require (__DIR__ . '/database.php');
    $inactive = strtotime('-30 days');
    $stmt=$conn->prepare('SELECT * FROM dashboard');
    if($stmt->execute()){
        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)){
            $date = strtotime($result['dateOut']);
            if($date > $inactive && $date != '0000-00-00'){
                $id = $result['id'];
                $stmt = $conn->prepare('UPDATE dashboard SET status = "INACTIVE" WHERE id = :id');
                $stmt->bindParam(':id', $id, PDO::PARAM_STR);
                $stmt->execute();
            }
        }
    }
}*/
function compute(){
    require (__DIR__ . '/database.php');
    $stmt = $conn->prepare('SELECT id, rate, holiday, philhealth, sss, advance FROM payroll');
    if($stmt->execute()){
        while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
            $id = $result['id'];
            $rate = $result['rate'];
            $holiday = $result['holiday'];
            $philhealth = $result['philhealth'];
            $sss = $result['sss'];
            $advance = $result['advance'];
        }
    }
}
?>