<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>GM Project</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- Select2 -->
  <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
 <!-- <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">-->
 <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="plugins/iCheck/all.css">
    <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <!-- DataTables -->
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  
  <style>
      .select2-container--default .select2-selection--single {
          border-radius: 0;
      }

      .select2-container .select2-selection--single .select2-selection__rendered {
          padding-left: 0;
      }

      .select2-container--default .select2-results__option--highlighted[aria-selected] {
          background-color: #3c8dbc;
          color: white;
      }

      .select2-container--default .select2-selection--multiple {
          border-radius: 0;
      }

      .select2-container .select2-selection--single {
          height: 33px;
      }

      .form-group {
          margin-bottom: 5px;
      }
	  
	  .skin-yellow .sidebar-menu .treeview-menu > li > a{ color:#da8c10}
	  .skin-red .sidebar-menu .treeview-menu > li > a { color: #dd4b39;}
	  .skin-green .sidebar-menu .treeview-menu > li > a { color: #00a65a;}
	  .skin-blue .sidebar-menu .treeview-menu > li > a { color: #ccc;}
	  
	 
  </style>
</head>
<body class="hold-transition skin-blue sidebar-mini control-sidebar-open"><!--skin-black-light-->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo" style="background-color:#222d32">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>GM</b></span>
      <!-- logo for regular state and mobile devices -->
	  <div class="pull-left">
         <img class="jalan" src="dist/img/logo.png" alt="Logo"> 
       </div>
      <!-- <span class="logo-lg"><b>Admin</b>LTE</span> -->
    </a>
    <!-- Header Navbar: style can be found in header.less -->
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
              <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs">JALAN BROTHERS</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  JALAN BROTHERS
                  <small>Healthcare Hospitals|Technology|Skills</small>
                </p>
              </li>
              <!-- Menu Body -->
              <!-- <li class="user-body"> -->
                <!-- <div class="row"> -->
                  <!-- <div class="col-xs-4 text-center"> -->
                    <!-- <a href="#">Followers</a> -->
                  <!-- </div> -->
                  <!-- <div class="col-xs-4 text-center"> -->
                    <!-- <a href="#">Sales</a> -->
                  <!-- </div> -->
                  <!-- <div class="col-xs-4 text-center"> -->
                    <!-- <a href="#">Friends</a> -->
                  <!-- </div> -->
                <!-- </div> -->
                <!-- <!-- /.row -->
              <!-- </li> -->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="#" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" onclick="toggleRightSidebarSlide();" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>JALAN BROTHERS</p>
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
	  
        <!--<li class="header">Cms Admin</li>-->
        <li class="active treeview menu-open">
          <a href="#">
            <i class="fa fa-files-o"></i><span>GM Admin Panel</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active treeview">
			  <a href="CRMIndex.html">
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
                <li><a href="DBSetup.html"><i class="fa fa-circle-o"></i> Assign Dealar</a></li>
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
                <li><a href="#"><i class="fa fa-circle-o"></i> Dealer Information</a></li>
				<li><a href="BrandMaster.html"><i class="fa fa-circle-o"></i> Brand Master</a></li>
				<li><a href="Location.html"><i class="fa fa-circle-o"></i>Location</a></li>
				<li><a href="MasterCustomer.html"><i class="fa fa-circle-o"></i>Master Customer</a></li>
				<li><a href="ProductCatogory.html"><i class="fa fa-circle-o"></i>Product Catogory</a></li>
				<li><a href="ProductSubCatogory.html"><i class="fa fa-circle-o"></i>Product Sub-Catogory</a></li>
				<li><a href="StockItem.html"><i class="fa fa-circle-o"></i>Stock Item Master</a></li>
				<li><a href="Users.html"><i class="fa fa-circle-o"></i>Users</a></li>
				<li><a href="VoucherType.html"><i class="fa fa-circle-o"></i>Voucher Type Mapping</a></li>
				<li class="treeview">
				<a href="#">
				<i class="fa fa-circle-o"></i> 
				<span>Product Management</span>
				<span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
				</a>
				<ul class="treeview-menu">
				<li><a href="#"><i class="fa fa-circle-o"></i> Category</a></li>
				<li><a href="#"><i class="fa fa-circle-o"></i> Sub Category</a></li>
				<li><a href="#"><i class="fa fa-circle-o"></i> Item</a></li>
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
                <li><a href="Order Management.html"><i class="fa fa-circle-o"></i> Order</a></li>
				<li><a href="GRN Viewer.html"><i class="fa fa-circle-o"></i> GRN Viewer</a></li>
				<li><a href="DealerCollection.html"><i class="fa fa-circle-o"></i> Collection Status</a></li>
				<li><a href="#"><i class="fa fa-circle-o"></i> Visit Tracking</a></li>
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
                <li><a href="Order Analysis.html"><i class="fa fa-circle-o"></i> Order Analysis</a></li>
				<li><a href="ProductOrder.html"><i class="fa fa-circle-o"></i> Product Wise Order</a></li>
				<li><a href="SalesPerson.html"><i class="fa fa-circle-o"></i> Sales Person Wise Order</a></li>
				<li><a href="Collection.html"><i class="fa fa-circle-o"></i> Collection Summary</a></li>
              </ul>
            </li>
           
          </ul>
        </li>
        
         
      </ul>
	</section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header" style="padding-top:15px;">
      <h1>
        Location
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb" style="padding-top:18px;">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Location</li>
      </ol>
    </section>

    <!-- Main content -->
    
    <section class="content" style="overflow-x:auto; max-height:750px;">
    
    <div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Location</a></li>
			  <li id="listTimeline" class="disabled"><a href="#timeline" id="timelinetab">Entry Page</a></li>
            </ul>
			<div class="button-section" id="buttonsection">
			<button class="btn btn-success btn-sm"></i>New</button>
			<button class="btn btn-twitter btn-sm" data-toggle="collapse" data-target="#smallform"><i class="fa fa-filter" style="padding:3px;"></i>Filter</button>
			
			</div>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                <div class="row">
        <div class="col-xs-12">
          <div class="box box-info">
            <div class="box-header" style="background-color: #337ab7; color: #fff">
              <h3 class="box-title">Location</h3>
			  <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" style="color:#fff"><i class="fa fa-minus"></i></button>
              </div>
            </div>
			<div class="box-body collapse"style="background-color: #D1D3D4;"id="smallform">
          <div class="row form-horizontal">
             <div class="row">
			 <div class="col-md-12">
			  <div class="col-md-4">
				  <div class="form-group">
						<label for="" class="col-sm-3 control-label">Location ID:</label>
						<div class="col-sm-9">
						   <input type="text" class="form-control">
						</div>
				 </div>
              <!-- /.form-group -->
			  </div>
			  <div class="col-md-4">
			  <div class="form-group">
						<label for="" class="col-sm-3 control-label">Location Name:</label>
						<div class="col-sm-9">
						    <input type="text" class="form-control">
						</div>
				 </div>
              <!-- /.form-group -->
            </div>
			<div class="col-md-4">
			  <div class="form-group">
						<label for="" class="col-sm-3 control-label">Sort Name:</label>
						<div class="col-sm-9">
						    <input type="text" class="form-control">
						</div>
				 </div>
              <!-- /.form-group -->
            </div>
			</div>
			</div>
			<div class="row">
			<div class="col-md-12">
			<div class="col-md-4">
			  <div class="form-group">
						<label for="" class="col-sm-3 control-label">Location Type:</label>
						<div class="col-sm-9">
						    <select class="form-control">
							  <option selected="selected">Select</option>
							  <option>Branch Office</option>
							  <option>Head Office</option>
							</select>
						</div>
				 </div>
              <!-- /.form-group -->
            </div>
			<div class="col-md-4">
			  <div class="form-group">
						<label for="" class="col-sm-3 control-label">Status:</label>
						<div class="col-sm-9">
						    <select class="form-control">
							  <option selected="selected">Select</option>
							  <option>Active</option>
							  <option>Inactive</option>
							</select>
						</div>
				 </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
			
            </div>
			</div>
			<!-- <div class="col-md-6">
			<div class="form-group">
						<div class="col-sm-10" style="margin-left: 116px;">
						    <button type="button" class="btn btn-facebook btn-inner">6 Months<i class="fa fa-calendar"style="margin-left: 4px;"></i></button>
							<button type="button"class="btn  btn-linkedin btn-inner">YTD<i class="fa fa-calendar"style="margin-left: 4px;"></i></button>
							<button type="button"class="btn btn-twitter btn-inner">From Start</button>
						</div>
				 </div>
			</div> -->
			<div class="col-md-12">
			<div class="form-group">
						<div class="col-sm-10 filter">
						    <!-- <button type="button" class="btn btn-google btn-inner"><i class="fa fa-close"style="margin-right: 4px;"></i>Close</button>
							<button type="button"class="btn btn-warning btn-inner">Reset<i class="fa fa-edit"style="margin-left: 4px;"></i></button> -->
							<button type="button"class="btn btn-success btn-inner">Search</button>
						</div>
				 </div>
			</div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
            <!-- /.box-header -->
            <div class="box-body">
             <div class="table-responsive">
             
             <table id="example1" class="table table-bordered table-hover table-striped">
               <thead>
                <tr>
                  <th style="text-align:center;width:105px;">Location Id</th>
                  <th style="text-align:center;width:145px">Location Name</th>
				  <th style="text-align:center;width:105px;">Sort Name</th>
				  <th style="text-align:center;width:61.3px;">Loacation Type</th>
				  <th style="text-align:center;width:61.3px;">Status</th>
                </tr>
                </thead>
                <tbody style="text-align:center;">
                <tr>
                  <td style="text-align:center;">25639888</td>
                  <td>ABCDE</td>
				  <td>fgfvnbvmnb</td>
				  <td>Type</td>
                  <td>Status</td>
                </tr>
				
                <tr>
                  <td style="text-align:center;">25639888</td>
                  <td>ABCDE</td>
				  <td>fgfvnbvmnb</td>
				  <td>Type</td>
                  <td>Status</td>
                </tr>
				<tr>
                  <td style="text-align:center;">25639888</td>
                  <td>ABCDE</td>
				  <td>fgfvnbvmnb</td>
				  <td>Type</td>
                  <td>Status</td>
                </tr>
                  <tr>
                  <td style="text-align:center;">25639888</td>
                  <td>ABCDE</td>
				  <td>fgfvnbvmnb</td>
				  <td>Type</td>
                  <td>Status</td>
                </tr>
				<tr>
                  <td style="text-align:center;">25639888</td>
                  <td>ABCDE</td>
				  <td>fgfvnbvmnb</td>
				  <td>Type</td>
                  <td>Status</td>
                </tr>
				
                </tbody>
				<!-- <col>
  <col>
  <colgroup span="6"></colgroup>
  <thead>
    <tr>
      <th scope="col">Server name</th>
	  <th scope="col">Last Access</th>
	  <th scope="col">Status</th>
      <th scope="col">Campin</th>
      <th colspan="1" scope="colgroup">Total Records</th>
	  <th scope="col">Run</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th rowspan="3" scope="rowgroup">ABCDE</th>
	  <td>02-3-2018</td>
	  <td class="text-success">Success</td>
      <th scope="row">OPD</th>
      <td>100</td>
	  <td><a href=#><i class="fa fa-check" style="font-size:23px;padding-right:10px"></i></a></td>
    </tr>
    <tr>
	  <td>02-3-2018</td>
	  <td class="text-success">Success</td>
      <th scope="row">IPD</th>
      <td>200</td>
	  <td></td>
    </tr>
    <tr>
	<td>02-3-2018</td>
	  <td class="text-success">Success</td>
      <th scope="row">G1 DD</th>
      <td>100</td>
	  <td></td>
    </tr>
  </tbody>
  <tbody>
    <tr>
      <th rowspan="3" scope="rowgroup">MNOP</th>
	  <td>15-2-2018</td>
	  <td class="text-danger">Fail</td>
      <th scope="row">OPD</th>
      <td>100</td>
	  <td><a href=#><i class="fa fa-check" style="font-size:23px;padding-right:10px"></i></a></td>
    </tr>
    <tr>
	  <td>15-2-2018</td>
	  <td class="text-danger">Fail</td>
      <th scope="row">IPD</th>
      <td>360</td>
	  <td></td>
    </tr>
    <tr>
	<td>15-2-2018</td>
	  <td class="text-danger">Fail</td>
      <th scope="row">G1 DD</th>
      <td>200</td>
	  <td></td>
    </tr>
  </tbody>
  <tbody>
    <tr>
      <th rowspan="3" scope="rowgroup">PQRST</th>
	  <td>01-2-2018</td>
	  <td class="text-success">Success</td>
      <th scope="row">OPD</th>
      <td>100</td>
	  <td><a href=#><i class="fa fa-check" style="font-size:23px;padding-right:10px"></i></a></td>
    </tr>
    <tr>
	  <td>01-2-2018</td>
	  <td class="text-success">Success</td>
      <th scope="row">IPD</th>
      <td>200</td>
	  <td></td>
    </tr>
    <tr>
	<td>01-2-2018</td>
	  <td class="text-success">Success</td>
      <th scope="row">G1 DD</th>
      <td>100</td>
	  <td></td>
    </tr>
  </tbody>
  <tbody> -->
                <!-- <tfoot style="text-align:center;">
                <tr>
                  <th align="center">Server Name</th>
                  <th align="center">Last Access</th>
                  <th align="center">Number of Records</th>
                </tr>
                </tfoot> -->
              </table>
			  
             
             </div>
              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
              </div>
         

            </div>
            <!-- /.tab-content -->
          </div>
          
          
     </section>     
          
	</div>
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2017-2018 <a href="https://mgts.co.in/">MG Tathya Solution Pvt. Ltd</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside id="abcd" class="control-sidebar control-sidebar-dark  control-sidebar-open">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <!-- <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li> -->
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane active" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Orders</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-shopping-basket bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Order:10</h4>

                <p>On Today</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Product Wise Order:11</h4>

                <p>On Today</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Sales Person Order:12</h4>

                <p>On Today</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Collection Status:13</h4>

                <p>On Today</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Total Order</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Order:10
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Product Wise Order:11
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Sales Person Wise Order:12
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Collection Status:13
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
<div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="plugins/input-mask/jquery.inputmask.js"></script>
<script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- daterangepicker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap color picker -->
<script src="bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- iCheck 1.0.1 -->
<script src="plugins/iCheck/icheck.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- CK Editor -->
<script src="bower_components/ckeditor/ckeditor.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<script>
    function toggleRightSidebarSlide() {
        $('#chkrightsidebarslide').prop('checked', false);
    }
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
        //Datemask2 mm/dd/yyyy
        $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
        //Money Euro
        $('[data-mask]').inputmask()

        //Date range picker
        $('#reservation').daterangepicker()
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
        //Date range as a button
        $('#daterange-btn').daterangepicker(
          {
              ranges: {
                  'Today': [moment(), moment()],
                  'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                  'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                  'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                  'This Month': [moment().startOf('month'), moment().endOf('month')],
                  'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
              },
              startDate: moment().subtract(29, 'days'),
              endDate: moment()
          },
          function (start, end) {
              $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
          }
        )

        //Date picker
        $('#datepicker').datepicker({
            autoclose: true
        })
		$('#datepicker1').datepicker({
            autoclose: true
        })

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        })
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
            checkboxClass: 'icheckbox_minimal-red',
            radioClass: 'iradio_minimal-red'
        })
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        })

        //Colorpicker
        $('.my-colorpicker1').colorpicker()
        //color picker with addon
        $('.my-colorpicker2').colorpicker()

        //Timepicker
        $('.timepicker').timepicker({
            showInputs: false
        })
    })
    $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1')
        //bootstrap WYSIHTML5 - text editor
        $('.textarea').wysihtml5()
    })
	  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
	  "columnDefs": [
        {"className": "text-center", "targets":[0,1,2,4,5]},
		{"className": "text-right", "targets":[3]}
      ]
    })
	
  })
    //numeric value
    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }
    //decimal value
    function isNumberKey2(txt, evt) {

        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode == 46) {
            //Check if the text already contains the . character
            if (txt.value.indexOf('.') === -1) {
                return true;
            } else {
                return false;
            }
        } else {
            if (charCode > 31
                 && (charCode < 48 || charCode > 57))
                return false;
        }
        return true;
    }
    // Email must be an email
    $('#txtemail').on('input', function () {
        var input = $(this);
        var re = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
        var is_email = re.test(input.val());
        if (is_email) { input.removeClass("invalid").addClass("valid"); }
        else { input.removeClass("valid").addClass("invalid"); }
    });
	// Website must be a website
