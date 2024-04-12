<?php
include($_SERVER['DOCUMENT_ROOT'].'/fronted/database/connection.php');
include(dirname(dirname(__FILE__)).'\Helper\Apphelper.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $hidden_id = isset($_POST['hidden_id']) ? $_POST['hidden_id'] : '';
    $existing_site_logo = isset($_POST['existing_site_logo']) ? $_POST['existing_site_logo'] : '';
    $existing_fav_icon = isset($_POST['existing_fav_icon']) ? $_POST['existing_fav_icon'] : '';
    $site_title = $_POST['site_title'];
    $site_description = $_POST['site_description'];
    $site_logo = isset($_FILES['site_logo']['name']) ? $_FILES['site_logo']['name'] :'';
    $site_logoTemp = isset($_FILES["site_logo"]["tmp_name"]) ? $_FILES["site_logo"]["tmp_name"] : '';
    $site_favicon = isset($_FILES['site_favicon']['name']) ? $_FILES['site_favicon']['name'] :'';
    $site_faviconTemp = isset($_FILES["site_favicon"]["tmp_name"]) ? $_FILES["site_favicon"]["tmp_name"] : '';
    $footer_phone = $_POST['footer_phone'];
    $footer_description = $_POST['footer_description'];
    $footer_email = $_POST['footer_email'];
    $footer_links = implode(',', $_POST['footer_links']);
    $smtp_driver = $_POST['smtp_driver'];
    $smtp_host = $_POST['smtp_host'];
    $smtp_port = $_POST['smtp_port'];
    $smtp_username = $_POST['smtp_username'];
    $smtp_password = $_POST['smtp_password'];
    $smtp_encryption = $_POST['smtp_encryption'];

    $createUserId = get_current_user_id();

    // echo $createUserId; exit;

    // upload images
    $uploadFolderSiteLogo = "./upload/site_logo";
    $uploadFolderSiteFavicon = "./upload/site_favicon";

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


  try{

    if(!empty($hidden_id)){
        $sql = "UPDATE `site_settings` SET `site_tittle` = '$site_title', `site_description` = '$site_description', `site_logo` = '$existing_site_logo', `site_favicon` = '$existing_fav_icon', `smtp_driver` = '$smtp_driver', `smtp_host` = '$smtp_host', `smtp_port` = '$smtp_port', `smtp_username` = '$smtp_username', `smtp_password` = '$smtp_password', `site_footer_links` = '$footer_links', `site_footer_email` = '$footer_email', `site_footer_description` = '$footer_description', `site_footer_phone_number` = '$footer_phone', `create_user` = '$createUserId' WHERE `id` = '$hidden_id'";
    } else {
        $sql = "INSERT INTO site_settings (site_tittle, site_description, site_logo, site_favicon, smtp_driver, smtp_host, smtp_port, smtp_username, smtp_encryption, smtp_password, site_footer_links, site_footer_email, site_footer_description, site_footer_phone_number, create_user) VALUES ('$site_title', '$site_description', '$site_logo', '$site_favicon', '$smtp_driver', '$smtp_host', '$smtp_port', '$smtp_username', '$smtp_encryption', '$smtp_password', '$footer_links', '$footer_email', ' $footer_description', '$footer_phone', '$createUserId')";
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
}
?>