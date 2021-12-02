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
                    <p class="page-header">Configure Admission Schedules</p>
                    <p class="page-subheader">Set the schedules for the admission</p>
                    </div>
                    <div class="card">
                        <div class="header">
                            <p class="table-subheader"></p>
                            <button type="button" class="btn bg-green waves-effect"  href="#" data-toggle="modal" data-target="#addModal">
                                <i class="material-icons">add</i>
                                <span>Add Schedule</span>
                            </button>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Schedule Date</th>
                                            <th>Schedule Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- populate table with db data -->
                                        <?php
                                            require 'be/database/db_pdo.php';
                                            $sql = $conn->prepare("SELECT * FROM tbl_schedules");
                                            $sql->execute();

                                            while($fetch = $sql->fetch()){
                                        ?>
                                        <tr>
                                            <td><?php echo $fetch['schedule_date']; ?></td>
                                            <td><?php echo $fetch['schedule_desc']; ?></td>
                                            <td style="text-align: center; width: 250px;">
                                                <button class="btn bg-light-blue btn-circle waves-effect waves-circle waves-float" data-toggle="modal" data-target="#update<?php echo $fetch['id']?>"><i class="material-icons">edit</i></button>
                                                <button class="btn bg-red btn-circle waves-effect waves-circle waves-float" data-toggle="modal" data-target="#delete<?php echo $fetch['id']?>" id="btnDelete"><i class="material-icons">delete</i></button>
                                            </td>
                                            <?php
                                            include 'be/schedule/deleteModal.php';
                                            include 'be/schedule/updateModal.php';
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
            <?php include 'be/schedule/addModal.php' ?>
        </div>
    </section>
    <?php include 'includes/logout_modal.php';?>
    <?php include 'includes/scripts.php';?>
</body>

</html>
