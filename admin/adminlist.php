<?php
session_start();

include "../database/connection.php";
include "../Helper/Apphelper.php";

if(!isset($_SESSION['email'])){

  echo "<script> window.location = 'index.php';</script>";
  exit;
}

// Number of records per page
$recordsPerPage = 10;
// current page number

if(isset($_GET['page'])){
    $currentPage = $_GET['page'];
} else {
    $currentPage = 1;
}

$startFrom = ($currentPage-1)*$recordsPerPage;
$query = "SELECT COUNT(`id`) FROM `adminsignin` ";
$query1 = "SELECT * FROM `adminsignin` LIMIT $startFrom, $recordsPerPage";


$result = mysqli_query($conn, $query);
$result1 = mysqli_query($conn, $query1);
$count = mysqli_num_rows($result);

include('includes/header.php'); 
include('includes/navbar.php'); 
?>



<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Admin List</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="card shadow mb-4">

            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Admin Register Table</h6>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminModel">
                    Add Admin
                </button>
                <input type="search" placeholder="search here..." class="live-search" name="livesearch" id="search">
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>S No.</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Role</th>
                                <th>Profile Image</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="showdata">
                            <?php

                                    if(mysqli_num_rows($result1)>0){
                                        $i=($currentPage-1)*$recordsPerPage + 1;
                                        while($row = mysqli_fetch_assoc($result1)){
                                            ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $row['first_name']; ?></td>
                                <td><?php echo $row['last_name']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['status']; ?></td>
                                <td><?php echo $row['role']; ?></td>
                                <td><img src="<?php echo base_url();?>upload/<?php echo $row['profile_image']; ?>"
                                        height="50" width="50"></td>
                                <td>
                                    <a href="javascript:void(0);" class="btn btn-success edit-profile"
                                        data-id="<?php echo $row['id']?>">Edit</a>&nbsp;
                                    <a href="javascript:void(0);" class="btn btn-danger delete-profile"
                                        data-id="<?php echo $row['id']?>">Delete</a>
                                </td>
                            </tr>
                            <?php
                                        }
                                    } else {
                                        ?>
                            <tr>
                                <td>No Records found</td>
                            </tr>
                            <?php
                                    }
                                    ?>

                        </tbody>
                    </table>

                    <?php
                    $sql = "SELECT COUNT(*) AS `total` FROM `adminsignin`";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $totalRecords = $row["total"];
                    $totalPages = ceil($totalRecords / $recordsPerPage);

                    echo "<nav aria-label='Page navigation example'>
                        <ul class='pagination'>";
                    if ($totalPages > 1) {

                        $class = $currentPage>1?"":'disabled';
                        echo "<li class='page-item $class'><a class='page-link' href='?page=" . max($currentPage - 1, 1) . "'>Previous</a></li>";
                        for ($i = 1; $i <= $totalPages; $i++) {
                        if ($i == $currentPage) {
                            echo "<li class='page-item'><a class='page-link active' href='?page=$i'>$i</a></li>";
                        } else {
                            echo "<li class='page-item'><a class='page-link' href='?page=$i'>$i</a></li>";
                        }
                        }

                
                        $class =  $currentPage < $totalPages?'':'disabled';
                        echo "<li class='page-item $class'><a class='page-link' href='?page=".min($currentPage + 1, 1)."'>Next</a></li>";
                        
                    }
                    echo "</ul></nav>";
                    $i=($currentPage-1)*$recordsPerPage + 1;
                    $perPageResult = ($recordsPerPage < $totalRecords) ? (($i + $recordsPerPage - 1) > $totalRecords ? $totalRecords : ($i + $recordsPerPage - 1)) : $totalRecords;
                    echo "showing result $i to $perPageResult of $totalRecords";
                    ?>

                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    <!-- edit model -->
    <div id="edit_model">
    </div>

    <!-- add admin -->
    <div class="modal fade" id="addadminModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Admin Profile</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="javascript:void(0);" enctype="multipart/form-data" id="addadminprofile" method="post">
                        <div class="form-group">
                            <label for="first-name" class="col-form-label">First Name:</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" />
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Last Name:</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" />
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" />
                        </div>

                        <div class="form-group">
                            <input type="password" name="password" class="form-control password" id="password1"
                                placeholder="Password">
                            <span toggle="#password-field" class="fa fa-fw fa-eye field_icon toggle-password"></span>
                        </div>

                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Status:</label>
                            <select name="role" id="AdminList">
                                <option value="">--Select Role--</option>
                                <option value="admin">Admin</option>
                                <option value="subadmin">Sub Admin</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Status:</label>
                            <select name="status" id="SelectList">
                                <option value="">--Select Status--</option>
                                <option value="active">Active</option>
                                <option value="inactive">InActive</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Profile Pic:</label>
                            <input type="file" class="form-control" id="file" name="file">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Admin</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

</div>

<!-- Content Row -->

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>