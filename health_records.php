<!DOCTYPE html>
<html lang="en">


<!-- patients23:17-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>E-Health</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
	<![endif]-->
</head>
<style>
    .view_records{
        display: none;
        position: absolute;
        width: 50%;
        max-height: 80vh;
        overflow-y: auto;
        border-radius: 5px;
        background: #009efb;
        box-shadow: 0 0 15px rgba(0, 0, 0, .1);
        padding: 15px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 10;
    }
    .view_records h3{
        width: 100%;
        color: #fff;
    }
    .view_records .record{
        padding: 5px;
        border-radius: 3px;
        background: #fff;
        margin-bottom: 20px;
        color: #000;
    }
    .analysis{
        border-bottom: 1px solid rgba(0, 0, 0, .2);
    }
    .report_close, .pdf{
        float: right;
    }
</style>
<body>
    <div class="main-wrapper">
        <?php include 'includes/heading.php'?>
		<?php include 'includes/functions.php'?>
        <div class="page-wrapper">
            <div class="content">
                <div class="view_records">
                </div>
                <div class="row">
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">Patients' Health Records</h4>
                    </div>
                </div>
				<div class="row">
					<div class="col-md-12">
						<div class="table-responsive">
							<table class="table table-border table-striped custom-table datatable mb-0">
								<thead>
									<tr>
										<th>Name</th>
										<th>Age</th>
										<th>Address</th>
										<th>Phone</th>
										<th>Email</th>
										<th class="text-right">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php health_records()?>
								</tbody>
							</table>
						</div>
					</div>
                </div>
            </div>
        </div>
		<div id="delete_patient" class="modal fade delete-modal" role="dialog">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-body text-center">
						<img src="assets/img/sent.png" alt="" width="50" height="46">
						<h3>Are you sure want to delete this Patient?</h3>
						<div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
							<button type="submit" class="btn btn-danger">Delete</button>
						</div>
					</div>
				</div>
			</div>
			
		</div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="assets/js/printThis.js"></script>
	<script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/select2.min.js"></script>
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/bootstrap-datetimepicker.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>
<script>
    $(document).ready(function () {
        $('.view_records_button').on('click', function(){
            var patient_id = $(this).val();
            $.ajax({
                type: "post",
                url: "server/view_patient_records.php",
                data: {patient_id: patient_id},
                dataType: "html",
                success: function (response) {
                    $('.view_records').show();
                    $('.view_records').html(response);

                    $('.pdf').on('click', function() {
                        var patient_name = $(this).val();
                        $('.record').printThis({
                            importCSS: true,
                            header: '<h3>'+patient_name+' Medical Report</h3>',
                        });
                    });

                    $('.report_close').on('click', function(){
                        $('.view_records').hide();
                    });
                },
                error:function(){
                    alert('An error happened!');
                }
            });
        });
    });
</script>
</html>