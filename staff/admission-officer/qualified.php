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

            $sql1 = $conn->prepare("SELECT * FROM `tbl_academic_year` WHERE `ay_status` = 1");
            $sql1->execute();
            $fetch1 = $sql1->fetch();

            $sy_id = $fetch1['id'];
            $sem = $_GET['sem'];
        ?>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="block-header">
                        <p class="page-header">Qualified Student Applicants</p>
                        <p class="page-subheader">Check/export list of qualified applicants</p>
                    </div>
                    <div class="card">
                        <div class="header">
                            <p class="table-subheader">Admission Qualifiers Masterlist</p>
                            <small>A.Y. <?php echo $fetch1['ay_year']?> - <?php echo $sem ?></small>
                            <hr class="default-divider ml-auto">
                            <a class="btn bg-blue waves-effect" href="be/print_pdf.php?sy_id=<?php echo $sy_id ?>&sem=<?php echo $sem?>">
                                <i class="material-icons">file_download</i>?
                                <span>Generate List</span>
                            </a>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>Applicant Name</th>
                                            <th>Entry Type</th>
                                            <th>Semester</th>
                                            <th>First Choice</th>
                                            <th>Status</th>
                                            <th>Second Choice</th>
                                            <th>Status</th>
                                            <th>Admission Confirmation</th>
                                            <th>ID Number</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- populate table with db data -->
                                        <?php

                                            $sql = $conn->prepare("SELECT *, tbl_applicant.id FROM tbl_applicant
                                            LEFT JOIN tbl_applicant_account ON tbl_applicant_account.id = tbl_applicant.applicant_account_id
                                            WHERE `form_status`='Approved' AND `exam_status`='Scored'
                                            AND `semester` = '$sem'
                                            AND `interview_status_1`='Qualified' OR `interview_status_2`='Qualified'
                                            AND `admission_status`='Evaluated' AND ((`approved_first_choice` = 1 AND `approved_second_choice` = 0) OR (`approved_first_choice` = 0 AND `approved_second_choice` = 1) OR (`approved_first_choice` = 1 AND `approved_second_choice` = 1) OR (`approved_first_choice` = 1 AND `approved_second_choice` = 3) OR (`approved_first_choice` = 3 AND `approved_second_choice` = 1))");
                                            $sql->execute();
                                            while($fetch = $sql->fetch()){

                                                //fetch first and second choice

                                                $firstChoice = $fetch['program_first_choice'];
                                                $secondChoice = $fetch['program_second_choice'];

                                                $sql1 = $conn->prepare("SELECT * FROM `tbl_course` WHERE `course_id` = '$firstChoice'");
                                                $sql1->execute();

                                                $sql2 = $conn->prepare("SELECT * FROM `tbl_course` WHERE `course_id` = '$secondChoice'");
                                                $sql2->execute();

                                                while($fetch1 = $sql1->fetch()){
                                                    while($fetch2 = $sql2->fetch()){
                                        ?>
                                        <tr>
                                            <td>
                                                <?php
                                                    echo $fetch['last_name'].', '.$fetch['first_name'].' '.$fetch['middle_name'];
                                                ?>
                                            </td>
                                            <td><?php echo $fetch['entry']; ?></td>
                                            <td><?php echo $fetch['semester']; ?></td>
                                            <td>
                                                <?php
                                                    echo $fetch1['course_acronym'];
                                                ?>  
                                            </td>
                                            <td>
                                                <?php
                                                    if($fetch['approved_first_choice'] == 1){
                                                        echo '<p class="label-green">Approved</p>';
                                                    }else if($fetch['approved_first_choice'] == 2){
                                                        echo '<p class="label-red">Disapproved</p>';
                                                    }else if($fetch['approved_first_choice'] == 3){
                                                        echo '<p class="label-orange">Waitlisted</p>';
                                                    }else if($fetch['approved_first_choice'] == 0){
                                                        echo '<p class="label-blue">Pending</p>';
                                                    }
                                                ?>  
                                            </td>
                                            <td>
                                                <?php
                                                    echo $fetch2['course_acronym'];
                                                ?>    
                                            </td>
                                            <td>
                                                <?php
                                                    if($fetch['approved_second_choice'] == 1){
                                                        echo '<p class="label-green">Approved</p>';
                                                    }else if($fetch['approved_second_choice'] == 2){
                                                        echo '<p class="label-red">Disapproved</p>';
                                                    }else if($fetch['approved_second_choice'] == 3){
                                                        echo '<p class="label-orange">Waitlisted</p>';
                                                    }else if($fetch['approved_second_choice'] == 0){
                                                        echo '<p class="label-blue">Pending</p>';
                                                    }
                                                ?>  
                                            </td>
                                            <td align="center">
                                                <?php
                                                    if($fetch['pursue_enrollment'] == 0){
                                                        echo '<p class="label-blue">Pending</p>';
                                                    }else if($fetch['pursue_enrollment'] == 1){
                                                        echo '<p class="label-green">Accepted</p>';
                                                    }else if($fetch['pursue_enrollment'] == 2){
                                                        echo '<p class="label-red">Declined</p>';
                                                    }
                                                ?>  
                                            </td>
                                            <td>
                                                <?php
                                                    echo $fetch['student_number'];
                                                ?>  
                                            </td>
                                            <td style="text-align: center;">
                                                <button class="btn bg-light-blue btn-circle waves-effect waves-circle waves-float" data-toggle="modal" data-target="#notify<?php echo $fetch['id']?>" <?php if($fetch['student_number'] != 'N/A'){echo 'disabled';} ?>><i class="material-icons">add_circle_outline</i></button>
                                            </td>
                                            
                                        <?php
                                            include 'be/notify/notifyModal.php';
                                                }
                                            }
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
    <?php include 'includes/logout_modal.php';?>
    <?php include 'includes/scripts.php';?>
</body>

</html>
