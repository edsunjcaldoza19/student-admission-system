 <!-- UPDATE MODAL (DEPARTMENT) -->
 <div class="modal fade" id="addModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action = "be/program/add.php" method="POST" enctype="multipart/form-data">
                        <input class="hidden" name="staff_id" value="<?php echo $staff_id?>">
                        <input class="hidden" name="staff_username" value="<?php echo $username?>">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">New Program Offering</h4>
                            <hr class="default-divider ml-auto">
                        </div>
                        <div class="modal-body">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="name" required autofocus>
                                    <label class="form-label">Program Name (e.g. Bachelor of Science in Information Technology)</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="acronym" required autofocus>
                                    <label class="form-label">Program Acronym (e.g. BSIT)</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <select class="form-control" name="unitID" required>
                                        <?php
                                            require 'be/database/db_pdo.php';
                                            $sqlUnit = $conn->prepare("SELECT * FROM `tbl_unit`");
                                            $sqlUnit->execute();
                                            while($fetchUnit = $sqlUnit->fetch()){
                                        ?>
                                            <option name="unitID" value="<?php echo $fetchUnit['id'] ?>">
                                            <?php echo $fetchUnit['unit_name'] ?></option>
                                        <?php
                                            }
                                        ?>
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