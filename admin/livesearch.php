<?php
session_start();
include "../database/connection.php";
include "../Helper/Apphelper.php";

if(isset($_POST['s'])){
    $search = $_POST['s'];
    $sql = "SELECT * FROM `adminsignin` WHERE `email` LIKE '$search%'";
    $query = mysqli_query($conn, $sql);
    $output = '';
    $i=1;

    while($row = mysqli_fetch_assoc($query)){
        $output.= "<tr>
        <td>".$i++."</td>
        <td>".$row['first_name']."</td>
        <td>".$row['last_name']."</td>
        <td>".$row['email']."</td>
        <td>".$row['status']."</td>
        <td>".$row['role']."</td>
        <td><img src = ".base_url()."upload/".$row['profile_image']." height='50' width='50'></td>
        <td>
        <a href='javascript:void(0);' class='btn btn-success edit-profile' data-id=".$row['id'].">Edit</a>&nbsp;
        <a href='javascript:void(0);' class='btn btn-danger delete-profile' data-id=".$row['id'].">Delete</a>
        </td>
        </tr>";
    }

    echo $output;
}
?>