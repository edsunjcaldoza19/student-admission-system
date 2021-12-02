<!-- APPROVE MODAL -->
<div class="modal fade" id="notify<?php echo $fetch['id']?>" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action = "be/notify/notify.php" method="POST">
                <input class="hidden" name="staff_id" value="<?php echo $staff_id?>">
                <input class="hidden" name="staff_username" value="<?php echo $username?>">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Assign Student Number</h4>
                    <hr class="default-divider ml-auto">
                </div>
                <div class="modal-body">
                    <input type="hidden" name="applicantID" id="applicantID" value="<?php echo $fetch['id'] ?>">
                    <input type="hidden" name="email" id="email" value="<?php echo $fetch['email'] ?>">
                    <p class="card-dashboard-header">Student Name: 
                    <br>
                        <b>
                            <?php 
                                echo $fetch['first_name'].' '.$fetch['middle_name'].' '.$fetch['last_name'];
                                echo '<input type="hidden" name="name" value="'.$fetch['first_name'].' '.$fetch['middle_name'].' '.$fetch['last_name'].'">';
                            ?>  
                        </b>
                    </p>
                    <p class="card-dashboard-header">Recommended Program:
                    <br>
                        <b>
                            <?php 
                                if($fetch['approved_first_choice'] == 1 && $fetch['approved_second_choice'] == 1){
                                    echo $fetch1['course_name'];
                                    echo '<input type="hidden" name="program" value="'.$fetch1['course_name'].'">';
                                }else if($fetch['approved_first_choice'] == 1 && $fetch['approved_second_choice'] == 0){
                                    echo $fetch1['course_name'];
                                    echo '<input type="hidden" name="program" value="'.$fetch1['course_name'].'">';
                                }else if($fetch['approved_first_choice'] == 1 && $fetch['approved_second_choice'] == 3){
                                    echo $fetch1['course_name'];
                                    echo '<input type="hidden" name="program" value="'.$fetch1['course_name'].'">';
                                }else if($fetch['approved_first_choice'] == 0 && $fetch['approved_second_choice'] == 1){
                                    echo $fetch2['course_name'];
                                    echo '<input type="hidden" name="program" value="'.$fetch2['course_name'].'">';
                                }else if($fetch['approved_first_choice'] == 3 && $fetch['approved_second_choice'] == 1){
                                    echo $fetch2['course_name'];
                                    echo '<input type="hidden" name="program" value="'.$fetch2['course_name'].'">';
                                }
                            ?> 
                        </b>
                    </p>
                    <hr class="default-divider ml-auto">
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="idNum" required autofocus>
                            <label class="form-label">Enter Student ID Number</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <hr class="default-divider ml-auto">
                    <button type="submit" class="btn btn-link btn-success waves-effect" name="send" id="send" onclick="showSuccess();" style="color: #EEEEEE;">Assign Student Number</button>
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CANCEL</button>
                </div>
            </form>
        </div>
    </div>
</div>