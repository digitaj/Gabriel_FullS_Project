
<?php
    session_start();
    require_once "../classes/Common.php";
    require_once "../classes/User.php";

    $re = new User;

    if(isset($_POST['btnlogin'])){
            $email = Common::dataclean($_POST['email']);
            $password = $_POST['password'];
            $response = $re->login($email,$password);
            if($response === false){
                header("location:../login.php?retuser=$email");
                exit();
            }else{// login is correct, save userid in session
                $_SESSION['user_online'] = $response;
                header("location:../index.php");
                exit();
            } 
    }else{
        $_SESSION['error'] = "Please complete the login form";
        header("location:../login.php");
       exit();
    }

?>