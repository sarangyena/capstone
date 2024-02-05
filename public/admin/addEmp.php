<?php
include ('../../includes/admin/header.php');
?>

                    <div class="container-fluid p-3">
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
                                                    <option value="EMPLOYEE">EMPLOYEE</option>
                                                    <option value="ON-CALL">ON-CALL</option>
                                                </select>
                                            </div>                         
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CLOSE</button>
                                            <button type="submit" class="btn btn-success" name="select">SELECT</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <ul class="nav nav-pills justify-content-center">
                            <li class="nav-item">
                                <a class="nav-link active bg-warning me-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><button type="button" class="btn btn-sm">ADD EMPLOYEE</button></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active bg-secondary me-2" href="addOnCall.php"><button type="button" class="btn btn-sm">ADD ON-CALL</button></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active bg-secondary" href="viewOnCall.php"><button type="button" class="btn btn-sm">ON-CALL DETAILS</button></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active bg-secondary ms-2" href="viewEmp.php"><button type="button" class="btn btn-sm">EMPLOYEE DETAILS</button></a>
                            </li>
                        </ul>
                        <!--<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                        </div>-->
                    </div>
                    <div class="container-fluid p-3">
                        <h1 class="text-white border-bottom d-inline-block">ADD EMPLOYEE</h1>
                        <?php
                        if(isset($_SESSION['success'])){
                            echo '<div class="alert alert-success" role="alert">
                            Successfuly added an employee.
                            </div>';
                            unset($_SESSION['success']);
                        }else if(isset($_SESSION['error5'])){
                            echo '<div class="alert alert-danger" role="alert">
                            Failed to add an employee. Try again.
                            </div>';
                            unset($_SESSION['error5']);
                        }
                        ?>
                        <h4 class="text-white border-bottom mt-3">PERSONAL INFORMATION</h4>
                        <form method="POST" enctype="multipart/form-data" id="myForm" action="../../private/addEmp_process.php">
                            <div class="row my-3">
                                <div class="col-sm-3 text-center bg-white rounded p-3">
                                    <img src="../../private/images/user.png" class="img-fluid mx-auto" id="preview" style="max-height: 200px;">
                                </div>
                                <div class="col-sm d-flex flex-column">
                                    <h2 class="text-white mt-auto">UPLOAD EMPLOYEE IMAGE:</h2>
                                    <input type="file" name="image" id="image" onchange="previewImage(event)" class="form-control mb-auto" accept=".jpg, .jpeg, .png" tabindex="1" required>
                                    <?php
                                    if(isset($_SESSION['error1'])){
                                        echo '<div class="alert alert-danger mt-2" role="alert">
                                            File too large.
                                            </div>';
                                            unset($_SESSION['error1']);
                                    }else if(isset($_SESSION['error2'])){
                                        echo '<div class="alert alert-danger mt-2" role="alert">
                                            Invalid file type.
                                            </div>';
                                            unset($_SESSION['error2']);
                                    }else if(isset($_SESSION['error3'])){
                                        echo '<div class="alert alert-danger mt-2" role="alert">
                                            Error uploading file.
                                            </div>';
                                            unset($_SESSION['error3']);
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm">
                                    <div class="input-group">
                                        <span class="input-group-text">LAST NAME</span>
                                        <input type="text" class="form-control" name="add1" oninput="letters(this)" tabindex="2" required>
                                    </div>
                                    <div class="input-group mt-2">
                                        <label class="input-group-text" for="status">CIVIL STATUS</label>
                                        <select class="form-select" name="add4" tabindex="5" required>
                                            <option value="" disabled selected></option>
                                            <option value="SINGLE">SINGLE</option>
                                            <option value="MARRIED">MARRIED</option>
                                            <option value="DIVORCED">DIVORCED</option>
                                        </select>
                                    </div>
                                    <div class="input-group mt-2">
                                        <label class="input-group-text" for="job">DESIGNATION</label>
                                        <select class="form-select" name="add7" tabindex="8" required>
                                            <option value="" disabled selected></option>
                                            <option value="AREA MANAGER">AREA MANAGER</option>
                                            <option value="BOOK KEEPER">BOOK KEEPER</option>
                                            <option value="CASHIER">CASHIER</option>
                                            <option value="FARMER">FARMER</option>
                                            <option value="FARM MANAGER">FARM MANAGER</option>
                                            <option value="GENERAL MANAGER">GENERAL MANAGER</option>
                                            <option value="HR">HR</option>
                                            <option value="PAYROLL ASSISTANT">PAYROLL ASSISTANT</option>
                                            <option value="SECRETARY">SECRETARY</option>
                                            <option value="SUPERVISOR">SUPERVISOR</option>
                                            <option value="TECH SUPPORT">TECH SUPPORT</option>
                                        </select>
                                    </div>
                                    <div class="input-group mt-2">
                                        <span class="input-group-text">PAG-IBIG NUMBER</span>
                                        <input type="text" class="form-control" name="add10" tabindex="11">
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="input-group">
                                        <span class="input-group-text">FIRST NAME</span>
                                        <input type="text" class="form-control" name="add2" oninput="letters(this)" tabindex="3" required>
                                    </div>
                                    <div class="input-group mt-2">
                                        <span class="input-group-text">EMAIL</span>
                                        <input type="email" class="form-control" name="add5" oninput="up(this)" tabindex="6">
                                    </div>
                                    <div class="input-group mt-2">
                                        <span class="input-group-text">SSS NUMBER</span>
                                        <input type="text" class="form-control" name="add8" oninput="num(this)" tabindex="9">
                                    </div>
                                    <div class="input-group mt-2">
                                        <span class="input-group-text">RATE</span>
                                        <input type="number" class="form-control" name="add11" tabindex="12" required>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="input-group">
                                        <span class="input-group-text">MIDDLE NAME</span>
                                        <input type="text" class="form-control" name="add3" oninput="letters(this)" tabindex="4">
                                    </div>
                                    <div class="input-group mt-2">
                                        <span class="input-group-text">PHONE NUMBER</span>
                                        <input type="text" class="form-control" name="add6" oninput="num(this)" tabindex="7">
                                    </div>
                                    <div class="input-group mt-2">
                                        <span class="input-group-text">PHILHEALTH NUMBER</span>
                                        <input type="text" class="form-control" name="add9" oninput="num(this)" tabindex="10">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-sm">
                                    <h4 class="text-white border-bottom">ADDRESS</h4>
                                    <div class="input-group">
                                        <span class="input-group-text">ADDRESS</span>
                                        <input type="text" class="form-control" name="add12" oninput="up(this)" tabindex="13" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <h4 class="text-white border-bottom">EMERGENCY CONTACT</h4>
                                <div class="col-sm">
                                    <div class="input-group">
                                        <span class="input-group-text">FULL NAME</span>
                                        <input type="text" class="form-control" name="add13" oninput="letters(this)" tabindex="14">
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="input-group">
                                        <span class="input-group-text">PHONE NUMBER</span>
                                        <input type="text" class="form-control" name="add14" oninput="num(this)" tabindex="15">
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mt-2">
                                <span class="input-group-text">ADDRESS</span>
                                <input type="text" class="form-control" name="add15" oninput="up(this)" tabindex="16">
                            </div>
                            <div>
                                <div class="d-flex mt-3">
                                    <button type="submit" class="btn btn-warning ms-auto" name="add" tabindex="17">ADD EMPLOYEE</button>
                                    <button type="button" class="btn btn-warning ms-2" onclick="clearForm()" tabindex="18">CLEAR</button>
                                </div>
                            </div>
                        </form>
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