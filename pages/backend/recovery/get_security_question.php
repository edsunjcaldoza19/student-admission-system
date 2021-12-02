<?php 

	include '../config/db_pdo.php';

	if(isset($_GET['email']))
	{
		
		$email = $_GET['email'];

		$sql = $conn->prepare("SELECT * FROM tbl_applicant_account WHERE `email` = '$email'");
		$sql->execute();
		$result = $sql->fetch();

		echo $result['security_question'];

	}

?>