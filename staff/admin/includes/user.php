<!-- User Info -->
            <div class="user-info">
                <?php
                    require 'be/database/db_pdo.php';
                    $admin_id = $_SESSION['admin_id'];
                    $sql = $conn->prepare("SELECT * FROM `tbl_admin` WHERE `id` = $admin_id");
                    $sql->execute();
                    $fetch = $sql->fetch();
                    $image = (!empty($fetch['image'])) ? '../../images/staff-img/'.$fetch['staff_profile_img'] : '../../images/staff-img/default.png';
                ?>
                <div class="image">
                    <img src="<?php echo $image; ?>" width="50" height="50" alt="User" />
                </div>
                <div class="info-container">
                    <div class="email" style="font-size: 14px;">Hi, <?php echo $_SESSION['admin_email']; ?></div>
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"style="font-size: 11px;">Administrator</div>
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