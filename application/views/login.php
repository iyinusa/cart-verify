<div class="container">
	<div class="row mt">
    	<div class="col-lg-6">
        	<h1>Certificate Verification</h1>
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
        	<?php if($this->session->userdata('logged_in') == TRUE){ ?>
            <h2 class="text-muted">Welcome!</h2>
            You are now logged in into the system<br /><br />
            You can <a href="<?php echo base_url('logout'); ?>">Log Out</a> here
            <?php } else { ?>
            <h2 class="text-muted"><i class="fa fa-key"></i> Log In!</h2>
        	<?php echo form_open('login', array('id'=>'regform')); ?>
                <?php echo $err_msg; ?>
                <div class="box-body padding-md">
                    <div class="form-group">
                        <?php echo form_error('username'); ?>
                        <input type="text" name="username" class="form-control" placeholder="Username"/>
                    </div>
                    <div class="form-group">
                        <?php echo form_error('password'); ?>
                        <input type="password" name="password" class="form-control" placeholder="Password"/>
                    </div>          
                    <div class="form-group">
                        <input type="checkbox" /> <small>Remember me</small>
                    </div>  
                    <div class="box-footer">                                                               
                        <button type="submit" class="btn btn-success btn-block"><h4 style="color:#fff;">Log In <i class="fa fa-arrow-circle-right"></i></h4></button>  
                    </div>
                </div>
            <?php echo form_close(); ?>
            <?php } ?>
            <br /><br />
            <div class="text-muted small">Project by: Adaranijo Idris Olakunle (NOU110151490)<br />BSc. - Computer Science, National Open University.</div>
    	</div>
 	</div>
</div>