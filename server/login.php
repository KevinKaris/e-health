<?php
session_start();
include '../includes/connection.php';
if(isset($_POST['email']) && isset($_POST['password'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $run = mysqli_query($con, $sql);
    $rows = mysqli_num_rows($run);
    if($rows == 1){
        $fetch = mysqli_fetch_assoc($run);
        if(password_verify($password, $fetch['password'])){
            $_SESSION['username'] = $fetch['username'];
            $_SESSION['usertype'] = $fetch['usertype'];
            $_SESSION['user_id'] = $fetch['id'];
            $_SESSION['admin-login-time'] = time();
            header('Location: ../index.php');
            exit;
        }else{
            $_SESSION['error'] = 'Wrong Password';
            header('Location: ../login.php');
            exit;
        }
    }
    else{
        $_SESSION['error'] = 'Wrong Email';
        header('Location: ../login.php');
    }
}