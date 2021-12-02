<?php
    include '../includes/head.php';
    require '../database/db_pdo.php';

	if(ISSET($_POST['toggle'])){
		try{
            $id = $_POST['id'];
            $status = $_POST['status'];
            
            if($status == 0){
            	$examStatus = 1;
            }else{
            	$examStatus = 0;
            }

			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE `tbl_academic_year` SET `enable_exam`='$examStatus' WHERE `id` = '$id'";
			$conn->exec($sql);

		}catch(PDOException $e){
			echo $e->getMessage();
		}
		$conn = null;
		echo '
		<script>

			$(document).ready(function(){

				Swal.fire({
					icon: "success",
					title: "Examination Status Updated Successfully",
                    text: "LNU - Student Admission and Information System",
					timer: 2000
				}).then(function(){
					window.location.replace("../../exam_toggle.php");

				});

			});

		</script>
	';
	}
?>

