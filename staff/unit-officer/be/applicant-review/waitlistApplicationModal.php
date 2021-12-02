<!-- APPROVE MODAL -->
<div class="modal fade" id="waitlist<?php echo $fetch['id']?>" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?php
                $syID = $_GET['sy_id'];
            ?>
            <form action = "be/applicant-review/waitlistApplication.php?syID=<?php echo $syID?>&appId=<?php echo $fetch['id']?>&courseId=<?php echo $fetchCourse['course_id']?>" method="POST">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Add Applicant to Waitlist</h4>
                    <hr class="default-divider ml-auto">
                </div>
                <div class="modal-body">
                    <input type="hidden" name="applicantID" id="applicantID" value="<?php echo $fetch['id'] ?>">
                    <input type="hidden" name="courseID" id="courseID" value="<?php echo $fetchCourse['course_id'] ?>"
                    >
                    <input type="hidden" name="firstChoice" id="firstChoice" value="<?php echo $fetch['program_first_choice'] ?>"
                    >
                    <input type="hidden" name="secondChoice" id="secondChoice" value="<?php echo $fetch['program_second_choice'] ?>"
                    >
                    <input type="hidden" name="staff_id" value="<?php echo $staff_id?>">
                    <input type="hidden" name="staff_username" value="<?php echo $username?>">
                    <p class="card-dashboard-header">Are you sure you want to add
                    <b>
                    <?php 
                        echo $fetch['first_name'].' '.$fetch['middle_name'].' '.$fetch['last_name'];
                    ?></b>
                    to <b><?php echo $fetchCourse['course_name']?></b>'s waitlist ?</p>
                </div>
                <div class="modal-footer">
                    <hr class="default-divider ml-auto">
                    <button type="submit" class="btn btn-link btn-warning waves-effect" name="waitlist" id="waitlist" onclick="showSuccess();" style="color: #EEEEEE;">Yes, Add to Waitlist</button>
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CANCEL</button>
                </div>
            </form>
        </div>
    </div>
</div>