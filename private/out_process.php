<?php
session_start();

if (isset($_SESSION['user_id'])) {
    session_unset();
    session_destroy();

    header("Location: ../index.php");
    exit();
} else {
    echo "You are not logged in.";
}
?>