<?php
session_start();
include '../includes/connection.php';

if(isset($_POST['doctor_id'])){
    $id = $_POST['doctor_id'];
    $sql = "DELETE FROM users WHERE id = $id";
    $run = mysqli_query($con, $sql);
    if($run){
        header('Location: ../doctors.php');
    }
    else{
        header('Location: ../doctors.php');
    }
}