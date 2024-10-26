<?php
session_start();
include '../includes/connection.php';
if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['number']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $password = $_POST['password'];

    $password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (username, email, phone, usertype, password) VALUES ('$username', '$email', $number, '1', '$password')";
    $run = mysqli_query($con, $sql);
    if($run){
        header('Location: ../login.php');
        exit;
    }
    else{
        $_SESSION['error'] = 'Something went wrong!';
        header('Location: ../register.php');
    }
}