<?php
    session_start();
    require_once "classes/Admin.php";

    $admin = new Admin;

    $admin->admin_logout();

    header("location:login.php");
    exit;
?>