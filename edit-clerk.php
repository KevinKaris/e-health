<?php
session_start();
include 'includes/connection.php'; // Include your database connection file

$doctorDetails = [
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

if (isset($_GET['clerk_id'])) {
    $client_id = mysqli_real_escape_string($con, $_GET['clerk_id']);
    $query = "SELECT * FROM users WHERE id = '$client_id' AND usertype = '4'"; // Ensure only fetching doctors
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $doctorDetails = mysqli_fetch_assoc($result);
        if (empty($doctorDetails['avatar'])) {
            $doctorDetails['avatar'] = 'assets/img/user.jpg';
        }
    } else {
        $_SESSION['error'] = 'Invalid Client ID.';
        header('Location: ../clerks.php');
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
                        <h4 class="page-title">Edit Clerk</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form action="server/update-clerk.php" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-sm-6">
                                    <input type="hidden" name="clerk_id" value="<?php echo $doctorDetails['id']; ?>">
                                    <div class="form-group">
                                        <label>First Name <span class="text-danger">*</span></label>
                                        <input class="form-control" name="fname" type="text" value="<?php echo htmlspecialchars($doctorDetails['first_name']); ?>" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input class="form-control" name="lname" value="<?php echo htmlspecialchars($doctorDetails['last_name']); ?>" type="text" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Username <span class="text-danger">*</span></label>
                                        <input class="form-control" name="username" value="<?php echo htmlspecialchars($doctorDetails['username']); ?>" type="text" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Email <span class="text-danger">*</span></label>
                                        <input class="form-control" name="email" value="<?php echo htmlspecialchars($doctorDetails['email']); ?>" type="email" required>
                                    </div>
                                </div>
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Date of Birth</label>
                                        <div class="cal-icon">
                                            <input type="text" name="dob" class="form-control datetimepicker" value="<?php echo htmlspecialchars($doctorDetails['dob']); ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
									<div class="form-group gender-select">
										<label class="gen-label">Gender:</label>
										<div class="form-check-inline">
											<label class="form-check-label">
												<input type="radio" name="gender" value="Male" class="form-check-input" <?php echo ($doctorDetails['gender'] == 'Male') ? 'checked' : ''; ?>>Male
											</label>
										</div>
										<div class="form-check-inline">
											<label class="form-check-label">
												<input type="radio" name="gender" value="Female" class="form-check-input" <?php echo ($doctorDetails['gender'] == 'Female') ? 'checked' : ''; ?>>Female
											</label>
										</div>
									</div>
                                </div>
								<div class="col-sm-12">
									<div class="row">
										<div class="col-sm-12">
											<div class="form-group">
												<label>Address</label>
												<input type="text" name="address" value="<?php echo htmlspecialchars($doctorDetails['address']); ?>" class="form-control">
											</div>
										</div>
										<div class="col-sm-6 col-md-6 col-lg-3">
											<div class="form-group">
												<label>City/Town</label>
												<input type="text" name="city" value="<?php echo htmlspecialchars($doctorDetails['city']); ?>" class="form-control" required>
											</div>
										</div>
										<div class="col-sm-6 col-md-6 col-lg-3">
											<div class="form-group">
												<label>Location</label>
												<input type="text" name="location" value="<?php echo htmlspecialchars($doctorDetails['location']); ?>" class="form-control">
											</div>
										</div>
										<div class="col-sm-6 col-md-6 col-lg-3">
											<div class="form-group">
												<label>Postal Code</label>
												<input type="text" name="postal_code" value="<?php echo htmlspecialchars($doctorDetails['postal_code']); ?>" class="form-control">
											</div>
										</div>
									</div>
								</div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Phone </label>
                                        <input class="form-control" name="phone" value="<?php echo htmlspecialchars($doctorDetails['phone']); ?>" type="text" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
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
                                <label>Short Biography</label>
                                <textarea class="form-control" name="biography" rows="3" cols="30">
                                    <?php echo htmlspecialchars($doctorDetails['biography']); ?>
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label class="display-block">Status</label>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="status" id="doctor_active" value="1" <?php echo ($doctorDetails['status'] == 'Active') ? 'checked' : ''; ?> checked>
									<label class="form-check-label" for="doctor_active">
									Active
									</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="status" id="doctor_inactive" <?php echo ($doctorDetails['status'] == 'Inactive') ? 'checked' : ''; ?> value="0">
									<label class="form-check-label" for="doctor_inactive">
									Inactive
									</label>
								</div>
                            </div>
                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary submit-btn" type="submit">Update Clerk</button>
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
