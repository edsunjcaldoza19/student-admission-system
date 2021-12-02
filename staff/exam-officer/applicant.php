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

            $sql1 = $conn->prepare("SELECT * from `tbl_academic_year` WHERE `ay_status` = 1");
            $sql1->execute();
            $fetch1 = $sql1->fetch();

            $sy_id = $fetch1['id'];
        ?>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="block-header">
                        <p class="page-header">Applicant Masterlist</p>
                        <p class="page-subheader">View applicants taking the entrance examination</p>
                    </div>
                    <div class="card">
                        <div class="header">
                            <p class="table-subheader">Applicant Masterlist (A.Y. <?php echo $fetch1['ay_year']?>)
                            </p>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>Applicant Name</th>
                                            <th>Entry Type</th>
                                            <th>Semester</th>
                                            <th>Application Form Status</th>
                                            <th>Entrance Examination Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- populate table with db data -->
                                        <?php
                                            require 'be/database/db_pdo.php';
                                            $sql = $conn->prepare("SELECT *, tbl_applicant.id FROM tbl_applicant
                                            LEFT JOIN tbl_applicant_account ON tbl_applicant_account.id = tbl_applicant.applicant_account_id
                                            WHERE `school_year_id` = $sy_id
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
