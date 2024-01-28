<?php
session_start();
require('private/database.php');
require('private/functions.php');
checkAdmin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAYROLL SYSTEM</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.min.js" integrity="sha512-WW8/jxkELe2CAiE4LvQfwm1rajOS8PHasCCx+knHG0gBHt8EXxS6T6tJRTGuDQVnluuAvMxWF4j8SNFDKceLFg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" integrity="sha512-b2QcS5SsA8tZodcDtGRELiGv5SaKSk1vDHDaQRda0htPYWZ6046lr3kJ5bAAQdpV2mmA/4v0wQF9MyU6/pDIAg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" type="image/x-icon" href="private/images/logo.png">
    <link rel="stylesheet" type="text/css" href="private/styles.css">
    <script text="text/javascript" src="private/script.js"></script>
</head>
<body>
    <div class="bg-success d-flex flex-column" style="height: 100vh;">
        <nav class="navbar bg-success-subtle">
            <div class="container-fluid">
                <a class="navbar-brand" href="homepage.php">
                <img src="private/images/logo.png" alt="Logo" class="img-fluid d-inline-block" style="width: 8%;">
                <h4 class="d-inline-block">AL DA'WAH PRODUCERS COOPERATIVE</h4>
                </a>
            </div>
        </nav>
        
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
</body>
</html>