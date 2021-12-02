<?php 

	include '../config/db_mysqli.php';

	if(isset($_GET['email']))
	{
		
		$email = $_GET['email'];
		$answer = $_GET['answer'];

		$sqlQuery = "SELECT * FROM tbl_applicant_account WHERE `email` = '$email' AND `security_answer` = '$answer'";

		$result = mysqli_query($connection, $sqlQuery);

		if(mysqli_num_rows($result) > 0){
			echo 1;
		}else{
			echo 0;
		}

	}

?>