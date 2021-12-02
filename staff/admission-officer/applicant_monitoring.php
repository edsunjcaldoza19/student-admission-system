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
        ?>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="block-header">
                        <p class="page-header">Applicant Monitoring</p>
                        <p class="page-subheader">Check status of all registered applicants</p>
                    </div>
                    <div class="card">
                        <div class="header">
                            <?php $sy_id = $_GET['id'];
                                require 'be/database/db_pdo.php';
                                $sqlAY = $conn->prepare("SELECT * FROM `tbl_academic_year` WHERE `id` = $sy_id");
                                $sqlAY->execute();
                                $fetchAY = $sqlAY->fetch();
                            ?>
                            <p class="table-subheader">List of Registered Applicants (A.Y. <?php echo $fetchAY['ay_year']; ?>)</p>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>Applicant Name</th>
                                            <th>Entry Type</th>
                                            <th>First Choice</th>
                                            <th>Second Choice</th>
                                            <th>Application Form Status</th>
                                            <th>Entrance Exam Status</th>
                                            <th>Interview Status</th>
                                            <th>Admission Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <!-- populate table with db data -->
                                        <?php
                                            $sy_id = $_GET['id'];
                                            require 'be/database/db_pdo.php';
                                            $sql = $conn->prepare("SELECT *, tbl_applicant.id FROM tbl_applicant
                                            LEFT JOIN tbl_applicant_account ON tbl_applicant_account.id = tbl_applicant.applicant_account_id
                                            WHERE `school_year_id` = '$sy_id'");
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
                                                    if($fetch['interview_status_1'] == "Pending"){
                                                        echo '<p class="label-blue">1st Choice: Pending</p>';
                                                    }else if($fetch['interview_status_1'] == "Qualified"){
                                                        echo '<p class="label-green">1st Choice: Qualified</p>';
                                                    }else if($fetch['interview_status_1'] == "Unqualified"){
                                                        echo '<p class="label-red">1st Choice: Unqualified</p>';
                                                    }
                                                ?>
                                                <?php
                                                    if($fetch['interview_status_2'] == "Pending"){
                                                        echo '<p class="label-blue">2nd Choice: Pending</p>';
                                                    }else if($fetch['interview_status_2'] == "Qualified"){
                                                        echo '<p class="label-green">2nd Choice: Qualified</p>';
                                                    }else if($fetch['interview_status_2'] == "First Choice:Unqualified"){
                                                        echo '<p class="label-red">2nd Choice: Unqualified</p>';
                                                    }
                                                ?>
                                            </td>
                                            <td align="center">
                                                <?php
                                                    if($fetch['admission_status'] == "Pending"){
                                                        echo '<p class="label-blue">Pending</p>';
                                                    }else if($fetch['admission_status'] == "Evaluated"){
                                                        echo '<p class="label-green">Evaluated</p>';
                                                    }
                                                ?>
                                            </td>
                                        <?php
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
    <?php
        include 'includes/logout_modal.php';
        include 'includes/scripts.php';
    ?>
</body>

</html>
