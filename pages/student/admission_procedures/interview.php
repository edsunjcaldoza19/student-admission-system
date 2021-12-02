<?php

	$email = '';
	require '../../backend/auth/check_token.php';

	if(isset($_SESSION['student_token'])){

		$sql = $conn->prepare("SELECT *, tbl_applicant_account.id FROM tbl_applicant_account
        LEFT JOIN tbl_applicant ON tbl_applicant_account.id = tbl_applicant.applicant_account_id
        LEFT JOIN tbl_interview ON tbl_interview.interview_applicant_id = tbl_applicant.applicant_account_id
        WHERE `session_token` = '$token'");
		$sql->execute();

		$sql1 = $conn->prepare("SELECT * from `tbl_academic_year` WHERE `ay_status` = 1");
		$sql1->execute();

		if($fetch = $sql->fetch()){

			$form1_status = $fetch['form1_progress'];
			$form2_status = $fetch['form2_progress'];
			$exam_status = $fetch['examination_progress'];
			$interview_status = $fetch['interview_progress'];

			//Determine if re-admission
			$entry_type = $fetch['entry'];

			if($fetch1 = $sql1->fetch()){

				$exam_enabled = $fetch1['enable_exam'];

				if($exam_enabled == 1){

					if($interview_status == 'Done'){

						echo '

						<script>

							window.location.replace("done.php");

						</script>

						';

					}else if($exam_status == 'Not Started' && $entry_type !== 'Re-admission'){

						echo '

						<script>

							alert("[MESSAGE]: Finish the previous step first!");
							window.location.replace("entrance_exam.php");

						</script>

						';

					}

				}else if($exam_enabled == 0){

					if($interview_status == 'Done'){

						echo '

						<script>

							window.location.replace("done.php");

						</script>

						';

					}else if($form2_status == 'Not Started'){

						echo '

						<script>

							alert("[MESSAGE]: Finish the previous step first!");
							window.location.replace("application_form2.php");

						</script>

						';

					}

				}

			}

		}


		$staff_id_1 = $fetch['interview_staff_id_1'];
		$staff_id_2 = $fetch['interview_staff_id_2'];

		$sql2 = $conn->prepare("SELECT * from `tbl_account_staff` WHERE `id` = $staff_id_1");
		$sql2->execute();
		$fetchStaff1 = $sql2->fetch();

		$sql3 = $conn->prepare("SELECT * from `tbl_account_staff` WHERE `id` = $staff_id_2");
		$sql3->execute();
		$fetchStaff2 = $sql3->fetch();

		if($fetch['interview_staff_id_1'] == 0){
			$interviewerName1 = 'TBA';
		}else{
			$interviewerName1 = 'Interviewer 1';
		}

		if($fetch['interview_staff_id_2'] == 0){
			$interviewerName2 = 'TBA';
		}else{
			$interviewerName2 = 'Interviewer 2';
		}

	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>LNU SAIS | Interview</title>

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
								<div class="sidebar-item" <?php if($fetch1['enable_exam'] == 1 && $entry_type !== 'Re-admission'){echo 'style="display:block"';}else{echo 'style="display:none"';}?>>
									<hr class="default-divider ml-auto" style="margin: 10px;">
									<i class="fas fa-check-circle sidebar-progress-icon done"></i> Entrance Examination
								</div>
								<div class="sidebar-item active">
									<hr class="default-divider ml-auto" style="margin: 10px;">
									<i class="fa fa-arrow-circle-right sidebar-progress-icon active"></i> Interview/Evaluation
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
								<div class="sidebar-item" <?php if($fetch1['enable_exam'] == 1 || $entry_type !== 'Re-admission'){echo 'style="display:block"';}else{echo 'style="display:none"';}?>>
									<hr class="default-divider ml-auto" style="margin: 10px;">
									<i class="fas fa-check-circle sidebar-progress-icon done"></i> Entrance Examination
								</div>
								<div class="sidebar-item active">
									<hr class="default-divider ml-auto" style="margin: 10px;">
									<i class="fa fa-arrow-circle-right sidebar-progress-icon active"></i> Interview/Evaluation
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
							<p class="student-account-details-item name"><b>Hi, <?php echo $email ?></b></p>
							<a class="student-account-details-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
						</div>
					</div>
					<div class="student-page-default" style="height: 550px; margin-bottom: 20px; overflow-x: hidden;">
						<p class="student-page-default-header">INTERVIEW/EVALUATION</p>
						<div class="row">
							<div class="col-md-6">
								<img src="../../assets/images/interview-image.png" class="interview-placeholder-image" style="width: 500px;">
							</div>
							<div class="col-md-6" style="padding: 0px 30px 0px 30px;">
								<p class="exam-placeholder-header" style="font-size: 30px; margin-top: 10px;">
									Interview Details
								</p>
								<p class="exam-placeholder-subheader" style="font-size: 15px; margin-top: 5px;">
									Please take note of the following details for the conduct of your interview.
								</p>
								<div class="form-group form-float">
									<div class="form-line">
								        <select class="form-control" name="cbToggleSchedule" id="cbToggleSchedule" required>
			                                <option value="" disabled selected>Toggle Schedules</option>
			                                <option value="First Choice">First Choice Schedule</option>
			                                <option value="Second Choice">Second Choice Schedule</option>
			                            </select>
		                            </div>
				                </div>
								<div id="firstChoiceSchedule" style="display: none;">
									<?php
										if($fetch['interview_staff_id_1'] == '0'){
											echo '<small><i>*TBA - To be announced (kindly check this page from time-to-time for updates)</i></small>';
										}
									?>
									<p class="exam-placeholder-subheader" style="font-size: 15px; margin: 5px 0px 5px 0px; color: #0A079D;">
										Interviewer:
									</p>
									<p class="exam-placeholder-text" style="font-size: 15px; margin: 5px 0px 5px 0px;">
										<?php echo $interviewerName1; ?>
									</p>
									<hr class="default-divider ml-auto" style="margin: 5px;">
									<p class="exam-placeholder-subheader" style="font-size: 15px; margin: 5px 0px 5px 0px; color: #0A079D;">
										Interview Schedule:
									</p>
									<p class="exam-placeholder-text" style="font-size: 15px; margin: 5px 0px 5px 0px;">
										<?php echo $fetch['interview_date_1']; ?> - <?php echo $fetch['interview_time_1']; ?>
									</p>
									<hr class="default-divider ml-auto" style="margin: 5px;">
									<p class="exam-placeholder-subheader" style="font-size: 15px; margin: 5px 0px 5px 0px; color: #0A079D;">
										Method:
									</p>
									<p class="exam-placeholder-text" style="font-size: 15px; margin: 5px 0px 5px 0px;">
										<?php echo $fetch['interview_method_1']; ?>
									</p>
									<hr class="default-divider ml-auto" style="margin: 5px;">
									<p class="exam-placeholder-subheader" style="font-size: 15px; margin: 5px 0px 5px 0px; color: #0A079D;">
										<?php
											$method = $fetch['interview_method_1'];
											if($method == 'Face-to-Face'){
												echo 'Interview Venue:';
											}else{
												echo 'Video Call Link:';
											}
										?>
									</p>
									<p class="exam-placeholder-text" href="#" style="font-size: 15px; margin: 5px 0px 5px 0px;">
										<?php
											$link = $fetch['interview_venue_or_link_1'];
											if($link == 'TBA'){
												echo 'TBA';
											}else{
												echo '<a href="'.$link.'">'.$link.'</a>';
											}
										?>
									</p>
								</div>
								<div id="secondChoiceSchedule" style="display: none;">
									<?php
										if($fetch['interview_staff_id_2'] == '0'){
											echo '<small><i>*TBA - To be announced (kindly check this page from time-to-time for updates)</i></small>';
										}
									?>
									<p class="exam-placeholder-subheader" style="font-size: 15px; margin: 5px 0px 5px 0px; color: #0A079D;">
										Interviewer:
									</p>
									<p class="exam-placeholder-text" style="font-size: 15px; margin: 5px 0px 5px 0px;">
										<?php echo $interviewerName2; ?>
									</p>
									<hr class="default-divider ml-auto" style="margin: 5px;">
									<p class="exam-placeholder-subheader" style="font-size: 15px; margin: 5px 0px 5px 0px; color: #0A079D;">
										Interview Schedule:
									</p>
									<p class="exam-placeholder-text" style="font-size: 15px; margin: 5px 0px 5px 0px;">
										<?php echo $fetch['interview_date_2']; ?> - <?php echo $fetch['interview_time_2']; ?>
									</p>
									<hr class="default-divider ml-auto" style="margin: 5px;">
									<p class="exam-placeholder-subheader" style="font-size: 15px; margin: 5px 0px 5px 0px; color: #0A079D;">
										Method:
									</p>
									<p class="exam-placeholder-text" style="font-size: 15px; margin: 5px 0px 5px 0px;">
										<?php echo $fetch['interview_method_2']; ?>
									</p>
									<hr class="default-divider ml-auto" style="margin: 5px;">
									<p class="exam-placeholder-subheader" style="font-size: 15px; margin: 5px 0px 5px 0px; color: #0A079D;">
										<?php
											$method = $fetch['interview_method_2'];
											if($method == 'Face-to-Face'){
												echo 'Interview Venue:';
											}else{
												echo 'Video Call Link:';
											}
										?>
									</p>
									<p class="exam-placeholder-text" href="#" style="font-size: 15px; margin: 5px 0px 5px 0px;">
										<?php
											$link = $fetch['interview_venue_or_link_2'];
											if($link == 'TBA'){
												echo 'TBA';
											}else{
												echo '<a href="'.$link.'">'.$link.'</a>';
											}
										?>
									</p>
								</div>
							</div>

						</div>
					</div>
				</form>
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
    <script src="../../assets/libs/node-waves/waves.js"></script>
    <script src="../../assets/js/template/admin.js"></script>
    <script src="../../assets/js/template/demo.js"></script>

	<!-- Additional JS codes -->

	<script>

		var toggleClicks = 0;

		$(document).ready(function () {
        	showDateTime();
        	toggleSchedule();

    	});

		$('#sidebar-toggle').click(function () {

			toggleClicks++;

			if(toggleClicks %2 == 0){
				closeSidebar();
			}else{
				openSidebar();
			}

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

  		function toggleSchedule(){

  			$('#cbToggleSchedule').on('change', function(){
		        var value = $(this).val();
		        if(value == 'First Choice'){
		            $('#firstChoiceSchedule').show();
		            $('#secondChoiceSchedule').hide();
		        }else{
		            $('#firstChoiceSchedule').hide();
		            $('#secondChoiceSchedule').show();
		        }
    		});

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