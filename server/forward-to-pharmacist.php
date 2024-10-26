<?php
session_start();
include '../includes/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['patient_id'], $_POST['analysis'])) {
        $patient_id = mysqli_real_escape_string($con, $_POST['patient_id']);
        $analysis = mysqli_real_escape_string($con, $_POST['analysis']);

        // Update doctor details in the database
        $sql = "UPDATE patients SET 
                    analysis='$analysis',
                    status='2' 
                    WHERE id='$patient_id'";

        if (mysqli_query($con, $sql)) {
            $_SESSION['success'] = 'Patient Forwaded To Pharmacist successfully.';
            header('Location: ../new-patients.php');
            exit;
        } else {
            $_SESSION['error'] = 'Something went wrong! ' . mysqli_error($con);
            header('Location: ../new-patients.php');
            exit;
        }
    } else {
        $_SESSION['error'] = 'Analysis field required!';
        header('Location: ../new-patients.php');
        exit;
    }
} else {
    $_SESSION['error'] = 'Invalid request method!';
    header('Location: ../new-patients.php');
    exit;
}
?>
