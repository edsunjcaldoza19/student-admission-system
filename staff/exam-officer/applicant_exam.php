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
        ?>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
            <h1>APPLICANT EXAM RESULT</h1>
            </div>
            <div class="row clearfix jsdemo-notification-button">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h3>APPLICANT SCORE</h3>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Acronym</th>
                                            <th style="width: 5%;">Update</th>
                                            <th style="width: 5%;">Delete</th>
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
                                            <td style="text-align: center;">
                                                <button class="btn bg-teal btn-circle waves-effect waves-circle waves-float" data-toggle="modal" data-target="#update<?php echo $fetch['id']?>"><i class="material-icons">edit</i></button>
                                            </td>
                                            <td style="text-align: center;">
                                                <button class="btn bg-red btn-circle waves-effect waves-circle waves-float" data-toggle="modal" data-target="#delete<?php echo $fetch['id']?>" id="btnDelete"><i class="material-icons">delete</i></button>
                                            </td>

                                        </tr>

                                        <?php
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
</body>


<!-- Autosize Plugin Js -->
<script src="../../plugins/autosize/autosize.js"></script>

<!-- Moment Plugin Js -->
<script src="../../plugins/momentjs/moment.js"></script>

<!-- Bootstrap Material Datetime Picker Plugin Js -->
<script src="../../plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

<script>
    $(document).ready(function(){
        $('#exam_start_sched').bootstrapMaterialDatePicker({
            format: 'YYYY-MM-DD HH:mm'
        });
        $('#exam_end_sched').bootstrapMaterialDatePicker({
            format: 'YYYY-MM-DD HH:mm'
        });

        $.material.init();
    });
</script>

<!-- Custom Js -->
<script src="../../js/pages/forms/basic-form-elements.js"></script>


</html>
