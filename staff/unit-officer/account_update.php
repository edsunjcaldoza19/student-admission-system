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
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <p class="table-subheader">Update Interviewer Account</p>
                            <small>Update settings for this account</small>
                        </div>
                        <div class="body">
                        <?php
                            $updateID = $_GET['id'];
                            require 'be/database/db_pdo.php';
                            $update = $conn->prepare("SELECT * FROM tbl_account_staff WHERE `id` = '$updateID'");
                            $update->execute();
                            while($fetchaccount = $update->fetch()){
                        ?>
                            <form action="be/account_staff/update.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="staff_id" value="<?php echo $staff_id?>">
                                <input type="hidden" name="staff_username" value="<?php echo $username?>">
                                <p class="table-subheader">Profile Picture</p>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php
                                                $image = (!empty($fetchaccount['staff_profile_img'])) ? '../../images/staff-img/'.$fetchaccount['staff_profile_img'] : '../../images/staff-img/default.png';
                                            ?>
                                            <div class="col-md-12">
                                                <img src="<?php echo $image; ?>" id="preview" width="120px" height="120px" style="border-radius: 100%;"/>
                                            </div>
                                        </div>
                                        <p style="display: inline-block; position: absolute; right: 35px; top: 30px; font-size: 12px; overflow-wrap: break-word; text-align: right; font-weight: 600;">A preview of the selected image will be shown here</p>
                                        <p style="display: inline-block; position: absolute; right: 40px; top: 50px; font-size: 12px; overflow-wrap: break-word; text-align: right;">An image with a 1x1 ratio (square) is recommended</p>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>
                                                Account Profile Picture:
                                            </label>
                                            <!-- Load IMAGE filename -->
                                            <input type="hidden" name="oldImage" value="<?php echo $fetchaccount['staff_profile_img']; ?>">
                                            <!-- Basic file uploader -->
                                            <input type="file" name="image" class="form-control"
                                                    onchange="previewImage(event)">
                                        </div>
                                    </div>
                                </div>
                                <p class="table-subheader">Account Information</p>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="hidden" name="id" value="<?php echo $updateID ?>" >
                                        <div class="alert alert-danger" id="alertUsername" name="alertUsername" style="padding: 10px; display: none;">
                                        <i class="fa fa-times-circle"></i><p class="" style="display: inline-block; margin-left: 10px;">An account with a similar username already exists!</p>
                                        </div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="username" id="username" value="<?php echo $fetchaccount['staff_username'] ?>" required>
                                                <label class="form-label">Username*</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-float" id="unit">
                                            <div class="form-line">
                                                <select name="courseID" class="form-control">
                                                <?php
                                                    require 'be/database/db_pdo.php';
                                                    $program_id = $_SESSION['staff_unit'];
                                                    $sqlCourse = $conn->prepare("SELECT * FROM `tbl_course` WHERE `unit_id` = $program_id");
                                                    $sqlCourse->execute();
                                                        while($fetchCourse = $sqlCourse->fetch()){
                                                ?>
                                                    <option name="courseID" value="<?php echo $fetchCourse['course_id']?>">
                                                    <?php echo $fetchCourse['course_name'] ?></option>
                                                <?php
                                                    }
                                                ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p style="font-size: 20px;">Personal Information</p>
                                <div class="row" style="margin-top: 15px;">
                                    <div class="col-md-6">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <select name="title" class="form-control" required>
                                                    <option disabled selected>Honorific*</option>
                                                    <option value="Mr." <?php if($fetchaccount['staff_title'] == 'Mr.') echo 'selected'?>>Mr.</option>
                                                    <option value="Mrs." <?php if($fetchaccount['staff_title'] == 'Mrs.') echo 'selected'?>>Mrs.</option>
                                                    <option value="Prof." <?php if($fetchaccount['staff_title'] == 'Prof.') echo 'selected'?>>Prof.</option>
                                                    <option value="Dr." <?php if($fetchaccount['staff_title'] == 'Dr.') echo 'selected'?>>Dr.</option>
                                                    <option value="Engr." <?php if($fetchaccount['staff_title'] == 'Engr.') echo 'selected'?>>Engr.</option>
                                                </select>
                                            </div>  
                                        </div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" name="firstName" class="form-control" value="<?php echo $fetchaccount['staff_first_name'] ?>" required>
                                                <label class="form-label">First Name*</label>
                                            </div>
                                        </div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" name="middleName" class="form-control" value="<?php echo $fetchaccount['staff_middle_name'] ?>">
                                                <label class="form-label">Middle Name</label>
                                            </div>
                                        </div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" name="lastName" class="form-control" value="<?php echo $fetchaccount['staff_last_name'] ?>" required>
                                                <label class="form-label">Last Name*</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="alert alert-danger" id="alertEmail" name="alertEmail" style="padding: 10px; display: none;">
                                            <i class="fa fa-times-circle"></i><p class="" style="display: inline-block; margin-left: 10px;">An account with a similar email already exists!</p>
                                        </div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="email" name="email" id="email" class="form-control" value="<?php echo $fetchaccount['staff_email'] ?>" required>
                                                <label class="form-label">Email*</label>
                                            </div>
                                        </div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input name="contact" cols="30" rows="3" class="form-control no-resize" value="<?php echo $fetchaccount['staff_contact'] ?>" required>
                                                <label class="form-label">Contact Number*</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                                <div class="form-group">
                                    <button type="submit" class="btn bg-green waves-effect" name="update" id="submit">
                                        <i class="material-icons">save</i>
                                        <span>Save Changes and Exit</span>
                                    </button>
                                </div> 
                            </form>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Advanced Form Example With Validation -->
        </div>
    </section>

    <?php
        include 'includes/logout_modal.php';
        include 'includes/scripts.php';
    ?>
     <script>
        var previewImage = function(event){
            var output = document.getElementById("preview");
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function(){
                URL.revokeObjectURL(output.src)
            }
        }
    </script>
</body>
<!-- ADDITIONAL JAVASCRIPT FOR THIS PAGE (ACADEMIC YEAR) -->
    <!-- Autosize Plugin Js -->
    <script src="../../plugins/autosize/autosize.js"></script>
    <!-- Jquery DataTable Plugin Js -->
    <script src="../../plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="../../plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="../../plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="../../plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="../../plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="../../plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="../../plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="../../plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="../../plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
    <!-- Custom Js -->
    <script src="../../js/admin.js"></script>
    <script src="../../js/pages/tables/jquery-datatable.js"></script>
    <script src="../../js/pages/forms/advanced-form-elements.js"></script>
    <!-- Demo Js -->
    <script src="../../js/demo.js"></script>
</html>
