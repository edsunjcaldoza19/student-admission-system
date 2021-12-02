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
                            <h1>UPDATE ACCOUNT</h1>
                            <p>Please fill in the required fields to update the account. </p>
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

                        <?php
                            $updateID = $_GET['id'];
                            require 'be/database/db_pdo.php';
                            $update = $conn->prepare("SELECT * FROM tbl_account_staff WHERE `id` = '$updateID'");
                            $update->execute();
                            while($fetchaccount = $update->fetch()){
                        ?>
                            <form action="be/account_staff/update.php" method="POST" enctype="multipart/form-data">
                                <h3>Account Information</h3>
                                <fieldset>
                                    <input type="hidden" value="<?php echo $fetchaccount['id']; ?>" name="id">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="username"
                                            value="<?php echo $fetchaccount['staff_username']; ?>" required>
                                            <label class="form-label">Username*</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="password" class="form-control" name="password" id="password"
                                            value="<?php echo $fetchaccount['staff_password']; ?>" required>
                                            <label class="form-label">Password*</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="password" class="form-control" name="confirm" required>
                                            <label class="form-label">Confirm Password*</label>
                                        </div>
                                    </div>
                                    <div class="form-group" id="">
                                    <p>Role</p>
                                        <select id="role" name="role" class="form-control show-tick">
                                            <option disabled>Select Role</option>
                                            <option value="1">Admission Officer</option>
                                            <option value="2">Exam Officer</option>
                                            <option value="3">Unit Head</option>
                                        </select>
                                    </div>
                                    <div class="form-group" id="unitID">
                                    <p id="unitLabel">Program</p>
                                    <select name="unitID" class="form-control">
                                        <?php
                                            require 'be/database/db_pdo.php';
                                            $sqlCourse = $conn->prepare("SELECT * FROM `tbl_unit`");
                                            $sqlCourse->execute();
                                            while($fetchCourse = $sqlCourse->fetch()){
                                        ?>
                                            <option name="unitID" value="<?php echo $fetchCourse['id']?>">
                                            <?php echo $fetchCourse['unit_name'] ?></option>
                                        <?php
                                            }
                                    ?>
                                    </select>
                                    </div>
                                </fieldset>
                                <h3>Profile Information</h3>
                                <fieldset>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" name="title" class="form-control"
                                            value="<?php echo $fetchaccount['staff_title']; ?>" required>
                                            <label class="form-label">Title*</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" name="firstName" class="form-control"
                                            value="<?php echo $fetchaccount['staff_first_name']; ?>" required>
                                            <label class="form-label">First Name*</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" name="middleName" class="form-control"
                                            value="<?php echo $fetchaccount['staff_middle_name']; ?>" required>
                                            <label class="form-label">Middle Name*</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" name="lastName" class="form-control"
                                            value="<?php echo $fetchaccount['staff_last_name']; ?>" required>
                                            <label class="form-label">Last Name*</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="email" name="email" class="form-control"
                                            value="<?php echo $fetchaccount['staff_email']; ?>" required>
                                            <label class="form-label">Email*</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <textarea name="address" cols="30" rows="3" class="form-control no-resize" required><?php echo $fetchaccount['staff_address']; ?></textarea>
                                            <label class="form-label">Address*</label>
                                        </div>
                                    </div>
                                </fieldset>
                                <div class="form-group">
                                    <label>
                                        Please upload the picture of the employee.
                                    </label>
                                    <!-- Load IMAGE filename -->
                                    <input type="hidden" name="oldImage" value="<?php echo $fetchaccount['staff_profile_img']; ?>">
                                    <!-- Basic file uploader -->
                                    <input type="file" name="image" class="form-control"
                                            onchange="previewImage(event)">
                                </div>
                                <div class="form-group">
                                    Image uploaded will be previewed here.
                                    Please select an image with same width and
                                    height ratio.
                                </div>
                                <div class="form-group">
                                        <?php
                                            $image = (!empty($fetchaccount['staff_profile_img'])) ? '../../images/staff-img/'.$fetchaccount['staff_profile_img'] : '../../images/staff-img/default.png';
                                        ?>
                                    <div class="col-md-12">
                                        <img src="<?php echo $image; ?>" id="preview" width="300px" height="300px" style="border: 2px solid;"/>
                                    </div>
                                </div>
                                <h3>Terms & Conditions - Finish</h3>
                                <fieldset>
                                    <input id="acceptTerms-2" name="acceptTerms" type="checkbox" required>
                                    <label for="acceptTerms-2">I agree with the Terms and Conditions.</label>
                                </fieldset>
                                <div class="form-group">
                                    <button type="submit" class="btn bg-green btn-lg" name="update">Update</button>
                                    <a href="account_admission_officer.php" class="btn bg-blue btn-lg">Cancel</a>
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
        document.getElementById("unitID").hidden=true;
            document.getElementById("unitLabel").hidden=true;
            document.getElementById("role").onchange=function(){
                if(this.options[this.selectedIndex].value==1){
                    document.getElementById("unitID").hidden=true;
                    document.getElementById("unitLabel").hidden=true;
                }
                else if(this.options[this.selectedIndex].value==2){
                    document.getElementById("unitID").hidden=true;
                    document.getElementById("unitLabel").hidden=true;
                }
                else if(this.options[this.selectedIndex].value==3){
                    document.getElementById("unitID").hidden=false;
                    document.getElementById("unitLabel").hidden=false;
                }
            }
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
