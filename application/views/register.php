<div class="box">
    <div class="header clearfix">
        <div class="pull-left"><i class="fa fa-sign-in"></i> Create Account</div>
        <div class="pull-right"><a href="#"><i class="fa fa-times"></i></a></div>
    </div>
    <?php echo form_open('register', array('id'=>'regform')); ?>
    <!--<form id="regform" method="post" action="<?php echo base_url(); ?>register/">-->
        <!--<div class="alert alert-warning no-radius no-margin padding-sm"><i class="fa fa-info-circle"></i> Create account for BaseRANT</div>-->
        <?php echo $err_msg; ?>
        <div class="box-body padding-md">
            <div class="form-group">
                <?php echo form_error('username'); ?>
                <input type="text" name="username" class="form-control" placeholder="Username"/>
            </div>
            <div class="form-group">
                <?php echo form_error('email'); ?>
                <input type="email" name="email" class="form-control" placeholder="Email"/>
            </div>
            <div class="form-group">
                <?php echo form_error('password'); ?>
                <input type="password" name="password" class="form-control" placeholder="Password"/>
            </div>          
            <div class="form-group">
                <?php echo form_error('confirm'); ?>
                <input type="password" name="confirm" class="form-control" placeholder="Repeat Password"/>
            </div>          
            <div class="box-footer">                                                               
                <button type="submit" class="btn btn-success btn-block">Register</button>  
            </div>
        </div>
    <?php echo form_close(); ?>
</div>
<div class="box-extra clearfix">
    <a href="<?php echo base_url(); ?>login" class="pull-left btn btn-xs">Are you member?</a>
</div>