
<?php   
session_start();
require_once "../classes/User.php";

$us = new User;

if(!isset($_SESSION["user_online"])){
     $rsp = [
        "status" => false,
        "message" => "you need to be logged in"
    ];
    echo json_encode($rsp);
    exit;
}

if(isset($_FILES['pix'])){
    $fname=$_FILES['pix']['name'];
    $ftmp=$_FILES['pix']['tmp_name'];
    $ferror=$_FILES['pix']['error'];
    $fsize=$_FILES['pix']['size'];

    if($ferror){
        $rsp = [
        "status" => false,
        "message" => "Please Upload a valid file"
        ];
        echo json_encode($rsp);
        exit;

    
    }

    $max_size = 5*1024*1024;

    if($fsize>$max_size) {
       $rsp = [
        "status" => false,
        "message" => "File is too large. Maximum accepted is 5mb"
        ];
        echo json_encode($rsp);
        exit;

    }

    $allowed=['png','jpg','gif','jpeg'];
    $user_ext=strtolower(pathinfo($fname,PATHINFO_EXTENSION));

    if(!in_array($user_ext,$allowed)) {
      $rsp = [
        "status" => false,
        "message" => "Only image with extension png, jpg, gif and jpeg are allowed"
    ];
    echo json_encode($rsp);
    exit;

    }

    $unique_filename=uniqid("realestate_").time().".".$user_ext;
    $destination = "uploads/$unique_filename";
    $res=move_uploaded_file($ftmp,"../$destination");

    if($res) {
        // insert into database and send back response
        $us->save_filename($destination, $_SESSION['user_online']);
        $rsp = [
            "status" => true,
            "message" => $destination
        ];
        echo json_encode($rsp);
        exit();

    }else{
        $rsp = [
        "status" => false,
        "message" => "Unable to upload image"
    ];
    echo json_encode($rsp);
    exit;
    }
}else{
    $rsp = [
        "status" => false,
        "message" => "You must select a file"
    ];
    echo json_encode($rsp);
    exit;
}

?>