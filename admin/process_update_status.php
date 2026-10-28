<?php
session_start();
require_once "admin_guard.php";
require_once "classes/Admin.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $admin = new Admin();
    $user_id = $_POST['user_id'];
    $status = $_POST['status'];

    $result = $admin->update_user_status($user_id, $status);

    if ($result) {
        echo json_encode(['success' => true, 'message' => 'User Enabled or Disabled Successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error updating user status']);
    }
}
?>