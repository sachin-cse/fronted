<?php
include($_SERVER['DOCUMENT_ROOT'].'/fronted/database/connection.php');
include(dirname(dirname(__FILE__)).'\Helper\Apphelper.php');


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if($_POST['mode'] == 'save_pages'){
        // save pages
        // print_r($_FILES); exit;
        $id = $_POST['hidden_id'];
        $page_name = !empty($_POST['page_name']) ? $_POST['page_name'] :'';
        $page_slug = !empty($_POST['page_slug']) ? $_POST['page_slug']:'';
        $page_title = !empty($_POST['page_title']) ? $_POST['page_title']:'';
        $page_status = !empty($_POST['page_status']) ? $_POST['page_status']:'';
        $page_description = !empty($_POST['page_description']) ? $_POST['page_description']:'';
        $page_feature_image = isset($_FILES['page_feature_image']['name']) ? $_FILES['page_feature_image']['name'] :'';
        $feature_imageTemp = isset($_FILES["page_feature_image"]["tmp_name"]) ? $_FILES["page_feature_image"]["tmp_name"] : '';

        // seo data
        $meta_title = !empty($_POST['meta_title']) ? $_POST['meta_title']:'';
        $meta_keyword = !empty($_POST['meta_keyword']) ? $_POST['meta_keyword']:'';
        $meta_robots = $_POST['robot_index'].','.$_POST['robot_follow'];
        $meta_description = !empty($_POST['meta_description']) ? $_POST['meta_description']:'';
        $og_feature_image = isset($_FILES['og_feature_image']['name']) ? $_FILES['og_feature_image']['name'] :'';
        $og_imageTemp = isset($_FILES["og_feature_image"]["tmp_name"]) ? $_FILES["og_feature_image"]["tmp_name"] : '';

        try{
            if($id <= 0){
                $sql = "insert into `pages`(`page_name`, `page_slug`, `page_title`, `page_status`, `page_description`, `page_feature_image`) VALUES ('$page_name', '$page_slug', '$page_title', '$page_status', '$page_description', '$page_feature_image')";
            } else {
                $sql = "UPDATE `pages` SET `page_name` = '$page_name', `page_slug` = '$page_slug', `page_status` = '$page_status', `page_description` = '$page_description', `page_feature_image` = '$page_feature_image'  WHERE `page_id` = '$id'";
            }

            $uploadFolder = "./upload";

            if(!file_exists($uploadFolder)){
                if (!mkdir('./upload', 0777, true) && !is_dir('./upload')) {
                    // Handle the error, e.g., display an error message and exit
                    echo "Failed to create directory: $uploadFolder";
                    exit;
                }

            }


            $query = mysqli_query($conn, $sql);

            $getId = 0;
            if(!$query){
                throw new Exception(mysqli_error($conn));
            }

            $uploadFolder = "./upload/".$page_feature_image;
            
            move_uploaded_file($feature_imageTemp, $uploadFolder);

            if($id == 0){
                $getId = mysqli_insert_id($conn);
            }

            if($id==0 && $getId > 0){
                // seo insert
                $sql1 = "insert into `page_seo`(`page_id`, `meta_title`, `meta_keyword`, `meta_description`, `meta_robots`, `og_feature_image`) VALUES ('$getId', '$meta_title', '$meta_keyword', '$meta_description','$meta_robots', '$og_feature_image')";
            }else {
                // seo update
                $sql1 = "UPDATE `page_seo` SET `meta_title` = '$meta_title', `meta_keyword` = '$meta_keyword', `meta_description` = '$meta_description',`meta_robots`='$meta_robots', `og_feature_image` = '$og_feature_image' WHERE `page_id` = '$id'";
            }

            $query1 = mysqli_query($conn, $sql1);
            if(!$query1){
                throw new Exception(mysqli_error($conn));
            }else{
                $uploadFolder1 = "./upload/".$og_feature_image;
                move_uploaded_file($og_imageTemp, $uploadFolder1);
                echo json_encode(['status'=>200, 'message'=>'Page save successfully']);
            }
        }catch(Exception $e){
            echo json_encode(['status'=>500, 'message'=>$e->getMessage()]);
            // echo "Error: " . ;
        }
    }
}
?>