<?php
    include '../includes/head.php';
    require '../database/db_pdo.php';

    date_default_timezone_set('Asia/Taipei');

	if(isset($_POST['add'])){
		try{
           /* Add a new AY to the database */
            $year = $_POST['year'];
            $enable_exam = $_POST['enableExam'];
            $status = $_POST['status'];

            /* Disables currently active academic year */

            if($status == 1){

            	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = "UPDATE `tbl_academic_year` SET `ay_status` = 0 WHERE `ay_status` = 1";
				$conn->exec($sql);

            }

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql1 = "INSERT INTO `tbl_academic_year`(`ay_year`, `enable_exam`, `ay_status`)
            VALUES ('$year', '$enable_exam', '$status')";

            if($conn->exec($sql1)){

            	//log this action

				$staff_id = $_POST['staff_id'];
				$staff_username = $_POST['staff_username'];
				$staff_role = 0;
				$log_description = 'Added the academic year '.$year;
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
					title: "Academic Year Successfully Added",
                    text: "LNU - Student Admission and Information System",
					timer: 2000
				}).then(function(){
					window.location.replace("../../academic_year.php");

				});

			});

		</script>
	';
	}
?>


