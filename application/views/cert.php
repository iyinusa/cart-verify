    <div class="rightside">
        <div class="page-head">
            <h1>Certficates</h1>
            <ol class="breadcrumb">
                <li>You are here:</li>
                <li><a href="<?php echo base_url(); ?>">Home</a></li>
                <li class="active">Certficates</li>
            </ol>
        </div>

        <div class="content">
            <div class="row">
                <div class="col-xs-12">
                    <?php echo form_open_multipart('cert'); ?>
                            <div class="box">
                                <div class="box-title">
                                    <i class="fa fa-book"></i>
                                    <h3>New Certificate</h3>
                                    <div class="pull-right box-toolbar">
                                        <a href="#" class="btn btn-link btn-xs remove-box"><i class="fa fa-times"></i></a>
                                    </div>          
                                </div>
                                <div class="box-body" style="overflow:auto;">
                                    <?php if(!empty($err_msg)){echo $err_msg;} ?>
                                    
                                    <?php
                                        $sch_list = '';
                                        
                                        //get schools
                                        if(!empty($allsch)){
                                            foreach($allsch as $sch){
                                                if(!empty($e_sch_id)){
													if($e_sch_id == $sch->id){
														$dsel = 'selected="selected"';
													} else {$dsel = '';}
												} else {$dsel = '';}
												$sch_list .= '<option value="'.$sch->id.'" '.$dsel.'>'.$sch->name.'</option>';
                                            }
                                        }	
                                    ?>
                                    
                                    <div class="form-group">
                                        <input type="hidden" name="cert_id" value="<?php if(!empty($e_id)){echo $e_id;} ?>" />
                                        <label>School</label>
                                        <select name="sch_id" class="form-control" placeholder="Select School" required>
                                            <option value="">Select School</option>
                                            <?php echo $sch_list; ?>
                                        </select>
                                    </div> 
                                    <div class="form-group">
                                        <label>Student</label>
                                        <input type="text" name="name" class="form-control" placeholder="Student Name" value="<?php if(!empty($e_name)){echo $e_name;} ?>" required="required" />
                                    </div>
                                    <div class="form-group">
                                        <label>Matric</label>
                                        <input type="text" name="matric" class="form-control" placeholder="Student Matric Number" value="<?php if(!empty($e_matric)){echo $e_matric;} ?>" required="required" />
                                    </div>
                                    <div class="form-group">
                                        <label>Department</label>
                                        <input type="text" name="dept" class="form-control" placeholder="Student Department" value="<?php if(!empty($e_dept)){echo $e_dept;} ?>" required="required" />
                                    </div>
                                    <div class="form-group">
                                        <label>Year Admitted</label>
                                        <input type="text" name="admit" class="form-control" placeholder="Year Admitted" value="<?php if(!empty($e_admit)){echo $e_admit;} ?>" required="required" />
                                    </div>
                                    <div class="form-group">
                                        <label>Year Graduated</label>
                                        <input type="text" name="graduate" class="form-control" placeholder="Year Graduated" value="<?php if(!empty($e_graduate)){echo $e_graduate;} ?>" required="required" />
                                    </div>
                                    <div class="form-group">
                                        <label>CGPA</label>
                                        <input type="text" name="gp" class="form-control" placeholder="Student CGPA" value="<?php if(!empty($e_gp)){echo $e_gp;} ?>" required="required" />
                                    </div>
                                </div>
                                <div class="box-footer clearfix">
                                    <button type="submit" name="submit" class="pull-left btn btn-success">Update Record <i class="fa fa-arrow-circle-right"></i></button>
                                </div>
                            </div>
                    <?php echo form_close(); ?>
                </div>
                
                
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-title">
                            <i class="fa fa-book"></i>
                            <h3>Certificate Directory</h3>
                            <div class="pull-right box-toolbar">
                                <a href="#" class="btn btn-link btn-xs remove-box"><i class="fa fa-times"></i></a>
                            </div>          
                        </div>
                        <div class="box-body">
                            <?php
								$ins =& get_instance();
								$ins->load->model('mschool');
								$dir_list = '';
								if(!empty($allup)){
									foreach($allup as $up){
										//get school name
										$sch = $this->mschool->query_school_id($up->sch_id);
										if(!empty($sch)){
											foreach($sch as $sr){
												$sch_name = $sr->name;
											}
										} else {$sch_name = '';}
										
										$dir_list .= '
											<tr>
												<td>'.$up->name.'</td>
												<td>'.$sch_name.'</td>
												<td>'.$up->matric.'</td>
												<td>'.$up->dept.'</td>
												<td>'.$up->admit.'</td>
												<td>'.$up->graduate.'</td>
												<td>'.$up->gp.'</td>
												<td>
													<a href="'.base_url().'cert?edit='.$up->id.'" class="btn btn-primary btn"><i class="fa fa-pencil"></i> Edit</a>
													<a href="'.base_url().'cert?del='.$up->id.'" class="btn btn-danger btn"><i class="fa fa-times"></i> Delete</a>
												</td>
											</tr>
										';	
									}
								}
							?>	
                            
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Student</th>
                                        <th>School</th>
                                        <th>Matric</th>
                                        <th>Dept.</th>
                                        <th>Admitted</th>
                                        <th>Graduated</th>
                                        <th>CGPA</th>
                                        <th>Manage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php echo $dir_list; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Student</th>
                                        <th>School</th>
                                        <th>Matric</th>
                                        <th>Dept.</th>
                                        <th>Admitted</th>
                                        <th>Graduated</th>
                                        <th>CGPA</th>
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