<?php
    include 'includes/session.php';
    include 'includes/header.php';
    ?>
    <!-- JQuery DataTable Css -->
    <link href="../../plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
    <?php
    include 'includes/topbar.php';
    include 'includes/left_sidebar.php';
?>
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <p class="page-header">Configure Academic Units</p>
                <p class="page-subheader">Set configurations for available academic units</p>
            </div>
            <div class="row clearfix jsdemo-notification-button">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <p class="table-subheader">Academic Unit Overview</p>
                            <button type="button" class="btn bg-green waves-effect"  href="#" data-toggle="modal" data-target="#addModal">
                                <i class="material-icons">add</i>
                                <span>New Academic Unit</span>
                            </button>
                        </div>
                        <div class="body">
                            <div class="table">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Unit Name</th>
                                            <th>Description</th>
                                            <th>College</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- populate table with db data -->
                                        <?php
                                            require 'be/database/db_pdo.php';
                                            $sql = $conn->prepare("SELECT *, tbl_unit.id FROM tbl_unit
                                            LEFT JOIN tbl_department ON tbl_department.id=tbl_unit.unit_dept_id");
                                            $sql->execute();

                                            while($fetch = $sql->fetch()){
                                        ?>
                                        <tr>
                                            <td><?php echo $fetch['unit_name']?></td>
                                            <td><?php echo $fetch['unit_desc']?></td>
                                            <td><?php echo $fetch['dept_name']?></td>
                                            <td style="text-align: center; width: 200px;">
                                                <button class="btn bg-light-blue btn-circle waves-effect waves-circle waves-float" data-toggle="modal" data-target="#update<?php echo $fetch['id']?>"><i class="material-icons">edit</i></button>
                                                <button class="btn bg-red btn-circle waves-effect waves-circle waves-float" data-toggle="modal" data-target="#delete<?php echo $fetch['id']?>" id="btnDelete"><i class="material-icons">delete</i></button>
                                            </td>
                                        </tr>

                                        <?php
                                            include 'be/unit/deleteModal.php';
                                            include 'be/unit/updateModal.php';
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           <?php include 'be/unit/addModal.php';?>
        </div>
    </section>

 <?php
        include 'includes/logout_modal.php';
        include 'includes/scripts.php';
    ?>
    <!-- ADDITIONAL JAVASCRIPT FOR THIS PAGE (ACADEMIC YEAR) -->
    <!-- Autosize Plugin Js -->
    <script src="../../plugins/autosize/autosize.js"></script>
    <!-- Moment Plugin Js -->
    <script src="../../plugins/momentjs/moment.js"></script>
    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="../../plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
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
