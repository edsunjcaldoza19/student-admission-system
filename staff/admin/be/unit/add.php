<?php

    include '../includes/head.php';
    require '../database/db_pdo.php';

    date_default_timezone_set('Asia/Taipei');

	if(ISSET($_POST['add'])){
		try{
            $name = $_POST['name'];
            $description = $_POST['description'];
			$deptID = $_POST['deptID'];

			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO tbl_unit(`unit_name`, `unit_desc`, `unit_dept_id`)
			VALUES('$name', '$description', '$deptID')";
		
			if($conn->exec($sql)){

				//log this action

				$staff_id = $_POST['staff_id'];
				$staff_username = $_POST['staff_username'];
				$staff_role = 0;
				$log_description = 'Added the academic unit '.$name;
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
					title: "Academic Unit Successfully Added",
					text: "LNU - Student Admission and Information System",
					timer: 2000
				}).then(function(){

					window.location.replace("../../unit.php");

				});

			});

		</script>
	';
	}
?>

