<?php
session_start();
require ('../private/database.php');
require ('../private/functions.php');

if(isset($_POST['select'])){
    $category = $_POST['category'];
    if ($category === 'EMPLOYEE'){
        echo header('Location: ../public/admin/addEmp.php');
    }else if($category === 'ON-CALL'){
        echo header('Location: ../public/admin/addOnCall.php');
    }
}
?>