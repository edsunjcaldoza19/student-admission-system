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
                <h1>ADD ACCOUNT</h1>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h3>ACCOUNT DETAILS</h3>
                            <p>Please fill in the required fields to create an account. </p>
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
                            <form action="be/account_staff/add.php" method="POST" enctype="multipart/form-data">
                                <h3>Account Information</h3>
                                <div class="form-group">
                                    <small>Provide username and password for your account information. This will be used to login to the system.</small>
                                </div>
                                <fieldset>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="username" required>
                                            <label class="form-label">Username*</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="password" class="form-control" name="password" id="password" required>
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
                                            <input type="text" name="title" class="form-control" required>
                                            <label class="form-label">Title*</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" name="firstName" class="form-control" required>
                                            <label class="form-label">First Name*</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" name="middleName" class="form-control" required>
                                            <label class="form-label">Middle Name*</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" name="lastName" class="form-control" required>
                                            <label class="form-label">Last Name*</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="email" name="email" class="form-control" required>
                                            <label class="form-label">Email*</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <textarea name="address" cols="30" rows="3" class="form-control no-resize" required></textarea>
                                            <label class="form-label">Address*</label>
                                        </div>
                                    </div>
                                </fieldset>
                                <div class="form-group">
                                    <label>
                                        Please upload the picture of the employee.
                                    </label>
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
                                    <div class="col-md-12">
                                        <img id="preview" width="350px" height="350px" style="border: 2px solid;"/>
                                    </div>
                                </div>
                                <h3>Terms & Conditions - Finish</h3>
                                <fieldset>
                                    <input id="acceptTerms-2" name="acceptTerms" type="checkbox" required>
                                    <label for="acceptTerms-2">I agree with the Terms and Conditions.</label>
                                </fieldset>
                                <div class="form-group">
                                    <button type="submit" class="btn bg-green btn-lg" name="submit">Submit</button>
                                    <a href="account_admission_officer.php" class="btn bg-blue btn-lg">Cancel</a>
                                </div>
                            </form>
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
    <script src="../../plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="../../plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="../../plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="../../plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="../../plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
    <!-- Custom Js -->
    <script src="../../js/admin.js"></script>
    <script src="../../js/pages/tables/jquery-datatable.js"></script>
    <script src="../../js/pages/forms/basic-form-elements.js"></script>
    <!-- Demo Js -->
    <script src="../../js/demo.js"></script>
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

</html>
