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
    	<div class="col-lg-8">
        	<h1>Log Out!</h1>
        	<?php echo $msg; ?>
    	</div>
 	</div>
</div>