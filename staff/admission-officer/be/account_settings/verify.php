<head>

    <link rel="stylesheet" type="text/css" href="../../../../pages/assets/libs/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../../../../pages/assets/css/style.css">


    <script src="../../../../pages/assets/libs/jquery/jquery.min.js"></script>
    <script src="../../../../pages/assets/libs/sweetalert/sweetalert2.all.min.js"></script>

</head>

<?php

require '../database/db_mysqli.php';

if(isset($_GET['verification_key'])){

	$verification_key = $_GET['verification_key'];

	$result = $connection->query("SELECT verification_key, verified FROM tbl_admin WHERE verified = 0 AND verification_key = '$verification_key' LIMIT 1");

	if($result->num_rows == 1){

		$verify = $connection->query("UPDATE tbl_admin SET verified = 1 WHERE verification_key = '$verification_key' LIMIT 1");

		if($verify){

			echo '
		        <script>

		            $(document).ready(function(){

		                Swal.fire({

		                    icon: "success",
		                    title: "Your administrator account is activated, you may now login!",
		                    showConfirmButton: false,
		                    timer: 3000

		                }).then(function(){

		                    window.location.replace("../../../login/index.php");

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