                                    <!--- ## START REFERENCES INFORMATION --->
                                    <div role="tabpanel" class="tab-pane fade in" id="references">
                                        <div class="form-horizontal">
                                            <br>
                                            <p class="table-subheader">Character References</p>
                                             <div class="form-group">
                                                <div class="col-sm-4">
                                                	<label>Name</label>
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="reference_name"
                                                        value="<?php echo $fetch['reference_name'];?>" disabled="true">
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label>Address</label>
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="reference_address"
                                                        value="<?php echo $fetch['reference_address'];?>" disabled="true">
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label>Contact</label>
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="reference_contact"
                                                        value="<?php echo $fetch['reference_contact'];?>" disabled="true">
                                                    </div>
                                                </div>
                                            </div>
                                             <div class="form-group">
                                                <div class="col-sm-4">
                                                    <label>Name</label>
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="reference_name2"
                                                        value="<?php echo $fetch['reference_name2'];?>" disabled="true">
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label>Address</label>
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="reference_address2"
                                                        value="<?php echo $fetch['reference_address2'];?>" disabled="true">
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label>Contact</label>
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="reference_contact2"
                                                        value="<?php echo $fetch['reference_contact2'];?>" disabled="true">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- ## END REFERENCES INFORMATION -->

                                            <!-- ## START RELEVANT INFORMATION -->
                                            <p class="table-subheader">Other Relevant Information</p>
                                            <div class="form-group">
                                                <div class="col-sm-6">
                                                    <label>Previous Application</label>
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="previous_application"
                                                        value="<?php echo $fetch['previous_application'];?>" disabled="true">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>Academic Year</label>
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="previous_academic_year"
                                                        value="<?php echo $fetch['previous_academic_year'];?>" disabled="true">
                                                    </div>
                                                </div>
                                            </div>
                                             <div class="form-group">
                                                <div class="col-sm-12">
                                                    <label>Hobbies</label>
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="hobbies"
                                                        value="<?php echo $fetch['hobbies'];?>" disabled="true">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-6">
                                                    <label>Club Member</label>
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="club_member"
                                                        value="<?php echo $fetch['club_member'];?>" disabled="true">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>Club Name</label>
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="club_name"
                                                        value="<?php echo $fetch['club_name'];?>" disabled="true">
                                                    </div>
                                                </div>
                                            </div>
                                             <div class="form-group">
                                                <div class="col-sm-6">
                                                    <label>Disabilty</label>
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="disability"
                                                        value="<?php echo $fetch['disability'];?>" disabled="true">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>Name of Disability</label>
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="disability_name"
                                                        value="<?php echo $fetch['disability_name'];?>" disabled="true">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <label>Personal Statement</label>
                                                   <div class="form-line">
                                                        <textarea name="Personal Statement" cols="30" rows="5" class="form-control no-resize" disabled="true"><?php echo $fetch['personal_statement'];?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    