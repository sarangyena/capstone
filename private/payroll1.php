<?php
require ('database.php');
require ('functions.php');

ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAYSLIP</title>
    <link rel="icon" type="image/x-icon" href="../images/logo.png">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="styles.css">
    <script text="text/javascript" src="script.js"></script>
</head>
<body>
    <div class="container d-flex justify-content-center">
        <?php
        $stmtPayroll = $conn->prepare('SELECT * FROM payroll WHERE id = :id');
        $stmtPayroll->bindParam(':id', $_SESSION['rowId'], PDO::PARAM_STR);
        $stmtPayroll->execute();
        $payrollResult = $stmtPayroll->fetch(PDO::FETCH_ASSOC);
        $deduction = $payrollResult['philhealth']-$payrollResult['sss']-$payrollResult['advance'];
        $net = $payrollResult['total']-$deduction;

        $path = 'images/logo.png';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        echo '<img src="'.$base64.'" style="width: 8%">';
        ?>
        <h3 class="text-center">AL DAWAH PRODUCERS COOPERATIVE</h3>
        <h5 class="text-center">303 YUMUL ST. BARANGAY GOMEZ 4316 LOPEZ, PHILIPPINES</h5>
        <h3><?php echo date('Y-m-d h:i:s a')?></h3>

        <table class="table table-striped table-bordered table-condensed">
            <tbody>
                <tr>
                    <th>ID</th>
                    <td><?php echo $payrollResult['id']; ?></td>
                </tr>
                <tr>
                    <th>EMPLOYEE NAME</th>
                    <td><?php echo $payrollResult['name']; ?></td>
                </tr>
                <tr>
                    <th>JOB</th>
                    <td><?php echo $payrollResult['job']; ?></td>
                </tr>
                <tr>
                    <th>WEEK</th>
                    <td><?php echo $payrollResult['week']; ?></td>
                </tr>
            </tbody>
        </table>

        <table class="table table-striped table-bordered table-condensed">
            <tbody>
                <tr>
                    <th>REPORT</th>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>RATE</td>
                    <td><?php echo $payrollResult['rate']; ?></td>
                    <td>HOLIDAY</td>
                    <td><?php echo $payrollResult['holiday']; ?></td>
                </tr>
                <tr>
                    <td>NO. OF DAYS</td>
                    <td><?php echo $payrollResult['days']; ?></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>LATE</td>
                    <td><?php echo $payrollResult['rate']; ?></td>
                    <td>PHILHEALTH</td>
                    <td><?php echo $payrollResult['philhealth']; ?></td>
                </tr>
                <tr>
                    <td>SALARY</td>
                    <td><?php echo $payrollResult['salary']; ?></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>RATE PER HOUR</td>
                    <td><?php echo $payrollResult['rph']; ?></td>
                    <td>SSS</td>
                    <td><?php echo $payrollResult['sss']; ?></td>
                </tr>
                <tr>
                    <td>NO. OF HOURS</td>
                    <td><?php echo $payrollResult['hrs']; ?></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>OVERTIME PAY</td>
                    <td><?php echo $payrollResult['ot']; ?></td>
                    <td>CASH ADVANCE</td>
                    <td><?php echo $payrollResult['advance']; ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <th>NET SALARY</th>
                    <td><?php echo $payrollResult['total']; ?></td>
                </tr>
            </tbody>
        </table>
        <h4><?php echo numberToWords($net).' pesos'; ?></h4>
        <h5>Date: ____________________________</h5>
        <table class="table">
            <tbody>
                <tr>
                    <td>Signature of Employee: ____________________</td>
                    <td>Signature of Director: ____________________</td>
                </tr>
            </tbody>
        </table>
    </div>
    <?php
    unset($_SESSION['printId']);
    ?>
</body>
</html>