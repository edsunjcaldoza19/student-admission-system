<?php

	session_start();

	if(isset($_SESSION['student_token'])){

		echo '
			<script>
				window.location.replace("../../student/admission_procedures/start.php");
			</script>
		';

	}else{

		session_destroy();

	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>LNU SAIS | Applicant Login</title>

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
<body>

	<nav class="navbar navbar-expand-sm student-navbar-main">
		<div class="student-navbar-logo-container">
			<img src="../../assets/images/student_navbar_logo_container.png" class="logo-container">
			<a class="navbar-brand" href="../../index.php">
				<img src="../../assets/images/navbar_logo_main.png" class="logo">
			</a>
		</div>
		<div class="student-navbar-button-container">
			<a class="student-navbar-button-text" href="../../index.php">Home</a>
			<a class="student-navbar-button-text active" href="#">Account</a>
		</div>
	</nav>

	<nav class="navbar navbar-expand-sm student-navbar-secondary">
		<div class="student-navbar-logo-container secondary">
			<a class="navbar-brand" href="../../index.php">
				<img src="../../assets/images/navbar_logo_mobile.png" class="secondary-logo">
			</a>
		</div>
	</nav>
	<div class="student-navbar-button-container secondary">
		<a class="student-navbar-button-text" href="../../index.php">Home</a>
		<hr class="default-divider my-0 ml-auto">
		<a class="student-navbar-button-text active" href="#">Account</a>
	</div>

	<div class="container-fluid login">
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4 login">
				<div class="login-form-container">
					<form method="POST" action="../../backend/auth/student_login.php">
						<div class="login-form-header">
							<p class="login-form-header-text">Applicant Login</p>
							<p class="login-form-header-subtext">Please login using a valid account</p>
						</div>
						<div class="login-form-body">
		                    <div class="form-group form-float">
		                       	<div class="form-line">
		                            <input type="email" name="tbEmail" id="tbEmail" class="form-control" autocomplete="off" required/>
		                            <label class="form-label">Email Address</label>
		                        </div>
		                    </div>
		                    <div class="form-group form-float">
		                        <div class="form-line">
		                            <input type="password" name="tbPassword" id="tbPassword" class="form-control" autocomplete="off" required/>
		                            <label class="form-label">Password</label>
		                            <span toggle="#tbPassword" class="fa fa-eye form-toggle-password"></span>
		                        </div>
		                    </div>
						</div>
						<div class="login-form-buttons" align="center">
							<button class="default-button disabled-button" id="btnLogin" name="btnLogin" type="submit" disabled>Login</button>
							<a class="default-button alt-button" href="registration.php">Register Account</a>
							<hr class="default-divider ml-auto">
							<i class="fa fa-question-circle" style="color: #4285F4; font-size: 15px;"></i> <a class="default-form-link-text" href="password_recovery.php">Forgot Password?</a>
						</div>
					</form>
				</div>
			</div>
			<div class="col-md-4"></div>
		</div>
	</div>

	<div class="footer-container-main">
		<div class="student-footer-first"></div>
		<div class="student-footer-second"></div>
		<div class="student-footer-main">
			<div class="row">
				<div class="col-md-9">
					<div class="footer-logo-container">
						<img src="../../assets/images/footer_logo.png" class="footer-logo">
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

	<script src="../../assets/libs/jquery/jquery.min.js"></script>
	<script src="../../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/libs/bootstrap-select/js/bootstrap-select.js"></script>
    <script src="../../assets/libs/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../../assets/libs/node-waves/waves.js"></script>

    <!-- Custom Js -->
    <script src="../../assets/js/template/admin.js"></script>

    <!-- Demo Js -->
    <script src="../../assets/js/template/demo.js"></script>

	<!-- Additional JS codes -->

	<script>

		document.getElementById("tbPassword").addEventListener("keyup", validateFields);

		function validateFields(){

			var email = $('#tbEmail').val();
			var password = $('#tbPassword').val();

			if(email.length > 1 && password.length > 1){

				$('#btnLogin').addClass("primary-button");
				$('#btnLogin').removeClass("disabled-button");
				$('#btnLogin').attr("disabled", false);

			}else{

				$('#btnLogin').addClass("disabled-button");
				$('#btnLogin').removeClass("primary-button");
				$('#btnLogin').attr("disabled", true);

			}

		}

		//toggles show/hide password

		$('.form-toggle-password').click(function(){

			$(this).toggleClass("fa-eye fa-eye-slash");
			var input = $($(this).attr("toggle"));

			if(input.attr("type") == "password"){
				input.attr("type", "text");
			}else{
				input.attr("type", "password");
			}

		})



	</script>

</body>
</html>