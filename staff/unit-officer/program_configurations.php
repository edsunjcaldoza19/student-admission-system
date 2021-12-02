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

            $sql2 = $conn->prepare("SELECT * from `tbl_unit` WHERE `id` = ".$unitId."");
            $sql2->execute();
            $fetch2 = $sql2->fetch();
        ?>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="block-header">
                        <p class="page-header">Program Configurations</p>
                        <p class="page-subheader">Set quotas and qualifying scores for each programs.</p>
                    </div>
                    <div class="card">
                        <div class="header">
                            <p class="table-subheader">Program Configurations Overview</p>
                            <small><?php echo $fetch2['unit_name']?></small>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Program Name</th>
                                            <th>Program Quota</th>
                                            <th>Waitlist Quota</th>
                                            <th>Interview Passing Rating</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- populate table with db data -->
                                        <?php
                                            require 'be/database/db_pdo.php';
                                            $sql = $conn->prepare("SELECT * FROM `tbl_course` WHERE `unit_id` = '$unitId'");
                                            $sql->execute();
                                            while($fetch = $sql->fetch()){
                                        ?>
                                        <tr>
                                            <td><?php echo $fetch['course_name']; ?></td>
                                            <td><?php echo $fetch['course_quota']; ?></td>
                                            <td><?php echo $fetch['waitlist_quota']; ?></td>
                                            <td><?php echo $fetch['interview_passing_score']; ?></td>
                                            <td style="text-align: center; width: 200px;">
                                                <button class="btn bg-light-blue btn-circle waves-effect waves-circle waves-float" data-toggle="modal" data-target="#update<?php echo $fetch['course_id'];?>"><i class="material-icons">edit</i></button>
                                            </td>
                                        <?php
                                            include 'be/program_config/updateModal.php';
                                            //include 'be/procedure/updateModal.php';
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
