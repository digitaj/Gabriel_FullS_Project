
<?php
session_start();
require_once "../classes/Common.php";
require_once "../classes/User.php";

$re = new User;

if(isset($_POST["btnreg"])) {
        $firstname = Common::dataclean($_POST["firstname"]);
        $lastname =  Common::dataclean($_POST["lastname"]);

        $email = ($_POST['email']);
        $phone_number = Common::dataclean($_POST["phone_number"]);
        $password = Common::dataclean($_POST["password"]);
          
        
        if(Common::is_email($email === false)){
             $_SESSION['error'] = "Email is not valid";
            header("location:../register.php");
             exit();
        }elseif(empty($firstname) || empty($lastname) || empty($phone_number)) {
             $_SESSION['error'] = "Please complete the form";
             header("location:../register.php"); 
             exit();
        }elseif($re->check_email($email) > 0){
             $_SESSION['error'] = "This email address already exit";
             header("location:../register.php"); 
             exit();
        }elseif(strlen($password) <= 7 && empty($password)){
             $_SESSION['error'] = "Password must be 8 charater";
             header("location:../register.php"); 
             exit();
        }else{
            $response = $re->register_user($firstname, $lastname, $email, $phone_number, $password);
             $_SESSION['feedback'] = "Registration successful, you can now login";
            header("location:../login.php");
            
        }
}else{
        $_SESSION['error'] = "You need to complete the form";
            header("location:../register.php");
        exit();
    }



?>