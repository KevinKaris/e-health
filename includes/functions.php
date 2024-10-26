<?php
include 'connection.php';
function doctors(){
    global $con;
    $sql = "SELECT * FROM users WHERE usertype = 2";
    $run = mysqli_query($con, $sql);
    while($details = mysqli_fetch_assoc($run)){?>
        <div class="col-md-4 col-sm-4  col-lg-3">
            <div class="profile-widget">
                <div class="doctor-img">
                    <a class="avatar" href="#"><img alt="" src="uploads/<?php echo $details['avatar']?>"></a>
                </div>
                <div class="dropdown profile-action">
                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <form action="edit-doctor.php" method="get">
                            <input type="hidden" name="doctor_id" value="<?php echo $details['id']?>">
                            <button class="dropdown-item" type="submit"><i class="fa fa-pencil m-r-5"></i> Edit</button>
                        </form>
                        <form action="server/delete-doctor.php" method="post">
                            <input type="hidden" name="doctor_id" value="<?php echo $details['id']?>">
                            <button class="dropdown-item" type="submit"><i class="fa fa-trash-o m-r-5"></i> Delete</button>
                        </form>
                    </div>
                </div>
                <h4 class="doctor-name text-ellipsis"><a href="#"><?php echo $details['first_name'].' '.$details['last_name']?></a></h4>
                <div class="doc-prof"><?php echo $details['city']?></div>
                <div class="user-country">
                    <i class="fa fa-map-marker"></i> <?php echo $details['address']?>
                </div>
            </div>
        </div>
        <?php
    }
}


function unserved_patients(){
    global $con;
    $sql = "SELECT * FROM patients Where status = 0 ORDER BY created_at";
    $run = mysqli_query($con, $sql);
    while($details = mysqli_fetch_assoc($run)){
        $dobDateTime = new DateTime($details['dob']);
        $currentDateTime = new DateTime();
        $ageInterval = $currentDateTime->diff($dobDateTime);
        $age = $ageInterval->y;
        ?>
        <tr>
            <td><img width="28" height="28" src="uploads/<?php echo $details['avatar']?>" class="rounded-circle m-r-5" alt=""><?php echo $details['first_name'].' '.$details['last_name']?></td>
            <td><?php echo $age?></td>
            <td><?php echo $details['city'].' '.$details['location']?></td>
            <td><?php echo $details['phone']?></td>
            <td><?php echo $details['email']?></td>
            <td><?php echo $details['disease']?></td>
            <td><span class="custom-badge status-green">UnServed</span></td>
            <td class="text-right">
                <div class="dropdown dropdown-action">
                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <form action="server/serve-patient.php" method="post">
                            <input type="hidden" name="patient_id" value="<?php echo $details['id']?>">
                            <button class="dropdown-item" type="submit">Mark As Served</button>
                        </form>
                        <form action="server/edit-patient.php" method="get">
                            <input type="hidden" name="patient_id" value="<?php echo $details['id']?>">
                            <button class="dropdown-item" type="submit"><i class="fa fa-pencil m-r-5"></i> Edit</button>
                        </form>
                        <form action="server/delete-patient.php" method="post">
                            <input type="hidden" name="patient_id" value="<?php echo $details['id']?>">
                            <button class="dropdown-item" type="submit"><i class="fa fa-trash-o m-r-5"></i> Delete</button>
                        </form>
                    </div>
                </div>
            </td>
        </tr>
    <?php
    }
}


function treated_patients(){
    global $con;
    $sql = "SELECT * FROM patients Where status = 1 ORDER BY created_at";
    $run = mysqli_query($con, $sql);
    while($details = mysqli_fetch_assoc($run)){
        $dob = $details['dob'];
        $dobDateTime = DateTime::createFromFormat('d/m/Y', $dob);
        $currentDateTime = new DateTime();
        $ageInterval = $currentDateTime->diff($dobDateTime);
        $age = $ageInterval->y;
        ?>
        <tr>
            <td><img width="28" height="28" src="uploads/<?php echo $details['avatar']?>" class="rounded-circle m-r-5" alt=""><?php echo $details['first_name'].' '.$details['last_name']?></td>
            <td><?php echo $age?></td>
            <td><?php echo $details['city'].' '.$details['location']?></td>
            <td><?php echo $details['phone']?></td>
            <td><?php echo $details['email']?></td>
            <td><?php echo $details['disease']?></td>
            <td><span class="custom-badge status-green">Fully Served</span></td>
            <td class="text-right">
                <div class="dropdown dropdown-action">
                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <!-- <form action="server/edit-patient.php" method="get">
                            <input type="hidden" name="patient_id" value="<?php echo $details['id']?>">
                            <button class="dropdown-item" type="submit"><i class="fa fa-pencil m-r-5"></i> Edit</button>
                        </form>
                        <form action="server/delete-patient.php" method="post">
                            <input type="hidden" name="patient_id" value="<?php echo $details['id']?>">
                            <button class="dropdown-item" type="submit"><i class="fa fa-trash-o m-r-5"></i> Delete</button>
                        </form> -->
                    </div>
                </div>
            </td>
        </tr>
    <?php
    }
}


