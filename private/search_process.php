<?php
session_start();
require ('../private/database.php');
if(isset($_POST['bar']) && (isset($_POST['filter']))){
    $search = $_POST['bar'];
    $filter = $_POST['filter'];
    $_SESSION['bar'] = $search;
    $_SESSION['filter'] = $filter;
    echo header('Location: ../public/admin/viewEmp.php');
    exit();
}

?>