$('#contact_website').on('input', function() {
	var input=$(this);
	if (input.val().substring(0,4)=='www.'){input.val('http://www.'+input.val().substring(4));}
	var re = /(http|ftp|https):\/\/[\w-]+(\.[\w-]+)+([\w.,@?^=%&:\/~+#-]*[\w@?^=%&\/~+#-])?/;
	var is_url=re.test(input.val());
	if(is_url){input.removeClass("invalid").addClass("valid");}
	else{input.removeClass("valid").addClass("invalid");}
});
//var inputs = document.getElementsByTagName('input');
 //   for(var i = 0;i < inputs.length; i++) {
 //   if(inputs[i].style.display == 'none') {
 //       inputs[i].disabled = true;
  //  }
//}
    function validation() {
	    var numerictxt1=$('#txtnumeric1').val();
		var numerictxt2=$('#txtnumeric2').val();
		var txtsmall=$('#txtSmall').val();
		var mail = $('#txtemail').val();
		var area=$('#txtarea').val();
		var inputs = document.getElementsByTagName('input');
		var Span = document.getElementsByTagName('Span');
		var textarea=document.getElementsByTagName('textarea');
		//debugger
		if(numerictxt1=='')
		{       //var inputnumeric1 = document.getElementById('spannumeric1');
		         var inputnumeric1 = $('#spannumeric1');
			    if(inputnumeric1.css("display", "none")) {
                //inputnumeric1.style.display = true;
				//inputnumeric1.css('display', 'true')
				inputnumeric1.visible=true;
                }
				return false;
		}
		else if(numerictxt2=='')
		{
			 var spannumeric2 = $('#spannumeric2');
			    if(spannumeric2.style.display == 'none') {
                spannumeric2.visible = 'true';
                }
				return false;
		}
		else if(txtsmall=='')
		{
			 var Spansmalltext = $('#Spansmalltext');
			    if(Spansmalltext.style.display == 'none') {
                Spansmalltext.visible = true;
                }
				return false;
		}
		else if(mail=='')
		{
			 var SpanMail = $('#SpanMail');
			    if(SpanMail.style.display == 'none') {
                SpanMail.visible = true;
                }
				return false;
		}
		else if(area=='')
		{
			 var spanTxtarea = $('#spanTxtarea');
			    if(spanTxtarea.style.display == 'none') {
                spanTxtarea.visible = true;
                }
				return false;
		}
		else if(mail!='')
		{
			var input = $('#txtemail');
			var re = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
			var is_email = re.test(mail);
			if (is_email) {
				input.removeClass("invalid").addClass("valid");
			}
			else {
				input.removeClass("valid").addClass("invalid");
			}
		}
		return true;
    }
	
  </script>
</body>
</html>

