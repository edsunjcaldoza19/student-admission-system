<?php 

	include '../config/db_mysqli.php';

	if(isset($_POST['email']))
	{
		
		$email = $_POST['email'];

		header('Content-Type: application/json');

		$sqlQuery = "SELECT * FROM tbl_applicant_account WHERE `email` = '$email'";

		$result = mysqli_query($connection, $sqlQuery);

		if(mysqli_num_rows($result) > 0){
			echo 1;
		}else{
			echo 0;
		}

	}

?>