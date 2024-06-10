<?php
// session_start();

// echo dirname( __FILE__ ); exit;
// echo $_SERVER['DOCUMENT_ROOT'].'/fronted/database/connection.php'; exit;

include($_SERVER['DOCUMENT_ROOT'].'/fronted/database/connection.php');
include(dirname(dirname(__FILE__)).'\Helper\Apphelper.php');

if(!isset($_SESSION['email'])){

  echo "<script> window.location = 'index.php';</script>";
  exit;
}
// echo dirname(dirname(__FILE__));
include(dirname(dirname(__FILE__)).'\includes\header.php'); 
include(dirname(dirname(__FILE__)).'\includes\navbar.php'); 

$sql = "SELECT * FROM `resources` WHERE `created_by` = ".$_SESSION['currentUser_id']."";
$result  = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);


?>


<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0">Resources</h1>
    </div>

    <!-- Content Row -->
    <div class="row justify-content-center">
        <div class="card shadow col-12 col-lg-8">
        
            <div class="card-body">
                <!-- <p>Hare Krishna</p> -->
                <form action="javascript:void(0);" id="resource" method="post">
                    <input type="hidden" value="<?php echo $row['id']??''; ?>" name="hidden_id">
                    <input type="hidden" value="save_resource_data" name="resource_data">
                    <div class="row">

                        <div class="form-group col-6">
                            <label for="media_type" class="col-form-label">Select Media Type</label>

                            <select name="media_type" id="media_type" class="form-select">
                                <option value="" selected disabled>select media type</option>
                                <option value="file" <?php if($row['media_type'] == 'file')echo 'selected';?> >file</option>
                                <option value="video" <?php if($row['media_type'] == 'video')echo 'selected';?> >video</option>
                            </select> 
                        </div>

                        <div class="form-group col-6 <?php echo ($row['media_type'] == 'file') ? '':'d-none' ?>" id="show_file_link">
                            <label for="file_link" class="col-form-label">File Link</label>
                            <input type="text" value="<?= $row['file_link'];?>" class="form-control" id="file_link" name="file_link" value=""/>
                        </div>

                        <div class="form-group col-6 <?php ($row['media_type'] == 'video') ? '':'d-none' ?>" id="show_media_file">
                            <label for="media" class="col-form-label">Media</label>
                            <?php
                            $getExtension = explode('.', $row['file_link']??'');
                            $media_file = !empty($row['media_type']) && in_array(end($getExtension), ['mp4', 'ogg', 'wav']) ? $base_url.'fronted/admin/upload/play-icon.png':$base_url.'/fronted/admin/upload/noimage.png';
                            ?>
                            <img src="<?= $media_file??'' ?>" id="media" height="50" width="50">
                            <input type="file" class="form-control" id="media_file" value="" name="media_file" onchange="previewImage('media', this)">
                            <input type="hidden" value="<?=$row['file_link']; ?>" name="existing_media_file" id="existing_media_file">
                        </div>

                        <div class="form-group col-12">
                            <label for="meta_description" class="col-form-label">Description:</label>
                            <textarea name="description" class="form-control editor" id="description"><?=$row['description']; ?></textarea>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save Settings</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>

    </div>

</div>

<?php
// footer part
include(dirname(dirname(__FILE__)).'\includes\scripts.php');
include(dirname(dirname(__FILE__)).'\includes\footer.php');
?>