<!DOCTYPE html>
<html lang="en">


<!-- profile22:59-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>E-Health</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
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
                    <div class="col-sm-7 col-6">
                        <h4 class="page-title">My Profile</h4>
                    </div>
                    <?php
                    include 'includes/connection.php';
                    $user_id = $_SESSION['user_id'];

                    $sql = "SELECT * FROM users WHERE id = $user_id";
                    $run = mysqli_query($con, $sql);
                    $profile = mysqli_fetch_assoc($run);
                    ?>
                    <div class="col-sm-5 col-6 text-right m-b-30">
                        <a href="edit-profile.php?user_id=<?php echo $profile['id']?>" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i> Edit Profile</a>
                    </div>
                </div>
                <div class="card-box profile-header">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="profile-view">
                                <div class="profile-img-wrap">
                                    <div class="profile-img">
                                        <a href="#"><img class="avatar" src="uploads/<?php echo $profile['avatar']?>" alt=""></a>
                                    </div>
                                </div>
                                <div class="profile-basic">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="profile-info-left">
                                                <h3 class="user-name m-t-0 mb-0"><?php echo $profile['first_name'].' '.$profile['last_name']?></h3>
                                                <small class="text-muted"><?php echo $profile['biography']?></small>
                                                <div class="staff-id">
                                                    <?php
                                                    if($profile['usertype'] == 1){
                                                        echo 'Manager';
                                                    }
                                                    else if($profile['usertype'] == 2){
                                                        echo 'Doctor';
                                                    }
                                                    else if($profile['usertype'] == 3){
                                                        echo 'Pharmacist';
                                                    }
                                                    else if($profile['usertype'] == 4){
                                                        echo 'Clerk';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <ul class="personal-info">
                                                <li>
                                                    <span class="title">Phone:</span>
                                                    <span class="text"><a href="#"><?php echo $profile['phone']?></a></span>
                                                </li>
                                                <li>
                                                    <span class="title">Email:</span>
                                                    <span class="text"><a href="#"><?php echo $profile['email']?></a></span>
                                                </li>
                                                <li>
                                                    <span class="title">Birthday:</span>
                                                    <span class="text"><?php echo $profile['dob']?></span>
                                                </li>
                                                <li>
                                                    <span class="title">City:</span>
                                                    <span class="text"><?php echo $profile['city']?></span>
                                                </li>
                                                <li>
                                                    <span class="title">Address:</span>
                                                    <span class="text"><?php echo $profile['address']?></span>
                                                </li>
                                                <li>
                                                    <span class="title">Gender:</span>
                                                    <span class="text"><?php echo $profile['gender']?></span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>                        
                        </div>
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
    <script src="assets/js/app.js"></script>
</body>


<!-- profile23:03-->
</html>