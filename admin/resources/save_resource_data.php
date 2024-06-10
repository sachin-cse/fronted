<?php
include($_SERVER['DOCUMENT_ROOT'].'/fronted/database/connection.php');
include(dirname(dirname(__FILE__)).'\Helper\Apphelper.php');

if($_SERVER["REQUEST_METHOD"] == 'POST'){
    $createUserId = get_current_user_id();

    if($_POST['resource_data']??'' == 'save_resource_data'){

        $response['status'] = '';
        $response['message'] = '';

        $media_type = isset($_POST['media_type'])?$_POST['media_type']:'';
        $description = isset($_POST['description'])?$_POST['description']:'';
        $file_link = isset($_POST['file_link'])?$_POST['file_link']:'';
        $media_file = !empty($_FILES['media_file']['name']) ? $_FILES['media_file']['name'] :$_POST['existing_media_file'];
        // echo $media_file; exit;
        $file = !empty($file_link) ? $file_link:$media_file;
        $media_fileTemp = isset($_FILES["media_file"]["tmp_name"]) ? $_FILES["media_file"]["tmp_name"] : '';
        $hidden_id = isset($_POST['hidden_id'])? $_POST['hidden_id']:'';

        // server side validation
        if(empty($media_type)){
            $response['status'] = 500;
            $response['message'] = 'Please select your media type';
        }

        switch($media_type){
            case "file":
                $file_link ? '': $response['status'] = 500;
                $response['message'] = 'Please enter your media file link';
                break;
            case "video":
                $media_file ? '':$response['status'] = 500;
                $response['message'] = 'Please upload your video';
                break;
        }

        if($media_type == 'video'){
            $allow_ext = ['mp4', 'ogg', 'wav'];
            $ext = pathinfo($media_file, PATHINFO_EXTENSION);
            if(!in_array($ext, $allow_ext)){
                $response['status'] = 500;
                $response['message'] = 'Please upload only mp4, ogg, wav file extension';
            }
        }

        if(empty($description)){
            $response['status'] = 500;
            $response['message'] = 'Please enter your description';
        }

        if($response['status'] != '' && $response['message'] != ''){
            echo json_encode($response);
        }else{
            try{
                $uploadFolder = "./upload";

                if(!file_exists($uploadFolder)){
                    if (!mkdir('./upload', 0777, true) && !is_dir('./upload')) {
                        // Handle the error, e.g., display an error message and exit
                        echo "Failed to create directory: $uploadFolder";
                        exit;
                    }

                }

                if($hidden_id > 0){
                    $sql = "UPDATE `resources` SET `media_type` = '$media_type', `description` = '$description', `file_link` = '$file',
                    `updated_by` = '$createUserId' WHERE `id` = '$hidden_id'";
                } else {
                    $sql = "INSERT INTO resources (media_type, description, file_link, created_by) VALUES ('$media_type', '$description', '$file', '$createUserId')";
                }

                $runQuery = mysqli_query($conn, $sql);
                if(!$runQuery){
                    throw new Exception(mysqli_error($conn));
                }else{
                    $uploadFolder = "./upload/".$media_file;
            
                    move_uploaded_file($media_fileTemp, $uploadFolder);
                    echo (json_encode(array('message' => 'Data Save successfully', 'status' => 201)));
                }

            }catch(Exception $e){
                echo (json_encode(array('message' => $e->getMessage(), 'status' => 500)));
            }
        }

    }
}
?>