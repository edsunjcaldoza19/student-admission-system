<?php

require 'database/db_pdo.php';

session_start();

$user = $_SESSION['admin_username'];

$sql = $conn->prepare("SELECT * from `tbl_admin` where `username`='$user'");
$sql->execute();
if($fetch = $sql->fetch()){

	$id = $fetch['id'];

	$sql = "UPDATE `tbl_admin` SET `login_status` = '0', `session_token` = '' WHERE id = '$id'";
	$success = $conn->prepare($sql)->execute();

	/* Unsets session from admin username */

	if($success){

		unset($_SESSION['admin_id']);
		unset($_SESSION['admin_email']);
		unset($_SESSION['admin_username']);
		unset($_SESSION['admin_name']);
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