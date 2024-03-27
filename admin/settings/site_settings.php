<?php
session_start();

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
                <form action="javascript:void(0);"  id="site_settings" method="post">
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="site_title" class="col-form-label">Site Title</label>
                            <input type="text" class="form-control" id="site_title" name="site_title" />
                        </div>

                        <div class="form-group col-6">
                            <label for="site_description" class="col-form-label">Site Description:</label>
                            <!-- <input type="email" class="form-control" id="email" name="email" /> -->
                            <textarea name="site_description" class="form-control editor" id="site_description"></textarea>
                        </div>

                        <div class="form-group col-6">
                            <label for="site_logo" class="col-form-label">Site Logo</label>
                            <img src="<?php echo $base_url; ?>/fronted/admin/upload/noimage.png" id="sitelogo" height="50" width="50">
                            <input type="file" class="form-control" id="site_logo" name="site_logo" accept=".gif, .jpg, .png" onchange="previewImage('sitelogo', this)">
                        </div>

                        <div class="form-group col-6">
                            <label for="site_favicon" class="col-form-label">Site Favicon</label>
                            <img src="<?php echo $base_url; ?>/fronted/admin/upload/noimage.png" id="sitefavicon" height="50" width="50">
                            <input type="file" class="form-control" id="site_favicon" accept=".gif, .jpg, .png" name="site_favicon" onchange="previewImage('sitefavicon', this)">
                        </div>

                        <div class="form-group col-6">
                            <label for="footer_title" class="col-form-label">Site Footer Title</label>
                            <input type="text" class="form-control" id="footer_title" name="footer_title" placeholder="Site Footer title">
                        </div>

                        <div class="form-group col-6">
                            <label for="footer_description" class="col-form-label">Site Footer Description</label>
                            <textarea name="footer_description" class="form-control footer-description" id="footer_description"></textarea>
                        </div>

                        <div class="form-group col-6">
                            <label for="footer_email" class="col-form-label">Site Footer Email</label>
                            <input name="footer_email" class="form-control" id="footer_email">
                        </div>

                        <div class="form-group col-6">
                            <label for="footer_email" class="col-form-label">Site Footer Links</label>
                            <table class="table table-bordered" id="dynamic_field">
                                    <tr><td><input type="text" name="footer_links[]" id="footer_links" class="form-control" placeholder="Footer Links"></td></tr>
                                    <td><button name="add" id="add">Add</button></td>
                            </table>
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