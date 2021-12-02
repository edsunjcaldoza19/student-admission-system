<head>
    <link rel="stylesheet" type="text/css" href="../../../plugins/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../../../css/style.css">
    <script src="../../../plugins/jquery/jquery.min.js"></script>
    <script src="../../../plugins/sweetalert2/sweetalert2.all.min.js"></script>
</head>
<?php
	require 'database/db_pdo.php';
	require 'database/db_mysqli.php';

	session_set_cookie_params(0);
	session_start();
    $username = $_POST['username'];
	$password = $_POST['password'];
	$role = $_POST['role'];

	$validCredentials = '';

	if(ISSET($_POST['login'])){

		if($role == '0'){

			try{

				$sql = $conn->prepare("SELECT * from `tbl_admin` where `username` = '$username'");
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

					require_once('../../../plugins/jwt/jwt.php');

					$serverKey = '5f2b5cdbe5194f10b3241568fe4e2b23';

		            $nbf = new DateTimeImmutable();
		            $exp = $nbf->modify('+5 minutes')->getTimestamp();

					$payloadArray = array();
		    		$payloadArray['staff_username'] = $username;
		    		if (isset($nbf)) {$payloadArray['nbf'] = $nbf->getTimestamp();}
		    		if (isset($exp)) {$payloadArray['exp'] = $exp;}

		    		$token = JWT::encode($payloadArray, $serverKey);

					if($user['verified'] == '1'){

						if($user['login_status'] == 0){

							/* Set Session Information */

							$_SESSION['admin_id'] = $user['id'];
							$_SESSION['role'] = $role;
		    				$_SESSION['admin_username'] = $user['username'];
							$_SESSION['admin_name'] = $user['name'];
							$_SESSION['admin_email'] = $user['email'];
							$_SESSION['token'] = $token;

							$id = $user['id'];

							$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							$sql1 = "UPDATE `tbl_admin` SET `login_status` = '1', `session_token` = '$token' WHERE `id` = '$id'";
							$conn->exec($sql1);

							echo '
								<script>
									$(document).ready(function(){
										Swal.fire({
											icon: "success",
											title: "Login Successful. Please Wait...",
											text: "LNU Student Admission and Information System",
											timer: 1000,
											showConfirmButton: false
										}).then(function(){
											window.location.replace("../../admin/home.php");
										});

									});
								</script>
							';

						}else{

							header('location: ../../admin/home.php');

						}

					}else{

						notVerified();

					}


				}else{

					invalidCredentials();
				}

			}catch(exception $e){
				echo 'Error: '.$e->getMessage();

			}

		}else if($role == '1'){

			try{

				$sql = $conn->prepare("SELECT * from `tbl_account_staff` where `staff_username` = '$username' and `staff_role` = 1");
				$sql->execute();

				if($fetch = $sql->fetch()){

					if(password_verify($password, $fetch['staff_password'])){

						$user = $fetch;
						$validCredentials = true;

					}else{

						$validCredentials = false;

					}

				}

				if($validCredentials){

					/* Generate JWT Token */

					require_once('../../../plugins/jwt/jwt.php');

					$serverKey = '5f2b5cdbe5194f10b3241568fe4e2b23';

		            $nbf = new DateTimeImmutable();
		            $exp = $nbf->modify('+5 minutes')->getTimestamp();

					$payloadArray = array();
		    		$payloadArray['staff_username'] = $username;
		    		if (isset($nbf)) {$payloadArray['nbf'] = $nbf->getTimestamp();}
		    		if (isset($exp)) {$payloadArray['exp'] = $exp;}

		    		$token = JWT::encode($payloadArray, $serverKey);

					if($user['login_status'] == 0){

							$fullname = $user['staff_first_name'].' '.$user['staff_middle_name'].' '.$user['staff_last_name'];

							/* Set Session Information */

							$_SESSION['staff_id'] = $user['id'];
							$_SESSION['role'] = $role;
							$_SESSION['staff_username'] = $user['staff_username'];
							$_SESSION['staff_name'] = $fullname;
							$_SESSION['staff_email'] = $user['staff_email'];
							$_SESSION['staff_profile_img'] = $user['staff_profile_img'];
							$_SESSION['token'] = $token;

							$id = $user['id'];

							$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							$sql1 = "UPDATE `tbl_account_staff` SET `login_status` = '1', `session_token` = '$token' WHERE `id` = '$id' AND `staff_role` = 1";
							$conn->exec($sql1);

							echo '
								<script>
									$(document).ready(function(){
										Swal.fire({
											icon: "success",
											title: "Login Successful. Please Wait...",
											text: "LNU Student Admission and Information System",
											timer: 1000,
											showConfirmButton: false
										}).then(function(){
											window.location.replace("../../admission-officer/index.php");
										});

									});
								</script>
							';

					}else{

						header('location: ../../admission-officer/home.php');

					}


				}else{

					invalidCredentials();
				}

			}catch(exception $e){
				echo 'Error: '.$e->getMessage();

			}

		}elseif($role == '2'){

			try{

				$sql = $conn->prepare("SELECT * from `tbl_account_staff` where `staff_username` = '$username' and `staff_role` = 2");
				$sql->execute();

				if($fetch = $sql->fetch()){

					if(password_verify($password, $fetch['staff_password'])){

						$user = $fetch;
						$validCredentials = true;

					}else{

						$validCredentials = false;

					}

				}

				if($validCredentials){

					/* Generate JWT Token */

					require_once('../../../plugins/jwt/jwt.php');

					$serverKey = '5f2b5cdbe5194f10b3241568fe4e2b23';

		            $nbf = new DateTimeImmutable();
		            $exp = $nbf->modify('+5 minutes')->getTimestamp();

					$payloadArray = array();
		    		$payloadArray['staff_username'] = $username;
		    		if (isset($nbf)) {$payloadArray['nbf'] = $nbf->getTimestamp();}
		    		if (isset($exp)) {$payloadArray['exp'] = $exp;}

		    		$token = JWT::encode($payloadArray, $serverKey);

					if($user['login_status'] == 0){

							$fullname = $user['staff_first_name'].' '.$user['staff_middle_name'].' '.$user['staff_last_name'];

							/* Set Session Information */

							$_SESSION['staff_id'] = $user['id'];
							$_SESSION['role'] = $role;
							$_SESSION['staff_username'] = $user['staff_username'];
							$_SESSION['staff_name'] = $fullname;
							$_SESSION['staff_email'] = $user['staff_email'];
							$_SESSION['staff_profile_img'] = $user['staff_profile_img'];
							$_SESSION['token'] = $token;

							$id = $user['id'];

							$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							$sql1 = "UPDATE `tbl_account_staff` SET `login_status` = '1', `session_token` = '$token' WHERE `id` = '$id' AND `staff_role` = 2";
							$conn->exec($sql1);

							echo '
								<script>
									$(document).ready(function(){
										Swal.fire({
											icon: "success",
											title: "Login Successful. Please Wait...",
											text: "LNU Student Admission and Information System",
											timer: 1000,
											showConfirmButton: false
										}).then(function(){
											window.location.replace("../../exam-officer/index.php");
										});

									});
								</script>
							';

					}else{

						header('location: ../../exam-officer/home.php');

					}


				}else{

					invalidCredentials();
				}

			}catch(exception $e){
				echo 'Error: '.$e->getMessage();

			}

		}elseif($role == '3'){

			try{

				$sql = $conn->prepare("SELECT * from `tbl_account_staff` where `staff_username` = '$username' and `staff_role` = 3");
				$sql->execute();

				if($fetch = $sql->fetch()){

					if(password_verify($password, $fetch['staff_password'])){

						$user = $fetch;
						$validCredentials = true;

					}else{

						$validCredentials = false;

					}

				}

				if($validCredentials){

					/* Generate JWT Token */

					require_once('../../../plugins/jwt/jwt.php');

					$serverKey = '5f2b5cdbe5194f10b3241568fe4e2b23';

		            $nbf = new DateTimeImmutable();
		            $exp = $nbf->modify('+5 minutes')->getTimestamp();

					$payloadArray = array();
		    		$payloadArray['staff_username'] = $username;
		    		if (isset($nbf)) {$payloadArray['nbf'] = $nbf->getTimestamp();}
		    		if (isset($exp)) {$payloadArray['exp'] = $exp;}

		    		$token = JWT::encode($payloadArray, $serverKey);

					if($user['login_status'] == 0){

							$fullname = $user['staff_first_name'].' '.$user['staff_middle_name'].' '.$user['staff_last_name'];

							/* Set Session Information */

							$_SESSION['staff_id'] = $user['id'];
							$_SESSION['role'] = $role;
							$_SESSION['staff_username'] = $user['staff_username'];
							$_SESSION['staff_name'] = $fullname;
							$_SESSION['staff_email'] = $user['staff_email'];
							$_SESSION['staff_profile_img'] = $user['staff_profile_img'];
							$_SESSION['staff_unit'] = $user['staff_unit'];
							$_SESSION['token'] = $token;

							$id = $user['id'];

							$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							$sql1 = "UPDATE `tbl_account_staff` SET `login_status` = '1', `session_token` = '$token' WHERE `id` = '$id' AND `staff_role` = 3";
							$conn->exec($sql1);

							echo '
								<script>
									$(document).ready(function(){
										Swal.fire({
											icon: "success",
											title: "Login Successful. Please Wait...",
											text: "LNU Student Admission and Information System",
											timer: 1000,
											showConfirmButton: false
										}).then(function(){
											window.location.replace("../../unit-officer/index.php");
										});

									});
								</script>
							';

					}else{

						header('location: ../../unit-officer/home.php');

					}


				}else{

					invalidCredentials();
				}

			}catch(exception $e){
				echo 'Error: '.$e->getMessage();

			}

		}elseif($role == '4'){

			try{

				$sql = $conn->prepare("SELECT * from `tbl_account_staff` where `staff_username` = '$username' and `staff_role` = 4");
				$sql->execute();

				if($fetch = $sql->fetch()){

					if(password_verify($password, $fetch['staff_password'])){

						$user = $fetch;
						$validCredentials = true;

					}else{

						$validCredentials = false;

					}

				}

				if($validCredentials){

					/* Generate JWT Token */

					require_once('../../../plugins/jwt/jwt.php');

					$serverKey = '5f2b5cdbe5194f10b3241568fe4e2b23';

		            $nbf = new DateTimeImmutable();
		            $exp = $nbf->modify('+5 minutes')->getTimestamp();

					$payloadArray = array();
		    		$payloadArray['username'] = $username;
		    		if (isset($nbf)) {$payloadArray['nbf'] = $nbf->getTimestamp();}
		    		if (isset($exp)) {$payloadArray['exp'] = $exp;}

		    		$token = JWT::encode($payloadArray, $serverKey);

					if($user['login_status'] == 0){

							$fullname = $user['staff_first_name'].' '.$user['staff_middle_name'].' '.$user['staff_last_name'];

							/* Set Session Information */

							$_SESSION['staff_id'] = $user['id'];
							$_SESSION['role'] = $role;
							$_SESSION['staff_username'] = $user['staff_username'];
							$_SESSION['staff_name'] = $fullname;
							$_SESSION['staff_email'] = $user['staff_email'];
							$_SESSION['staff_profile_img'] = $user['staff_profile_img'];
							$_SESSION['staff_unit'] = $user['staff_unit'];
							$_SESSION['staff_program'] = $user['staff_program'];
							$_SESSION['token'] = $token;

							$id = $user['id'];

							$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							$sql1 = "UPDATE `tbl_account_staff` SET `login_status` = '1', `session_token` = '$token' WHERE `id` = '$id' AND `staff_role` = 4";
							$conn->exec($sql1);

							echo '
								<script>
									$(document).ready(function(){
										Swal.fire({
											icon: "success",
											title: "Login Successful. Please Wait...",
											text: "LNU Student Admission and Information System",
											timer: 1000,
											showConfirmButton: false
										}).then(function(){
											window.location.replace("../../interviewer/index.php");
										});

									});
								</script>
							';

					}else{

						header('location: ../../interviewer/home.php');

					}


				}else{

					invalidCredentials();
				}

			}catch(exception $e){
				echo 'Error: '.$e->getMessage();

			}

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

                    window.location.replace("../index.php");

                });

            });

        </script>

    ';

	}

	function notVerified(){

	echo '
        <script>

            $(document).ready(function(){

                Swal.fire({

                    icon: "error",
                    title: "Your account is not yet activated!",
                    showConfirmButton: false,
                    timer: 2000

                }).then(function(){

                    window.location.replace("../index.php");

                });

            });

        </script>

    ';

	}

?>