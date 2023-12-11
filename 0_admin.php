<?php
session_start();
require ('private/database.php');
require ('private/functions.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAYROLL SYSTEM</title>
    <link rel="icon" type="image/x-icon" href="private/images/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="private/styles.css">
    <script text="text/javascript" src="private/script.js"></script>
</head>
<body>
    <div class="bg-success d-flex flex-column" style="height: 100vh;">
        <nav class="navbar bg-success-subtle d-flex flex-column">
            <div class="container-fluid">
                <a class="navbar-brand" href="homepage.php">
                <img src="private/images/logo.png" alt="Logo" class="img-fluid d-inline-block" style="width: 8%;">
                <h4 class="d-inline-block">AL DA'WAH PRODUCERS COOPERATIVE</h4>
                </a>
            </div>
        </nav>
        <div class="container p-3">
            <h1 class="text-white border-bottom d-inline-block">REGISTER ADMIN</h1>
            <?php
            if(isset($_SESSION['success'])){
                echo '<div class="alert alert-success" role="alert">
                Successfuly added admin.
                </div>';
                unset($_SESSION['success']);
            }else if(isset($_SESSION['error5'])){
                echo '<div class="alert alert-danger" role="alert">
                Failed to add admin. Try again.
                </div>';
                unset($_SESSION['error5']);
            }
            ?>
            <h4 class="text-white border-bottom mt-3">PERSONAL INFORMATION</h4>
            <form method="POST" enctype="multipart/form-data" id="myForm" action="private/0_admin_process.php">
                <div class="row my-3">
                    <div class="col-sm-3 text-center bg-white rounded p-3">
                        <img src="private/images/user.png" class="img-fluid mx-auto" id="preview" style="max-height: 200px;">
                    </div>
                    <div class="col-sm d-flex flex-column">
                        <h2 class="text-white mt-auto">UPLOAD ADMIN IMAGE:</h2>
                        <input type="file" name="image" id="image" onchange="previewImage(event)" class="form-control mb-auto" accept=".jpg, .jpeg, .png" required>
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
                            <input type="text" class="form-control" name="add2" oninput="letters(this)" tabindex="1" required>
                        </div>
                        <div class="input-group mt-2">
                            <span class="input-group-text">SUFFIX</span>
                            <input type="text" class="form-control" name="add5" oninput="letters(this)" tabindex="4">
                        </div>
                        <div class="input-group mt-2">
                            <label class="input-group-text" for="gender">GENDER</label>
                            <select class="form-select" name="add8" tabindex="7" required>
                                <option value="" disabled selected></option>
                                <option value="MALE">MALE</option>
                                <option value="FEMALE">FEMALE</option>
                            </select>
                        </div>
                        <div class="input-group mt-2">
                            <label class="input-group-text" for="status">CIVIL STATUS</label>
                            <select class="form-select" name="add11" tabindex="10" required>
                                <option value="" disabled selected></option>
                                <option value="SINGLE">SINGLE</option>
                                <option value="MARRIED">MARRIED</option>
                                <option value="DIVORCED">DIVORCED</option>
                            </select>
                        </div>
                        <div class="input-group mt-2">
                            <label class="input-group-text" for="job">DESIGNATION</label>
                            <select class="form-select" name="add14" tabindex="13" required>
                                <option value="" disabled selected></option>
                                <option value="FARMER">FARMER</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="input-group">
                            <span class="input-group-text">FIRST NAME</span>
                            <input type="text" class="form-control" name="add3" oninput="letters(this)" tabindex="2" required>
                        </div>
                        <div class="input-group mt-2">
                            <span class="input-group-text">BIRTHDAY</span>
                            <input type="date" class="form-control" name="add6" tabindex="5" required>
                        </div>
                        <div class="input-group mt-2">
                            <span class="input-group-text">EMAIL</span>
                            <input type="email" class="form-control" name="add9" oninput="up(this)" tabindex="8" required>
                        </div>
                        <div class="input-group mt-2">
                            <span class="input-group-text">SSS NUMBER</span>
                            <input type="text" class="form-control" name="add12" oninput="num(this)" tabindex="11" required>
                        </div>
                        <div class="input-group mt-2">
                            <span class="input-group-text">RATE</span>
                            <input type="number" class="form-control" name="add15" tabindex="14" required>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="input-group">
                            <span class="input-group-text">MIDDLE NAME</span>
                            <input type="text" class="form-control" name="add4" oninput="letters(this)" tabindex="3" required>
                        </div>
                        <div class="input-group mt-2">
                            <span class="input-group-text">AGE</span>
                            <input type="number" class="form-control" name="add7" tabindex="6" required>
                        </div>
                        <div class="input-group mt-2">
                            <span class="input-group-text">PHONE NUMBER</span>
                            <input type="text" class="form-control" name="add10" oninput="num(this)" tabindex="9" required>
                        </div>
                        <div class="input-group mt-2">
                            <span class="input-group-text">PHILHEALTH NUMBER</span>
                            <input type="text" class="form-control" name="add13" oninput="num(this)" tabindex="12" required>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-sm">
                        <h4 class="text-white border-bottom">ADDRESS</h4>
                        <div class="input-group">
                            <span class="input-group-text">ADDRESS</span>
                            <input type="text" class="form-control" name="add16" oninput="up(this)" tabindex="15" required>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <h4 class="text-white border-bottom">EMERGENCY CONTACT</h4>
                    <div class="col-sm">
                        <div class="input-group">
                            <span class="input-group-text">FULL NAME</span>
                            <input type="text" class="form-control" name="add17" oninput="letters(this)" tabindex="16" required>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="input-group">
                            <span class="input-group-text">PHONE NUMBER</span>
                            <input type="text" class="form-control" name="add18" oninput="num(this)" tabindex="17" required>
                        </div>
                    </div>
                </div>
                <div class="input-group mt-2">
                    <span class="input-group-text">ADDRESS</span>
                    <input type="text" class="form-control" name="add19" oninput="up(this)" tabindex="18" required>
                </div>
                <div>
                    <div class="d-flex mt-3">
                        <button type="submit" class="btn btn-warning ms-auto" name="add" tabindex="19">ADD ADMIN</button>
                        <button type="button" class="btn btn-warning ms-2" onclick="clearForm()" tabindex="20">CLEAR</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>