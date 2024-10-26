<?php
session_start();
include '../includes/connection.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['company_name'], $_POST['email'])) {
        $company_name = mysqli_real_escape_string($con, $_POST['company_name']);
        $contact_person = mysqli_real_escape_string($con, $_POST['contact'] ?? '');
        $address = mysqli_real_escape_string($con, $_POST['address'] ?? '');
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $phone = mysqli_real_escape_string($con, $_POST['phone'] ?? '');

        $result = mysqli_query($con, "SELECT id FROM company_settings LIMIT 1");

        if ($result && mysqli_num_rows($result) > 0) {
            $sql_update = "UPDATE company_settings SET company_name = '$company_name', contact_person = '$contact_person', address = '$address', email = '$email', phone = '$phone', updated_at = CURRENT_TIMESTAMP WHERE id = 1";
            if (mysqli_query($con, $sql_update)) {
                $_SESSION['success'] = 'Company settings updated successfully.';
                header('Location: ../settings.php');
                exit;
            } else {
                $_SESSION['error'] = 'Something went wrong! ' . mysqli_error($con);
                header('Location: ../settings.php');
                exit;
            }
        } else {
            $sql_insert = "INSERT INTO company_settings (company_name, contact_person, address, email, phone) VALUES ('$company_name', '$contact_person', '$address', '$email', '$phone')";
            if (mysqli_query($con, $sql_insert)) {
                $_SESSION['success'] = 'Company settings saved successfully.';
                header('Location: ../settings.php');
                exit;
            } else {
                $_SESSION['error'] = 'Something went wrong! ' . mysqli_error($con);
                header('Location: ../settings.php');
                exit;
            }
        }
    } else {
        $_SESSION['error'] = 'Please fill in all required fields!';
        header('Location: ../settings.php');
        exit;
    }
} else {
    $_SESSION['error'] = 'Invalid request method!';
    header('Location: ../settings.php');
    exit;
}
?>
