<!DOCTYPE html>
<html>
	
<head>
        <meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/favicon.ico">
		
        <title><?php echo $title; ?></title>
		
		<!-- Maniac stylesheets -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.min.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/font-awesome.min.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/gritter/jquery.gritter.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css"  />
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap-tagsinput/bootstrap-tagsinput.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-jvectormap/jquery-jvectormap-1.2.2.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/animate/animate.min.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/iCheck/all.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/datatables/dataTables.bootstrap.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css" />
		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
	</head>
	<body class="fixed">
        <!-- Header -->
        <header>
			<a href="<?php echo base_url(); ?>" class="logo">
            	<img alt="" src="<?php echo base_url(); ?>assets/img/logo_small.png" style="max-height:100%;" />
            </a>
            <nav class="navbar navbar-static-top">
                <a href="#" class="navbar-btn sidebar-toggle">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <li class="dropdown widget-user">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<img src="<?php echo base_url(); ?>assets/img/logo_small.png" class="pull-left" alt="image" />
                                <span><?php if(!empty($log_username)){echo $log_username;} ?> <i class="fa fa-caret-down"></i></span>
                            </a>
                            <ul class="dropdown-menu">
								<li>
									<a href="<?php echo base_url(); ?>profile"><i class="fa fa-user"></i>Profile</a>
								</li>
								<li class="footer">
									<a href="<?php echo base_url(); ?>logout"><i class="fa fa-power-off"></i>Logout</a>
								</li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
		<!-- /.header -->
		