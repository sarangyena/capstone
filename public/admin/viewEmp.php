<?php
include ('../../includes/admin/header.php');
?>

                    <div class="container-fluid p-3">
                        <ul class="nav nav-pills justify-content-center">
                            <li class="nav-item">
                                <a class="nav-link active bg-secondary" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><button type="button" class="btn btn-sm">ADD EMPLOYEE</button></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active bg-secondary mx-2" href="viewOnCall.php"><button type="button" class="btn btn-sm">ON-CALL DETAILS</button></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active text-black bg-warning" href="viewEmp.php"><button type="button" class="btn btn-sm">EMPLOYEE DETAILS</button></a>
                            </li>
                        </ul>
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">ADD EMPLOYEE</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="POST" action="../../private/category.php">
                                        <div class="modal-body">
                                            <div class="input-group mt-2">
                                                <label class="input-group-text" for="category">CATEGORY</label>
                                                <select class="form-select" name="category" required>
                                                    <option value="" disabled selected></option>
                                                    <option value="EMPLOYEE">EMPLOYEE</option>
                                                    <option value="ON-CALL">ON-CALL</option>
                                                </select>
                                            </div>                         
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CLOSE</button>
                                            <button type="submit" class="btn btn-primary" name="select">SELECT</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="container-fluid">
                            <h1 class="text-white border-bottom d-inline-block">EMPLOYEE DETAILS</h1>
                            <form method="POST" class="d-flex" action="../../private/search_process.php">
                                <div class="input-group">
                                    <span class="input-group-text">SEARCH</span>
                                    <input type="search" class="form-control" name="empBar" oninput="up(this)" tabindex="1" required>
                                </div>
                                <div class="input-group mx-2 ">
                                    <label class="input-group-text">FILTER</label>
                                    <select class="form-select" name="empFilter" tabindex="2" required>
                                        <option value="" disabled selected></option>
                                        <option value="id">ID</option>
                                        <option value="last">LAST</option>
                                        <option value="first">FIRST</option>
                                        <option value="middle">MIDDLE</option>
                                        <option value="status">STATUS</option>
                                        <option value="email">EMAIL</option>
                                        <option value="phone">PHONE</option>
                                        <option value="job">JOB</option>
                                        <option value="sss">SSS</option>
                                        <option value="philhealth">PHILHEALTH</option>
                                        <option value="pagibig">PHILHEALTH</option>
                                        <option value="rate">RATE</option>
                                        <option value="address">ADDRESS</option>
                                        <option value="eName">ENAME</option>
                                        <option value="ePhone">EPHONE</option>
                                        <option value="eAddress">EADD</option>
                                        <option value="hired">HIRED</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-warning" name="search" tabindex="3">SEARCH</button>
                                <button type="button" class="btn btn-warning ms-2" name="reload" tabindex="4" onclick="reloadPage()"><i class="fa-solid fa-rotate-right"></i></button>
                                <button type="button" class="btn btn-warning ms-2" id="print-btn" onclick="window.print();">PRINT</button>
                            </form>
                            
                            <?php
                            tableEmp();
                            ?>
                        </div>
                    </div>
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                        let pill = document.getElementById("employee");
                        employee.classList.remove('text-black');
                        employee.className += " bg-success text-white active";
                    });
                    </script>
<?php
include ('../../includes/admin/footer.php');
?>