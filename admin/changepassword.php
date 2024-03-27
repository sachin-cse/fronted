<?php

session_start();
include "../database/connection.php";
include "../Helper/Apphelper.php";

if(isset($_POST['hidden_id'])){

    $newpassword = md5($_POST['newpassword']);
    $hiddenId = $_POST['hidden_id'];
    
    $update_password = "UPDATE `adminsignin`
    SET `password` = '$newpassword' WHERE `id` = '$hiddenId'";

    $run_query = mysqli_query($conn, $update_password);
    if($run_query){
        echo (json_encode(array('message' => 'password updated successfully', 'status' => 200)));
    } else {
        echo (json_encode(array('message' => 'Some went wrong', 'status' => 500)));
    }
} 

mysqli_close($conn);
?>