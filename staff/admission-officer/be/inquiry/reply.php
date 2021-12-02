<?php
	include '../includes/head.php';
	require_once '../database/db_pdo.php';

	date_default_timezone_set("Asia/Taipei");

	if(ISSET($_POST['send'])){
		try{
			$id = $_POST['ticketID'];
			$staff_role = $_POST['role'];
			$reply = $_POST['reply'];
			$timestamp = date("F j, Y, g:i a");
			$status = "Settled";

			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE `tbl_inquiry` SET `inquiry_reply` = '$reply', `inquiry_reply_role` = '$staff_role', `inquiry_status` = '$status', `inquiry_reply_timestamp` = '$timestamp' WHERE `id` = '$id'";

			if($conn->exec($sql)){

				//log this action

				$staff_id = $_POST['staff_id'];
				$staff_username = $_POST['staff_username'];
				$staff_role = 1;
				$log_description = 'Responded to an inquiry ticket';
				$timestamp = date('m/d/Y, g:i:s A');

				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql2 = "INSERT INTO `tbl_logs`(`log_staff_id`, `log_staff_username`, `log_staff_role`, `log_description`, `timestamp`)
        		VALUES ('$staff_id', '$staff_username', '$staff_role', '$log_description', '$timestamp')";
				$conn->exec($sql2);

			}
		}catch(PDOException $e){
			echo $e->getMessage();
		}
		$conn = null;
		echo '
		<script>

			$(document).ready(function(){

				Swal.fire({
					icon: "success",
					title: "Inquiry Reply Sent",
					text: "LNU - Student Admission Information System",
					timer: 2000
				}).then(function(){

					window.location.replace("../../inquiry.php");

				});

			});

		</script>
	';
	}
?>