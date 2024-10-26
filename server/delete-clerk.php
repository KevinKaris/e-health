<?php
session_start();
include '../includes/connection.php';

if(isset($_POST['clerk_id'])){
    $id = $_POST['clerk_id'];
    $sql = "DELETE FROM users WHERE id = $id";
    $run = mysqli_query($con, $sql);
    if($run){
        header('Location: ../clerks.php');
    }
    else{
        header('Location: ../clerks.php');
    }
}