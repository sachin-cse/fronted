<?php
include($_SERVER['DOCUMENT_ROOT'].'/fronted/database/connection.php');
include(dirname(dirname(__FILE__)).'\Helper\Apphelper.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    print_r($_POST);
}
?>