<?php
session_start();
require ('../../private/database.php');
require ('../../private/functions.php');
checkAuthentication();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAYROLL SYSTEM</title>
    <link rel="icon" type="image/x-icon" href="../../private/images/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="../../private/styles.css">
    <script text="text/javascript" src="../../private/script.js"></script>
</head>
<body>
    <div class="bg-success d-flex flex-column" style="height: 100vh;">
        <nav class="navbar bg-success-subtle d-flex flex-column">
            <div class="container-fluid">
                <a class="navbar-brand" href="homepage.php">
                <img src="../../private/images/logo.png" alt="Logo" class="img-fluid d-inline-block" style="width: 8%;">
                <h4 class="d-inline-block">AL DA'WAH PRODUCERS COOPERATIVE</h4>
                </a>
                <?php
                displayName();
                ?>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="row">
                <div class="col-2 d-flex flex-column">
                    <div class="container bg-white rounded-bottom p-3">
                        <ul class="nav nav-pills d-flex flex-column">
                            <li class="nav-item">
                                <a class="nav-link text-center text-black" id="homepage" href="homepage.php">HOMEPAGE</a>
                            </li>
                            <li class="nav-item mt-3">
                                <a class="nav-link text-center text-black" id="report" href="report.php">SALARY REPORT</a>
                            </li>
                            <li class="nav-item mt-3">
                                <a class="nav-link text-center text-black" id="about" href="about.php">ABOUT</a>
                            </li>
                            <li class="nav-item mt-3">
                                <a class="nav-link text-center text-black" id="password" href="changePass.php">CHANGE PASSWORD</a>
                            </li>
                            <li class="nav-item mt-3">
                                <a class="nav-link text-center text-black" id="out" href="../../private/out_process.php">LOG OUT</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col">