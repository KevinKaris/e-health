<?php
session_start();
include '../includes/connection.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['password'])) {
        $user_id = $_SESSION['user_id'];
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $new_password = password_hash($password, PASSWORD_DEFAULT);

        // Update doctor details in the database
        $sql = "UPDATE users SET password='$new_password' WHERE id='$user_id'";

        if (mysqli_query($con, $sql)) {
            $_SESSION['success'] = 'Updated successfully.';
            header('Location: ../profile.php');
            exit;
        } else {
            $_SESSION['error'] = 'Something went wrong! ' . mysqli_error($con);
            header('Location: ../profile.php');
            exit;
        }
    } else {
        $_SESSION['error'] = 'Please fill in all required fields!';
        header('Location: ../edit-profile.php?user_id=' . $user_id);
        exit;
    }
} else {
    $_SESSION['error'] = 'Invalid request method!';
    header('Location: ../edit-profile.php?user_id=' . $user_id);
    exit;
}
?>
