<?php
    include '../includes/head.php';
    require '../database/db_pdo.php';

    date_default_timezone_set('Asia/Taipei');

	if(ISSET($_POST['update'])){
		try{
            $id = $_POST['id'];
            $dateString = $_POST['date'];
            $formatDate = new DateTime($dateString);
            $date = $formatDate->format('l, F d, Y');

            $description = $_POST['description'];

			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE `tbl_schedules` SET `schedule_date`='$date',
            `schedule_desc`='$description' WHERE `id` = '$id'";
			
            if($conn->exec($sql)){

				//log this action

				$staff_id = $_POST['staff_id'];
				$staff_username = $_POST['staff_username'];
				$staff_role = 1;
				$log_description = 'Modified an admission requirement';
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
					title: "Schedule Successfully Updated",
                    text: "LNU - Student Admission and Information System",
					timer: 2000
				}).then(function(){
					window.location.replace("../../schedule.php");

				});

			});

		</script>
	';
	}
?>

