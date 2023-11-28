<?php
include ('../../includes/admin/header.php');
?>
                    
                    <div class="container-fluid text-white p-3">
                        <h1 class="text-white border-bottom d-inline-block">PAYROLL</h1>
                        <form method="post" id="myForm" class="text-black" action="../../private/search_process.php">
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
                                        <input type="text" class="form-control" name="job" id="job" tabindex="2" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <h5 class="text-white border-bottom">REGULAR DAYS</h5>
                                <div class="col-sm">
                                    <div class="input-group">
                                        <span class="input-group-text">NO. OF DAYS</span>
                                        <input type="text" class="form-control" name="days" id="days" placeholder="0" oninput="num(this); compute();" tabindex="3" required>
                                    </div>
                                    <div class="input-group mt-2">
                                        <span class="input-group-text">RATE</span>
                                        <input type="text" class="form-control" name="rate" id="rate" placeholder="0" oninput="num(this); compute();" tabindex="5" required>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="input-group">
                                        <span class="input-group-text">LATE</span>
                                        <input type="text" class="form-control" name="late" id="late" placeholder="0" oninput="num(this); compute();" tabindex="4" required>
                                    </div>
                                    <div class="input-group mt-2">
                                        <span class="input-group-text">SALARY</span>
                                        <input type="text" class="form-control" name="salary" id="salary" placeholder="0" oninput="num(this); compute();" tabindex="6" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <h5 class="text-white border-bottom">OVERTIME</h5>
                                <div class="col-sm">
                                    <div class="input-group">
                                        <span class="input-group-text">RATE PER HOUR</span>
                                        <input type="text" class="form-control" name="rph" id="rph" placeholder="0" oninput="num(this); compute();" tabindex="7" required>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="input-group">
                                        <span class="input-group-text">NO. OF HOURS</span>
                                        <input type="text" class="form-control" name="hours" id="hours" placeholder="0" oninput="num(this); compute();" tabindex="8" required>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="input-group">
                                        <span class="input-group-text">OVERTIME PAY</span>
                                        <input type="text" class="form-control" name="otPay" id="otPay" placeholder="0" oninput="num(this); compute();" tabindex="9" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <h5 class="text-white border-bottom">ALLOWANCES & DEDUCTIONS</h5>
                                <div class="col-sm">
                                    <div class="input-group">
                                        <span class="input-group-text">HOLIDAY</span>
                                        <input type="text" class="form-control" name="holiday" id="holiday" placeholder="0" oninput="num(this); compute();" tabindex="10" required>
                                    </div>
                                    <div class="input-group mt-2">
                                        <span class="input-group-text">PHILHEALTH</span>
                                        <input type="text" class="form-control" name="philHealth" id="philHealth" placeholder="0" oninput="num(this); compute();" tabindex="12" required>
                                    </div>
                                    <div class="input-group mt-2">
                                        <span class="input-group-text">CASH ADVANCE</span>
                                        <input type="text" class="form-control" name="advance" id="advance" placeholder="0" oninput="num(this); compute();" tabindex="14" required>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="input-group">
                                        <span class="input-group-text">ALLOWANCES</span>
                                        <input type="text" class="form-control" name="allowance" id="allowance" placeholder="0" oninput="num(this); compute();" tabindex="11" required>
                                    </div>
                                    <div class="input-group mt-2">
                                        <span class="input-group-text">SSS</span>
                                        <input type="text" class="form-control" name="sss" id="sss" placeholder="0" oninput="num(this); compute();" tabindex="13" required>
                                    </div>
                                </div>
                                <div class="input-group mt-2 border-top pt-2">
                                    <span class="input-group-text">TOTAL AMOUNT</span>
                                    <input type="text" class="form-control" name="amount" id="amount" placeholder="0" oninput="num(this); compute();" tabindex="15" readonly required>
                                </div>
                                <div class="d-flex mt-3">
                                    <button type="submit" class="btn btn-warning ms-auto" name="compute" tabindex="16">ADD PAYROLL</button>
                                    <button type="button" class="btn btn-warning ms-2" onclick="clearForm()" tabindex="17">CLEAR</button>
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