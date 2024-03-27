<?php 
include "./Helper/Apphelper.php";
include "./database/connection.php";
?>

<?php
session_start();
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $email = $_SESSION['email'];
    $userId = $_SESSION['id'];
    // $profile_pic = $_SESSION['profile_pic'];

    // print_r($_SESSION); exit;
    
} else {
    // Redirect to login page if user is not logged in
    echo "<script> window.location = 'index.php';</script>";
    exit;
}
$page = 'dashboard';

$sql = "SELECT `profile_pic` FROM `register` WHERE `id` = '$userId'";

$result = mysqli_query($conn, $sql);
$row = $result->fetch_assoc();

$profile_pic = $row['profile_pic'];
// print_r($profile_pic); exit;
?>




  <?php
  include './header/header.php';
  ?>


    <!-- navbar -->
    <?php
    include 'navbar.php';
    ?>

<!-- carousel effect -->
<div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="./carousel/5.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="./carousel/2.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="./carousel/3.jpg" class="d-block w-100" alt="...">
    </div>
  </div>
</div>

<!-- content -->
<h1>We are Isckon</h1>
<div class="card-group mb-5">
  <div class="card">
    <img src="./carousel/mayapur1.jpg" class="card-img-top" alt="bhaktiyoga">
    <div class="card-body">
      <h5 class="card-title">Bhaktiyoga</h5>
      <p class="card-text">The path of bhakti-yoga is developed through a variety of activities</p>
    </div>
  </div>
  <div class="card">
    <img src="./carousel/mayapur1.jpg" class="card-img-top" alt="chanting">
    <div class="card-body">
      <h5 class="card-title">Chanting</h5>
      <p class="card-text">The Hare Krishna mantra is a chant meant for enhancing consciousness to the greatest possible degree.
      </p>
    </div>
  </div>
  <div class="card">
    <img src="./carousel/mayapur1.jpg" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Mayapur</h5>
      <p class="card-text">Mayapur is one of the nine dhams of the holy islands, which look like petals of a lotus flowe</p>
    </div>
  </div>
</div>

<!-- model -->
<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="profileModalLabel">Profile Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
    <form action = "update_profile.php" method="post" enctype = "multipart/form-data">
      <div class="modal-body">
        <!-- Profile details form code here -->
        <input type="hidden" value="<?php echo $userId; ?>" name="usrId">

        <div class="form-group">
          <label for="username">Profile pic:</label>
          <img src="upload/<?php echo $profile_pic; ?>" alt="Profile Picture" height="20" width="50" class="img-fluid">
          <input type="file" name="update_profile" id="update_profile_pic">

          <input type="hidden" name="hidden_profile_img" value="<?php echo $profile_pic; ?>">
          <div class="holder">
                <img id="imgPreview" src="#" alt="" />
            </div>
        </div>

        <br>

        <div class="form-group">
          <label for="username">Username:</label>
          <input type="text" class="form-control" id="username" value="<?php echo $username; ?>" readonly>
        </div>

      <br>

        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" class="form-control" id="email" value="<?php echo $email; ?>" readonly>
        </div>
        <br>
      <input type="submit" value="Update Profile" name="update_profile">
        <!-- Add more profile fields as needed -->
      </div>
    </form>
    </div>
  </div>
</div>


<?php
include './footer/footer.php';
?>


