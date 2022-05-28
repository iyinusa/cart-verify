    <div class="rightside">
        <div class="page-head">
            <h1>Profile  <small>add to design directory</small></h1>
            <ol class="breadcrumb">
                <li>You are here:</li>
                <li><a href="<?php echo base_url(); ?>">Home</a></li>
                <li><a href="<?php echo base_url('dashboard'); ?>">Dashboard</a></li>
                <li class="active">Profile</li>
            </ol>
        </div>

        <div class="content">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 text-center">
                    <img alt="" src="<?php echo base_url('assets/img/logo.png'); ?>" />
                </div>
                
                
                <div class="col-lg-8 col-md-6 col-sm-6 col-xs-12">
                     <?php echo form_open_multipart('profile'); ?>
                        <div class="box">
                            <div class="box-title">
                                <i class="fa fa-key"></i>
                                <h3>Change Password</h3>
                                <div class="pull-right box-toolbar">
                                    <a href="#" class="btn btn-link btn-xs remove-box"><i class="fa fa-times"></i></a>
                                </div>          
                            </div>
                            <div class="box-body">
                                <?php echo $err_msg; ?>
                                <div class="form-group">
                                    <?php echo form_error('old'); ?>
                                    <input type="password" name="old" class="form-control" placeholder="Old Password" />
                                    <?php echo form_error('new'); ?>
                                    <input type="password" name="new" class="form-control" placeholder="New Password" />
                                    <?php echo form_error('confirm'); ?>
                                    <input type="password" name="confirm" class="form-control" placeholder="Confirm New Password" />
                                </div>
                            </div>
                            <div class="box-footer clearfix">
                                <button type="submit" name="submit" class="pull-left btn btn-success">Change Password <i class="fa fa-arrow-circle-right"></i></button>
                            </div>
                        </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>