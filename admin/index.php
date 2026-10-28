<?php
session_start();
if(isset($_SESSION['admin_online'])){
    header("location:dashboard.php");
    exit;
}else{
    header("location:login.php");
    exit;
}

?>