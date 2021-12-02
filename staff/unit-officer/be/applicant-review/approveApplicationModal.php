<!-- APPROVE MODAL -->c
<div class="modal fade" id="approve<?php echo $fetch['id']?>" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?php
                $syID = $_GET['sy_id'];
            ?>
            <form action = "be/applicant-review/approveApplication.php?syID=<?php echo $syID?>&appId=<?php echo $fetch['id']?>&courseId=<?php echo $fetchCourse['course_id']?>" method="POST">
                <input type="hidden" name="staff_id" value="<?php echo $staff_id?>">
                <input type="hidden" name="staff_username" value="<?php echo $username?>">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Approve Application</h4>
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
                    <p class="card-dashboard-header">Are you sure you want to finalize approval of
                    <b>
                    <?php 
                        echo $fetch['first_name'].' '.$fetch['middle_name'].' '.$fetch['last_name'];
                    ?></b>'s 
                application for the program <b><?php echo $fetchCourse['course_name']?></b>?</p>
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