function new_patients(){
    global $con;
    $sql = "SELECT * FROM patients Where status = 0 ORDER BY created_at";
    $run = mysqli_query($con, $sql);
    while($details = mysqli_fetch_assoc($run)){
        $dob = $details['dob'];
        $dobDateTime = DateTime::createFromFormat('d/m/Y', $dob);
        $currentDateTime = new DateTime();
        $ageInterval = $currentDateTime->diff($dobDateTime);
        $age = $ageInterval->y;
        ?>
        <tr>
            <td><img width="28" height="28" src="uploads/<?php echo $details['avatar']?>" class="rounded-circle m-r-5" alt=""><?php echo $details['first_name'].' '.$details['last_name']?></td>
            <td><?php echo $age?></td>
            <td><?php echo $details['city'].' '.$details['location']?></td>
            <td><?php echo $details['phone']?></td>
            <td><?php echo $details['email']?></td>
            <td><?php echo $details['disease']?></td>
            <td><span class="custom-badge status-pink">Not Served</span></td>
            <td class="text-right">
                <div class="dropdown dropdown-action">
                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <?php
                        if ($_SESSION['usertype'] == '1' || $_SESSION['usertype'] == '2') {
                            ?>
                        <form action="edit-new-patient.php" method="get">
                            <input type="hidden" name="patient_id" value="<?php echo $details['id'] ?>">
                            <button class="dropdown-item" type="submit"><i class="fa fa-pencil m-r-5"></i> Edit</button>
                        </form>
                        <?php
                        }
                        ?>
                        <form action="server/delete-patient.php" method="post">
                            <input type="hidden" name="patient_id" value="<?php echo $details['id']?>">
                            <button class="dropdown-item" type="submit"><i class="fa fa-trash-o m-r-5"></i> Delete</button>
                        </form>
                    </div>
                </div>
            </td>
        </tr>
    <?php
    }
}


function dashboard_new_patients(){
    global $con;
    $sql = "SELECT * FROM patients Where status = 0 ORDER BY created_at LIMIT 5";
    $run = mysqli_query($con, $sql);
    while($details = mysqli_fetch_assoc($run)){
        $dob = $details['dob'];
        $dobDateTime = DateTime::createFromFormat('d/m/Y', $dob);
        $currentDateTime = new DateTime();
        $ageInterval = $currentDateTime->diff($dobDateTime);
        $age = $ageInterval->y;
        ?>
        <tr>
            <td>
                <img width="28" height="28" class="rounded-circle" src="uploads/<?php echo $details['avatar']?>" alt=""> 
                <h2><?php echo $details['first_name'].' '.$details['last_name']?></h2>
            </td>
            <td><?php echo $age.' years'?></td>
            <td><?php echo $details['email']?></td>
            <td><?php echo $details['phone']?></td>
            <td><button class="btn btn-primary btn-primary-one float-right"><?php echo $details['disease']?></button></td>
        </tr>
    <?php
    }
}


function dashboard_departments(){
    global $con;
    $sql = "SELECT * FROM departments LIMIT 5";
    $run = mysqli_query($con, $sql);
    while($details = mysqli_fetch_assoc($run)){
        ?>
        <div class="item">
            <div class="bar">
                <span class="percent"><?php echo $details['department_name']?></span>
                <div class="item-progress" data-percent="16">
                    <span class="title"><?php echo $details['department_name']?></span>
                </div>
            </div>
        </div>
    <?php
    }
}


function doctor_count(){
    global $con;
    $sql = "SELECT count(*) FROM users WHERE usertype = 2";
    $run = mysqli_query($con, $sql);
    echo mysqli_num_rows($run);
}

function patients_count(){
    global $con;
    $sql = "SELECT count(*) FROM patients";
    $run = mysqli_query($con, $sql);
    echo mysqli_num_rows($run);
}

function uncleared_patients(){
    global $con;
    $sql = "SELECT count(*) FROM patients WHERE status = 0 OR status = 2";
    $run = mysqli_query($con, $sql);
    echo mysqli_num_rows($run);
}

function cleared_patients(){
    global $con;
    $sql = "SELECT count(*) FROM patients WHERE status = 1";
    $run = mysqli_query($con, $sql);
    echo mysqli_num_rows($run);
}



