
<!-- ADD EXAMINATION MODULE MODAL -->
<div class="modal fade" id="updateScore<?php echo $fetch['id']; ?>" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?php
            $syID = $_GET['sy_id'];
            ?>
            <form action = "be/applicant_exam/updateScore.php?sy_id=<?php echo $syID;?>" method="POST" enctype="multipart/form-data">
                <input class="hidden" name="staff_id" value="<?php echo $staff_id?>">
                <input class="hidden" name="staff_username" value="<?php echo $username?>">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Input Entrance Examination Score</h4>
                    <hr class="default-divider ml-auto">
                </div>
                <div class="modal-body">
                    <input type="hidden" value="<?php echo $fetch['applicant_account_id']; ?>" name="id">
                    <div class="form-group">
                        <p style="font-weight: 600;">Set Examination Score for: </p>
                        <p>
                            <?php echo $fetch['last_name'].', '.$fetch['first_name'].' '.$fetch['middle_name']?>
                        </p>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="number" class="form-control" name="exam_score" required autofocus>
                            <label class="form-label">Enter Entrance Examination Score</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <hr class="default-divider ml-auto">
                        <button type="submit" class="btn btn-link waves-effect" name="updateScore" id="updateScore" >SAVE CHANGES</button>
                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

