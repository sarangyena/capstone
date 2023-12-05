<?php
include ('../../includes/admin/header.php');
?>
                    <div class="container-fluid text-white p-3">
                        <h1 class="text-white border-bottom d-inline-block">REPORT</h1>
                        <form method="POST" class="d-flex" action="../../private/search_process.php">
                            <div class="input-group">
                                <span class="input-group-text">SEARCH</span>
                                <input type="search" class="form-control" name="payrollBar" oninput="up(this)" tabindex="1" required>
                            </div>
                            <div class="input-group mx-2 ">
                                <label class="input-group-text">FILTER</label>
                                <select class="form-select" name="payrollFilter" tabindex="2" required>
                                    <option value="" disabled selected></option>
                                    <option value="uid">ID</option>
                                    <option value="name">NAME</option>
                                    <option value="date">DATE</option>
                                    <option value="job">JOB</option>
                                    <option value="days">NO. OF DAYS</option>
                                    <option value="late">LATE</option>
                                    <option value="rate">RATE</option>
                                    <option value="salary">SALARY</option>
                                    <option value="rph">RATE PER HOUR</option>
                                    <option value="hours">NO. OF HOURS</option>
                                    <option value="otPay">OVERTIME PAY</option>
                                    <option value="holiday">HOLIDAY</option>
                                    <option value="allowances">ALLOWANCES</option>
                                    <option value="philHealth">PHILHEALTH</option>
                                    <option value="sss">SSS</option>
                                    <option value="advance">ADVANCE</option>
                                    <option value="amount">AMOUNT</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-warning" name="search" tabindex="3">SEARCH</button>
                            <button type="button" class="btn btn-warning ms-2" name="reload" tabindex="4" onclick="reloadPage()"><i class="fa-solid fa-rotate-right"></i></button>
                        </form>
                        <div class="table-responsive text-center">
                            <table class="table table-sm table-bordered mt-3">
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
                                    <tr>
                                        <?php
                                        if(isset($_SESSION['payrollBar']) && (isset($_SESSION['payrollFilter']))){
                                            $search = $_SESSION['payrollBar'];
                                            $filter = $_SESSION['payrollFilter'];
                                            unset($_SESSION['payrollBar']);
                                            unset($_SESSION['filter']);
                                            searchPayroll($search, $filter);
                                        }else{
                                            tablePayroll();
                                        }
                                        ?>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                        let pill = document.getElementById("report");
                        report.classList.remove('text-black');
                        report.className += " bg-success text-white active";
                    });
                    </script>
<?php
include ('../../includes/admin/footer.php');
?>