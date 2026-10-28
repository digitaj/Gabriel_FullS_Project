<?php
    session_start();
    require_once "classes/User.php";

    $dev = new User;
    $dev->logout();
    
    header("location:index.php");
    exit;
?>