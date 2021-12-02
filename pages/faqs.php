<?php
	require 'backend/config/db_pdo.php';
	require 'backend/config/db_mysqli.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>LNU SAIS | FAQs</title>

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
			<a class="navbar-brand" href="index.php">
				<img src="assets/images/navbar_logo_main.png" class="logo">
			</a>
		</div>
	</nav>

	<nav class="navbar navbar-expand-sm student-navbar-secondary">
		<div class="student-navbar-logo-container secondary">
			<a class="navbar-brand" href="index.php">
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
	          				<li class="breadcrumb-item active">FAQs Page</li>
	        			</ol>
					</div>
				</div>
				<div class="row">
					<div class="home-container">
						<div class="faq-header" align="center">
							<h4 style="color: #262626;">Frequently Asked Questions (FAQs)</h4>
							<hr class="default-divider ml-auto">
						</div>

						<?php
							$queryFAQs = "SELECT * from tbl_faqs";
							$fetchFAQs = mysqli_query($connection, $queryFAQs);

							if($fetchFAQs){
								$numFAQs = mysqli_num_rows($fetchFAQs);
							}
							if($numFAQs > 0){
								$sqlFaq = $conn->prepare("SELECT * FROM tbl_faqs");
								$sqlFaq->execute();
								while($fetchFaq = $sqlFaq->fetch()){
							?>
								<div class="faq-card">
									<div class="faq-card-question">
										<div class="row">
											<div class="col-md-1 faq-card-question-header">
												<h2>Q.</h2>
											</div>
											<div class="col-md-11 faq-card-content">
												<p style="white-space: normal; word-break: break-all; margin: 10px 20px 10px 10px; font-size: 13px;"><?php echo $fetchFaq['question']?></p>
											</div>
										</div>
									</div>
									<div class="faq-card-answer">
										<div class="row">
											<div class="col-md-1 faq-card-answer-header">
												<h2>A.</h2>
											</div>
											<div class="col-md-11 faq-card-content">
												<p style="white-space: normal; word-break: break-all; margin: 10px 20px 10px 10px; font-size: 13px;"><?php echo $fetchFaq['answer']?></p>
											</div>
										</div>
									</div>
								</div>
							<?php
								}
							}else{
								echo "<p style='text-align: center'><i>FAQs not yet set, please contact the Admissions Office!</i></p>";
							}
						?>

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