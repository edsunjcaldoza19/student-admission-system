<div class="modal fade" id="rejectModal<?php echo $fetch['id']?>" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action = "be/pending_applicants/rejectAccount.php" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Reject Account Registration</h4>
                    <hr class="default-divider ml-auto">
                </div>
                <div class="modal-body">
                    <input class="hidden" value="<?php echo $fetch['verification_key'] ?>" name="verification_key">
                    <input class="hidden" value="<?php echo $fetch['email'] ?>" name="email">
                    <p style="font-size: 15px;">Reject account registration for this applicant?</p>
                </div>
                <div class="modal-footer">
                    <hr class="default-divider ml-auto">
                    <button type="submit" class="btn btn-link waves-effect" name="btnConfirm" id="btnConfirm">CONFIRM</button>
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                </div>
            </form>
        </div>
    </div>
</div>