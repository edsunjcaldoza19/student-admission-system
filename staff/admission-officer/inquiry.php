<?php
    include 'includes/session.php';
    include 'includes/header.php';
    include 'includes/topbar.php';
    include 'includes/left_sidebar.php';
?>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <p class="page-header">Manage System Inquiries</p>
                <p class="page-subheader">View and answer inquiries from end-users</p>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <p class="table-subheader">Inquiry Inbox</p>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Sender Name</th>
                                            <th>Category</th>
                                            <th>Subject</th>
                                            <th>Send Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- populate table with db data -->
                                        <?php
                                            require 'be/database/db_pdo.php';
                                            $sql = $conn->prepare("SELECT *, tbl_inquiry.id FROM tbl_inquiry 
                                                LEFT JOIN tbl_applicant_account ON tbl_applicant_account.id = tbl_inquiry.inquiry_applicant_id 
                                                LEFT JOIN tbl_applicant ON tbl_applicant.applicant_account_id = tbl_applicant_account.id 
                                                WHERE `inquiry_status` = 'Queued'");
                                            $sql->execute();

                                            while($fetch = $sql->fetch()){
                                        ?>
                                        <tr>
                                            <td><?php echo $fetch['first_name'].' '.$fetch['last_name']?></td>
                                            <td><?php echo $fetch['inquiry_category']?></td>
                                            <td><?php echo $fetch['inquiry_subject']; ?></td>
                                            <td><?php echo $fetch['inquiry_sent_timestamp']; ?></td>
                                            <td style="text-align: center; width: 120px; vertical-align: middle;">
                                                <button class="btn bg-light-green btn-circle waves-effect waves-circle waves-float" data-toggle="modal" data-target="#reply<?php echo $fetch['id']?>"><i class="material-icons">reply</i></button>
                                                <button class="btn bg-red btn-circle waves-effect waves-circle waves-float" data-toggle="modal" data-target="#delete<?php echo $fetch['id']?>" id="btnDelete"><i class="material-icons">delete</i></button>
                                            </td>
                                        </tr>

                                        <?php
                                            include 'be/inquiry/deleteModal.php';
                                            include 'be/inquiry/replyModal.php';
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Advanced Form Example With Validation -->
        </div>
    </section>

    <?php
        include 'includes/logout_modal.php';
        include 'includes/scripts.php';
    ?>
</body>

    <script>

        $(function(){
            $('#feedback-reply-message').slimScroll({
                height: '200px'
            });
            $('#feedback-reply-textarea').slimScroll({
                height: '75px'
            });
        });

    </script>
