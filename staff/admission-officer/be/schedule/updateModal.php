<!-- UPDATE MODAL -->
<div class="modal fade" id="update<?php echo $fetch['id']?>" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action = "be/schedule/update.php" method="POST" enctype="multipart/form-data">
                <input class="hidden" name="staff_id" value="<?php echo $staff_id?>">
                <input class="hidden" name="staff_username" value="<?php echo $username?>">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Update Schedule Details</h4>
                    <hr class="default-divider ml-auto">
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" value="<?php echo $fetch['id']; ?>">
                    <div class="form-group form-float">
                        <div class="form-line focused">
                            <input type="date" value="<?php echo $fetch['schedule_date']; ?>" class="datepicker form-control" name="date" required autofocus>
                            <label class="form-label">Schedule Date</label>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" value="<?php echo $fetch['schedule_desc']; ?>" class="form-control" name="description" placeholder="Description" required autofocus>
                            <label class="form-label">Schedule Description</label>
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