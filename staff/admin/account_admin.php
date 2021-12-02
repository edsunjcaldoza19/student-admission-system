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
    <!-- ## BODY CONTENTS ## -->
    <?php
        $id = $_SESSION['admin_id'];
        require 'be/database/db_pdo.php';
        $sql = $conn->prepare("SELECT * FROM `tbl_admin` where `id` = '$id'");
        $sql->execute();
        while($fetch = $sql->fetch()){
    ?>
    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-3">
                    <div class="card profile-card">
                        <div class="profile-header">&nbsp;</div>
                        <div class="profile-body">
                            <?php
                                require 'be/database/db_pdo.php';
                                $admin_id = $_SESSION['admin_id'];
                                $sql = $conn->prepare("SELECT * FROM `tbl_admin` WHERE `id` = $admin_id");
                                $sql->execute();
                                $fetch = $sql->fetch();
                                $image = (!empty($fetch['image'])) ? '../../images/staff-img/'.$fetch['staff_profile_img'] : '../../images/staff-img/default.png';
                            ?>
                            <div class="image-area">
                                <img src="<?php echo $image ?>" width="128px" height="128px" alt="AdminBSB - Profile Image" />
                            </div>
                            <div class="content-area">
                                <h3><?php echo $fetch['name'];?></h3>
                                <p>LNU SAIS V.1.0.0</p>
                                <p>Administrator</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-9">
                    <div class="card" style="height: 376px; overflow-y: auto;">
                        <div class="body">
                            <div>
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#profile_settings" aria-controls="settings" role="tab" data-toggle="tab">Profile Settings</a></li>
                                    <li role="presentation"><a href="#change_password_settings" aria-controls="settings" role="tab" data-toggle="tab">Change Password</a></li>
                                    <li role="presentation"><a href="#add_administrator_settings" aria-controls="settings" role="tab" data-toggle="tab">Add Administrator Account</a></li>
                                </ul>
                                <div class="tab-content">
                                    <!--- ## START PROFILE --->
                                    <div role="tabpanel" class="tab-pane fade in active" id="profile_settings">
                                        <form action="be/account_admin/update-info.php" method="post" class="form-horizontal">
                                            <div class="form-group">
                                                <label for="NameSurname" class="col-sm-2 control-label">Name</label>
                                                <div class="col-sm-10">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="name" name="name" placeholder="Name Surname" value="<?php echo $fetch['name'];?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="username" class="col-sm-2 control-label">Username</label>
                                                <div class="col-sm-10">
                                                    <input type="hidden" name="id" value="<?php echo $_SESSION['admin_id']?>">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="username" name="username" placeholder="username" value="<?php echo $fetch['username'];?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Email" class="col-sm-2 control-label">Email</label>
                                                <div class="col-sm-10">
                                                    <div class="form-line">
                                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $fetch['email'];?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr class="default-divider ml-auto">
                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <button type="submit" name="submit" class="btn bg-green waves-effect">
                                                        <i class="material-icons">save</i>
                                                        <span>Save Changes</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!--- ## END PROFILE --->
                                    <!--- ## START CHANGE PASSWORD --->
                                    <div role="tabpanel" class="tab-pane fade in" id="change_password_settings">
                                        <form action="be/account_admin/update-password.php" method="post" class="form-horizontal">
                                            <div class="alert alert-danger" id="alertMessage" name="alertMessage" style="padding: 10px; display: none;">
                                                <i class="fa fa-times-circle"></i><p class="" style="display: inline-block; margin-left: 10px;">The old password is incorrect!</p>
                                            </div>
                                            <div class="form-group">
                                                <input class="hidden" name="staff_username" value="<?php echo $username?>">
                                                <label for="OldPassword" class="col-sm-3 control-label">Old Password</label>
                                                <div class="col-sm-9">
                                                    <input type="hidden" name="adminId" id="id" value="<?php echo $id?>">
                                                    <div class="form-line">
                                                        <input type="password" class="form-control" id="oldPassword" name="oldPassword" placeholder="Old Password" required>
                                                        <span toggle="#oldPassword" class="fa fa-eye form-toggle-password"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="NewPassword" class="col-sm-3 control-label" id="newPasswordLabel">New Password</label>
                                                <div class="col-sm-9">
                                                    <div class="form-line" id="newPasswordLine">
                                                        <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="New Password" required disabled>
                                                        <span toggle="#newPassword" class="fa fa-eye form-toggle-password"></span>
                                                    </div>
                                                    <p class="form-error" id="passwordError1"><i class="fa fa-exclamation-circle"></i> What's your password?</p>
                                                    <p class="form-error" id="passwordError2"><i class="fa fa-exclamation-circle"></i> Minimum password length is 8</p>
                                                    <p class="form-error" id="passwordError3"><i class="fa fa-exclamation-circle"></i> Maximum password length is 16</p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="newPasswordConfirm" class="col-sm-3 control-label" id="newPasswordConfirmLabel">New Password (Confirm)</label>
                                                <div class="col-sm-9">
                                                    <div class="form-line" id="newPasswordConfirmLine" >
                                                        <input type="password" class="form-control" id="newPasswordConfirm" name="newPasswordConfirm" placeholder="New Password (Confirm)" required disabled>
                                                        <span toggle="#newPasswordConfirm" class="fa fa-eye form-toggle-password"></span>
                                                    </div>
                                                    <p class="form-error" id="confirmPasswordError"><i class="fa fa-exclamation-circle"></i> Passwords does not match</p>
                                                </div>
                                            </div>
                                            <hr class="default-divider ml-auto">
                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <button type="submit" name="submit" id="submitPass" class="btn bg-green waves-effect" disabled>
                                                        <i class="material-icons">save</i>
                                                        <span>Save Changes</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- ## END CHANGE PASSWORD -->
                                    <!--- ## START ADD ADMIN --->
                                    <div role="tabpanel" class="tab-pane fade in" id="add_administrator_settings">
                                        <form action="be/account_admin/add-administrator.php" method="post" class="form-horizontal">
                                            <div class="alert alert-danger" id="alertUsername" name="alertUsername" style="padding: 10px; display: none;">
                                                <i class="fa fa-times-circle"></i><p class="" style="display: inline-block; margin-left: 10px;">An account with a similar username already exists!</p>
                                            </div>
                                            <div class="alert alert-danger" id="alertEmail" name="alertEmail" style="padding: 10px; display: none;">
                                                <i class="fa fa-times-circle"></i><p class="" style="display: inline-block; margin-left: 10px;">An account with a similar email already exists!</p>
                                            </div>
                                            <div class="form-group">
                                                <input class="hidden" name="staff_id" value="<?php echo $staff_id?>">
                                                <input class="hidden" name="staff_username" value="<?php echo $username?>">
                                                <label for="firstName" class="col-sm-3 control-label">First Name</label>
                                                <div class="col-sm-9">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Enter First Name" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="lastName" class="col-sm-3 control-label">Last Name</label>
                                                <div class="col-sm-9">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Enter Last Name" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="newUsername" class="col-sm-3 control-label"> Username</label>
                                                <div class="col-sm-9">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="newUsername" name="newUsername" placeholder="Enter Username" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="newEmail" class="col-sm-3 control-label">Email</label>
                                                <div class="col-sm-9">
                                                    <div class="form-line">
                                                        <input type="email" class="form-control" id="newEmail" name="newEmail" placeholder="Enter Email" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr class="default-divider ml-auto">
                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <button type="submit" name="addAccount" id="addAccount" class="btn bg-green waves-effect">
                                                        <i class="material-icons">save</i>
                                                        <span>Add Administrator Account</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- ## END ADD ADMIN -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
    }
        include 'includes/logout_modal.php';
        include 'includes/scripts.php';
    ?>
