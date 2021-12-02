<?php
	require '../config/db_pdo.php';

	try{
		$id = $_GET['id'];

		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "UPDATE `tbl_applicant_account` SET `pursue_enrollment` = 1 WHERE `id` = '$id'";
		$conn->exec($sql);

	}catch(PDOException $e){
		echo $e->getMessage();
	}

	$conn = null;
	header('location: ../../student/admission_procedures/done.php');
	
?>