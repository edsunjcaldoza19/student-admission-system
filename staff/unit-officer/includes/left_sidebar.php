<!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
           <?php
                include 'includes/user.php';
                require 'be/database/db_pdo.php';

                $sql1 = $conn->prepare("SELECT * FROM `tbl_academic_year` WHERE `ay_status` = 1");
                $sql1->execute();
                $fetch1 = $sql1->fetch();
           ?>
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="<?= ($activePage == 'home') ? 'active': ''; ?>">
                        <a href="home.php">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li>
                    <li class="<?= ($activePage == 'account_add') ? 'active': ''; ?>">
                        <a href="account_add.php">
                            <i class="material-icons">person_add</i>
                            <span>Add Interviewer Account</span>
                        </a>
                    </li>
                    <li>
                    <li class="<?= ($activePage == 'account_interviewer') ? 'active': ''; ?>">
                        <a href="account_interviewer.php">
                            <i class="material-icons">person</i>
                            <span>Interviewer Accounts</span>
                        </a>
                    </li>
                    <li class="<?= ($activePage == 'applicant') ? 'active': ''; ?>">
                        <a href="applicant.php">
                            <i class="material-icons">perm_identity</i>
                            <span>Applicants Masterlist</span>
                        </a>
                    </li>
                    <li>
                    <li class="header">MANAGE STUDENT APPLICATIONS</li>
                    <li class="<?= ($activePage == 'applicant_approved' || $activePage == 'applicant_pending' || $activePage == 'applicant_rejected' || $activePage =='applicant_review') ? 'active': ''; ?>">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">supervisor_account</i>
                            <span>Applicant Evaluation</span>
                        </a>
                        <ul class="ml-menu">
                            <li class="<?= ($activePage == 'applicant_pending') ? 'active': ''; ?>">
                                <a href="applicant_pending.php?sy_id=<?php echo $fetch1['id'];?>">Pending Applicants</a>
                            </li>
                            <li class="<?= ($activePage == 'applicant_approved') ? 'active': ''; ?>">
                                <a href="javascript:void(0);" class="menu-toggle">Approved Applicants</a>
                                <ul class="ml-menu" style="max-height: 120px; overflow-x: auto;">
                                    <li>
                                        <?php
                                            $sql = $conn->prepare("SELECT * FROM `tbl_course` WHERE `unit_id` = $unitId");
                                            $sql->execute();

                                            while($fetch = $sql->fetch()){
                                        ?>
                                        <a href="applicant_approved.php?course_id=<?php echo $fetch['course_id'];?>&sy_id=<?php echo $fetch1['id'];?>"><?php echo $fetch['course_name']; ?></a>
                                        <?php
                                            }
                                        ?>
                                    </li>
                                </ul>
                            </li>
                            <li class="<?= ($activePage == 'applicant_rejected') ? 'active': ''; ?>">
                                <a href="javascript:void(0);" class="menu-toggle">Disapproved Applicants</a>
                                <ul class="ml-menu" style="max-height: 120px; overflow-x: auto;">
                                    <li>
                                        <?php
                                            $sql = $conn->prepare("SELECT * FROM `tbl_course` WHERE `unit_id` = $unitId");
                                            $sql->execute();

                                            while($fetch = $sql->fetch()){
                                        ?>
                                        <a href="applicant_rejected.php?course_id=<?php echo $fetch['course_id'];?>&sy_id=<?php echo $fetch1['id'];?>"><?php echo $fetch['course_name']; ?></a>
                                        <?php
                                            }
                                        ?>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="<?= ($activePage == 'waitlist') ? 'active': ''; ?>">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">low_priority</i>
                            <span>Waitlisted Applicants</span>
                        </a>
                        <ul class="ml-menu" style="max-height: 200px; overflow-x: auto;"> 
                            <li>
                                <?php
                                    $sql = $conn->prepare("SELECT * FROM `tbl_course` WHERE `unit_id` = $unitId");
                                    $sql->execute();
                                    while($fetch = $sql->fetch()){
                                ?>
                                    <a href="waitlist.php?course_id=<?php echo $fetch['course_id'];?>&sy_id=<?php echo $fetch1['id'];?>"><?php echo $fetch['course_name']; ?></a>
                                <?php
                                    }
                                ?>
                            </li>
                        </ul>
                    </li>
                    <li class="header">OTHER OPTIONS</li>
                    <li class="<?= ($activePage == 'program_configurations') ? 'active': ''; ?>">
                        <a href="program_configurations.php?sy_id=<?php echo $fetch1['id']?>">
                            <i class="material-icons">list</i>
                            <span>Program Configurations</span>
                        </a>
                    </li>
                    <li class="<?= ($activePage == 'account_settings') ? 'active': ''; ?>">
                        <a href="account_settings.php">
                            <i class="material-icons">settings</i>
                            <span>Account Settings</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="version">
                    LNU SAIS | Version 1.0.0
                </div>
                <div class="copyright">
                    &copy; 2021 <a href="javascript:void(0);">Leyte Normal University</a>
                </div>
            </div>
            <!-- #Footer -->
            <?php
            include 'includes/right_sidebar.php';
        ?>
        </aside>
        <!-- #END# Left Sidebar -->