</body>
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
    <!-- Demo Js -->
    <script src="../../js/demo.js"></script>

    <!-- Validation scripts -->

    <script>

        document.getElementById("oldPassword").addEventListener("keyup", checkOldPassword);
        document.getElementById("newPassword").addEventListener("keyup", validateNewPasswordField);
        document.getElementById("newPasswordConfirm").addEventListener("keyup", validateConfirmPasswordField);

        document.getElementById("newUsername").addEventListener("keyup", checkUsername);
        document.getElementById("newEmail").addEventListener("keyup", checkEmail);

        function checkOldPassword(){

            var id = $('#id').val();
            var pass = $('#oldPassword').val();

            $.post("be/verify_password.php", { "id": id, "pass": pass }, function(response){

                if(response == 0){

                    $('#alertMessage').css('display', 'block');
                    $('#newPassword').prop('disabled', true);
                    $('#newPasswordConfirm').prop('disabled', true);

                }else{

                    $('#alertMessage').css('display', 'none');
                    $('#newPassword').prop('disabled', false);
                    $('#newPasswordConfirm').prop('disabled', false);

                }

            });

        }

        function validateNewPasswordField(){

            var newPass = $('#newPassword').val();

            if(newPass == ''){

                $('#newPasswordLine').css('border-bottom', '2px solid #ff6961');
                $('#newPasswordLabel').css('color', '#ff6961');
                $('#passwordError1').css('display', 'block');
                
            }else{

                $('#newPasswordLine').css('border-bottom', '1px solid #1f91f3');
                $('#newPasswordLabel').css('color', '#555');
                $('#passwordError1').css('display', 'none');

                if(newPass.length < 8){

                    $('#newPasswordLine').css('border-bottom', '2px solid #ff6961');
                    $('#newPasswordLabel').css('color', '#ff6961');
                    $('#passwordError2').css('display', 'block');

                }else{

                    $('#newPasswordLine').css('border-bottom', '1px solid #1f91f3');
                    $('#newPasswordLabel').css('color', '#55');
                    $('#passwordError2').css('display', 'none');

                    if(newPass.length > 16){

                        $('#newPasswordLine').css('border-bottom', '2px solid #ff6961');
                        $('#newPasswordLabel').css('color', '#ff6961');
                        $('#passwordError3').css('display', 'block');

                    }else{

                        $('#newPasswordLine').css('border-bottom', '1px solid #1f91f3');
                        $('#newPasswordLabel').css('color', '#555');
                        $('#passwordError3').css('display', 'none');

                    }

                }

            }

        }

        function validateConfirmPasswordField(){

            var pass = $('#newPassword').val();
            var cpass = $('#newPasswordConfirm').val();

            if(pass != cpass){

                $('#newPasswordConfirmLine').css('border-bottom', '2px solid #ff6961');
                $('#newPasswordConfirmLabel').css('color', '#ff6961');
                $('#confirmPasswordError').css('display', 'block');
                $('#submitPass').prop('disabled', true);
                    
            }else{

                $('#newPasswordConfirmLine').css('border-bottom', '1px solid #1f91f3');
                $('#newPasswordConfirmLabel').css('color', '#555');
                $('#confirmPasswordError').css('display', 'none');
                $('#submitPass').prop('disabled', false);

            }

        }

        //Validate add administrator account

        function checkUsername(){

            var username = $('#newUsername').val();

            $.post("be/account_admin/check_admin_account.php", { "username": username }, function(response){

                if(response == 1){

                    $('#alertUsername').css('display', 'block');
                    $('#addAccount').attr("disabled", true);

                }else{

                    $('#alertUsername').css('display', 'none');
                    $('#addAccount').attr("disabled", false);

                }

            });

        }

        function checkEmail(){

            var email = $('#newEmail').val();

            $.post("be/account_admin/check_admin_account.php", { "email": email }, function(response){

                if(response == 1){

                    $('#alertEmail').css('display', 'block');
                    $('#addAccount').attr("disabled", true);

                }else{

                    $('#alertEmail').css('display', 'none');
                    $('#addAccount').attr("disabled", false);

                }

            });

        }

        //toggles show/hide password

        $('.form-toggle-password').click(function(){

            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));

            if(input.attr("type") == "password"){
                input.attr("type", "text");
            }else{
                input.attr("type", "password");
            }

        })

    </script>

</html>
