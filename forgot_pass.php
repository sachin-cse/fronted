

<?php

include './database/connection.php';


if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $username = $_POST['username'];
  $n_pass = $_POST['n_pass'];

  // check if both are empty
  if(empty($username) || empty($n_pass)){
    echo  "<script>alert('Please enter your username and new password.'); window.location='./forgot_pass.php';</script>";
  } else {
    $sql = "SELECT * FROM login WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);


    if(mysqli_num_rows($result) == 0){
      echo "<script>alert('No user found that username.')</script>";
    } else {
       // update the user's password in the database
       $n_pass = mysqli_real_escape_string($conn, $n_pass);
       $new_pass_hash = password_hash($n_pass, PASSWORD_DEFAULT);

      //  write query top update login table 
      $sql = "UPDATE login SET password = '$new_pass_hash' WHERE username = '$username'";
      $result = mysqli_query($conn, $sql);

      // update signup table 
      $sql = "UPDATE register SET password = '$new_pass_hash' WHERE username = '$username'";
      $result2 = mysqli_query($conn, $sql);


      if($result && $result2){
        echo "<script>alert('Your password has been updated successfully.plz login.'); window.location = './index.php';</script>";
      }
      else {
        echo "<script>alert('There was an error updating your password. Please try again later.')</script>";

      }
    }
  }
}
mysqli_close($conn);
?>


<!DOCTYPE html>
<html>
  <head>
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="./css/login.css">
    <link rel="stylesheet" type="text/css" href="./css/loader.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  </head>
  <body>
    <div class="login-page">
      <div class="avatar">
        <img src="./logo/iskcon_logo.jpg" alt="Avatar">
      </div>
      <div class="form">
        <h2>Reset Password</h2>
        <form action="./forgot_pass.php" method="post" name='signin'>
          <input type="text" placeholder="Username" name="username">
          <input type="password" placeholder="New Password" name="n_pass">
          <button>Reset</button>
        </form>
      </div>
    </div>

       <!-- loader -->

<div id="loader">
  <div class="spinner-grow" role="status">
    <span class="sr-only"></span>
  </div>
</div>

  </body>
</html>