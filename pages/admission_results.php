<?php
	require 'backend/config/db_pdo.php';
	require 'backend/config/db_mysqli.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>LNU SAIS | Admission Results</title>

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
			<a class="navbar-brand" href="home.php">
				<img src="assets/images/navbar_logo_main.png" class="logo">
			</a>
		</div>
	</nav>

	<nav class="navbar navbar-expand-sm student-navbar-secondary">
		<div class="student-navbar-logo-container secondary">
			<a class="navbar-brand" href="home.php">
				<img src="assets/images/navbar_logo_mobile.png" class="secondary-logo">
			</a>
		</div>
	</nav>

	<div class="container-fluid" style="height: 100%;">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8 home" style="margin-bottom: 20px;">
				<div class="row">
					<div class="page-navigation">
						<ol class="breadcrumb">
	          				<li class="breadcrumb-item"><a href="index.php">Home</a></li>
	          				<li class="breadcrumb-item active">Admission Results</li>
	        			</ol>
					</div>
				</div>
				<div class="row">
					<div class="home-container">
						<div class="results-header" align="center">
							<h4 style="color: #262626;">Admission Results</h4>
							<p>For
								<?php
									$sqlSchoolYear = $conn->prepare("SELECT * FROM tbl_academic_year WHERE `ay_status` = 1");
                                    $sqlSchoolYear->execute();
                                    $fetchSchoolYear = $sqlSchoolYear->fetch()
								?>
								<strong>A.Y <?php echo $fetchSchoolYear['ay_year']?></strong>.
							</p>
							<hr class="default-divider ml-auto">
						</div>
						<div class="results-placeholder" align="center" style="<?php if($fetchSchoolYear['result_available'] == 0){echo 'display: block';}else{echo 'display: none';}?>">
							<div class="results-placeholder-holder-image">
								<img src="assets/images/results_placeholder_unavailable1.png" class="placeholder-image">
							</div>
							<div class="results-placeholder-text">
								<div class="row">
									<div class="col-md-2"></div>
									<div class="col-md-8">
										<p>The results are still being processed... please come back again later!</p>
									</div>
									<div class="col-md-2"></div>
								</div>
							</div>
						</div>
						<div class="results-placeholder" align="center" style="<?php if($fetchSchoolYear['result_available'] == 0){echo 'display: none';}else{echo 'display: block';}?>">
							<div class="results-placeholder-holder-image">
								<img src="assets/images/results_placeholder_available.png" class="placeholder-image">
							</div>
							<div class="results-placeholder-text">
								<div class="row">
									<div class="col-md-2"></div>
									<div class="col-md-8">
										<p>Results are already available! Click the button below to view results</p>
									</div>
									<div class="col-md-2"></div>
								</div>
							</div>
						</div>
						<hr class="default-divider ml-auto" style="margin-bottom: 5px;">
						<div class="results-download">
							<div class="row">
								<div class="col-md-4"></div>
								<div class="col-md-4">
									<a class="default-button <?php if($fetchSchoolYear['result_available'] == 0){echo 'disabled-button';}else{echo 'primary-button';} ?>" href="backend/admission/admission_qualifiers.php?sy_id=<?php echo $fetchSchoolYear['id']; ?>" align="center">Download Results</a>
								</div>
								<div class="col-md-4"></div>
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