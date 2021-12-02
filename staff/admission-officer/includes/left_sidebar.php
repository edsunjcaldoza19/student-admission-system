<!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
           <?php
                include 'includes/user.php';
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
                    <li class="<?= ($activePage == 'procedure') ? 'active': ''; ?>">
                        <a href="procedure.php">
                            <i class="material-icons">assignment_turned_in</i>
                            <span>Procedures</span>
                        </a>
                    </li>
                    <li>
                    <li class="<?= ($activePage == 'requirements') ? 'active': ''; ?>">
                        <a href="requirements.php">
                            <i class="material-icons">assignment</i>
                            <span>Requirements</span>
                        </a>
                    </li>
                    <li>
                    <li class="<?= ($activePage == 'schedule') ? 'active': ''; ?>">
                        <a href="schedule.php">
                            <i class="material-icons">date_range</i>
                            <span>Schedules</span>
                        </a>
                    </li>
                    <li class="<?= ($activePage == 'faqs') ? 'active': ''; ?>">
                        <a href="faqs.php">
                            <i class="material-icons">question_answer</i>
                            <span>Frequently Asked Questions</span>
                        </a>
                    </li>
                    <li class="header">MANAGE STUDENT APPLICATIONS</li>
                    <li class="<?= ($activePage == 'applicant' || $activePage == 'applicant_approved' || $activePage == 'applicant_pending' || $activePage == 'applicant_rejected' || $activePage =='applicant_review') ? 'active': ''; ?>">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">supervisor_account</i>
                            <span>Applicant Evaluation</span>
                        </a>
                         <ul class="ml-menu">
                            <li class="<?= ($activePage == 'applicant_pending') ? 'active': ''; ?>">
                                <a href="javascript:void(0);" class="menu-toggle">Pending Applications</a>
                                <ul class="ml-menu">
                                    <li>
                                        <?php
                                        require 'be/database/db_pdo.php';
                                        $sql = $conn->prepare("SELECT * FROM `tbl_academic_year`");
                                        $sql->execute();
                                        while($fetch = $sql->fetch()){
                                        ?>
                                        <a href="applicant_pending.php?sy_id=<?php echo $fetch['id'];?>">A.Y. <?php echo $fetch['ay_year']; ?></a>
                                        <?php
                                            }
                                        ?>
                                    </li>
                                </ul>
                            </li>
                            <li class="<?= ($activePage == 'applicant_approved') ? 'active': ''; ?>">
                                <a href="javascript:void(0);" class="menu-toggle">Approved Applications</a>
                                <ul class="ml-menu">
                                    <li>
                                        <?php
                                        require 'be/database/db_pdo.php';
                                        $sql = $conn->prepare("SELECT * FROM `tbl_academic_year`");
                                        $sql->execute();
                                        while($fetch = $sql->fetch()){
                                        ?>
                                        <a href="applicant_approved.php?sy_id=<?php echo $fetch['id'];?>">A.Y. <?php echo $fetch['ay_year']; ?></a>
                                        <?php
                                            }
                                        ?>
                                    </li>
                                </ul>
                            </li>
                            <li class="<?= ($activePage == 'applicant_rejected') ? 'active': ''; ?>">
                                <a href="javascript:void(0);" class="menu-toggle">Disapproved Applications</a>
                                <ul class="ml-menu">
                                    <li>
                                        <?php
                                        require 'be/database/db_pdo.php';
                                        $sql = $conn->prepare("SELECT * FROM `tbl_academic_year`");
                                        $sql->execute();
                                        while($fetch = $sql->fetch()){
                                        ?>
                                        <a href="applicant_rejected.php?sy_id=<?php echo $fetch['id'];?>">A.Y. <?php echo $fetch['ay_year']; ?></a>
                                        <?php
                                            }
                                        ?>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="<?= ($activePage == 'qualified') ? 'active': ''; ?>">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">check_circle</i>
                            <span>Admission Qualifiers</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="qualified.php?sem=First%20Semester">First Semester</a>
                            </li>
                            <li>
                                <a href="qualified.php?sem=Second%20Semester">Second Semester</a>
                            </li>
                            <li>
                                <a href="qualified.php?sem=Summer">Summer</a>
                            </li>
                        </ul>
                    </li>
                    <li class="<?= ($activePage == 'applicant_monitoring') ? 'active': ''; ?>">
                        <?php
                            require 'be/database/db_pdo.php';
                            $sql = $conn->prepare("SELECT * FROM `tbl_academic_year` WHERE `ay_status` = 1");
                            $sql->execute();
                            while($fetch = $sql->fetch()){
                        ?>
                        <a href="applicant_monitoring.php?id=<?php echo $fetch['id'];?>">
                            <i class="material-icons">person_outline</i>
                            <span>Applicant Monitoring</span>
                        </a>
                        <?php
                            }
                        ?>
                    </li>
                    <li class="header">OTHER OPTIONS</li>
                    <li class="<?= ($activePage == 'inquiry') ? 'active': ''; ?>">
                        <a href="inquiry.php">
                            <i class="material-icons">feedback</i>
                            <span>Inquiries</span>
                        </a>
                    </li>
                    <li class="<?= ($activePage == 'system_logs') ? 'active': ''; ?>">
                        <a href="system_logs.php">
                            <i class="material-icons">dvr</i>
                            <span>System Logs</span>
                        </a>
                    </li>
                    <li class="<?= ($activePage == 'pending_accounts') ? 'active': ''; ?>">
                        <a href="pending_accounts.php">
                            <i class="material-icons">how_to_reg</i>
                            <span>Verify Re-admission Accounts</span>
                        </a>
                    </li>
                    <!-- <li class="<?= ($activePage == 'academic_year') ? 'active': ''; ?>">
                        <a href="academic_year.php">
                            <i class="material-icons">date_range</i>
                            <span>Configure Academic Year</span>
                        </a>
                    </li> -->
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