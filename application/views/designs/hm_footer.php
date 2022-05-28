	<br /><br />	
    <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
       <!-- <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>-->
        <script src="<?php echo base_url(); ?>js/plugins/jquery/jquery-1.10.2.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>js/plugins/jquery-ui/jquery-ui-1.10.4.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/main.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/masonry.pkgd.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/imagesloaded.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/classie.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/AnimOnScroll.js"></script>

		<!-- Interface -->
        <script src="<?php echo base_url(); ?>js/plugins/pace/pace.min.js" type="text/javascript"></script>
		
		<!-- Forms -->
        <script src="<?php echo base_url(); ?>js/plugins/bootstrapValidator/bootstrapValidator.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
		
		<script type="text/javascript">
			function swap(one, two) {
				document.getElementById(one).style.display = 'block';
				document.getElementById(two).style.display = 'none';
			}
			
			new AnimOnScroll( document.getElementById( 'grid' ), {
                minDuration : 0.4,
                maxDuration : 0.7,
                viewportFactor : 0.2
            } );
			
			new AnimOnScroll( document.getElementById( 'grid2' ), {
                minDuration : 0.4,
                maxDuration : 0.7,
                viewportFactor : 0.2
            } );
			
			//iCheck
			$("input[type='checkbox'], input[type='radio']").iCheck({
				checkboxClass: 'icheckbox_minimal',
				radioClass: 'iradio_minimal'
			});
			
			$(document).ready(function() {
				$('#loginform').bootstrapValidator({
					message: 'This value is not valid',
					fields: {
						username: {
							message: 'The username is not valid',
							validators: {
								notEmpty: {
									message: 'The username is required and can\'t be empty'
								}
							}
						},
						password: {
							validators: {
								notEmpty: {
									message: 'The password is required and can\'t be empty'
								}
							}
						}
					}
				});
				
				$('#regform').bootstrapValidator({
					message: 'This value is not valid',
					fields: {
						username: {
							message: 'The username is not valid',
							validators: {
								notEmpty: {
									message: 'The username is required and can\'t be empty'
								}
							}
						},
						password: {
							validators: {
								notEmpty: {
									message: 'The password is required and can\'t be empty'
								}
							}
						}
					}
				});
			});
		</script>
    </body>
</html>