<!-- DISAPPROVE APPLICATION-- -->
<div class="modal fade" id="reject<?php echo $fetch['id']?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action = "be/applicant-review/rejectApplication.php?syID=<?php echo $syID ?>" method="POST">
                <input class="hidden" name="staff_id" value="<?php echo $staff_id?>">
                <input class="hidden" name="staff_username" value="<?php echo $username?>">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Disapprove Application</h4>
                    <hr class="default-divider ml-auto">
                </div>
                <div class="modal-body logout-modal-body">
                    <input type="hidden" name="applicantID" id="applicantID" value="<?php echo $fetch['id'] ?>">
                    <div class="form-group">
                        <p class="card-dashboard-header">Are you sure you want to disapprove
                        <b>
                            <?php 
                                echo $fetch['first_name'].' '.$fetch['middle_name'].' '.$fetch['last_name'];
                            ?>  
                        </b>
                        's application ?</p>
                        <p><i>If yes, please specify the reason for the disapproval of this application:</i></p>
                        <div class="form-line">
                            <textarea name="reasonReject" cols="30" rows="5" class="form-control no-resize" placeholder="Reason for rejection" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <hr class="default-divider ml-auto">
                    <button type="submit" class="btn btn-link btn-danger waves-effect" name="reject" id="reject" onclick="showSuccess();" style="color: #EEEEEE;">Yes, Disapprove Application</button>
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CANCEL</button>
                </div>
            </form>
        </div>
    </div>
</div>