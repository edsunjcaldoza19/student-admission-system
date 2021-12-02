<?php
	include '../includes/head.php';
	require_once '../database/db_pdo.php';

	date_default_timezone_set('Asia/Taipei');

	if(ISSET($_POST['approve'])){

		try{

			$sy_id = $_GET['syID'];
			$id = $_POST['applicantID'];
			$courseId = $_POST['courseID'];
			$firstChoice = $_POST['firstChoice'];
			$secondChoice = $_POST['secondChoice'];
			$timestamp = date('F j, Y, g:i:s A');

            $sql = $conn->prepare("SELECT *, tbl_applicant.id FROM tbl_applicant
            LEFT JOIN tbl_applicant_account ON tbl_applicant_account.id = tbl_applicant.applicant_account_id
            WHERE `school_year_id` = $sy_id
            AND ((`approved_first_choice` = 1 AND `program_first_choice` = $courseId) OR (`approved_second_choice` = 1 AND `program_second_choice` = $courseId))
            ");
            $sql->execute();
            $count = $sql->rowCount();

			//checks course quota

			$sql1 = $conn->prepare("SELECT * FROM `tbl_course` WHERE `course_id` = $courseId");
			$sql1->execute();
			$fetch1 = $sql1->fetch();

			if($count <= ($fetch1['course_quota']-1)  && $fetch1['course_quota'] !== 0){

				if($courseId == $firstChoice){
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$sql = "UPDATE `tbl_applicant` SET `approved_first_choice` = 1, `admission_status` = 'Evaluated', `as_timestamp` = '$timestamp' WHERE `id` = '$id'";
					
					if($conn->exec($sql)){

					//log this action

					$account = $conn->prepare("SELECT * FROM `tbl_applicant` WHERE `applicant_account_id` = '$id'");
					$account->execute();
					$fetchAccount = $account->fetch();

					$name = $fetchAccount['first_name'].' '.$fetchAccount['last_name'];

					$staff_id = $_POST['staff_id'];
					$staff_username = $_POST['staff_username'];
					$staff_role = 3;
					$log_description = 'Approved application of '.$name;
					$timestamp = date('m/d/Y, g:i:s A');

					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$sql2 = "INSERT INTO `tbl_logs`(`log_staff_id`, `log_staff_username`, `log_staff_role`, `log_description`, `timestamp`)
	        		VALUES ('$staff_id', '$staff_username', '$staff_role', '$log_description', '$timestamp')";
					$conn->exec($sql2);

					}

				}else if($courseId == $secondChoice){
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$sql = "UPDATE `tbl_applicant` SET `approved_second_choice` = 1, `admission_status` = 'Evaluated', `as_timestamp` = '$timestamp' WHERE `id` = '$id'";
					
					if($conn->exec($sql)){

					//log this action

					$account = $conn->prepare("SELECT * FROM `tbl_applicant` WHERE `applicant_account_id` = '$id'");
					$account->execute();
					$fetchAccount = $account->fetch();

					$name = $fetchAccount['first_name'].' '.$fetchAccount['last_name'];

					$staff_username = $_POST['staff_username'];
					$staff_role = 3;
					$log_description = 'Approved application of '.$name;
					$timestamp = date('m/d/Y, g:i:s A');

					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$sql2 = "INSERT INTO `tbl_logs`(`log_staff_id`, `log_staff_username`, `log_staff_role`, `log_description`, `timestamp`)
	        		VALUES ('$staff_id', '$staff_username', '$staff_role', '$log_description', '$timestamp')";
					$conn->exec($sql2);

					}

				}

				success();

			}else{

				quotaReached();
			}

		}catch(PDOException $e){
			echo $e->getMessage();
		}

		
	}

	function success(){

		$conn = null;
		header('location:../../applicant_pending.php?sy_id='.$_GET['syID'].'');

	}

	function quotaReached(){

		echo '
			<script>

				$(document).ready(function(){

					Swal.fire({
						icon: "error",
						title: "Maximum course quota reached!",
						timer: 2000
					}).then(function(){

						window.location.replace("../../applicant_review.php?id='.$_GET['appId'].'&sy_id='.$_GET['syID'].'&course='.$_GET['courseId'].'");

					});

				});

			</script>
		';

	}
?>