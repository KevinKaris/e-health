<?php
session_start();
include '../includes/connection.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['department_id'], $_POST['doctor_id'], $_POST['department_name'], $_POST['description'], $_POST['status'])) {
        $department_id = mysqli_real_escape_string($con, $_POST['department_id']);
        $doctor_id = mysqli_real_escape_string($con, $_POST['doctor_id']);
        $department_name = mysqli_real_escape_string($con, $_POST['department_name']);
        $description = mysqli_real_escape_string($con, $_POST['description']);
        $status = mysqli_real_escape_string($con, $_POST['status']);

        $query = "UPDATE departments SET 
                    doctor_id='$doctor_id', 
                    department_name='$department_name', 
                    description='$description',
                    status='$status' 
                  WHERE id='$department_id'";

        if (mysqli_query($con, $query)) {
            $_SESSION['success'] = 'Department updated successfully.';
            header('Location: ../edit-department.php?department_id=' . $department_id);
            exit;
        } else {
            $_SESSION['error'] = 'Something went wrong! ' . mysqli_error($con);
            header('Location: ../edit-department.php?department_id=' . $department_id);
            exit;
        }
    } else {
        $_SESSION['error'] = 'Please fill in all required fields!';
        header('Location: ../edit-department.php?department_id=' . $department_id);
    }
}
