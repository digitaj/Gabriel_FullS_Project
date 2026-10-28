
<?php
  require_once "../classes/Admin.php";
  
    $state_id = $_GET["state_id"];
   
    $lg = new Admin;
    $lgs = $lg->fetch_local_govt_by_state($state_id);
             

    $list = '<option value="">Select Location</opton>';

    foreach($lgs as $lg){
           $lgid = $lg["lga_id"];
          $cure = "<option value='".$lg["lga_id"]."'>".$lg["lga_name"]."</option>";
          $list = $list . $cure;
    }

    echo $list;
   
    // 
?>