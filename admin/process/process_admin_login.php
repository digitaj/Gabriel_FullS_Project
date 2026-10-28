<?php
    session_start();
    require_once "../classes/Admin.php";
    $admin = new Admin;
    if(isset($_POST['btnadmin'])){
        // retrieve form data
        $email = $_POST['email'];
        $password = $_POST['password'];
        $rsp = $admin -> admin_login($email, $password);
        if($rsp){// login was successful
            $_SESSION['admin_online'] = $rsp;
            header("location:../dashboard.php");
            exit;
        }else{
            header("location:../login.php");
            exit;
        }


    }else{
        $_SESSION['admin_error'] = "Complete the form";
        header("location:../login.php");
        exit;
    }
?>