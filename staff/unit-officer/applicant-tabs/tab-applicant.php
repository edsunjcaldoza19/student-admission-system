<!-- APPLICANT PROFILE -->
<div class="col-xs-12 col-sm-3">
    <div class="card profile-card">
        <div class="profile-header">&nbsp;</div>
        <div class="profile-body">
            <?php
                $image = (!empty($fetch['applicant_picture'])) ? '../../images/applicant-img/applicant-profile/'.$fetch['applicant_picture'] : '../../images/user-lg.jpg';
            ?>
            <div class="image-area">
                <?php echo "<img src='".$image."'  width='180px' height='180'";?>
            </div>
            <div class="content-area" style="margin: 15px 0px 0px 0px;">
                <p class="table-subheader"><?php
                echo $fetch['last_name'];
                echo ", ";
                echo $fetch['first_name'];
                echo " ";
                echo $fetch['middle_name'];
                ?></p>
                <p><?php echo $fetch['age'];?> years old</p>
                <p style="color: #0A079D;"><?php echo $fetch['entry'];?> Applicant</p>
            </div>
        </div>
    </div>
    <div>
        <div class="body" align="center">
            <p style="font-size: 14px; font-weight: 600; margin-top: 5px;">Admission Qualification Summary</p>
            <p>Application Form</p>
            <?php
                if($fetch['form_status'] == "Pending"){
                    echo '<p class="label-blue">Pending</p>';
                }else if($fetch['form_status'] == "Approved"){
                    echo '<p class="label-green">Approved</p>';
                }else if($fetch['form_status'] == "Disapproved"){
                    echo '<p class="label-red">Disapproved</p>';
                }
            ?>
            <hr class="default-divider ml-auto" style="margin: 5px;">
            <p>Entrance Examination</p>
            <?php
                if($fetch['exam_status'] == "Pending"){
                    echo '<p class="label-blue">Pending</p>';
                }else if($fetch['exam_status'] == "Scored"){
                    echo '<p class="label-blue">Scored</p>';
                }else if($fetch['exam_status'] == "Qualified"){
                    echo '<p class="label-green">Qualified</p>';
                }else if($fetch['exam_status'] == "Unqualified"){
                    echo '<p class="label-red">Unqualified</p>';
                }
            ?>
            <hr class="default-divider ml-auto" style="margin: 5px;">
            <p>Interview</p>
            <?php
                if($fetch['interview_status_1'] == "Pending" || $fetch['interview_status_2'] == "Pending"){
                    echo '<p class="label-blue">Pending</p>';
                }else if($fetch['interview_status_1'] == "Qualified" || $fetch['interview_status_2'] == "Qualified"){
                    echo '<p class="label-green">Qualified</p>';
                }else if($fetch['interview_status_1'] == "Unqualified" || $fetch['interview_status_2'] == "Unqualified"){
                    echo '<p class="label-red">Unqualified</p>';
                }
            ?>
            <hr class="default-divider ml-auto" style="margin: 5px;">
            <p>Actions</p>
            <button type="submit" data-toggle="modal" data-target="#approve<?php echo $fetch['id']?>" class="btn btn-block btn-lg bg-green waves-effect"><i class="material-icons" style="font-size: 15px;">check</i> APPROVE</button>
            <button type="submit" data-toggle="modal" data-target="#reject<?php echo $fetch['id']?>"class="btn btn-block btn-lg bg-red waves-effect"><i class="material-icons" style="font-size: 15px;">close</i> DISAPPROVE</button>
            <button type="submit" data-toggle="modal" data-target="#waitlist<?php echo $fetch['id']?>" class="btn btn-block btn-lg bg-orange waves-effect"><i class="material-icons" style="font-size: 15px;">move_to_inbox</i>ADD TO WAITLIST</button>
        </div>
    </div>
</div>