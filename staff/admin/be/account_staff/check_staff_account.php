<?php 

	include '../database/db_mysqli.php';

	if(isset($_POST['username']))
	{
		
		$username = $_POST['username'];

		header('Content-Type: application/json');

		$sqlQuery = "SELECT * FROM tbl_account_staff WHERE `staff_username` = '$username'";

		$result = mysqli_query($connection, $sqlQuery);

		if(mysqli_num_rows($result) > 0){
			echo 1;
		}else{
			echo 0;
		}

	}

	else if(isset($_POST['email']))
	{
		
		$email = $_POST['email'];

		header('Content-Type: application/json');

		$sqlQuery = "SELECT * FROM tbl_account_staff WHERE `staff_email` = '$email'";

		$result = mysqli_query($connection, $sqlQuery);

		if(mysqli_num_rows($result) > 0){
			echo 1;
		}else{
			echo 0;
		}

	}

?>