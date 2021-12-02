<?php

	$email = '';
	require '../../backend/auth/check_token.php';


	if(isset($_SESSION['student_token'])){

		$sql = $conn->prepare("SELECT * from `tbl_applicant_account` WHERE `session_token` = '$token'");
		$sql->execute();

		//checks if examination module is activated//
		$sql1 = $conn->prepare("SELECT * from `tbl_academic_year` WHERE `ay_status` = 1");
		$sql1->execute();
		$fetch1 = $sql1->fetch();

		//checks entry type 
		$sql2 = $conn->prepare("SELECT * from `tbl_applicant` WHERE `applicant_account_id` = $id");
		$sql2->execute();
		$fetch2 = $sql2->fetch();

		if($fetch = $sql->fetch()){

			$form1_status = $fetch['form1_progress'];
			$form2_status = $fetch['form2_progress'];

		}

		if($form2_status == 'Done'){

			echo '

			<script>

				window.location.replace("entrance_exam.php");

			</script>

			';
			
		}else if ($form1_status == 'Not Started'){

			echo '

			<script>

				alert("[MESSAGE]: Finish the previous step first!");
				window.location.replace("application_form1.php");

			</script>

			';

		}

	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>LNU SAIS | Application Form 2</title>

		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- Imports third-party CSS libraries -->

		<link rel="stylesheet" type="text/css" href="../../assets/libs/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../../assets/libs/bootstrap-select/dist/css/bootstrap-select.css">
    	<link rel="stylesheet" type="text/css" href="../../assets/libs/bootstrap-datepicker/css/bootstrap-datepicker3.css" />
		<link rel="stylesheet" type="text/css" href="../../assets/libs/font-awesome/css/all.css">

		<!-- Imports default styling -->

		<link rel="stylesheet" type="text/css" href="../../assets/css/style.css">

		<link rel="shortcut-icon" href="../../assets/images/lnu.ico" type="image/x-icon"/>
  		<link rel="icon" href="../../assets/images/lnu.ico" type="image/x-icon"/>

</head>
<body id="body">

	<nav class="navbar navbar-expand-sm student-navbar-secondary" style="z-index: 3">
		<div class="student-navbar-logo-container secondary">
			<a class="navbar-brand" href="#">
				<img src="../../assets/images/navbar_logo_mobile.png" class="secondary-logo">
			</a>
		</div>
		<div class="student-navbar-hamburger-container">
			<a href="#" id="sidebar-toggle">
				<img src="../../assets/images/navbar_burger_icon.png" class="burger-icon">
			</a>
		</div>
	</nav>

	<div class="container-fluid">

		<div class="row">
			<div class="col-md-2" style="padding: 0px;">
				<aside id="sidebar" class="sidebar">
					<div class="student-sidebar-container">
						<div class="student-sidebar-logo-container">
							<img src="../../assets/images/sidebar-logo.png" class="sidebar-logo">
						</div>
						<div class="sidebar-navigation">
							<p class="sidebar-header" style="margin-bottom: 3px;">SCHOOL YEAR</p>
								<p class="sidebar-link"><?php echo $fetch1['ay_year']?></p>
							<p class="sidebar-header">NAVIGATE</p>
							<div class="sidebar-item">
								<i class="far fa-user-circle sidebar-navigation-icon"></i> <a href="../help/my_status.php" class="sidebar-link">My Status</a>
							</div>
							<hr class="default-divider ml-auto" style="margin: 10px;">
							<div class="sidebar-item">
								<i class="far fa-comments sidebar-navigation-icon"></i> <a href="../help/send_inquiry.php" class="sidebar-link">Send Inquiry</a>
							</div>
						</div>
						<div class="sidebar-progress">
							<a class="sidebar-header" href="#" data-toggle="collapse" data-target="#collapse-progress">PROGRESS CHECKLIST <i class="fas fa-caret-down"></i></a>
							<div class="collapse show" id="collapse-progress">
								<div class="sidebar-item">
									<i class="fas fa-check-circle sidebar-progress-icon done"></i> Application Form (1/2)
								</div>
								<div class="sidebar-item active">
									<hr class="default-divider ml-auto" style="margin: 10px;">
									<i class="fas fa-arrow-circle-right sidebar-progress-icon active"></i> Application Form (2/2)
								</div>
								<div class="sidebar-item" <?php if($fetch1['enable_exam'] == 1 || $fetch2['entry'] !== 'Re-admission'){
								echo 'style="display:block"';}else{echo 'style="display:none"';}?>>
									<hr class="default-divider ml-auto" style="margin: 10px;">
									<i class="far fa-times-circle sidebar-progress-icon"></i> Entrance Examination
								</div>
								<div class="sidebar-item">
									<hr class="default-divider ml-auto" style="margin: 10px;">
									<i class="far fa-times-circle sidebar-progress-icon"></i> Interview/Evaluation
								</div>
							</div>
						</div>

					</div>
				</aside>
				<aside id="sidebar-hidden" class="sidebar-hidden">
					<div class="student-sidebar-container-hidden">
						<div class="sidebar-navigation">
							<p class="sidebar-header" style="margin-bottom: 3px;">SCHOOL YEAR</p>
								<p class="sidebar-link"><?php echo $fetch1['ay_year']?></p>
							<p class="sidebar-header">NAVIGATE</p>
							<div class="sidebar-item">
								<i class="far fa-user-circle sidebar-navigation-icon"></i> <a href="../help/my_status.php" class="sidebar-link">My Status</a>
							</div>
							<hr class="default-divider ml-auto" style="margin: 10px;">
							<div class="sidebar-item">
								<i class="far fa-comments sidebar-navigation-icon"></i> <a href="../help/send_inquiry.php" class="sidebar-link">Send Inquiry</a>
							</div>
						</div>
						<div class="sidebar-progress">
							<a class="sidebar-header" href="#" data-toggle="collapse" data-target="#collapse-progress-hidden">PROGRESS CHECKLIST <i class="fas fa-caret-down"></i></a>
							<div class="collapse show" id="collapse-progress-hidden">
								<div class="sidebar-item">
									<i class="fas fa-check-circle sidebar-progress-icon done"></i> Application Form (1/2)
								</div>
								<div class="sidebar-item active">
									<hr class="default-divider ml-auto" style="margin: 10px;">
									<i class="fas fa-arrow-circle-right sidebar-progress-icon active"></i> Application Form (2/2)
								</div>
								<div class="sidebar-item" <?php if($fetch1['enable_exam'] == 1 || $entry_type !== 'Re-admission'){
								echo 'style="display:block"';}else{echo 'style="display:none"';}?>>
									<hr class="default-divider ml-auto" style="margin: 10px;">
									<i class="far fa-times-circle sidebar-progress-icon"></i> Entrance Examination
								</div>
								<div class="sidebar-item">
									<hr class="default-divider ml-auto" style="margin: 10px;">
									<i class="far fa-times-circle sidebar-progress-icon"></i> Interview/Evaluation
								</div>
							</div>
						</div>
					</div>
				</aside>
			</div>
			<div class="col-md-10">
				<div class="student-page-container">
					<div class="student-account-container">
						<p id="datetime" class="default-datetime">0:00</p>
						<div class="student-account-details">
							<p class="student-account-details-item name"><b>Hi, <?php echo $email ?></b></p>
							<a class="student-account-details-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
						</div>
					</div>
					<div class="student-page-default" style="height: 550px; margin-bottom: 10px;">
						<p class="student-page-default-header">APPLICATION FORM 2</p>
						<p style="font-size: 12px;"><i>Note: Put NONE or N/A if not applicable.</i></p>
						<form id="myForm" method="POST" action="../../backend/admission/application_form2.php" enctype="multipart/form-data">
							<hr class="default-divider ml-auto" style="margin: 10px 0px 20px 0px;">
							<h3>Educational Background</h3>
                            <fieldset>
                            	<div class="row">
									<div class="col-md-6">
										<input type="hidden" name="id" value="<?php echo $fetch['id'] ?>">
										<input type="hidden" name="entry" value="<?php echo $fetch2['entry'] ?>">
										<!-- Kindergarten -->
										<p class="student-page-label">Kindergarten</p>
										<div class="form-group form-float" style="margin-bottom: 15px;">
				                        	<div class="form-line">
				                            	<input type="text" name="tbKinderSchoolName" id="tbKinderSchoolName" class="form-control"/>
				                            	<label class="form-label">School Name </label>
				                       		</div>
				                    	</div>
				                    	<div class="form-group form-float" style="margin-bottom: 15px;">
				                        	<div class="form-line">
				                            	<input type="text" name="tbKinderSchoolAddress" id="tbKinderSchoolAddress" class="form-control"/>
				                            	<label class="form-label">School Address </label>
				                       		</div>
				                    	</div>
				                    	<div class="form-group form-float" style="margin-bottom: 15px;">
				                        	<div class="form-line">
				                            	<input type="text" name="tbKinderYearGraduated" id="tbKinderYearGraduated" class="form-control"/>
				                            	<label class="form-label">Year Graduated </label>
				                       		</div>
				                    	</div>
				                    	<div class="form-group form-float" style="margin-bottom: 15px;">
				                        	<div class="form-line">
				                            	<input type="text" name="tbKinderHonorsReceived" id="tbKinderHonorsReceived" class="form-control"/>
				                            	<label class="form-label">Honors Received (if any)</label>
				                       		</div>
				                    	</div>
				                    	<!-- Elementary -->
				                    	<p class="student-page-label">Elementary</p>
										<div class="form-group form-float" style="margin-bottom: 15px;">
				                        	<div class="form-line">
				                            	<input type="text" name="tbElementarySchoolName" id="tbElementarySchoolName" class="form-control" required/>
				                            	<label class="form-label">School Name *</label>
				                       		</div>
				                    	</div>
				                    	<div class="form-group form-float" style="margin-bottom: 15px;">
				                        	<div class="form-line">
				                            	<input type="text" name="tbElementarySchoolAddress" id="tbElementarySchoolAddress" class="form-control" required/>
				                            	<label class="form-label">School Address *</label>
				                       		</div>
				                    	</div>
				                    	<div class="form-group form-float" style="margin-bottom: 15px;">
				                        	<div class="form-line">
				                            	<input type="text" name="tbElementaryYearGraduated" id="tbElementaryYearGraduated" class="form-control" required/>
				                            	<label class="form-label">Year Graduated *</label>
				                       		</div>
				                    	</div>
				                    	<div class="form-group form-float" style="margin-bottom: 15px;">
				                        	<div class="form-line">
				                            	<input type="text" name="tbElementaryHonorsReceived" id="tbElementaryHonorsReceived" class="form-control"/>
				                            	<label class="form-label">Honors Received (if any)</label>
				                       		</div>
				                    	</div>
				                    	<!-- Junior Highschool -->
				                    	<p class="student-page-label">Junior High School</p>
										<div class="form-group form-float" style="margin-bottom: 15px;">
				                        	<div class="form-line">
				                            	<input type="text" name="tbJHSSchoolName" id="tbJHSSchoolName" class="form-control" required/>
				                            	<label class="form-label">School Name *</label>
				                       		</div>
				                    	</div>
				                    	<div class="form-group form-float" style="margin-bottom: 15px;">
				                        	<div class="form-line">
				                            	<input type="text" name="tbJHSSchoolAddress" id="tbJHSSchoolAddress" class="form-control" required/>
				                            	<label class="form-label">School Address *</label>
				                       		</div>
				                    	</div>
				                    	<div class="form-group form-float" style="margin-bottom: 15px;">
				                        	<div class="form-line">
				                            	<input type="text" name="tbJHSYearGraduated" id="tbJHSYearGraduated" class="form-control" required/>
				                            	<label class="form-label">Year Graduated *</label>
				                       		</div>
				                    	</div>
				                    	<div class="form-group form-float" style="margin-bottom: 15px;">
				                        	<div class="form-line">
				                            	<input type="text" name="tbJHSHonorsReceived" id="tbJHSHonorsReceived" class="form-control"/>
				                            	<label class="form-label">Honors Received (if any)</label>
				                       		</div>
				                    	</div>
									</div>
									<div class="col-md-6">
										<!-- Senior Highschool -->
				                    	<p class="student-page-label">Senior High School</p>
										<div class="form-group form-float" style="margin-bottom: 15px;">
				                        	<div class="form-line">
				                            	<input type="text" name="tbSHSSchoolName" id="tbSHSSchoolName" class="form-control" required/>
				                            	<label class="form-label">School Name *</label>
				                       		</div>
				                    	</div>
				                    	<div class="form-group form-float" style="margin-bottom: 15px;">
				                        	<div class="form-line">
				                            	<input type="text" name="tbSHSSchoolAddress" id="tbSHSSchoolAddress" class="form-control" required/>
				                            	<label class="form-label">School Address *</label>
				                       		</div>
				                    	</div>
				                    	<div class="form-group form-float" style="margin-bottom: 15px;">
				                        	<div class="form-line">
								                <select class="form-control" name="cbSHSStrand" id="cbSHSStrand" required>
			                                     	<option value="" disabled selected>Senior Highschool Strand *</option>
				                                    <option value="Science, Technology, Engineering and Mathematics (STEM)">Science, Technology, Engineering and Mathematics (STEM)</option>
				                                    <option value="Accountancy and Business Management (ABM)">Accountancy and Business Management (ABM)</option>
				                                    <option value="Humanities and Social Sciences (HUMSS)">Humanities and Social Sciences (HUMSS)</option>
				                                    <option value="General Academics Strand (GAS)">General Academics Strand (GAS)</option>
				                                    <option value="Information and Communications Technology (Tech-Voc ICT)">Information and Communications Technology (Tech-Voc ICT)</option>
				                                    <option value=">Home Economics (Tech-Voc HE)">Home Economics (Tech-Voc HE)</option>
				                                    <option value="Others">Others (please specify)</option>
			                                    </select>	
		                                    </div>
				                    	</div>
				                    	<div class="form-group form-float" id="tbSHSStrand" style="margin-bottom: 15px; display: none;">
				                        	<div class="form-line">
				                            	<input type="text" name="tbSHSStrand" class="form-control"/>
				                            	<label class="form-label">Specify Senior High School Strand *</label>
				                       		</div>
				                    	</div>
				                    	<div class="form-group form-float" style="margin-bottom: 15px;">
				                        	<div class="form-line">
				                            	<input type="text" name="tbSHSYearGraduated" id="tbSHSYearGraduated" class="form-control" required/>
				                            	<label class="form-label">Year Graduated *</label>
				                       		</div>
				                    	</div>
				                    	<div class="form-group form-float" style="margin-bottom: 15px;">
				                        	<div class="form-line">
				                            	<input type="text" name="tbSHSHonorsReceived" id="tbSHSHonorsReceived" class="form-control"/>
				                            	<label class="form-label">Honors Received (if any)</label>
				                       		</div>
				                    	</div>
				                    	<!-- College -->
				                    	<div id="college" <?php if($fetch2['entry'] == 'Transferee')
				                    	{echo 'style="display: block"';}else{echo 'style="display: none"';}?>>
				                    		<p class="student-page-label">College 1 (for Transferees only)</p>
											<div class="form-group form-float" style="margin-bottom: 15px;">
					                        	<div class="form-line">
					                            	<input type="text" name="tbCollegeSchoolName1" id="tbCollegeSchoolName1" class="form-control" />
					                            	<label class="form-label">School Name</label>
					                       		</div>
					                    	</div>
					                    	<div class="form-group form-float" style="margin-bottom: 15px;">
					                        	<div class="form-line">
					                            	<input type="text" name="tbCollegeSchoolAddress1" id="tbCollegeSchoolAddress1" class="form-control" />
					                            	<label class="form-label">School Address</label>
					                       		</div>
					                    	</div>
					                    	<div class="form-group form-float" style="margin-bottom: 15px;">
					                        	<div class="form-line">
					                            	<input type="text" name="tbCollegeYearGraduated1" id="tbCollegeYearGraduated1" class="form-control" />
					                            	<label class="form-label">Year Graduated</label>
					                       		</div>
					                    	</div>
					                    	<div class="form-group form-float" style="margin-bottom: 15px;">
					                        	<div class="form-line">
					                            	<input type="text" name="tbCollegeHonorsReceived1" id="tbCollegeHonorsReceived1" class="form-control"/>
					                            	<label class="form-label">Honors Received</label>
					                       		</div>
					                    	</div>
					                    	<p class="student-page-label">College 2 (for Transferees only)</p>
					                    	<div class="form-group form-float" style="margin-bottom: 15px;">
					                        	<div class="form-line">
					                            	<input type="text" name="tbCollegeSchoolName2" id="tbCollegeSchoolName2" class="form-control" />
					                            	<label class="form-label">School Name</label>
					                       		</div>
					                    	</div>
					                    	<div class="form-group form-float" style="margin-bottom: 15px;">
					                        	<div class="form-line">
					                            	<input type="text" name="tbCollegeSchoolAddress2" id="tbCollegeSchoolAddress2" class="form-control" />
					                            	<label class="form-label">School Address</label>
					                       		</div>
					                    	</div>
					                    	<div class="form-group form-float" style="margin-bottom: 15px;">
					                        	<div class="form-line">
					                            	<input type="text" name="tbCollegeYearGraduated2" id="tbCollegeYearGraduated2" class="form-control" />
					                            	<label class="form-label">Year Graduated</label>
					                       		</div>
					                    	</div>
					                    	<div class="form-group form-float" style="margin-bottom: 15px;">
					                        	<div class="form-line">
					                            	<input type="text" name="tbCollegeHonorsReceived2" id="tbCollegeHonorsReceived2" class="form-control"/>
					                            	<label class="form-label">Honors Received</label>
					                       		</div>
					                    	</div>
				                    	</div>

				                    	<!-- Upload File -->
				                    	<div style="height: auto; width: 100%; padding: 10px; border-radius: 5px; background-color: #F2F2F2;">
				                    		<p class="student-page-label">Please upload a scanned copy/clear photo of your <?php if($fetch2['entry'] == 'Freshmen'){echo 'Grade 12 Report Card (back-to-back)';}else if($fetch2['entry'] == 'Transferee'){echo 'Transcript of Records (TOR)';}else if($fetch2['entry'] == 'Re-admission'){echo 'Approved Leave of Absence (LOA)';} ?></p>
				                    		<p style="font-size: 12px"><i>Note: See to it that your name is visible in the photo/s of the report card/TOR/LOA.</i></p>
											<div class="form-group form-float" style="margin-bottom: 15px;">
				                        		<input class="student-page-upload" name="cardImages[]" type="file" accept="image/jpeg, image/jpg, image/png" multiple required>
				                    		</div>
				                    	</div>
									</div>
								</div>
							</fieldset>
							<h3>Other Relevant Information</h3>
							<fieldset>
								<div class="row">
									<div class="col-md-6">
										<p class="student-page-label">Character References</p>
										<div class="form-group form-float" style="margin-bottom: 15px;">
					                       	<div class="form-line">
					                           	<input type="text" name="tbReferenceName1" id="tbReferenceName1" class="form-control" required/>
					                           	<label class="form-label">Name (Reference 1) *</label>
					                       	</div>
					                    </div>
					                    <div class="form-group form-float" style="margin-bottom: 15px;">
					                       	<div class="form-line">
					                           	<input type="text" name="tbReferenceAddress1" id="tbReferenceAddress1" class="form-control" required/>
					                           	<label class="form-label">Address (Reference 1) *</label>
					                       	</div>
					                    </div>
					                    <div class="form-group form-float" style="margin-bottom: 15px;">
					                       	<div class="form-line">
					                           	<input type="text" name="tbReferenceContact1" id="tbReferenceContact1" class="form-control" required/>
					                           	<label class="form-label">Contact Number (Reference 1) *</label>
					                       	</div>
					                    </div>
					                    <div class="form-group form-float" style="margin-bottom: 15px;">
					                       	<div class="form-line">
					                           	<input type="text" name="tbReferenceName2" id="tbReferenceName2" class="form-control" required/>
					                           	<label class="form-label">Name (Reference 2) *</label>
					                       	</div>
					                    </div>
					                    <div class="form-group form-float" style="margin-bottom: 15px;">
					                       	<div class="form-line">
					                           	<input type="text" name="tbReferenceAddress2" id="tbReferenceAddress2" class="form-control" required/>
					                           	<label class="form-label">Address (Reference 2) *</label>
					                       	</div>
					                    </div>
					                    <div class="form-group form-float" style="margin-bottom: 15px;">
					                       	<div class="form-line">
					                           	<input type="text" name="tbReferenceContact2" id="tbReferenceContact2" class="form-control" required/>
					                           	<label class="form-label">Contact Number (Reference 2) *</label>
					                       	</div>
					                    </div>
					                    <p class="student-page-label">Do you have previous application at Leyte Normal University? *</p>
										<div class="form-group form-float" style="margin-bottom: 15px;">
					                       	<input type="radio" name="rbPreviousApplication" id="rbPreviousApplicationYes" value="Yes" required/>
		                                	<label for="rbPreviousApplicationYes">Yes</label>
		                                	<br>
		                                	<input type="radio" name="rbPreviousApplication" id="rbPreviousApplicationNo" value="No" />
		                                	<label for="rbPreviousApplicationNo">No</label>
					                    </div>
					                    <div class="form-group form-float" id="academicYearField" style="margin-bottom: 15px; display: none;">
					                       	<div class="form-line">
					                           	<input type="text" name="tbPreviousApplicationYear" id="tbPreviousApplicationYear" class="form-control" />
					                           	<label class="form-label">If yes, kindly indicate the Academic Year</label>
					                       	</div>
					                    </div>
					                    <p class="student-page-label">What are your hobbies, talents, and interests *</p>
										<div class="form-group form-float" style="margin-bottom: 15px;">
					                       	<div class="form-line">
					                           	<input type="text" name="tbHobbies" id="tbHobbies" class="form-control" required/>
					                           	<label class="form-label">e.g. Singing, Dancing, Writing</label>
					                       	</div>
					                    </div>
					                    <p class="student-page-label">Are you a member of any club or organization in your high school? *</p>
										<div class="form-group form-float" style="margin-bottom: 15px;">
					                       	<input type="radio" name="rbClubMember" id="rbClubMemberYes" value="Yes" required/>
		                                	<label for="rbClubMemberYes">Yes</label>
		                                	<br>
		                                	<input type="radio" name="rbClubMember" id="rbClubMemberNo" value="No" />
		                                	<label for="rbClubMemberNo">No</label>
					                    </div>
					                    <div class="form-group form-float" id="clubField" style="margin-bottom: 25px; display: none;">
					                       	<div class="form-line">
					                           	<input type="text" name="tbClubName" id="tbClubName" class="form-control" />
					                           	<label class="form-label">If yes, kindly indicate the name/s of the organization or club</label>
					                       	</div>
					                    </div>
									</div>
									<div class="col-md-6">
										<p class="student-page-label">Do you have any PHYSICAL DISABILITY and/or CONDITION that requires additional support,
					                	special attention or that should be taken into consideration in planning your academic activities</p>
										<div class="form-group form-float" style="margin-bottom: 15px;">
					                       	<input type="radio" name="rbPhysicalCondition" id="rbPhysicalConditionYes" value="Yes"/>
		                                	<label for="rbPhysicalConditionYes">Yes</label>
		                                	<br>
		                                	<input type="radio" name="rbPhysicalCondition" id="rbPhysicalConditionNo" value="No" />
		                                	<label for="rbPhysicalConditionNo">No</label>
					                    </div>
					                    <div class="form-group form-float" id="disabilityField" style="margin-bottom: 15px; display: none;">
					                       	<div class="form-line">
					                           	<input type="text" name="tbPhysicalConditionSpecify" id="tbPhysicalConditionSpecify" class="form-control" />
					                           	<label class="form-label">If yes, please specify</label>
					                       	</div>
					                    </div>

					                    <!-- Upload File -->

				                    	<div style="height: auto; width: 100%; padding: 10px; border-radius: 5px; background-color: #F2F2F2; display: none;" id="disabilityFile">
				                    		<p class="student-page-label">If necessary, please attach medical certificate and/or psycho-educational
				                    		assessment report</p>
											<div class="form-group form-float" style="margin-bottom: 15px;">
				                        		<input class="student-page-upload" id="medicalImage" name="medicalImages[]" type="file" multiple>
				                    		</div>
				                    	</div>
				                    	<br>
				                    	<p class="student-page-label">Personal Statement *</p>
				                    	<p style="font-size: 12px"><i>Explain your purpose in seeking admission to the University and the goals which
				                    	you want to achieve.</i></p>
				                    	<div class="form-group form-float" style="margin-bottom: 15px;">
					                       	<div class="form-line">
		                                        <textarea rows="7" name="tbStatement" id="tbStatement" class="form-control no-resize" placeholder="Type your answer..." required></textarea>
		                                    </div>
					                    </div>

					                    <div class="alert alert-primary">
					                    	<p style="text-align: justify; font-size: 13px;">I understand that my application for admission is subject for approval
					                    	of the Admission Committee of the University. I certify that the information given is true and correct. Falsifying
					                    	any of the information is sufficient ground for any legal action and rejection relative to my application. In addition, I understand that LNU has no obligation to provide me with reasons in case this application will be denied.</p>
					                    </div>
									</div>
								</div>
							</fieldset>


							<div class="modal fade" id="nextModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						    	<div class="modal-dialog" role="document">
						      		<div class="modal-content">
						       			<div class="modal-header">
						       			  <p class="modal-header-text">Submit Application Form?</p>
						       			  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
						       			    <span aria-hidden="true">×</span>
						       			  </button>
						       			</div>
						       			<div class="modal-body">
						       				<p style="text-align: justify; font-size: 14px;">By submitting, all the information that you entered on this page will be saved to the database.</p>
						       				<p style="text-align: justify; font-size: 14px;"><b>Please review everything first before proceeding.</b></p>
						      			</div>
						      			<div class="modal-footer" style="padding: 10px;">
						       			  <button type="submit" name="btnSubmit" class="default-button" 
						       			  style="padding: 5px 10px 5px 10px; position: relative;" onclick="clearCache();">Confirm</button>
						       			</div>
						    		</div>
						  		</div>
	  						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    	<div class="modal-dialog" role="document">
      		<div class="modal-content">
       			<div class="modal-header">
       			  <p class="modal-header-text">Confirm Logout?</p>
       			  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
       			    <span aria-hidden="true">×</span>
       			  </button>
       			</div>
       			<div class="modal-body">
       				<p>Are you sure you want to logout?</p>
      			</div>
      			<div class="modal-footer" style="padding: 10px;">
       			  <a class="default-button" href="../../backend/auth/student_logout.php" style="padding: 5px 10px 5px 10px; position: relative;">Confirm</a>
       			</div>
    		</div>
  		</div>
  	</div>

	<footer class="footer-subfooter" style="bottom: 0;">
		<p class="subfooter-text">
			All Rights Reserved - Leyte Normal University | Maintained by MIS Office
		</p>
	</footer>

	<script src="../../assets/libs/jquery/jquery.min.js"></script>
	<script src="../../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="../../assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script src="../../assets/libs/jquery-slimscroll/jquery.slimscroll.js"></script>
    <script src="../../assets/libs/node-waves/waves.js"></script>
    <script src="../../assets/js/template/admin.js"></script>
    <script src="../../../plugins/jquery-validation/jquery.validate.js"></script>
    <script src="../../../js/pages/forms/form-wizard.js"></script>
    <script src="../../../plugins/jquery-steps/jquery.steps.js"></script>
    <script src="../../assets/js/template/demo.js"></script>

	<!-- Additional JS codes -->

	<script src="../../../js/formcache.js"></script>

	<script>

		var toggleClicks = 0;

		$(document).ready(function () {
        	showDateTime();
        	$('#myForm').formcache({
        		local: false,
        		session: true,
        		maxAge: 300000
        	});

        	var previousApplication = $("input[name='rbPreviousApplication']:checked").val();
	        var clubMember = $("input[name='rbClubMember']:checked").val();
	        var physicalDisability = $("input[name='rbPhysicalCondition']:checked").val();
	        if(previousApplication == 'Yes'){
	        	$("#academicYearField").css('display', 'block');
	        	$("#tbPreviousApplicationYear").prop('required', true);
	        }else{
	        	$("#academicYearField").css('display', 'none');
	        	$("#tbPreviousApplicationYear").prop('required', false);
	        }
	        if(clubMember == 'Yes'){
	        	$("#clubField").css('display', 'block');
	        	$("#tbClubName").prop('required', true);
	        }else{
	        	$("#clubField").css('display', 'none');
	        	$("#tbClubName").prop('required', false);
	        }
	        if(physicalDisability == 'Yes'){
	        	$("#disabilityField").css('display', 'block');
	        	$("#disabilityFile").css('display', 'block');
	        	$("#tbPhysicalConditionSpecify").prop('required', true);
	        }else{
	        	$("#disabilityField").css('display', 'none');
	        	$("#disabilityFile").css('display', 'none');
	        	$("#tbPhysicalConditionSpecify").prop('required', false);
	        }

        	$("input[type='radio']").click(function(){
	        	var previousApplication = $("input[name='rbPreviousApplication']:checked").val();
	        	var clubMember = $("input[name='rbClubMember']:checked").val();
	        	var physicalDisability = $("input[name='rbPhysicalCondition']:checked").val();
	        	if(previousApplication == 'Yes'){
	        		$("#academicYearField").css('display', 'block');
	        		$("#tbPreviousApplicationYear").prop('required', true);
	        	}else{
	        		$("#academicYearField").css('display', 'none');
	        		$("#tbPreviousApplicationYear").prop('required', false);
	        	}
	        	if(clubMember == 'Yes'){
	        		$("#clubField").css('display', 'block');
	        		$("#tbClubName").prop('required', true);
	        	}else{
	        		$("#clubField").css('display', 'none');
	        		$("#tbClubName").prop('required', false);
	        	}
	        	if(physicalDisability == 'Yes'){
	        		$("#disabilityField").css('display', 'block');
	        		$("#disabilityFile").css('display', 'block');
	        		$("#tbPhysicalConditionSpecify").prop('required', true);
	        	}else{
	        		$("#disabilityField").css('display', 'none');
	        		$("#disabilityFile").css('display', 'none');
	        		$("#tbPhysicalConditionSpecify").prop('required', false);
	        	}
	        });

        	$.AdminBSB.input.activate();
    	});

		$('#sidebar-toggle').click(function () {

			toggleClicks++;

			if(toggleClicks %2 == 0){
				closeSidebar();
			}else{
				openSidebar();
			}

    	});


		function openSidebar(){

			document.getElementById("sidebar-hidden").style.width = "300px";
			document.getElementById("body").style.overflowY = "hidden";

		}

		function closeSidebar(){

			document.getElementById("sidebar-hidden").style.width = "0px";
			document.getElementById("body").style.overflowY = "auto";

		}

		function showDateTime(){

  			var dt = new Date();

  			document.getElementById("datetime").innerHTML = (("0"+(dt.getMonth()+1)).slice(-2)) + "/" + (("0"+dt.getDate()).slice(-2)) + "/" + (dt.getFullYear()) + " | " + (("0" + dt.getHours()).slice(-2)) + ":" + (("0" + dt.getMinutes()).slice(-2)) + ":" + (("0" + dt.getSeconds()).slice(-2));

  			setTimeout("showDateTime()", 1000);

  		}

  		var previewImage = function(event){
            var output = document.getElementById("preview");
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function(){
                URL.revokeObjectURL(output.src)
            }
        }

        //auto logout on idle script//

		var maxIdle = 25; //log the user out after 25 minutes of inactivity
		var idleTime = 0;

		var idleInterval = setInterval("incrementTimer()", 60000);
		$("body").mousemove(function(event){
			idleTime = 0;
		})

		//increment idle time every minute

		function incrementTimer(){
			idleTime = idleTime + 1;
			if(idleTime > maxIdle){
				alert("[WARNING]: You've been logged-out due to inactivity. Please login again");
				window.location = "../../backend/auth/student_logout.php" ;
			}
		}

		//clear cache

		function clearCache(){
			$('#myForm').removeCaches();
		}


	</script>

</body>
</html>