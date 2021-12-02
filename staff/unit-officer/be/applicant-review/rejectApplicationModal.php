<!-- DISAPPROVE APPLICATION-- -->
<div class="modal fade" id="reject<?php echo $fetch['id']?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action = "be/applicant-review/rejectApplication.php?syID=<?php echo $syID ?>" method="POST">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Disapprove Application</h4>
                    <hr class="default-divider ml-auto">
                </div>
                <div class="modal-body logout-modal-body">
                    <input type="hidden" name="applicantID" id="applicantID" value="<?php echo $fetch['id'] ?>">
                    <input type="hidden" name="courseID" id="courseID" value="<?php echo $fetchCourse['course_id'] ?>"
                    >
                    <input type="hidden" name="firstChoice" id="firstChoice" value="<?php echo $fetch['program_first_choice'] ?>"
                    >
                    <input type="hidden" name="secondChoice" id="secondChoice" value="<?php echo $fetch['program_second_choice'] ?>">
                    <input type="hidden" name="staff_id" value="<?php echo $staff_id?>">
                    <input type="hidden" name="staff_username" value="<?php echo $username?>">
                    >
                    <div class="form-group">
                        <p class="card-dashboard-header">Are you sure you want to finalize disapproval of
                        <b>
                        <?php 
                            echo $fetch['first_name'].' '.$fetch['middle_name'].' '.$fetch['last_name'];
                        ?></b>'s 
                        application for the program <b><?php echo $fetchCourse['course_name'] ?></b>?</p>
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