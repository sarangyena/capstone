<?php
require ('database.php');
require ('functions.php');

ob_start();
include ("get_id.php")
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
        $stmt = $conn->prepare('SELECT * FROM payroll WHERE id = :id');
        $stmt->bindParam(':id', $_SESSION['printId'], PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $deduction = $result['philhealth']-$result['sss']-$result['advance'];
        $net = $result['total']-$deduction;

        $path = 'images/logo.png';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        echo '<img src="'.$base64.'" style="width: 8%">';
        ?>
        <h3 class="text-center">AL DAWAH PRODUCERS COOPERATIVE</h3>
        <h5 class="text-center">303 YUMUL ST. BARANGAY GOMEZ 4316 LOPEZ, PHILIPPINES</h5>

        <table class="table table-striped table-bordered table-condensed">
            <tbody>
                <tr>
                    <th>EMPLOYEE NAME</th>
                    <td><?php echo $result['name']; ?></td>
                </tr>
                <tr>
                    <th>DESIGNATION</th>
                    <td><?php echo $result['job']; ?></td>
                </tr>
                <tr>
                    <th>WEEK</th>
                    <td></td>
                </tr>
            </tbody>
        </table>

        <table class="table table-striped table-bordered table-condensed">
            <tbody>
                <tr>
                    <th>EARNINGS</th>
                    <td></td>
                    <th>DEDUCTIONS</th>
                    <td></td>
                </tr>
                <tr>
                    <td>SALARY</td>
                    <td><?php echo $result['salary']; ?></td>
                    <td>PHILHEALTH</td>
                    <td><?php echo $result['philhealth']; ?></td>
                </tr>
                <tr>
                    <td>OVERTIME PAY</td>
                    <td><?php echo $result['ot']; ?></td>
                    <td>SSS</td>
                    <td><?php echo $result['sss']; ?></td>
                </tr>
                <tr>
                    <td>HOLIDAY</td>
                    <td><?php echo $result['holiday']; ?></td>
                    <td>CASH ADVANCE</td>
                    <td><?php echo $result['advance']; ?></td>
                </tr>
                <tr>
                    <td>TOTAL AMOUNT</td>
                    <td><?php echo $result['total']; ?></td>
                    <td>TOTAL DEDUCTION</td>
                    <td><?php echo $deduction; ?></td>
                </tr>
                <tr>
                    <th></th>
                    <td></td>
                    <th>NET SALARY</th>
                    <td><?php echo $net; ?></td>
                </tr>
            </tbody>
        </table>
        <h4><?php echo numberToWords($net); ?></h4>
        <h5>Cheque No.: ______________________</h5>
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
</body>
</html>