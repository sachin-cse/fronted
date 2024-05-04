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

// $sql = "SELECT * FROM `site_settings` WHERE `create_user` = ".$_SESSION['currentUser_id']."";
// $result  = mysqli_query($conn, $sql);
// $row = mysqli_fetch_assoc($result);

?>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0">General Settings</h1>
    </div>

    <!-- Content Row -->
    <div class="row justify-content-center">
        <div class="card shadow col-12 col-lg-8">
        
            <div class="card-body">
                <!-- <p>Hare Krishna</p> -->
                <form action="javascript:void(0);" id="general_settings" method="post">
                    <input type="hidden" value="<?php echo $row['id']??''; ?>" name="hidden_id">
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="meta_title" class="col-form-label">Meta Title</label>
                            <input type="text" class="form-control" id="meta_title" name="meta_title" value="<?php echo $row['meta_title']??''; ?>"/>
                        </div>

                        <div class="form-group col-6">
                            <label for="meta_description" class="col-form-label">Meta Description:</label>
                            <!-- <input type="email" class="form-control" id="email" name="email" /> -->
                            <textarea name="meta_description" class="form-control editor" id="meta_description"><?php echo $row['meta_description']??''; ?></textarea>
                        </div>

                        <div class="form-group col-6">
                            <label for="og_image" class="col-form-label">Og Image</label>
                            <?php
                            $site_logo = !empty($row['site_logo']??'') ? $base_url.'fronted/admin/settings/upload/site_logo/'.$row['site_logo']??''.'':$base_url.'/fronted/admin/upload/noimage.png';
                            ?>
                            <img src="<?php echo $site_logo??'' ?>" id="ogImage" height="50" width="50">
                            <input type="file" class="form-control" id="og_image" name="og_image" accept=".gif, .jpg, .png" onchange="previewImage('ogImage', this)">
                            <!-- <input type="hidden" value="<?php echo $row['site_logo']; ?>" name="existing_site_logo" id="existing_site_logo"> -->
                        </div>

                        <div class="form-group col-6">
                            <label for="meta_keywords" class="col-form-label">Site Meta keywords</label>
                            <input type="text" class="form-control" id="meta_keywords" value="<?php echo $row['meta_keywords']??''; ?>" name="meta_keywords" placeholder="Site Meta Keywords">
                        </div>

                        <div class="form-group col-6">
                            <label for="robot_index" class="col-form-label">Robot Index</label>

                            <select name="robot_index" id="robot_index">
                                <option value="index" <?php if($row['index']??'' == "index") echo "selected"; ?> >default</option>
                                <option value="noindex" <?php if($row['noindex']??'' == "noindex") echo "selected"; ?> >noindex</option>
                            </select> 
                        </div>

                        <div class="form-group col-6">
                            <label for="robot_follow" class="col-form-label">Robot Follow</label>

                            <select name="robot_follow" id="robot_follow">
                                <option value="follow" <?php if($row['follow']??'' == "follow") echo "selected"; ?> >follow</option>
                                <option value="nofollow" <?php if($row['nofollow']??'' == "nofollow") echo "selected"; ?> >nofollow</option>
                            </select> 
                        </div>

                        <div class="form-group col-6">
                            <label for="script_title" class="col-form-label">Script Title</label>
                            <input type="text" class="form-control" id="script_title" name="script_title" value="<?php echo $row['script_title']??''; ?>"/>
                        </div>

                        <div class="form-group col-6">
                            <label for="script_description" class="col-form-label">Script Description:</label>
                            <!-- <input type="email" class="form-control" id="email" name="email" /> -->
                            <textarea name="script_description" class="form-control script_description" id="script_description"><?php echo $row['script_description']??''; ?></textarea>
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