<!-- ADD MODAL -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action = "be/academic_year/add.php" method="POST" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">New Academic Year</h4>
                            <hr class="default-divider ml-auto">
                        </div>
                        <div class="modal-body">
                            <input class="hidden" name="staff_id" value="<?php echo $staff_id?>">
                            <input class="hidden" name="staff_username" value="<?php echo $username?>">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="year" required autofocus>
                                    <label class="form-label">Academic Year (e.g. 2020-2021)</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <select class="form-control" name="enableExam" id="enableExam" required>
                                        <option value="" disabled selected>Enable Entrance Exam</option>
                                        <option value="1">Enable</option>
                                        <option value="0">Disable</option>
                                    </select>   
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <select class="form-control" name="status" id="status" required>
                                        <option value="" disabled selected>Set Status</option>
                                        <option value="1">Active (Deactivates currently active year*)</option>
                                        <option value="0">Inactive</option>
                                    </select>   
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <hr class="default-divider ml-auto">
                            <button type="submit" class="btn btn-link waves-effect" name="add" id="add">SAVE CHANGES</button>
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>