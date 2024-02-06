<?php
include ('../../includes/employee/header.php');
?>
                    <div class="container-fluid text-white p-3">
                        <h1 class="border-bottom text-center py-2">HOMEPAGE</h1>
                        <div class="row" style="height: 150px;">
                            <div class="col bg-white border border-black rounded-2 text-black"> 
                                <h3 class="text-center border-bottom border-black">TOTAL EARNINGS</h3>
                                <?php
                                $salary = 0;
                                $stmtSal = $conn->prepare('SELECT salary FROM payroll WHERE id = :id');
                                $stmtSal->bindParam(':id', $_SESSION['user_id'], PDO::PARAM_STR);
                                $stmtSal->execute();
                                while($result = $stmtSal->fetch(PDO::FETCH_ASSOC)){
                                    $salary += $result['salary'];
                                }
                                echo '<h1 class="text-center mt-4">₱ '.$salary.'</h1>';
                                ?>
                            </div>
                            <div class="col bg-white border border-black mx-2 rounded-2 text-black">
                                <h3 class="text-center border-bottom border-black">TOTAL DEDUCTIONS</h3>
                                <?php
                                $deduction = 0;
                                $stmtDeduc = $conn->prepare('SELECT * FROM payroll WHERE id = :id');
                                $stmtDeduc->bindParam(':id', $_SESSION['user_id'], PDO::PARAM_STR);
                                $stmtDeduc->execute();
                                while($result = $stmtDeduc->fetch(PDO::FETCH_ASSOC)){
                                    $deduction += $result['philhealth']+$result['sss']+$result['advance'];
                                    $deduction = floatVal($deduction);
                                }
                                
                                echo '<h1 class="text-center mt-4">-₱'.$deduction.'</h1>';
                                ?>
                            </div>
                            <div class="col bg-white border border-black rounded-2 text-black">
                                <h3 class="text-center border-bottom border-black">NET SALARY</h3>
                                <?php
                                $amount = 0;
                                $stmtAmount = $conn->prepare('SELECT * FROM payroll WHERE id = :id');
                                $stmtAmount->bindParam(':id', $_SESSION['user_id'], PDO::PARAM_STR);
                                $stmtAmount->execute();
                                while($result = $stmtAmount->fetch(PDO::FETCH_ASSOC)){
                                    $amount += $result['total'];
                                }
                                
                                echo '<h1 class="text-center mt-4">₱ '.$amount.'</h1>';
                                ?>
                            </div>
                        </div>
                        <?php
                        $username = $_SESSION['user_id'];
                        empDashboard($username);
                        ?>
                    </div>
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                        let pill = document.getElementById("homepage");
                        homepage.classList.remove('text-black');
                        homepage.className += " bg-success text-white active";
                    });
                    </script>
<?php
include ('../../includes/employee/footer.php');
?>