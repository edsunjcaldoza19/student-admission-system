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
                        <p class="page-header">Unqualified Applicants</p>
                        <p class="page-subheader">Inspect applicants who did not qualify the interview</p>
                    </div>
                    <div class="card">
                        <div class="header">
                            <p class="table-subheader">Unqualified Applicants List - Interview (A.Y. <?php echo $fetch1['ay_year']?>)</p>
                            <small><?php echo $fetch2['unit_name']?></small>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>Interview Rating</th>
                                            <th>Applicant Name</th>
                                            <th>Entry Type</th>
                                            <th>Preferred Program</th>
                                            <th>Application Form Status</th>
                                            <th>Entrance Exam Status</th>
                                            <th>Interview Status</th>
                                            <th>Update Rating</th>
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
                                            AND ((`interview_status_1` = 'Unqualified' AND `program_first_choice` = $courses) OR (`interview_status_2` = 'Unqualified' AND `program_second_choice` = $courses))
                                            ");
                                            $sql->execute();
                                            while($fetch = $sql->fetch()){
                                        ?>
                                        <tr>
                                            <td>
                                                <?php
                                                    if($fetch['course_id'] == $fetch['program_first_choice']){
                                                        echo $fetch['interview_rating_1'];
                                                    }else if($fetch['course_id'] == $fetch['program_second_choice']){
                                                        echo $fetch['interview_rating_2'];
                                                    }
                                                ?>           
                                            </td>
                                            <td>
                                                <?php
                                                    echo $fetch['last_name'].', '.$fetch['first_name'].' '.$fetch['middle_name'];
                                                ?>     
                                            <td><?php echo $fetch['entry']; ?></td>
                                            <td>
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
                                            <td align="center">
                                                <?php
                                                    if($fetch['form_status'] == "Pending"){
                                                        echo '<p class="label-blue">Pending</p>';
                                                    }else if($fetch['form_status'] == "Approved"){
                                                        echo '<p class="label-green">Approved</p>';
                                                    }else if($fetch['form_status'] == "Disapproved"){
                                                        echo '<p class="label-red">Disapproved</p>';
                                                    }
                                                ?>
                                            </td>
                                            <td align="center">
                                                <?php
                                                    if($fetch['exam_status'] == "Pending"){
                                                        echo '<p class="label-blue">Pending</p>';
                                                    }else if($fetch['exam_status'] == "Scored"){
                                                        echo '<p class="label-blue">Scored</p>';
                                                    }else if($fetch['exam_status'] == "Qualified"){
                                                        echo '<p class="label-green">Qualified</p>';
                                                    }else if($fetch['exam_status'] == "Unqualified"){
                                                        echo '<p class="label-red">Qualified</p>';
                                                    }
                                                ?>
                                            </td>
                                            <td align="center">
                                                <?php
                                                    if($fetch['program_first_choice'] == $courses){
                                                        if($fetch['interview_status_1'] == "Pending"){
                                                            echo '<p class="label-blue">Pending</p>';
                                                        }else if($fetch['interview_status_1'] == "Qualified"){
                                                            echo '<p class="label-green">Qualified</p>';
                                                        }else if($fetch['interview_status_1'] == "Unqualified"){
                                                            echo '<p class="label-red">Unqualified</p>';
                                                        }
                                                    }else{
                                                        if($fetch['interview_status_2'] == "Pending"){
                                                            echo '<p class="label-blue">Pending</p>';
                                                        }else if($fetch['interview_status_2'] == "Qualified"){
                                                            echo '<p class="label-green">Qualified</p>';
                                                        }else if($fetch['inteview_status_2'] == "Unqualified"){
                                                            echo '<p class="label-red">Unqualified</p>';
                                                        }
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <button class="btn btn-primary waves-effect" data-toggle="modal" data-target="#updateScore<?php echo $fetch['id']; ?>">
                                                    <i class="material-icons">add</i>
                                                    <span>Update Rating</span>
                                                </button>
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
    <?php
        include 'includes/logout_modal.php';
        include 'includes/scripts.php';
    ?>
</body>

</html>
