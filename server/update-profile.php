<?php
session_start();
include '../includes/connection.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        isset($_POST['f_name'], $_POST['l_name'], $_POST['username'], $_POST['email'], 
        $_POST['dob'], $_POST['gender'], $_POST['city'], $_POST['phone'])
    ) {
        $user_id = $_SESSION['user_id'];
        $first_name = mysqli_real_escape_string($con, $_POST['f_name']);
        $last_name = mysqli_real_escape_string($con, $_POST['l_name']);
        $username = mysqli_real_escape_string($con, $_POST['username']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $dob = mysqli_real_escape_string($con, $_POST['dob']);
        $gender = mysqli_real_escape_string($con, $_POST['gender']);
        $address = mysqli_real_escape_string($con, $_POST['address']);
        $city = mysqli_real_escape_string($con, $_POST['city']);
        $location = mysqli_real_escape_string($con, $_POST['location']);
        $postal_code = mysqli_real_escape_string($con, $_POST['postal_code']);
        $phone = mysqli_real_escape_string($con, $_POST['phone']);
        $biography = mysqli_real_escape_string($con, $_POST['biography']);

        // Update doctor details in the database
        $sql = "UPDATE users SET 
                    first_name='$first_name', 
                    last_name='$last_name', 
                    username='$username', 
                    email='$email',
                    dob='$dob', 
                    gender='$gender', 
                    address='$address', 
                    city='$city', 
                    location='$location', 
                    postal_code='$postal_code', 
                    phone='$phone', 
                    biography='$biography'
                WHERE id='$user_id'";

        if (mysqli_query($con, $sql)) {
            $_SESSION['success'] = 'Updated successfully.';
            header('Location: ../edit-profile.php?user_id=' . $user_id);
            exit;
        } else {
            $_SESSION['error'] = 'Something went wrong! ' . mysqli_error($con);
            header('Location: ../edit-profile.php?user_id=' . $user_id);
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
