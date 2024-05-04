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

$sql = "SELECT * FROM `site_settings` WHERE `create_user` = ".$_SESSION['currentUser_id']."";
$result  = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

?>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0">Site Settings</h1>
    </div>

    <!-- Content Row -->
    <div class="row justify-content-center">
        <div class="card shadow col-12 col-lg-8">
        
            <div class="card-body">
                <!-- <p>Hare Krishna</p> -->
                <form action="javascript:void(0);" id="site_settings" method="post">
                    <input type="hidden" value="<?php echo $row['id']; ?>" name="hidden_id">
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="site_title" class="col-form-label">Site Title</label>
                            <input type="text" class="form-control" id="site_title" name="site_title" value="<?php echo $row['site_tittle']; ?>"/>
                        </div>

                        <div class="form-group col-6">
                            <label for="site_description" class="col-form-label">Site Description:</label>
                            <!-- <input type="email" class="form-control" id="email" name="email" /> -->
                            <textarea name="site_description" class="form-control editor" id="site_description"><?php echo $row['site_description']; ?></textarea>
                        </div>

                        <div class="form-group col-6">
                            <label for="site_logo" class="col-form-label">Site Logo</label>
                            <?php
                            $site_logo = !empty($row['site_logo']) ? $base_url.'fronted/admin/settings/upload/site_logo/'.$row['site_logo'].'':$base_url.'/fronted/admin/upload/noimage.png';
                            $site_favicon = !empty($row['site_favicon']) ? $base_url.'fronted/admin/settings/upload/site_favicon/'.$row['site_favicon'].'':$base_url.'/fronted/admin/upload/noimage.png';
                            ?>
                            <img src="<?php echo $site_logo ?>" id="sitelogo" height="50" width="50">
                            <input type="file" class="form-control" id="site_logo" name="site_logo" accept=".gif, .jpg, .png" onchange="previewImage('sitelogo', this)">
                            <input type="hidden" value="<?php echo $row['site_logo']; ?>" name="existing_site_logo" id="existing_site_logo">
                        </div>

                        <div class="form-group col-6">
                            <label for="site_favicon" class="col-form-label">Site Favicon</label>
                            <img src="<?php echo $site_favicon; ?>" id="sitefavicon" height="50" width="50">
                            <input type="file" class="form-control" id="site_favicon" accept=".gif, .jpg, .png" name="site_favicon" onchange="previewImage('sitefavicon', this)">
                            <input type="hidden" value="<?php echo $row['site_favicon']; ?>" name="existing_fav_icon" id="existing_fav_icon">
                        </div>

                        <div class="form-group col-6">
                            <label for="footer_title" class="col-form-label">Site Footer Phone Number</label>
                            <input type="text" class="form-control" id="footer_phone" value="<?php echo $row['site_footer_phone_number']; ?>" name="footer_phone" placeholder="Site Footer Phone Number">
                        </div>

                        <div class="form-group col-6">
                            <label for="footer_description" class="col-form-label">Site Footer Description</label>
                            <textarea name="footer_description" class="form-control footer-description" id="footer_description"><?= $row['site_footer_description'];?></textarea>
                        </div>

                        <div class="form-group col-6">
                            <label for="footer_email" class="col-form-label">Site Footer Email</label>
                            <input name="footer_email" class="form-control" id="footer_email" Value="<?= $row['site_footer_email'];?>">
                        </div>

                        <div class="form-group col-6">
                            <label for="footer_email" class="col-form-label">Site Footer Links</label>
                            <table class="table table-bordered" id="dynamic_field">
                                <?php
                                $count = 1;
                                $footer_links = explode(',', $row['site_footer_links']);
                                foreach($footer_links as $key=>$footer_link){
                                    ?>
                                        <tr>
                                        <td><input type="text" name="footer_links[]" id="footer_links" value="<?php echo $footer_link; ?>" class="form-control" placeholder="Footer Links">
                                        </td>
                                        <?php 
                                        if($count == 1){
                                            ?>
                                                <td><a href="javascript:void(0);" id="add">Add</a></td>
                                            <?php
                                        } else{
                                            ?>
                                                <td>
                                                    <a href="javascript:void(0);" class="form-control remove_field">Remove</a>
                                                </td>
                                            <?php
                                        }
                                        $count++;
                                        ?>
                                        </tr>
                                    <?php
                                }
                                ?>
                            </table>
                        </div>

                        <div class="form-group col-6">
                            <label for="smtp_driver" class="col-form-label">SMTP Driver</label>
                            <input type="text" value="<?php echo $row['smtp_driver']; ?>" class="form-control" id="smtp_driver" value="SMTP" name="smtp_driver" placeholder="SMTP Driver" />
                        </div>

                        <div class="form-group col-6">
                            <label for="smtp_host" class="col-form-label">SMTP Host</label>
                            <input type="text" class="form-control" value="<?php echo $row['smtp_host']; ?>" id="smtp_host" name="smtp_host" placeholder="SMTP Host" />
                        </div>

                        <div class="form-group col-6">
                            <label for="smtp_port" class="col-form-label">SMTP Port</label>
                            <input type="text" class="form-control" value="<?php echo $row['smtp_port']; ?>" id="smtp_port" name="smtp_port" placeholder="SMTP Port" />
                        </div>

                        <div class="form-group col-6">
                            <label for="smtp_username" class="col-form-label">SMTP Username</label>
                            <input type="text" class="form-control" value="<?php echo $row['smtp_username']; ?>" id="smtp_username" name="smtp_username" placeholder="SMTP Username" />
                        </div>

                        <div class="form-group col-6">
                            <label for="smtp_password" class="col-form-label">SMTP Password</label>
                            <input type="password" class="form-control" value="<?php echo $row['smtp_password']; ?>" id="smtp_password" name="smtp_password" placeholder="SMTP Password" />
                        </div>

                        <div class="form-group col-6">
                            <label for="smtp_encryption" class="col-form-label">SMTP Encryption</label>

                            <select name="smtp_encryption" id="smtp_encryption">
                                <option value="tls" <?php if($row['smtp_encryption'] == "tls") echo "selected"; ?> >TLS</option>
                                <option value="ssl" <?php if($row['smtp_encryption'] == "ssl") echo "selected"; ?> >SSL</option>
                            </select> 
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