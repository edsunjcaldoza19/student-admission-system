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
                <p class="page-header">Add Staff Account</p>
                <p class="page-subheader">Create new account for staffs using the system</p>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <p class="table-subheader">Account Credentials</p>
                            <small>Basic account credentials for the staff account</small>
                        </div>
                        <div class="body">
                            <form action="be/account_staff/add.php" method="POST" enctype="multipart/form-data">        
                                <div class="row">
                                    <input class="hidden" name="staff_id" value="<?php echo $staff_id?>">
                                    <input class="hidden" name="staff_username" value="<?php echo $username?>">
                                    <div class="col-md-6">
                                        <div class="alert alert-danger" id="alertUsername" name="alertUsername" style="padding: 10px; display: none;">
                                        <i class="fa fa-times-circle"></i><p class="" style="display: inline-block; margin-left: 10px;">An account with a similar username already exists!</p>
                                        </div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="username" id="username" required>
                                                <label class="form-label">Username*</label>
                                            </div>
                                        </div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <select id="role" name="role" class="form-control show-tick" required>
                                                    <option disabled selected>Account Type*</option>
                                                    <option value="1">Admission Officer</option>
                                                    <option value="2">Exam Officer</option>
                                                    <option value="3">Unit Head</option>
                                                </select>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-float" id="unit">
                                            <div class="form-line">
                                                <select name="unitID" id="unitID" class="form-control" required>
                                                    <option disabled selected>Academic Unit (for Unit Heads only)*</option>
                                                    <?php
                                                        require 'be/database/db_pdo.php';
                                                        $sqlCourse = $conn->prepare("SELECT * FROM `tbl_unit`");
                                                        $sqlCourse->execute();
                                                        while($fetchCourse = $sqlCourse->fetch()){
                                                    ?>
                                                        <option name="unitID" value="<?php echo $fetchCourse['id']?>">
                                                            <?php echo $fetchCourse['unit_name'] ?>        
                                                        </option>
                                                    <?php
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                <p style="font-size: 20px;">Personal Information</p>
                                <small>Additional information about this account</small>
                                <div class="row" style="margin-top: 15px;">
                                    <div class="col-md-6">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <select name="title" class="form-control" required>
                                                    <option disabled selected>Honorific*</option>
                                                    <option value="Mr.">Mr.</option>
                                                    <option value="Mrs.">Mrs.</option>
                                                    <option value="Mrs.">Ms.</option>
                                                    <option value="Prof.">Prof.</option>
                                                    <option value="Dr.">Dr.</option>
                                                    <option value="Engr.">Engr.</option>
                                                </select>
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
                                                <input type="text" name="middleName" class="form-control">
                                                <label class="form-label">Middle Name</label>
                                            </div>
                                        </div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" name="lastName" class="form-control" required>
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
                                                <input type="email" name="email" id="email" class="form-control" required>
                                                <label class="form-label">Email*</label>
                                            </div>
                                        </div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input name="contact" cols="30" rows="3" class="form-control no-resize" required>
                                                <label class="form-label">Contact Number*</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>           
                                <div class="form-group">
                                    <button type="submit" class="btn bg-green waves-effect" name="submit" id="submit">
                                        <i class="material-icons">add</i>
                                        <span>Add Account</span>
                                    </button>
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

        document.getElementById("unit").hidden=true;
        document.getElementById("role").onchange=function(){
            if(this.options[this.selectedIndex].value==1){
                document.getElementById("unit").hidden=true;
            }
            else if(this.options[this.selectedIndex].value==2){
                document.getElementById("unit").hidden=true;
            }
            else if(this.options[this.selectedIndex].value==3){
                document.getElementById("unit").hidden=false;
            }
        }

        //Validate add administrator account

        document.getElementById("username").addEventListener("keyup", checkUsername);
        document.getElementById("email").addEventListener("keyup", checkEmail);

        function checkUsername(){

            var username = $('#username').val();

            $.post("be/account_staff/check_staff_account.php", { "username": username }, function(response){

                if(response == 1){

                    $('#alertUsername').css('display', 'block');
                    $('#submit').attr("disabled", true);

                }else{

                    $('#alertUsername').css('display', 'none');
                    $('#submit').attr("disabled", false);

                }

            });

        }

        function checkEmail(){

            var email = $('#email').val();

            $.post("be/account_staff/check_staff_account.php", { "email": email }, function(response){

                if(response == 1){

                    $('#alertEmail').css('display', 'block');
                    $('#submit').attr("disabled", true);

                }else{

                    $('#alertEmail').css('display', 'none');
                    $('#submit').attr("disabled", false);

                }

            });

        }
        
    </script>
</body>

</html>
