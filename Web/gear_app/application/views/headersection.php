<?php
  $this->load->helper('url');
    
    $baseurl= $this->config->item('base_url');
    ?>
<header class="main-header">
    <!-- Logo -->
   <!-- <a href="<?php //echo $baseurl?>/dashboard" class="logo" style="background-color:#222d32">
      <span class="logo-mini"><b>GM</b></span>
	  <div class="pull-left">
         <img class="jalan" src="dist/img/logo.png" alt="Logo" width="100%"> 
      </div>
    </a>-->
    <!-- Header Navbar -->
	<nav class="navbar navbar-static-top">
		  <!-- Sidebar toggle button-->
		  <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
			<span class="sr-only">Toggle navigation</span>
		  </a>
		<div class="navbar-custom-menu">
		 <ul class="nav navbar-nav">
		   <!-- User Account: style can be found in dropdown.less -->
			<li class="dropdown user user-menu">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
				  <img src="dist/img/logo.png" class="user-image" alt="User Image">
				  <span class="hidden-xs"><?php echo $this->session->userdata('username');?></span>
				</a>
				<ul class="dropdown-menu">
				  <!-- User image -->
				  <li class="user-header">
					<img src="dist/img/logo.png" class="img-circle" alt="User Image">
					<p>
					  <?php echo $this->session->userdata('username');?>
					  <small></small>
					</p>
				  </li>
				  <li class="user-footer">
					
					<div class="pull-right">
					  <a href="<?php echo $baseurl;?>/logout" class="btn btn-default btn-flat">Sign out</a>
					</div>
				  </li>
                </ul>
            </li>
          <!-- Control Sidebar Toggle Button -->
			<!--<li>
			  <a href="#" onclick="toggleRightSidebarSlide();" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
			</li>-->
         </ul>
        </div>
    </nav>
	<!-- Header Nav End -->
 </header>