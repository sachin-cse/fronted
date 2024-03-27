<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
include "./database/connection.php";

// Get form data
$username = isset($_POST['usrname']) ? $_POST['usrname'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$remember_me = isset($_POST['remember_me']) ? $_POST['remember_me']:'';

// echo $remember_me; exit;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['usrname'];
    $sql = "SELECT * FROM register WHERE username = '$username'";
    $result = $conn->query($sql);

    // print_r($request); exit;
    // echo "<pre>";
    // var_dump($result); exit;
    // // or use print_r($result);
    // echo "</pre>";

    if(isset($_POST['remember_me'])){

        setcookie('usrname', $username, time() + 3600); // Example: Cookie expires in 1 hour
        setcookie('password', $password, time() + 3600);
        setcookie('remember_me', $remember_me, time() + 3600);
    } else {
        setcookie('usrname', '', time() - 3600); // Expire the cookie immediately
        setcookie('password', '', time() - 3600);
        setcookie('remember_me', '', time() - 3600);

    }

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $stored_password = $row['password'];
        $userId = $row['id'];
        $email = $row['email'];
        $profile_pic = $row['profile_pic'];

        // echo "Profile Picture: " . $profile_pic; exit;


        if (password_verify($password, $stored_password)) {
            $userId = $row['id'];
            $sql = "SELECT * FROM login WHERE id = '$userId'";
            $result = $conn->query($sql);

            if ($result->num_rows == 0) {
                $sql = "INSERT INTO login (id, username, password) VALUES ('$userId', '$username', '$stored_password')";
                if (!(mysqli_query($conn, $sql))) {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            }


            // Set session
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['id'] = $userId;
            // $_SESSION['profile_pic'] =  $profile_pic;

            // echo "<script>alert('Login successful!'); window.location = 'dashboard.php';</script>";
            $_SESSION['success_msg'] = 'Login successful!';
            header("Location: dashboard.php");
        } else {
            // echo "<script>alert('Invalid username or password. Please try again.'); window.location = 'login.php';</script>";
            $_SESSION['invalid_msg'] = 'Invalid username or password. Please try again.';
            header("Location: index.php");
        }
    } else {
            $_SESSION['error_msg'] = 'Username not found. Please register first.';
            header("Location: signup.php");
        // echo "<script>alert('Email not found. Please register first.'); window.location = 'signup.php';</script>";
        // exit;
    }
}

mysqli_close($conn);
?>
