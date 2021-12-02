 <!-- UPDATE MODAL (UNIT) -->
             <div class="modal fade" id="update<?php echo $fetch['id']?>" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action = "be/unit/update.php" method="POST" enctype="multipart/form-data">
                        <input class="hidden" name="staff_id" value="<?php echo $staff_id?>">
                        <input class="hidden" name="staff_username" value="<?php echo $username?>">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Update Academic Unit</h4>
                            <hr class="default-divider ml-auto">
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id" value="<?php echo $fetch['id']?>">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="name" value="<?php echo $fetch['unit_name']?>"required autofocus>
                                    <label class="form-label">Unit Name</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="description" value="<?php echo $fetch['unit_desc']?>" required autofocus>
                                    <label class="form-label">Unit Description</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-float">
                                    <select class="form-control show-tick" name="deptID">
                                    <?php
                                        require 'be/database/db_pdo.php';
                                        $sqlDept = $conn->prepare("SELECT * FROM `tbl_department`");
                                        $sqlDept->execute();
                                        while($fetchDept = $sqlDept->fetch()){
                                    ?>
                                        <option name="unitID" <?php if($fetch['unit_dept_id'] == $fetchDept['id'])
                                        {echo 'selected';}?> value="<?php echo $fetchDept['id'] ?>">
                                        <?php echo $fetchDept['dept_name'] ?></option>
                                    <?php
                                        }
                                    ?>
                                    </select>
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