<!--- ## START APPLICANT PROFILE --->

                                    <div role="tabpanel" class="tab-pane fade in active" id="profile">
                                        <div class="form-horizontal">
                                            <br>
                                        	<p class="table-subheader">Application Details</p>
                                            <div class="form-group">
                                                <div class="col-sm-6">
                                                	<label for="Entry Status">Entry Type</label>
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="name" name="name" placeholder="Entry" value="<?php
                                                        echo $fetch['entry'];?>" disabled="true">
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                	<label for="Semester" class="control-label">Semester</label>
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="semester" name="semester" placeholder="Semester" value="<?php echo $fetch['semester'];?>" disabled="true">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                	<label>Program (First Choice)</label>
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="program_first_choice" value="<?php
                                                       echo $fetch['course_name'];?>" disabled="true">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                	<label>Program (Second Choice)</label>
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="program_second_choice"
                                                        value="<?php echo $fetch2['course_name'];?>" disabled="true">
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="table-subheader">Applicant Profile</p>
                                            <div class="form-group">
                                                <div class="col-sm-6">
                                                	<label>Name</label>
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="name"
                                                        value="<?php
                                                       		echo $fetch['last_name'];
                                                       		echo ", ";
                                                       		echo $fetch['first_name'];
                                                       		echo " ";
                                                       		echo $fetch['middle_name'];
                                                   ?>" disabled="true">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                	<label>Date of Birth</label>
                                                    <div class="form-line">
                                                        <input type="date" class="form-control" name="date_birth" value="<?php echo $fetch['date_birth'];?>" disabled="true">
                                                    </div>
                                                </div>
                                            </div>
                                             <div class="form-group">
                                                <div class="col-sm-6">
                                                	<label>Age</label>
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="age"
                                                        value="<?php echo $fetch['age'];?>" disabled="true">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                	<label>Gender</label>
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="gender" value="<?php echo $fetch['gender'];?>" disabled="true">
                                                    </div>
                                                </div>
                                            </div>
                                             <div class="form-group">
                                                <div class="col-sm-6">
                                                	<label>Height </label>
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="height"
                                                        value="<?php echo $fetch['height_feet']; echo "' "; echo $fetch['height_inches'];?>" disabled="true">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                	<label>Weight</label>
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="weight" value="<?php echo $fetch['weight'];?>" disabled="true">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-6">
                                                	<label>Civil Status </label>
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="civil_status"
                                                        value="<?php echo $fetch['civil_status'];?>" disabled="true">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                	<label>Place of Birth</label>
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="place_birth" value="<?php echo $fetch['place_birth'];?>" disabled="true">
                                                    </div>
                                                </div>
                                            </div>
                                             <div class="form-group">
                                                <div class="col-sm-6">
                                                	<label>Citizenship</label>
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="citizenship"
                                                        value="<?php echo $fetch['citizenship'];?>" disabled="true">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                	<label>Address</label>
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="address" value="<?php echo $fetch['address'];?>" disabled="true">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-6">
                                                	<label>Mailing Address</label>
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="mailing_address"
                                                        value="<?php echo $fetch['mailing_address'];?>" disabled="true">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                	<label>Religion</label>
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="religion" value="<?php echo $fetch['religion'];?>" disabled="true">
                                                    </div>
                                                </div>
                                            </div>
                                             <div class="form-group">
                                                <div class="col-sm-6">
                                                	<label>Mobile Number</label>
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="mobile_number"
                                                        value="<?php echo $fetch['mobile_number'];?>" disabled="true">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--- ## END PROFILE --->