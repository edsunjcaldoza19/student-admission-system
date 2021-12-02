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
            <p class="page-header">Configure Academic Year</p>
            <p class="page-subheader">Set configurations for academic year</p>
            </div>
            <div class="row clearfix jsdemo-notification-button">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <p class="table-subheader">Academic Year Overview</p>
                            <button type="button" class="btn bg-green waves-effect"  href="#" data-toggle="modal" data-target="#addModal">
                                <i class="material-icons">add</i>
                                <span>Add Academic Year</span>
                            </button>
                        </div>
                        <div class="body">
                            <div class="table">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Academic Year</th>
                                            <th>Result Available</th>
                                            <!-- <th>Enable Exam</th> -->
                                            <th>Status</th>
                                            <th style="width: 5%;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- populate table with db data -->
                                        <?php
                                            require 'be/database/db_pdo.php';
                                            $sql = $conn->prepare("SELECT * FROM `tbl_academic_year`");
                                            $sql->execute();

                                            while($fetch = $sql->fetch()){
                                        ?>
                                        <tr>
                                            <td><?php echo $fetch['ay_year']?></td>
                                            <!-- <td style="width: 200px;" align="center">
                                                <?php
                                                    if($fetch['enable_exam'] == 0){
                                                        echo '<p class="label-red">Disabled</p>';
                                                    }else{
                                                        echo '<p class="label-green">Enabled</p>';
                                                    }
                                                ?>
                                            </td> -->
                                            <td style="width: 200px;" align="center">
                                            <?php
                                                    if($fetch['result_available'] == 0){
                                                        echo '<p class="label-red">Disabled</p>';
                                                    }else{
                                                        echo '<p class="label-green">Enabled</p>';
                                                    }
                                                ?>
                                            </td>
                                            <td style="width: 200px;" align="center">
                                                <?php
                                                    if($fetch['ay_status'] == 0){
                                                        echo '<p class="label-red">Inactive</p>';
                                                    }else{
                                                        echo '<p class="label-green">Active</p>';
                                                    }
                                                ?>
                                            </td>
                                            <td style="text-align: center; width: 200px;">
                                                <button class="btn bg-light-blue btn-circle waves-effect waves-circle waves-float" data-toggle="modal" data-target="#update<?php echo $fetch['id']?>"><i class="material-icons">edit</i></button>
                                            </td>
                                        </tr>

                                        <?php
                                            include 'be/academic_year/updateModal.php';
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
    <script src="../../js/pages/forms/basic-form-elements.js"></script>
    <!-- Demo Js -->
    <script src="../../js/demo.js"></script>
</body>

</html>
