
<?php
session_start();
require_once "../admin_guard.php";
require_once "../classes/Common.php";
require_once "../classes/Admin.php";


// check if user has submitted the form
if (!isset($_POST["btnupload"])) {
    $_SESSION["error"] = "Unauthorized access.";
    header("Location: ../admin_category.php");
    exit();
}
  // 1. validate user input
     $fname = $_FILES["images"]["name"];
     $ftemp = $_FILES["images"]["tmp_name"];
     $ferror = $_FILES["images"]["error"];
     $fsize = $_FILES["images"]["size"];
    $allowed_ext = ["jpg", "jpeg", "png", "gif"];
    $pro_title = Common::dataclean($_POST["title"]);
    $pro_price = Common::dataclean($_POST["price"]);
    $pro_desc = Common::dataclean($_POST["description"]);
    $pro_size = Common::dataclean($_POST["size"]);
    $lga_id = Common::dataclean($_POST["lga"]);
    $listing_type_id = Common::dataclean($_POST["category"]);
    $property_type_id = Common::dataclean($_POST["type"]);
    $state_id = Common::dataclean($_POST["state"]);
    $admin_id = $_SESSION["admin_online"];
    


   
    if (empty($pro_title) || empty($pro_price) || empty($pro_desc) || empty($pro_size) || empty($lga_id) || 
    empty($listing_type_id) || empty($property_type_id) || empty($state_id)) {
        $_SESSION["error"] = "All fields are required.";
        header("Location: ../admin_category.php");
        exit();
    }
    if (!is_numeric($pro_price) || $pro_price <= 0) {
        $_SESSION["error"] = "Price must be a positive number.";
        header("Location: ../admin_category.php");
        exit();
    }
    // image validation logic
    $max_files = 5;
    $max_size = 5 * 1024 * 1024; // 5MB
    if(isset($_FILES["images"]) && !empty($_FILES["images"]["name"][0])){
        $files = $_FILES["images"];
        $file_count = count($_FILES["images"]["name"]);
        if($file_count > $max_files){
            $_SESSION["error"] = "You can upload a maximum of 5 images.";
            header("Location: ../admin_category.php");
            exit();
        }

        for ($i = 0; $i < $file_count; $i++) {
            $fname = $files["name"][$i];
            $ftemp = $files["tmp_name"][$i];
            $ferror = $files["error"][$i];
            $fsize = $files["size"][$i];

            if ($ferror === 0) {
                $file_ext = strtolower(pathinfo($fname, PATHINFO_EXTENSION));
                if (!in_array($file_ext, $allowed_ext)) {
                    $_SESSION["error"] = "Invalid file type for file: " . htmlspecialchars($fname) . ". Only JPG, JPEG, PNG, WEBP, and GIF are allowed.";
                    header("Location: ../admin_category.php");
                    exit();
                }
                if ($fsize > $max_size) {
                    $_SESSION["error"] = "File size exceeds the limit of 5MB for file: " . htmlspecialchars($fname);
                    header("Location: ../admin_category.php");
                    exit();
                }
            } else {
                $_SESSION["error"] = "Error uploading file: " . htmlspecialchars($fname);
                header("Location: ../admin_category.php");
                exit();
            }
        }
    } else {
        $_SESSION["error"] = "At least one image is required.";
        header("Location: ../admin_category.php");
        exit();
    }

    // 2. process the upload
    $property = new Admin();
    $property_id = $property->admin_upload_property($pro_title, $pro_desc, $pro_price, $pro_size, $admin_id, $property_type_id, $listing_type_id, $lga_id, $state_id);
    if ($property_id) {
        // handle image uploads
        $files = $_FILES["images"];
        $file_count = count($_FILES["images"]["name"]);
        for ($i = 0; $i < $file_count; $i++) {
            $fname = $files["name"][$i];
            $ftemp = $files["tmp_name"][$i];
            $ferror = $files["error"][$i];
            if ($ferror === 0) {
                $file_ext = strtolower(pathinfo($fname, PATHINFO_EXTENSION));
                $new_filename = uniqid("prop_", true) . "." . $file_ext;
                $upload_dir = "../uploads/";
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0755, true);
                }
                $destination = $upload_dir . $new_filename;
                if (move_uploaded_file($ftemp, $destination)) {
                    // save image path to database
                    $property->admin_upload_images($property_id, "uploads/" . $new_filename);
                }
            }
        }
        $_SESSION["feedback"] = "Property uploaded successfully.";
        header("Location: ../admin_category.php");
        exit();
    } else {
        $_SESSION["error"] = "Failed to upload property. Please try again.";
       header("Location: ../admin_category.php");
        exit();
    }
