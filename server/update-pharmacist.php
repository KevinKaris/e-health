<?php
session_start();
include '../includes/connection.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        isset($_POST['clerk_id'], $_POST['fname'], $_POST['lname'], $_POST['username'], $_POST['email'], 
        $_POST['dob'], $_POST['gender'], $_POST['city'], $_POST['phone'], $_POST['status'])
    ) {
        $avatar_to_store = '';
        // Sanitize input data
        $clerk_id = mysqli_real_escape_string($con, $_POST['clerk_id']);
        $first_name = mysqli_real_escape_string($con, $_POST['fname']);
        $last_name = mysqli_real_escape_string($con, $_POST['lname']);
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
        $status = $_POST['status'] == '1' ? 'Active' : 'Inactive';

        // Handle file upload
        if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == UPLOAD_ERR_OK) {
            $avatar = $_FILES['avatar'];
            $avatar_path = '../uploads/'.basename($avatar['name']);
            $avatar_to_store = basename($avatar['name']);
            if (!move_uploaded_file($avatar['tmp_name'], $avatar_path)) {
                $_SESSION['error'] = 'Failed to upload avatar.';
                header('Location: ../edit-clerk.php');
                exit;
            }
        } else {
            $avatar_to_store = 'user.jpg'; // Default avatar if none uploaded
        }

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
                    biography='$biography',
                    status='$status', 
                    avatar='$avatar_to_store'
                WHERE id='$clerk_id' AND usertype='3'";

        if (mysqli_query($con, $sql)) {
            $_SESSION['success'] = 'Clerk details updated successfully.';
            header('Location: ../edit-clerk.php?clerk_id=' . $clerk_id);
            exit;
        } else {
            $_SESSION['error'] = 'Something went wrong! ' . mysqli_error($con);
            header('Location: ../edit-clerk.php?clerk_id=' . $clerk_id);
            exit;
        }
    } else {
        $_SESSION['error'] = 'Please fill in all required fields!';
        header('Location: ../edit-clerk.php?clerk_id=' . $_POST['clerk_id']);
        exit;
    }
} else {
    $_SESSION['error'] = 'Invalid request method!';
    header('Location: ../edit-clerk.php');
    exit;
}
?>
