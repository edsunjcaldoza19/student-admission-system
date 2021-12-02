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

            $id = $_GET['course_id'];
            $sy_id = $_GET['sy_id'];

            $sql1 = $conn->prepare("SELECT * from `tbl_course` WHERE `course_id` = $id");
            $sql1->execute();
            $fetch1 = $sql1->fetch();

            $sql2 = $conn->prepare("SELECT * from `tbl_unit` WHERE `id` = ".$unitId."");
            $sql2->execute();
            $fetch2 = $sql2->fetch();

            $sql3 = $conn->prepare("SELECT * from `tbl_academic_year` WHERE `id` = '$sy_id'");
            $sql3->execute();
            $fetch3 = $sql3->fetch();

            $course = $fetch1['course_id'];

            require 'be/database/db_pdo.php';
            $sql = $conn->prepare("SELECT *, tbl_applicant.id FROM tbl_applicant
            LEFT JOIN tbl_applicant_account ON tbl_applicant_account.id = tbl_applicant.applicant_account_id
            LEFT JOIN tbl_course ON (tbl_course.course_id=tbl_applicant.program_first_choice OR tbl_course.course_id=tbl_applicant.program_second_choice)
            WHERE `school_year_id` = $sy_id AND `unit_id` = $unitId
            AND ((`approved_first_choice` = 3 AND `program_first_choice` = $course) OR (`approved_second_choice` = 3 AND `program_second_choice` = $course))
            ");
            $sql->execute();
            $count = $sql->rowCount();
        ?>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="block-header">
                        <p class="page-header">Waitlist</p>
                        <p class="page-subheader">Check and manage waitlisted applicants</p>
                    </div>
                    <div class="card">
                        <div class="header">
                            <p class="table-subheader">Waitlisted Applicants List (<?php echo $fetch1['course_name']?>)</p>
                            <small>A.Y. <?php echo $fetch3['ay_year'];?> <b>(Waitlist Slots: <?php echo $count;?>/<?php echo $fetch1['waitlist_quota'];?>)</b></small>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>Applicant Name</th>
                                            <th>Entry Type</th>
                                            <th>Program Preference</th>
                                            <th>Unit Approval Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- populate table with db data -->
                                        <?php

                                            while($fetch = $sql->fetch()){

                                        ?>
                                        <tr>
                                            <td>
                                                <?php
                                                    echo $fetch['last_name'].', '.$fetch['first_name'].' '.$fetch['middle_name'];
                                                ?>   
                                            </td>
                                            <td><?php echo $fetch['entry']; ?></td>
                                            <td>
                                                <?php
                                                    if($fetch['course_id'] == $fetch['program_first_choice']){
                                                        echo 'First Choice';
                                                    }else if($fetch['course_id'] == $fetch['program_second_choice']){
                                                        echo 'Second Choice';
                                                    }
                                                ?>    
                                            </td>
                                            <td align="center">
                                                <?php
                                                    if(($fetch['approved_first_choice'] == 0 && $fetch['program_first_choice'] == $course) || ($fetch['approved_second_choice'] == 0 && $fetch['program_second_choice'] == $course)){
                                                        echo '<p class="label-blue">Pending</p>';
                                                    }else if(($fetch['approved_first_choice'] == 1 && $fetch['program_first_choice'] == $course) || ($fetch['approved_second_choice'] == 1 && $fetch['program_second_choice'] == $course)){
                                                        echo '<p class="label-green">Approved</p>';
                                                    }else if(($fetch['approved_first_choice'] == 2 && $fetch['program_first_choice'] == $course) || ($fetch['approved_second_choice'] == 2 && $fetch['program_second_choice'] == $course)){
                                                        echo '<p class="label-red">Disapproved</p>';
                                                    }else if(($fetch['approved_first_choice'] == 3 && $fetch['program_first_choice'] == $course) || ($fetch['approved_second_choice'] == 3 && $fetch['program_second_choice'] == $course)){
                                                        echo '<p class="label-orange">Waitlisted</p>';
                                                    }
                                                ?>
                                            </td>
                                            <td style="text-align: center;">
                                                <button class="btn bg-light-blue btn-circle waves-effect waves-circle waves-float" data-toggle="modal" data-target="#approve<?php echo $fetch['id']?>"><i class="material-icons">edit</i></button>
                                            </td>
                                        <?php
                                            include 'be/waitlist/approveApplicationModal.php';
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
