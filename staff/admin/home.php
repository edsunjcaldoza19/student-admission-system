<?php
    include 'includes/session.php';
    include 'includes/header.php';
    include 'includes/left_sidebar.php';
    include 'includes/topbar.php';
    require 'be/database/db_pdo.php';
?>
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <p class="page-header">System Dashboard</p>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="dashboard-card-wide dashboard-name">
                        <p class="dashboard-main-text">Welcome back, <?php echo $fetch['name']?></p>
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
                        <p class="dashboard-main-subtext">Colleges</p>
                        <?php 
                            $query = $conn->prepare("SELECT * FROM `tbl_department`");
                            $query->execute();
                            $count = $query->rowCount();
                        ?>
                        <p class="dashboard-main-text" style="font-size: 32px;"><?php echo $count?></p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="dashboard-card-wide dashboard-three" align="right">
                        <p class="dashboard-main-subtext">Academic Units</p>
                        <?php 
                            $query = $conn->prepare("SELECT * FROM `tbl_unit`");
                            $query->execute();
                            $count = $query->rowCount();
                        ?>
                        <p class="dashboard-main-text" style="font-size: 32px;"><?php echo $count?></p>
                    </div>
                    <div class="dashboard-card-wide dashboard-four" align="right">
                        <p class="dashboard-main-subtext">Programs</p>
                        <?php 
                            $query = $conn->prepare("SELECT * FROM `tbl_course`");
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
                            <p class="table-subheader" style="font-weight: 600;">System Administrators</p>
                        </div>
                        <div class="body" style="overflow-x: auto; height: 200px;">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>Administrator Name</th>
                                            <th>Email</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- populate table with db data -->
                                        <?php
                                            require 'be/database/db_pdo.php';
                                            $sql = $conn->prepare("SELECT * FROM `tbl_admin`");
                                            $sql->execute();
                                            while($fetch = $sql->fetch()){
                                        ?>
                                        <tr>
                                            <td><?php echo $fetch['name']; ?></td>
                                            <td><?php echo $fetch['email']; ?></td>
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
                            <p class="table-subheader" style="font-weight: 600;">Registered Staff Accounts</p>
                        </div>
                        <div class="body" style="padding: 10px 25px 10px 25px;">
                            <div class="row">
                                <div class="col-md-3" style="padding: 7px;">
                                    <div class="dashboard-card-small dashboard-two" align="right">
                                        <p class="dashboard-main-subtext">Admissions</p>
                                        <?php 
                                            $query = $conn->prepare("SELECT * FROM `tbl_account_staff` WHERE `staff_role` = 1");
                                            $query->execute();
                                            $count = $query->rowCount();
                                        ?>
                                        <p class="dashboard-main-text" style="font-size: 50px; margin-top: 45px;"><?php echo $count?></p>
                                    </div>
                                </div>
                                <div class="col-md-3" style="padding: 7px;">
                                    <div class="dashboard-card-small dashboard-two" align="right">
                                        <p class="dashboard-main-subtext">Exam Officer</p>
                                        <?php 
                                            $query = $conn->prepare("SELECT * FROM `tbl_account_staff` WHERE `staff_role` = 2");
                                            $query->execute();
                                            $count = $query->rowCount();
                                        ?>
                                        <p class="dashboard-main-text" style="font-size: 50px; margin-top: 24px;"><?php echo $count?></p>
                                    </div>
                                </div>
                                <div class="col-md-3" style="padding: 7px;">
                                    <div class="dashboard-card-small dashboard-two" align="right">
                                        <p class="dashboard-main-subtext">Unit Head</p>
                                        <?php 
                                            $query = $conn->prepare("SELECT * FROM `tbl_account_staff` WHERE `staff_role` = 3");
                                            $query->execute();
                                            $count = $query->rowCount();
                                        ?>
                                        <p class="dashboard-main-text" style="font-size: 50px; margin-top: 45px;"><?php echo $count?></p>
                                    </div>
                                </div>
                                <div class="col-md-3" style="padding: 7px;">
                                    <div class="dashboard-card-small dashboard-two" align="right">
                                        <p class="dashboard-main-subtext">Interviewer</p>
                                        <?php 
                                            $query = $conn->prepare("SELECT * FROM `tbl_account_staff` WHERE `staff_role` = 4");
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
<!-- Custom Js -->
<script src="../../js/admin.js"></script>

<!-- Demo Js -->
<script src="../../js/demo.js"></script>
<!-- Additional JS -->

<script>
    $(document).ready(function () {
        showDateTime();
    });

    function showDateTime(){

        var t = new Date();
        var d = new Date();
        document.getElementById("time").innerHTML = (t.toLocaleTimeString([], {hour: '2-digit', minute: '2-digit'}));
        document.getElementById("date").innerHTML = (d.toLocaleDateString([], {weekday: 'long', month: 'long', day: 'numeric', year: 'numeric'}));
        setTimeout("showTime()", 1000);
    }
</script>


</html>
