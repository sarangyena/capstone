<?php
include ('../../includes/admin/header.php');
compute();
?>
                    
                    <div class="container-fluid text-white p-3">
                        <h1 class="text-white border-bottom d-inline-block">PAYROLL</h1>
                        <form method="POST" class="d-flex" action="../../private/search_process.php">
                            <div class="input-group">
                                <span class="input-group-text">SEARCH</span>
                                <input type="search" class="form-control" name="payrollBar" oninput="up(this)" tabindex="1" required>
                            </div>
                            <div class="input-group mx-2 ">
                                <label class="input-group-text">FILTER</label>
                                <select class="form-select" name="payrollFilter" tabindex="2" required>
                                    <option value="" disabled selected></option>
                                    <option value="id">ID</option>
                                    <option value="name">NAME</option>
                                    <option value="job">JOB</option>
                                    <option value="rate">RATE</option>
                                    <option value="days">NO. OF DAYS</option>
                                    <option value="late">LATE</option>
                                    <option value="salary">SALARY</option>
                                    <option value="rph">RATE PER HOUR</option>
                                    <option value="hrs">NO. OF HOURS</option>
                                    <option value="ot">OVERTIME PAY</option>
                                    <option value="holiday">HOLIDAY</option>
                                    <option value="philhealth">PHILHEALTH</option>
                                    <option value="sss">SSS</option>
                                    <option value="advance">ADVANCE</option>
                                    <option value="amount">AMOUNT</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-warning" name="search" tabindex="3">SEARCH</button>
                            <button type="button" class="btn btn-warning ms-2" name="reload" tabindex="4" onclick="reloadPage()"><i class="fa-solid fa-rotate-right"></i></button>
                        </form>
                        <div class="modal fade" id="payroll1" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5 text-black" id="staticBackdropLabel">EDIT</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="POST" action="../../private/editPayroll_process.php">
                                        <div class="modal-body">
                                            <div class="input-group">
                                                <span class="input-group-text">RATE</span>
                                                <input type="number" class="form-control" id="rate" name="rate">
                                            </div>     
                                            <div class="input-group mt-2">
                                                <span class="input-group-text">HOLIDAY</span>
                                                <input type="number" class="form-control" id="holiday" name="holiday">
                                            </div>     
                                            <div class="input-group mt-2">
                                                <span class="input-group-text">PHILHEALTH</span>
                                                <input type="number" class="form-control" id="philhealth" name="philhealth">
                                            </div>     
                                            <div class="input-group mt-2">
                                                <span class="input-group-text">SSS</span>
                                                <input type="number" class="form-control" id="sss" name="sss">
                                            </div>     
                                            <div class="input-group mt-2">
                                                <span class="input-group-text">ADVANCE</span>
                                                <input type="number" class="form-control" id="advance" name="advance">
                                            </div>                    
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CLOSE</button>
                                            <button type="submit" class="btn btn-success" name="editPayroll">UPDATE</button>
                                        </div>
                                    </form>
                                    <button>asasas</button>
                                </div>
                            </div>
                        </div>
                        <?php
                        if(isset($_SESSION['success'])){
                            echo '<div class="alert alert-success mt-3" role="alert">
                                Successfuly updated information.
                                </div>';
                                unset($_SESSION['success']);
                        }else if(isset($_SESSION['error'])){
                            echo '<div class="alert alert-danger mt-3" role="alert">
                                Error. Try again.
                                </div>';
                                unset($_SESSION['error']);
                        }
                        tablePayroll();
                        ?>
                    </div>
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                        let pill = document.getElementById("payroll2");
                        payroll2.classList.remove('text-black');
                        payroll2.className += " bg-success text-white active";
                    });
                    function getRowId(id) {
                        var rowId = id;
                        fetch('../../private/editPayroll_process.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: rowId
                        })
                        .then(response => response.json())
                        .then(data => {
                            var rate = document.getElementById('rate');
                            rate.value = data.rate;
                            var holiday = document.getElementById('holiday');
                            holiday.value = data.holiday;
                            var philhealth = document.getElementById('philhealth');
                            philhealth.value = data.philhealth;
                            var sss = document.getElementById('sss');
                            sss.value = data.sss;
                            var advance = document.getElementById('advance');
                            advance.value = data.advance;
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                        
                    }
                    function payslip(id) {
                        fetch('../../private/payslip_process.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: id
                        })
                        .then(response => response.json())
                        .then(data => {
                            if(data){
                                window.location.href = "../../private/payslip_process.php";
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                        
                    }
                    function payroll(id) {
                        fetch('../../private/print_payroll.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: id
                        })
                        .then(response => response.json())
                        .then(data => {
                            if(data){
                                window.location.href = "../../private/print_payroll.php";
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                        
                    }
                    </script>
<?php
include ('../../includes/admin/footer.php');
?>