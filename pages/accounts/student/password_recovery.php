<!DOCTYPE html>
<html>
<head>
	<title>LNU SAIS | Password Recovery</title>

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
<body style="background-color: #262626;">

	<div class="container-fluid login">
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4 login">
				<div class="container-fluid" style="width: 100%; padding: 40px;">
				<img src="../../assets/images/navbar_logo_main.png" style="width: 50%; position: absolute; left: 50%; margin-left: -25%;">
				</div>
				<div class="login-form-container">
					<form method="POST" action="../../backend/recovery/reset_password.php">
						<div class="login-form-header">
							<p class="login-form-header-text">Password Recovery</p>
							<p class="login-form-header-subtext">Please enter the e-mail address linked to your account</p>
						</div>
						<div class="alert alert-danger" id="alertMessage" name="alertMessage" style="padding: 10px; display: none;">
							<i class="fa fa-times-circle"></i><p class="" style="display: inline-block; margin-left: 10px; font-size: 12px;">No account is associated with this email.</p>
						</div>
						<div class="login-form-body">
		                    <div class="form-group form-float">
		                        <div class="form-line">
		                            <input type="email" name="tbEmail" id="tbEmail" class="form-control" autocomplete="off" required/>
		                            <label class="form-label">Email</label>
		                        </div>
		                    </div>
						</div>
						<div class="login-form-body security-question-section" id="securityQuestion" style="display: none;">
							<div class="form-group form-float">
		                        <p class="login-form-header-subtext">Your security question:</p>
		                        <p class="login-form-security-question" id="security-question">

		                        </p>
		                    </div>
		                    <div class="form-group form-float">
		                        <div class="form-line" id="answerLine">
		                            <input type="password" name="tbAnswer" id="tbAnswer" class="form-control" required/>
		                            <label class="form-label" id="answerLabel">Answer *</label>
		                            <span toggle="#tbAnswer" class="fa fa-eye form-toggle-password"></span>
		                       	</div>
		                    </div>
		                     <div class="form-group form-float">
		                        <div class="form-line" id="confirmAnswerLine">
		                           	<input type="password" name="tbConfirmAnswer" id="tbConfirmAnswer" class="form-control" required/>
		                           	<label class="form-label" id="confirmAnswerLine">Confirm Answer *</label>
		                           	<span toggle="#tbConfirmAnswer" class="fa fa-eye form-toggle-password"></span>
		                       	</div>
		                       	<p class="form-error" id="confirmAnswerError"><i class="fa fa-exclamation-circle"></i> Your answers does not match</p>
		                    </div>
						</div>
						<div class="alert alert-danger" id="errorMessage" name="errorMessage" style="padding: 10px; display: none;">
							<i class="fa fa-times-circle"></i><p class="" style="display: inline-block; margin-left: 10px; font-size: 12px;">Your answer is not correct.</p>
						</div>
						<div class="alert alert-success" id="successMessage" name="successMessage" style="padding: 10px; display: none;">
							<i class="fa fa-times-circle"></i><p class="" style="display: inline-block; margin-left: 10px; font-size: 12px;">Your answer is correct.</p>
						</div>
						<div class="login-form-body security-question-section" id="newPassword" style="display: none;">
		                    <div class="form-group form-float">
		                        <div class="form-line" id="passwordLine">
		                           	<input type="password" name="tbPassword" id="tbPassword" class="form-control" required/>
		                           	<label class="form-label" id="passwordLabel">New Password *</label>
		                           	<span toggle="#tbPassword" class="fa fa-eye form-toggle-password"></span>
		                       	</div>
		                       	<p class="form-error" id="passwordError1"><i class="fa fa-exclamation-circle"></i> What's your password?</p>
		                       	<p class="form-error" id="passwordError2"><i class="fa fa-exclamation-circle"></i> Minimum password length is 8</p>
		                       	<p class="form-error" id="passwordError3"><i class="fa fa-exclamation-circle"></i> Maximum password length is 16</p>
		                   	</div>
		                   	<div class="form-group form-float">
		                        <div class="form-line" id="confirmPasswordLine">
		                           	<input type="password" name="tbConfirmPassword" id="tbConfirmPassword" class="form-control" required/>
		                           	<label class="form-label" id="confirmPasswordLabel">Confirm New Password *</label>
		                           	<span toggle="#tbConfirmPassword" class="fa fa-eye form-toggle-password"></span>
		                       	</div>
		                       	<p class="form-error" id="confirmPasswordError"><i class="fa fa-exclamation-circle"></i> Passwords does not match</p>
		                    </div>
						</div>
						<div class="login-form-buttons" align="center">
							<button class="default-button disabled-button" id="btnRecover" name="btnRecover" type="submit" disabled>Reset Password</button>
							<hr class="default-divider ml-auto">
							<a class="default-form-link-text" href="login.php">Return to Login Page</a>
						</div>
					</form>
				</div>
			</div>
			<div class="col-md-4"></div>
		</div>
	</div>

	<script src="../../assets/libs/jquery/jquery.min.js"></script>
	<script src="../../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="../../assets/libs/chart.js/Chart.min.js"></script>
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

		document.getElementById("tbEmail").addEventListener("keyup", checkEmail);
		document.getElementById("tbConfirmAnswer").addEventListener("keyup", validateConfirmAnswerField);
		document.getElementById("tbConfirmAnswer").addEventListener("keyup", checkAnswer);
		document.getElementById("tbPassword").addEventListener("keyup", validatePasswordField);
		document.getElementById("tbConfirmPassword").addEventListener("keyup", validateConfirmPasswordField);

		function checkEmail(){

			var email = $('#tbEmail').val();

			$.post("../../backend/register/check_student_account.php", { "email": email }, function(response){

				if(response == 0){

					$('#securityQuestion').css('display', 'none')
					$('#alertMessage').css('display', 'block');
					

				}else{

					$('#securityQuestion').css('display', 'block')
					$('#alertMessage').css('display', 'none');

					getQuestion();

				}

			});

	}

	function getQuestion(){

		var email = $('#tbEmail').val();

		$.get("../../backend/recovery/get_security_question.php", { "email": email }, function(response){

			document.getElementById("security-question").innerHTML = response;				

		})

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

	function checkAnswer(){

		var email = $('#tbEmail').val();
		var answer = $('#tbConfirmAnswer').val();

		$.get("../../backend/recovery/check_answer.php", { "email": email, "answer": answer }, function(response){

			if(response == 1){

				$('#successMessage').css('display', 'block');
				$('#errorMessage').css('display', 'none');
				$('#newPassword').css('display', 'block');

			}else{

				$('#errorMessage').css('display', 'block');
				$('#successMessage').css('display', 'none');
				$('#newPassword').css('display', 'none');

			}				

		})

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
				$('#btnRecover').addClass("disabled-button");
				$('#btnRecover').removeClass("primary-button");
				$('#btnRecover').attr("disabled", true);
				
			}else{

				$('#confirmPasswordLine').css('border-bottom', '1px solid #1f91f3');
				$('#confirmPasswordLabel').css('color', '#aaa');
				$('#confirmPasswordError').css('display', 'none');
				$('#btnRecover').addClass("primary-button");
				$('#btnRecover').removeClass("disabled-button");
				$('#btnRecover').attr("disabled", false);

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