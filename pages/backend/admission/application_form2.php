<head>

    <link rel="stylesheet" type="text/css" href="../../assets/libs/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/style.css">

    <script src="../../assets/libs/jquery/jquery.min.js"></script>
    <script src="../../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/libs/sweetalert/sweetalert2.all.min.js"></script>

</head>

<?php

    date_default_timezone_set("Asia/Taipei");

    require '../config/db_pdo.php';
    require '../config/db_mysqli.php';


    if(ISSET($_POST['btnSubmit'])){

        try{
            /* UPDATE to the database */
            $applicant_account_id = $_POST['id'];

            $sql = $conn->prepare("SELECT * FROM `tbl_applicant` WHERE `applicant_account_id` = $applicant_account_id");
            $sql->execute();
            $fetchApplicant = $sql->fetch();

        //Pathinfo for CARD IMAGES + Save Filename to Database
        foreach ($_FILES['cardImages']['name'] as $key => $cardname){
		    $cardrename = 'IMG_CARD'.time().'_'.$fetchApplicant['last_name'].'_'.$fetchApplicant['first_name'];
            $cardFilename = $cardrename . "_" . $cardname;
            move_uploaded_file($_FILES['cardImages']['tmp_name'][$key], '../../../images/applicant-img/applicant-card/' . $cardFilename);
            $sqlCard = "INSERT INTO `tbl_applicant_card`(`card_applicant_id`, `card_image`) VALUES ('$applicant_account_id','$cardFilename')";
            $conn->exec($sqlCard);
        }
        //Pathinfo for MEDICAL IMAGES + Save Filename to Database
        foreach ($_FILES['medicalImages']['name'] as $key => $medicalname){
		    $medicalrename = 'IMG_MED'.time().'_'.$fetchApplicant['last_name'].'_'.$fetchApplicant['first_name'];
            $medicalFilename = $medicalrename . "_" . $medicalname;
            move_uploaded_file($_FILES['medicalImages']['tmp_name'][$key], '../../../images/applicant-img/applicant-medical/' . $medicalFilename);
            $sqlMedical = "INSERT INTO `tbl_applicant_medical`(`medical_applicant_id`, `medical_image`) VALUES ('$applicant_account_id','$medicalFilename')";
            $conn->exec($sqlMedical);

        }

        ## Kinder
        $kinderSchoolName = $_POST['tbKinderSchoolName'];
        $kinderSchoolAddress = $_POST['tbKinderSchoolAddress'];
        $kinderYearGraduated = $_POST['tbKinderYearGraduated'];
        $kinderHonorsReceived = $_POST['tbKinderHonorsReceived'];
        ## Elementary
        $elementarySchoolName = $_POST['tbElementarySchoolName'];
        $elementarySchoolAddress = $_POST['tbElementarySchoolAddress'];
        $elementaryYearGraduated = $_POST['tbElementaryYearGraduated'];
        $elementaryHonorsReceived = $_POST['tbElementaryHonorsReceived'];
        ## JHS
        $JHSSchoolName = $_POST['tbJHSSchoolName'];
        $JHSSchoolAddress = $_POST['tbJHSSchoolAddress'];
        $JHSYearGraduated = $_POST['tbJHSYearGraduated'];
        $JHSHonorsReceived = $_POST['tbJHSHonorsReceived'];
        # SHS
        $SHSSchoolName = $_POST['tbSHSSchoolName'];
        $SHSSchoolAddress = $_POST['tbSHSSchoolAddress'];
        $SHSStrand = $_POST['cbSHSStrand'];

        if($SHSStrand == 'Others'){
            $SHSStrand = $_POST['tbSHSStrand'];
        }else{
            $SHSStrand = $_POST['cbSHSStrand'];
        }

        $SHSYearGraduated = $_POST['tbSHSYearGraduated'];
        $SHSHonorsReceived = $_POST['tbSHSHonorsReceived'];

        # Entry

        $entry = $_POST['entry'];

        if($entry == 'Transferee'){
            # College 1 [--TRANSFEREES--]
            $collegeSchoolName1 = $_POST['tbCollegeSchoolName1'];
            $collegeSchoolAddress1 = $_POST['tbCollegeSchoolAddress1'];
            $collegeYearGraduated1 = $_POST['tbCollegeYearGraduated1'];
            $collegeHonorsReceived1 = $_POST['tbCollegeHonorsReceived1'];
            # College 2 [--TRANSFEREES--]
            $collegeSchoolName2 = $_POST['tbCollegeSchoolName2'];
            $collegeSchoolAddress2 = $_POST['tbCollegeSchoolAddress2'];
            $collegeYearGraduated2 = $_POST['tbCollegeYearGraduated2'];
            $collegeHonorsReceived2 = $_POST['tbCollegeHonorsReceived2'];
        }else{
            # College 1 [--TRANSFEREES--]
            $collegeSchoolName1 = "N/A";
            $collegeSchoolAddress1 = "N/A";
            $collegeYearGraduated1 = "N/A";
            $collegeHonorsReceived1 = "N/A";
            # College 2 [--TRANSFEREES--]
            $collegeSchoolName2 = "N/A";
            $collegeSchoolAddress2 = "N/A";
            $collegeYearGraduated2 = "N/A";
            $collegeHonorsReceived2 = "N/A";
        }

        ## Character Reference 1
        $referenceName1 = $_POST['tbReferenceName1'];
        $referenceAddress1 = $_POST['tbReferenceAddress1'];
        $referenceContact1 = $_POST['tbReferenceContact1'];
        ## Character Reference 2
        $referenceName2 = $_POST['tbReferenceName2'];
        $referenceAddress2 = $_POST['tbReferenceAddress2'];
        $referenceContact2 = $_POST['tbReferenceContact2'];
        ## Previous Applications
        $previousApplication = $_POST['rbPreviousApplication'];

        if($previousApplication == 'Yes'){
            $previousApplicationYear = $_POST['tbPreviousApplicationYear'];
        }else{
            $previousApplicationYear = 'N/A';
        }

        ## Hobbies
        $hobbies = $_POST['tbHobbies'];

        ## Club Member
        $clubMember = $_POST['rbClubMember'];

        if($clubMember == 'Yes'){
            $clubName = $_POST['tbClubName'];
        }else{
            $clubName = 'N/A';
        }

        ## Physical Condition
        $physicalCondition = $_POST['rbPhysicalCondition'];

        if($physicalCondition == 'Yes'){
            $physicalConditionSpecify = $_POST['tbPhysicalConditionSpecify'];
        }else{
            $physicalConditionSpecify = 'N/A';
        }

        ## Personal Statement
        $statement = $_POST['tbStatement'];

        $timestamp = date("F j, Y, h:i:s A");

        $sql = "UPDATE `tbl_applicant` SET `kinder_name`='$kinderSchoolName',
        `kinder_address`= '$kinderSchoolAddress',`kinder_year_graduated`='$kinderYearGraduated',
        `kinder_honors`='$kinderHonorsReceived',`elem_name`='$elementarySchoolName',
        `elem_address`='$elementarySchoolAddress',`elem_year_graduated`='$elementaryYearGraduated',
        `elem_honors`='$elementaryHonorsReceived',`jhs_name`='$JHSSchoolName',
        `jhs_address`='$JHSSchoolAddress',`jhs_year_graduated`='$JHSYearGraduated',
        `jhs_honors`='$JHSHonorsReceived',`shs_name`='$SHSSchoolName',
        `shs_address`='$SHSSchoolAddress',`shs_strand` = '$SHSStrand', `shs_year_graduated`='$SHSYearGraduated',
        `shs_honors`='$SHSHonorsReceived',`college_name`='$collegeSchoolName1',
        `college_address`='$collegeSchoolAddress1',`college_year_graduated`='$collegeYearGraduated1',
        `college_honors`='$collegeHonorsReceived1',`college_name2`='$collegeSchoolName2',
        `college_address2`='$collegeSchoolAddress2',`college_year_graduated2`='$collegeYearGraduated2',
        `college_honors2`='$collegeHonorsReceived2', `reference_name`='$referenceName1',
        `reference_address`='$referenceAddress1',`reference_contact`='$referenceContact1',
        `reference_name2`='$referenceName2',`reference_address2`='$referenceAddress2',
        `reference_contact2`='$referenceContact2',`previous_application`='$previousApplication',
        `previous_academic_year`='$previousApplicationYear',`hobbies`='$hobbies',
        `club_member`='$clubMember',`club_name`='$clubName',`disability`='$physicalCondition',
        `disability_name`='$physicalConditionSpecify',`personal_statement`='$statement'
        WHERE `applicant_account_id` = '$applicant_account_id'";
        $conn->exec($sql);

        $sql2 = "UPDATE `tbl_applicant_account` SET `form2_progress` = 'Done', `fp_timestamp` = '$timestamp' WHERE `id` = '$applicant_account_id'";
        $conn->exec($sql2);

        success();

        }catch(exception $e){

            echo $e->getMessage();
            error();

        }

    }

    function success(){

        echo '
        <script>

            $(document).ready(function(){

                Swal.fire({

                    icon: "success",
                    title: "Application form submitted successfully!",
                    showConfirmButton: false,
                    timer: 2000

                }).then(function(){

                    window.location.replace("../../student/admission_procedures/entrance_exam.php");

                });

            });

        </script>

        ';

    }

    function error(){

        echo '
        <script>

            $(document).ready(function(){

                Swal.fire({

                    icon: "error",
                    title: "'.$e->getMessage().'",
                    showConfirmButton: false,
                    timer: 2000

                }).then(function(){

                     window.location.replace("../../student/admission_procedures/application_form2.php");

                });

            });

        </script>

        ';

    }

?>