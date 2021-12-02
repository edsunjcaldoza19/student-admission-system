 <!-- UPDATE MODAL  -->
             <div class="modal fade" id="update<?php echo $fetch['course_id']?>" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action = "be/program_config/update.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="staff_id" value="<?php echo $staff_id?>">
                        <input type="hidden" name="staff_username" value="<?php echo $username?>">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Configure Program</h4>
                            <hr class="default-divider ml-auto">
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id" value="<?php echo $fetch['course_id']?>">
                            <input type="hidden" name="sy_id" value="<?php echo $fetch1['id']?>">
                            <b>Program Name:</b>
                            <p><?php echo $fetch['course_name']?></p>
                            <br>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="number" class="form-control" name="program_quota" value="<?php echo $fetch['course_quota'] ?>"required autofocus>
                                    <label class="form-label">Program Quota</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="number" class="form-control" name="waitlist_quota" value="<?php echo $fetch['waitlist_quota'] ?>" required autofocus>
                                    <label class="form-label">Waitlist Quota</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="number" class="form-control" name="interview_passing" value="<?php echo $fetch['interview_passing_score'] ?>" required autofocus>
                                    <label class="form-label">Interview Passing Rating</label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-link waves-effect" name="update" id="update">SAVE CHANGES</button>
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>