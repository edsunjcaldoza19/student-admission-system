<!-- ADD MODAL -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action = "be/faqs/add.php" method="POST" enctype="multipart/form-data">
                <input class="hidden" name="staff_id" value="<?php echo $staff_id?>">
                <input class="hidden" name="staff_username" value="<?php echo $username?>">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">New FAQ Entry</h4>
                    <hr class="default-divider ml-auto">
                </div>
                <div class="modal-body">
                    <div class="form-group form-float">
                        <div class="form-line">
                            <textarea class="form-control" name="question" style="resize: none; height: 100px;" required></textarea>
                            <label class="form-label">Enter Question</label>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <textarea class="form-control" name="answer" style="resize: none; height: 100px;" required></textarea>
                            <label class="form-label">Enter Answer</label>
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