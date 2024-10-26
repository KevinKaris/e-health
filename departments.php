<!DOCTYPE html>
<html lang="en">


<!-- departments23:21-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>E-Health</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/dataTables.bootstrap4.min.css">
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
        <?php include 'includes/functions.php'?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-5 col-5">
                        <h4 class="page-title">Departments</h4>
                    </div>
                    <div class="col-sm-7 col-7 text-right m-b-30">
                        <?php
                        if ($_SESSION['usertype'] == '1') {
                            ?>
                        <a href="add-department.php" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i> Add Department</a>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table mb-0 datatable">
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
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Department Name</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php departments()?>
                                </tbody>
                            </table>
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
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/app.js"></script>
</body>


<!-- departments23:21-->
</html>