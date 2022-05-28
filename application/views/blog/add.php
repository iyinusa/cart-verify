    <div class="rightside">
        <div class="page-head">
            <h1>Manage Blogs  <small>manage blog posts here</small></h1>
            <ol class="breadcrumb">
                <li>You are here:</li>
                <li><a href="<?php echo base_url(); ?>">Home</a></li>
                <li class="active">Blogs</li>
            </ol>
        </div>

        <div class="content">
            <div class="row">
                <div class="col-lg-12">
                    <?php echo form_open_multipart('blog/add'); ?>
                        <div class="box">
                            <div class="box-title">
                                <i class="fa fa-bullhorn"></i>
                                <h3>New Upload</h3>
                                <div class="pull-right box-toolbar">
                                    <a href="#" class="btn btn-link btn-xs remove-box"><i class="fa fa-times"></i></a>
                                </div>          
                            </div>
                            <div class="box-body">
                                <?php echo $err_msg; ?>
                                <div class="form-group">
                                    <input type="hidden" name="blog_id" value="<?php if(!empty($e_id)){echo $e_id;} ?>" />
                                    <input type="hidden" name="pics" value="<?php if(!empty($e_pics)){echo $e_pics;} ?>" />
                                    <input type="hidden" name="pics_small" value="<?php if(!empty($e_pics_small)){echo $e_pics_small;} ?>" />
                                    <input type="hidden" name="pics_square" value="<?php if(!empty($e_pics_square)){echo $e_pics_square;} ?>" />
                                    
                                    <?php
										$cat_list = '';
										if(!empty($allcat)){
											foreach($allcat as $cat){
												if(!empty($e_cat_id)){
													if($e_cat_id == $cat->id){
														$cat_sel = 'selected="selected"';
													} else {$cat_sel = '';}
												} else {$cat_sel = '';}
												
												$cat_list .= '<option value="'.$cat->id.'" '.$cat_sel.'>'.$cat->cat.'</option>';
											}
										} else {$cat_list = 'Goto Blog Category and add';}
									?>	
                                    <label>Category</label>
                                    <select name="cat" class="form-control" placeholder="Blog Category" required>
                                        <option value="">Select Blog Category</option>
                                        <?php echo $cat_list; ?>
                                    </select>
                                </div> 
                                
                                <div class="form-group">
                                    <label>Blog Title</label>
                                    <input type="text" name="title" class="form-control" placeholder="Blog Title" required="required" value="<?php if(!empty($e_title)){echo $e_title;} ?>">
                              	</div>
                                
                                <div class="form-group">
                                    <label>Blog Details</label>
                                    <textarea name="details" class="bs-texteditor form-control" rows="8" required="required"><?php if(!empty($e_details)){echo $e_details;} ?></textarea>
                              	</div>					
                                
                                <div class="form-group">
                                    <label>Select Image</label>
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
                
                
                <div class="col-lg-12">
                    <div class="box">
                        <div class="box-title">
                            <i class="fa fa-bullhorn"></i>
                            <h3>Blogs</h3>
                            <div class="pull-right box-toolbar">
                                <a href="#" class="btn btn-link btn-xs remove-box"><i class="fa fa-times"></i></a>
                            </div>          
                        </div>
                        <div class="box-body">
                            <?php
								$ins_obj =& get_instance();
								$ins_obj->load->model('blogs');
								$dir_list = '';
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
										
										$dir_list .= '
											<tr>
												<td>'.$blog->post_date.'</td>
												<td>'.$category.'</td>
												<td>'.$blog->title.'</td>
												<td><img alt="" src="'.base_url().$blog->pics_square.'" width="40" /></td>
												<td>'.$blog->views.'</td>
												<td>
													<a href="'.base_url().'blog/add?edit='.$blog->id.'" class="btn btn-primary btn"><i class="fa fa-pencil"></i> Edit</a>
													<a href="'.base_url().'blog/add?del='.$blog->id.'" class="btn btn-danger btn"><i class="fa fa-times"></i> Delete</a>
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
                                        <th>Title</th>
                                        <th>Image</th>
                                        <th>Views</th>
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
                                        <th>Title</th>
                                        <th>Image</th>
                                        <th>Views</th>
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