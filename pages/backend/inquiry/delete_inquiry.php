<head>

    <link rel="stylesheet" type="text/css" href="../../assets/libs/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/style.css">

    <script src="../../assets/libs/jquery/jquery.min.js"></script>
    <script src="../../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/libs/sweetalert/sweetalert2.all.min.js"></script>

</head>

<?php

	require '../config/db_pdo.php';

	try{

		if(ISSET($_GET['id'])){
		
			$id = $_GET['id'];
			$sql = $conn->prepare("DELETE from `tbl_inquiry` WHERE `id`='$id'");
			$sql->execute();

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
                    title: "Inquiry ticket deleted successfully!",
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

                    window.location.replace("../../student/help/send_inquiry.php");

                });

            });

        </script>

        ';

	}


?>