<?php

    include '../includes/head.php';
    require '../database/db_pdo.php';

    date_default_timezone_set('Asia/Taipei');

    error_reporting(0);
	if(ISSET($_POST['update'])){
		try{
            $id = $_POST['id'];
            $username = $_POST['username'];
            $password = $_POST['password'];
			$role = $_POST['role'];
            $title = $_POST['title'];
            $firstName = $_POST['firstName'];
            $middleName = $_POST['middleName'];
            $lastName = $_POST['lastName'];
            $email = $_POST['email'];
            $contact = $_POST['contact'];
			$role = $_POST['role'];
			$unitID = $_POST['unitID'];

			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE `tbl_account_staff` SET `staff_username`='$username',
            `staff_password`='$password',`staff_role`='$role', `staff_title`='$title',`staff_first_name`='$firstName',
            `staff_middle_name`='$middleName',`staff_last_name`='$lastName',
            `staff_contact`='$contact',`staff_email`='$email',`staff_role`='$role',`staff_unit`='$unitID' WHERE `id` = '$id'";

			if($conn->exec($sql)){

				echo '
					<script>

						$(document).ready(function(){

							Swal.fire({
								icon: "success",
								title: "Staff Account Successfully Updated",
			                    text: "LNU - Student Admission and Information System",
			                    timer: 2000

							}).then(function(){
								window.location.replace("../../account_all.php");

							});

						});

					</script>
				';

				//log this action

				$staff_id = $_POST['staff_id'];
				$staff_username = $_POST['staff_username'];
				$staff_role = 0;
				$log_description = 'Modified staff account details for username '.$username;
				$timestamp = date('m/d/Y, g:i:s A');

				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql2 = "INSERT INTO `tbl_logs`(`log_staff_id`, `log_staff_username`, `log_staff_role`, `log_description`, `timestamp`)
	            VALUES ('$staff_id', '$staff_username', '$staff_role', '$log_description', '$timestamp')";
				$conn->exec($sql2);

			}

			//pathinfo
			$image=$_FILES['image']['name'];
			$extension = pathinfo($image, PATHINFO_EXTENSION);
			$rename = 'STAFF_PROFILE_'.strtolower($firstName.'_'.$lastName);
			$newname = $rename.'.'.$extension;
			$target="../../../../images/staff-img/".$newname;
			//old Image
			$oldImage = $_POST['oldImage'];

			if($image != ""){
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = "UPDATE `tbl_account_staff` SET `staff_profile_img`='$newname' WHERE `id` = '$id'";
				$conn->exec($sql);
				if (unlink("../../../../images/staff-img/".$oldImage)) {
					$msg= "Deleted";
				}
				else {
					$msg ="Not Deleted";
				}
				//Move to path
				if(move_uploaded_file($_FILES['image']['tmp_name'], $target)){
					$msg="Image uploaded successfully";
        		}
			}
			else{
				$msg="No Changes";
			}
		}catch(PDOException $e){
			echo $e->getMessage();
		}
		$conn = null;
	
	}
?>

