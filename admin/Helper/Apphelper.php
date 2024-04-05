<?php
session_start();
function base_url(){
    return "http://" . $_SERVER['SERVER_NAME'] . dirname($_SERVER["REQUEST_URI"] . '?') . '/';
}

base_url();


function get_current_user_id(){
    return $_SESSION['currentUser_id'];
}
?>

