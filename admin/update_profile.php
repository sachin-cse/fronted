<?php

session_start();
include "../database/connection.php";
include "../Helper/Apphelper.php";

if(isset($_POST['hidden_id'])){
    $id = $_POST['hidden_id'];
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $status = $_POST['status'];
    // echo $status; exit;
    $role = $_POST['role'];
    $image = isset($_FILES['file']['name']) ? $_FILES['file']['name'] :'';
    $tempname = isset($_FILES["file"]["tmp_name"]) ? $_FILES["file"]["tmp_name"] : '';

    $uploadFolder = "./upload/";

    // Check if 'upload' folder exists inside 'admin'
    if (!file_exists($uploadFolder)) {
        if (!mkdir('./upload/', 0777, true) && !is_dir('./upload/')) {
            // Handle the error, e.g., display an error message and exit
            echo "Failed to create directory: $uploadFolder";
            exit;
        }
    }

    if(!empty($image)){

    $folder = './upload/' . $image;
    $update_profile = "UPDATE `adminsignin`
    SET `profile_image` = '$image', `first_name` = '$fname', `last_name` = '$lname', `status` = '$status', `role` = '$role' WHERE `id` = '$id'";

    $run_query = mysqli_query($conn, $update_profile);

    if($run_query){
        move_uploaded_file($tempname, $folder);
        echo (json_encode(array('message' => 'profile updated successfully', 'status' => 200)));
    } else {
        echo (json_encode(array('message' => mysqli_error($conn), 'status' => 500)));
    }
} else {
    $image = isset($_FILES['hidden_image']['name']) ? $_FILES['hidden_image']['name'] : '';
    $tempname = isset($_FILES["hidden_image"]["tmp_name"]) ? $_FILES["hidden_image"]["tmp_name"]: '';
    $folder = "./upload/" . $image;
    move_uploaded_file($tempname, $folder);
    $update_profile = "UPDATE `adminsignin`
    SET `first_name` = '$fname', `last_name` = '$lname', `status` = '$status' WHERE `id` = '$id'";
    mysqli_query($conn, $update_profile);
    echo (json_encode(array('message' => 'profile updated successfully', 'status' => 200)));
}
    
} 

mysqli_close($conn);
?>