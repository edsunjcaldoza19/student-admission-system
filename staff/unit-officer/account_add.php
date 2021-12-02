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
                <p class="page-header">Add Unit Interviewer Account</p>
                <p class="page-subheader">Create new account for designated unit interviewers</p>
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
                                <input type="hidden" name="staff_id" value="<?php echo $staff_id?>">
                                <input type="hidden" name="staff_username" value="<?php echo $username?>">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="hidden" name="unitID" value="<?php echo $unitId?>">
                                        <div class="alert alert-danger" id="alertUsername" name="alertUsername" style="padding: 10px; display: none;">
                                            <i class="fa fa-times-circle"></i><p class="" style="display: inline-block; margin-left: 10px;">An account with a similar username already exists!</p>
                                        </div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="username" id="username" required>
                                                <label class="form-label">Username*</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-float" id="unit">
                                            <div class="form-line">
                                                <select name="courseID" id="courseID" class="form-control" required>
                                                    <option disabled selected>Program*</option>
                                                    <?php
                                                        require 'be/database/db_pdo.php';
                                                        $sqlCourse = $conn->prepare("SELECT * FROM `tbl_course` WHERE `unit_id` = $unitId");
                                                        $sqlCourse->execute();
                                                        while($fetchCourse = $sqlCourse->fetch()){
                                                    ?>
                                                        <option name="courseID" value="<?php echo $fetchCourse['course_id']?>">
                                                            <?php echo $fetchCourse['course_name'] ?>        
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
                                <fieldset>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <select name="title" class="form-control" required>
                                                <option disabled selected>Honorific*</option>
                                                <option value="Mr.">Mr.</option>
                                                <option value="Mrs.">Mrs.</option>
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
                                    <div class="alert alert-danger" id="alertEmail" name="alertEmail" style="padding: 10px; display: none;">
                                        <i class="fa fa-times-circle"></i><p class="" style="display: inline-block; margin-left: 10px;">An account with a similar username already exists!</p>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="email" name="email" id="email" class="form-control" required>
                                            <label class="form-label">Email Address*</label>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" name="contact" cols="30" rows="3" class="form-control" required></input>
                                            <label class="form-label">Contact Number*</label>
                                        </div>
                                    </div>
                                </fieldset>
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
    <!-- Custom Js -->
    <script src="../../js/admin.js"></script>
    <script src="../../js/pages/forms/basic-form-elements.js"></script>
    <!-- Demo Js -->
    <script src="../../js/demo.js"></script>
     <script>
        var previewImage = function(event){
            var output = document.getElementById("preview");
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function(){
                URL.revokeObjectURL(output.src)
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
