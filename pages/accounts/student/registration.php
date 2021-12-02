<!DOCTYPE html>
<html>
<head>
	<title>LNU SAIS | Applicant Registration</title>

		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- Imports third-party CSS libraries -->

		<link rel="stylesheet" type="text/css" href="../../assets/libs/bootstrap/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../../assets/libs/bootstrap-select/dist/css/bootstrap-select.css"
		/>
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
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<div class="registration-form-container">
					<form method="POST" action="../../backend/register/student_account.php">
						<div class="login-form-header">
							<p class="login-form-header-text">Register Account</p>
						</div>
						<hr class="default-divider ml-auto" style="margin: 10px;">
						<div class="login-form-body">
							<div id="accountInfo" style="height: auto; padding: 2px;">
								<p style="font-size: 18px; margin-bottom: 0px;">Account Details</p>
								<p class="login-form-header-subtext" style="margin-bottom: 15px;">Please enter your basic account details.</p>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group form-float" style="margin-bottom: 15px;">
				                        	<div class="form-line">
				                            	<input type="text" name="tbFirstName" id="tbFirstName" class="form-control" required/>
				                            	<label class="form-label">First Name *</label>
				                       		</div>
			                    		</div>
			                    		<div class="form-group form-float" style="margin-bottom: 15px;">
				                        	<div class="form-line">
				                            	<input type="text" name="tbMiddleName" id="tbMiddleName" class="form-control"/>
				                            	<label class="form-label">Middle Name </label>
				                       		</div>
			                    		</div>
			                    		<div class="form-group form-float" style="margin-bottom: 15px;">
				                        	<div class="form-line">
				                            	<input type="text" name="tbFamilyName" id="tbFamilyName" class="form-control" required/>
				                            	<label class="form-label">Last Name *</label>
				                       		</div>
		                    			</div>
		                    			<p class="student-page-label">Birthday *</p>
		                    			<div class="form-group form-float">
                                    		<div class="form-line">
                                       			<input type="date" name="dpBirthday" id="dpBirthday" class="form-control" required/>
                                    		</div>
                               	 		</div>
									</div>
									<div class="col-md-6">
										<div class="form-group form-float">
	                                    	<div class="form-line">
	                                        	<input type="number" name="tbAge" id="tbAge" class="form-control" required/>
	                                        	<label class="form-label">Enter Age *</label>
	                                    	</div>
	                                	</div>
									
	                                	<div class="form-group form-float">
					                        <select class="form-control show-tick" name="cbGender" id="cbGender" required>
                                        		<option value="" disabled selected>Select Gender *</option>
                                        		<option value="Male">Male</option>
                                        		<option value="Female">Female</option>
                                    		</select>
		                    			</div>
		                    			<div class="form-group form-float">
					                        <select class="form-control show-tick" name="cbEntryStatus" id="cbEntryStatus" required>
                                        		<option value="" disabled selected>Select Entry Status *</option>
                                        		<option value="Freshmen">Freshmen</option>
                                        		<option value="Transferee">Transferee</option>
                                        		<option value="Re-admission">Re-admission</option>
                                    		</select>
		                    			</div>
									</div>
								</div>
								<p style="font-size: 18px; margin-bottom: 0px;">Account Credentials</p>
								<p class="login-form-header-subtext" style="margin-bottom: 15px;">You'll use these details to login.</p>
								<div class="row">
									<div class="col-md-12">		
				                    	<div class="alert alert-danger" id="alertMessage" name="alertMessage" style="padding: 10px; display: none;">
											<i class="fa fa-times-circle"></i><p class="" style="display: inline-block; margin-left: 10px;">An account with a similar email already exists.</p>
										</div>
										<div class="form-group form-float">
			                       			<div class="form-line" id="emailLine">
			                        		    <input type="email" name="tbEmail" id="tbEmail" class="form-control" autocomplete="off" required/>
			                        		    <label class="form-label" id="emailLabel">Email Address *</label>
			                        		</div>
			                        		<p class="form-error" id="emailError"><i class="fa fa-exclamation-circle"></i> What's your email?</p>
		                   		 		</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
		                    		<div class="form-group form-float">
		                        		<div class="form-line" id="passwordLine">
		                            		<input type="password" name="tbPassword" id="tbPassword" class="form-control" required/>
		                            		<label class="form-label" id="passwordLabel">Password *</label>
		                            		<span toggle="#tbPassword" class="fa fa-eye form-toggle-password"></span>
		                       			</div>
		                       			<p class="form-error" id="passwordError1"><i class="fa fa-exclamation-circle"></i> What's your password?</p>
		                       			<p class="form-error" id="passwordError2"><i class="fa fa-exclamation-circle"></i> Minimum password length is 8</p>
		                       			<p class="form-error" id="passwordError3"><i class="fa fa-exclamation-circle"></i> Maximum password length is 16</p>
		                    		</div>
		                    	</div>
		                    	<div class="col-md-6">
		                    		<div class="form-group form-float">
		                        		<div class="form-line" id="confirmPasswordLine">
		                            		<input type="password" name="tbConfirmPassword" id="tbConfirmPassword" class="form-control" required/>
		                            		<label class="form-label" id="confirmPasswordLabel">Confirm Password *</label>
		                            		<span toggle="#tbConfirmPassword" class="fa fa-eye form-toggle-password"></span>
		                       			</div>
		                       			<p class="form-error" id="confirmPasswordError"><i class="fa fa-exclamation-circle"></i> Passwords does not match</p>
		                    		</div>
		                    	</div>
								</div>
		                    </div>
		                    <div id="passwordRecovery" style="display: none;">
			                   	<div class="row" style="margin-bottom: 20px; margin-top: 10px;" style="display: none;">
			                    	<div class="col-md-12">
			                    		<p style="font-size: 18px; margin-bottom: 0px;">Password Recovery</p>
										<p class="login-form-header-subtext" style="text-align: justify;">Please pick and answer one of the security questions below to recover your account incase you forgot your password.</p>
			                    		<div class="form-line">
			                    			<select class="form-control show-tick" name="cbQuestion" id="cbQuestion" style="max-width: 100%;" required>
	                                        	<option value="" disabled selected>-- Pick a security question --</option>
	                                        	<option value="What was the house number and street name you lived in as a child?">When was your parents married?</option>
	                                        	<option value="What is your grandmother's (on your mother side) maiden name?">What is your grandmother's (on your mother side) 
	                                        	maiden name?</option>
	                                        	<option value="What time of the day were you born?">What time of the day were you born?</option>
	                                        	<option value="What was your childhood nickname?">What was your childhood nickname?</option>
	                                        	<option value="What was the last name of your third grade teacher?">What was the last name of your third grade teacher?</option>
	                                        	<option value="What was the favorite place you visited as a child?">What was the favorite place you visited as a child?</option>
	                                        	<option value="How old is your oldest sibling?">How old is your oldest sibling?</option>
	                                    	</select>
			                    		</div>
			                    	</div>
			                    </div>
			                    <div class="row">
			                    	<div class="col-md-6">
			                    		<div class="form-group form-float">
			                        		<div class="form-line" id="answerLine">
			                            		<input type="password" name="tbAnswer" id="tbAnswer" class="form-control" required/>
			                            		<label class="form-label" id="answerLabel">Answer *</label>
			                            		<span toggle="#tbAnswer" class="fa fa-eye form-toggle-password"></span>
			                       			</div>
			                       			<p class="form-error" id="answerError"><i class="fa fa-exclamation-circle"></i> What is your answer?</p>
			                    		</div>
			                    	</div>
			                    	<div class="col-md-6">
			                    		<div class="form-group form-float">
			                        		<div class="form-line" id="confirmAnswerLine">
			                            		<input type="password" name="tbConfirmAnswer" id="tbConfirmAnswer" class="form-control" required/>
			                            		<label class="form-label" id="confirmAnswerLine">Confirm Answer *</label>
			                            		<span toggle="#tbConfirmAnswer" class="fa fa-eye form-toggle-password"></span>
			                       			</div>
			                       			<p class="form-error" id="confirmAnswerError"><i class="fa fa-exclamation-circle"></i> Your answers does not match</p>
			                    		</div>
			                    	</div>
			                    </div>
		                	</div>
						</div>
						<div class="login-form-buttons" align="center">
							<button class="default-button primary-button" type="submit" name="btnRegister" id="btnRegister">Register Account</button>
							<hr class="default-divider ml-auto">
							<a class="default-form-link-text" href="login.php">Return to Login Page</a>
						</div>
					</form>
				</div>
			</div>
			<div class="col-md-3"></div>

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
	<script src="../../assets/libs/bootstrap-select/dist/js/bootstrap-select.js"></script>
    <script src="../../assets/libs/jquery-slimscroll/jquery.slimscroll.js"></script>
    <script src="../../assets/libs/node-waves/waves.js"></script>
    <script src="../../assets/js/template/admin.js"></script>
    <script src="../../assets/js/template/demo.js"></script>

	<!-- Additional JS codes -->

	<script>

		//invoke these functions on field keyup event

		document.getElementById("tbEmail").addEventListener("keyup", validateEmailField);
		document.getElementById("tbEmail").addEventListener("keyup", checkEmail);
		document.getElementById("tbPassword").addEventListener("keyup", validatePasswordField);
		document.getElementById("tbConfirmPassword").addEventListener("keyup", validateConfirmPasswordField);
		document.getElementById("tbAnswer").addEventListener("keyup", validateAnswerField);
		document.getElementById("tbConfirmAnswer").addEventListener("keyup", validateConfirmAnswerField);

		//checks if the following field is empty

		function validateEmailField(){

			var email = $('#tbEmail').val()

			if(email == ''){

				$('#emailLine').css('border-bottom', '2px solid #ff6961');
				$('#emailLabel').css('color', '#ff6961');
				$('#emailError').css('display', 'block');
				
			}else{

				$('#emailLine').css('border-bottom', '1px solid #1f91f3');
				$('#emailLabel').css('color', '#aaa');
				$('#emailError').css('display', 'none');

			}

		}

		function validatePasswordField(){

			var password = $('#tbPassword').val();

			if(password == ''){

				$('#passwordLine').css('border-bottom', '2px solid #ff6961');
				$('#passwordLabel').css('color', '#ff6961');
				$('#passwordError1').css('display', 'block');
				
			}else{

				$('#passwordLine').css('border-bottom', '1px solid #1f91f3');
				$('#passwordLabel').css('color', '#aaa');
				$('#passwordError1').css('display', 'none');

				if(password.length < 8){

					$('#passwordLine').css('border-bottom', '2px solid #ff6961');
					$('#passwordLabel').css('color', '#ff6961');
					$('#passwordError2').css('display', 'block');

				}else{

					$('#passwordLine').css('border-bottom', '1px solid #1f91f3');
					$('#passwordLabel').css('color', '#aaa');
					$('#passwordError2').css('display', 'none');

					if(password.length > 16){

						$('#passwordLine').css('border-bottom', '2px solid #ff6961');
						$('#passwordLabel').css('color', '#ff6961');
						$('#passwordError3').css('display', 'block');

					}else{

						$('#passwordLine').css('border-bottom', '1px solid #1f91f3');
						$('#passwordLabel').css('color', '#aaa');
						$('#passwordError3').css('display', 'none');

					}

				}

			}

		}

		function validateConfirmPasswordField(){

			var password = $('#tbPassword').val();
			var confirmPassword = $('#tbConfirmPassword').val();

			if(password != confirmPassword){

				$('#confirmPasswordLine').css('border-bottom', '2px solid #ff6961');
				$('#confirmPasswordLabel').css('color', '#ff6961');
				$('#confirmPasswordError').css('display', 'block');
				$('#passwordRecovery').css('display', 'none');
				
			}else{

				$('#confirmPasswordLine').css('border-bottom', '1px solid #1f91f3');
				$('#confirmPasswordLabel').css('color', '#aaa');
				$('#confirmPasswordError').css('display', 'none');
				$('#passwordRecovery').css('display', 'block');

			}

		}

		function validateAnswerField(){

			var answer = $('#tbAnswer').val()

			if(answer == ''){

				$('#answerLine').css('border-bottom', '2px solid #ff6961');
				$('#answerLabel').css('color', '#ff6961');
				$('#answerError').css('display', 'block');
				
			}else{

				$('#answerLine').css('border-bottom', '1px solid #1f91f3');
				$('#answerLabel').css('color', '#aaa');
				$('#answerError').css('display', 'none');

			}

		}

		function validateConfirmAnswerField(){

			var answer = $('#tbAnswer').val()
			var confirmAnswer = $('#tbConfirmAnswer').val()

			if(confirmAnswer != answer){

				$('#confirmAnswerLine').css('border-bottom', '2px solid #ff6961');
				$('#confirmAnswerLabel').css('color', '#ff6961');
				$('#confirmAnswerError').css('display', 'block');
			
				
			}else{

				$('#confirmAnswerLine').css('border-bottom', '1px solid #1f91f3');
				$('#confirmAnswerLabel').css('color', '#aaa');
				$('#confirmAnswerError').css('display', 'none');

			}

		}

		function checkEmail(){

			var email = $('#tbEmail').val();

			$.post("../../backend/register/check_student_account.php", { "email": email }, function(response){

				if(response == 1){

					$('#alertMessage').css('display', 'block');
					$('#btnRegister').addClass("disabled-button");
					$('#btnRegister').removeClass("primary-button");
					$('#btnRegister').attr("disabled", true);

				}else{

					$('#alertMessage').css('display', 'none');
					$('#btnRegister').addClass("primary-button");
					$('#btnRegister').removeClass("disabled-button");
					$('#btnRegister').attr("disabled", false);

				}

			});

		}

		$('#dpBirthday').on('change', function(){
			var birthDate = new Date($('#dpBirthday').val());
			var currentDate = new Date();
			var age = currentDate - birthDate
			var formatAge = new Date(age);
			var newAge = Math.abs(formatAge.getUTCFullYear() - 1970);
			
			document.getElementById('tbAge').value = newAge;

			$.AdminBSB.input.activate();
		})

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