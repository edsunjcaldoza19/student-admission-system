<?php
	include '../includes/head.php';
	require_once '../database/db_pdo.php';

	date_default_timezone_set('Asia/Taipei');

	if(ISSET($_POST['update'])){
		try{
			$id = $_POST['id'];
			$sy_id = $_POST['sy_id'];
			$program_quota = $_POST['program_quota'];
			$waitlist_quota = $_POST['waitlist_quota'];
			$interview_passing = $_POST['interview_passing'];

			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE `tbl_course` SET `course_quota`='$program_quota',
            `waitlist_quota`='$waitlist_quota', `interview_passing_score`='$interview_passing' 
            WHERE `course_id` = '$id'";

			if($conn->exec($sql)){

				//log this action

				$course = $conn->prepare("SELECT * FROM `tbl_course` WHERE `course_id` = '$id'");
				$course->execute();
				$fetchProgram = $course->fetch();

				$program = $fetchProgram['course_name'];

				$staff_id = $_POST['staff_id'];
				$staff_username = $_POST['staff_username'];
				$staff_role = 3;
				$log_description = 'Modified program configurations for '.$program;
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
					title: "Program Configuration Successfully Updated",
					text: "LNU - Student Admission Information System",
					timer: 2000
				}).then(function(){

					window.location.replace("../../program_configurations.php?sy_id='.$sy_id.'");

				});

			});

		</script>
	';
	}
?>