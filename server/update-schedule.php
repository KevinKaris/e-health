<?php
session_start();
include '../includes/connection.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['schedule_id'], $_POST['doctor_id'], $_POST['days'], $_POST['start_time'], $_POST['end_time'], $_POST['status'])) {
        $schedule_id = mysqli_real_escape_string($con, $_POST['schedule_id']);
        $doctor_id = mysqli_real_escape_string($con, $_POST['doctor_id']);
        $days = mysqli_real_escape_string($con, implode(',', $_POST['days']));
        $start_time = mysqli_real_escape_string($con, $_POST['start_time']);
        $end_time = mysqli_real_escape_string($con, $_POST['end_time']);
        $note = mysqli_real_escape_string($con, $_POST['note'] ?? '');
        $status = mysqli_real_escape_string($con, $_POST['status']);

        $query = "UPDATE schedules SET 
                    doctor_id='$doctor_id', 
                    days='$days', 
                    start_time='$start_time', 
                    end_time='$end_time', 
                    note='$note', 
                    status='$status' 
                  WHERE id='$schedule_id'";

        if (mysqli_query($con, $query)) {
            $_SESSION['success'] = 'Schedule updated successfully.';
            header('Location: ../edit-schedule.php?schedule_id=' . $schedule_id);
            exit;
        } else {
            $_SESSION['error'] = 'Something went wrong! ' . mysqli_error($con);
            header('Location: ../edit-schedule.php?schedule_id=' . $schedule_id);
            exit;
        }
    } else {
        $_SESSION['error'] = 'Please fill in all required fields!';
        header('Location: ../edit-schedule.php?schedule_id=' . $schedule_id);
    }
}
