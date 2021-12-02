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
            WHERE `school_year_id` = $sy_id
            AND ((`approved_first_choice` = 1 AND `program_first_choice` = $course) OR (`approved_second_choice` = 1 AND `program_second_choice` = $course))
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
                        <p class="page-header">Approved Applicants</p>
                        <p class="page-subheader">Check and print list of applicants approved for admission</p>
                    </div>
                    <div class="card">
                        <div class="header">
                            <p class="table-subheader">Approved Applicants List (<?php echo $fetch1['course_name']?>)</p>
                            <small>A.Y. <?php echo $fetch3['ay_year'];?> <b>(Program Slots: <?php echo $count;?>/<?php echo $fetch1['course_quota'];?>)</b></small>
                            <hr class="default-divider ml-auto">
                            <a class="btn bg-blue waves-effect" href="be/print_pdf.php?sy_id=<?php echo $sy_id ?>&unit_id=<?php echo $unitId ?>&course_id=<?php echo $id ?>">
                                <i class="material-icons">file_download</i>
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
                                            <th>Unit Approval Status</th>
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
                                            <td><?php echo $fetch['semester']; ?></td>
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
