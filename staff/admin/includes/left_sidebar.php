<?php
    include 'be/backup/backupModal.php';
?>
<section>
       <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
           <?php
                include 'includes/user.php';
           ?>
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="<?= ($activePage == 'home') ? 'active': ''; ?>">
                        <a href="home.php">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li class="<?= ($activePage == 'academic_year') ? 'active': ''; ?>">
                        <a href="academic_year.php">
                            <i class="material-icons">date_range</i>
                            <span>Academic Year</span>
                        </a>
                    </li>
                    <li class="<?= ($activePage == 'college') ? 'active': ''; ?>">
                        <a href="college.php">
                            <i class="material-icons">view_agenda</i>
                            <span>College</span>
                        </a>
                    </li>
                    <li class="<?= ($activePage == 'unit') ? 'active': ''; ?>">
                        <a href="unit.php">
                            <i class="material-icons">view_headline</i>
                            <span>Academic Unit</span>
                        </a>
                    </li>
                    <li class="<?= ($activePage == 'program') ? 'active': ''; ?>">
                        <a href="program.php">
                            <i class="material-icons">view_module</i>
                            <span>Programs</span>
                        </a>
                    </li>
                    <li class="header">ACCOUNTS</li>
                    <li class="<?= ($activePage == 'account_add') ? 'active': ''; ?>">
                        <a href="account_add.php">
                            <i class="material-icons">person_add</i>
                            <span>Add Staff Account</span>
                        </a>
                    </li>
                    <li class="<?= ($activePage == 'account_admission_officer' || $activePage == 'account_exam_officer'
                    || $activePage == 'account_interviewer' || $activePage == 'account_unit_head' || $activePage == 'account_all') ? 'active': ''; ?>">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">supervisor_account</i>
                            <span>Manage Staff Accounts</span>
                        </a>
                        <ul class="ml-menu">
                        <li class="<?= ($activePage == 'account_all') ? 'active': ''; ?>">
                                <a href="account_all.php">All Staff Accounts</a>
                            </li>
                            <li class="<?= ($activePage == 'account_admission_officer') ? 'active': ''; ?>">
                                <a href="account_admission_officer.php">Admission Officer Account</a>
                            </li>
                            <li class="<?= ($activePage == 'account_exam_officer') ? 'active': ''; ?>">
                                <a href="account_exam_officer.php">Exam Officer Account</a>
                            </li>
                            <li class="<?= ($activePage == 'account_unit_head') ? 'active': ''; ?>">
                                <a href="account_unit_head.php">Unit Head Account</a>
                            </li>
                            <li class="<?= ($activePage == 'account_interviewer') ? 'active': ''; ?>">
                                <a href="account_interviewer.php">Interviewer Account</a>
                            </li>
                        </ul>
                    </li>
                     <li class="<?= ($activePage == 'account_admin') ? 'active': ''; ?>">
                        <a href="account_admin.php">
                            <i class="material-icons">settings</i>
                            <span>Admin Account Settings</span>
                        </a>
                    </li>
                    <li class="header">OTHER SETTINGS</li>
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
                    <li class="<?= ($activePage == 'backup') ? 'active': ''; ?>">
                        <a href="" data-toggle="modal" data-target="#backupModal">
                            <i class="material-icons">download</i>
                            <span>Backup Database</span>
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
        </aside>
        <!-- #END# Left Sidebar -->
        <?php
            include 'includes/right_sidebar.php';
        ?>

    </section>

    <script>
</script>