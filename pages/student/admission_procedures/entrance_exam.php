<?php

	date_default_timezone_set('Asia/Taipei');
	$today = new DateTime();
	$email = '';
	require '../../backend/auth/check_token.php';

	if(isset($_SESSION['student_token'])){

		$sql = $conn->prepare("SELECT *, tbl_applicant_account.id FROM tbl_applicant_account
        LEFT JOIN tbl_applicant ON tbl_applicant_account.id = tbl_applicant.applicant_account_id 
        WHERE `session_token` = '$token'");
		$sql->execute();

		if($fetch = $sql->fetch()){

			$form1_status = $fetch['form1_progress'];
			$form2_status = $fetch['form2_progress'];
			$exam_status = $fetch['examination_progress'];

			//Determine if re-admission
			$entry_type = $fetch['entry'];

			$sql1 = $conn->prepare("SELECT * from `tbl_academic_year` WHERE `ay_status` = 1");
			$sql1->execute();
			$sql2 = $conn->prepare("SELECT * from `tbl_exam`");
			$sql2->execute();

			if($fetch1 = $sql1->fetch()){

				$exam_enabled = $fetch1['enable_exam'];

				if($fetch2 = $sql2->fetch()){

					if($exam_enabled == 1){

						$exam_start = new DateTime($fetch2['exam_start_date']);
						$exam_end = new DateTime($fetch2['exam_end_date']);
						$exam_stat = $fetch2['exam_status'];

						if($today >= $exam_start && $today < $exam_end){

							$exam_stat = "Activated";
							$time_limit = $fetch2['exam_time_limit'];

						}else if($today >= $exam_end){

							$exam_stat = "Expired";

						}else{

							$exam_stat = "Deactivated";

						}

					}else if($exam_enabled == 0){

						echo '

							<script>
								window.location.replace("interview.php");
							</script>

						';

					}

				}else{

					$exam_stat = "Not Set";

				}

			}

		}

		if($exam_status == 'Done' || $entry_type == 'Re-admission'){

			echo '

			<script>
				window.location.replace("interview.php");
			</script>

			';

		}else if ($form2_status == 'Not Started'){

			echo '

			<script>
				alert("[MESSAGE]: Finish the previous step first!");
				window.location.replace("application_form2.php");
			</script>

			';

		}

	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>LNU SAIS | Entrance Examination</title>

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
						<div class="sidebar-progress">
							<a class="sidebar-header" href="#" data-toggle="collapse" data-target="#collapse-progress">PROGRESS CHECKLIST <i class="fas fa-caret-down"></i></a>
							<div class="collapse show" id="collapse-progress">
								<div class="sidebar-item">
									<i class="fas fa-check-circle sidebar-progress-icon done"></i> Application Form (1/2)
								</div>
								<div class="sidebar-item">
									<hr class="default-divider ml-auto" style="margin: 10px;">
									<i class="fas fa-check-circle sidebar-progress-icon done"></i> Application Form (2/2)
								</div>
								<div class="sidebar-item active">
									<hr class="default-divider ml-auto" style="margin: 10px;">
									<i class="fa fa-arrow-circle-right sidebar-progress-icon active"></i> Entrance Examination
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
						<div class="sidebar-progress">
							<a class="sidebar-header" href="#" data-toggle="collapse" data-target="#collapse-progress-hidden">PROGRESS CHECKLIST <i class="fas fa-caret-down"></i></a>
							<div class="collapse show" id="collapse-progress-hidden">
								<div class="sidebar-item">
									<i class="fas fa-check-circle sidebar-progress-icon done"></i> Application Form (1/2)
								</div>
								<div class="sidebar-item">
									<hr class="default-divider ml-auto" style="margin: 10px;">
									<i class="fas fa-check-circle sidebar-progress-icon done"></i> Application Form (2/2)
								</div>
								<div class="sidebar-item active">
									<hr class="default-divider ml-auto" style="margin: 10px;">
									<i class="fa fa-arrow-circle-right sidebar-progress-icon active"></i> Entrance Examination
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
				<form>
					<div class="student-account-container">
						<p id="datetime" class="default-datetime">0:00</p>
						<div class="student-account-details">
							<p class="student-account-details-item name" id="account-name"><b>Hi, <?php echo $email ?></b></p>
							<a class="student-account-details-item" href="javascript.void(0)" data-toggle="modal" data-target="#logoutModal">Logout</a>
						</div>
					</div>
					<div class="exam-placeholder" id="not-available-placeholder" <?php if($exam_stat == "Deactivated" || $exam_stat == "Expired")
					{echo 'style="display:block"';} else if($exam_stat == "Activated"){echo 'style="display:none"';}?>>
						<div class="row">
							<div class="col-md-5" align="center">
								<img src="../../assets/images/exam_placeholder_not_available.png" class="exam-placeholder-image">
							</div>
							<div class="col-md-7" style="padding: 0px 40px 0px 40px;">
								<p class="exam-placeholder-header">
									<?php
										if($exam_stat == "Deactivated"){
											echo 'The entrance examination module is not yet activated';
										}else if($exam_stat == "Expired"){
											echo 'The entrance examination is already finished!';
										}else if($exam_stat == "Not Set"){
											echo 'The entrance examination is not yet configured';
										}
									?>
								</p>
								<div <?php if($exam_stat == "Deactivated"){echo 'style="display:block"';}
								else if($exam_stat == "Expired" || $exam_stat == "Not Set"){echo 'style="display:none"';} ?>>
									<p class="exam-placeholder-subheader">
										Please come back on:
									</p>
									<p class="exam-placeholder-schedule">
										<?php echo $exam_start->format("F j, Y")?> |
										<?php echo $exam_start->format("g:i A") ?>
									</p>
								</div>
								<div <?php if($exam_stat == "Expired" || $exam_stat == "Not Set"){echo 'style="display:block"';}
								else if($exam_stat == "Deactivated"){echo 'style="display:none"';} ?>>
									<p class="exam-placeholder-schedule">
										Please contact the Admissions Office for assistance.
									</p>
								</div>
							</div>
						</div>
					</div>
					<div class="exam-placeholder" id="available-placeholder" <?php if($exam_stat == "Deactivated" || $exam_stat == "Expired")
					{echo 'style="display:none"';} else if($exam_stat == "Activated"){echo 'style="display:block"';}?>>
						<div class="row">
							<div class="col-md-5" align="center">
								<img src="../../assets/images/exam_placeholder_available.png" class="exam-placeholder-image">
							</div>
							<div class="col-md-7" style="padding: 0px 40px 0px 40px;">
								<p class="exam-placeholder-header">
									Leyte Normal University Entrance Examinations
								</p>
								<p class="exam-placeholder-subheader">
									Before you begin, please take note of the following:
								</p>
								<li class="exam-placeholder-text">A time limit of <?php echo $time_limit ?> minutes is given for the whole coverage of the exam.</li>
								<li class="exam-placeholder-text">Please read and answer each questions carefully.</li>
								<li class="exam-placeholder-text">Cheating is strictly prohibited.</li>
								<div class="page-start-button-container" style="margin-top: 30px;">
									<button class="default-button primary-button" type="button" name="btnBegin" id="btnBegin" data-toggle="modal" data-target="#beginModal">
										Begin Examination
									</button>
								</div>
							</div>
						</div>
					</div>
					<div class="student-page-default" id="exam-container" style="height: 550px; margin-bottom: 20px; display: none;">
						<p class="student-page-default-header">ENTRANCE EXAMINATION</p>
					</div>
					<div class="modal fade" id="submitModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				    	<div class="modal-dialog" role="document">
				      		<div class="modal-content">
				       			<div class="modal-header">
				       			  <p class="modal-header-text">Finished with the examination?</p>
				       			  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
				       			    <span aria-hidden="true">×</span>
				       			  </button>
				       			</div>
				       			<div class="modal-body">
				       				<p style="text-align: justify; font-size: 14px;">By submitting, your scores will be finalized and submitted to the database</p>
				       				<p style="text-align: justify; font-size: 14px;"><b>Please review your answers if there's still an available time.</b></p>
				      			</div>
				      			<div class="modal-footer" style="padding: 10px;">
				       			  <button type="submit" class="default-button" style="padding: 5px 10px 5px 10px; position: relative;">Confirm</button>
				       			</div>
				    		</div>
				  		</div>
	  				</div>
				</form>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="beginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    	<div class="modal-dialog" role="document">
      		<div class="modal-content">
       			<div class="modal-header">
       			  <p class="modal-header-text">Begin Examination?</p>
       			  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
       			    <span aria-hidden="true">×</span>
       			  </button>
       			</div>
       			<div class="modal-body">
       				<p>You will not be able to take again once you begin, confirm?</p>
      			</div>
      			<div class="modal-footer" style="padding: 10px;">
       			  <button class="default-button" type="button" id="btnConfirm" style="padding: 5px 10px 5px 10px; position: relative;">Confirm</button>
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

	<footer class="footer-subfooter">
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

    	$('#btnConfirm').click(function () {

			$('#available-placeholder').css('display', 'none');
			$('#exam-container').css('display', 'block');
			$('#beginModal').modal('toggle');

    	});

    	window.onbeforeunload = function(){

    		return "The examination will immediately end if you proceed, continue?";
    	};


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