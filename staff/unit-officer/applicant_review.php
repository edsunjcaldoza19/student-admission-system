<?php
    include 'includes/session.php';
    include 'includes/header.php';
    ?>
    <!-- Light Gallery Plugin Css -->
    <link href="../../plugins/light-gallery/css/lightgallery.css" rel="stylesheet">
    <?php
    include 'includes/topbar.php';
?>
    <section>

        <?php
        	include 'includes/left_sidebar.php';
            include 'includes/right_sidebar.php';
        ?>
    </section>

    <!-- ## BODY CONTENTS ## -->
    <section class="content">
    	 <?php
                $applicant_id = $_GET['id'];
                $course = $_GET['course'];

                require 'be/database/db_pdo.php';
                $sql = $conn->prepare("SELECT *, tbl_applicant.id FROM tbl_applicant
                LEFT JOIN tbl_course ON tbl_course.course_id=tbl_applicant.program_first_choice
                WHERE tbl_applicant.id = '$applicant_id'");
                $sql->execute();

                $sql2 = $conn->prepare("SELECT *, tbl_applicant.id FROM tbl_applicant
                LEFT JOIN tbl_course ON tbl_course.course_id=tbl_applicant.program_second_choice
                WHERE tbl_applicant.id = '$applicant_id'");
                $sql2->execute();

                $sql3 = $conn->prepare("SELECT * FROM `tbl_course` WHERE `course_id` = '$course'");
                $sql3->execute();
                $fetchCourse = $sql3->fetch();

                while($fetch = $sql->fetch()){
                    while($fetch2 = $sql2->fetch()){
                        $applicant_account_id = $fetch['applicant_account_id'];

         ?>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12">
                    <!-- ## APPLICANT PROFILE PICTURE ## -->
                    <?php include 'applicant-tabs/tab-applicant.php';?>
                </div>
                <div class="col-xs-12 col-sm-9" style="padding: 0px;">
                    <div class="card">
                        <div class="body">
                            <div>
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#profile" aria-controls="settings" role="tab" data-toggle="tab">Applicant Profile</a></li>
                                    <li role="presentation"><a href="#parent" aria-controls="settings" role="tab" data-toggle="tab">Family Background</a></li>
                                    <li role="presentation"><a href="#education" aria-controls="settings" role="tab" data-toggle="tab">Educational Background</a></li>
                                    <li role="presentation"><a href="#references" aria-controls="settings" role="tab" data-toggle="tab">Other Relevant Info</a></li>
                                    <li role="presentation"><a href="#documents" aria-controls="settings" role="tab" data-toggle="tab">Submitted Documents</a></li>
                                </ul>

                                <input type="hidden" name="applicantID" value="<?php echo $fetch['id'];?>">
                                <div class="tab-content">
                                    <?php
                                    	include 'applicant-tabs/tab-profile.php';
                                    	include 'applicant-tabs/tab-parent.php';
                                    	include 'applicant-tabs/tab-education.php';
                                    	include 'applicant-tabs/tab-references.php';
                                        include 'applicant-tabs/tab-document.php';
                                    ?>
                                </div>

                            </div>
                        </div><!-- ## BODY CLOSING TAG ['TAB GROUP'] ## -->
                    </div>
                </div>
            </div>
        </div>
        <?php
            include 'be/applicant-review/approveApplicationModal.php';
            include 'be/applicant-review/rejectApplicationModal.php';
            include 'be/applicant-review/waitlistApplicationModal.php';
            }
        }
        ?>
    </section>
    <?php
        include 'includes/logout_modal.php';
        include 'includes/scripts.php';
    ?>
</body>
<script src="../../js/pages/medias/image-gallery.js"></script>
<!-- Light Gallery Plugin Js -->
<script src="../../plugins/light-gallery/js/lightgallery-all.js"></script>

</html>
