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

} else {
    // Redirect to login page if user is not logged in
    echo "<script> window.location = 'index.php';</script>";
    exit;
}
$page = 'about';

$sql = "SELECT `profile_pic` FROM `register` WHERE `id` = '$userId'";

$result = mysqli_query($conn, $sql);
$row = $result->fetch_assoc();

$profile_pic = $row['profile_pic'];
?>

<!-- <!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/isckon.css">
    <script src = './js/script.js'></script>
    <script src="https://kit.fontawesome.com/9490fec376.js" crossorigin="anonymous"></script>
    <title>Hare Krishna movement</title>
    <link rel="icon" type="image/x-icon" href="./favicon/8.png">
</head>

<body> -->

<?php
include './header/header.php';
?>

    <!-- navbar -->
    <?php
    include 'navbar.php'
    ?>
    <!-- main content -->
    <div class="d-flex justify-content-center">
        <h1>What is Isckon</h1>
    </div>
    <hr class="my-4 bg-light">

    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto text-center">
                <p class="text">The International Society for Krishna Consciousness (ISKCON), otherwise
                    known as the Hare Krishna movement, includes five hundred major centers,
                    temples and rural communities, nearly one hundred affilated vegetarian restaurants,
                    thousands of namahattas or local meeting groups, a wide variety of community projects,
                    and millions of congregational members worldwide. Although less than fifty years on the global
                    stage,
                    ISKCON has expanded widely since its founding by His Divine Grace A. C. Bhaktivedanta Swami
                    Prabhupāda in New York City in 1966.
                </p>
                <div class="mx-auto">
                    <img src="./carousel/mayapur1.jpg" alt="Image description" width="500" height="300">
                </div>  
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col-md-8 mx-auto text-center">
                <p class="text">The International Society for Krishna Consciousness (ISKCON), otherwise
                    known as the Hare Krishna movement, includes five hundred major centers,
                    temples and rural communities, nearly one hundred affilated vegetarian restaurants,
                    thousands of namahattas or local meeting groups, a wide variety of community projects,
                    and millions of congregational members worldwide. Although less than fifty years on the global
                    stage,
                    ISKCON has expanded widely since its founding by His Divine Grace A. C. Bhaktivedanta Swami
                    Prabhupāda in New York City in 1966.
                </p>
                <div class="mx-auto">
                    <img src="./carousel/mayapur1.jpg" alt="Image description" width="500" height="300">
                </div>  
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col-md-8 mx-auto text-center">
                <p class="text">The International Society for Krishna Consciousness (ISKCON), otherwise
                    known as the Hare Krishna movement, includes five hundred major centers,
                    temples and rural communities, nearly one hundred affilated vegetarian restaurants,
                    thousands of namahattas or local meeting groups, a wide variety of community projects,
                    and millions of congregational members worldwide. Although less than fifty years on the global
                    stage,
                    ISKCON has expanded widely since its founding by His Divine Grace A. C. Bhaktivedanta Swami
                    Prabhupāda in New York City in 1966.
                </p>
                <div class="mx-auto">
                    <img src="./carousel/mayapur1.jpg" alt="Image description" width="500" height="300">
                </div>  
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
      <div class="modal-body">
        <!-- Profile details form code here -->

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
        <!-- Add more profile fields as needed -->
      </div>
    </div>
  </div>
</div>

<?php
include './footer/footer.php';
?>