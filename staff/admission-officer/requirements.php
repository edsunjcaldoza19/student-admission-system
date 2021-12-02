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
                    <p class="page-header">Configure Admission Requirements</p>
                    <p class="page-subheader">Set the requirements for the admission</p>
                    </div>
                    <div class="card">
                        <div class="header">
                            <p class="table-subheader"></p>
                            <button type="button" class="btn bg-green waves-effect"  href="#" data-toggle="modal" data-target="#addModal">
                                <i class="material-icons">add</i>
                                <span>Add Requirement</span>
                            </button>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th style="width: 20%;">Requirement No.</th>
                                            <th>Requirement Description</th>
                                            <th style="width: 10%;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- populate table with db data -->
                                        <?php
                                            require 'be/database/db_pdo.php';
                                            $sql = $conn->prepare("SELECT * FROM tbl_requirements");
                                            $sql->execute();

                                            while($fetch = $sql->fetch()){
                                        ?>
                                        <tr>
                                            <td><?php echo $fetch['requirements_num']; ?></td>
                                            <td><?php echo $fetch['requirements_desc']; ?></td>
                                            <td style="text-align: center; width: 250px;">
                                                <button class="btn bg-light-blue btn-circle waves-effect waves-circle waves-float" data-toggle="modal" data-target="#update<?php echo $fetch['id']?>"><i class="material-icons">edit</i></button>
                                                <button class="btn bg-red btn-circle waves-effect waves-circle waves-float" data-toggle="modal" data-target="#delete<?php echo $fetch['id']?>" id="btnDelete"><i class="material-icons">delete</i></button>
                                            </td>
                                            <?php
                                            include 'be/requirement/deleteModal.php';
                                            include 'be/requirement/updateModal.php';
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
            <?php include 'be/requirement/addModal.php' ?>
        </div>
    </section>
    <?php include 'includes/logout_modal.php';?>
    <?php include 'includes/scripts.php';?>
</body>

</html>
