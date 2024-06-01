<?php
include($_SERVER['DOCUMENT_ROOT'].'/fronted/database/connection.php');
include(dirname(dirname(__FILE__)).'\Helper\Apphelper.php');

if($_SERVER["REQUEST_METHOD"] == 'POST'){
    $createUserId = get_current_user_id();

    if($_POST['resource_data']??'' == 'save_resource_data'){
        echo "Hare Krishna";
    }
}
?>