<?php
include ('../../includes/admin/header.php');
?>

                    <div class="container-fluid p-3">
                        <ul class="nav nav-pills justify-content-center">
                            <li class="nav-item">
                                <a class="nav-link active bg-secondary" href="addEmp.php">ADD EMPLOYEE</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active bg-secondary mx-2" href="addClass.php">ADD CLASS</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active text-black bg-warning" href="viewEmp.php">EMPLOYEE DETAILS</a>
                            </li>
                        </ul>
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
                                        <option value="uid">ID</option>
                                        <option value="hired">HIRED</option>
                                        <option value="last">LAST</option>
                                        <option value="first">FIRST</option>
                                        <option value="middle">MIDDLE</option>
                                        <option value="suffix">SUFFIX</option>
                                        <option value="birthday">BIRTHDAY</option>
                                        <option value="age">AGE</option>
                                        <option value="gender">GENDER</option>
                                        <option value="email">EMAIL</option>
                                        <option value="phone">PHONE</option>
                                        <option value="status">STATUS</option>
                                        <option value="sss">SSS</option>
                                        <option value="philHealth">PHILHEALTH</option>
                                        <option value="job">JOB</option>
                                        <option value="rate">RATE</option>
                                        <option value="address">ADDRESS</option>
                                        <option value="eName">ENAME</option>
                                        <option value="ePhone">EPHONE</option>
                                        <option value="eAdd">EADD</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-warning" name="search" tabindex="3">SEARCH</button>
                                <button type="button" class="btn btn-warning ms-2" name="reload" tabindex="4" onclick="reloadPage()"><i class="fa-solid fa-rotate-right"></i></button>
                            </form>
                            <div class="table-responsive text-center" style="width: 1039px;">
                                <table class="table table-sm table-bordered mt-3">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">HIRED</th>
                                            <th scope="col">LAST</th>
                                            <th scope="col">FIRST</th>
                                            <th scope="col">MIDDLE</th>
                                            <th scope="col">SUFFIX</th>
                                            <th scope="col">BIRTHDAY</th>
                                            <th scope="col">AGE</th>
                                            <th scope="col">GENDER</th>
                                            <th scope="col">EMAIL</th>
                                            <th scope="col">PHONE</th>
                                            <th scope="col">STATUS</th>
                                            <th scope="col">SSS</th>
                                            <th scope="col">PHILHEALTH</th>
                                            <th scope="col">JOB</th>
                                            <th scope="col">RATE</th>
                                            <th scope="col">ADDRESS</th>
                                            <th scope="col">ENAME</th>
                                            <th scope="col">EPHONE</th>
                                            <th scope="col">EADD</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-group-divider text-center">
                                        <tr>
                                            <?php
                                            if(isset($_SESSION['bar']) && (isset($_SESSION['filter']))){
                                                $search = $_SESSION['bar'];
                                                $filter = $_SESSION['filter'];
                                                unset($_SESSION['bar']);
                                                unset($_SESSION['filter']);
                                                searchEmp($search, $filter);
                                            }else{
                                                tableEmp();
                                            }
                                            ?>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
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