<?php
    include '../includes/head.php';
    require '../database/db_pdo.php';
	$sy_id = $_GET['sy_id'];

	date_default_timezone_set('Asia/Taipei');

	if(ISSET($_POST['updateScore'])){
		date_default_timezone_set('Asia/Taipei');
		try{
            $id = $_POST['id'];
            $exam_score = $_POST['exam_score'];
			$timestamp = date('F j, Y, g:i:s A');

			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE `tbl_exam_result` SET `exam_score`=$exam_score
            WHERE `exam_applicant_id`=$id";
			$conn->exec($sql);

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql1 = "UPDATE `tbl_applicant` SET `exam_status`= 'Scored', `es_timestamp` = '$timestamp'
            WHERE `applicant_account_id`=$id";

			if($conn->exec($sql1)){

				//log this action

				$account = $conn->prepare("SELECT * FROM `tbl_applicant` WHERE `applicant_account_id` = '$id'");
				$account->execute();
				$fetchAccount = $account->fetch();

				$name = $fetchAccount['first_name'].' '.$fetchAccount['last_name'];

				$staff_id = $_POST['staff_id'];
				$staff_username = $_POST['staff_username'];
				$staff_role = 2;
				$log_description = 'Encoded examination score for '.$name;
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
					title: "Examinee Score Added",
                    text: "LNU - Student Admission and Information System",
					timer: 1000
				}).then(function(){
					window.location.replace("../../applicant_unscored.php?sy_id='.$sy_id.'");

				});

			});

		</script>
	';
	}
?>

