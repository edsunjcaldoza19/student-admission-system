<head>

    <link rel="stylesheet" type="text/css" href="../../assets/libs/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/style.css">

    <script src="../../assets/libs/jquery/jquery.min.js"></script>
    <script src="../../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/libs/sweetalert/sweetalert2.all.min.js"></script>

</head>

<?php

require '../config/db_pdo.php';

ini_set('session.gc_maxlifetime', 3600);
session_start();

if(isset($_POST['btnLogin'])){

	try{

		/* Checks user credentials in the database  */

		$email = $_POST['tbEmail'];
		$password = $_POST['tbPassword'];
		$validCredentials = '';
		$sql = $conn->prepare("SELECT * from `tbl_applicant_account` where `email`='$email'");
		$sql->execute();
		if($fetch = $sql->fetch()){

			if(password_verify($password, $fetch['password'])){

				$user = $fetch;
				$validCredentials = true;

			}else{

				$validCredentials = false;

			}

		}

		if($validCredentials){

			/* Generate JWT Token */

			require_once('jwt.php');

			$serverKey = '5f2b5cdbe5194f10b3241568fe4e2b23';

            $nbf = new DateTimeImmutable();
            $exp = $nbf->modify('+5 minutes')->getTimestamp();

			$payloadArray = array();
    		$payloadArray['email'] = $email;
    		if (isset($nbf)) {$payloadArray['nbf'] = $nbf->getTimestamp();}
    		if (isset($exp)) {$payloadArray['exp'] = $exp;}

    		$token = JWT::encode($payloadArray, $serverKey);

			if($user['login_status'] == 0){

				if($user['readmission_verified'] == 1){

					// Check if account is already verified //

					if($fetch['verified'] == 1){

					/* Set Session Information */

					$_SESSION['student_token'] = $token;

					/* Update User Token */

    				$data = [

    					'token' => $token,
    					'login_status' => 1,
    					'id' => $user['id']

    				];

					$sql = "UPDATE tbl_applicant_account SET session_token=:token, login_status=:login_status WHERE id=:id";
					$conn->prepare($sql)->execute($data);

					echo '
						<script>
							window.location.replace("../../student/admission_procedures/start.php");
						</script>
					';


					}else{

						notVerified();

					}

				}else if($user['readmission_verified'] == 2){

					rejected();

				}
				else{

					notReadmissionVerified();

				}


			}else{

				loggedIn();

			}


		}else{

			invalidCredentials();
		}

	}catch(exception $e){
		echo 'Error: '.$e->getMessage();

	}

}

function invalidCredentials(){

	echo '
        <script>

            $(document).ready(function(){

                Swal.fire({

                    icon: "error",
                    title: "Invalid username or password",
                    showConfirmButton: false,
                    timer: 2000

                }).then(function(){

                    window.location.replace("../../accounts/student/login.php");

                });

            });

        </script>

    ';

}

function loggedIn(){

	header('location: ../../student/admission_procedures/start.php');

}

function notVerified(){

	echo '
        <script>

            alert("[UNVERIFIED ACCOUNT]: Please check your email to verify and try again");
            window.location.replace("../../accounts/student/login.php");

        </script>

    ';

}

function notReadmissionVerified(){

	echo '
        <script>

            alert("[UNVERIFIED ACCOUNT]: Your account is still pending verification from the admissions office");
            window.location.replace("../../accounts/student/login.php");

        </script>

    ';

}

function rejected(){

	echo '
        <script>

            alert("[UNVERIFIED ACCOUNT]: Your account was not approved for registration. Please check your email");
            window.location.replace("../../accounts/student/login.php");

        </script>

    ';

}


