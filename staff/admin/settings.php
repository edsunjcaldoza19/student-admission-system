<?php
    include 'includes/session.php';
    include 'includes/header.php';
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
                            <div class="image-area">
                                <img src="../../images/user-account.png" width="128px" alt="AdminBSB - Profile Image" />
                            </div>
                            <div class="content-area">
                                <h3><?php echo $fetch['name'];?></h3>
                                <p>LNU STUDENT ADMISSION AND INFORMATION SYSTEM</p>
                                <p>Administrator</p>
                            </div>
                        </div>
                    </div>
                <div class="col-xs-12 col-sm-9">
                    <div class="card">
                        <div class="body">
                            <div>
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#profile_settings" aria-controls="settings" role="tab" data-toggle="tab">Profile Settings</a></li>
                                    <li role="presentation"><a href="#change_password_settings" aria-controls="settings" role="tab" data-toggle="tab">Change Password</a></li>
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

                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <input type="checkbox" id="terms_condition_check" class="chk-col-red filled-in" required="true" />
                                                    <label for="terms_condition_check">I agree to the <a href="#">terms and conditions</a></label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <button type="submit" name="submit" class="btn btn-danger">SUBMIT</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!--- ## END PROFILE --->
                                    <!--- ## START CHANGE PASSWORD --->
                                    <div role="tabpanel" class="tab-pane fade in" id="change_password_settings">
                                        <form action="be/account_admin/update-password.php" method="post" class="form-horizontal">
                                            <div class="form-group">
                                                <label for="OldPassword" class="col-sm-3 control-label">Old Password</label>
                                                <div class="col-sm-9">
                                                    <input type="hidden" name="id" value="<?php echo $_SESSION['id']?>">
                                                    <div class="form-line">
                                                        <input type="password" class="form-control" id="oldPassword" name="oldPassword" placeholder="Old Password" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="NewPassword" class="col-sm-3 control-label">New Password</label>
                                                <div class="col-sm-9">
                                                    <div class="form-line">
                                                        <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="New Password" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="newPasswordConfirm" class="col-sm-3 control-label">New Password (Confirm)</label>
                                                <div class="col-sm-9">
                                                    <div class="form-line">
                                                        <input type="password" class="form-control" id="newPasswordConfirm" name="newPasswordConfirm" placeholder="New Password (Confirm)" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-sm-offset-3 col-sm-9">
                                                    <button type="submit" name="submit" class="btn btn-danger">SUBMIT</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- ## END CHANGE PASSWORD -->
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
<!-- Custom Js -->
<script src="../../js/admin.js"></script>

<!-- Demo Js -->
<script src="../../js/demo.js"></script>

</html>
