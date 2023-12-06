<?php
include ('../../includes/employee/header.php');
?>
                    <div class="container-fluid p-3">
                        <h1 class="text-white border-bottom d-inline-block">CHANGE PASSWORD</h1>
                        <form method="post" action="../../private/changePass_process.php" id="myForm">
                            <div class="input-group mt-3">
                                <span class="input-group-text">OLD PASSWORD</span>
                                <input type="password" class="form-control" placeholder="OLD PASSWORD" name="old" tabindex="1" required>
                            </div>
                            <div class="input-group mt-2">
                                <span class="input-group-text">NEW PASSWORD</span>
                                <input type="password" class="form-control" placeholder="NEW PASSWORD" name="new" id="new" tabindex="2" oninput="checkPassword()" required>
                            </div>
                            <div class="input-group mt-2">
                                <span class="input-group-text">CONFIRM PASSWORD</span>
                                <input type="password" class="form-control" placeholder="CONFIRM PASSWORD" name="confirm" id="confirm" tabindex="3" oninput="checkPassword()" required>
                            </div>
                            <div class="alert alert-success mt-3" id="success" role="alert" hidden>
                            Password is the same.
                            </div>
                            <div class="alert alert-danger mt-3" id="fail" role="alert" hidden>
                                Password is not the same.
                            </div>
                            <?php
                            if(isset($_SESSION['success'])){
                                echo '<div class="alert alert-success mt-3" role="alert">
                                        Successfully changed the password.
                                    </div>';
                                    unset($_SESSION['success']);
                            }else if(isset($_SESSION['error'])){
                                echo '<div class="alert alert-danger mt-3" role="alert">
                                    Error. Try again.
                                    </div>';
                                    unset($_SESSION['error']);
                            }else if(isset($_SESSION['error1'])){
                                echo '<div class="alert alert-danger mt-3" role="alert">
                                    Wrong password. Try again.
                                    </div>';
                                    unset($_SESSION['error1']);
                            }else if(isset($_SESSION['error2'])){
                                echo '<div class="alert alert-danger mt-3" role="alert">
                                    Old password and new password is the same. Change to a new one.
                                    </div>';
                                    unset($_SESSION['error2']);
                            }
                            ?>
                            <div class="d-flex mt-3">
                                <button type="submit" class="btn btn-warning ms-auto" name="change" id="change" tabindex="4" disabled>CHANGE PASSWORD</button>
                                <button type="button" class="btn btn-warning ms-2" onclick="clearForm()" tabindex="5">CLEAR</button>
                            </div>
                        </form>
                    </div>
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                        let pill = document.getElementById("password");
                        password.classList.remove('text-black');
                        password.className += " bg-success text-white active";
                    });
                    </script>
<?php
include ('../../includes/employee/footer.php');
?>