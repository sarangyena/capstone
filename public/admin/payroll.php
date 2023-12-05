<?php
include ('../../includes/admin/header.php');
?>
                    
                    <div class="container-fluid text-white p-3">
                        <h1 class="text-white border-bottom d-inline-block">PAYROLL</h1>
                        <?php
                        if(isset($_SESSION['success'])){
                            echo '<div class="alert alert-success" role="alert">
                                    Successfuly added salary.
                                </div>';
                                unset($_SESSION['success']);
                        }else if(isset($_SESSION['error'])){
                            echo '<div class="alert alert-danger" role="alert">
                                Error. Try again.
                                </div>';
                        }
                        ?>
                        <form method="post" id="myForm" class="text-black" action="../../private/payroll_process.php">
                            <div class="row">
                                <div class="col-sm">
                                    <div class="input-group">
                                        <label class="input-group-text" for="employee">SELECT EMPLOYEE</label>
                                        <select class="form-select" name="select" id="select" tabindex="1">
                                            <option value="" disabled selected></option>
                                            <?php
                                            dispEmp();
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="input-group">
                                        <span class="input-group-text">DESIGNATION</span>
                                        <input type="text" class="form-control" name="job" id="job" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <h5 class="text-white border-bottom">REGULAR DAYS</h5>
                                <div class="col-sm">
                                    <div class="input-group">
                                        <span class="input-group-text">NO. OF DAYS</span>
                                        <input type="text" class="form-control" name="compute1" id="days" placeholder="0" oninput="num(this); computes()" tabindex="2" required>
                                    </div>
                                    <div class="input-group mt-2">
                                        <span class="input-group-text">RATE</span>
                                        <input type="text" class="form-control" name="compute3" id="rate" placeholder="0" readonly required>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="input-group">
                                        <span class="input-group-text">LATE</span>
                                        <input type="text" class="form-control" name="compute2" id="late" placeholder="0" oninput="num(this); computes();" tabindex="3" required>
                                    </div>
                                    <div class="input-group mt-2">
                                        <span class="input-group-text">SALARY</span>
                                        <input type="text" class="form-control" name="compute4" id="salary" placeholder="0" readonly required>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <h5 class="text-white border-bottom">OVERTIME</h5>
                                <div class="col-sm">
                                    <div class="input-group">
                                        <span class="input-group-text">RATE PER HOUR</span>
                                        <input type="text" class="form-control" name="compute5" id="rph" placeholder="0" readonly required>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="input-group">
                                        <span class="input-group-text">NO. OF HOURS</span>
                                        <input type="text" class="form-control" name="compute6" id="hours" placeholder="0" oninput="num(this); computes();" tabindex="4" required>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="input-group">
                                        <span class="input-group-text">OVERTIME PAY</span>
                                        <input type="text" class="form-control" name="compute7" id="otPay" placeholder="0" readonly required>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <h5 class="text-white border-bottom">ALLOWANCES & DEDUCTIONS</h5>
                                <div class="col-sm">
                                    <div class="input-group">
                                        <span class="input-group-text">HOLIDAY</span>
                                        <input type="text" class="form-control" name="compute8" id="holiday" placeholder="0" oninput="num(this); computes();" tabindex="5">
                                    </div>
                                    <div class="input-group mt-2">
                                        <span class="input-group-text">PHILHEALTH</span>
                                        <input type="text" class="form-control" name="compute10" id="philHealth" placeholder="0" oninput="num(this); computes();" tabindex="7">
                                    </div>
                                    <div class="input-group mt-2">
                                        <span class="input-group-text">CASH ADVANCE</span>
                                        <input type="text" class="form-control" name="compute12" id="advance" placeholder="0" oninput="num(this); computes();" tabindex="9">
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="input-group">
                                        <span class="input-group-text">ALLOWANCES</span>
                                        <input type="text" class="form-control" name="compute9" id="allowance" placeholder="0" oninput="num(this); computes();" tabindex="6">
                                    </div>
                                    <div class="input-group mt-2">
                                        <span class="input-group-text">SSS</span>
                                        <input type="text" class="form-control" name="compute11" id="sss" placeholder="0" oninput="num(this); computes();" tabindex="8">
                                    </div>
                                </div>
                                <div class="input-group mt-2 border-top pt-2">
                                    <span class="input-group-text">TOTAL AMOUNT</span>
                                    <input type="text" class="form-control" name="compute13" id="amount" placeholder="0" oninput="num(this); computes();" readonly required>
                                </div>
                                <div class="d-flex mt-3">
                                    <button type="submit" class="btn btn-warning ms-auto" name="compute" tabindex="10">ADD PAYROLL</button>
                                    <button type="button" class="btn btn-warning ms-2" onclick="clearForm()" tabindex="11">CLEAR</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                        let pill = document.getElementById("payroll");
                        payroll.classList.remove('text-black');
                        payroll.className += " bg-success text-white active";
                    });

                    var username = document.getElementById("select");
                    username.addEventListener("input", function() {
                        var value = username.value;
                        fetch('../../private/search_process.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'text/plain'                            
                            },
                            body: value
                        })
                        .then(response => response.json())
                        .then(data => {
                            var job = document.getElementById('job');
                            job.value = data.job;
                            var rate = document.getElementById('rate');
                            rate.value = data.rate
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                    });
                    </script>
<?php
include ('../../includes/admin/footer.php');
?>