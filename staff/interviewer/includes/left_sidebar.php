<!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
           <?php
                include 'includes/user.php';
                require 'be/database/db_pdo.php';
            
                $sql = $conn->prepare("SELECT * FROM `tbl_academic_year` WHERE `ay_status` = 1");
                $sql->execute();
                $fetch=$sql->fetch();
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
                    <li class="<?= ($activePage == 'applicant') ? 'active': ''; ?>">
                        <a href="applicant.php">
                            <i class="material-icons">perm_identity</i>
                            <span>Applicants Masterlist</span>
                        </a>
                    </li>
                    <li class="header">MANAGE STUDENT INTERVIEWS</li>
                    <li class="<?= ($activePage == 'applicant_approved' || $activePage == 'applicant_pending' || $activePage == 'applicant_rejected' || $activePage =='applicant_review') ? 'active': ''; ?>">
                        <li class="<?= ($activePage == 'applicant_pending') ? 'active': ''; ?>">
                            <a href="applicant_pending.php?sy_id=<?php echo $fetch['id'];?>">
                                <i class="material-icons">event_busy</i>
                                <span>Pending for Schedule</span>
                            </a>
                        </li>
                        <li class="<?= ($activePage == 'applicant_scheduled') ? 'active': ''; ?>">
                            <a href="applicant_scheduled.php?sy_id=<?php echo $fetch['id'];?>">
                                <i class="material-icons">event_available</i>
                                <span>Scheduled Applicants</span>
                            </a>
                        </li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">supervisor_account</i>
                            <span>Applicants Overview</span>
                        </a>
                        <ul class="ml-menu">
                            <li class="<?= ($activePage == 'applicant_qualified') ? 'active': ''; ?>">
                                <a href="applicant_qualified.php?sy_id=<?php echo $fetch['id'];?>">Qualified Applicants</a>
                            </li>
                            <li class="<?= ($activePage == 'applicant_unqualified') ? 'active': ''; ?>">
                                <a href="applicant_unqualified.php?sy_id=<?php echo $fetch['id'];?>">Unqualified Applicants</a>
                            </li>
                        </ul>
                    </li>
                    <li class="header">OTHER OPTIONS</li>
                     <li>
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