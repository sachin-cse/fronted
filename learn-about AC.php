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
$page = 'links';

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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <script src="https://kit.fontawesome.com/9490fec376.js" crossorigin="anonymous"></script>
    <script src = './js/script.js'></script>
    <title>Hare Krishna movement</title>
    <link rel="icon" type="image/x-icon" href="./favicon/8.png">
  </head>
  <body> -->

  <?php
  include './header/header.php';
  ?>

  


    <!-- navbar -->
    <?php
    include 'navbar.php';
    ?>

    <!-- main content -->
    <div class="d-flex justify-content-center">
        <h1>Founder of Isckon</h1>
    </div>
    <hr class="my-4 bg-light">

    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto text-center"> 
                <p class="text">For millennia the teachings and the rich culture of bhakti-yoga, or Krishna Consciousness, had been hidden within the borders of India. Today, millions around the globe express their gratitude to Srila Prabhupada for revealing the timeless wisdom of bhakti to a world.
Born as Abhay Charan De on September 1, 1896, in Calcutta, as a young man he joined Mahatma Gandhi’s civil disobedience movement. In 1922, a meeting with the prominent scholar and spiritual leader, Srila Bhaktisiddhanta Sarasvati, proved to be most influential on young Abhay’s future calling.
Srila Bhaktisiddhanta was a leader in the Gaudiya Vaishnava community, a monotheistic tradition within the broader Hindu culture. At their very first meeting, Srila Bhaktisiddhanta asked Abhay to bring the teachings of Lord Krishna to the English-speaking world. Deeply moved by his devotion and wisdom, Abhay became a disciple of Srila Bhaktisiddhanta in 1933, and resolved to carry out his mentor’s request. Abhay, later known by the honorific A.C. Bhaktivedanta Swami Prabhupada, spent the next 32 years preparing for his journey west.
In 1965, at the age of sixty-nine, Srila Prabhupada begged a free passage and boarded a cargo ship, the Jaladhuta, to New York. The journey proved to be treacherous and he suffered two heart attacks aboard. After 35 days at sea, he first arrived at a lonely Brooklyn pier with just seven dollars in Indian rupees and a crate of his translations of sacred Sanskrit texts.
In New York, he faced great hardships and began his mission humbly by giving classes on the Bhagavad-gita in lofts on the Bowery and leading kirtan (traditional devotional chants) in Tompkins Square Park. His message of peace and goodwill resonated with many young people, some of whom came forward to become serious students of the Krishna-bhakti tradition. With the help of these students, Bhaktivedanta Swami rented a small storefront on New York’s Lower East Side to use as a temple.
In July of 1966, Bhaktivedanta Swami established the International Society for Krishna Consciousness (ISKCON) for the purpose he stated of “checking the imbalance of values in the world and working for real unity and peace”.
                </p>
                <div class="mx-auto">
                    <img src="./carousel/srilaprabhupada.jpg" alt="Image description" width="500" height="300">
                </div>  
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col-md-8 mx-auto text-center">
                <p class="text">In the eleven years that followed, Srila Prabhupada circled the globe 14 times on lecture tours spreading the teachings of Lord Krishna. Men and women from all backgrounds and walks of life came forward to accept his message. With their help, Srila Prabhupada established temples, farm communities, a publishing house, and educational institutions around the world. And, he began what has now become the world’s largest vegetarian food relief program, Hare Krishna Food for Life.
With the desire to nourish the roots of Krishna consciousness in its home, Srila Prabhupada returned to India several times, where he sparked a revival in the Vaishnava tradition. In India, he opened dozens of temples, including large centers in the holy towns of Vrindavana and Mayapura.
Srila Prabhupada’s most significant contributions, perhaps, are his books. He authored over 70 volumes on the Krishna tradition, which are highly respected by scholars for their authority, depth, fidelity to the tradition, and clarity. Several of his works are used as textbooks in numerous college courses. His writings have been translated into 76 languages. His most prominent works include: Bhagavad-gita As It Is, the 30-volume Srimad-Bhagavatam, and the 17-volume Sri Caitanya-caritamrita.
A.C. Bhaktivedanta Swami Srila Prabhupada passed away on November 14, 1977, in the holy town of Vrindavana, surrounded by his loving disciples who carry on his mission today.
                </p>
                <!-- <div class="mx-auto">
                    <img src="./carousel/mayapur1.jpg" alt="Image description" width="500" height="300">
                </div>   -->
            </div>
        </div>

        <!-- <br>

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
        </div> -->

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