function pharmacist_patients(){
    global $con;
    $sql = "SELECT * FROM patients Where status = 2 ORDER BY created_at";
    $run = mysqli_query($con, $sql);
    while($details = mysqli_fetch_assoc($run)){
        $dob = $details['dob'];
        $dobDateTime = DateTime::createFromFormat('d/m/Y', $dob);
        $currentDateTime = new DateTime();
        $ageInterval = $currentDateTime->diff($dobDateTime);
        $age = $ageInterval->y;
        ?>
        <tr>
            <td><img width="28" height="28" src="uploads/<?php echo $details['avatar']?>" class="rounded-circle m-r-5" alt=""><?php echo $details['first_name'].' '.$details['last_name']?></td>
            <td><?php echo $age?></td>
            <td><?php echo $details['city'].' '.$details['location']?></td>
            <td><?php echo $details['phone']?></td>
            <td><?php echo $details['email']?></td>
            <td><?php echo $details['disease']?></td>
            <td><span class="custom-badge status-orange">Partially Served</span></td>
            <td class="text-right">
                <div class="dropdown dropdown-action">
                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <form action="edit-pharmacist-patient.php" method="get">
                            <input type="hidden" name="patient_id" value="<?php echo $details['id']?>">
                            <button class="dropdown-item" type="submit"><i class="fa fa-pencil m-r-5"></i> Edit</button>
                        </form>
                    </div>
                </div>
            </td>
        </tr>
    <?php
    }
}


function clerks(){
    global $con;
    $sql = "SELECT * FROM users Where usertype = 4";
    $run = mysqli_query($con, $sql);
    while($details = mysqli_fetch_assoc($run)){
        ?>
        <tr>
            <td><img width="28" height="28" src="uploads/<?php echo $details['avatar']?>" class="rounded-circle m-r-5" alt=""><?php echo $details['first_name'].' '.$details['last_name']?></td>
            <td><?php echo $details['phone']?></td>
            <td><?php echo $details['email']?></td>
            <td><?php echo $details['address']?></td>
            <td><?php echo $details['city']?></td>
            <td class="text-right">
                <div class="dropdown dropdown-action">
                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <form action="edit-clerk.php" method="get">
                            <input type="hidden" name="clerk_id" value="<?php echo $details['id']?>">
                            <button class="dropdown-item" type="submit"><i class="fa fa-pencil m-r-5"></i> Edit</button>
                        </form>
                        <form action="server/delete-clerk.php" method="post">
                            <input type="hidden" name="clerk_id" value="<?php echo $details['id']?>">
                            <button class="dropdown-item" type="submit"><i class="fa fa-trash-o m-r-5"></i> Delete</button>
                        </form>
                    </div>
                </div>
            </td>
        </tr>
    <?php
    }
}


function pharmacists(){
    global $con;
    $sql = "SELECT * FROM users Where usertype = 3";
    $run = mysqli_query($con, $sql);
    while($details = mysqli_fetch_assoc($run)){
        ?>
        <tr>
            <td><img width="28" height="28" src="uploads/<?php echo $details['avatar']?>" class="rounded-circle m-r-5" alt=""><?php echo $details['first_name'].' '.$details['last_name']?></td>
            <td><?php echo $details['phone']?></td>
            <td><?php echo $details['email']?></td>
            <td><?php echo $details['address']?></td>
            <td><?php echo $details['city']?></td>
            <td class="text-right">
                <div class="dropdown dropdown-action">
                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <form action="edit-pharmacist.php" method="get">
                            <input type="hidden" name="pharmacist_id" value="<?php echo $details['id']?>">
                            <button class="dropdown-item" type="submit"><i class="fa fa-pencil m-r-5"></i> Edit</button>
                        </form>
                        <form action="server/delete-pharmacist.php" method="post">
                            <input type="hidden" name="pharmacist_id" value="<?php echo $details['id']?>">
                            <button class="dropdown-item" type="submit"><i class="fa fa-trash-o m-r-5"></i> Delete</button>
                        </form>
                    </div>
                </div>
            </td>
        </tr>
    <?php
    }
}


