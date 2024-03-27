<?php
include "./Helper/Apphelper.php";
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo base_url();?>css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/loader.css">
    
  </head>
  <body>
    <div class="login-page">
      <div class="avatar">
        <img src="./logo/iskcon_logo.jpg" alt="Avatar">
      </div>
      <div class="form">
        <h2>Login</h2>
        <?php 
    session_start();
    ob_start();
    
    if(isset($_SESSION['invalid_msg']))
    {
        ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <?= $_SESSION['invalid_msg']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php 
        unset($_SESSION['invalid_msg']);
    }


?>
        <form action="login.php" method="post" name='signin' id="signin-form">
          <input type="text" placeholder="Username" name="usrname" value ="<?php if(isset($_COOKIE['usrname'])) { echo $_COOKIE['usrname']; } ?>" required>
          <input type="password" placeholder="Password" name="password" value="<?php if(isset($_COOKIE['password'])) { echo $_COOKIE['password']; } ?>" required>
          <label>

          <input type="checkbox" name="remember_me" value="1" id="remember_me" <?php if(isset($_COOKIE['remember_me']) && $_COOKIE['remember_me'] == '1') { echo 'checked'; } ?>>
          Remember me 
          </label>
          <button>Log in</button>
        </form>
        <p class="message">Not registered? <a href="signup.php">Create an account</a></p>
        <p class="message">Forgot your password? <a href="forgot_pass.php">Click here to reset it</a></p>
      </div>
    </div>
    <!-- loader -->

<div id="loader">
  <div class="spinner-grow" role="status">
    <span class="sr-only"></span>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="<?php echo base_url();?>js/jquery.min.js"></script>
<script src="<?php echo base_url();?>js/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>js/script.js"></script>
  </body>
</html>
