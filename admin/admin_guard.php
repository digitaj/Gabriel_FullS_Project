<?php

    if(!isset($_SESSION['admin_online'])){
        $_SESSION['admin_error'] = "You need admin access to view this page";
        header("location:login.php");
        exit;
    }

//    echo "<pre>";
//    print_r(password_hash("admin123", PASSWORD_DEFAULT));
//    echo "</pre>";
?>