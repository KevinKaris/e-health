<?php
session_start();
include 'includes/connection.php'; // Include your database connection file

$patientsDetails = [
    'id' => '',
    'first_name' => '',
    'last_name' => '',
    'username' => '',
    'email' => '',
    'dob' => '',
    'gender' => '',
    'address' => '',
    'city' => '',
    'location' => '',
    'postal_code' => '',
    'phone' => '',
    'biography' => '',
    'status' => '',
    'avatar' => 'assets/img/user.jpg',
];

if (isset($_GET['patient_id'])) {
    $patient_id = mysqli_real_escape_string($con, $_GET['patient_id']);
    $query = "SELECT * FROM patients WHERE id = '$patient_id'"; // Ensure only fetching doctors
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $patientsDetails = mysqli_fetch_assoc($result);
        if (empty($patientsDetails['avatar'])) {
            $patientsDetails['avatar'] = 'assets/img/user.jpg';
        }
    } else {
        $_SESSION['error'] = 'Invalid Pharmacist ID.';
        header('Location: ../pharmacists.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">


<!-- add-patient24:06-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>E-Health</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
	<![endif]-->
</head>

<body>
    <div class="main-wrapper">
        <?php include 'includes/heading.php'?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Update Patient</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form action="server/cleared.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="patient_id" value="<?php echo htmlspecialchars($patientsDetails['id']); ?>">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>First Name <span class="text-danger">*</span></label>
                                        <input class="form-control" name="fname" type="text" required disabled value="<?php echo htmlspecialchars($patientsDetails['first_name']); ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input class="form-control" name="lname" type="text" required disabled value="<?php echo htmlspecialchars($patientsDetails['last_name']); ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Email <span class="text-danger">*</span></label>
                                        <input class="form-control" name="email" type="email" required disabled value="<?php echo htmlspecialchars($patientsDetails['email']); ?>">
                                    </div>
                                </div>
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Date of Birth</label>
                                        <div class="cal-icon">
                                            <input type="text" name="dob" class="form-control datetimepicker" disabled required value="<?php echo htmlspecialchars($patientsDetails['dob']); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
									<div class="form-group gender-select">
										<label class="gen-label">Gender:</label>
										<div class="form-check-inline">
											<label class="form-check-label">
												<input type="radio" name="gender" value="Male" disabled class="form-check-input" <?php echo ($patientsDetails['gender'] == 'Male') ? 'checked' : ''; ?>>Male
											</label>
										</div>
										<div class="form-check-inline">
											<label class="form-check-label">
												<input type="radio" name="gender" value="Female" disabled class="form-check-input" <?php echo ($patientsDetails['gender'] == 'Female') ? 'checked' : ''; ?>>Female
											</label>
										</div>
									</div>
                                </div>
								<div class="col-sm-12">
									<div class="row">
										<div class="col-sm-12">
											<div class="form-group">
												<label>Address</label>
												<input type="text" name="address" class="form-control" disabled value="<?php echo htmlspecialchars($patientsDetails['address']); ?>">
											</div>
										</div>
										<div class="col-sm-6 col-md-6 col-lg-3">
											<div class="form-group">
												<label>City/Town</label>
												<input type="text" name="city" class="form-control" required disabled value="<?php echo htmlspecialchars($patientsDetails['city']); ?>">
											</div>
										</div>
										<div class="col-sm-6 col-md-6 col-lg-3">
											<div class="form-group">
												<label>Location</label>
												<input type="text" name="location" class="form-control" disabled value="<?php echo htmlspecialchars($patientsDetails['location']); ?>">
											</div>
										</div>
										<div class="col-sm-6 col-md-6 col-lg-3">
											<div class="form-group">
												<label>Postal Code</label>
												<input type="text" name="postal_code" class="form-control" disabled value="<?php echo htmlspecialchars($patientsDetails['postal_code']); ?>">
											</div>
										</div>
									</div>
								</div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Phone </label>
                                        <input class="form-control" name="phone" type="text" disabled required value="<?php echo htmlspecialchars($patientsDetails['phone']); ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6 d-none">
									<div class="form-group">
										<label>Avatar</label>
										<div class="profile-upload">
											<div class="upload-img">
												<img alt="" src="assets/img/user.jpg">
											</div>
											<div class="upload-input">
												<input type="file" name="avatar" class="form-control">
											</div>
										</div>
									</div>
                                </div>
                            </div>
							<div class="form-group">
                                <label>Patient Complaint</label>
                                <textarea class="form-control" name="disease" rows="3" cols="30" disabled><?php echo htmlspecialchars($patientsDetails['disease']); ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Analysis</label>
                                <textarea class="form-control" name="analysis" rows="3" cols="30" placeholder="Analysed Problem..." disabled><?php echo htmlspecialchars($patientsDetails['analysis']); ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Recommended Medicines</label>
                                <textarea class="form-control" name="medicines" rows="3" cols="30" placeholder="Recommended medicines..." required></textarea>
                            </div>
                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary submit-btn" type="submit">Cleared</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/select2.min.js"></script>
	<script src="assets/js/moment.min.js"></script>
	<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>


<!-- add-patient24:07-->
</html>
