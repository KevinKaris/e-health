<!DOCTYPE html>
<html lang="en">


<!-- edit-profile23:03-->
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
                    <div class="col-sm-12">
                        <h4 class="page-title">Edit Profile</h4>
                    </div>
                </div>
                <?php
                    include 'includes/connection.php';
                    $user_id = $_GET['user_id'];

                    $sql = "SELECT * FROM users WHERE id = $user_id";
                    $run = mysqli_query($con, $sql);
                    $profile = mysqli_fetch_assoc($run);
                    ?>
                    <?php
                            if(isset($_SESSION['success'])){?>
                                <div class="alert alert-success">
                                    <?php echo $_SESSION['success']?>
                                </div>
                            <?php
                            unset($_SESSION['success']);
                            }
                            ?>
                            <?php
                            if(isset($_SESSION['error'])){?>
                                <div class="alert alert-danger">
                                    <?php echo $_SESSION['error']?>
                                </div>
                            <?php
                            unset($_SESSION['error']);
                            }
                            ?>
                <form action="server/update-profile.php" method="post">
                    <div class="card-box">
                        <h3 class="card-title">Basic Informations</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="profile-img-wrap">
                                    <img class="inline-block" src="uploads/<?php echo $profile['avatar']?>" alt="user">
                                    <!-- <div class="fileupload btn">
                                        <input class="upload" type="file">
                                    </div> -->
                                </div>
                                <div class="profile-basic">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group form-focus">
                                                <label class="focus-label">First Name</label>
                                                <input type="text" name="f_name" class="form-control floating" value="<?php echo $profile['first_name']?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-focus">
                                                <label class="focus-label">Last Name</label>
                                                <input type="text" name="l_name" class="form-control floating" value="<?php echo $profile['last_name']?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-focus">
                                                <label class="focus-label">Birth Date</label>
                                                <div class="cal-icon">
                                                    <input class="form-control floating datetimepicker" name="dob" type="text" value="<?php echo $profile['dob']?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-focus select-focus">
                                                <label class="focus-label">Gendar</label>
                                                <select class="select form-control floating" name="gender">
                                                    <?php
                                                    if($profile['gender'] == 'Male'){?>
                                                        <option value="Male" selected>Male</option>
                                                        <option value="Female">Female</option>
                                                        <?php
                                                    }
                                                    else if($profile['gender'] == 'Female'){?>
                                                        <option value="Male">Male</option>
                                                        <option value="Female" selected>Female</option>
                                                        <?php
                                                    }
                                                    else{?>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-box">
                        <h3 class="card-title">Contact Informations</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <label class="focus-label">Username</label>
                                    <input type="text" class="form-control floating" name="username" value="<?php echo $profile['username']?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <label class="focus-label">Phone</label>
                                    <input type="text" class="form-control floating" name="phone" value="<?php echo $profile['phone']?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <label class="focus-label">Email</label>
                                    <input type="text" class="form-control floating" name="email" value="<?php echo $profile['email']?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <label class="focus-label">Address</label>
                                    <input type="text" class="form-control floating" name="address" value="<?php echo $profile['address']?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <label class="focus-label">City</label>
                                    <input type="text" class="form-control floating" name="city" value="<?php echo $profile['city']?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <label class="focus-label">Location</label>
                                    <input type="text" class="form-control floating" name="location" value="<?php echo $profile['location']?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <label class="focus-label">Postal Code</label>
                                    <input type="text" class="form-control floating" name="postal_code" value="<?php echo $profile['postal_code']?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <label class="focus-label">Biography</label>
                                    <textarea class="form-control floating" rows="3" name="biography"><?php echo $profile['biography']?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center m-t-20">
                        <button class="btn btn-primary submit-btn" type="submit">Save</button>
                    </div>
                </form>
                <br>
                <form action="server/update-password.php" method="post">
                    <div class="card-box">
                        <h3 class="card-title">Security Information</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <label class="focus-label">New Password</label>
                                    <input type="password" class="form-control floating" name="password">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center m-t-20">
                        <button class="btn btn-primary submit-btn" type="submit">Save</button>
                    </div>
                </form>
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


<!-- edit-profile23:05-->
</html>