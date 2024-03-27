<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
    session_start();
    session_unset();
    session_destroy();

    $error = array('status' => 200, 'message' => 'you have successfully logout');
    echo json_encode($error);
}
?>