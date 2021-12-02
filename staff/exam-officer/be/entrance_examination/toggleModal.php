<!-- --TOGGLE MODAL-- -->
<div class="modal fade" id="toggle<?php echo $fetch['id']?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action = "be/entrance_examination/toggle.php" method="POST">
                <div class="modal-header">
                    <h4 class="modal-title logout-modal-title">Toggle Entrance Examination</h5>
                    <hr class="default-divider ml-auto">
                </div>
                <div class="modal-body logout-modal-body">
                    <input type="hidden" name="id" id="id" value="<?php echo $fetch['id'] ?>">
                    <input type="hidden" name="status" id="status" value="<?php echo $fetch['enable_exam'] ?>">
                    <p class="card-dashboard-header" style="font-size: 15px;"><?php if($fetch['enable_exam'] == 0){echo 'Enable ';}else{
                    echo 'Disable ';} ?>entrance examination for this school year?</p>
                </div>
                <div class="modal-footer">
                    <hr class="default-divider ml-auto">
                    <button type="submit" class="btn btn-link waves-effect" name="toggle" id="toggle">CONFIRM</button>
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                </div>
            </form>
        </div>
    </div>
</div>