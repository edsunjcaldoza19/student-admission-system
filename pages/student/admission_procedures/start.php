<?php

	$email = '';
	require '../../backend/auth/check_token.php';

	if(isset($_SESSION['student_token'])){

		$sql = $conn->prepare("SELECT *, tbl_applicant_account.id FROM tbl_applicant_account
        LEFT JOIN tbl_applicant ON tbl_applicant_account.id = tbl_applicant.applicant_account_id
        WHERE `session_token` = '$token'");
		$sql->execute();

		//checks if examination module is activated//
		$sql1 = $conn->prepare("SELECT * from `tbl_academic_year` WHERE `ay_status` = 1");
		$sql1->execute();
		$fetch1 = $sql1->fetch();

		if($fetch = $sql->fetch()){

			$interview_status = $fetch['interview_progress'];

			//Determine if re-admission
			$entry_type = $fetch['entry'];

		}

		if($interview_status == 'Done'){

			echo '

				<script>
					window.location.replace("done.php");
				</script>

			';

		}

	}

?>

<!DOCTYPE html>
<html>
<head>

	<title>LNU SAIS | Admission Procedure</title>

		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- Imports third-party CSS libraries -->

		<link rel="stylesheet" type="text/css" href="../../assets/libs/bootstrap/css/bootstrap.min.css">
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
							<p class="sidebar-header" style="margin-bottom: 3px;">SCHOOL YEAR</p>
								<p class="sidebar-link"><?php echo $fetch1['ay_year']?></p>
							<p class="sidebar-header">NAVIGATE</p>
							<div class="sidebar-item">
								<i class="far fa-user-circle sidebar-navigation-icon"></i> <a href="../help/my_status.php" class="sidebar-link">My Status</a>
							</div>
							<hr class="default-divider ml-auto" style="margin: 10px;">
							<div class="sidebar-item">
								<i class="far fa-comments sidebar-navigation-icon"></i> <a href="../help/send_inquiry.php" class="sidebar-link">Send Inquiry</a>
							</div>
						</div>
						<div class="sidebar-progress" style="opacity: 0.5">
							<a class="sidebar-header" href="#" data-toggle="collapse" data-target="#collapse-progress">PROGRESS CHECKLIST <i class="fas fa-caret-down"></i></a>
							<div class="collapse" id="collapse-progress">
								<div class="sidebar-item">
									<i class="far fa-times-circle sidebar-progress-icon"></i> Application Form (1/2)
								</div>
								<div class="sidebar-item">
									<hr class="default-divider ml-auto" style="margin: 10px;">
									<i class="far fa-times-circle sidebar-progress-icon"></i> Application Form (2/2)
								</div>
								<div class="sidebar-item" <?php if($fetch1['enable_exam'] == 1 && $entry_type !== 'Re-admission'){
								echo 'style="display:block"';}else{echo 'style="display:none"';}?>>
									<hr class="default-divider ml-auto" style="margin: 10px;">
									<i class="far fa-times-circle sidebar-progress-icon"></i> Entrance Examination
								</div>
								<div class="sidebar-item">
									<hr class="default-divider ml-auto" style="margin: 10px;">
									<i class="far fa-times-circle sidebar-progress-icon"></i> Interview/Evaluation
								</div>
							</div>
						</div>

					</div>
				</aside>
				<aside id="sidebar-hidden" class="sidebar-hidden">
					<div class="student-sidebar-container-hidden">
						<div class="sidebar-navigation">
							<p class="sidebar-header" style="margin-bottom: 3px;">SCHOOL YEAR</p>
								<p class="sidebar-link"><?php echo $fetch1['ay_year']?></p>
							<p class="sidebar-header">NAVIGATE</p>
							<div class="sidebar-item">
								<i class="far fa-user-circle sidebar-navigation-icon"></i> <a href="../help/my_status.php" class="sidebar-link">My Status</a>
							</div>
							<hr class="default-divider ml-auto" style="margin: 10px;">
							<div class="sidebar-item">
								<i class="far fa-comments sidebar-navigation-icon"></i> <a href="../help/send_inquiry.php" class="sidebar-link">Send Inquiry</a>
							</div>
						</div>
						<div class="sidebar-progress" style="opacity: 0.5;">
							<a class="sidebar-header" href="#" data-toggle="collapse" data-target="#collapse-progress-hidden">PROGRESS CHECKLIST <i class="fas fa-caret-down"></i></a>
							<div class="collapse" id="collapse-progress-hidden">
								<div class="sidebar-item">
									<i class="far fa-times-circle sidebar-progress-icon"></i> Application Form (1/2)
								</div>
								<div class="sidebar-item">
									<hr class="default-divider ml-auto" style="margin: 10px;">
									<i class="far fa-times-circle sidebar-progress-icon"></i> Application Form (2/2)
								</div>
								<div class="sidebar-item" <?php if($fetch1['enable_exam'] == 1 && $entry_type !== 'Re-admission'){
								echo 'style="display:block"';}else{echo 'style="display:none"';}?>>
									<hr class="default-divider ml-auto" style="margin: 10px;">
									<i class="far fa-times-circle sidebar-progress-icon"></i> Entrance Examination
								</div>
								<div class="sidebar-item">
									<hr class="default-divider ml-auto" style="margin: 10px;">
									<i class="far fa-times-circle sidebar-progress-icon"></i> Interview/Evaluation
								</div>
							</div>
						</div>
					</div>
				</aside>
			</div>
			<div class="col-md-10">
				<div class="student-page-container">
					<div class="student-account-container">
						<p id="datetime" class="default-datetime">0:00 </p>
						<div class="student-account-details">
							<p class="student-account-details-item"><b>Hi, <?php echo $email ?></b></p>
							<a class="student-account-details-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
						</div>
					</div>
					<div class="student-page-start">
						<div class="row">
							<div class="col-md-3"></div>
							<div class="col-md-6" style="text-align: left;">
								<p class="page-start-text">Greetings, future Normalista!</p>
								<p class="page-start-subtext">You are currently using Leyte Normal University's online admission platform. Before proceeding, please take note of the following instructions below:</p>
								<li class="page-start-subtext-text">You may check your student application's status using the <strong>My Status Tab</strong> on the sidebar.</li>
								<li class="page-start-subtext-text">For feedbacks, suggestions or problems encountered, you may use the <strong>Send Inquiry Tab</strong> on the sidebar.</li>
								<li class="page-start-subtext-text">To track your progress, kindly refer to the <strong>Progress Checklist Tab.</strong>

								<div class="page-start-button-container">
									<button class="default-button page-start-button" name="btnBegin" data-toggle="modal" data-target="#privacyPolicyModal" >
										<?php
											if($form1 == 'Not Started'){
												echo 'Begin Admission Process';
											}else{
												echo 'Resume Process';
											}
										?>
									</button>
								</div>
							</div>
							<div class="col-md-3"></div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>

	<div class="modal fade" id="privacyPolicyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    	<div class="modal-dialog" role="document">
      		<div class="modal-content">
       			<div class="modal-header">
       			  <p class="modal-header-text">Terms and Privacy Policy</p>
       			  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
       			    <span aria-hidden="true">×</span>
       			  </button>
       			</div>
       			<div class="modal-body">
       				<div class="modal-instructions">
       					<p class="modal-body-header">
       						Instructions
       					</p>
       					<p class="modal-body-item">
       						1. Read carefully the admissions guidelines before filling out
       						this application form.
       					</p>
       					<p class="modal-body-item">
       						2. Please fill out this form carefully and completely. Type all requested
       						information.
       					</p>
       					<p class="modal-body-item">
       						3. Only correctly and completely accomplished application form will be accepted.
       					</p>
       					<p class="modal-body-item">
       						4. Incomplete application form and admission requirements will not be processed.
       					</p>
       					<p class="modal-body-item">
       						5. Documents submitted in compliance with the admission shall become the property of
       						the University and will not be returned to the applicant.
       					</p>
       				</div>
       				<hr class="default-divider ml-auto" style="margin: 10px;">
       				<div class="modal-privacy-notice" id="modal-privacy-notice">
       					<p class="modal-body-header">
       						Privacy Notice
       					</p>
       					<p class="modal-body-item">
       						I know that the information that will be collected relates to my admission and will
       						be handled, processed, protected, shared, retained and to be used by the University for
       						its pursuits of legitimate purposes.
       					</p>
       					<br>
       					<p class="modal-body-item">
       						By clicking PROCEED, <b>I AGREE</b> that the data pertaining to screening will be treated for:
       					</p>
       					<p class="modal-body-item">
       						- Collection and records keeping during my stay in the University;
       					</p>
       					<p class="modal-body-item">
       						- Publication/Posting of my name, if qualified;
       					</p>
       					<p class="modal-body-item">
       						- Be destroyed one (1) year after my graduation/transfer;
       					</p>
       					<p class="modal-body-item">
       						- Be used for reporting for and by the Admissions Director, Guidance and Testing
       						Office, and the University;
       					</p>
       					<p class="modal-body-item">
       						- Be used for creating programs and activities of the Admissions Director and the Guidance and
       						Testing Office;
       					</p>
       					<br>
       					<p class="modal-body-item">
       						By clicking PROCEED, <b>I AGREE</b> further that if qualified to be a student of Leyte Normal University,
       						I will abide by all the rules and regulations of the University.
       					</p>
       				</div>
       				<div class="modal-footer" style="padding: 10px;">
       				  <a class="default-button" href="application_form1.php" style="padding: 5px 10px 5px 10px; position: relative;">Proceed</a>
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
	<script src="../../assets/libs/jquery-slimscroll/jquery.slimscroll.js"></script>

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
			$('#modal-privacy-notice').slimScroll({
				height: '250px'
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

		//auto logout on idle script//

		var maxIdle = 25; //log the user out after 25 minutes of inactivity
		var idleTime = 0;

		var idleInterval = setInterval("incrementTimer()", 60000);
		$("body").mousemove(function(event){
			idleTime = 0;
		})

		//increment idle time every minute

		function incrementTimer(){
			idleTime = idleTime + 1;
			if(idleTime > maxIdle){
				alert("[WARNING]: You've been logged-out due to inactivity. Please login again");
				window.location = "../../backend/auth/student_logout.php" ;
			}
		}

	</script>

</body>
</html>