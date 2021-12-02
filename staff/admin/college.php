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
            <p class="page-header">Configure Colleges</p>
            <p class="page-subheader">Set configurations for university's collegiate departments</p>
            </div>
            <div class="row clearfix jsdemo-notification-button">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <p class="table-subheader">College Overview</p>
                            <button type="button" class="btn bg-green waves-effect"  href="#" data-toggle="modal" data-target="#addModal">
                            <i class="material-icons">add</i>
                                <span>Add New College</span>
                            </button>
                        </div>
                        <div class="body">
                            <div class="table">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>College Name</th>
                                            <th>Acronym</th>
                                            <th>Dean</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- populate table with db data -->
                                        <?php
                                            require 'be/database/db_pdo.php';
                                            $sql = $conn->prepare("SELECT * FROM `tbl_department`");
                                            $sql->execute();

                                            while($fetch = $sql->fetch()){
                                        ?>
                                        <tr>
                                            <td><?php echo $fetch['dept_name']?></td>
                                            <td><?php echo $fetch['dept_acronym']?></td>
                                            <td><?php echo $fetch['dept_dean']?></td>
                                            <td style="text-align: center; width: 200px;">
                                                <button class="btn bg-light-blue btn-circle waves-effect waves-circle waves-float" data-toggle="modal" data-target="#update<?php echo $fetch['id']?>"><i class="material-icons">edit</i></button>
                                                <button class="btn bg-red btn-circle waves-effect waves-circle waves-float" data-toggle="modal" data-target="#delete<?php echo $fetch['id']?>" id="btnDelete"><i class="material-icons">delete</i></button>
                                            </td>
                                        </tr>

                                        <?php
                                            include 'be/department/deleteModal.php';
                                            include 'be/department/updateModal.php';
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           <?php include 'be/department/addModal.php';?>
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
    <!-- Demo Js -->
    <script src="../../js/demo.js"></script>
</body>

</html>
