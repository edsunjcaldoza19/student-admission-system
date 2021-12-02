<?php
    include 'includes/session.php';
    include 'includes/header.php';
    include 'includes/topbar.php';
    include 'includes/left_sidebar.php';

    //Fetch academic unit

    $sql1 = $conn->prepare("SELECT * from `tbl_unit` WHERE `id` = $unitId");
    $sql1->execute();
    $fetch1 = $sql1->fetch();
?>

    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="block-header">
                        <p class="page-header">Manage Unit Interviewer Accounts</p>
                        <p class="page-subheader">Manage and control register unit interviewer accounts</p>
                    </div>
                    <div class="card">
                        <div class="header">
                            <p class="table-subheader">Unit Interviewer Accounts Overview</p>
                            <p><?php echo $fetch1['unit_name']?></p>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Profile Picture</th>
                                            <th>Interviewer Name</th>
                                            <th>Contact Number</th>
                                            <th>Email</th>
                                            <th>Program</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- populate table with db data -->
                                        <?php
                                            require 'be/database/db_pdo.php';
                                            $sql = $conn->prepare("SELECT *, tbl_account_staff.id FROM `tbl_account_staff`
                                            LEFT JOIN tbl_course ON tbl_course.course_id=tbl_account_staff.staff_program
                                            LEFT JOIN tbl_unit ON tbl_unit.id=tbl_course.unit_id
                                            WHERE `staff_role` = '4'");
                                            $sql->execute();
                                            while($fetch = $sql->fetch()){
                                        ?>
                                        <tr>
                                            <?php
                                                $image = (!empty($fetch['staff_profile_img'])) ? '../../images/staff-img/'.$fetch['staff_profile_img'] : '../../images/staff-img/default.png';
                                            ?>
                                            <td style="text-align: center; width: 100px;"><img src="<?php echo $image; ?>" class="staff-img" style="border-radius: 100%;"  alt="Card image cap" width="50px" height="50px">
                                            </td>
                                            <td>
                                            <?php
                                                echo $fetch['staff_first_name'].' '.$fetch['staff_middle_name'].' '.$fetch['staff_last_name'];
                                            ?>
                                            </td>
                                            <td><?php echo $fetch['staff_contact']?></td>
                                            <td><?php echo $fetch['staff_email']; ?></td>
                                            <td><?php echo $fetch['course_acronym']; ?></td>
                                            <td style="text-align: center; width: 100px; vertical-align: middle;">
                                                <a class="btn bg-light-blue btn-circle waves-effect waves-circle waves-float" href="account_update.php?id=<?php echo $fetch['id']; ?>"><i class="material-icons">edit</i></a>
                                                <button class="btn bg-red btn-circle waves-effect waves-circle waves-float" data-toggle="modal" data-target="#delete<?php echo $fetch['id']?>" id="btnDelete"><i class="material-icons">delete</i></button>
                                            </td>
                                        </tr>
                                        <?php
                                            include 'be/account_staff/deleteModal.php';
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
</html>
