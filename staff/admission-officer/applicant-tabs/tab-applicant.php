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
        <div class="body">
            <button type="submit" data-toggle="modal" data-target="#approve<?php echo $fetch['id']?>" class="btn btn-block btn-lg bg-green waves-effect" ><i class="material-icons" style="font-size: 15px;">check</i> APPROVE</button>
            <button type="submit" data-toggle="modal" data-target="#reject<?php echo $fetch['id']?>"class="btn btn-block btn-lg bg-red waves-effect"><i class="material-icons" style="font-size: 15px;">close</i> DISAPPROVE</button>
        </div>
    </div>
</div>