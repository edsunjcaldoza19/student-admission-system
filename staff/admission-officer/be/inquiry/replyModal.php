<!-- REPLY MODAL -->
<div class="modal fade" id="reply<?php echo $fetch['id']?>" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action = "be/inquiry/reply.php" method="POST">
                <input class="hidden" name="staff_id" value="<?php echo $staff_id?>">
                <input class="hidden" name="staff_username" value="<?php echo $username?>">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Reply Ticket</h4>
                    <hr class="default-divider ml-auto" style="margin-bottom: 5px;">
                </div>
                <div class="modal-body">
                    <input type="hidden" name="ticketID" value="<?php echo $fetch['id']?>">
                    <input type="hidden" name="role" value="<?php echo $role?>">
                    <div class="feedback-reply-details">
                        <p style="font-size: 15px;">Inquiry Ticket Details</p>
                        <hr class="default-divider ml-auto" style=" margin: 10px 0px 10px 0px; background-color: black;">
                        <p><b>From: </b> <?php echo $fetch['first_name'].' '.$fetch['middle_name']
                        .' '.$fetch['last_name'].' ('.$fetch['entry'].')'?></p>
                        <p><b>Subject: </b> <?php echo $fetch['inquiry_subject']?> </p>
                    </div>
                    <hr class="default-divider ml-auto" style="margin: 10px 0px 10px 0px; background-color: black;">
                    <div class="feedback-reply-message">
                        <p><b>Message: </b></p>
                        <p><?php echo $fetch['inquiry_message']?></p>
                    </div>
                    <hr class="default-divider ml-auto" style="margin: 10px 0px 10px 0px; background-color: black;">
                    <div class="feedback-reply-area">
                        <p><b>Reply: </b></p>
                        <textarea class="feedback-reply-textarea" name="reply" id="reply" placeholder="Enter your reply here..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <hr class="default-divider ml-auto">
                    <button type="submit" class="btn btn-link waves-effect" name="send" id="send">SEND REPLY</button>
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                </div>
            </form>
        </div>
    </div>
</div>