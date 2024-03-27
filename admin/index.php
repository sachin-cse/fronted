<?php
include('includes/header.php');

?>


  <form action = "javascript:void(0);" method="post" id="adminsignForm" enctype='multipart/form-data' autocomplete="off">
  <div class="form-group">
    <label for="email">Email</label>
    <input type="text" name="email" class="form-control" id="email" placeholder="Enter email">
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" name="password" class="form-control password" id="password" placeholder="Password">
    <span toggle="#password-field" class="fa fa-fw fa-eye field_icon toggle-password"></span>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>

</form>
<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
