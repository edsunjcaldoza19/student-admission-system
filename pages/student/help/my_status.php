<?php

	$email = '';
	require '../../backend/auth/check_token.php';

	try{

		$sql = $conn->prepare("SELECT *, tbl_applicant_account.id FROM tbl_applicant_account
        LEFT JOIN tbl_applicant ON tbl_applicant_account.id = tbl_applicant.applicant_account_id 
        WHERE `session_token` = '$token'");
    	$sql->execute();
    	$application = $sql->fetch();

    	if($application == ''){

    		$application['first_name'] = '--';
    		$application['middle_name'] = '--';
    		$application['last_name'] = '--';
    		$application['entry'] = 'N/A';
    		$application['form_status'] = 'Pending';
    		$application['fs_timestamp'] = 'N/A';
			$application['exam_status'] = 'Pending';
    		$application['es_timestamp'] = 'N/A';
			$application['interview_status_1'] = 'Pending';
    		$application['is_timestamp_1'] = 'N/A';
    		$application['interview_status_2'] = 'Pending';
    		$application['is_timestamp_2'] = 'N/A';
			$application['admission_status'] = 'Pending';
    		$application['as_timestamp'] = 'N/A';

    	}else{

    		if($application['form_status'] == ''){
    			$application['form_status'] = 'Pending';
    			$application['fs_timestamp'] = 'N/A';
    		}
    		if($application['exam_status'] == ''){
    			$application['exam_status'] = 'Pending';
    			$application['es_timestamp'] = 'N/A';
    		}
    		if($application['interview_status_1'] == ''){
    			$application['interview_status_1'] = 'Pending';
    			$application['is_timestamp_1'] = 'N/A';
    		}
    		if($application['interview_status_2'] == ''){
    			$application['interview_status_2'] = 'Pending';
    			$application['is_timestamp_2'] = 'N/A';
    		}
    		if($application['admission_status'] == ''){
    			$application['admission_status'] = 'Pending';
    			$application['as_timestamp'] = 'N/A';
    		}

    	}

    	if($application['form_status'] == 'Pending'){

    		$application['as_timestamp'] = 'N/A';

    	}

		if($application['exam_status'] == 'Pending'){

    		$application['es_timestamp'] = 'N/A';

    	}

		if($application['interview_status_1'] == 'Pending'){

    		$application['is_timestamp_1'] = 'N/A';

    	}

    	if($application['interview_status_2'] == 'Pending'){

    		$application['is_timestamp_2'] = 'N/A';

    	}

    	if($application['interview_progress'] == 'Done'){

    		echo '

			<script>

				window.location.replace("../admission_procedures/done.php");

			</script>

			';

    	}

    	$sql1 = $conn->prepare("SELECT * FROM `tbl_academic_year` WHERE `ay_status` = 1");
    	$sql1->execute();
    	$academicYear = $sql1->fetch();

	}catch(exception $e){
		echo 'Error: '.$e->getMessage();
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>LNU SAIS | My Status</title>

		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- Imports third-party CSS libraries -->

		<link rel="stylesheet" type="text/css" href="../../assets/libs/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../../assets/libs/bootstrap-select/dist/css/bootstrap-select.css">
    	<link rel="stylesheet" type="text/css" href="../../assets/libs/bootstrap-datepicker/css/bootstrap-datepicker3.css" />
		<link rel="stylesheet" type="text/css" href="../../assets/libs/font-awesome/css/all.css">

		<!-- Imports default styling -->

		<link rel="stylesheet" type="text/css" href="../../assets/css/style.css">

		<link rel="shortcut-icon" href="../../assets/images/lnu.ico" type="image/x-icon"/>
  		<link rel="icon" href="../../assets/images/lnu.ico" type="image/x-icon"/>

</head>
<body id="body">

	<nav class="navbar navbar-expand-sm student-navbar-secondary" style="z-index: 3">
		<div class="student-navbar-logo-container secondary">
			<a class="navbar-brand" href="#">
				<img src="../../assets/images/navbar_logo_mobile.png" class="secondary-logo">
			</a>
		</div>
		<div class="student-navbar-hamburger-container">
			<a href="#" id="sidebar-toggle">
				<img src="../../assets/images/navbar_burger_icon.png" class="burger-icon">
			</a>
		</div>
	</nav>

	<div class="container-fluid">

		<div class="row">
			<div class="col-md-2" style="padding: 0px;">
				<aside id="sidebar" class="sidebar">
					<div class="student-sidebar-container">
						<div class="student-sidebar-logo-container">
							<img src="../../assets/images/sidebar-logo.png" class="sidebar-logo">
						</div>
						<div class="sidebar-navigation">
							<div class="sidebar-item">
								<i class="fa fa-arrow-circle-left sidebar-navigation-icon" style="color: #C2C2C2;"></i> <a href="../admission_procedures/start.php"
								class="sidebar-link" style="color: #C2C2C2;">Return</a>
							</div>
							<hr class="default-divider ml-auto" style="margin: 10px;">
							<p class="sidebar-header">NAVIGATE</p>
							<div class="sidebar-item">
								<i class="far fa-user-circle sidebar-navigation-icon"></i> <a href="javascript:void(0);" class="sidebar-link active">My Status</a>
							</div>
							<hr class="default-divider ml-auto" style="margin: 10px;">
							<div class="sidebar-item">
								<i class="far fa-comments sidebar-navigation-icon"></i> <a href="send_inquiry.php" class="sidebar-link">Send Inquiry</a>
							</div>
						</div>
					</div>
				</aside>
				<aside id="sidebar-hidden" class="sidebar-hidden">
					<div class="student-sidebar-container-hidden">
						<div class="sidebar-navigation">
							<div class="sidebar-item">
								<i class="fa fa-arrow-circle-left sidebar-navigation-icon" style="color: #C2C2C2;"></i> <a href="../admission_procedures/start.php"
								class="sidebar-link" style="color: #C2C2C2;">Return</a>
							</div>
							<hr class="default-divider ml-auto" style="margin: 10px;">
							<p class="sidebar-header">NAVIGATE</p>
							<div class="sidebar-item">
								<i class="far fa-user-circle sidebar-navigation-icon"></i> <a href="javascript:void(0);" class="sidebar-link active">My Status</a>
							</div>
							<hr class="default-divider ml-auto" style="margin: 10px;">
							<div class="sidebar-item">
								<i class="far fa-comments sidebar-navigation-icon"></i> <a href="send_inquiry.php" class="sidebar-link">Send Inquiry</a>
							</div>
						</div>
					</div>
				</aside>
			</div>
			<div class="col-md-10">
				<div class="student-page-container">
					<div class="student-account-container">
						<p id="datetime" class="default-datetime">0:00</p>
						<div class="student-account-details">
							<p class="student-account-details-item name"><b>Hi, <?php echo $email ?></b></p>
							<a class="student-account-details-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
						</div>
					</div>
					<div class="student-page-default" id="student-page-default" style="height: 550px; margin-bottom: 20px;">
						<div class="row">
							<div class="col-md-6">
								<img src="../../assets/images/status-image.png" class="status-placeholder-image">
							</div>
							<div class="col-md-6" style="padding: 0px 30px 0px 30px; overflow: hidden;">
								<p class="exam-placeholder-header" style="font-size: 30px; margin-top: 30px;">
									My Status
								</p>
								<p class="exam-placeholder-subheader" style="font-size: 15px; margin-top: 5px; margin-bottom: 5px;">
									Applicant Name:
								</p>
								<p class="default-interface-text name">
									<?php echo $application['first_name'] ?> <?php echo $application['middle_name'] ?> <?php echo $application['last_name'] ?> (<?php echo $application['entry'] ?>)
								</p>
								<div id="status-labels" style="overflow-x: auto">
									<!-- Progress Monitoring -->

									<hr class="default-divider ml-auto" style="margin: 5px;">
										<p class="exam-placeholder-subheader" style="font-size: 15px; margin-top: 5px; margin-bottom: 5px;">
											PROGRESS MONITORING
										</p>
									<hr class="default-divider ml-auto" style="margin: 5px;">
									<p class="default-interface-subheader">
										Filling-out of Application Form
									</p>
									<p class="default-interface-text">
										<?php
											if($fetch['form1_progress'] == 'Not Started' && $fetch['form2_progress'] == 'Not Started'){
												echo '<i class="far fa-times-circle sidebar-progress-icon"></i>';
												echo ''.$fetch['form2_progress']. ' ('.$fetch['fp_timestamp'].')';
											}else if($fetch['form1_progress'] == 'Done' && $fetch['form2_progress'] == 'Not Started'){
												echo '<i class="far fa-check-circle sidebar-progress-icon done"></i>';
												echo 'Started '.' ('.$fetch['fp_timestamp'].')';;
											}else{
												echo '<i class="far fa-check-circle sidebar-progress-icon done"></i>';
												echo ''.$fetch['form2_progress']. ' ('.$fetch['fp_timestamp'].')';
											}
										?>
										
									</p>
									<hr class="default-divider ml-auto" style="margin: 10px;">

									<div style="<?php if($academicYear['enable_exam'] == 1){echo 'display:block';}else{echo 'display:none';}?>">
										<p class="default-interface-subheader">
											Entrance Examination
										</p>
										<p class="default-interface-text">
											<?php
												if($fetch['examination_progress'] == 'Not Started'){
													echo '<i class="far fa-times-circle sidebar-progress-icon"></i>';
												}else{
													echo '<i class="far fa-check-circle sidebar-progress-icon done"></i>';
												}
											?>
											<?php echo $fetch['examination_progress'] ?> (<?php echo $fetch['ep_timestamp'] ?>)
										</p>
										<hr class="default-divider ml-auto" style="margin: 10px;">
									</div>
									<p class="default-interface-subheader">
										Interview
									</p>
									<p class="default-interface-text">
										<?php
											if($fetch['interview_progress'] == 'Not Started'){
												echo '<i class="far fa-times-circle sidebar-progress-icon"></i>';
											}else{
												echo '<i class="far fa-check-circle sidebar-progress-icon done"></i>';
											}
										?>
										<?php echo $fetch['interview_progress'] ?> (<?php echo $fetch['ip_timestamp'] ?>)
									</p>
						

									<!-- Admission Status -->

									<hr class="default-divider ml-auto" style="margin: 5px;">
										<p class="exam-placeholder-subheader" style="font-size: 15px; margin-top: 5px; margin-bottom: 5px;">
											ADMISSION STATUS MONITORING
										</p>
									<hr class="default-divider ml-auto" style="margin: 5px;">
									<p class="default-interface-subheader">
										Application Form Status
									</p>
									<p class="default-interface-text">
										<?php
											if($application['form_status'] == 'Approved'){
												echo '<i class="far fa-check-circle sidebar-progress-icon done"></i>';
											}else if($application['form_status'] == 'Pending'){
												echo '<i class="far fa-question-circle sidebar-progress-icon"></i>';
											}else{
												echo '<i class="far fa-times-circle sidebar-progress-icon"></i>';
											}
										?>
										<?php echo $application['form_status'] ?> (<?php echo $application['fs_timestamp'] ?>)
									</p>
									<p style="margin-left: 22px; <?php if($application['form_status'] == 'Disapproved'){echo 'display:block';}else{echo 'display:none';} ?>">
										<i>Remarks: <?php echo $application['remarks'];?></i>
									</p>
									<hr class="default-divider ml-auto" style="margin: 10px;">
									<div style="<?php if($application['entry'] !== 'Re-admission'){echo 'display:block';}else{echo 'display:none';}?>">
										<p class="default-interface-subheader">
										Entrance Examination Status
										</p>
										<p class="default-interface-text">
											<?php
												if($application['exam_status'] == 'Scored'){
													echo '<i class="far fa-check-circle sidebar-progress-icon done"></i>';
												}else if($application['exam_status'] == 'Pending'){
													echo '<i class="far fa-question-circle sidebar-progress-icon"></i>';
												}else{
													echo '<i class="far fa-times-circle sidebar-progress-icon"></i>';
												}
											?>
											<?php echo $application['exam_status'] ?> (<?php echo $application['es_timestamp'] ?>)
										</p>
										<hr class="default-divider ml-auto" style="margin: 10px;">
									</div>
									<p class="default-interface-subheader">
										Interview Status
									</p>
									<p style="font-weight: 600; margin-bottom: 5px; font-size: 14px;">First Choice:</p>
									<p class="default-interface-text">
										<?php
											if($application['interview_status_1'] == 'Qualified' || $application['interview_status_1'] == 'Scheduled'){
												echo '<i class="far fa-check-circle sidebar-progress-icon done"></i>';
											}else if($application['interview_status_1'] == 'Pending'){
												echo '<i class="far fa-question-circle sidebar-progress-icon"></i>';
											}else{
												echo '<i class="far fa-times-circle sidebar-progress-icon"></i>';
											}
										?>
										<?php echo $application['interview_status_1'] ?> (<?php echo $application['is_timestamp_1'] ?>)
									</p>
									<p style="font-weight: 600; margin-bottom: 5px; font-size: 14px;">Second Choice:</p>
									<p class="default-interface-text">
										<?php
											if($application['interview_status_2'] == 'Qualified' || $application['interview_status_2'] == 'Scheduled'){
												echo '<i class="far fa-check-circle sidebar-progress-icon done"></i>';
											}else if($application['interview_status_2'] == 'Pending'){
												echo '<i class="far fa-question-circle sidebar-progress-icon"></i>';
											}else{
												echo '<i class="far fa-times-circle sidebar-progress-icon"></i>';
											}
										?>
										<?php echo $application['interview_status_2'] ?> (<?php echo $application['is_timestamp_2'] ?>)
									</p>
									<hr class="default-divider ml-auto" style="margin: 10px;">
									<p class="default-interface-subheader">
										Admission Status
									</p>
									<p class="default-interface-text">
										<?php
											if($application['admission_status'] == 'Evaluated'){
												echo '<i class="far fa-check-circle sidebar-progress-icon done"></i>';
											}else if($application['admission_status'] == 'Pending'){
												echo '<i class="far fa-question-circle sidebar-progress-icon"></i>';
											}else{
												echo '<i class="far fa-times-circle sidebar-progress-icon"></i>';
											}
										?>
										<?php echo $application['admission_status'] ?> (<?php echo $application['as_timestamp'] ?>)
									</p>
									<hr class="default-divider ml-auto" style="margin: 10px;">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    	<div class="modal-dialog" role="document">
      		<div class="modal-content">
       			<div class="modal-header">
       			  <p class="modal-header-text">Confirm Logout?</p>
       			  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
       			    <span aria-hidden="true">×</span>
       			  </button>
       			</div>
       			<div class="modal-body">
       				<p>Are you sure you want to logout?</p>
      			</div>
      			<div class="modal-footer" style="padding: 10px;">
       			  <a class="default-button" href="../../backend/auth/student_logout.php" style="padding: 5px 10px 5px 10px; position: relative;">Confirm</a>
       			</div>
    		</div>
  		</div>
  	</div>

	<footer class="footer-subfooter" style="bottom: 0;">
		<p class="subfooter-text">
			All Rights Reserved - Leyte Normal University | Maintained by MIS Office
		</p>
	</footer>

	<script src="../../assets/libs/jquery/jquery.min.js"></script>
	<script src="../../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="../../assets/libs/bootstrap-select/dist/js/bootstrap-select.js"></script>
	<script src="../../assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script src="../../assets/libs/jquery-slimscroll/jquery.slimscroll.js"></script>
    <script src="../../assets/libs/node-waves/waves.js"></script>
    <script src="../../assets/js/template/admin.js"></script>
    <script src="../../assets/js/template/demo.js"></script>

	<!-- Additional JS codes -->

	<script>

		var toggleClicks = 0;

		$(document).ready(function () {
        	showDateTime();
    	});

		$('#sidebar-toggle').click(function () {

			toggleClicks++;

			if(toggleClicks %2 == 0){
				closeSidebar();
			}else{
				openSidebar();
			}

    	});

		$(function(){
			$('#status-labels').slimScroll({
				height: '350px'
			});
		});


		function openSidebar(){

			document.getElementById("sidebar-hidden").style.width = "300px";
			document.getElementById("body").style.overflowY = "hidden";

		}

		function closeSidebar(){

			document.getElementById("sidebar-hidden").style.width = "0px";
			document.getElementById("body").style.overflowY = "auto";

		}

		function showDateTime(){

  			var dt = new Date();

  			document.getElementById("datetime").innerHTML = (("0"+(dt.getMonth()+1)).slice(-2)) + "/" + (("0"+dt.getDate()).slice(-2)) + "/" + (dt.getFullYear()) + " | " + (("0" + dt.getHours()).slice(-2)) + ":" + (("0" + dt.getMinutes()).slice(-2)) + ":" + (("0" + dt.getSeconds()).slice(-2));

  			setTimeout("showDateTime()", 1000);

  		}

  		var previewImage = function(event){
            var output = document.getElementById("preview");
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function(){
                URL.revokeObjectURL(output.src)
            }
        }


	</script>

</body>
</html>