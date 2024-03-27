<?php

session_start();
include "../database/connection.php";

if(isset($_POST['id'])){
    $id = $_POST['id'];
    // echo $id; exit;
    $sql = "SELECT * FROM `adminsignin` WHERE `id` = '$id' ";

    $result = mysqli_query($conn, $sql);

    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            // echo $row['first_name']; exit;
            $output[] = array (
                "first_name" => $row['first_name'],
                "last_name" => $row['last_name'],
                "email" => $row['email'],
                "status" => $row['status'],
                "role" => $row['role'],
                "profile_image" => $row['profile_image']
            );
        }
    
    echo json_encode($output);
    } else {
        header('HTTP/1.1 500 Internal Server Booboo');
        header('Content-Type: application/json; charset=UTF-8');
        echo (json_encode(array('message' => 'No records exist for this id', 'code' => 404)));
    }
} 
else {
    header('HTTP/1.1 500 Internal Server Booboo');
    header('Content-Type: application/json; charset=UTF-8');
    echo (json_encode(array('message' => 'Something went wrong', 'code' => 500)));
}

mysqli_close($conn);
?>