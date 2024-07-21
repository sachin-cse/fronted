<?php

session_start();
include "../database/connection.php";

$email = isset($_POST['email']) ? $_POST['email'] :'';
$password = isset($_POST['password']) ? md5($_POST['password']) :'';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $sql = "SELECT `id`, `email`, `password`, `role`, `profile_image`, `status` FROM `adminsignin` WHERE `email` = '$email'";
    $result = mysqli_query($conn, $sql);
    // print_r($result); exit;
    $row = mysqli_fetch_array($result);

         // update login time
         date_default_timezone_set('Asia/Kolkata');
         $current_time = date('Y-m-d H:i:s');
         $logintime = "UPDATE `adminsignin` SET `last_login` = '$current_time' WHERE `email`  = '$email'";
        //  echo $logintime; exit;
         mysqli_query($conn, $logintime);

        if(mysqli_num_rows($result) > 0){
            $_SESSION['email'] = $email;
            
            $_SESSION['currentUser_id'] = $row['id'];
            $_SESSION['profile_pic'] = $row['profile_image'];
            $_SESSION['loginTime'] = $current_time;
            $_SESSION['userRole'] = $row['role'];
            // print_r($_SESSION['currentUser_id']); exit;

            if(!($row['status'] == 'inactive')){
                if ($password == $row['password']) {
                    $success = array('success' => 'Successfully login', 'status' => 200);
                    echo json_encode($success);
                } else {
                    $error = array('error' => 'Invalid credentials', 'status' => 404);
                    echo json_encode($error);
                }
            }
          else {
                $error = array('error' => 'Account temporary closed by administration', 'status' => 401);
                echo json_encode($error);
            }
        } else {
            $error = array('error' => 'Email does not exist', 'status' => 500);
            echo json_encode($error);
        }


}
mysqli_close($conn);
?>