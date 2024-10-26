<?php
session_start();
include '../includes/connection.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['fname'], $_POST['lname'], $_POST['username'], $_POST['email'], $_POST['password'], $_POST['dob'], $_POST['gender'], $_POST['address'], $_POST['city'], $_POST['location'], $_POST['postal_code'], $_POST['phone'], $_POST['biography'], $_POST['status'])) {
        $fname = mysqli_real_escape_string($con, $_POST['fname']);
        $lname = mysqli_real_escape_string($con, $_POST['lname']);
        $username = mysqli_real_escape_string($con, $_POST['username']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $dob = mysqli_real_escape_string($con, $_POST['dob']);
        $gender = mysqli_real_escape_string($con, $_POST['gender']);
        $address = mysqli_real_escape_string($con, $_POST['address']);
        $city = mysqli_real_escape_string($con, $_POST['city']);
        $location = mysqli_real_escape_string($con, $_POST['location']);
        $postal_code = mysqli_real_escape_string($con, $_POST['postal_code']);
        $phone = mysqli_real_escape_string($con, $_POST['phone']);
        $biography = mysqli_real_escape_string($con, $_POST['biography']);
        $status = ($_POST['status'] == 'option1') ? 'Active' : 'Inactive';
        
        // Handle file upload (avatar)
        if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == UPLOAD_ERR_OK) {
            $avatar = $_FILES['avatar'];
            $avatar_path = '../uploads/'.basename($avatar['name']);
            $avatar_to_store = basename($avatar['name']);
            if (!move_uploaded_file($avatar['tmp_name'], $avatar_path)) {
                $_SESSION['error'] = 'Failed to upload avatar.';
                header('Location: ../add-doctor.php');
                exit;
            }
        } else {
            $avatar_to_store = 'user.jpg'; // Default avatar if none uploaded
        }

        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare the SQL query
        $sql = "INSERT INTO users (usertype, first_name, last_name, username, email, password, dob, gender, address, city, location, postal_code, phone, biography, status, avatar) 
                VALUES ('2', '$fname', '$lname', '$username', '$email', '$hashed_password', '$dob', '$gender', '$address', '$city', '$location', '$postal_code', '$phone', '$biography', '$status', '$avatar_to_store')";
        
        if (mysqli_query($con, $sql)) {
            header('Location: ../doctors.php');
            exit;
        } else {
            $_SESSION['error'] = 'Something went wrong! ' . mysqli_error($con);
            header('Location: ../add-doctor.php');
            exit;
        }
    } else {
        $_SESSION['error'] = 'Please fill in all required fields!';
        header('Location: ../add-doctor.php');
        exit;
    }
} else {
    $_SESSION['error'] = 'Invalid request method!';
    header('Location: ../add-doctor.php');
    exit;
}
?>
