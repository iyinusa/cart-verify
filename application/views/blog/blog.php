<div id="portwrap">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <h2>Our Latest Thoughts<br /><?php if(!empty($blog_title)){echo $blog_title;} else {echo 'Blogs';} ?></h2>
            </div>
        </div><!-- row -->
    </div><!-- /container -->
</div><!-- /portrwrap -->

<?php if($view == 1){ ?>
	<div class="container">
		<div class="row mt">
			<div class="col-lg-8">
            	<p class="small">
                	<i class="fa fa-calendar"></i> <?php echo $post_date; ?> | 
                    <i class="fa fa-book"></i> <?php echo $scat; ?> Category |  
                    <i class="fa fa-eye"></i> <?php echo $views; ?> Views
              	</p>
                
                <img alt="" src="<?php echo base_url($pics); ?>" width="100%" /><br /><br />
                
                <?php echo $details; ?>
                
                <br />
                
                <div class="fb-comments" data-href="http://developers.facebook.com/docs/plugins/comments/" data-width="100%" data-numposts="10" data-colorscheme="light"></div>
            </div>
            
            <div class="col-lg-8">
            
            </div>
		</div>
	</div>
<?php } else {//list all posts here ?>
	<?php
		$ins_obj =& get_instance();
		$ins_obj->load->model('blogs');
		$list = '';
		$category = '';
		if(!empty($allblog)){
			foreach($allblog as $blog){
				$cat_id = $blog->cat_id;
									
				$gc = $this->blogs->query_blog_cat_id($cat_id);
				if(!empty($gc)){
					foreach($gc as $citem){
						$category = $citem->cat;	
					}
				}
				
				$list .= '
					<div class="col-lg-4">
						<img class="img-responsive" src="'.base_url($blog->pics_small).'" alt="">
						<h3><a href="'.base_url('blog?v='.$blog->slug).'">'.character_limiter($blog->title,45).'</a></h3>
						<p class="small"><i class="fa fa-calendar"></i> '.$blog->post_date.' | <i class="fa fa-book"></i> '.$category.' | <i class="fa fa-eye"></i> '.$blog->views.' Views</p>
						<p><a href="'.base_url('blog?v='.$blog->slug).'" target="_blank"><i class="fa fa-link"></i> Read More</a></p>
					</div>
				';
			}
		}
	?>
	<div class="container">
		<div class="row mt">
			<?php echo $list; ?>
		</div>
	</div>
<?php } ?>