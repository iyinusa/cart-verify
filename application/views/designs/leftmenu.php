<?php
	if($page_act == 'dashboard'){$dashboard_active = 'active';}else{$dashboard_active = '';}
	if($page_act == 'schedule'){$sch_active = 'active';}else{$sch_active = '';}
?>

<!-- wrapper -->
<div class="wrapper">
    <div class="leftside">
        <div class="sidebar">
            <ul class="sidebar-menu">
                <li class="title">Navigation</li>
                <li class="<?php echo $dashboard_active; ?>">
                    <a href="<?php echo base_url(); ?>dashboard">
                        <i class="fa fa-home"></i> <span>Manage School</span>
                    </a>
                </li>
                <li class="<?php echo $sch_active; ?>">
                    <a href="<?php echo base_url(); ?>cert">
                        <i class="fa fa-book"></i> <span>Manage Certificate</span>
                    </a>
                </li>
            </ul>
         </div>
    </div>