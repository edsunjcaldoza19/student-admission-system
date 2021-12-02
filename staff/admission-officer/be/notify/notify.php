<head>

    <link rel="stylesheet" type="text/css" href="../../../../pages/assets/libs/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../../../../pages/assets/css/style.css">

    <script src="../../../../pages/assets/libs/jquery/jquery.min.js"></script>
    <script src="../../../../pages/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../../../pages/assets/libs/sweetalert/sweetalert2.all.min.js"></script>

</head>

<?php

require '../database/db_mysqli.php';
require '../database/db_pdo.php';
require '../../../../pages/assets/libs/PHPMailer/src/PHPMailer.php';
require '../../../../pages/assets/libs/PHPMailer/src/SMTP.php'; 
require '../../../../pages/assets/libs/PHPMailer/src/Exception.php'; 

date_default_timezone_set('Asia/Taipei');

if(isset($_POST['send'])){

    //Get form Data

    $email = $_POST['email'];
    $name = $_POST['name'];
    $program = $_POST['program'];
    $idNum = $_POST['idNum'];

    $query="UPDATE tbl_applicant_account SET `student_number` = '$idNum' WHERE `email` = '$email'";
    $query_run = mysqli_query($connection, $query); 

    if($query_run){

        //log this action

        $staff_id = $_POST['staff_id'];
        $staff_username = $_POST['staff_username'];
        $staff_role = 1;
        $log_description = 'Assigne student number to '.$name;
        $timestamp = date('m/d/Y, g:i:s A');

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql2 = "INSERT INTO `tbl_logs`(`log_staff_id`, `log_staff_username`, `log_staff_role`, `log_description`, `timestamp`)
        VALUES ('$staff_id', '$staff_username', '$staff_role', '$log_description', '$timestamp')";
        $conn->exec($sql2);

        echo '
            <script>

                $(document).ready(function(){

                    Swal.fire({
                        icon: "success",
                        title: "Student Number Succesfully Assigned!",
                        timer: 1000
                    }).then(function(){
                        window.location.replace("../../qualified.php");

                    });

                });

            </script>
        ';
            
    }

    /* if($query_run){
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
        $mail->addEmbeddedImage('../../../../pages/assets/images/logo.png', 'lnu_logo');
        

        //Mail body

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
                    <p class='letter-header' style='font-size: 30px; font-weight: 300; color: #A2A2A2;'>Congratulations!</p>
                    <hr class='default-divider ml-auto' style='background-color: #A2A2A2;'>
                    <p style='font-weight: 600;'>Greetings! $name, </p>
                    <p style='text-align: justify;'>We are glad to inform that you are <u><b>QUALIFIED FOR ADMISSION</b></u> to the university for the program <b>".$program."</b>.
                    </p>
                    <p style='text-align: justify;'>Your official student ID Number is: <b>".$idNum."</b>
                    </p>
                    <p style='text-align: justify;'>You may now proceed and access the university's enrolment portal by clicking the link below. Please use your ID number to log-in.</b>
                    </p>
                    <p style='text-align: justify;'>Sincerely,</p>
                    <p style='text-align: justify; font-weight: 600;'>Admissions Office | Leyte Normal University</p>
                    <hr class='default-divider ml-auto' style='background-color: #A2A2A2;'>
                        <a href='http://enrollment.lnu.edu.ph'>Enrolment Portal</a>
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


        if($mail->Send()){
            echo '
            <script>

                $(document).ready(function(){

                    Swal.fire({

                        icon: "success",
                        title: "A notification email was already sent to your email address!",
                        showConfirmButton: false,
                        timer: 2000

                    }).then(function(){

                        window.location.replace("../../qualified.php");

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

    */
}


?>
