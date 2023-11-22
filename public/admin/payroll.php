<?php
include ('../../includes/admin/header.php');
?>
                    
                    <div class="container-fluid text-white p-3">
                        <h1 class="text-white border-bottom d-inline-block">PAYROLL</h1>
                        <form method="post" id="myForm" class="text-black">
                            <div class="row">
                                <div class="col-sm">
                                    <div class="input-group">
                                        <span class="input-group-text">LAST NAME</span>
                                        <input type="text" class="form-control" name="add2" oninput="letters(this)" tabindex="1" required>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="input-group">
                                        <span class="input-group-text">LAST NAME</span>
                                        <input type="text" class="form-control" name="add2" oninput="letters(this)" tabindex="1" required>
                                    </div>
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
                    </script>
<?php
include ('../../includes/admin/footer.php');
?>