    <div class="rightside">
        <div class="page-head">
            <h1>Uploads  <small>add to design directory</small></h1>
            <ol class="breadcrumb">
                <li>You are here:</li>
                <li><a href="<?php echo base_url(); ?>">Home</a></li>
                <li class="active">Uploads</li>
            </ol>
        </div>

        <div class="content">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <?php echo form_open_multipart('upload'); ?>
                        <div class="box">
                            <div class="box-title">
                                <i class="fa fa-upload"></i>
                                <h3>New Upload</h3>
                                <div class="pull-right box-toolbar">
                                    <a href="#" class="btn btn-link btn-xs remove-box"><i class="fa fa-times"></i></a>
                                </div>          
                            </div>
                            <div class="box-body">
                                <?php echo $err_msg; ?>
                                <div class="form-group">
                                    <input type="hidden" name="upload_id" value="<?php if(!empty($e_id)){echo $e_id;} ?>" />
                                    <input type="hidden" name="pics" value="<?php if(!empty($e_pics)){echo $e_pics;} ?>" />
                                    <input type="hidden" name="pics_small" value="<?php if(!empty($e_pics_small)){echo $e_pics_small;} ?>" />
                                    <input type="hidden" name="pics_square" value="<?php if(!empty($e_pics_square)){echo $e_pics_square;} ?>" />
                                    <label>Design Category</label>
                                    <select name="service" class="form-control" placeholder="Services/Products" required>
                                        <option value="">Select Service/Product</option>
                                        <option value="<?php if(!empty($e_cat)){echo $e_cat;} ?>" <?php if(!empty($e_cat)){echo 'selected="selected"';} ?>><?php if(!empty($e_cat)){echo $e_cat;} ?></option>
                                        <optgroup label="PROMOTIONS">
                                            <option value="Logos">Logos</option>
                                            <option value="Office Correspondence">Office Correspondence</option>
                                            <option value="Marketing/Promotional">Marketing/Promotional</option>
                                        </optgroup>
                                        <optgroup label="CLOTHS">
                                            <option value="Shirts">Shirts</option>
                                            <option value="Trousers">Trousers</option>
                                            <option value="Male Blazers">Male Blazers</option>
                                            <option value="Jalamias">Jalamias</option>
                                            <option value="Male Natives">Male Natives</option>
                                            <option value="Female Blazers">Female Blazers</option>
                                            <option value="Female Natives">Female Natives</option>
                                            <option value="Polo">Polo</option>
                                        </optgroup>
                                    </select>
                                </div> 
                                <div class="form-group">
                                    <label>Select Design</label>
                                    <input type="file" name="up_file" class="btn btn-info file-inputs" title="Select file">
                                    <?php
										if(!empty($e_pics_square)){
											echo '<br /><br /><img alt="" src="'.base_url().$e_pics_square.'" />';	
										}
									?>
                                </div>
                            </div>
                            <div class="box-footer clearfix">
                                <button type="submit" name="submit" class="pull-left btn btn-success">Update Record <i class="fa fa-arrow-circle-right"></i></button>
                            </div>
                        </div>
                    <?php echo form_close(); ?>
                </div>
                
                
                <div class="col-lg-8 col-md-6 col-sm-6 col-xs-12">
                    <div class="box">
                        <div class="box-title">
                            <i class="fa fa-upload"></i>
                            <h3>Upload Directory</h3>
                            <div class="pull-right box-toolbar">
                                <a href="#" class="btn btn-link btn-xs remove-box"><i class="fa fa-times"></i></a>
                            </div>          
                        </div>
                        <div class="box-body">
                            <?php
								$dir_list = '';
								if(!empty($allup)){
									foreach($allup as $up){
										$dir_list .= '
											<tr>
												<td>'.$up->reg_date.'</td>
												<td>'.$up->cat.'</td>
												<td><img alt="" src="'.base_url().$up->pics_square.'" width="75" /></td>
												<td>
													<a href="'.base_url().'upload?edit='.$up->id.'" class="btn btn-primary btn"><i class="fa fa-pencil"></i> Edit</a>
													<a href="'.base_url().'upload?del='.$up->id.'" class="btn btn-danger btn"><i class="fa fa-times"></i> Delete</a>
												</td>
											</tr>
										';	
									}
								}
							?>	
                            
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Category</th>
                                        <th>Design</th>
                                        <th>Manage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php echo $dir_list; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Date</th>
                                        <th>Category</th>
                                        <th>Design</th>
                                        <th>Manage</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>