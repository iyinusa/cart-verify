<div class="container">
	<div class="row mt">
    	<div class="col-lg-6">
        	<h1>Result Verification</h1>
        </div>
        <div class="col-lg-6 text-right">
        	<h1>
            	<?php if($this->session->userdata('logged_in') == TRUE){ ?>
            	<a href="<?php echo base_url('dashboard'); ?>" class="btn btn-primary"><i class="fa fa-home"></i> Dashboard</a>
                <?php } else { ?>
                <a href="<?php echo base_url(); ?>" class="btn btn-info"><i class="fa fa-key"></i> Log In</a>
                <?php } ?>
                <a href="<?php echo base_url('check'); ?>" class="btn btn-success"><i class="fa fa-check"></i> Verify Certificate</a>
           	</h1>
        </div>
   	</div>
</div>

<hr />

<!-- WELCOME SECTION -->
<div class="container">
	<div class="row mt">
    	<div class="col-lg-6">
        	<h2 class="text-muted"><i class="fa fa-check"></i> Check Certificate/Result!</h2>
        	<?php echo form_open('check', array('id'=>'regform')); ?>
                <div class="box-body padding-md">
                    <div class="form-group">
                       <?php
						  $sch_list = '';
						  
						  //get schools
						  if(!empty($allsch)){
							  foreach($allsch as $sch){
								 $sch_list .= '<option value="'.$sch->id.'">'.$sch->name.'</option>';
							  }
						  }	
					  ?>
                       <select name="sch" class="form-control" placeholder="Select School" required>
                          <option value="">Select School</option>
                          <?php echo $sch_list; ?>
                      </select><br />
                       <input type="text" name="name" class="form-control" placeholder="Student Name/Matric Number" required="required"/>
                    </div> 
                    <div class="box-footer">                                                               
                        <button type="submit" class="btn btn-success btn-block"><h4 style="color:#fff;">Check Now! <i class="fa fa-check"></i></h4></button>  
                    </div>
                </div>
                <?php if(!empty($err_msg)){echo $err_msg;} ?>
            <?php echo form_close(); ?>
    	</div>
 	</div>
</div>