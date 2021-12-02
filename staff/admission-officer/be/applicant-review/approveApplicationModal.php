<!-- APPROVE MODAL -->
<div class="modal fade" id="approve<?php echo $fetch['id']?>" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?php
                $syID = $_GET['sy_id'];
            ?>
            <form action = "be/applicant-review/approveApplication.php?syID=<?php echo $syID ?>" method="POST">
                <input class="hidden" name="staff_id" value="<?php echo $staff_id?>">
                <input class="hidden" name="staff_username" value="<?php echo $username?>">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Approve Application</h4>
                    <hr class="default-divider ml-auto">
                </div>
                <div class="modal-body">
                    <input type="hidden" name="applicantID" id="applicantID" value="<?php echo $fetch['id'] ?>">
                    <p class="card-dashboard-header">Are you sure you want to initially approve
                    <b>
                    <?php 
                        echo $fetch['first_name'].' '.$fetch['middle_name'].' '.$fetch['last_name'];
                    ?></b>'s 
                application ?</p>
                </div>
                <div class="modal-footer">
                    <hr class="default-divider ml-auto">
                    <button type="submit" class="btn btn-link btn-success waves-effect" name="approve" id="approve" onclick="showSuccess();" style="color: #EEEEEE;">Yes, Approve Application</button>
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CANCEL</button>
                </div>
            </form>
        </div>
    </div>
</div>