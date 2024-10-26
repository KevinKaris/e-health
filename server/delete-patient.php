<?php
session_start();
include '../includes/connection.php';

if(isset($_POST['patient_id'])){
    $id = $_POST['patient_id'];
    $sql = "DELETE FROM patients WHERE id = $id";
    $run = mysqli_query($con, $sql);
    if($run){
        header('Location: ../new-patients.php');
    }
    else{
        header('Location: ../new-patients.php');
    }
}