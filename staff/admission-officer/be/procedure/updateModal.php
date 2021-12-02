<!-- UPDATE MODAL -->
<div class="modal fade" id="update<?php echo $fetch['id']?>" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action = "be/procedure/update.php" method="POST" enctype="multipart/form-data">
                        <input class="hidden" name="staff_id" value="<?php echo $staff_id?>">
                        <input class="hidden" name="staff_username" value="<?php echo $username?>">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Update Procedure</h4>
                            <hr class="default-divider ml-auto">
                        </div>
                        <div class="modal-body">
                            <input type="hidden" value="<?php echo $fetch['id']; ?>" name="id">
                            <div class="form-group form-float">     
                                <div class="form-line">
                                    <input type="number" value="<?php echo $fetch['procedure_step_num']; ?>" class="form-control" name="step" placeholder="Step No." required autofocus>
                                    <label class="form-label">Procedure Number</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" value="<?php echo $fetch['procedure_desc']; ?>" class="form-control" name="description" placeholder="Description" required autofocus>
                                    <label class="form-label">Description</label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <hr class="default-divider ml-auto">
                            <button type="submit" class="btn btn-link waves-effect" name="update" id="update">SAVE CHANGES</button>
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>