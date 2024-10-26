<?php
session_start();
include '../includes/connection.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['doctor'], $_POST['days'], $_POST['start-time'], $_POST['end-time'], $_POST['status'])) {
        // Ensure 'days' is set and is an array
        $days = '';
        if (is_array($_POST['days'])) {
            $days = implode(',', $_POST['days']);
        } else {
            $_SESSION['error'] = 'Please select valid days.';
            header('Location: ../schedule.php');
            exit;
        }

        $doctor = mysqli_real_escape_string($con, $_POST['doctor']);
        $start_time = mysqli_real_escape_string($con, $_POST['start-time']);
        $end_time = mysqli_real_escape_string($con, $_POST['end-time']);
        $note = mysqli_real_escape_string($con, $_POST['note'] ?? '');
        $status = $_POST['status'] === 'option1' ? 'Active' : 'Inactive';

        // Insert the schedule into the database
        $sql = "INSERT INTO schedules (doctor_id, days, start_time, end_time, note, status) VALUES ('$doctor', '$days', '$start_time', '$end_time', '$note', '$status')";
        if (mysqli_query($con, $sql)) {
            $_SESSION['success'] = 'Schedule created successfully.';
            header('Location: ../schedule.php');
            exit;
        } else {
            $_SESSION['error'] = 'Something went wrong! ' . mysqli_error($con);
            header('Location: ../schedule.php');
            exit;
        }
    } else {
        $_SESSION['error'] = 'Please fill in all required fields!';
        header('Location: ../schedule.php');
        exit;
    }
} else {
    $_SESSION['error'] = 'Invalid request method!';
    header('Location: ../schedule.php');
    exit;
}
?>
