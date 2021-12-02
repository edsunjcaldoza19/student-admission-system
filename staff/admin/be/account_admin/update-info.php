<?php
	require_once '../database/db_pdo.php';

	date_default_timezone_set('Asia/Taipei');
	
	if(ISSET($_POST['submit'])){
		try{
			$id = $_POST['id'];
			$name = $_POST['name'];
			$username = $_POST['username'];
			$email = $_POST['email'];
			
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE `tbl_admin` SET `name` = '$name', `username` = '$username', `email` = '$email' WHERE `id` = '$id'";
			$conn->exec($sql);

			//log this action

			$staff_role = 0;
			$log_description = 'Updated own account information';
        	$timestamp = date('m/d/Y, g:i:s A');

	        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	       	$sql2 = "INSERT INTO `tbl_logs`(`log_staff_id`, `log_staff_username`, `log_staff_role`, `log_description`, `timestamp`)
	        VALUES ('$staff_id', '$staff_username', '$staff_role', '$log_description', '$timestamp')";
	        $conn->exec($sql2);
    

		}catch(PDOException $e){
			echo $e->getMessage();
		}
		
		$conn = null;
		header('location:../../account_admin.php');
	}
?>