function schedules(){
    global $con;
    $sql = "SELECT * FROM schedules";
    $run = mysqli_query($con, $sql);
    while($details = mysqli_fetch_assoc($run)){
        $doc_id = $details['doctor_id'];
        $sql2 = "SELECT * FROM users WHERE id = $doc_id AND usertype = 2";
        $run2 = mysqli_query($con, $sql2);
        $fetch = mysqli_fetch_assoc($run2);

        $sql3 = "SELECT * FROM departments WHERE doctor_id = $doc_id";
        $run3 = mysqli_query($con, $sql3);
        $department = mysqli_fetch_assoc($run3);
        ?>
            <td><img width="28" height="28" src="uploads/<?php echo $fetch['avatar']?>" class="rounded-circle m-r-5" alt=""><?php echo $fetch['first_name'].' '.$fetch['last_name']?></td>
            <td><?php echo $department['department_name']?></td>
            <td><?php echo $details['days']?></td>
            <td><?php echo $details['start_time']?></td>
            <td><?php echo $details['end_time']?></td>
            <td><?php echo $details['note']?></td>
            <td><span class="custom-badge status-green"><?php echo $details['status']?></span></td>
            <td class="text-right">
                <div class="dropdown dropdown-action">
                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <?php
                        if ($_SESSION['usertype'] == '1') {
                            ?>
                        <form action="edit-schedule.php" method="get">
                            <input type="hidden" name="schedule_id" value="<?php echo $details['id'] ?>">
                            <button class="dropdown-item" type="submit"><i class="fa fa-pencil m-r-5"></i> Edit</button>
                        </form>
                        <form action="server/delete-schedule.php" method="post">
                            <input type="hidden" name="schedule_id" value="<?php echo $details['id'] ?>">
                            <button class="dropdown-item" type="submit"><i class="fa fa-trash-o m-r-5"></i> Delete</button>
                        </form>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </td>
        </tr>
    <?php
    }
}


function departments(){
    global $con;
    $sql = "SELECT * FROM departments";
    $run = mysqli_query($con, $sql);
    $count = 0;
    while($details = mysqli_fetch_assoc($run)){
        $count++;
        ?>
            <td><?php echo $count?></td>
            <td><?php echo $details['department_name']?></td>
            <td><?php echo $details['description']?></td>
            <td><span class="custom-badge status-green"><?php echo $details['status']?></span></td>
            <td class="text-right">
                <div class="dropdown dropdown-action">
                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <?php
                        if ($_SESSION['usertype'] == '1') {
                            ?>
                        <form action="edit-department.php" method="get">
                            <input type="hidden" name="dapartment_id" value="<?php echo $details['id'] ?>">
                            <button class="dropdown-item" type="submit"><i class="fa fa-pencil m-r-5"></i> Edit</button>
                        </form>
                        <form action="server/delete-department.php" method="post">
                            <input type="hidden" name="dapartment_id" value="<?php echo $details['id'] ?>">
                            <button class="dropdown-item" type="submit"><i class="fa fa-trash-o m-r-5"></i> Delete</button>
                        </form>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </td>
        </tr>
    <?php
    }
}


function doctor_dropdown(){
    global $con;
    $sql = "SELECT * FROM users WHERE usertype = 2";
    $run = mysqli_query($con, $sql);
    while($details = mysqli_fetch_assoc($run)){?>
        <option value="<?php echo $details['id']?>"><?php echo $details['first_name'].' '.$details['last_name']?></option>
    <?php
    }
}

function doctor_dropdown2($doctor_id){
    global $con;
    $sql = "SELECT * FROM users WHERE usertype = 2";
    $run = mysqli_query($con, $sql);
    while($details = mysqli_fetch_assoc($run)){
        if ($details['id'] == $doctor_id) {?>
            <option value="<?php echo $details['id'] ?>" selected><?php echo $details['first_name'] . ' ' . $details['last_name'] ?></option>
    <?php
        }
        else{?>
            <option value="<?php echo $details['id'] ?>"><?php echo $details['first_name'] . ' ' . $details['last_name'] ?></option>
        <?php
        }
    }
}

function health_records(){
    global $con;
    $sql = "SELECT p.* FROM patients p INNER JOIN (SELECT MIN(id) as id FROM patients WHERE status = 1 GROUP BY phone, email) as unique_patients ON p.id = unique_patients.id ORDER BY p.created_at";
    $run = mysqli_query($con, $sql);
    while($details = mysqli_fetch_assoc($run)){
        $dob = $details['dob'];
        $dobDateTime = DateTime::createFromFormat('d/m/Y', $dob);
        $currentDateTime = new DateTime();
        $ageInterval = $currentDateTime->diff($dobDateTime);
        $age = $ageInterval->y;
        ?>
        <tr>
            <td><img width="28" height="28" src="uploads/<?php echo $details['avatar']?>" class="rounded-circle m-r-5" alt=""><?php echo $details['first_name'].' '.$details['last_name']?></td>
            <td><?php echo $age?></td>
            <td><?php echo $details['city'].' '.$details['location']?></td>
            <td><?php echo $details['phone']?></td>
            <td><?php echo $details['email']?></td>
            <td class="text-right">
                <div class="dropdown dropdown-action">
                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <button class="dropdown-item view_records_button" value="<?php echo $details['id']?>"><i class="fa fa-file-o"></i> View Records</button>
                        <!-- <form action="server/delete-patient.php" method="post">
                            <input type="hidden" name="patient_id" value="<?php echo $details['id']?>">
                            <button class="dropdown-item" type="submit"><i class="fa fa-trash-o m-r-5"></i> Delete</button>
                        </form> -->
                    </div>
                </div>
            </td>
        </tr>
    <?php
    }
}