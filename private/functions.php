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
    if($role == 'E'){
        $stmt=$conn->prepare('SELECT id, last, first, middle FROM employee WHERE id = ?');
        $stmt->bindParam(1, $username, PDO::PARAM_STR);
        if($stmt->execute()){
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $initial = substr($result['middle'], 0, 1);
            if ($initial){
                $name = $result['last'].', '.$result['first'].' '.$initial.'.';
            }else{
                $name = $result['last'].', '.$result['first'];
            }
            echo '<div class="alert alert-info my-auto" role="alert">
                            <strong>WELCOME </strong>'.$name.'('.$username.')</strong> '.'
                    </div>';
        }
    }else if($role == 'O'){
        $stmt=$conn->prepare('SELECT id, last, first, middle FROM onCall WHERE id = ?');
        $stmt->bindParam(1, $username, PDO::PARAM_STR);
        if($stmt->execute()){
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $initial = substr($result['middle'], 0, 1);
            if ($initial){
                $name = $result['last'].', '.$result['first'].' '.$initial.'.';
            }else{
                $name = $result['last'].', '.$result['first'];
            }
            echo '<div class="alert alert-info my-auto" role="alert">
                            <strong>WELCOME </strong>'.$name.'('.$username.')</strong> '.'
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
                                echo '<td><button class="btn" onclick="qrId(`'.$result['id'].'`)"><i class="fa-solid fa-qrcode""></i></button></td>';
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
                                echo '<td><button class="btn" onclick="qrId(`'.$result['id'].'`)"><i class="fa-solid fa-qrcode""></i></button></td>';
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
                echo '</tr>
                </tbody>
            </table>
        </div>';
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
            echo '<div class="table-responsive text-center mt-2" style="width: 1063px;">
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
                        </tr>
                    </thead>
                    <tbody class="table-group-divider text-center">
                        <tr>';
            while ($result = $stmt->fetch(PDO::FETCH_ASSOC)){
                echo '<tr>';
                echo '<td>'.$result['id'].'</td>';
                echo '<td>'.$result['name'].'</td>';
                echo '<td>'.$result['job'].'</td>';
                echo '<td>'.$result['rate'].'</td>';
                echo '<td>'.$result['days'].'</td>';
                echo '<td>'.$result['late'].'</td>';
                echo '<td>'.$result['salary'].'</td>';
                echo '<td>'.$result['rph'].'</td>';
                echo '<td>'.$result['hrs'].'</td>';
                echo '<td>'.$result['ot'].'</td>';
                echo '<td>'.$result['holiday'].'</td>';
                echo '<td>'.$result['philhealth'].'</td>';
                echo '<td>'.$result['sss'].'</td>';
                echo '<td>'.$result['advance'].'</td>';
                echo '<td>'.$result['total'].'</td>';
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
                echo '<div class="table-responsive text-center mt-2" style="width: 1063px;">
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
                            <th scope="col">PRINT</th>
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
                    echo '<td><button class="btn fa-solid fa-print" onclick="printId(`'.$result['id'].'`)"></button></td>';
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
function dashboardEmp(){
    require (__DIR__ . '/database.php');
    $stmt = $conn->prepare('SELECT * FROM dashboard WHERE type = "EMP"');
    if($stmt->execute()){
        $result = $stmt->rowCount();
        if($result == 0){
            echo '<div class="alert alert-info mt-3 " role="alert">
            No data to be displayed.
        </div>';
        }else{
            if(isset($_SESSION['homepageBar']) && (isset($_SESSION['homepageFilter']))){
                $search = $_SESSION['homepageBar'];
                $filter = $_SESSION['homepageFilter'];
                searchDashboardEmp($search, $filter);
            }else{
                echo '<div class="table-responsive text-center">
                <table class="table table-sm table-striped table-success table-hover table-bordered">
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
function dashboardOnCall(){
    require (__DIR__ . '/database.php');
    $stmt = $conn->prepare('SELECT * FROM dashboard WHERE type = "ONCALL"');
    if($stmt->execute()){
        $result = $stmt->rowCount();
        if($result == 0){
            echo '<div class="alert alert-info mt-3 " role="alert">
            No data to be displayed.
        </div>';
        }else{
            if(isset($_SESSION['homepageBar']) && (isset($_SESSION['homepageFilter']))){
                $search = $_SESSION['homepageBar'];
                $filter = $_SESSION['homepageFilter'];
                unset($_SESSION['homepageBar']);
                unset($_SESSION['homepageFilter']);
                searchDashboardOnCall($search, $filter);
            }else{
                echo '<div class="table-responsive text-center">
                <table class="table table-sm table-striped table-success table-hover table-bordered">
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

function status(){
    require (__DIR__ . '/database.php');
    $stmt = $conn->prepare('SELECT * FROM dashboard');
    $stmt->execute();
    while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
        $id = $result['id'];
        $dateOut = $result['dateOut'];
        $date = new DateTime($dateOut);
        $current = new DateTime();
        $interval = $current->diff($date);
        $days = $interval->days;
        if ($days > 30) {
            $stmt = $conn->prepare('UPDATE dashboard SET status = "INACTIVE" WHERE id = :id');
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->execute();
        }else{
            $stmt = $conn->prepare('UPDATE dashboard SET status = "ACTIVE" WHERE id = :id');
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->execute();
        }
    }
}
function compute(){
    require (__DIR__ . '/database.php');
    $stmt = $conn->prepare('SELECT * FROM payroll');
    if($stmt->execute()){
        while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
            $id = $result['id'];
            $rate = $result['rate'];
            $holiday = $result['holiday'];
            $philhealth = $result['philhealth'];
            $sss = $result['sss'];
            $advance = $result['advance'];  
            $hrs = $result['hrs'];
            $days = $result['days'];
            $late = $result['late'];
            $ot = $result['ot'];
            
            $salary = $rate*$days+$rate/8*$late;
            $rph = $rate/8+$rate/8*0.20;
            $otPay = $rph*$hrs;
            $total = $salary+$otPay+$holiday-$philhealth-$sss-$advance;
            
            $stmtUpdate = $conn->prepare('UPDATE payroll SET salary = :salary, rph = :rph, ot = :ot, total = :total WHERE id = :id');
            $stmtUpdate->bindParam(':id', $id, PDO::PARAM_STR);
            $stmtUpdate->bindParam(':salary', $salary, PDO::PARAM_STR);
            $stmtUpdate->bindParam(':rph', $rph, PDO::PARAM_STR);
            $stmtUpdate->bindParam(':ot', $otPay, PDO::PARAM_STR);
            $stmtUpdate->bindParam(':total', $total, PDO::PARAM_STR);
            $stmtUpdate->execute();
            
        }
    }
}
function empDashboard($username2){
    require (__DIR__ . '/database.php');
    $stmt = $conn->prepare('SELECT * FROM log WHERE id = :id ORDER BY updateTime DESC');
    $stmt->bindParam(':id', $username2, PDO::PARAM_STR);
    if($stmt->execute()){
        $result = $stmt->rowCount();
        if($result == 0){
            echo '<div class="alert alert-info mt-3" role="alert">
            No data to be displayed.
        </div>';
        }else{
            if(isset($_SESSION['homepageBar']) && (isset($_SESSION['homepageFilter']))){
                $search = $_SESSION['homepageBar'];
                $filter = $_SESSION['homepageFilter'];
                unset($_SESSION['homepageBar']);
                unset($_SESSION['homepageFilter']);
                searchDashboardEmp($search, $filter);
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
function searchDashboardEmp($search, $filter){
    require (__DIR__ . '/database.php');
    $stmt = $conn->prepare('SELECT * FROM dashboard WHERE '.$filter.' LIKE :search AND type = "EMP"');
    if($stmt->execute(['search' => '%'.$search.'%'])){
        $result = $stmt->rowCount();
        if($result == 0){
            echo '<div class="alert alert-info mt-3" role="alert">
            No data to be displayed.
        </div>';
        }else{
            echo '<div class="table-responsive text-center mt-2">
                <table class="table table-sm table-striped table-success table-hover table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">NAME</th>
                            <th scope="col">JOB</th>
                            <th scope="col">TIMED-IN (DATE)</th>
                            <th scope="col">TIMED-IN (TIME)</th>
                            <th scope="col">TIMED-OUT (DATE)</th>
                            <th scope="col">TIMED-OUT (TIME)</th>
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
function searchDashboardOnCall($search, $filter){
    require (__DIR__ . '/database.php');
    $stmt = $conn->prepare('SELECT * FROM dashboard WHERE '.$filter.' LIKE :search AND type = "ONCALL"');
    if($stmt->execute(['search' => '%'.$search.'%'])){
        $result = $stmt->rowCount();
        if($result == 0){
            echo '<div class="alert alert-info mt-3" role="alert">
            No data to be displayed.
        </div>';
        }else{
            echo '<div class="table-responsive text-center mt-2">
                <table class="table table-sm table-striped table-success table-hover table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">NAME</th>
                            <th scope="col">JOB</th>
                            <th scope="col">TIMED-IN (DATE)</th>
                            <th scope="col">TIMED-IN (TIME)</th>
                            <th scope="col">TIMED-OUT (DATE)</th>
                            <th scope="col">TIMED-OUT (TIME)</th>
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
function payrollEmp($username1){
    require (__DIR__ . '/database.php');
    $stmt = $conn->prepare('SELECT * FROM payroll WHERE id = :id');
    $stmt->bindParam(':id', $username1, PDO::PARAM_STR);
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
                echo '<div class="table-responsive text-center mt-2" style="width: 1063px;">
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
                        </tr>
                    </thead>
                    <tbody class="table-group-divider text-center">
                        <tr>';
                while ($result = $stmt->fetch(PDO::FETCH_ASSOC)){
                    echo '<tr>';
                    echo '<td>'.$result['id'].'</td>';
                    echo '<td>'.$result['name'].'</td>';
                    echo '<td>'.$result['job'].'</td>';
                    echo '<td>'.$result['rate'].'</td>';
                    echo '<td>'.$result['days'].'</td>';
                    echo '<td>'.$result['late'].'</td>';
                    echo '<td>'.$result['salary'].'</td>';
                    echo '<td>'.$result['rph'].'</td>';
                    echo '<td>'.$result['hrs'].'</td>';
                    echo '<td>'.$result['ot'].'</td>';
                    echo '<td>'.$result['holiday'].'</td>';
                    echo '<td>'.$result['philhealth'].'</td>';
                    echo '<td>'.$result['sss'].'</td>';
                    echo '<td>'.$result['advance'].'</td>';
                    echo '<td>'.$result['total'].'</td>';
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
function days($id){
    require (__DIR__ . '/database.php');
    $date = date("Y-m-d");
    $previousDate = date("Y-m-d", strtotime($date . " -1 day"));
    $hours = 0;
    $stmt = $conn->prepare('SELECT * FROM log WHERE id = :id AND dateIn = :date AND dateOut = :date LIMIT 2');
    $stmt->bindParam(':id', $id, PDO::PARAM_STR);
    $stmt->bindParam(':date', $date, PDO::PARAM_STR);
    if($stmt->execute()){
        $rowCount = $stmt->rowCount();
        while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
            $timeIn = strtotime($result['timeIn']);
            $timeOut = strtotime($result['timeOut']);
            $totalTime = abs($timeOut - $timeIn);
            $totalTime /= 3600;
            $hours += $totalTime;
        }
        $stmtDays = $conn->prepare('SELECT days FROM payroll WHERE id = :id');
        $stmtDays->bindParam(':id', $id, PDO::PARAM_STR);
        $stmtDays->execute();
        $days = $stmtDays->fetch(PDO::FETCH_ASSOC);
        $days = $days['days'];
        if($hours >= 8){
            $days += 1;
            $stmt = $conn->prepare('UPDATE payroll SET days = :days WHERE id = :id');
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->bindParam(':days', $days, PDO::PARAM_STR);
            $stmt->execute();
        }else if($rowCount == 1 && $hours > 4 && $hours < 8){
            $days += 0.5;
            $stmt = $conn->prepare('UPDATE payroll SET days = :days WHERE id = :id');
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->bindParam(':days', $days, PDO::PARAM_STR);
            $stmt->execute();
        }
        
    }
}
function late($id){
    require (__DIR__ . '/database.php');
    $date = date("Y-m-d");
    $previousDate = date("Y-m-d", strtotime($date . " -1 day"));
    $timeLimit = "08:15:00";
    $limit = new DateTime(date('Y-m-d') . ' ' . $timeLimit);
    $penalty = 30;
    
    $stmt = $conn->prepare('SELECT * FROM log WHERE id = :id AND dateIn = :date AND dateOut = :date LIMIT 2');
    $stmt->bindParam(':id', $id, PDO::PARAM_STR);
    $stmt->bindParam(':date', $date, PDO::PARAM_STR);
    if($stmt->execute()){
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $check = new DateTime($date . ' ' . $result['timeIn']);
        if ($check > $limit) {
            $interval = $check->diff($limit);
            $penalty += $interval->days * 24 * 60 + $interval->h * 60 + $interval->i;
            $penalty /= 60;
            $penalty = number_format($penalty, 2);
            
            $stmtUpdate = $conn->prepare('UPDATE payroll SET late = :late WHERE id = :id');
            $stmtUpdate->bindParam(':id', $id, PDO::PARAM_STR);
            $stmtUpdate->bindParam(':late', $penalty, PDO::PARAM_STR);
            $stmtUpdate->execute();        
        }
    }
}
function otHours($id){
    require (__DIR__ . '/database.php');
    $date = date("Y-m-d");
    $previousDate = date("Y-m-d", strtotime($date . " -1 day"));
    $timeLimit = "18:00:00";
    $limit = new DateTime(date('Y-m-d') . ' ' . $timeLimit);
    $hours = 0;

    $stmt = $conn->prepare('SELECT * FROM log WHERE id = :id AND dateIn = :date AND dateOut = :date ORDER BY updateTime DESC  LIMIT 2');
    $stmt->bindParam(':id', $id, PDO::PARAM_STR);
    $stmt->bindParam(':date', $date, PDO::PARAM_STR);
    if($stmt->execute()){
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $check = new DateTime($date . ' ' . $result['timeOut']);
        if ($check > $limit) {
            $interval = $check->diff($limit);
            $hours += $interval->days * 24 * 60 + $interval->h * 60 + $interval->i;
            $hours /= 60;
            $hours = number_format($hours, 2);
            
            $stmtUpdate = $conn->prepare('UPDATE payroll SET hrs = :hrs WHERE id = :id');
            $stmtUpdate->bindParam(':id', $id, PDO::PARAM_STR);
            $stmtUpdate->bindParam(':hrs', $hours, PDO::PARAM_STR);
            $stmtUpdate->execute();        
        }else{
            echo 'false';
        }
    }


}
function numberToWords($number) {
    $units = ["", "one", "two", "three", "four", "five", "six", "seven", "eight", "nine"];
    $teens = ["", "eleven", "twelve", "thirteen", "fourteen", "fifteen", "sixteen", "seventeen", "eighteen", "nineteen"];
    $tens = ["", "ten", "twenty", "thirty", "forty", "fifty", "sixty", "seventy", "eighty", "ninety"];

    $result = "";

    if ($number == 0) {
        $result = "zero";
    } else {
        // Extract digits
        $thousands = floor($number / 1000);
        $hundreds = floor(($number % 1000) / 100);
        $tensAndUnits = $number % 100;

        // Convert thousands to words
        if ($thousands > 0) {
            $result .= $units[$thousands] . " thousand ";
        }

        // Convert hundreds to words
        if ($hundreds > 0) {
            $result .= $units[$hundreds] . " hundred ";
        }

        // Convert tens and units to words
        if ($tensAndUnits > 0) {
            if ($tensAndUnits >= 11 && $tensAndUnits <= 19) {
                $result .= $teens[$tensAndUnits - 10];
            } else {
                $result .= $tens[floor($tensAndUnits / 10)] . " " . $units[$tensAndUnits % 10];
            }
        }
    }

    return trim($result);
}

?>