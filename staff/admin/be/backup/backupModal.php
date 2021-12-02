<!-- BACKUP MODAL -->
<div class="modal fade" id="backupModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="myForm" action="be/backup/backup.php" method="POST">
                <input class="hidden" name="staff_id" value="<?php echo $staff_id?>">
                <input class="hidden" name="staff_username" value="<?php echo $username?>">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Backup Database</h4>
                    <hr class="default-divider ml-auto">
                </div>
                <div class="modal-body">
                <input class="hidden" value="<?php echo $fetch['id'] ?>" name="id">
                <p style="font-size: 15px;">Backup the current database, this will download an SQL file?</p>
                </div>
                <div class="modal-footer">
                    <hr class="default-divider ml-auto">
                    <button type="submit" class="btn btn-link waves-effect" name="backup" id="backup">PROCEED</button>
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                </div>
            </form>
        </div>
    </div>
</div>
