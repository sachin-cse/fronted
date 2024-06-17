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

// $sql = "SELECT * FROM `pages` WHERE `page_id` = '1'";
// $result  = mysqli_query($conn, $sql);
// $row = mysqli_fetch_assoc($result);

?>


<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0"><?php ($row['page_id']??'') > 0 ? 'Add Page':'Edit Page' ?></h1>
    </div>

    <!-- Content Row -->
    <div class="row justify-content-center">
        <div class="card shadow col-12 col-lg-8">
        
            <div class="card-body">
                <!-- <p>Hare Krishna</p> -->
                <form action="javascript:void(0);" id="add_edit_page" method="post">
                    <input type="hidden" value="<?php echo $row['page_id']??0; ?>" name="hidden_id">
                    <input type="hidden" name="mode" value="save_pages">
                    <!-- <input type="hidden" value="save_resource_data" name="resource_data"> -->
                    <div class="row">

                        <h4>CMS</h4>

                        <div class="form-group col-6">
                            <label for="page_name">Page Name<span class="text-danger">*</span></label>
                            <input type="text" value="<?= $row['page_name']; ?>" class="form-control slug" id="page_name" name="page_name" data-slug="page_slug"/>
                        </div>

                        <div class="form-group col-6">
                            <label for="page_slug">Page Slug<span class="text-danger">*</span></label>
                            <input type="text" value="<?= $row['page_slug']; ?>" class="form-control" id="page_slug" name="page_slug"/>
                        </div>

                        <div class="form-group col-6">
                            <label for="page_title">Page Title<span class="text-danger">*</span></label>
                            <input type="text" value="<?= $row['page_title']; ?>" class="form-control" id="page_title" name="page_title"/>
                        </div>

                        <div class="form-group col-6">
                            <label for="page_status" class="col-form-label">Select Page Status<span class="text-danger">*</span></label>

                            <select name="page_status" id="page_status" class="form-select">
                                <option value="" selected disabled>select page status</option>
                                <option value="active" >Active</option>
                                <option value="inactive" >InActive</option>
                            </select> 
                        </div>

                        <div class="form-group col-12">
                            <label for="page_title">Page Description<span class="text-danger">*</span></label>
                            <textarea name="page_description" class="form-control editor" id="page_description"></textarea>
                        </div>

                        <div class="form-group col-6">
                            <label for="page_feature_image" class="col-form-label">Page Feature Image</label>
                            <img src="" id="feature_image" height="50" width="50">
                            <input type="file" value="" class="form-control" id="page_feature_image" name="page_feature_image" onchange="previewImage('feature_image', this)"/>
                        </div>

                    </div>

                    <div class="row">

                        <h4>SEO</h4>

                        <div class="form-group col-6">
                            <label for="meta_title">Meta Title</label>
                            <input type="text" value="" class="form-control" id="meta_title" name="meta_title"/>
                        </div>

                        <div class="form-group col-6">
                            <label for="meta_keyword">Meta Keyword</label>
                            <input type="text" value="" class="form-control" id="meta_keyword" name="meta_keyword"/>
                        </div>

                        <div class="form-group col-6">
                            <label for="robot_index" class="col-form-label">Robot Index</label>

                            <select name="robot_index" id="robot_index">
                                <option value="index">index</option>
                                <option value="noindex">noindex</option>
                            </select> 
                        </div>

                        <div class="form-group col-6">
                            <label for="robot_follow" class="col-form-label">Robot Follow</label>

                            <select name="robot_follow" id="robot_follow">
                                <option value="follow">follow</option>
                                <option value="nofollow">nofollow</option>
                            </select> 
                        </div>

                        <div class="form-group col-12">
                            <label for="meta_description">Meta Description</label>
                            <textarea name="meta_description" class="form-control editor" id="meta_description"></textarea>
                        </div>

                        <div class="form-group col-6">
                            <label for="og_feature_image" class="col-form-label">Og Feature Image</label>
                            <img src="" id="og_image" height="50" width="50">
                            <input type="file" value="" class="form-control" id="og_feature_image" name="og_feature_image" onchange="previewImage('og_image', this)"/>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
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