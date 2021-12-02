<head>

    <link rel="stylesheet" type="text/css" href="../../assets/libs/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/style.css">


    <script src="../../assets/libs/jquery/jquery.min.js"></script>
    <script src="../../assets/libs/sweetalert/sweetalert2.all.min.js"></script>

</head>

<?php

require '../config/db_mysqli.php';

if(isset($_GET['verification_key'])){

	$verification_key = $_GET['verification_key'];

	$result = $connection->query("SELECT verification_key, verified FROM tbl_applicant_account WHERE verified = 0 AND verification_key = '$verification_key' LIMIT 1");

	if($result->num_rows == 1){

		$verify = $connection->query("UPDATE tbl_applicant_account SET verified = 1 WHERE verification_key = '$verification_key' LIMIT 1");

		if($verify){

			echo '
		        <script>

		            $(document).ready(function(){

		                Swal.fire({

		                    icon: "success",
		                    title: "Email successfully verified, you may now login!",
		                    showConfirmButton: false,
		                    timer: 3000

		                }).then(function(){

		                    window.location.replace("../../accounts/student/login.php");

		                });

		            });

		        </script>
        	';

		}else{

			echo $connection->error;
		}

	}else{
		
		echo '
		    <script>

		        $(document).ready(function(){

		            Swal.fire({

		                icon: "error",
		                title: "Account not found. Please contact the administrator",
		                showConfirmButton: false,
		                timer: 3000

		            }).then(function(){

		                window.location.replace("../../accounts/student/login.php");

		            });

		        });

		    </script>
        ';

	}

}else{
	die("Something went wrong. Please try again.");
}


?>