<?php
session_start();
include '../includes/connection.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['department_name'], $_POST['status'], $_POST['doctor'])) {
        $department_name = mysqli_real_escape_string($con, $_POST['department_name']);
        $doctor = mysqli_real_escape_string($con, $_POST['doctor']);
        $description = isset($_POST['description']) ? mysqli_real_escape_string($con, $_POST['description']) : '';
        $status = $_POST['status'] === 'option1' ? 'Active' : 'Inactive';

        $sql = "INSERT INTO departments (department_name, doctor_id, description, status) VALUES ('$department_name', '$doctor', '$description', '$status')";
        
        if (mysqli_query($con, $sql)) {
            $_SESSION['success'] = 'Department created successfully.';
            header('Location: ../departments.php');
            exit;
        } else {
            $_SESSION['error'] = 'Something went wrong! ' . mysqli_error($con);
            header('Location: ../add-department.php');
            exit;
        }
    } else {
        $_SESSION['error'] = 'Please fill in all required fields!';
        header('Location: ../add-department.php');
        exit;
    }
} else {
    $_SESSION['error'] = 'Invalid request method!';
    header('Location: ../add-department.php');
    exit;
}
?>
