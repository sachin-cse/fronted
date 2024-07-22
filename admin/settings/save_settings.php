<?php
include($_SERVER['DOCUMENT_ROOT'].'/fronted/database/connection.php');
include(dirname(dirname(__FILE__)).'\Helper\Apphelper.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $createUserId = get_current_user_id();

    if($_POST['general_setting']??'' == 'save_general_setting'){
        // validation message
        $response['status'] = '';
        $response['message'] = '';
        // echo "Hare Krishna"; exit;
        $hidden_id = isset($_POST['hidden_id']) ? $_POST['hidden_id'] : '';
        $og_image = isset($_FILES['og_image']['name']) ? $_FILES['og_image']['name'] :'';
        $og_imageTemp = isset($_FILES["og_image"]["tmp_name"]) ? $_FILES["og_image"]["tmp_name"] : '';

        $existing_og_image = !empty($_POST['existing_og_image']) ? $_POST['existing_og_image'] : $og_image;

        $footer_phone = $_POST['footer_phone']??'';
        $meta_title = $_POST['meta_title']??'';
        $meta_description = mysqli_real_escape_string($conn,$_POST['meta_description']??'');
        $meta_keywords = $_POST['meta_keywords'];
        $metarobots = $_POST['robot_index'].','.$_POST['robot_follow'];
        $script_title = $_POST['script_title']??'';
        $script_description = mysqli_real_escape_string($conn,$_POST['script_description']??'');

        if(empty($meta_title)){
            $response['status'] = 500;
            $response['message'] = 'Please enter meta title';
        } else if(!preg_match("/^([a-zA-Z' ]+)$/",$meta_title)){
            $response['status'] = 500;
            $response['message'] = 'Please enter meta title properly';
        }

        if(empty($meta_description)){
            $response['status'] = 500;
            $response['message'] = 'Please enter meta description';
        }

        // image validation
        $allowed_image_extension = ['jpg', 'png', 'jpeg'];
        $file_extension = pathinfo($_FILES["og_image"]["name"], PATHINFO_EXTENSION);

        if(!empty($og_image)){
            if(!in_array($file_extension, $allowed_image_extension)){
                $response['status'] = 500;
                $response['message'] = 'Upload valid images. Only JPG, PNG and JPEG are allowed.';
            } 
            else if(($_FILES["og_image"]["size"] > 200 * 1024)){
                $response['status'] = 500;
                $response['message'] = 'Image size exceeds 200kb';
            }
        }

        if(empty($existing_og_image)){
            $response['status'] = 500;
            $response['message'] = 'Please upload og image';
        }

        if(empty($meta_keywords)){
            $response['status'] = 500;
            $response['message'] = 'Please enter meta keywords';
        } else if(!preg_match("/^([a-zA-Z' ]+)$/",$meta_keywords)){
            $response['status'] = 500;
            $response['message'] = 'Please enter meta keywords properly';
        }

        if(empty($metarobots)){
            $response['status'] = 500;
            $response['message'] = 'Please select meta robots';
        }


        if(empty($script_title)){
            $response['status'] = 500;
            $response['message'] = 'Please enter script title';
        } else if(!preg_match("/^([a-zA-Z' ]+)$/",$script_title)){
            $response['status'] = 500;
            $response['message'] = 'Please enter script title properly';
        }

        if(empty($script_description)){
            $response['status'] = 500;
            $response['message'] = 'Please enter script description';
        }


        if($response['status'] != '' && $response['message'] != ''){
          
            echo json_encode($response);
        } else {
            try{
                $uploadFolderogImage = "./upload/og_image";

                if(!file_exists($uploadFolderogImage)){
                    if (!mkdir('./upload/og_image', 0777, true) && !is_dir('./upload/og_image')) {
                        // Handle the error, e.g., display an error message and exit
                        echo "Failed to create directory: $uploadFolderSiteLogo";
                        exit;
                    }
                }
            
                // Check if there's an existing favicon with the same filename and unlink it
                if (!empty($existing_og_image) && $og_image && $og_image != $existing_og_image) {
                    $existingogImagePath = "./upload/og_image/" . $existing_og_image;
                    if (file_exists($existingogImagePath)) {
                        unlink($existingogImagePath);
                    }
                }

                $ogImageupdateorNot =  $og_image ? $og_image:$existing_og_image;
                if(!empty($hidden_id)){
                    $sql = "UPDATE `general_settings` SET `site_meta_title` = '$meta_title', `site_meta_description` = '$meta_description', `site_meta_keywords` = '$meta_keywords', `site_meta_robots` = '$metarobots', `site_script_title` = '$script_title', `site_script_description` = '$script_description', `site_og_image` = '$ogImageupdateorNot', `create_user` = '$createUserId' WHERE `id` = '$hidden_id'";
                } else {
                    $sql = "INSERT INTO general_settings (site_meta_title, site_meta_description, site_meta_keywords, site_meta_robots, site_script_title, site_script_description, site_og_image, create_user) VALUES ('$meta_title', '$meta_description', '$meta_keywords', '$metarobots', '$script_title', '$script_description', '$ogImageupdateorNot', '$createUserId')";
                }

                $runQuery = mysqli_query($conn, $sql);
                if($runQuery){

                    $uploadFolderogImage = "./upload/og_image/" . $og_image;
            
                    move_uploaded_file($og_imageTemp, $uploadFolderogImage);
                    echo (json_encode(array('message' => 'general Settings Save successfully', 'status' => 201)));
                } else {
                    echo (json_encode(array('message' => 'Fail to save general settings', 'status' => 500)));
                }
            }
            catch(\Exception $e){
                echo (json_encode(array('message' => $e->getMessage(), 'status' => 500)));
            }
        }
    } else if($_POST['social_setting']??'' == 'save_social_setting'){
        $response['status'] = '';
        $response['message'] = '';
        foreach($_POST['social_link_name'] as $key=>$value){
            if(empty($_POST['social_link_name'][$key]) && empty($_POST['social_link'][$key]) && empty($_POST['social_link_icon'][$key]) && empty($_POST['social_link_class'][$key])){
                $response['status'] = 500;
                $response['message'] = 'Please fill each field';
            }
        }

        if($response['status'] != '' && $response['message'] != ''){
            echo json_encode($response);
        } else {
            foreach($_POST['social_link_name'] as $key=>$value){
                $socialData[] = ['social_link_name' =>$_POST['social_link_name'][$key], 'social_link' =>$_POST['social_link'][$key], 'social_link_icon' =>$_POST['social_link_icon'][$key], 'social_link_class'=>$_POST['social_link_class'][$key]];
            }

            if($_POST['hidden_id'] > 0){
                $sql = "UPDATE `social_settings` SET `social_links` = '".json_encode($socialData)."',`create_user` = '$createUserId' WHERE `id` = '".$_POST['hidden_id']."'";
            } else {
                $sql = "INSERT INTO social_settings (social_links, create_user) VALUES ('".json_encode($socialData)."', '$createUserId')";
            }

            $runQuery = mysqli_query($conn, $sql);

            if($runQuery){
                echo (json_encode(array('message' => 'Social Settings Save successfully', 'status' => 201)));
            } else {
                echo (json_encode(array('message' => 'Fail to save Social settings', 'status' => 500)));
            }
        }
    }
    elseif($_POST['site_settings']??'' == 'save_site_settings')
    {
        $hidden_id = isset($_POST['hidden_id']) ? $_POST['hidden_id'] : '';
        $existing_site_logo = isset($_POST['existing_site_logo']) ? $_POST['existing_site_logo'] : '';
        $existing_fav_icon = isset($_POST['existing_fav_icon']) ? $_POST['existing_fav_icon'] : '';
        $site_title = $_POST['site_title']??'';
        $site_description = mysqli_real_escape_string($conn,$_POST['site_description']??'');
        $site_logo = isset($_FILES['site_logo']['name']) ? $_FILES['site_logo']['name'] :'';
        $site_logoTemp = isset($_FILES["site_logo"]["tmp_name"]) ? $_FILES["site_logo"]["tmp_name"] : '';
        $site_favicon = isset($_FILES['site_favicon']['name']) ? $_FILES['site_favicon']['name'] :'';
        $site_faviconTemp = isset($_FILES["site_favicon"]["tmp_name"]) ? $_FILES["site_favicon"]["tmp_name"] : '';
        $footer_phone = $_POST['footer_phone']??'';
        $footer_description = mysqli_real_escape_string($conn,$_POST['footer_description']??'');
        $footer_email = $_POST['footer_email']??'';
        $footer_links = implode(',', $_POST['footer_links']??[]);
        $smtp_driver = $_POST['smtp_driver']??'';
        $smtp_host = $_POST['smtp_host']??'';
        $smtp_port = $_POST['smtp_port']??'';
        $smtp_username = $_POST['smtp_username']??'';
        $smtp_password = $_POST['smtp_password']??'';
        $smtp_encryption = $_POST['smtp_encryption']??'';
    // echo $createUserId; exit;
    
    // upload images
        $uploadFolderSiteLogo = "./upload/site_logo";
        $uploadFolderSiteFavicon = "./upload/site_favicon";

        if (!empty($existing_site_logo) && $site_logo && $site_logo != $existing_site_logo) {
            $existingSiteLogoPath = "./upload/site_logo/" . $existing_site_logo;
            if (file_exists($existingSiteLogoPath)) {
                unlink($existingSiteLogoPath);
            }
        }

    // Check if there's an existing favicon with the same filename and unlink it
        if (!empty($existing_fav_icon) && $site_favicon && $site_favicon != $existing_fav_icon) {
            $existingFavIconPath = "./upload/site_favicon/" . $existing_fav_icon;
            if (file_exists($existingFavIconPath)) {
                unlink($existingFavIconPath);
            }
        }
  

        try{
            if(!file_exists($uploadFolderSiteLogo)){
                if (!mkdir('./upload/site_logo', 0777, true) && !is_dir('./upload/site_logo')) {
                    // Handle the error, e.g., display an error message and exit
                    echo "Failed to create directory: $uploadFolderSiteLogo";
                    exit;
                }
            }

            if(!file_exists($uploadFolderSiteFavicon)){
                if (!mkdir('./upload/site_favicon', 0777, true) && !is_dir('./upload/site_favicon')) {
                    // Handle the error, e.g., display an error message and exit
                    echo "Failed to create directory: $uploadFolderSiteFavicon";
                    exit;
                }
            }
        }catch(\Exception $e){
            echo (json_encode(array('message' => $e->getMessage(), 'status' => 500)));
        }

    // $filePath = fopen($_FILES["site_logo"]["tmp_name"], 'r');
    // echo $filePath; exit;
        try{
            $siteLogoupdateorNot =  $site_logo ? $site_logo:$existing_site_logo;
            $siteFaviconupdateorNot = $site_favicon ? $site_favicon:$existing_fav_icon;
            if(!empty($hidden_id)){
                $sql = "UPDATE `site_settings` SET `site_tittle` = '$site_title', `site_description` = '$site_description', `site_logo` = '$siteLogoupdateorNot', `site_favicon` = '$siteFaviconupdateorNot', `site_smtp_driver` = '$smtp_driver', `site_smtp_host` = '$smtp_host', `site_smtp_port` = '$smtp_port', `site_smtp_username` = '$smtp_username', `site_smtp_password` = '$smtp_password',`site_smtp_encryption`='$smtp_encryption', `site_footer_links` = '$footer_links', `site_footer_email` = '$footer_email', `site_footer_description` = '$footer_description', `site_footer_phone_number` = '$footer_phone', `create_user` = '$createUserId' WHERE `id` = '$hidden_id'";
            } else {
                $sql = "INSERT INTO site_settings (site_tittle, site_description, site_logo, site_favicon, site_smtp_driver, site_smtp_host, site_smtp_port, site_smtp_username, site_smtp_encryption, site_smtp_password, site_footer_links, site_footer_email, site_footer_description, site_footer_phone_number, create_user) VALUES ('$site_title', '$site_description', '$site_logo', '$site_favicon', '$smtp_driver', '$smtp_host', '$smtp_port', '$smtp_username', '$smtp_encryption', '$smtp_password', '$footer_links', '$footer_email', ' $footer_description', '$footer_phone', '$createUserId')";
            }

            $runQuery = mysqli_query($conn, $sql);

            if($runQuery){

                $uploadFolderSiteLogo = "./upload/site_logo/" . $site_logo;
                $uploadFolderSiteFavicon = "./upload/site_favicon/" . $site_favicon;

                move_uploaded_file($site_logoTemp, $uploadFolderSiteLogo);
                move_uploaded_file($site_faviconTemp, $uploadFolderSiteFavicon);
                echo (json_encode(array('message' => 'Site Settings Save successfully', 'status' => 201)));
            } else {
                echo (json_encode(array('message' => 'Fail to save site settings', 'status' => 500)));
            }
        }
        catch(\Exception $e){
            echo (json_encode(array('message' => $e->getMessage(), 'status' => 500)));
        }
    
    } else {
        echo (json_encode(array('message' => 'Page not found', 'status' => 404)));
    }
    
} 



?>