<?php
include ('../../includes/admin/header.php');
?>
                    
                    <div class="container-fluid text-white p-3">
                        <h1 class="text-white border-bottom d-inline-block">PAYROLL</h1>
                        <div class="modal fade" id="payroll1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                            <button type="submit" class="btn btn-success" name="editPayroll">SELECT</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php
                        if(isset($_SESSION['success'])){
                            echo '<div class="alert alert-success" role="alert">
                                Successfuly updated information.
                                </div>';
                                unset($_SESSION['success']);
                        }else if(isset($_SESSION['error'])){
                            echo '<div class="alert alert-danger" role="alert">
                                Error. Try again.
                                </div>';
                                unset($_SESSION['error']);
                        }
                        tablePayroll();
                        ?>
                    </div>
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                        let pill = document.getElementById("payroll");
                        payroll.classList.remove('text-black');
                        payroll.className += " bg-success text-white active";
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
                    </script>
<?php
include ('../../includes/admin/footer.php');
?>