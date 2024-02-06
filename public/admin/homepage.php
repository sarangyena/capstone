<?php
include ('../../includes/admin/header.php');
status();
?>
                    <div class="container-fluid text-white p-3">
                        <h1 class="border-bottom text-center py-2">HOMEPAGE</h1>
                        <div class="row" style="height: 150px;">
                            <div class="col bg-white border border-black rounded-2 text-black"> 
                                <h3 class="text-center border-bottom border-black">TOTAL EMPLOYEES</h3>
                                <?php
                                $stmtEmp = $conn->prepare('SELECT * FROM employee');
                                $stmtEmp->execute();
                                $employee = $stmtEmp->rowCount();
                                $stmtOnCall = $conn->prepare('SELECT * FROM oncall');
                                $stmtOnCall->execute();
                                $oncall = $stmtOnCall->rowCount();
                                $total = $employee+$oncall;
                                echo '<h1 class="text-center mt-4">'.$total.'</h1>';
                                ?>
                            </div>
                            <div class="col bg-white border border-black mx-2 rounded-2 text-black">
                                <h3 class="text-center border-bottom border-black">ACTIVE</h3>
                                <?php
                                $stmtActive = $conn->prepare('SELECT status FROM dashboard WHERE status = "ACTIVE"');
                                $stmtActive->execute();
                                $totalActive = $stmtActive->rowCount();
                                echo '<h1 class="text-center mt-4">'.$totalActive.'</h1>';
                                ?>
                            </div>
                            <div class="col bg-white border border-black rounded-2 text-black">
                                <h3 class="text-center border-bottom border-black">INACTIVE</h3>
                                <?php
                                $stmtInactive = $conn->prepare('SELECT status FROM dashboard WHERE status = "INACTIVE"');
                                $stmtInactive->execute();
                                $totalInactive = $stmtInactive->rowCount();
                                echo '<h1 class="text-center mt-4">'.$totalInactive.'</h1>';
                                ?>
                            </div>
                        </div>
                        <form method="POST" class="d-flex mt-3" action="../../private/search_process.php">
                                <div class="input-group">
                                    <span class="input-group-text">SEARCH</span>
                                    <input type="search" class="form-control" name="homepageBar" oninput="up(this)" tabindex="1" required>
                                </div>
                                <div class="input-group mx-2 ">
                                    <label class="input-group-text">FILTER</label>
                                    <select class="form-select" name="homepageFilter" tabindex="2" required>
                                        <option value="" disabled selected></option>
                                        <option value="id">ID</option>
                                        <option value="name">NAME</option>
                                        <option value="job">JOB</option>
                                        <option value="dateIn">DATE-IN</option>
                                        <option value="timeIn">TIME-IN</option>
                                        <option value="dateOut">DATE-OUT</option>
                                        <option value="timeOut">TIME-OUT</option>
                                        <option value="status">STATUS</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-warning" name="search" tabindex="3">SEARCH</button>
                                <button type="button" class="btn btn-warning ms-2" name="reload" tabindex="4" onclick="reloadPage()"><i class="fa-solid fa-rotate-right"></i></button>
                            </form>
                            <h2 class="text-center mt-3 border-bottom">ATTENDANCE RECORD</h2>
                            <div class="row">
                                <div class="col">
                                    <h3 class="text-center mt-3 border-bottom">EMPLOYEES</h3>
                                    <?php
                                    dashboardEmp();
                                    ?>
                                </div>
                                <div class="col">
                                    <h3 class="text-center mt-3 border-bottom">ON-CALL</h3>
                                    <?php
                                    dashboardOnCall();
                                    ?>
                                </div>
                            </div>
                        
                    </div>
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                        let pill = document.getElementById("homepage");
                        homepage.classList.remove('text-black');
                        homepage.className += " bg-success text-white active";
                    });
                    </script>
<?php
include ('../../includes/admin/footer.php');
?>