<?php include "./database/connection.php"; ?>



<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

$mail = new PHPMailer(true);

// Get form data
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['pass'];

$image = $_FILES['image']['name'];
$tempname = $_FILES["image"]["tmp_name"];

$folder = "./upload/" . $image;    

// echo $image; exit;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $sql = "SELECT * FROM register WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<script>alert('Email already exists, please choose a new email'); window.location='signup.php';</script>";
    } else {
        // Email does not exist in the database, so the details will be stored in the database
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        // Set timezone
        // date_default_timezone_set('Asia/Kolkata');
        $signup_time = date('Y-m-d H:i:s a');
        $sql = "INSERT INTO register (username, email, profile_pic, password) VALUES ('$username', '$email', '$image', '$password_hash')";

        if (!(mysqli_query($conn, $sql))) {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        } else {
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'noreplysachin725@gmail.com';                     //SMTP username
            $mail->Password   = 'inysokrypkjpdnnb';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $mail->setFrom('noreplysachin725@gmail.com', 'nopely');
            $mail->addAddress($email, $username);

            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Hare Krishna Movement';
            $mail->Body    = "Thank you for signing up. Your account details are as follows:<br><br>"
            . "Username: " . htmlspecialchars($username) . "<br>"
            . "Email: " . htmlspecialchars($email) . "<br>"
            . "Password: " . htmlspecialchars($password) . "<br>"
            . "Please remember to keep your password confidential and do not share it with anyone.";
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
            if($mail->send()){
                move_uploaded_file($tempname, $folder);
                echo "<script>alert('You have successfully created a new user. Please login'); window.location = 'index.php';</script>";
            } else {
                echo "<script>alert('something went wrong'); window.location = 'signup.php';</script>";
            }

            // echo "<script>alert('You have successfully created a new user. Please login'); window.location = 'index.php';</script>";
        }
    }
}

mysqli_close($conn);
?>
