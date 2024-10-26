<?php
session_start();
include '../includes/connection.php';

if(isset($_POST['pharmacist_id'])){
    $id = $_POST['pharmacist_id'];
    $sql = "DELETE FROM users WHERE id = $id";
    $run = mysqli_query($con, $sql);
    if($run){
        header('Location: ../pharmacists.php');
    }
    else{
        header('Location: ../pharmacists.php');
    }
}