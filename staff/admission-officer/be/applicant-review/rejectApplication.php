<?php
	require_once '../database/db_pdo.php';

	date_default_timezone_set('Asia/Taipei');
	
	if(ISSET($_POST['reject'])){
		try{
			$id = $_POST['applicantID'];
			$reason = $_POST['reasonReject'];
			$timestamp = date('F j, Y, g:i:s A');
			
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE `tbl_applicant` SET `form_status` = 'Disapproved', `fs_timestamp` = '$timestamp', `remarks` = '$reason' WHERE `id` = '$id'";

			if($conn->exec($sql)){

				//log this action

				$account = $conn->prepare("SELECT * FROM `tbl_applicant` WHERE `applicant_account_id` = '$id'");
				$account->execute();
				$fetchAccount = $account->fetch();

				$name = $fetchAccount['first_name'].' '.$fetchAccount['last_name'];

				$staff_id = $_POST['staff_id'];
				$staff_username = $_POST['staff_username'];
				$staff_role = 1;
				$log_description = 'Disapproved application form of '.$name;
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
		header('location:../../applicant_pending.php?sy_id='.$_GET['syID'].'');
	}
?>