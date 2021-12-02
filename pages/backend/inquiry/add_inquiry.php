<head>

    <link rel="stylesheet" type="text/css" href="../../assets/libs/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/style.css">

    <script src="../../assets/libs/jquery/jquery.min.js"></script>
    <script src="../../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/libs/sweetalert/sweetalert2.all.min.js"></script>

</head>

<?php

	require '../config/db_mysqli.php';
    date_default_timezone_set('Asia/Taipei');

	try{

		if(isset($_POST['btnSend'])){
		
            $id = $_POST['senderID'];
			$category = $_POST['cbFeedbackCategory'];
            $subject = $_POST['tbFeedbackSubject'];
            $message = $_POST['tbFeedbackMessage'];
            $timestamp = date("F j, Y, g:i a");
            $status = "Queued";

            //Sanitize form data

            $category = $connection->real_escape_string($category);
            $subject = $connection->real_escape_string($subject);
            $message = $connection->real_escape_string($message);

			$query="INSERT INTO tbl_inquiry(`inquiry_applicant_id`, `inquiry_category`, `inquiry_subject`, `inquiry_message`, `inquiry_sent_timestamp`, `inquiry_status`) VALUES('$id', '$category', '$subject', '$message', '$timestamp', '$status')";
            $query_run = mysqli_query($connection, $query);

			success();

		}

	}catch(exception $e){
		
		error();

	}

	function success(){

		echo '
        <script>

            $(document).ready(function(){

                Swal.fire({

                    icon: "success",
                    title: "Feedback successfully queued!",
                    showConfirmButton: false,
                    timer: 2000

                }).then(function(){

                    window.location.replace("../../student/help/send_inquiry.php");

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
                    title: "'.$e->getErrorMessage().'",
                    showConfirmButton: false,
                    timer: 2000

                }).then(function(){

                    window.location.replace("../../student/help/send_feedback.php");

                });

            });

        </script>

        ';

	}


?>