<?php

    include '../includes/head.php';
    require '../database/db_pdo.php';

    date_default_timezone_set('Asia/Taipei');

	if(isset($_POST['delete'])){
		try{
            $id = $_POST['id'];
			$oldImage = $_POST['image'];

			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "DELETE FROM tbl_account_staff WHERE `id` = '$id'";

			if($conn->exec($sql)){

				//log this action

				$staff_username = $_POST['staff_username'];
				$staff_role = 3;
				$log_description = 'Deleted an interviewer account';
				$timestamp = date('m/d/Y, g:i:s A');

				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql2 = "INSERT INTO `tbl_logs`(`log_staff_id`, `log_staff_username`, `log_staff_role`, `log_description`, `timestamp`)
        		VALUES ('$staff_id', '$staff_username', '$staff_role', '$log_description', '$timestamp')";
				$conn->exec($sql2);

			}


			if (unlink("../../../../images/staff-img/".$oldImage)) {
				$msg= "Deleted";
			}
			else {
				$msg ="Not Deleted";
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
					title: "Interviewer Account Successfully Deleted",
                    text: "LNU - Student Admission and Information System",
                    timer: 2000

				}).then(function(){
					window.location.replace("../../account_interviewer.php");

				});

			});

		</script>
	';
	}
?>


