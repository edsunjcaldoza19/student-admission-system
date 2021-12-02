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
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="block-header">
                        <p class="page-header">Enable/Disable Examination</p>
                        <p class="page-subheader">Enable or disable online examination for this academic year</p>
                    </div>
                    <div class="card">
                        <div class="header">
                            <p class="table-subheader">Toggle Entrance Examination</p>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Active Academic Year</th>
                                            <th>Examination Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- populate table with db data -->
                                        <?php
                                            require 'be/database/db_pdo.php';
                                            $sql = $conn->prepare("SELECT * FROM `tbl_academic_year` WHERE `ay_status` = 1");
                                            $sql->execute();

                                            while($fetch = $sql->fetch()){
                                        ?>
                                            <td><?php echo $fetch['ay_year'];?></td>
                                            <td align="center">
                                                <?php
                                                    if($fetch['enable_exam'] == 0){
                                                        echo '<p class="label-red">Disabled</p>';
                                                    }else if($fetch['enable_exam'] == 1){
                                                        echo '<p class="label-green">Enabled</p>';
                                                    }
                                                ?>
                                            </td>
                                            <td align="center">
                                                <button class="btn bg-light-blue btn-circle waves-effect waves-circle waves-float" data-toggle="modal" data-target="#toggle<?php echo $fetch['id']?>"><i class="material-icons">edit</i></button>
                                            </td>
                                        <?php 
                                            include 'be/entrance_examination/toggleModal.php';
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
             <?php include 'be/entrance_examination/addExaminationModal.php'; ?>
        </div>
    </section>
    <?php
        include 'includes/logout_modal.php';
        include 'includes/scripts.php';
    ?>
</body>


<!-- Autosize Plugin Js -->
<script src="../../plugins/autosize/autosize.js"></script>

<!-- Custom Js -->
<script src="../../js/pages/forms/basic-form-elements.js"></script>


</html>
