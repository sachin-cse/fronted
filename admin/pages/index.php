<?php


include($_SERVER['DOCUMENT_ROOT'].'/fronted/database/connection.php');
include(dirname(dirname(__FILE__)).'\Helper\Apphelper.php');

if(!isset($_SESSION['email'])){

  echo "<script> window.location = 'index.php';</script>";
  exit;
}

// echo dirname(dirname(__FILE__));
include(dirname(dirname(__FILE__)).'\includes\header.php'); 
include(dirname(dirname(__FILE__)).'\includes\navbar.php'); 

// // Number of records per page
// $recordsPerPage = 1;
// // current page number

// if(isset($_GET['page'])){
//     $currentPage = $_GET['page'];
// } else {
//     $currentPage = 1;
// }

// $startFrom = ($currentPage-1)*$recordsPerPage;
// $query = "SELECT COUNT(`id`) FROM `adminsignin` ";
$query1 = "SELECT * FROM `pages`";


// $result = mysqli_query($conn, $query);
$result1 = mysqli_query($conn, $query1);
// $count = mysqli_num_rows($result);

?>



<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">CMS Pages list</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="card shadow mb-4">

            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">CMS Pages</h6>

                <a href="/fronted/admin/pages/add_edit.php" class="btn btn-primary float-right">Add Page</a>
                <!-- <input type="search" placeholder="search here..." class="live-search" name="livesearch" id="search"> -->
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>S No.</th>
                                <th>Page Name</th>
                                <th>Status</th>
                                <th>Created at</th>
                                <th>Actions</th>
                            </tr>
                            <?php
                            $i=1; 
                            while($row = mysqli_fetch_assoc($result1)){
                                ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $row['page_name']; ?></td>
                                        <td><?= $row['page_status']; ?></td>
                                        <td><?= date('d F Y H:i:s a', strtotime($row['created_at'])); ?></td>
                                        <td>Actions</td>
                                    </tr>
                                <?php
                            }
                            ?>
                        </thead>
                    </table>

                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
</div>

</div>

<!-- Content Row -->

<?php
// footer part
include(dirname(dirname(__FILE__)).'\includes\scripts.php');
include(dirname(dirname(__FILE__)).'\includes\footer.php');
?>