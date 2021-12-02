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
                <p class="page-header">Configure Programs</p>
                <p class="page-subheader">Set configurations for offered programs</p>
            </div>
            <div class="row clearfix jsdemo-notification-button">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <p class="table-subheader">Programs Offered</p>
                            <button type="button" class="btn bg-green waves-effect"  href="#" data-toggle="modal" data-target="#addModal">
                                <i class="material-icons">add</i>
                                <span>New Program Offering</span>
                            </button>
                        </div>
                        <div class="body">
                            <div class="table">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Program Name</th>
                                            <th>Program Acronym</th>
                                            <th>Academic Unit</th>
                                            <th>College</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- populate table with db data -->
                                        <?php
                                            require 'be/database/db_pdo.php';
                                            $sql = $conn->prepare("SELECT *, tbl_course.course_id FROM tbl_course
                                            LEFT JOIN tbl_unit ON tbl_unit.id=tbl_course.unit_id
                                            LEFT JOIN tbl_department ON tbl_department.id=tbl_unit.unit_dept_id");
                                            $sql->execute();

                                            while($fetch = $sql->fetch()){
                                        ?>
                                        <tr>
                                            <td><?php echo $fetch['course_name']?></td>
                                            <td><?php echo $fetch['course_acronym']?></td>
                                            <td><?php echo $fetch['unit_name']?></td>
                                            <td><?php echo $fetch['dept_name']?></td>
                                            <td style="text-align: center; width: 100px;">
                                                <button class="btn bg-light-blue btn-circle waves-effect waves-circle waves-float" data-toggle="modal" data-target="#update<?php echo $fetch['course_id']?>"><i class="material-icons">edit</i></button>
                                                 <button class="btn bg-red btn-circle waves-effect waves-circle waves-float" data-toggle="modal" data-target="#delete<?php echo $fetch['course_id']?>" id="btnDelete"><i class="material-icons">delete</i></button>
                                            </td>
                                        </tr>
                                        <?php
                                            include 'be/program/updateModal.php';
                                            include 'be/program/deleteModal.php';
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           <?php include 'be/program/addModal.php';?>
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
