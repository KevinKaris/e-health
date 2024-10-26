<?php
session_start();
include '../includes/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['patient_id'], $_POST['medicines'])) {
        $patient_id = mysqli_real_escape_string($con, $_POST['patient_id']);
        $medicines = mysqli_real_escape_string($con, $_POST['medicines']);

        // Update doctor details in the database
        $sql = "UPDATE patients SET 
                    medicines='$medicines',
                    status='1' 
                    WHERE id='$patient_id'";

        if (mysqli_query($con, $sql)) {
            $_SESSION['success'] = 'Patient Cleared successfully.';
            header('Location: ../pharmacist-patients.php');
            exit;
        } else {
            $_SESSION['error'] = 'Something went wrong! ' . mysqli_error($con);
            header('Location: ../pharmacist-patients.php');
            exit;
        }
    } else {
        $_SESSION['error'] = 'Medicines field required!';
        header('Location: ../pharmacist-patients.php');
        exit;
    }
} else {
    $_SESSION['error'] = 'Invalid request method!';
    header('Location: ../pharmacist-patients.php');
    exit;
}
?>
