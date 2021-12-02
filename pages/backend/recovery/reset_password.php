<head>

    <link rel="stylesheet" type="text/css" href="../../assets/libs/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/style.css">

    <script src="../../assets/libs/jquery/jquery.min.js"></script>
    <script src="../../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/libs/sweetalert/sweetalert2.all.min.js"></script>

</head>

<?php

	require '../config/db_pdo.php';

	if(isset($_POST['btnRecover'])){

		try{

            $email = $_POST['tbEmail'];
			$password = $_POST['tbPassword'];
			$password = password_hash($password, PASSWORD_DEFAULT);

			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$sql = "UPDATE `tbl_applicant_account` SET `password` = '$password' WHERE `email` = '$email'";
			$conn->exec($sql);

			success();


		}catch(PDOException $e){
			echo $e->getMessage();
		}
	}

	function success(){

		echo '
        <script>

            $(document).ready(function(){

                Swal.fire({

                    icon: "success",
                    title: "Password successfully reset!",
                    showConfirmButton: false,
                    timer: 2000

                }).then(function(){

                    window.location.replace("../../accounts/student/login.php");

                });

            });

        </script>

        ';

	}

	function error(){

		echo '
        <script>

            $(document).ready(function(){

                Swal.fire({

                    icon: "error",
                    title: "'.$e->getErrorMessage().'",
                    showConfirmButton: false,
                    timer: 2000

                }).then(function(){

                    window.location.replace("../../accounts/student/password_recovery.php");

                });

            });

        </script>

        ';

	}

?>
