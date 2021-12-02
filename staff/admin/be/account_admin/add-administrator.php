<head>

    <link rel="stylesheet" type="text/css" href="../../../../pages/assets/libs/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../../../../pages/assets/css/style.css">

    <script src="../../../../pages/assets/libs/jquery/jquery.min.js"></script>
    <script src="../../../../pages/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../../../pages/assets/libs/sweetalert/sweetalert2.all.min.js"></script>

</head>

<?php

require '../database/db_pdo.php';
require '../database/db_mysqli.php';
require '../../../../pages/assets/libs/PHPMailer/src/PHPMailer.php';
require '../../../../pages/assets/libs/PHPMailer/src/SMTP.php'; 
require '../../../../pages/assets/libs/PHPMailer/src/Exception.php'; 

date_default_timezone_set('Asia/Taipei');

if(isset($_POST['addAccount'])){

    //Get form Data

    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $username = $_POST['newUsername'];
    $email = $_POST['newEmail'];
    $loginStatus = 0;

    //Sanitize form data

    $firstName = $connection->real_escape_string($firstName);
    $lastName = $connection->real_escape_string($lastName);
    $username = $connection->real_escape_string($username);
    $email = $connection->real_escape_string($email);

    $fullName = $firstName.' '.$lastName;

    //Set last name as default password

    $password = password_hash($username, PASSWORD_DEFAULT);

    //Set default avatar

    $image = generateAvatar(strtoupper($firstName[0].''.$lastName[0]), strtolower($firstName.'_'.$lastName));

    //Generate verification key

    $vkey = md5(time().$email);
    $verified = 0;

    $query="INSERT INTO tbl_admin(`username`, `password`, `name`, `email`, `image`, `verification_key`, `verified`, `login_status`) VALUES('$username', '$password', '$fullName', '$email', '$image', '$vkey', '$verified', '$loginStatus')";
    $query_run = mysqli_query($connection, $query);

    if($query_run){
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
        $mail->Subject = "Activate LNU-SAIS Administrator Account";
        $mail->setFrom("lnu.admissionsoffice@lnu.edu.ph");

        //Initialize email body

        $mail->isHTML(true);
        $mail->From = "lnu.admissionsoffice@lnu.edu.ph";
        $mail->FromName = "<no-reply@mailersais>";
        $mail->addAddress($email);
        $mail->addEmbeddedImage('../../../../pages/assets/images/logo.png', 'lnu_logo');
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
                    <p class='letter-header' style='font-size: 30px; font-weight: 300; color: #A2A2A2;'>Administrator Account Activation</p>
                    <hr class='default-divider ml-auto' style='background-color: #A2A2A2;'>
                    <p style='font-weight: 600;'>Greetings! $email <br>You may now activate your LNU-SAIS Administrator Account</p>
                    <p>Please use the following default user credentials upon activation:</p>
                    <p style='margin-bottom: 5px;'><b>Username: $username</b></p>
                    <p><b>Password: $username</b></p>
                    <p style='text-align: justify;'>To activate your administrator account, please click the link provided below</p>
                    <p style='text-align: justify;'>Sincerely,</p>
                    <p style='text-align: justify; font-weight: 600;'>MIS Office | Leyte Normal University</p>
                    <hr class='default-divider ml-auto' style='background-color: #A2A2A2;'>
                        <a href='http://localhost/lnu-sais/staff/admin/be/account_admin/verify.php?verification_key=$vkey'>Activate My Account</a>
                    <hr class='default-divider ml-auto' style='background-color: #A2A2A2;'>
                    <p style='text-align: center;'><b><i>Note: Inactivated accounts will not be allowed to log-in to the system. <br>We also advise you to change your password immediately on first login</i></b></p>
                    <p style='text-align: center;'><i>For more information, kindly contact the university MIS office or the Admissions Office</i></p>
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
                        title: "An activation email was sent to the indicated email address!",
                        showConfirmButton: false,
                        timer: 3000

                    }).then(function(){

                        window.location.replace("../../account_admin.php");

                    });

                });

            </script>

            ';
        }

        //log this action

        $staff_id = $_POST['staff_id'];
        $staff_username = $_POST['staff_username'];
        $staff_role = 0;
        $log_description = 'Added new administrator account';
        $timestamp = date('m/d/Y, g:i:s A');

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql2 = "INSERT INTO `tbl_logs`(`log_staff_id`, `log_staff_username`, `log_staff_role`, `log_description`, `timestamp`)
        VALUES ('$staff_id', '$staff_username', '$staff_role', '$log_description', '$timestamp')";
        $conn->exec($sql2);
    
    }else{
        echo '<script> alert("Error adding account");</script>';
        echo mysqli_error($connection);
    }

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
