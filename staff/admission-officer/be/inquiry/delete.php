<?php

require '../database/db_mysqli.php';

date_default_timezone_set('Asia/Taipei');

try{

    if(isset($_POST['deleteFeedback'])){

        $id = $_POST['id'];

        $query="DELETE FROM tbl_feedback WHERE `id` = '$id'";
        $query_run = mysqli_query($connection, $query);

        if($query){

            //log this action

                $staff_id = $_POST['staff_id'];
                $staff_username = $_POST['staff_username'];
                $staff_role = 1;
                $log_description = 'Deleted an inquiry ticket';
                $timestamp = date('m/d/Y, g:i:s A');

                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql2 = "INSERT INTO `tbl_logs`(`log_staff_id`, `log_staff_username`, `log_staff_role`, `log_description`, `timestamp`)
                VALUES ('$staff_id', '$staff_username', '$staff_role', '$log_description', '$timestamp')";
                $conn->exec($sql2);
            
            echo '<script> alert("Data deleted");</script>';
            sleep(2);
            header('location:../../feedback.php');

        }
        else{
            echo '<script> alert("Data not deleted");</script>';
        }
    }      

}catch(exception $e){
        echo 'Error: '.$e->getErrorMessage();

    }

?>
