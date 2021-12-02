<head>

    <link rel="stylesheet" type="text/css" href="../../assets/libs/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/style.css">

    <script src="../../assets/libs/jquery/jquery.min.js"></script>
    <script src="../../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/libs/sweetalert/sweetalert2.all.min.js"></script>

</head>

<?php

require '../config/db_mysqli.php';
require '../config/db_pdo.php';
require '../../assets/libs/PHPMailer/src/PHPMailer.php';
require '../../assets/libs/PHPMailer/src/SMTP.php'; 
require '../../assets/libs/PHPMailer/src/Exception.php'; 

if(isset($_POST['btnRegister'])){

    //Get form Data

    $last_name = $_POST['tbFamilyName'];
    $first_name = $_POST['tbFirstName'];
    $middle_name = $_POST['tbMiddleName'];
    $birthday = $_POST['dpBirthday'];
    $age = $_POST['tbAge'];
    $gender = $_POST['cbGender'];
    $entry = $_POST['cbEntryStatus'];
    $email = $_POST['tbEmail'];
    $password = $_POST['tbPassword'];
    $securityQuestion = $_POST['cbQuestion'];
    $securityAnswer = $_POST['tbAnswer'];
    $form1 = "Not Started";
    $form2 = "Not Started";
    $form_timestamp = "N/A";
    $exam = "Not Started";
    $exam_timestamp = "N/A";
    $interview = "Not Started";
    $interview_timestamp = "N/A";
    $admission = "pending";
    $admission_timestamp = "N/A";
    $studentNumber = "N/A";
    $loginStatus = "Logged-out";

    //Sanitize account credentials data

    $email = $connection->real_escape_string($email);
    $password = $connection->real_escape_string($password);
    $password = password_hash($password, PASSWORD_DEFAULT);
    $securityQuestion = $connection->real_escape_string($securityQuestion);
    $securityAnswer = $connection->real_escape_string($securityAnswer);

    //Generate verification key

    $vkey = md5(time().$email);
    $verified = 0;
    
    if($entry == 'Re-admission'){
        $readmissionVerified = 0;
    }else{
        $readmissionVerified = 1;
    }

    $query="INSERT INTO tbl_applicant_account(`email`, `password`, `verification_key`, `verified`, `readmission_verified`, `security_question`, `security_answer`, `form1_progress`, `form2_progress`, `fp_timestamp`, `examination_progress`, `ep_timestamp`, `interview_progress`, `ip_timestamp`, `student_number`, `login_status`) VALUES('$email', '$password', '$vkey', '$verified', '$readmissionVerified', '$securityQuestion', '$securityAnswer', '$form1', '$form2', '$form_timestamp', '$exam', '$exam_timestamp', '$interview', '$interview_timestamp', '$studentNumber', '$loginStatus')";
    $query_run = mysqli_query($connection, $query); 

    //Insert applicant_account_id to tbl_applicant

    $sql = $conn->prepare("SELECT * FROM `tbl_applicant_account` ORDER BY `id` DESC LIMIT 1");
    $sql->execute();
    $fetch = $sql->fetch();
                                            
    $applicant_account_id = $fetch['id'];
    
    $query2="INSERT INTO tbl_applicant(`applicant_account_id`, `entry`, `first_name`, `middle_name`, `last_name`, `date_birth`, `age`, `gender`)
    VALUES ('$applicant_account_id', '$entry', '$first_name', '$middle_name', '$last_name', '$birthday', '$age', '$gender')";
    $query2_run = mysqli_query($connection, $query2);

    //checks if entrance exam is enabled

    //$sql3 = "SELECT FROM `tbl_academic_year` WHERE `ay_status` = 1";
    //$conn->exec($sql3);
    //$fetch = $sql3->fetch();

    //if($fetch['enable_exam'] = 1){

    //    $query3 = "INSERT INTO tbl_exam_result(`applicant`) VALUES ()";
    //    $conn->exec($sql2);

    //} 

    if($query_run && $query2_run){
        sleep(1);

        //Initialize PHPMailer

        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls";
        $mail->Port = "587";
        $mail->Username = "1800638@lnu.edu.ph";
        $mail->Password = "llrcxiwvmbbjmmza";
        $mail->setFrom("lnu.admissionsoffice@lnu.edu.ph");

        //Initialize email body

        $mail->isHTML(true);
        $mail->From = "lnu.admissionsoffice@lnu.edu.ph";
        $mail->FromName = "<no-reply@mailersais>";
        $mail->addAddress($email);
        $mail->addEmbeddedImage('../../assets/images/logo.png', 'lnu_logo');
        
        if($entry == 'Re-admission'){

            //Mail body for returnee applicants

            $mail->Subject = "Account Registration for Re-admission Students";
            $mail->Body = "

            <div class='email-body' style=' height: auto; width: auto; background-color: #F2F2F2;'>
                <div class='email-logo-container' align='center' style='height: auto; width: auto; padding: 15px;
                background-color: #FFFFFF;'>
                    <img src='cid:lnu_logo' class='email-header-logo' alt='lnu-logo' style='height: auto;
                    width: 250px;'>
                </div>
                <div class='row' style='margin: 0px;'>
                    <div class='col-md-3'></div>
                    <div class='col-md-6 email-content' style='height: auto; width: auto; margin-top: 10px; padding: 20px;
                    background-color: #FFFFFF; box-shadow: 1px 1px 5px 1px rgba(0, 0, 0, 0.05);'>
                    <p class='letter-header' style='font-size: 30px; font-weight: 300; color: #A2A2A2;'>Account Registration</p>
                    <hr class='default-divider ml-auto' style='background-color: #A2A2A2;'>
                    <p style='font-weight: 600;'>Hi! $email, your account registration is currently under verification.</p>
                    <p style='text-align: justify;'>The admissions office will verify and confirm your existing records 
                    in the university first before confirming your account registration. Please wait for further updates
                    through this email address.
                    </p>
                    <p style='text-align: justify;'>Sincerely,</p>
                    <p style='text-align: justify; font-weight: 600;'>Admissions Office | Leyte Normal University</p>
                    <hr class='default-divider ml-auto' style='background-color: #A2A2A2;'>
                    <p style='font-size: 12px; text-align: center'><i>(This is a system generated email. Do not reply.)</i></p>
                    <p class='letter-footer' style='font-size: 10px; letter-spacing: 3px; color: #A2A2A2; text-align: center;'>
                        POWERED BY LNU SAIS V1.0.0
                    </p>
                    </div>   
                    <div class='col-md-3'></div> 
                </div>       
            </div>

            ";


        }else{

            //Mail body for non-returnee applicants

            $mail->Subject = "Verify Your Email";
            $mail->Body = "

            <div class='email-body' style=' height: auto; width: auto; background-color: #F2F2F2;'>
                <div class='email-logo-container' align='center' style='height: auto; width: auto; padding: 15px;
                background-color: #FFFFFF;'>
                    <img src='cid:lnu_logo' class='email-header-logo' alt='lnu-logo' style='height: auto;
                    width: 250px;'>
                </div>
                <div class='row' style='margin: 0px;'>
                    <div class='col-md-3'></div>
                    <div class='col-md-6 email-content' style='height: auto; width: auto; margin-top: 10px; padding: 20px;
                    background-color: #FFFFFF; box-shadow: 1px 1px 5px 1px rgba(0, 0, 0, 0.05);'>
                    <p class='letter-header' style='font-size: 30px; font-weight: 300; color: #A2A2A2;'>Email Verification</p>
                    <hr class='default-divider ml-auto' style='background-color: #A2A2A2;'>
                    <p style='font-weight: 600;'>Hi! $email, your account registration is almost done.</p>
                    <p style='text-align: justify;'>To proceed with the admission process, kindly verify your account using the link provided below</p>
                    <p style='text-align: justify;'>Sincerely,</p>
                    <p style='text-align: justify; font-weight: 600;'>Admissions Office | Leyte Normal University</p>
                    <hr class='default-divider ml-auto' style='background-color: #A2A2A2;'>
                        <a href='http://localhost/lnu-sais/pages/backend/register/verify.php?verification_key=$vkey'>Verify Account Here</a>
                    <hr class='default-divider ml-auto' style='background-color: #A2A2A2;'>
                    <p style='text-align: center;'><i>Note: Unverified accounts will not be allowed to log-in to the system</i></p>
                    <p style='font-size: 12px; text-align: center'><i>(This is a system generated email. Do not reply.)</i></p>
                    <p class='letter-footer' style='font-size: 10px; letter-spacing: 3px; color: #A2A2A2; text-align: center;'>
                        POWERED BY LNU SAIS V1.0.0
                    </p>
                    </div>   
                    <div class='col-md-3'></div> 
                </div>       
            </div>

            ";

        }

        if($mail->Send()){
            echo '
            <script>

                $(document).ready(function(){

                    Swal.fire({

                        icon: "success",
                        title: "A verification email was already sent to your email address!",
                        showConfirmButton: false,
                        timer: 3000

                    }).then(function(){

                        window.location.replace("../../accounts/student/registration.php");

                    });

                });

            </script>

            ';
        }else{
            echo '
            <script>

                $(document).ready(function(){

                    Swal.fire({

                        icon: "error",
                        title: "Cannot send a verification mail, please check your internet connection.",
                        showConfirmButton: false,
                        timer: 3000

                    }).then(function(){

                        window.location.replace("../../accounts/student/registration.php");

                    });

                });

            </script>

            ';
        }
    
    }
    else{
        echo '<script> alert("Error adding account");</script>';
        echo mysqli_error($connection);
    }
}


?>
