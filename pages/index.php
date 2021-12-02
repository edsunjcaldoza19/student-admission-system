<?php
	require 'backend/config/db_pdo.php';
	require 'backend/config/db_mysqli.php';

	$sqlSchoolYear = $conn->prepare("SELECT * FROM tbl_academic_year WHERE `ay_status` = 1");
    $sqlSchoolYear->execute();
    $fetchSchoolYear = $sqlSchoolYear->fetch()
?>

<!DOCTYPE html>
<html>
<head>
	<title>LNU SAIS | Welcome</title>

		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- Imports third-party CSS libraries -->

		<link rel="stylesheet" type="text/css" href="assets/libs/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="assets/libs/font-awesome/css/all.css">

		<!-- Imports default styling -->

		<link rel="stylesheet" type="text/css" href="assets/css/style.css">

		<link rel="shortcut-icon" href="assets/images/lnu.ico" type="image/x-icon"/>
  		<link rel="icon" href="assets/images/lnu.ico" type="image/x-icon"/>

</head>
<body>

	<nav class="navbar navbar-expand-sm student-navbar-main">
		<div class="student-navbar-logo-container">
			<img src="assets/images/student_navbar_logo_container.png" class="logo-container">
			<a class="navbar-brand" href="#">
				<img src="assets/images/navbar_logo_main.png" class="logo">
			</a>
		</div>
		<div class="student-navbar-button-container">
			<a class="student-navbar-button-text active" href="#">Home</a>
			<a class="student-navbar-button-text" href="accounts/student/login.php">Account</a>
		</div>
	</nav>

	<nav class="navbar navbar-expand-sm student-navbar-secondary">
		<div class="student-navbar-logo-container secondary">
			<a class="navbar-brand" href="#">
				<img src="assets/images/navbar_logo_mobile.png" class="secondary-logo">
			</a>
		</div>
	</nav>
	<div class="student-navbar-button-container secondary">
		<a class="student-navbar-button-text active" href="#">Home</a>
		<hr class="default-divider my-0 ml-auto">
		<a class="student-navbar-button-text" href="accounts/student/login.php">Account</a>
	</div>

	<div class="container-fluid">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8 home" style="margin-bottom: 20px;">
				<div class="row">
					<div class="page-navigation">
						<ol class="breadcrumb">
	          				<li class="breadcrumb-item active">Home /</li>
	          				<!-- <li class="breadcrumb-item active">Overview</li> -->
	        			</ol>
					</div>
				</div>

				<div class="row">
					<div class="home-container">
						<div class="alert alert-success" role="alert" style="padding: 5px 5px 5px 10px; <?php if($fetchSchoolYear['result_available'] == 0){echo 'display: none';}else{echo 'display: block';}?>"><i class="far fa-check-circle"></i> Admission Results for A.Y. <?php echo $fetchSchoolYear['ay_year']?> is now available! <a href="admission_results.php" class="alert-success" style="font-weight: 600;">View Results</a></div>
						<div class="home-image-container">
							<img src="assets/images/home_page_image.jpg" class="home-image">
						</div>
						<div class="register-button-container">
							<div class="row">
								<div class="col-md-9">
									<p class="register-text">Be a true Blue and Gold #Normalista. Your journey starts here.</p>
									<p class="register-subtext">Take part in Leyte Normal University's Online Admission for the

										<strong>S.Y <?php echo $fetchSchoolYear['ay_year']?></strong>.
									</p>
								</div>
								<div class="col-md-3" align="center">
									<a class="default-button primary-button" href="accounts/student/registration.php">Register Now</a>
								</div>
							</div>
						</div>
						<div class="default-home-container procedures-container">
							<div class="default-home-container-header">Online Admission Procedure</div>
							<div class="row default-home-container-body" style="margin: 0px 0px 15px 0px;">
								<?php
									$queryProcedures = "SELECT * from tbl_department";
									$fetchProcedures = mysqli_query($connection, $queryProcedures);

									if($fetchProcedures){
										$numProcedures = mysqli_num_rows($fetchProcedures);
									}

									if($numProcedures > 0){
										$sqlProc = $conn->prepare("SELECT * FROM tbl_procedures");
                                        $sqlProc->execute();
										while($fetchProc = $sqlProc->fetch()){
									?>
										<div class="col-xl-4 col-md-6 col-sm-12">
											<div class="procedure-header">
												Step <?php echo $fetchProc['procedure_step_num'] ?>
											</div>
											<div class="procedure-body" style="margin-bottom: 15px;">
												<?php echo $fetchProc['procedure_desc'] ?>
											</div>
										</div>
									<?php
										}
									}else{
										echo "<p style='text-align: center'><i>Admission procedures are not yet set, please contact the Admissions Office!</i></p>";
									}
								?>
							</div>
						</div>
						<div class="default-home-container procedures-container">
							<div class="default-home-container-header">Programs Offered</div>
							<div class="default-home-container-body">
								<?php
									$queryDepartments = "SELECT * from tbl_department";
									$queryCourses = "SELECT * from tbl_department";
									$fetchDepartments = mysqli_query($connection, $queryDepartments);
									$fetchCourses = mysqli_query($connection, $queryCourses);

									if($fetchDepartments && $fetchCourses){
										$numDepartments = mysqli_num_rows($fetchDepartments);
										$numCourses = mysqli_num_rows($fetchCourses);
									}

									if($numDepartments > 0 && $numCourses > 0){
										$sqlDept = $conn->prepare("SELECT * FROM tbl_department");
                                        $sqlDept->execute();
										while($fetchDept = $sqlDept->fetch()){
										$dept_id = $fetchDept['id'];
									?>
										<div class="row">
											<div class="col-md-12">
												<div class="course-container">
													<p class="course-header"><?php echo $fetchDept['dept_name']?></p>
													<hr class="default-divider ml-0" style="margin: 5px;">
													<?php
														$sqlCourse = $conn->prepare("SELECT *, tbl_course.course_id FROM tbl_course
														LEFT JOIN tbl_unit ON tbl_unit.id=tbl_course.unit_id WHERE `unit_dept_id` = $dept_id");
														$sqlCourse->execute();
														while($fetchCourse = $sqlCourse->fetch()){
													?>
														<p class="course-text"><?php echo $fetchCourse['course_name']?> (<?php echo $fetchCourse['course_acronym']?>)</p>
													<?php
														}
													?>
												</div>
											</div>
										</div>
									<?php
										}
									}else{
										echo "<p style='text-align: center'><i>Degree programs list is not currently set, please contact the administrator!</i></p>";
									}
								?>
								<hr class="default-divider ml-0">
							</div>
						</div>
						<div class="default-home-container documents-container">
							<div class="default-home-container-header">Documents to Prepare</div>
							<div class="default-home-container-body">
							<p class="course-text"><b>Please prepare the following documents before proceeding with the admission procedures:</b></p>
								<?php
									$queryRequirements = "SELECT * from tbl_requirements";
									$fetchRequirements = mysqli_query($connection, $queryRequirements);

									if($fetchRequirements){
										$numRequirements = mysqli_num_rows($fetchRequirements);
									}

									if($numRequirements > 0){
										$sqlReq = $conn->prepare("SELECT * FROM tbl_requirements");
                                        $sqlReq->execute();
										while($fetchReq = $sqlReq->fetch()){
								?>
									<p class="course-text"><?php echo $fetchReq['requirements_num']?>. ) <?php echo $fetchReq['requirements_desc']?></p>
									<hr class="default-divider ml-0" style="margin: 5px;">
								<?php
									}
								}else{
									echo "<p><i>Admission requirements are not yet set, please contact the Admissions Office!</i></p>";
								}
								?>

							</div>
						</div>
						<div class="default-home-container">
							<div class="default-home-container-header">Important Dates to Remember</div>
							<div class="default-home-container-body">
								<p class="course-text"><b>Please take note of the following dates and schedule:</b></p>
								<div class="row" style="margin: 0px">
									<?php
										$querySchedules = "SELECT * from tbl_schedules";
										$fetchSchedules = mysqli_query($connection, $querySchedules);

										if($fetchSchedules){
											$numSchedules = mysqli_num_rows($fetchSchedules);
										}

										if($numSchedules > 0){
											$sqlSched = $conn->prepare("SELECT * FROM tbl_schedules");
                                        	$sqlSched->execute();
											while($fetchSched = $sqlSched->fetch()){
										?>
											<div class="col-md-6">
												<p class="course-text"><?php echo $fetchSched['schedule_date']?></p>
											</div>
											<div class="col-md-6">
												<p class="course-text"><?php echo $fetchSched['schedule_desc']?></p>
											</div>
											<hr class="default-divider ml-0" style="margin: 5px;">
										<?php
											}
										}else{
											echo "<p style='text-align: center'><i>Schedules are not yet set, please contact the Admissions Office!</i></p>";
										}
									?>
								</div>
							</div>
						</div>
						<div class="default-home-container">
							<div class="default-home-container-header">Frequently Asked Questions (FAQs)</div>
							<div class="default-home-container-body">
								<div class="row">
									<div class="col-md-9">
										<p class="course-text"><b>To see the frequently asked questions (FAQs) and their answers, please click the button:</b></p>
									</div>
									<div class="col-md-3">
										<a class="default-button secondary-button" href="faqs.php">FAQs Page</a>
									</div>
								</div>
							</div>
						</div>
						<div class="default-home-container">
							<div class="default-home-container-header">Admission Results</div>
							<div class="default-home-container-body">
								<div class="row">
									<div class="col-md-9">
										<p class="course-text"><b>To download the admissions results for this school year, please click the button:</b></p>
									</div>
									<div class="col-md-3">
										<a class="default-button secondary-button" href="admission_results.php">See Results</a>
									</div>
								</div>
							</div>
						</div>


					</div>
				</div>

			</div>
			<div class="col-md-2"></div>
		</div>
	</div>

	<div class="footer-container-main">
		<div class="student-footer-first"></div>
		<div class="student-footer-second"></div>
		<div class="student-footer-main">
			<div class="row">
				<div class="col-md-9">
					<div class="footer-logo-container">
						<img src="assets/images/footer_logo.png" class="footer-logo">
					</div>
				</div>
				<div class="col-md-3">
					<div class="footer-contact-container">
						<p class="footer-contact-header">CONTACT US</p>
						<p class="footer-contact-subheader">EMAIL</p>
						<p class="footer-contact-text">lnu.admissionsoffice@lnu.edu.ph</p>
						<hr class="footer-divider">
						<p class="footer-contact-subheader">CONTACT NUMBER</p>
						<p class="footer-contact-text">09501234567 | 123-4567</p>
					</div>
				</div>
			</div>
		</div>
		<div class="footer-subfooter">
			<p class="subfooter-text">ALL RIGHTS RESERVED | LEYTE NORMAL UNIVERSITY</p>
		</div>
	</div>
	<div class="footer-container-secondary">
		<div class="student-footer-first"></div>
		<div class="student-footer-second"></div>
		<div class="student-footer-main">
			<div class="footer-contact-container">
				<p class="footer-contact-header">CONTACT US</p>
				<p class="footer-contact-subheader">EMAIL</p>
				<p class="footer-contact-text">lnu.admissionsoffice@lnu.edu.ph</p>
				<hr class="footer-divider">
				<p class="footer-contact-subheader">CONTACT NUMBER</p>
				<p class="footer-contact-text">09501234567 | 123-4567</p>
			</div>
		</div>
		<div class="footer-subfooter">
			<p class="subfooter-text">ALL RIGHTS RESERVED | LEYTE NORMAL UNIVERSITY</p>
		</div>
	</div>

	<script src="assets/libs/jquery/jquery.min.js"></script>
	<script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>

	<!-- Additional JS codes -->

</body>
</html>