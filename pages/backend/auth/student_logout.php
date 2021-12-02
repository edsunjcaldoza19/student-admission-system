<?php

require '../config/db_pdo.php';

session_start();

$token = $_SESSION['student_token'];
$id = '';

$sql = $conn->prepare("SELECT * from `tbl_applicant_account` where `session_token`='$token'");
$sql->execute();
if($fetch = $sql->fetch()){

	$id = $fetch['id'];

}

$data = [

	'id' => $id,
	'login_status' => "Logged-out",
	'session_token' => ""

];

$sql = "UPDATE tbl_applicant_account SET login_status=:login_status, session_token=:session_token WHERE id=:id";
$success = $conn->prepare($sql)->execute($data);

/* Unsets session */

if($success){

	unset($_SESSION['student_token']);
	header("location:../../accounts/student/login.php");

}else{

	echo '

		<script>

			alert("Something went wrong");

		</script>

	';

}

?>