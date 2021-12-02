<?php
	include '../includes/head.php';
	require_once '../database/db_pdo.php';

	date_default_timezone_set('Asia/Taipei');

	if(ISSET($_POST['update'])){
		try{
            $id = $_POST['id'];
			$year = $_POST['year'];
			$result_available = $_POST['resultAvailable'];
            $status = $_POST['status'];

			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE `tbl_academic_year` SET
            `ay_year`='$year', `result_available`=$result_available, `ay_status`=$status WHERE `id` = '$id'";

			if($conn->exec($sql)){

				//log this action

				$staff_id = $_POST['staff_id'];
				$staff_username = $_POST['staff_username'];
				$staff_role = 0;
				$log_description = 'Modified the academic year '.$year;
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
					title: "Academic Year Successfully Updated",
					text: "LNU - Student Admission Information System",
					timer: 2000
				}).then(function(){

					window.location.replace("../../academic_year.php");

				});

			});

		</script>
	';
	}
?>