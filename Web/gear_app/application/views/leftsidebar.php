<?php
  $this->load->helper('url');
    
    $baseurl= $this->config->item('base_url');
    ?>
<aside class="main-sidebar">
<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/logo.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>GEAR MERCHANDISE</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
    </div>
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
            </button>
          </span>
        </div>
    </form>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
  
    <ul class="sidebar-menu" data-widget="tree">
        <li class="active treeview menu-open">
          <a href="#">
            <i class="fa fa-files-o"></i><span>GM Admin Panel</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
            <ul class="treeview-menu">
            <li class="active treeview">
			  <a href="<?php echo $baseurl?>/dashboard">
				<i class="fa fa-dashboard"></i> <span>Dashboard</span>
				</a>
			</li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Salesperson Management</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> Assign Dealar</a></li>
                <li><a href="<?php echo $baseurl;?>/salesmanager"><i class="fa fa-circle-o"></i> Assign Sales Manager</a></li>
              </ul>
            </li>
			<li class="treeview">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Master Management</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
            <ul class="treeview-menu">
				<li><a href="#"><i class="fa fa-circle-o"></i> Brand Master</a></li>
				<li><a href="#"><i class="fa fa-circle-o"></i>Location</a></li>
				<li><a href="#"><i class="fa fa-circle-o"></i>Master Customer</a></li>
				<li><a href="#"><i class="fa fa-circle-o"></i>Product Catogory</a></li>
				<li><a href="#"><i class="fa fa-circle-o"></i>Product Sub-Catogory</a></li>
				<li><a href="#"><i class="fa fa-circle-o"></i>Stock Item Master</a></li>
				<li><a href="<?php echo $baseurl;?>/getUserListItems"><i class="fa fa-circle-o"></i>Users</a></li>
				<li><a href="#"><i class="fa fa-circle-o"></i>Voucher Type Mapping</a></li>
				<li class="treeview">
				<a href="#">
				<i class="fa fa-circle-o"></i> 
				<span>Product Management</span>
				<span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
				</a>
				<ul class="treeview-menu">
				<li><a href="<?php echo $baseurl?>/category"><i class="fa fa-circle-o"></i> Category</a></li>
				<li><a href="<?php echo $baseurl?>/subcategory"><i class="fa fa-circle-o"></i> Sub Category</a></li>
				<li><a href="<?php echo $baseurl?>/item"><i class="fa fa-circle-o"></i> Item</a></li>
				</ul>
				</li>
				
             </ul>
            </li>
			<li class=" active treeview">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Transaction Management</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="active"><a href="<?php echo $baseurl;?>/getOrderListItems"><i class="fa fa-circle-o"></i> Order</a></li>
				<li><a href="<?php echo $baseurl;?>/getGrnListItems"><i class="fa fa-circle-o"></i> GRN Viewer</a></li>
        <li><a href="#"><i class="fa fa-circle-o"></i> Collection List</a></li>
				<!-- <li><a href="<?php echo $baseurl;?>/getCollectionItems"><i class="fa fa-circle-o"></i> Collection List</a></li> -->
				<li><a href="<?php echo $baseurl;?>/getVisitListItems"><i class="fa fa-circle-o"></i> Visit Management</a></li>
			  </ul>
            </li>
			<li class="treeview">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>MIS Report</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo $baseurl;?>/getReportOrderAnalysis"><i class="fa fa-circle-o"></i> Order Analysis</a></li>
				<li><a href="#"><i class="fa fa-circle-o"></i> Product Wise Order</a></li>
				<li><a href="#"><i class="fa fa-circle-o"></i> Sales Person Wise Order</a></li>
				<li><a href="#"><i class="fa fa-circle-o"></i> Collection Summary</a></li>
        <li><a href="<?php echo $baseurl;?>/VisitAnalysisReport"><i class="fa fa-circle-o"></i> Visit Analysis</a></li>				
              </ul>
            </li>
            <li>
            <a href="<?php echo $baseurl;?>/ledgerupload">
                <i class="fa fa-upload"></i>
                <span>Upload Excel</span>
                
              </a>
            </li>
			<li>
			  <a href="<?php echo $baseurl;?>/apk/gareapp.apk">
				<i class="fa fa-download"></i> <span>Download Apk</span>
				</a>
        <!-- <a href="#">
        <i class="fa fa-download"></i> <span>Download Apk</span>
        </a> -->
			</li>	
            <li>
			  <a href="<?php echo $baseurl;?>/logout">
				<i class="fa fa-sign-out"></i> <span>Log Out</span>
				</a>
			</li>			
        </li>
    </ul>   
         
    </ul>
</section>
</aside>