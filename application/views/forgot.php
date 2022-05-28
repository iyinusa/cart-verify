<section id="content">
  <div class="main padder">
    <div class="row">
      <div class="col-lg-4 col-lg-offset-4 m-t-large">
        <section class="panel">
          <header class="panel-heading text-center">Reset Password</header>
          
          <?php echo $err_msg; ?>
          
          <?php if(isset($_GET['stamp']) && isset($_GET['email'])){ ?>
			  <?php $post_page = 'forgot?stamp='.$_GET['stamp'].'&email='.$_GET['email']; ?>
			  <?php echo form_open($post_page, array('class'=>'panel-body')) ?>
                <div class="block">
                  <?php echo form_error('new'); ?>
                  <label class="control-label">New password</label>
                  <input name="new" type="password" placeholder="Choose new password" class="form-control">
                </div>
                <div class="block">
                  <?php echo form_error('confirm'); ?>
                  <label class="control-label">Confirm new password</label>
                  <input name="confirm" type="password" placeholder="Confirm new password" class="form-control">
                  <div class="line line-dashed"></div> 
                </div>
                <button name="change" type="submit" class="btn btn-info">Reset Password</button>
              <?php echo form_close() ?>
          <?php } else { ?>
			  <?php echo form_open('forgot', array('class'=>'panel-body')) ?>
                <div class="block">
                  <?php echo form_error('email'); ?>
                  <label class="control-label">Email address</label>
                  <input name="email" type="email" placeholder="test@example.com" class="form-control">
                  <div class="line line-dashed"></div> 
                </div>
                <button name="send" type="submit" class="btn btn-info">Reset Password</button>
              <?php echo form_close() ?>
          	<?php }; ?>
        </section>
      </div>
    </div>
  </div>
</section>