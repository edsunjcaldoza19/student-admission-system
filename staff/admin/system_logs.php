<?php
    include 'includes/session.php';
    include 'includes/header.php';
    ?>
    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="../../plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />
    <!-- JQuery DataTable Css -->
    <link href="../../plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
    <?php
    include 'includes/topbar.php';
    include 'includes/left_sidebar.php';
?>
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
            <p class="page-header">System Logs</p>
            <p class="page-subheader">Monitor actions logged by the system.</p>
            </div>
            <div class="row clearfix jsdemo-notification-button">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <p class="table-subheader">System Logs Overview</p>
                            <button type="button" class="btn bg-red waves-effect"  href="#" data-toggle="modal" data-target="#delete">
                                <i class="material-icons">delete</i>
                                <span>Clear All Logs</span>
                            </button>
                        </div>
                        <div class="body">
                            <div class="table">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Timestamp</th>
                                            <th>Log Description</th>
                                            <th>Account Level</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- populate table with db data -->
                                        <?php
                                            require 'be/database/db_pdo.php';
                                            $sql = $conn->prepare("SELECT * FROM tbl_logs");
                                            $sql->execute();

                                            while($fetch = $sql->fetch()){
                                        ?>
                                        <tr>
                                            <td><?php echo $fetch['timestamp']?></td>
                                            <td><?php echo $fetch['log_description']?> - <i>Action commited by <?php echo $fetch['log_staff_username']?></i></td>
                                            <td style="font-size: 10px;" align="center">
                                                <?php
                                                    if($fetch['log_staff_role'] == 0){
                                                        echo '<p class="label-green">Administrator</p>';
                                                    }else if($fetch['log_staff_role'] == 1){
                                                        echo '<p class="label-blue">Admissions Office</p>';
                                                    }else if($fetch['log_staff_role'] == 2){
                                                        echo '<p class="label-orange">Examination Office</p>';
                                                    }else if($fetch['log_staff_role'] == 3){
                                                        echo '<p class="label-orange">Unit Head</p>';
                                                    }else if($fetch['log_staff_role'] == 4){
                                                        echo '<p class="label-orange">Unit Interviewer</p>';
                                                    } 
                                                ?>
                                            </td>
                                        </tr>
                                        <?php
                                            include 'be/logs/deleteModal.php'; 
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           <!-- <?php //include 'be/academic_year/eraseModal.php';?> -->
        </div>
    </section>
 <?php
        include 'includes/logout_modal.php';
        include 'includes/scripts.php';
    ?>
    <!-- ADDITIONAL JAVASCRIPT FOR THIS PAGE (ACADEMIC YEAR) -->
    <!-- Autosize Plugin Js -->
    <script src="../../plugins/autosize/autosize.js"></script>
    <!-- Jquery DataTable Plugin Js -->
    <script src="../../plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="../../plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="../../plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="../../plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <!-- Custom Js -->
    <script src="../../js/admin.js"></script>
    <script src="../../js/pages/tables/jquery-datatable.js"></script>
    <script src="../../js/pages/forms/basic-form-elements.js"></script>
    <!-- Demo Js -->
    <script src="../../js/demo.js"></script>
</body>

</html>
