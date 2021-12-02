<?php

/* Redirects to login page if user already logged-out */
session_start();

require '../../backend/config/db_pdo.php';

if(isset($_SESSION['student_token'])){

	$token = $_SESSION['student_token'];

	$sql = $conn->prepare("SELECT * from `tbl_applicant_account` where `session_token`='$token'");
	$sql->execute();

	if($fetch = $sql->fetch()){

		$id = $fetch['id'];
		$email = $fetch['email'];
		$form1 = $fetch['form1_progress'];


	}else{

		invalidToken();

	}

}else{

	loggedOut();

}


function invalidToken(){

	echo '
        <script>

            alert("[TOKEN EXPIRED/INVALID]: Please login to continue");
            window.location.replace("../../accounts/student/login.php");

        </script>

    ';

}

function loggedOut(){

	echo '
        <script>

            alert("[WARNING]: You have been logged-out, please login to continue");
            window.location.replace("../../accounts/student/login.php");

        </script>

    ';

}


?>