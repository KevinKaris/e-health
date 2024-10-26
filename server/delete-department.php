<?php
session_start();
include '../includes/connection.php';

if(isset($_POST['department_id'])){
    $id = $_POST['department_id'];
    $sql = "DELETE FROM departments WHERE id = $id";
    $run = mysqli_query($con, $sql);
    if($run){
        header('Location: ../departments.php');
    }
    else{
        header('Location: ../departments.php');
    }
}