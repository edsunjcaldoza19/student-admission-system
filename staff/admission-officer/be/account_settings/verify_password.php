<?php 

	include '../database/db_pdo.php';

	if(isset($_POST['id']))
	{
		
		$id = $_POST['id'];
		$pass = $_POST['pass'];

		header('Content-Type: application/json');

		$sqlQuery = $conn->prepare("SELECT * FROM tbl_account_staff WHERE `id` = '$id'");
		$sqlQuery->execute();

		if($fetch = $sqlQuery->fetch()){
			if(password_verify($pass, $fetch['staff_password'])){
				echo 1;
			}else{
				echo 0;
			}
		}

	}

?>