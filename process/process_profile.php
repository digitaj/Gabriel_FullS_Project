
<?php
session_start();
require_once "../classes/Common.php";
require_once "../classes/User.php";

$us = new User;

 if(!isset($_SESSION['user_online'])){
        $response = ["status" => false, "message" => "Invalid Access"];
        echo Json_encode($response);
        exit();
    }

    if(!isset($_POST['firstname'])){
        $response = ["status" => false, "message" => "Pls submit the form"];
        echo Json_encode($response);
        exit(); 
    }

    // retrieve the data coming from request
    $fname = Common::dataclean($_POST['firstname']);
    $phone = Common::dataclean($_POST["phone_number"]);
    $lastname = Common::dataclean($_POST['lastname']);
    $role_id = $_POST['type'];

    //validation
    if(empty($fname) || empty($lastname) || empty($phone) || empty($role_id)){
         $response = ["status" => false, "message" =>"All fields are required"];
        echo Json_encode($response);
        exit();
    }

    
    //update the db

    $check = $us->update_profile($fname, $lastname, $phone, $role_id, $_SESSION['user_online']);
    if($check == true){
        $response = ["status" => true, "message" =>"Profile updated Successfully"];
        echo Json_encode($response);
        exit();
    }else{
        $response = ["status" => false, "message" =>"Error updating profile"];
        echo Json_encode($response);
        exit();
    }

?>