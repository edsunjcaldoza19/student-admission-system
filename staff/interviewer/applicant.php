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

            $sql1 = $conn->prepare("SELECT * from `tbl_academic_year` WHERE `ay_status` = 1");
            $sql1->execute();
            $fetch1 = $sql1->fetch();

            $sy_id = $fetch1['id'];

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
                        <p class="page-header">Applicant Masterlist</p>
                        <p class="page-subheader">View applicants seeking admission to this unit</p>
                    </div>
                    <div class="card">
                        <div class="header">
                            <p class="table-subheader">Applicant Masterlist (A.Y. <?php echo $fetch1['ay_year']?>)
                            </p>
                            <small><?php echo $fetch2['unit_name']?></small>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>Applicant Name</th>
                                            <th>Entry Type</th>
                                            <th>Semester</th>
                                            <th>Preferred Program</th>
                                            <th>Application Form Status</th>
                                            <th>Entrance Examination Status</th>
                                            <th>Interview Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- populate table with db data -->
                                        <?php
                                            require 'be/database/db_pdo.php';
                                            $sql = $conn->prepare("SELECT *, tbl_applicant.id FROM tbl_applicant
                                            LEFT JOIN tbl_applicant_account ON tbl_applicant_account.id = tbl_applicant.applicant_account_id
                                            LEFT JOIN tbl_course ON (tbl_course.course_id=tbl_applicant.program_first_choice OR tbl_course.course_id=tbl_applicant.program_second_choice)
                                            WHERE `school_year_id` = $sy_id AND `unit_id` = $unitId
                                            AND (`program_first_choice` = $courses OR `program_second_choice` = $courses)
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
                                            <td><?php echo $fetch['semester']; ?></td>
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
                                                    }else if($fetch['form_status'] == "Rejected"){
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
        </div>
    </section>
    <?php include 'includes/logout_modal.php';?>
    <?php include 'includes/scripts.php';?>
</body>

</html>
