<?php
session_start();
include "../database/connection.php";


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // echo 1; exit;
    $id = $_POST['id'];
    // echo $id; exit;
    $query = "DELETE FROM `adminsignin` WHERE `id` = '$id'";
    $result = mysqli_query($conn, $query);

    if($result){
        $error = array('status' => 200, 'message' => 'admin deleted successfully');
        echo json_encode($error);
    } else {
        $error = array('status' => 404, 'message' => 'records does not exist');
        echo json_encode($error);
    }

}
mysqli_close($conn);
?>