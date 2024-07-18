<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'].'/fronted/database/connection.php');
function base_url(){
    return "http://" . $_SERVER['SERVER_NAME'] . dirname($_SERVER["REQUEST_URI"] . '?') . '/';
}

// base_url();


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

// search value page
if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['searchVal'])){
    $searchVal = $_GET['searchVal'];
    if($_GET['searchVal'] == null){
        $searchVal = 'home';
    }
    $sql = "SELECT * FROM `pages` WHERE `page_name` LIKE '$searchVal%'";
    $query = mysqli_query($conn, $sql);
    // print_r($query); exit;
    $output = '';
    $i=1;
    if(mysqli_num_rows($query) > 0){
        while($row = mysqli_fetch_assoc($query)){
            $output .= "<tr>
            <td><input type='checkbox' class='checkAll' name='checked_id[]' value='".$row['page_id']."'></td>
            <td>".$i++."</td>
            <td>".$row['page_name']."</td>
            <td>".$row['page_status']."</td>
            <td>".date('d F Y H:i:s a', strtotime($row['created_at']))."</td>
            <td>
                <a href='".(isset($_SERVER["HTTPS"]) && strtolower($_SERVER["HTTPS"]) == "on" ? 'https://' : 'http://').$_SERVER['SERVER_NAME']."/fronted/admin/pages/add_edit.php/".$row['page_id']."'>Edit</a> |
                <a href='javascript:void(0);' data-url='".(isset($_SERVER["HTTPS"]) && strtolower($_SERVER["HTTPS"]) == "on" ? 'https://' : 'http://').$_SERVER['SERVER_NAME']."/fronted/admin/pages/delete_page.php' data-id='".$row['page_id']."' class='delete_page'>Delete</a>
            </td>
        </tr>";


        }
    }else{
        $output.="<tr><td colspan='6' align='center'>No Result Found</td></tr>";
    }

    echo $output;
}
?>

