
<!-- ADD EXAMINATION MODULE MODAL -->
<div class="modal fade" id="updateScore<?php echo $fetch['id']; ?>" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?php
            $syID = $_GET['sy_id'];
            ?>
            <form action = "be/applicant_interview/updateInterviewScore.php?sy_id=<?php echo $syID;?>" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Input Interview Rating</h4>
                    <hr class="default-divider ml-auto">
                </div>
                <div class="modal-body">
                    <input type="hidden" value="<?php echo $fetch['applicant_account_id']; ?>" name="id">
                    <input type="hidden" value="<?php echo $fetch['program_first_choice']; ?>" name="firstChoice">
                    <input type="hidden" value="<?php echo $fetch['program_second_choice']; ?>" name="secondChoice">
                    <input type="hidden" value="<?php echo $fetch['course_id']; ?>" name="courseId">
                    <input type="hidden" value="<?php echo $staff_id; ?>" name="staffID">
                    <input type="hidden" name="staff_username" value="<?php echo $username?>">
                    <div class="form-group">
                    <p style="font-weight: 600;">Set Interview Rating for: </p>
                        <p>
                            <?php echo $fetch['last_name'].', '.$fetch['first_name'].' '.$fetch['middle_name']?>
                        </p>       
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="number" class="form-control" name="interview_score" required autofocus>
                            <label class="form-label">Enter Interview Rating</label>
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

