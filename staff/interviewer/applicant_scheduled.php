<?php include 'includes/session.php'; ?>
<!DOCTYPE html>
<html>

<?php
    include 'includes/header.php';
    include 'includes/topbar.php';
?>
    <section>
        <?php
            include 'includes/left_sidebar.php';

            //Fetch academic year//

            $id = $_GET['sy_id'];

            $sql1 = $conn->prepare("SELECT * from `tbl_academic_year` WHERE `id` = $id");
            $sql1->execute();
            $fetch1 = $sql1->fetch();

            $sql2 = $conn->prepare("SELECT * from `tbl_unit` WHERE `id` = ".$unitId."");
            $sql2->execute();
            $fetch2 = $sql2->fetch();

            $sql3 = $conn->prepare("SELECT * from `tbl_course` WHERE `unit_id` = ".$unitId."");
            $sql3->execute();
            while($fetch3 = $sql3->fetch()){
                $courses = $fetch3['course_id'];
            }
        ?>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="block-header">
                        <p class="page-header">Scheduled Applicants</p>
                        <p class="page-subheader">Input ratings for applicants scheduled under this interviewer account</p>
                    </div>
                    <div class="card">
                        <div class="header"> 
                            <p class="table-subheader">Scheduled Applicants List - Interview (A.Y. <?php echo $fetch1['ay_year']?>)</p>
                            <small>Interviewer: <b><?php echo $name?></b></small>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>Applicant Name</th>
                                            <th>Entry Type</th>
                                            <th>Preferred Program</th>
                                            <th>Interview Method</th>
                                            <th>Interview Details</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- populate table with db data -->
                                        <?php
                                            require 'be/database/db_pdo.php';
                                            $sql = $conn->prepare("SELECT *, tbl_applicant.id FROM tbl_applicant
                                            LEFT JOIN tbl_applicant_account ON tbl_applicant_account.id = tbl_applicant.applicant_account_id
                                            LEFT JOIN tbl_course ON (tbl_course.course_id=tbl_applicant.program_first_choice OR tbl_course.course_id=tbl_applicant.program_second_choice)
                                            LEFT JOIN tbl_interview ON tbl_interview.interview_applicant_id = tbl_applicant.applicant_account_id
                                            WHERE `form_status`='Approved' AND `exam_status`='Scored' 
                                            AND `school_year_id` = $id AND `unit_id` = $unitId
                                            AND ((`interview_status_1` = 'Scheduled' AND `program_first_choice` = $courses) OR (`interview_status_2` = 'Scheduled' AND `program_second_choice` = $courses))
                                            ");
                                            $sql->execute();
                                            while($fetch = $sql->fetch()){
                                        ?>
                                        <tr>
                                            <td>
                                                <?php
                                                    echo $fetch['last_name'].', '.$fetch['first_name'].' '.$fetch['middle_name'];
                                                ?>       
                                            </td>
                                            <td><?php echo $fetch['entry']; ?></td>
                                            <td style="width: 200px;">
                                                <?php
                                                    echo $fetch['course_name'].' ('.$fetch['course_acronym'].')';
                                                    if($fetch['course_id'] == $fetch['program_first_choice']){
                                                        echo ' - First Choice';
                                                        $course = $fetch['course_id'];
                                                    }else if($fetch['course_id'] == $fetch['program_second_choice']){
                                                        echo ' - Second Choice';
                                                        $course = $fetch['course_id'];
                                                    }
                                                ?>   
                                            </td>
                                            <td style="width: 50px;">
                                                <?php 
                                                    if($fetch['course_id'] == $fetch['program_first_choice']){
                                                        echo $fetch['interview_method_1'];
                                                    }else if($fetch['course_id'] == $fetch['program_second_choice']){
                                                        echo $fetch['interview_method_2'];
                                                    }
                                                ?>
                                            <td>
                                                <?php 
                                                    if($fetch['course_id'] == $fetch['program_first_choice']){
                                                        echo '<p><b>Date: </b><br>'.$fetch['interview_date_1'].'</p>';
                                                        echo '<p><b>Time: </b><br>'.$fetch['interview_time_1'].'</p>';
                                                        echo '<p><b>Link/Venue: </b><br>'.$fetch['interview_venue_or_link_1'].'</p>';
                                                    }else if($fetch['course_id'] == $fetch['program_second_choice']){
                                                        echo '<p><b>Date: </b><br>'.$fetch['interview_date_2'].'</p>';
                                                        echo '<p><b>Time: </b><br>'.$fetch['interview_time_2'].'</p>';
                                                        echo '<p><b>Link/Venue: </b><br>'.$fetch['interview_venue_or_link_2'].'</p>';
                                                    }
                                                ?>
                                            </td>
                                            
                                            <td align="center" style="width: 100px;">
                                                <button class="btn bg-light-blue btn-circle waves-effect waves-circle waves-float" data-toggle="modal" data-target="#updateScore<?php echo $fetch['id']; ?>"><i class="material-icons">edit</i></button>
                                            </td>
                                        <?php
                                            include 'be/applicant_interview/updateInterviewScoreModal.php';
                                            }
                                        ?>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
        </div>
    </section>
    <!-- Logout Modal -->
    <?php
        include 'includes/logout_modal.php';
        include 'includes/scripts.php';
    ?>

    <script>
        $("#method").change(function(){
            if($(this).val() == "Face-to-Face"){
                $("#callLink").hide();
                $("#callLink").prop('required', false);
                $("#venue").show();
                $("#venue").prop('required', true);
            }
            else if($(this).val() == "Video Call"){
                $("#callLink").show();
                $("#callLink").prop('required', true);
                $("#venue").hide();
                $("#venue").prop('required', false);
            }
        });
    </script>
</body>

</html>
