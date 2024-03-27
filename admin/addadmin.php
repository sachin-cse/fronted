<?php
session_start();
include "../database/connection.php";
include "../Helper/Apphelper.php";


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $firstname = $_POST['first_name'];
    $lastname = $_POST['last_name'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $status = $_POST['status'];
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

    // upload image
    if(isset($image)){
        $image = $image;
    } else {
        $image = null;
    }

    $query = "SELECT * FROM `adminsignin` WHERE `email` = '$email'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0){
        echo (json_encode(array('message' => 'Email already exist please choose another one', 'status' => 200)));
    } else {
        $sql = "INSERT INTO adminsignin (first_name, last_name, email, status, profile_image, role, password, last_login) VALUES ('$firstname', '$lastname', '$email', '$status', '$image', '$role', '$password', null)";
        $runQuery = mysqli_query($conn, $sql);

        if($runQuery){
            $folder = './upload/' . $image;
            move_uploaded_file($tempname, $folder);
            echo (json_encode(array('message' => 'Added successfully', 'status' => 201)));
        } else {
            echo (json_encode(array('message' => 'Something went wrong', 'status' => 500)));
        }
    }
}
?>