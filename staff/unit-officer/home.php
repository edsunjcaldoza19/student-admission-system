<?php
    include 'includes/session.php';
    include 'includes/header.php';
    include 'includes/left_sidebar.php';
    include 'includes/topbar.php';
    require 'be/database/db_pdo.php';

    $sql1 = $conn->prepare("SELECT * from `tbl_academic_year` WHERE `ay_status` = 1");
    $sql1->execute();
    $fetch1 = $sql1->fetch();

    $sy_id = $fetch1['id'];

    $sql3 = $conn->prepare("SELECT * from `tbl_course` WHERE `unit_id` = ".$unitId."");
    $sql3->execute();
    while($fetch3 = $sql3->fetch()){
        $courses = $fetch3['course_id'];
    }
?>
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <p class="page-header">System Dashboard</p>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="dashboard-card-wide dashboard-name">
                        <?php
                            $id = $_SESSION['staff_id'];
                            $query = $conn->prepare("SELECT * FROM `tbl_account_staff` WHERE `id` = $id");
                            $query->execute();
                            $fetchUser = $query->fetch();
                        ?>
                        <p class="dashboard-main-text text-overflow">Welcome back, <?php echo $fetchUser['staff_first_name'].' '.$fetchUser['staff_middle_name'].' '.$fetchUser['staff_last_name']?></p>
                        <p class="dashboard-main-subtext">What do you want to do today?</p>
                    </div>
                    <div class="dashboard-card-wide dashboard-date" style="padding: 10px 15px 15px 15px">
                        <p class="dashboard-main-text" id="time" style="font-size: 30px;">0:00 AM</p>
                        <hr class="default-divider ml-auto" style="margin: 2px 0px 2px 0px;">
                        <p class="dashboard-main-subtext" id="date">Sunday, February 5, 2021</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="dashboard-card-wide dashboard-one" align="right">
                        <p class="dashboard-main-subtext">Academic Year</p>
                        <?php
                            $query = $conn->prepare("SELECT * FROM `tbl_academic_year` WHERE `ay_status` = 1");
                            $query->execute();
                            $fetchYear = $query->fetch();
                        ?>
                        <p class="dashboard-main-text" style="font-size: 32px;"><?php echo $fetchYear['ay_year']?></p>
                    </div>
                    <div class="dashboard-card-wide dashboard-five" align="right">
                        <p class="dashboard-main-subtext">Academic Unit</p>
                        <?php
                            $query = $conn->prepare("SELECT * FROM `tbl_unit` WHERE `id` = $unitId");
                            $query->execute();
                            $fetch = $query->fetch()
                        ?>
                        <p class="dashboard-main-text" style="font-size: 18px;"><?php echo $fetch['unit_name']?></p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="dashboard-card-wide dashboard-three" align="right">
                        <p class="dashboard-main-subtext">Interviewers</p>
                        <?php
                            $query = $conn->prepare("SELECT * FROM `tbl_account_staff` WHERE `staff_role` = 4");
                            $query->execute();
                            $count = $query->rowCount();
                        ?>
                        <p class="dashboard-main-text" style="font-size: 32px;"><?php echo $count?></p>
                    </div>
                    <div class="dashboard-card-wide dashboard-four" align="right">
                        <p class="dashboard-main-subtext">Total Unit Applicants</p>
                        <?php

                            $query = $conn->prepare("SELECT *, tbl_applicant.id FROM tbl_applicant
                                LEFT JOIN tbl_applicant_account ON tbl_applicant_account.id = tbl_applicant.applicant_account_id
                                LEFT JOIN tbl_course ON (tbl_course.course_id=tbl_applicant.program_first_choice OR tbl_course.course_id=tbl_applicant.program_second_choice)
                                WHERE `school_year_id` = $sy_id AND `unit_id` = $unitId
                                AND (`program_first_choice` = $courses OR `program_second_choice` = $courses)
                            ");
                            $query->execute();
                            $count = $query->rowCount();
                        ?>
                        <p class="dashboard-main-text" style="font-size: 32px;"><?php echo $count?></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card dashboard-card">
                        <div class="header">
                            <p class="table-subheader" style="font-weight: 600;">Unit Interviewer Accounts</p>
                        </div>
                        <div class="body" style="overflow-x: auto; height: 200px;" id="dashboard-table">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Account Name</th>
                                            <th>Email</th>
                                            <th>Contact</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- populate table with db data -->
                                        <?php
                                            require 'be/database/db_pdo.php';
                                            $sql = $conn->prepare("SELECT * FROM `tbl_account_staff` WHERE `staff_role` = 4");
                                            $sql->execute();
                                            while($fetch = $sql->fetch()){
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $fetch['staff_first_name'].' '.$fetch['staff_middle_name'].' '.$fetch['staff_last_name']?>
                                            </td>
                                            <td><?php echo $fetch['staff_email']; ?></td>
                                            <td><?php echo $fetch['staff_contact']; ?></td>
                                            <?php
                                                }
                                            ?>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card dashboard-card" style="height: 280px;">
                        <div class="header">
                            <p class="table-subheader" style="font-weight: 600;">Applicant Overview</p>
                        </div>
                        <div class="body" style="padding: 10px 25px 10px 25px;">
                            <div class="row">
                                <div class="col-md-4" style="padding: 7px;">
                                    <div class="dashboard-card-small dashboard-two" align="right">
                                        <p class="dashboard-main-subtext">Approved</p>
                                        <?php
                                            $query = $conn->prepare("SELECT *, tbl_applicant.id FROM tbl_applicant
                                            LEFT JOIN tbl_applicant_account ON tbl_applicant_account.id = tbl_applicant.applicant_account_id
                                            WHERE `school_year_id` = $sy_id
                                            AND ((`approved_first_choice` = 1 AND `program_first_choice` = $courses) OR (`approved_second_choice` = 1 AND `program_second_choice` = $courses))");
                                            $query->execute();
                                            $count = $query->rowCount();
                                        ?>
                                        <p class="dashboard-main-text" style="font-size: 50px; margin-top: 45px;"><?php echo $count?></p>
                                    </div>
                                </div>
                                <div class="col-md-4" style="padding: 7px;">
                                    <div class="dashboard-card-small dashboard-two" align="right">
                                        <p class="dashboard-main-subtext">Disapproved</p>
                                        <?php
                                            $query = $conn->prepare("SELECT *, tbl_applicant.id FROM tbl_applicant
                                            LEFT JOIN tbl_applicant_account ON tbl_applicant_account.id = tbl_applicant.applicant_account_id
                                            WHERE `school_year_id` = $sy_id
                                            AND ((`approved_first_choice` = 2 AND `program_first_choice` = $courses) OR (`approved_second_choice` = 2 AND `program_second_choice` = $courses))");
                                            $query->execute();
                                            $count = $query->rowCount();
                                        ?>
                                        <p class="dashboard-main-text" style="font-size: 50px; margin-top: 45px;"><?php echo $count?></p>
                                    </div>
                                </div>
                                <div class="col-md-4" style="padding: 7px;">
                                    <div class="dashboard-card-small dashboard-two" align="right">
                                        <p class="dashboard-main-subtext">Waitlisted</p>
                                        <?php
                                            $query = $conn->prepare("SELECT *, tbl_applicant.id FROM tbl_applicant
                                            LEFT JOIN tbl_applicant_account ON tbl_applicant_account.id = tbl_applicant.applicant_account_id
                                            WHERE `school_year_id` = $sy_id
                                            AND ((`approved_first_choice` = 3 AND `program_first_choice` = $courses) OR (`approved_second_choice` = 3 AND `program_second_choice` = $courses))");
                                            $query->execute();
                                            $count = $query->rowCount();
                                        ?>
                                        <p class="dashboard-main-text" style="font-size: 50px; margin-top: 45px;"><?php echo $count?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
    include 'includes/logout_modal.php';
    include 'includes/scripts.php';
?>
</body>

<script>
    $(document).ready(function () {
        showDateTime();
    });

    function showDateTime(){

        var t = new Date();
        var d = new Date();
        document.getElementById("time").innerHTML = (t.toLocaleTimeString([], {hour: '2-digit', minute: '2-digit'}));
        document.getElementById("date").innerHTML = (d.toLocaleDateString([], {weekday: 'long', month: 'long', day: 'numeric', year: 'numeric'}));
        setTimeout("showDateTime()", 1000);
    }

    $(function(){
        $('#dashboard-table').slimScroll({
            height: '200px'
        });
    });

</script>


</html>
