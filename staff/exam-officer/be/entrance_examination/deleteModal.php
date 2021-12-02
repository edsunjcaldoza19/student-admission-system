<!-- --DELETE MODAL-- -->
<div class="modal fade" id="delete<?php echo $fetch['id']?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action = "be/entrance_examination/delete.php" method="POST">
                <div class="modal-header">
                    <h4 class="modal-title logout-modal-title">Delete Examination Module</h5>
                    <hr class="default-divider ml-auto">
                </div>
                <div class="modal-body logout-modal-body">
                    <p class="card-dashboard-header">Are you sure you want to remove this Exam from the database?</p>
                    <input type="hidden" name="id" id="id" value="<?php echo $fetch['id'] ?>">
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