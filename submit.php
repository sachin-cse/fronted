<?php
include './database/connection.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

$mail = new PHPMailer(true);

if($_SERVER['REQUEST_METHOD']=='POST'){
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $msg = $_POST['msg'];

  $sql = "INSERT INTO contact (name, email, phone, message ) VALUES ('$name', '$email', '$phone', '$msg')";

  if(mysqli_query($conn, $sql)){

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
    $mail->Body = "Thank you for contacting us. Your details are as follows:<br><br>"
            . "Name: " . htmlspecialchars($name) . "<br>"
            . "Email: " . htmlspecialchars($email) . "<br>"
            . "Phone: " . htmlspecialchars($phone) . "<br>"
            . "Message: " . nl2br(htmlspecialchars($msg)) . "<br><br>"
            . "We will get back to you as soon as possible.";

    if($mail->send()){
      echo "<script> alert('your message send successfully'); window.location = './contact.php'; </script>";
    } else {
      echo "<script> alert('somthing went wrong'); window.location = '../contact.php'; </script>";
    }

  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  // if($conn->query($sql) == TRUE){
  //   echo "<script> alert('your message send successfully'); window.location = '../contact.php'; </script>";
  // }

  // else {
  //   echo "Error: " . $sql . "<br>" . $conn->error;
  // }
}

mysqli_close($conn);
?>