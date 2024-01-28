<?php
include ('../../includes/admin/header.php');
?>

                    <div class="container-fluid p-3">
                        <div class="container bg-light my-auto rounded p-3" style="width: 25%;">
                            <form method="POST" id="myForm" action="private/login_process.php">
                                <h2 class="border-bottom border-success">LOGIN</h2>
                                <div class="input-group mt-3">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-user"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Username" name="username" tabindex="1" required>
                                </div>
                                <div class="input-group mt-3 mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-lock"></i>
                                    </span>
                                    <input type="password" class="form-control" placeholder="Password" name="password" tabindex="2" required>
                                </div>
                                <?php
                                if(isset($_SESSION['alert'])){
                                    echo '<div class="alert alert-danger mt-2" role="alert">
                                        Invalid Username or Password.
                                        </div>';
                                    unset($_SESSION['alert']);
                                }else if (isset($_SESSION['auth'])) {
                                    echo '<div class="alert alert-danger mt-2" role="alert">
                                        Log-in first.
                                        </div>';
                                    unset($_SESSION['auth']);
                                }
                                ?>
                                <div class="d-flex mt-2">
                                    <button type="submit" class="btn btn-success ms-auto" name="login" tabindex="5">Login</button>
                                    <button type="button" class="btn btn-success ms-2" onclick="clearForm()" tabindex="6">Clear</button>
                                </div>
                            </form>
                        </div>
                    </div>
<?php
include ('../../includes/admin/footer.php');
?>