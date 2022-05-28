    <div class="rightside">
        <div class="page-head">
            <h1>Manage Blog Categories  <small>manage blog categories here</small></h1>
            <ol class="breadcrumb">
                <li>You are here:</li>
                <li><a href="<?php echo base_url(); ?>">Home</a></li>
                <li><a href="<?php echo base_url('blog/add'); ?>">Blog</a></li>
                <li class="active">Categories</li>
            </ol>
        </div>

        <div class="content">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <?php echo form_open_multipart('blog/category'); ?>
                        <div class="box">
                            <div class="box-title">
                                <i class="fa fa-book"></i>
                                <h3>New Category</h3>
                                <div class="pull-right box-toolbar">
                                    <a href="#" class="btn btn-link btn-xs remove-box"><i class="fa fa-times"></i></a>
                                </div>          
                            </div>
                            <div class="box-body">
                                <?php echo $err_msg; ?>
                                <div class="form-group">
                                    <input type="hidden" name="cat_id" value="<?php if(!empty($e_id)){echo $e_id;} ?>" />
                                    <label>Design Category</label>
                                    <input type="text" name="cat" class="form-control" value="<?php if(!empty($e_cat)){echo $e_cat;} ?>" />
                                </div>
                            </div>
                            <div class="box-footer clearfix">
                                <button type="submit" name="submit" class="pull-left btn btn-success">Update Record <i class="fa fa-arrow-circle-right"></i></button>
                            </div>
                        </div>
                    <?php echo form_close(); ?>
                </div>
                
                
                <div class="col-lg-8 col-md-6 col-sm-6 col-xs-12">
                    <div class="box">
                        <div class="box-title">
                            <i class="fa fa-book"></i>
                            <h3>Categories</h3>
                            <div class="pull-right box-toolbar">
                                <a href="#" class="btn btn-link btn-xs remove-box"><i class="fa fa-times"></i></a>
                            </div>          
                        </div>
                        <div class="box-body">
                            <?php
								$dir_list = '';
								if(!empty($allcat)){
									foreach($allcat as $cat){
										$dir_list .= '
											<tr>
												<td>'.$cat->cat.'</td>
												<td>'.$cat->slug.'</td>
												<td>
													<a href="'.base_url().'blog/category?edit='.$cat->id.'" class="btn btn-primary btn"><i class="fa fa-pencil"></i> Edit</a>
													<a href="'.base_url().'blog/category?del='.$cat->id.'" class="btn btn-danger btn"><i class="fa fa-times"></i> Delete</a>
												</td>
											</tr>
										';	
									}
								}
							?>	
                            
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Category</th>
                                        <th>Slug</th>
                                        <th>Manage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php echo $dir_list; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Category</th>
                                        <th>Slug</th>
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