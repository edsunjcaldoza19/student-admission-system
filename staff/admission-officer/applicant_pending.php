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

            //Fetch academic year//

            $id = $_GET['sy_id'];

            $sql1 = $conn->prepare("SELECT * from `tbl_academic_year` WHERE `id` = $id");
            $sql1->execute();
            $fetch1 = $sql1->fetch();
            
        ?>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="block-header">
                        <p class="page-header">Pending Student Applications</p>
                        <p class="page-subheader">Perform preliminary evaluation of student applications</p>
                    </div>
                    <div class="card">
                        <div class="header">
                            <p class="table-subheader">Pending Applications List (A.Y. <?php echo $fetch1['ay_year']?>)</p>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>Applicant Name</th>
                                            <th>Entry Type</th>
                                            <th>Semester</th>
                                            <th>First Choice</th>
                                            <th>Second Choice</th>
                                            <th>Application Form Status</th>
                                            <th>Review</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- populate table with db data -->
                                        <?php
                                            $sy_id = $_GET['sy_id'];
                                            require 'be/database/db_pdo.php';
                                            $sql = $conn->prepare("SELECT *, tbl_applicant.id FROM tbl_applicant
                                            LEFT JOIN tbl_applicant_account ON tbl_applicant_account.id = tbl_applicant.applicant_account_id
                                            WHERE `form_status`='Pending' AND `school_year_id` = $sy_id");
                                            $sql->execute();

                                            while($fetch = $sql->fetch()){

                                                //fetch first and second choice

                                                $firstChoice = $fetch['program_first_choice'];
                                                $secondChoice = $fetch['program_second_choice'];

                                                $sql1 = $conn->prepare("SELECT * FROM `tbl_course` WHERE `course_id` = '$firstChoice'");
                                                $sql1->execute();

                                                $sql2 = $conn->prepare("SELECT * FROM `tbl_course` WHERE `course_id` = '$secondChoice'");
                                                $sql2->execute();

                                                while($fetch1 = $sql1->fetch()){
                                                    while($fetch2 = $sql2->fetch()){
                                        ?>
                                        <tr>
                                            <td>
                                                <?php
                                                    echo $fetch['last_name'].', '.$fetch['first_name'].' '.$fetch['middle_name'];
                                                ?>       
                                            </td>
                                            <td><?php echo $fetch['entry']; ?></td>
                                            <td><?php echo $fetch['semester']; ?></td>
                                            <td>
                                                <?php
                                                    echo $fetch1['course_name'].' ('.$fetch1['course_acronym'].')';
                                                ?>  
                                            </td>
                                            <td>
                                                <?php
                                                    echo $fetch2['course_name'].' ('.$fetch2['course_acronym'].')';
                                                ?>    
                                            </td>
                                            <td align="center">
                                                <?php
                                                    if($fetch['form_status'] == "Pending"){
                                                        echo '<p class="label-blue">Pending</p>';
                                                    }else if($fetch['form_status'] == "Approved"){
                                                        echo '<p class="label-green">Approved</p>';
                                                    }else if($fetch['form_status'] == "Disapproved"){
                                                        echo '<p class="label-red">Disapproved</p>';
                                                    }
                                                ?>
                                            </td>
                                            <td align="center">
                                                <a href="applicant_review.php?id=<?php echo $fetch['id'];?>&sy_id=<?php echo $sy_id; ?>" type="button" class="btn bg-light-blue btn-circle waves-effect waves-circle waves-float">
                                                    <i class="material-icons">launch</i>
                                                </a>
                                            </td>
                                            <?php
                                                    }
                                                }
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
             <div class="modal fade" id="addModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action = "../../be/course/add.php" method="POST" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Add Course Information</h4>
                        </div>
                        <div class="modal-body">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">person</i>
                                </span>
                                <div class="form-line">
                                    <input type="text" class="form-control" name="name" placeholder="Course Name" required autofocus>
                                </div>
                            </div>
                             <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">person</i>
                                </span>
                                <div class="form-line">
                                    <input type="text" class="form-control" name="acronym" placeholder="Acronym" required autofocus>
                                </div>
                            </div>
                             <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">person</i>
                                </span>
                                <div class="form-line">
                                <select class="form-control" style="margin-top: 10px;" name="deptId" id="deptId">
                                    <option selected="true" disabled="true">Department</option>
                                    <?php
                                        require 'be/database/db_pdo.php';
                                        $sql = $conn->prepare("SELECT * FROM `tbl_department`");
                                        $sql->execute();

                                        while($fetch = $sql->fetch()){
                                    ?>
                                    <option name="deptId" value="<?php echo $fetch['id'] ?>"><?php echo $fetch['dept_name'] ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-link waves-effect" name="add" id="add">SAVE CHANGES</button>
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Logout Modal -->
    <?php
        include 'includes/logout_modal.php';
        include 'includes/scripts.php';
    ?>
</body>

</html>
