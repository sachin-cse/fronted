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

$recordsPerPage = 1;

if(isset($_GET['page'])){
    $currentPage = $_GET['page'];
} else {
    $currentPage = 1;
}

$startFrom = ($currentPage-1)*$recordsPerPage;
$query = "SELECT * FROM `pages` LIMIT $startFrom, $recordsPerPage";

$result = mysqli_query($conn, $query);
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

                <form class="d-sm-inline-block form-inline mr-auto mw-100 navbar-search" action="<?= $base_url.'fronted/admin/Helper/Apphelper.php/' ?>" id="navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small search_page" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                            <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <a href="/fronted/admin/pages/add_edit.php" class="btn btn-primary float-right">Add Page</a>
                <a href="javascript:void(0);" class="btn btn-primary float-right me-1 delete_all" data-url="<?=$base_url.'/fronted/admin/pages/delete_page.php'?>" data-val = "multiple_delete">Delete All</a>
                <!-- <input type="search" placeholder="search here..." class="live-search" name="livesearch" id="search"> -->
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered" id="find-table" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th><input type="checkbox" class="check" name="checked"></th>
                                <th>S No.</th>
                                <th>Page Name</th>
                                <th>Status</th>
                                <th>Created at</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                            <?php
                            $i=1; 
                            if(mysqli_num_rows($result)){
                                $i=($currentPage-1)*$recordsPerPage + 1;
                                while($row = mysqli_fetch_assoc($result)){
                                    ?>
                                    <tbody id="searchData">
                                        <tr>
                                            <td><input type="checkbox" class="checkAll" name="checked_id[]" value="<?=$row['page_id'];?>"></td>
                                            <td><?= $i++; ?></td>
                                            <td><?= $row['page_name']; ?></td>
                                            <td><?= $row['page_status']; ?></td>
                                            <td><?= date('d F Y H:i:s a', strtotime($row['created_at'])); ?></td>
                                            <td><a href="<?= $base_url.'/fronted/admin/pages/add_edit.php/'.$row['page_id'];?>">Edit</a> | 
                                                <a href="javascript:void(0);" data-url="<?=$base_url.'/fronted/admin/pages/delete_page.php'?>" data-id="<?=$row['page_id'];?>" class="delete_page">Delete</a>
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
                    $sql = "SELECT COUNT('*') AS `total` FROM `pages`";
                    $query = mysqli_query($conn, $sql);
                    $result = mysqli_fetch_assoc($query);
                    $totalRecords = $result['total'];
                    $totalPages = ceil($totalRecords/$recordsPerPage);

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
</div>

</div>

<!-- Content Row -->

<?php
// footer part
include(dirname(dirname(__FILE__)).'\includes\scripts.php');
include(dirname(dirname(__FILE__)).'\includes\footer.php');
?>