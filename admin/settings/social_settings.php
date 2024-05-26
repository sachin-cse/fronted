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

$sql = "SELECT * FROM `social_settings` WHERE `create_user` = ".$_SESSION['currentUser_id']."";
$result  = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

?>


<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0">Social Settings</h1>
    </div>

    <!-- Content Row -->
    <div class="row justify-content-center">
        <div class="card shadow col-12 col-lg-8">
        
            <div class="card-body">
                <!-- <p>Hare Krishna</p> -->
                <form action="javascript:void(0);" id="social_settings" method="post">
                    <input type="hidden" value="<?php echo $row['id']??0; ?>" name="hidden_id">
                    <input type="hidden" value="save_social_setting" name="social_setting">
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="social_settings" class="col-form-label">Social Settings</label>
                            <table class="table table-bordered" id="dynamic_social_field">
                                <?php
                                $count = 1;
                                $social_links = json_decode($row['social_links'], true);
                                // print_r($social_links[0]['social_link_name']);
                                foreach($social_links as $key=>$value){
                                    ?>
                                        <tr>
                                        <td><input type="text" name="social_link_name[]" id="social_link_name" value="<?php echo $social_links[$key]['social_link_name']; ?>" class="form-control" placeholder="Social Link Name">
                                        </td>
                                        <td><input type="text" name="social_link[]" id="social_link" value="<?php echo $social_links[$key]['social_link']; ?>" class="form-control" placeholder="Social Link">
                                        </td>
                                        <td><input type="text" name="social_link_icon[]" id="social_link_icon" value="<?php echo $social_links[$key]['social_link_icon']; ?>" class="form-control" placeholder="Social Link Icon">
                                        </td>
                                        <td><input type="text" name="social_link_class[]" id="social_link_class" value="<?php echo $social_links[$key]['social_link_class']; ?>" class="form-control" placeholder="Social Link Class">
                                        </td>
                                        <?php 
                                        if($count == 1){
                                            ?>
                                                <td><a href="javascript:void(0);" id="add_social_item">Add</a></td>
                                            <?php
                                        } else{
                                            ?>
                                                <td>
                                                    <a href="javascript:void(0);" class="form-control remove_social_field">Remove</a>
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