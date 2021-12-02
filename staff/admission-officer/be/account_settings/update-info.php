<?php
	require_once '../database/db_pdo.php';

	date_default_timezone_set('Asia/Taipei');
	
	if(ISSET($_POST['submit'])){
		try{
			$id = $_POST['id'];
			$first_name = $_POST['firstname'];
			$middle_name = $_POST['middlename'];
			$last_name = $_POST['lastname'];
			$username = $_POST['username'];
			$email = $_POST['email'];
			$contact = $_POST['email'];
			
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE `tbl_account_staff` SET `staff_first_name` = '$first_name', `staff_middle_name` = '$middle_name', `staff_last_name` = '$last_name', `staff_username` = '$username', `staff_email` = '$email', `staff_contact` = '$contact' WHERE `id` = '$id'";
			$conn->exec($sql);

			//log this action

			$staff_username = $_POST['staff_username'];
			$staff_role = 1;
			$log_description = 'Updated own account information';
        	$timestamp = date('m/d/Y, g:i:s A');

	        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	       	$sql2 = "INSERT INTO `tbl_logs`(`log_staff_id`, `log_staff_username`, `log_staff_role`, `log_description`, `timestamp`)
	        VALUES ('$id', '$staff_username', '$staff_role', '$log_description', '$timestamp')";
	        $conn->exec($sql2);
    

		}catch(PDOException $e){
			echo $e->getMessage();
		}
		
		$conn = null;
		header('location:../../account_settings.php');
	}
?>