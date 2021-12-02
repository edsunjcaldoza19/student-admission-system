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
                    <li class="<?= ($activePage == 'applicant') ? 'active': ''; ?>">
                        <a href="applicant.php">
                            <i class="material-icons">people</i>
                            <span>Applicants Masterlist</span>
                        </a>
                    </li>
                    <li class="header">MANAGE ENTRANCE EXAMINATION</li>

                    <?php
                        $sql = $conn->prepare("SELECT * FROM `tbl_academic_year` WHERE `ay_status` = 1");
                        $sql->execute();
                        $fetchAy = $sql->fetch();

                    ?>
                    <li class="<?= ($activePage == 'applicant_scored' || $activePage == 'applicant_unscored') ? 'active': ''; ?> <?php if($fetchAy["enable_exam"] == 1){echo 'li-disabled';}else{echo '';}?>">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">mode</i>
                            <span>Encode Applicant Scores</span>
                        </a>
                         <ul class="ml-menu">
                            <li class="<?= ($activePage == 'applicant_unscored') ? 'active': ''; ?>">
                                <a href="applicant_unscored.php?sy_id=<?php echo $fetch1['id'];?>">Unscored Applicants</a>
                            </li>
                            <li class="<?= ($activePage == 'applicant_scored') ? 'active': ''; ?>">
                                <a href="applicant_scored.php?sy_id=<?php echo $fetch1['id'];?>">Scored Applicants</a>
                            </li>
                        </ul>
                    </li>
                    <li class="<?= ($activePage == 'exam_manage') ? 'active': ''; ?> <?php if($fetchAy["enable_exam"] == 0){echo 'li-disabled';}else{echo '';}?>" style="display: none;">
                                <a href="exam_manage.php">
                                <i class="material-icons">assignment</i>
                                <span>Examination Module</span>
                                </a>
                    </li>
                    <li class="<?= ($activePage == 'exam_results') ? 'active': ''; ?> <?php if($fetchAy["enable_exam"] == 0){echo 'li-disabled';}else{echo '';}?>" style="display: none;">
                            <a href="exam_results.php">
                                <i class="material-icons">list</i>
                                <span>Examination Results</span>
                            </a>
                        </li>
                    <li class="header">OTHER OPTIONS</li>
                    <li>
                        <li class="<?= ($activePage == 'exam_toggle') ? 'active': ''; ?>" style="display: none;">
                            <a href="exam_toggle.php">
                                <i class="material-icons">settings</i>
                                <span>Enable/Disable Examination</span>
                            </a>
                        </li>
                    </li>
                    <li>
                        <li class="<?= ($activePage == 'account_settings') ? 'active': ''; ?>">
                            <a href="account_settings.php">
                                <i class="material-icons">person</i>
                                <span>Account Settings</span>
                            </a>
                        </li>
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
        <?php include 'be/entrance_examination/addExaminationModal.php';?>