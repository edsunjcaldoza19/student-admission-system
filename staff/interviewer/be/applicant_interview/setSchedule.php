<?php
    include '../includes/head.php';
    require '../database/db_pdo.php';
	$sy_id = $_GET['sy_id'];

	if(ISSET($_POST['setSchedule'])){
		date_default_timezone_set('Asia/Taipei');
		try{
            $id = $_POST['id'];
            $staff_id = $_POST['staffID'];
            $course_id = $_POST['courseID'];
            $firstChoice = $_POST['firstChoice'];
            $secondChoice = $_POST['secondChoice'];
            $method = $_POST['method'];

            if($method == 'Face-to-Face'){
            	$link = $_POST['venue'];
            }else{
            	$link = $_POST['link'];
            }

            $timeString = $_POST['time'];
            $formatTime = new DateTime($timeString);
            $time = $formatTime->format('g:i A');

			$dateString = $_POST['date'];
            $formatDate = new DateTime($dateString);
            $date = $formatDate->format('m/d/Y');

            $timestamp = date('F j, Y, g:i:s A');

			if($course_id == $firstChoice){
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = "UPDATE `tbl_interview` SET `interview_method_1`='$method', `interview_staff_id_1` = '$staff_id', `interview_date_1`='$date',
				`interview_time_1`='$time', `interview_venue_or_link_1`='$link'
	            WHERE `interview_applicant_id`=$id";
				$conn->exec($sql);
				$sql1 = "UPDATE `tbl_applicant` SET `interview_status_1`='Scheduled', `is_timestamp_1`='$timestamp'
	            WHERE `applicant_account_id`=$id";

				if($conn->exec($sql1)){

				//log this action

				$account = $conn->prepare("SELECT * FROM `tbl_applicant` WHERE `applicant_account_id` = '$id'");
				$account->execute();
				$fetchAccount = $account->fetch();

				$name = $fetchAccount['first_name'].' '.$fetchAccount['last_name'];

				$staff_username = $_POST['staff_username'];
				$staff_role = 4;
				$log_description = 'Scheduled interview for '.$name;
				$timestamp = date('m/d/Y, g:i:s A');

				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql2 = "INSERT INTO `tbl_logs`(`log_staff_id`, `log_staff_username`, `log_staff_role`, `log_description`, `timestamp`)
        		VALUES ('$staff_id', '$staff_username', '$staff_role', '$log_description', '$timestamp')";
				$conn->exec($sql2);

				}

			}else if($course_id == $secondChoice){
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = "UPDATE `tbl_interview` SET `interview_method_2`='$method', `interview_staff_id_2` = '$staff_id', `interview_date_2`='$date',
				`interview_time_2`='$time', `interview_venue_or_link_2`='$link'
	            WHERE `interview_applicant_id`=$id";
				$conn->exec($sql);
				$sql1 = "UPDATE `tbl_applicant` SET `interview_status_2`='Scheduled', `is_timestamp_2`='$timestamp'
	            WHERE `applicant_account_id`=$id";
				
				if($conn->exec($sql1)){

				//log this action

				$account = $conn->prepare("SELECT * FROM `tbl_applicant` WHERE `applicant_account_id` = '$id'");
				$account->execute();
				$fetchAccount = $account->fetch();

				$name = $fetchAccount['first_name'].' '.$fetchAccount['last_name'];

				$staff_username = $_POST['staff_username'];
				$staff_role = 4;
				$log_description = 'Scheduled interview for '.$name;
				$timestamp = date('m/d/Y, g:i:s A');

				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql2 = "INSERT INTO `tbl_logs`(`log_staff_id`, `log_staff_username`, `log_staff_role`, `log_description`, `timestamp`)
        		VALUES ('$staff_id', '$staff_username', '$staff_role', '$log_description', '$timestamp')";
				$conn->exec($sql2);

				}
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
					title: "Applicant Schedule Added Successfully",
                    text: "LNU - Student Admission and Information System",
					timer: 1000
				}).then(function(){
					window.location.replace("../../applicant_pending.php?sy_id='.$sy_id.'");

				});

			});

		</script>
	';
	}
?>

