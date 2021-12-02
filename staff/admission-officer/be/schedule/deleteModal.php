<!-- DELETE MODAL -->
<div class="modal fade" id="delete<?php echo $fetch['id']?>" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action = "be/schedule/delete.php" method="POST" enctype="multipart/form-data">
                <input class="hidden" name="staff_id" value="<?php echo $staff_id?>">
                <input class="hidden" name="staff_username" value="<?php echo $username?>">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Remove Schedule</h4>
                    <hr class="default-divider ml-auto">
                </div>
                <div class="modal-body">
                <input class="hidden" value="<?php echo $fetch['id'] ?>" name="id">
                <p style="font-size: 15px;">Are you sure you want to remove this schedule?</p>
                </div>
                <div class="modal-footer">
                    <hr class="default-divider ml-auto">
                    <button type="submit" class="btn btn-link waves-effect" name="delete" id="delete">CONFIRM</button>
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                </div>
            </form>
        </div>
    </div>
</div>