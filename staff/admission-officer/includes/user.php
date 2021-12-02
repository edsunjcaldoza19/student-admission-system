<!-- User Info -->
            <div class="user-info">
                <?php
                    require 'be/database/db_pdo.php';
                    $staff_id = $_SESSION['staff_id'];
                    $sql = $conn->prepare("SELECT * FROM `tbl_account_staff` WHERE `id` = $staff_id");
                    $sql->execute();
                    $fetch = $sql->fetch();
                    $image = (!empty($fetch['staff_profile_img'])) ? '../../images/staff-img/'.$fetch['staff_profile_img'] : '../../images/staff-img/default.png';
                ?>
                <div class="image">
                    <img src="<?php echo $image; ?>" width="50" height="50" alt="User" />
                </div>
                <div class="info-container">
                    <div class="email" style="font-size: 14px;">Hi, <?php echo $_SESSION['staff_email']; ?></div>
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"style="font-size: 11px;">Admission Officer</div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                            <li role="separator" class="divider"></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="" data-toggle="modal" data-target="#logoutModal"><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </div>

                </div>
            </div>
<!-- #User Info -->