<?php
session_start();
include '../includes/connection.php';

if(isset($_POST['schedule_id'])){
    $id = $_POST['schedule_id'];
    $sql = "DELETE FROM schedules WHERE id = $id";
    $run = mysqli_query($con, $sql);
    if($run){
        header('Location: ../schedules.php');
    }
    else{
        header('Location: ../schedules.php');
    }
}