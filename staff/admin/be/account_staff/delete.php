
<?php

    include '../includes/head.php';
    require '../database/db_pdo.php';

    date_default_timezone_set('Asia/Taipei');

	if(isset($_POST['delete'])){
		try{
            $id = $_POST['id'];
			$oldImage = $_POST['image'];

			//log this action

			$account = $conn->prepare("SELECT * FROM `tbl_account_staff` WHERE `id` = '$id'");
			$account->execute();
			$fetchAccount = $account->fetch();

			$username = $fetchAccount['staff_username'];

			$staff_id = $_POST['staff_id'];
			$staff_username = $_POST['staff_username'];
			$staff_role = 0;
			$log_description = 'Deleted staff account for username '.$username;
			$timestamp = date('m/d/Y, g:i:s A');

			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql2 = "INSERT INTO `tbl_logs`(`log_staff_id`, `log_staff_username`, `log_staff_role`, `log_description`, `timestamp`)
	        VALUES ('$staff_id', '$staff_username', '$staff_role', '$log_description', '$timestamp')";
			$conn->exec($sql2);

			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "DELETE FROM tbl_account_staff WHERE `id` = '$id'";

			if($conn->exec($sql)){

				echo '
					<script>

						$(document).ready(function(){

							Swal.fire({
								icon: "success",
								title: "Staff Account Successfully Deleted",
			                    text: "LNU - Student Admission and Information System",
			                    timer: 2000

							}).then(function(){
								window.location.replace("../../account_all.php");

							});

						});

					</script>
				';

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

	}
?>


