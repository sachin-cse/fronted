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

$sql = "SELECT * FROM `general_settings` WHERE `create_user` = ".$_SESSION['currentUser_id']."";
$result  = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$meta_robots = explode(',', $row['site_meta_robots']??'');

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
                    <input type="hidden" value="save_general_setting" name="general_setting">
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="meta_title" class="col-form-label">Meta Title<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="meta_title" name="meta_title" value="<?php echo $row['site_meta_title']??''; ?>"/>
                        </div>

                        <div class="form-group col-6">
                            <label for="meta_description" class="col-form-label">Meta Description:<span class="text-danger">*</span></label>
                            <!-- <input type="email" class="form-control" id="email" name="email" /> -->
                            <textarea name="meta_description" class="form-control editor" id="meta_description"><?php echo $row['site_meta_description']??''; ?></textarea>
                        </div>

                        <div class="form-group col-6">
                            <label for="og_image" class="col-form-label">Og Image<span class="text-danger">*</span></label>
                            <?php
                            $og_image = !empty($row['site_og_image']??'') ? $base_url.'fronted/admin/settings/upload/og_image/'.$row['site_og_image']??''.'':$base_url.'/fronted/admin/upload/noimage.png';
                            ?>
                            <img src="<?php echo $og_image??'' ?>" id="ogImage" height="50" width="50">
                            <input type="file" class="form-control" id="og_image" value="" name="og_image" accept=".gif, .jpg, .png" onchange="previewImage('ogImage', this)">
                            <input type="hidden" value="<?php echo $row['site_og_image']??''; ?>" name="existing_og_image" id="existing_og_image">
                        </div>

                        <div class="form-group col-6">
                            <label for="meta_keywords" class="col-form-label">Site Meta keywords<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="meta_keywords" value="<?php echo $row['site_meta_keywords']??''; ?>" name="meta_keywords" placeholder="Site Meta Keywords">
                        </div>

                        <div class="form-group col-6">
                            <label for="robot_index" class="col-form-label">Robot Index<span class="text-danger">*</span></label>

                            <select name="robot_index" id="robot_index">
                                <option value="index" <?php if(($meta_robots[0]??'') == "index") echo "selected"; ?> >index</option>
                                <option value="noindex" <?php if(($meta_robots[0]??'') == "noindex") echo "selected"; ?> >noindex</option>
                            </select> 
                        </div>

                        <div class="form-group col-6">
                            <label for="robot_follow" class="col-form-label">Robot Follow<span class="text-danger">*</span></label>

                            <select name="robot_follow" id="robot_follow">
                                <option value="follow" <?php if(($meta_robots[1]??'') == "follow") echo "selected"; ?> >follow</option>
                                <option value="nofollow" <?php if(($meta_robots[1]??'') == "nofollow") echo "selected"; ?> >nofollow</option>
                            </select> 
                        </div>

                        <div class="form-group col-6">
                            <label for="script_title" class="col-form-label">Script Title<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="script_title" name="script_title" value="<?php echo $row['site_script_title']??''; ?>"/>
                        </div>

                        <div class="form-group col-6">
                            <label for="script_description" class="col-form-label">Script Description:<span class="text-danger">*</span></label>
                            <!-- <input type="email" class="form-control" id="email" name="email" /> -->
                            <textarea name="script_description" class="form-control script_description" id="script_description"><?php echo $row['site_script_description']??''; ?></textarea>
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