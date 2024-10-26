<?php
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['usertype']) && time() - $_SESSION['admin-login-time'] <= 36000) {
    $user_id = $_SESSION['user_id'];
    ?>
<div class="header">
			<div class="header-left">
				<a href="index.php" class="logo">
					<img src="assets/img/logo.png" width="35" height="35" alt=""> <span>Patient Medical Record Management System</span>
				</a>
			</div>
			<a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
            <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
            <ul class="nav user-menu float-right">
                <li class="nav-item dropdown has-arrow">
                    <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                        <span class="user-img">
							<img class="rounded-circle" src="assets/img/user.jpg" width="24" alt="Admin">
							<span class="status online"></span>
						</span>
						<span><?php echo $_SESSION['username']?></span>
                    </a>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="profile.php">My Profile</a>
						<a class="dropdown-item" href="edit-profile.php?user_id=<?php echo $user_id?>">Edit Profile</a>
						<!-- <a class="dropdown-item" href="settings.php">Settings</a> -->
						<a class="dropdown-item" href="server/logout.php">Logout</a>
					</div>
                </li>
            </ul>
            <div class="dropdown mobile-user-menu float-right">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="profile.php">My Profile</a>
                    <a class="dropdown-item" href="edit-profile.php?user_id=<?php echo $user_id?>">Edit Profile</a>
                    <!-- <a class="dropdown-item" href="settings.php">Settings</a> -->
                    <a class="dropdown-item" href="server/logout.php">Logout</a>
                </div>
            </div>
        </div>
        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="menu-title">Main</li>
                        <li class="active">
                            <a href="index.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                        </li>
                        <?php
                        if($_SESSION['usertype'] == '1'){?>
                            <li>
                                <a href="doctors.php"><i class="fa fa-user-md"></i> <span>Doctors</span></a>
                            </li>
                            <?php
                        }
                        ?>
						
                        <li class="submenu">
							<a href="#"><i class="fa fa-wheelchair"></i> <span> Patients </span> <span class="menu-arrow"></span></a>
							<ul style="display: none;">
                            <?php
                            if ($_SESSION['usertype'] == '1' || $_SESSION['usertype'] == '4') {
                                ?>
                                <li><a href="add-patient.php">Add Patient</a></li>
                                <?php
                            }
                                ?>
                                <?php
                                if ($_SESSION['usertype'] == '1' || $_SESSION['usertype'] == '4' || $_SESSION['usertype'] == '2') {
                                    ?>
                                <li><a href="new-patients.php">New Patients</a></li>
                                <?php
                                }

                                if($_SESSION['usertype'] == '1' || $_SESSION['usertype'] == '3'){
                                ?>
                                <li><a href="pharmacist-patients.php">Patients for Pharmacist</a></li>
                                <?php 
                                }
                                ?>
                                <li><a href="served-patients.php">Fully Served Patients</a></li>
                            </ul>
						</li>
                        <?php
                        if ($_SESSION['usertype'] == '1') {
                            ?>
                        <li>
                            <a href="clerks.php"><i class="fa fa-user-o"></i> <span>Clerks</span></a>
                        </li>
                        <li>
                            <a href="pharmacists.php"><i class="fa fa-user-o"></i> <span>Pharmacists</span></a>
                        </li>
                        <?php
                        }
                        ?>
                        <li>
                            <a href="schedule.php"><i class="fa fa-calendar-check-o"></i> <span>Doctor Schedule</span></a>
                        </li>
                        <li>
                            <a href="departments.php"><i class="fa fa-hospital-o"></i> <span>Departments</span></a>
                        </li>
						<!-- <li class="submenu">
							<a href="#"><i class="fa fa-user"></i> <span> Employees </span> <span class="menu-arrow"></span></a>
							<ul style="display: none;">
								<li><a href="employees.html">Employees List</a></li>
								<li><a href="leaves.html">Leaves</a></li>
								<li><a href="holidays.html">Holidays</a></li>
								<li><a href="attendance.html">Attendance</a></li>
							</ul>
						</li> -->
                        <!-- <li>
                            <a href="settings.php"><i class="fa fa-cog"></i> <span>App Settings</span></a>
                        </li> -->
                        <!-- <li>
                            <a href="roles-permissions.php"><i class="fa fa-cog"></i> <span>Roles & Permissions</span></a>
                        </li> -->
                        <li class="submenu">
							<a href="#"><i class="fa fa-file-o"></i> <span> Reports </span> <span class="menu-arrow"></span></a>
							<ul style="display: none;">
                                <li><a href="health_records.php">Patients' Health Records</a></li>
                                <!-- <li><a href="treated_diseases.php">Treated Diseases Report</a></li> -->
                            </ul>
						</li>
                    </ul>
                </div>
            </div>
        </div>
        <?php
}else{
    header('Location: login.php');
}
        ?>