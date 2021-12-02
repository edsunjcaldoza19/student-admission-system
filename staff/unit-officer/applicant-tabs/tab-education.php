                                    <!--- ## START PARENT INFORMATION --->
                                    <div role="tabpanel" class="tab-pane fade in" id="education">
                                        <div class="form-horizontal">
                                            <br>
                                            <p class="table-subheader">Kindergarten</p>
                                             <div class="form-group">
                                                <div class="col-sm-6">
                                                	<label>School Name</label>
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="kinder_name"
                                                        value="<?php echo $fetch['kinder_name'];?>" disabled="true">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>School Address</label>
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="kinder_address"
                                                        value="<?php echo $fetch['kinder_address'];?>" disabled="true">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-6">
                                                    <label>Year Graduated</label>
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="kinder_year_graduated"
                                                        value="<?php echo $fetch['kinder_year_graduated'];?>" disabled="true">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>Honors Received</label>
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="kinder_honors"
                                                        value="<?php echo $fetch['kinder_honors'];?>" disabled="true">
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="table-subheader">Elementary</p>
                                            <div class="form-group">
                                                <div class="col-sm-6">
                                                    <label>School Name</label>
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="elem_name"
                                                        value="<?php echo $fetch['elem_name'];?>" disabled="true">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>School Address</label>
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="elem_address"
                                                        value="<?php echo $fetch['elem_address'];?>" disabled="true">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-6">
                                                    <label>Year Graduated</label>
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="elem_year_graduated"
                                                        value="<?php echo $fetch['elem_year_graduated'];?>" disabled="true">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>Honors Received</label>
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="elem_honors"
                                                        value="<?php echo $fetch['elem_honors'];?>" disabled="true">
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="table-subheader">Junior High School</p>
                                            <div class="form-group">
                                                <div class="col-sm-6">
                                                    <label>School Name</label>
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="jhs_name"
                                                        value="<?php echo $fetch['jhs_name'];?>" disabled="true">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>School Address</label>
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="jhs_address"
                                                        value="<?php echo $fetch['jhs_address'];?>" disabled="true">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-6">
                                                    <label>Year Graduated</label>
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="jhs_year_graduated"
                                                        value="<?php echo $fetch['jhs_year_graduated'];?>" disabled="true">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>Honors Received</label>
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="jhs_honors"
                                                        value="<?php echo $fetch['jhs_honors'];?>" disabled="true">
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="table-subheader">Senior High School</p>
                                            <div class="form-group">
                                                <div class="col-sm-6">
                                                    <label>School Name</label>
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="shs_name"
                                                        value="<?php echo $fetch['jhs_name'];?>" disabled="true">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>School Address</label>
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="shs_address"
                                                        value="<?php echo $fetch['shs_address'];?>" disabled="true">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-6">
                                                    <label>Year Graduated</label>
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="shs_year_graduated"
                                                        value="<?php echo $fetch['shs_year_graduated'];?>" disabled="true">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>Honors Received</label>
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="shs_honors"
                                                        value="<?php echo $fetch['shs_honors'];?>" disabled="true">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- College -->
                                            <div style="<?php if($fetch['entry'] == 'Transferee'){echo 'display: block';} else{echo 'display: none';}?>">
                                                <p class="table-subheader">College (First)</p>
                                                <div class="form-group">
                                                    <div class="col-sm-6">
                                                        <label>School Name</label>
                                                        <div class="form-line">
                                                            <input type="text" class="form-control" name="college_name"
                                                            value="<?php echo $fetch['college_name'];?>" disabled="true">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label>School Address</label>
                                                        <div class="form-line">
                                                            <input type="text" class="form-control" name="college_address"
                                                            value="<?php echo $fetch['college_address'];?>" disabled="true">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-6">
                                                        <label>Year Graduated</label>
                                                        <div class="form-line">
                                                            <input type="text" class="form-control" name="college_year_graduated"
                                                            value="<?php echo $fetch['college_year_graduated'];?>" disabled="true">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label>Honors Received</label>
                                                        <div class="form-line">
                                                            <input type="text" class="form-control" name="college_honors"
                                                            value="<?php echo $fetch['college_honors'];?>" disabled="true">
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="table-subheader">College (Second)</p>
                                                <div class="form-group">
                                                    <div class="col-sm-6">
                                                        <label>School Name</label>
                                                        <div class="form-line">
                                                            <input type="text" class="form-control" name="college_name2"
                                                            value="<?php echo $fetch['college_name2'];?>" disabled="true">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label>School Address</label>
                                                        <div class="form-line">
                                                            <input type="text" class="form-control" name="college_address2"
                                                            value="<?php echo $fetch['college_address2'];?>" disabled="true">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-6">
                                                        <label>Year Graduated</label>
                                                        <div class="form-line">
                                                            <input type="text" class="form-control" name="college_year_graduated2"
                                                            value="<?php echo $fetch['college_year_graduated2'];?>" disabled="true">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label>Honors Received</label>
                                                        <div class="form-line">
                                                            <input type="text" class="form-control" name="college_honors2"
                                                            value="<?php echo $fetch['college_honors2'];?>" disabled="true">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ## END PARENT INFORMATION -->