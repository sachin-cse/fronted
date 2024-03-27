<?php include "./database/connection.php"; ?>

<?php
session_start();
if(isset($_POST['update_profile'])){

    // if($_POST['update_profile'] == ''){
    //     $image = $_POST['hidden_profile_img'];
    //     $tempname = $_FILES["hidden_profile_img"]["tmp_name"];
    // } else {
    //     $image = $_FILES['update_profile']['name'];
    //     $tempname = $_FILES["update_profile"]["tmp_name"];

    // }
    if(!empty($_FILES['update_profile']['name'])){

        $image = isset($_FILES['update_profile']['name']) ? $_FILES['update_profile']['name'] :'';
        $tempname = isset($_FILES["update_profile"]["tmp_name"]) ? $_FILES["update_profile"]["tmp_name"] : '';

        $usrId = $_POST['usrId'];

        $folder = "./upload/" . $image;
        // print_r($folder);
        $update_profile = "UPDATE `register` SET `profile_pic` = '$image' WHERE `id` = '$usrId'";
    
        $run_query = mysqli_query($conn, $update_profile);
    
        // print_r($image); exit;
    
        if($run_query){
            move_uploaded_file($tempname, $folder);
            echo "<script>alert('Profile pic update successful'); window.location='dashboard.php';</script>";
        } else {
            echo "Query Failed: " . mysqli_error($conn);
        }
    } else {
        // $image = $_POST['hidden_profile_img'];
        $image = isset($_FILES['hidden_profile_img']['name']) ? $_FILES['hidden_profile_img']['name'] : '';
        $tempname = isset($_FILES["hidden_profile_img"]["tmp_name"]) ? $_FILES["hidden_profile_img"]["tmp_name"]: '';
        $folder = "./upload/" . $image;
        move_uploaded_file($tempname, $folder);
        echo "<script>alert('Profile pic update successful'); window.location='dashboard.php';</script>";
    }

}

mysqli_close($conn);
?>
