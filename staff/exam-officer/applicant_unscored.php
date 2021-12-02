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
        ?>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="block-header">
                        <p class="page-header">Unscored Applicants</p>
                        <p class="page-subheader">Input scores of applicants who took the entrance examination</p>
                    </div>
                    <div class="card">
                        <div class="header">
                            <p class="table-subheader">Unscored Applicants List (A.Y. <?php echo $fetch1['ay_year']?>)</p>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>Input Score</th>
                                            <th>Applicant Name</th>
                                            <th>Entry Type</th>
                                            <th>Semester</th>
                                            <th>First Choice</th>
                                            <th>Second Choice</th>
                                            <th>Application Form Status</th>
                                            <th>Entrance Exam Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- populate table with db data -->
                                        <?php
                                            require 'be/database/db_pdo.php';
                                            $sql = $conn->prepare("SELECT *, tbl_applicant.id FROM tbl_applicant
                                            LEFT JOIN tbl_applicant_account ON tbl_applicant_account.id = tbl_applicant.applicant_account_id
                                            WHERE `form_status`='Approved' AND `exam_status`='Pending' AND `school_year_id` = $id");
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
                                                <button class="btn bg-light-blue btn-circle waves-effect waves-circle waves-float" data-toggle="modal" data-target="#updateScore<?php echo $fetch['id']?>"><i class="material-icons">edit</i></button>
                                            </td>
                                            <td>
                                                <?php
                                                    echo $fetch['last_name'].', '.$fetch['first_name'].' '.$fetch['middle_name'];
                                                ?>       
                                            </td>
                                            <td><?php echo $fetch['entry']; ?></td>
                                            <td><?php echo $fetch['semester']; ?></td>
                                            <td>
                                                <?php
                                                    echo $fetch1['course_name'].' ('.$fetch1['course_acronym'].')';
                                                ?>  
                                            </td>
                                            <td>
                                                <?php
                                                    echo $fetch2['course_name'].' ('.$fetch2['course_acronym'].')';
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
                                                        echo '<p class="label-red">Unqualified</p>';
                                                    }
                                                ?>
                                            </td>
                                            <?php
                                            include 'be/applicant_exam/updateScoreModal.php';
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
    <!-- Logout Modal -->
    <?php
        include 'includes/logout_modal.php';
        include 'includes/scripts.php';
    ?>
</body>

</html>
