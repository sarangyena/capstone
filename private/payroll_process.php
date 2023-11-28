<?php
session_start();
require ('database.php');

if(isset($_POST['compute'])){
    $username = $_POST['select'];
    for($i = 1; $i <= 12; $i++){
        ${'payroll'.$i} = $_POST['payroll'.$i];
    }
    
}
?>