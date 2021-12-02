<?php
	require_once '../database/db_pdo.php';
	require '../database/db_mysqli.php';

	date_default_timezone_set('Asia/Taipei');
	
	if(ISSET($_POST['submit'])){
		try{
			$id = $_POST['staff_id'];
			$oldPassword = $_POST['oldPassword'];
			$newPassword = $_POST['newPassword'];
			$newPassword1 = password_hash($newPassword, PASSWORD_DEFAULT);
			$newPasswordConfirm = $_POST['newPasswordConfirm'];

			$sql = "SELECT * from `tbl_account_staff` where `id`='$id'";
			$query = mysqli_query($connection, $sql);
			$row = mysqli_fetch_array($query);
			$count = mysqli_num_rows($query);

			if ($newPassword == $newPasswordConfirm) {
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = "UPDATE `tbl_account_staff` SET `staff_password` = '$newPassword1' WHERE `id` = '$id'";
				$conn->exec($sql);

				//log this action

				$staff_username = $_POST['staff_username'];
				$staff_role = 1;
				$log_description = 'Updated own account password';
	        	$timestamp = date('m/d/Y, g:i:s A');

		        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		        $sql2 = "INSERT INTO `tbl_logs`(`log_staff_id`, `log_staff_username`, `log_staff_role`, `log_description`, `timestamp`)
	            VALUES ('$id', '$staff_username', '$staff_role', '$log_description', '$timestamp')";
		        $conn->exec($sql2);
			}
			else{
				?>
				<script>
					alert("Invalid Password");
					window.location.href = "../../account_settings.php";
				</script>
				<?php
			}
			
			
		}catch(PDOException $e){
			echo $e->getMessage();
		}
		
		$conn = null;
		header('location:../../account_settings.php');
	}
?>