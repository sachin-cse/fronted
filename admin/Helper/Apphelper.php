<?php
session_start();
function base_url(){
    return "http://" . $_SERVER['SERVER_NAME'] . dirname($_SERVER["REQUEST_URI"] . '?') . '/';
}

base_url();


function get_current_user_id(){
    return $_SESSION['currentUser_id'];
}

// generate slug
if($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET['val'])){
    $pageVal = $_GET['val'];
    $output = preg_replace('/\s+/', ' ',$pageVal);
    $slug = str_replace(" ", "-", strtolower($output));

    echo json_encode(['slug'=>$slug]);
}
?>

