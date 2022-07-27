



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
  <link href="https://www.fontify.me/wf/af83a66be5d910ef21b7df40e1dd588f" rel="stylesheet" type="text/css">
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
        Sales Manager
        <small>Add</small>
      </h1>
      <ol class="breadcrumb" style="padding-top:18px;">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Sales Manager</li>
      </ol>
    </section>
	<!-- Main content -->
    <section class="content">
     
     <!-- <form action="<?php echo $baseurl;?>/uploadexcel" method="post" enctype="multipart/form-data">
    Select file to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload File" name="submit">
</form>
	  <br>
    <?php 
if(!empty($msg)){
    ?>
    <div class="alert alert-success">
  <strong>Success!</strong> <?php echo $msg;?>
</div>
<?php
}

?> -->

<?php echo form_open('tbl_master_manager_salesexecutive/add'); ?>

	<!-- <div class="form-group col-sm-5">
<label class="col-sm-5 control-label">Tbl Master Location : </label>
		<div class="col-sm-7">
		<select name="FK_LocationID">
			<option value="">select location</option>
			<?php 
			foreach($all_tbl_master_location as $tbl_master_location)
			{
				$selected = ($tbl_master_location['PK_LocationID'] == $this->input->post('FK_LocationID')) ? ' selected="selected"' : "";

				echo '<option value="'.$tbl_master_location['PK_LocationID'].'" '.$selected.'>'.$tbl_master_location['Location_name'].'</option>';
			} 
			?>
		</select>
	</div>
	</div> -->
  
    <div class="form-group">
		<label class=" control-label">Tbl Master Company :  </label>
		<div >
		<select name="FK_CompanyID" class="form-control">
			<option value="">select company</option>
			<?php 
			foreach($all_tbl_master_company as $tbl_master_company)
			{
				$selected = ($tbl_master_company['PK_CompanyID'] == $this->input->post('FK_CompanyID')) ? ' selected="selected"' : "";

				echo '<option value="'.$tbl_master_company['PK_CompanyID'].'" '.$selected.'>'.$tbl_master_company['Company_name'].'</option>';
			} 
			?>
		</select>
	</div>
	</div>


	
	<div class="form-group">
    <label class="control-label">Sales Executive :</label>
		<div >
		<select id="Selectedsale" onchange="SalesFunction()" name="FK_USER_SalesExecutiveID" required class="form-control">
			<option value="">select sales executive</option>
			<?php 
			foreach($all_tbl_master_userinformation as $tbl_master_userinformation)
			{
				if($tbl_master_userinformation['PK_UserID'] )
				$selected = ($tbl_master_userinformation['PK_UserID'] == $this->input->post('FK_USER_SalesExecutiveID')) ? ' selected="selected"' : "";

				echo '<option value="'.$tbl_master_userinformation['PK_UserID'].'" '.$selected.'>'.$tbl_master_userinformation['Name'].'-'.$tbl_master_userinformation['Company_name'].'</option>';
			} 
			?>
		</select>
	</div>
</div>
	<!-- <p id="demo"></p> -->
  	<div class="form-group ">
      <label class=" control-label">Manager : </label>
		<div >
		<select id="SelectedManeger" onchange="ManagerFunction()" name="FK_User_MangerID" required class="form-control">
			<option value="">select manager</option>
			<?php 
			foreach($all_tbl_master_userinformation as $tbl_master_userinformation)
			{
				$selected = ($tbl_master_userinformation['PK_UserID'] == $this->input->post('FK_User_MangerID')) ? ' selected="selected"' : "";

				echo '<option value="'.$tbl_master_userinformation['PK_UserID'].'" '.$selected.'>'.$tbl_master_userinformation['Name'].'-'.$tbl_master_userinformation['Company_name'].'</option>';
			} 
			?>
		</select>
	</div>
</div>
	
	<div class="form-group ">
    <label class=" control-label">SalesExecutiveName :</label>
		 <div class="">
		<input disabled type="text" name="SalesExecutiveName1" id="SalesExecutiveName1" class="form-control"/>
    <input  type="hidden" name="SalesExecutiveName" id="SalesExecutiveName"/>
	</div>
	
	</div>


	<div class="form-group ">
    <label class="control-label">ManagerName : </label>
		 <div class="">
		<input disabled type="text" name="ManagerName1" id="ManagerName1" class="form-control" />
    <input  type="hidden" name="ManagerName" id="ManagerName" />
	</div>
</div>
	
  <div class="form-group col-sm-6">
   
	<button type="submit">Save</button>

</div>

<?php echo form_close(); ?>


 <div class="form-group col-sm-6">
  
	<a href="<?php echo $baseurl.'/salesmanager'; ?>" >Show List</a>

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
  
<div class="control-sidebar-bg"></div>
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

<script>
function SalesFunction() {

  //document.getElementById("demo").innerHTML = document.getElementById("mySelect").value;
  var skillsSelect = document.getElementById("Selectedsale");
  var selectedText = skillsSelect.options[skillsSelect.selectedIndex].text; 
  var selectedTextarr=selectedText.split("-") ; 
  //document.getElementById("demo").innerHTML = selectedText;
  document.getElementById("SalesExecutiveName1").value = selectedText;
  document.getElementById("SalesExecutiveName").value = selectedTextarr[0];
}

function ManagerFunction() {

  //document.getElementById("demo").innerHTML = document.getElementById("mySelect").value;
  var skillsSelect = document.getElementById("SelectedManeger");
  var selectedText = skillsSelect.options[skillsSelect.selectedIndex].text; 
  var selectedTextarr=selectedText.split("-") ;
  //document.getElementById("demo").innerHTML = selectedText;
  document.getElementById("ManagerName1").value = selectedText;
  document.getElementById("ManagerName").value = selectedTextarr[0];
}
</script>

</body>
</html>



































