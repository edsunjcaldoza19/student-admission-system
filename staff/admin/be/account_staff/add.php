<?php

    include '../includes/head.php';
    require '../database/db_pdo.php';
    error_reporting(0);
    date_default_timezone_set('Asia/Taipei');

	if(ISSET($_POST['submit'])){
		try{
			
            $username = $_POST['username'];        
            $title = $_POST['title'];
            $firstName = $_POST['firstName'];
            $middleName = $_POST['middleName'];
            $lastName = $_POST['lastName'];
            $email = $_POST['email'];
            $contact = $_POST['contact'];
			$role = $_POST['role'];
			$unitID = $_POST['unitID'];

			if($unitID == ''){
				$unitID = 0;
			}else{
				$unitID = $_POST['unitID'];
			}

			$image = generateAvatar(strtoupper($firstName[0].''.$lastName[0]), strtolower($firstName.'_'.$lastName));

            $password = password_hash($username, PASSWORD_DEFAULT);

            $loginStatus = 0;

			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO `tbl_account_staff`(`staff_username`, `staff_password`,
            `staff_title`, `staff_first_name`, `staff_middle_name`, `staff_last_name`, `staff_contact`,
            `staff_email`, `staff_role`, `staff_unit`, `staff_profile_img`, `login_status`)
            VALUES ('$username','$password','$title','$firstName','$middleName',
            '$lastName','$contact','$email', '$role', '$unitID', '$image', '$loginStatus')";
	
			if($conn->exec($sql)){
				echo '
					<script>

						$(document).ready(function(){

							Swal.fire({
								icon: "success",
								title: "Account Successfully Added",
			                    text: "LNU - Student Admission and Information System",
			                    timer: 2000

							}).then(function(){
								window.location.replace("../../account_add.php");

							});

						});

					</script>
				';

				//log this action

				$staff_id = $_POST['staff_id'];
				$staff_username = $_POST['staff_username'];
				$staff_role = 0;
				$log_description = 'Added new staff account with username '.$username;
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
		
	}

	function generateAvatar($character, $name){

		$rename = 'STAFF_PROFILE_'.$name;
		$newname = $rename.'.png';
		$path = "../../../../images/staff-img/".$newname;

		$image = imagecreate(200, 200);
		$red = rand(0, 255);
		$green = rand(0, 255);
		$blue = rand(0, 255);

		imagecolorallocate($image, $red, $green, $blue);

		$textcolor = imagecolorallocate($image, 255, 255, 255);

		imagettftext($image, 80, 0, 35, 140, $textcolor, 'c:/windows/fonts/segoeui.ttf', $character);

		imagepng($image, $path);
		imagedestroy($image);

		return $newname;

	}
?>

