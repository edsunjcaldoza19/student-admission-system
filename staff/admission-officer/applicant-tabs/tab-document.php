                    <!--- ## START PARENT INFORMATION --->
                    <div role="tabpanel" class="tab-pane fade in" id="documents">
                        <div class="form-horizontal">
                            <div class="body" style="padding: 10px 0px;">
                            <p class="table-subheader">Submitted Documents (click to enlarge)</p>
                                <div id="aniimated-thumbnials" class="list-unstyled row clearfix">
                                <?php
                                    $sqlCard = $conn->prepare("SELECT * FROM `tbl_applicant_card` WHERE `card_applicant_id` = $applicant_account_id");
                                    $sqlCard->execute();

                                    while($fetchCard = $sqlCard->fetch()){
                                ?>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <a href="../../images/applicant-img/applicant-card/<?php echo $fetchCard['card_image'];?>" data-sub-html="Report Card">
                                        <img class="img-responsive thumbnail" style="width: 360px; height: 240px;" src="../../images/applicant-img/applicant-card/<?php echo $fetchCard['card_image'];?>">
                                     </a>
                                </div>
                                <?php
                                    }
                                ?>
                                <?php
                                    $sqlMedical = $conn->prepare("SELECT * FROM `tbl_applicant_medical` WHERE `medical_applicant_id` = $applicant_account_id");
                                    $sqlMedical->execute();
                                    while($fetchMedical = $sqlMedical->fetch()){
                                ?>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="<?php if($fetchMedical['medical_image'] == 'N/A'){echo 'display:none';}else{echo 'display: block';} ?>">
                                    <a href="../../images/applicant-img/applicant-medical/<?php echo $fetchMedical['medical_image'];?>" data-sub-html="Medical Certificate">
                                        <img class="img-responsive thumbnail" style="width: 360px; height: 240px;" src="../../images/applicant-img/applicant-medical/<?php echo $fetchMedical['medical_image'];?>">
                                     </a>
                                </div>
                                <?php
                                    }
                                ?>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- ## END PARENT INFORMATION -->