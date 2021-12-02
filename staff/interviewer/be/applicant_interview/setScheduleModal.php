<!-- ADD EXAMINATION MODULE MODAL -->
<div class="modal fade" id="setSchedule<?php echo $fetch['id']; ?>" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?php
                $syID = $_GET['sy_id'];
            ?>
            <form action = "be/applicant_interview/setSchedule.php?sy_id=<?php echo $syID;?>" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Set Interview Schedule</h4>
                    <hr class="default-divider ml-auto">
                </div>
                <div class="modal-body">
                    <input type="hidden" value="<?php echo $fetch['applicant_account_id']; ?>" name="id">
                    <input type="hidden" value="<?php echo $fetch['program_first_choice']; ?>" name="firstChoice">
                    <input type="hidden" value="<?php echo $fetch['program_second_choice']; ?>" name="secondChoice">
                    <input type="hidden" value="<?php echo $fetch['course_id']; ?>" name="courseID">
                    <input type="hidden" value="<?php echo $staff_id; ?>" name="staffID">
                    <input type="hidden" name="staff_username" value="<?php echo $username?>">
                    <div class="form-group">
                    <p style="font-weight: 600;">Set Interview Schedule for: </p>
                        <p>
                            <?php echo $fetch['last_name'].', '.$fetch['first_name'].' '.$fetch['middle_name']?>
                        </p>       
                    </div>
                    <div class="form-group">
                    <p style="font-weight: 600;">Preferred Method of Interview: </p>
                        <p>
                            <?php echo $fetch['interview_preferred_method']?>
                        </p>       
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <select class="form-control" name="method" id="method">
                                <option value="" disabled selected="">Select Method for Interview</option>
                                <option value="Face-to-Face">Face-to-Face</option>
                                <option value="Video Call">Video Call</option>
                            </select>
                            <label class="form-label">Interview Method</label>
                        </div>
                    </div>
                    <div class="form-group form-float" id="callLink" style="display: none;">
                        <div class="form-line">
                            <input type="text" class="form-control" name="link" autofocus>
                            <label class="form-label">Enter Video Call Link</label>
                        </div>
                    </div>
                    <div class="form-group form-float" id="venue" style="display: none;">
                        <div class="form-line">
                            <input type="text" class="form-control" name="venue" autofocus>
                            <label class="form-label">Enter Venue</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group form-float">
                                <div class="form-line focused">
                                    <input type="date" class="form-control" name="date" required autofocus>
                                    <label class="form-label">Date</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-float">
                                <div class="form-line focused">
                                    <input type="time" class="form-control" name="time" required autofocus>
                                    <label class="form-label">Time</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <hr class="default-divider ml-auto">
                        <button type="submit" class="btn btn-link waves-effect" name="setSchedule" id="setSchedule" >SAVE CHANGES</button>
                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

