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
            include 'includes/right_sidebar.php';

            //Fetch academic year//

            $id = $_GET['sy_id'];

            $sql1 = $conn->prepare("SELECT * from `tbl_academic_year` WHERE `ay_status` = 1");
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
                        <p class="page-header">Pending Applicants</p>
                        <p class="page-subheader">Approve/disapprove applicants for admission</p>
                    </div>
                    <div class="card">
                        <div class="header">
                            <p class="table-subheader">Pending Applicants List - Unit Chair Evaluation (A.Y. <?php echo $fetch1['ay_year']?>)</p>
                            <small><?php echo $fetch2['unit_name']?></small>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>Applicant Name</th>
                                            <th>Preferred Program</th>
                                            <th>Entry Type</th>
                                            <th>Semester</th>
                                            <th>Exam Score</th>
                                            <th>Interview Rating</th>
                                            <th>Unit Approval Status</th>
                                            <th>Review</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- populate table with db data -->
                                        <?php
                                            require 'be/database/db_pdo.php';
                                            $sql = $conn->prepare("SELECT *, tbl_applicant.id FROM tbl_applicant
                                            LEFT JOIN tbl_applicant_account ON tbl_applicant_account.id = tbl_applicant.applicant_account_id
                                            LEFT JOIN tbl_course ON (tbl_course.course_id=tbl_applicant.program_first_choice OR tbl_course.course_id=tbl_applicant.program_second_choice)
                                            LEFT JOIN tbl_exam_result ON tbl_exam_result.exam_applicant_id=tbl_applicant.applicant_account_id
                                            LEFT JOIN tbl_interview ON tbl_interview.interview_applicant_id=tbl_applicant.applicant_account_id
                                            WHERE `form_status`='Approved' AND `exam_status`='Scored'
                                            AND `school_year_id` = $id AND `unit_id` = $unitId
                                            AND ((`approved_first_choice` = 0 AND `approved_second_choice` = 1 AND `program_first_choice` = $courses AND `interview_status_1` = 'Qualified')
                                            OR (`approved_first_choice` = 1 AND `approved_second_choice` = 0 AND `program_second_choice` = $courses AND `interview_status_2` = 'Pending')
                                            OR (`approved_first_choice` = 0 AND `approved_second_choice` = 0 AND `program_first_choice` = $courses  AND `interview_status_1` = 'Qualified')
                                            OR (`approved_first_choice` = 0 AND `approved_second_choice` = 0 AND `program_second_choice` = $courses  AND `interview_status_2` = 'Qualified')
                                            OR (`approved_first_choice` = 0 AND `approved_second_choice` = 3 AND `program_first_choice` = $courses  AND `interview_status_1` = 'Qualified')
                                            OR (`approved_first_choice` = 3 AND `approved_second_choice` = 0 AND `program_second_choice` = $courses  AND `interview_status_2` = 'Qualified'))
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
                                            <td><?php echo $fetch['entry']; ?></td>
                                            <td><?php echo $fetch['semester']; ?></td>
                                            <td style="width: 40px;"><?php echo $fetch['exam_score']; ?></td>
                                            <td style="width: 40px;">
                                                <?php
                                                    if($fetch['program_first_choice'] == $courses){
                                                        echo $fetch['interview_rating_1'];
                                                    }else if($fetch['program_second_choice'] == $courses){
                                                        echo $fetch['interview_rating_2'];
                                                    }
                                                ?>
                                            </td>
                                            <td align="center">
                                                <?php
                                                    if(($fetch['approved_first_choice'] == 0 && $fetch['program_first_choice'] == $courses) || ($fetch['approved_second_choice'] == 0 && $fetch['program_second_choice'] == $courses)){
                                                        echo '<p class="label-blue">Pending</p>';
                                                    }else if(($fetch['approved_first_choice'] == 1 && $fetch['program_first_choice'] == $courses) || ($fetch['approved_second_choice'] == 1 && $fetch['program_second_choice'] == $courses)){
                                                        echo '<p class="label-green">Approved</p>';
                                                    }else if(($fetch['approved_first_choice'] == 2 && $fetch['program_first_choice'] == $courses) || ($fetch['approved_second_choice'] == 2 && $fetch['program_second_choice'] == $courses)){
                                                        echo '<p class="label-red">Disapproved</p>';
                                                    }else if(($fetch['approved_first_choice'] == 3 && $fetch['program_first_choice'] == $courses) || ($fetch['approved_second_choice'] == 3 && $fetch['program_second_choice'] == $courses)){
                                                        echo '<p class="label-orange">Waitlisted</p>';
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <a href="applicant_review.php?id=<?php echo $fetch['id'];?>&sy_id=<?php echo $id?>&course=<?php echo $course?>" type="button" class="btn bg-light-blue btn-circle waves-effect waves-circle waves-float">
                                                    <i class="material-icons">launch</i>
                                                </a>
                                            </td>
                                        <?php
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
</body>

</html>
