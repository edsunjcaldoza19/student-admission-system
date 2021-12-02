<?php
    include '../includes/head.php';
    require '../database/db_pdo.php';
	$sy_id = $_GET['sy_id'];

	if(ISSET($_POST['updateScore'])){
		date_default_timezone_set('Asia/Taipei');
		try{
            $id = $_POST['id'];
            $courseId = $_POST['courseId'];
            $firstChoice = $_POST['firstChoice'];
            $secondChoice = $_POST['secondChoice'];
            $interview_score = $_POST['interview_score'];
			$timestamp = date('F j, Y, g:i:s A');

			if($courseId == $firstChoice){
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = "UPDATE `tbl_interview` SET `interview_rating_1`= '$interview_score'
	            WHERE `interview_applicant_id`='$id'";
				$conn->exec($sql);

				//fetch passing rating

				$sql1 = $conn->prepare("SELECT * FROM `tbl_course` WHERE `course_id`=$courseId");
				$sql1->execute();
				$fetch = $sql1->fetch();

				if($interview_score >= $fetch['interview_passing_score']){
					$status = 'Qualified';
				}else{
					$status = 'Unqualified';
				}

				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql2 = "UPDATE `tbl_applicant` SET `interview_status_1`='$status', `is_timestamp_1` = '$timestamp'
	            WHERE `applicant_account_id`=$id";
				$conn->exec($sql2);

				//log this action

				$account = $conn->prepare("SELECT * FROM `tbl_applicant` WHERE `applicant_account_id` = '$id'");
				$account->execute();
				$fetchAccount = $account->fetch();

				$name = $fetchAccount['first_name'].' '.$fetchAccount['last_name'];

				$staff_id = $_POST['staffID'];
				$staff_username = $_POST['staff_username'];
				$staff_role = 4;
				$log_description = 'Encoded interview rating for '.$name;
				$log_timestamp = date('m/d/Y, g:i:s A');

				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql2 = "INSERT INTO `tbl_logs`(`log_staff_id`, `log_staff_username`, `log_staff_role`, `log_description`, `timestamp`)
        		VALUES ('$staff_id', '$staff_username', '$staff_role', '$log_description', '$log_timestamp')";
				$conn->exec($sql2);

			}else{
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = "UPDATE `tbl_interview` SET `interview_rating_2`= '$interview_score'
	            WHERE `interview_applicant_id`='$id'";
				$conn->exec($sql);

				//fetch passing rating

				$sql1 = $conn->prepare("SELECT * FROM `tbl_course` WHERE `course_id`=$courseId");
				$sql1->execute();
				$fetch = $sql1->fetch();

				if($interview_score >= $fetch['interview_passing_score']){
					$status = 'Qualified';
				}else{
					$status = 'Unqualified';
				}

				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql2 = "UPDATE `tbl_applicant` SET `interview_status_2`='$status', `is_timestamp_2` = '$timestamp'
	            WHERE `applicant_account_id`=$id";
				$conn->exec($sql2);

				//log this action

				$account = $conn->prepare("SELECT * FROM `tbl_applicant` WHERE `applicant_account_id` = '$id'");
				$account->execute();
				$fetchAccount = $account->fetch();

				$name = $fetchAccount['first_name'].' '.$fetchAccount['last_name'];

				$staff_id = $_POST['staffID'];
				$staff_username = $_POST['staff_username'];
				$staff_role = 4;
				$log_description = 'Encoded interview rating for '.$name;
				$log_timestamp = date('m/d/Y, g:i:s A');

				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql2 = "INSERT INTO `tbl_logs`(`log_staff_id`, `log_staff_username`, `log_staff_role`, `log_description`, `timestamp`)
        		VALUES ('$staff_id', '$staff_username', '$staff_role', '$log_description', '$log_timestamp')";
				$conn->exec($sql2);
			}

			//fetch passing rating

			$sql3 = $conn->prepare("SELECT * FROM `tbl_applicant` WHERE `applicant_account_id`=$id");
			$sql3->execute();
			$fetch1 = $sql3->fetch();

			if(($fetch1['interview_status_1'] == 'Qualified' || $fetch1['interview_status_1'] == 'Unqualified') && ($fetch1['interview_status_2'] == 'Qualified' || $fetch1['interview_status_2'] == 'Unqualified')){
				$progress = 'Done';
			}else{
				$progress = 'Pending';
			}

			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql4 = "UPDATE `tbl_applicant_account` SET `interview_progress`='$progress', `ip_timestamp` = '$timestamp'
            WHERE `id`=$id";
			$conn->exec($sql4);

		}catch(PDOException $e){
			echo $e->getMessage();
		}
		$conn = null;
		echo '
		<script>

			$(document).ready(function(){

				Swal.fire({
					icon: "success",
					title: "Applicant Interview Score Added",
                    text: "LNU - Student Admission and Information System",
					timer: 1000
				}).then(function(){
					window.location.replace("../../applicant_scheduled.php?sy_id='.$sy_id.'");

				});

			});

		</script>
	';
	}
?>

