<?php

require 'database/db_pdo.php';

session_start();

$user = $_SESSION['staff_username'];

$sql = $conn->prepare("SELECT * from `tbl_account_staff` where `staff_username`='$user'");
$sql->execute();

if($fetch = $sql->fetch()){

	$id = $fetch['id'];

	$sql = "UPDATE `tbl_account_staff` SET `login_status` = '0', `session_token` = '' WHERE id = '$id'";
	$success = $conn->prepare($sql)->execute();

	/* Unsets session from admin username */

	if($success){

		unset($_SESSION['staff_id']);
		unset($_SESSION['staff_email']);
		unset($_SESSION['staff_username']);
		unset($_SESSION['staff_name']);
		unset($_SESSION['staff_profile_img']);
		unset($_SESSION['token']);

		session_destroy();

		header("location:../../login/index.php");

	}else{
 
		echo '

			<script>

				alert("Something went wrong");

			</script>

		';

	}

}

?>