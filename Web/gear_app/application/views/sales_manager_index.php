
<?php   

    $baseurl= $this->config->item('base_url');
?>
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

	 
  </style>
</head>
<body class="hold-transition skin-blue sidebar-mini"><!--skin-black-light-->
<div class="wrapper">

  <?php
$this->load->view('headersection');
?>

 <!-- Header Section End -->
	
 <!-- Left side column. contains the logo and sidebar -->
 <?php
$this->load->view('leftsidebar');
?>
  <div class="content-wrapper">
   <!-- Content Header (Page header) -->
    <section class="content-header" style="padding-top:15px;">
      <h1>
        Sales
        <small>Executive Manager</small>
      </h1>
      <ol class="breadcrumb" style="padding-top:18px;">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Sales</li>
      </ol>
    </section>
	<!-- Main content -->
	
	<section class="content" style="overflow-x:auto; max-height:750px;">
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
              <li class="active"id="editlist" ><a href="#activity" data-toggle="tab">Executive Manager</a></li>		
			  <!-- <li id="listTimeline" class="disabled"><a href="#edittimeline" id="timelinetab">Add User</a></li>	 -->		  
            </ul>
		<div class="button-section" id="buttonsection">

		<a class="btn btn-success btn-sm" href="<?php echo $baseurl;?>/sales_manager_add">Add</a>
	</div>
           <div class="box-body">
        	<div class="table-responsive">
             
             <table id="userdetails" class="table table-bordered table-hover table-striped userdetails">

                <thead>
           
				 <tr>
                  
		
		     <th>Company Name</th>
				
					<th style="text-align:center;">Sales Executive Name</th> 
					<th style="text-align:center;">Manager Name</th>
          <th>Actions</th>
					
                </tr>
            </thead>
            <tbody style="text-align:center;">
                <?php foreach($tbl_master_manager_salesexecutive as $t){ ?>
    		<tr>	
          <td><?php echo $t['Company_name']; ?></td>
			
				<td><?php echo $t['SalesExecutiveName']; ?></td>
				<td><?php echo $t['ManagerName']; ?></td>
        <td>
           
            <a href="<?php echo $baseurl;?>/remove/<?php echo $t['PK_Manager_SalesExecutiveID']; ?>" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
            
        </td>
		
    	</tr>

	<?php } ?>
</tbody>
				
              </table>
			  
             
             </div>
              
            </div>
        </div>
</section>


    
    <!-- /.content -->
  </div>
	<!-- content-wrapper end -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2017-2018 <a href="https://mgts.co.in/">MG Tathya Solution Pvt. Ltd</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  

</div>
<!-- ./wrapper -->


<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="bower_components/raphael/raphael.min.js"></script>
<script src="bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- ChartJS -->
<script src="bower_components/Chart.js/Chart.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard2.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<script>
	$(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        //CKEDITOR.replace('editor1')
        //bootstrap WYSIHTML5 - text editor
        $('.textarea').wysihtml5()
    })
	  // $(function () {
		// $('.userdetails').DataTable(
		// {
		// columnDefs: [ { orderable: false, targets: [0] } ]
		// })
    // })
	$('.userdetails').dataTable( {

columnDefs: [ { targets: [2] } ]
}); 
</script>

</body>
</html>


