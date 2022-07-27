<?php
  $this->load->helper('url');
    
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
   <link rel="stylesheet" href="dist/css/buttons.dataTables.min.css">
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
<body class="hold-transition skin-blue sidebar-mini"><!--skin-black-light-->
<div class="wrapper">
<!-- Header Section Start -->
<?php
$this->load->view('headersection');
?>

 <!-- Header Section End -->
	
 <!-- Left side column. contains the logo and sidebar -->
 <?php
$this->load->view('leftsidebar');
?>

<!-- Left Side Bar End -->

  <!-- GRN Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  
    <!-- Content Header (Page header) -->
    <section class="content-header" style="padding-top:15px;">
      <h1>
        GRN Management
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb" style="padding-top:18px;">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">GRN Management</li>
      </ol>
    </section>

    <!-- Main content -->
    
    <section class="content" style="overflow-x:auto; max-height:750px;">
    
    <div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">GRN Management</a></li>
			  <li id="listTimeline" class="disabled"><a href="#timeline" id="timelinetab">View/Edit GRN</a></li>
            </ul>
			<div class="button-section" id="buttonsection">
			<!--<button class="btn btn-success btn-sm" onclick="editbutton();"></i>Add</button>-->
			<button class="btn btn-twitter btn-sm" data-toggle="collapse" data-target="#smallform"><i class="fa fa-filter" style="padding:3px;"></i>Filter</button>
			
			</div>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                <div class="row">
        <div class="col-xs-12">
          <div class="box box-info">
            <div class="box-header" style="background-color: #337ab7; color: #fff">
              <h3 class="box-title">GRN Management</h3>
			  <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" style="color:#fff"><i class="fa fa-minus"></i></button>
              </div>
            </div>
			<div class="box-body collapse"style="background-color: #D1D3D4;"id="smallform">
			<form method="post" action="<?php echo $baseurl;?>/getGrnListItems">
          <div class="row form-horizontal">
		  
		  <div class="col-sm-12">
			  <div class="col-md-4">
				<div class="form-group">
					<label for="" class="col-sm-5 control-label">From Date:</label>
					<div class="col-sm-7">
					  <div class='input-group date' id='datepicker' data-date="<?php echo $startDate;?>" data-date-format="yyyy-mm-dd">
							<input type='text' class="form-control" id="startDate" name="startDate" value="<?php echo $startDate;?>" />
							<span class="input-group-addon">
							<span class="glyphicon glyphicon-calendar"></span>
							</span>
						</div>
					</div>
				 </div>
              <!-- /.form-group -->
			  </div>
			  <div class="col-md-4">
				  <div class="form-group">
						<label for="" class="col-sm-5 control-label">To Date:</label>
						<div class="col-sm-7">
						 <div class='input-group date' id='datepicker1' data-date="<?php echo $endDate;?>" data-date-format="yyyy-mm-dd">
							<input type='text' id="endDate" name="endDate" class="form-control" value="<?php echo $endDate;?>" />
							<span class="input-group-addon">
							<span class="glyphicon glyphicon-calendar"></span>
							</span>
						</div>
						</div>
				 </div>
              <!-- /.form-group -->
			  </div>
            
			  <div class="col-md-4">
				  <div class="form-group">
						<label for="" class="col-sm-5 control-label">Company Name:</label>
						<div class="col-sm-7">
						   <select class="form-control" id="dealerid" name="dealerid">
						    
							 <option <?php if($dealerid==0)echo " selected ";else echo "";?> value="">Select</option>
							  <?php
                  foreach ($dealer_table->result() as $row)
                     {

                 if($dealerid==$row->PK_DealerID)
				 {
                 
                ?>
				<option selected value="<?php echo $row->PK_DealerID; ?>" ><?php echo $row->DealerName; ?></option>
				<?php
				 }
				 else
				 {
				?>
				<option  value="<?php echo $row->PK_DealerID; ?>" ><?php echo $row->DealerName; ?></option>
				
				<?php
				 }
					 }
				?>
				
							</select>
						</div>
				 </div>
              <!-- /.form-group -->
			  </div>
			 
			</div>
		  <div class="col-sm-12">
		  <div class="col-md-4">
				  <div class="form-group">
						<label for="" class="col-sm-5 control-label">GRN No.:</label>
						<div class="col-sm-7">
						   <input type="text" class="form-control" id="grnno" name="grnno" value="<?php echo $grnno;?>">
						</div>
				 </div>
              <!-- /.form-group -->
			</div>
			  <div class="col-md-4">
			  <div class="form-group">
						<label for="" class="col-sm-5 control-label">Status:</label>
						<div class="col-sm-7">
						    <select class="form-control" id="grnstatus" name="grnstatus">
							  <option <?php if($grnstatus==0)echo " selected ";else echo "";?> value="" >Select</option>
							  <?php
                  foreach ($status_table->result() as $row)
                     {

                 if($row->PK_StatusID==$grnstatus){
                 
                ?>
				<option selected value="<?php echo $row->PK_StatusID; ?>" ><?php echo $row->StatusName; ?></option>
				
				<?php
				 }
				 else
				 {
				
				?>
				<option  value="<?php echo $row->PK_StatusID; ?>" ><?php echo $row->StatusName; ?></option>
				<?php
				 }
					 }
				?>
							</select>
						</div>
				 </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
			 <div class="col-md-4">
			  <div class="form-group">
						<label for="" class="col-sm-5 control-label">Sales Person:</label>
						<div class="col-sm-7">
						    <select class="form-control" id="userid" name="userid">
							  <option <?php if($userid==0)echo " selected ";else echo "";?> value="">Select</option>
							  <?php
                  foreach ($user_table->result() as $row)
                     {

                 if($userid==$row->PK_UserID)
				 {
                 
                ?>
				<option selected  value="<?php echo $row->PK_UserID; ?>" ><?php echo $row->Name; ?></option>
				<?php
				 }
				 else
					 
					 {
				?>
				<option  value="<?php echo $row->PK_UserID; ?>" ><?php echo $row->Name; ?></option>
				<?php
					 }
					 }
				?>
							</select>
						</div>
				 </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
		  
			  </div>
			  
			
			
			<div class="col-md-12">
			<div class="form-group">
						<div class="col-sm-10 filter">
						   <!--- <button type="button" class="btn btn-google btn-inner" id="closebtn" ><i class="fa fa-close"style="margin-right: 4px;"></i>Close</button>-->
							<a href="<?php echo $baseurl;?>/getGrnListItems">
							<button type="button"class="btn btn-warning btn-inner">Reset<i class="fa fa-edit"style="margin-left: 4px;"></i></button>
							</a>
							<!--<button type="button"class="btn btn-success btn-inner">Submit</button>-->
							<input type="submit" value="Submit" class="btn btn-success btn-inner" />
						</div>
				 </div>
			</div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
		  </form>
        </div>
            <!-- /.box-header -->
            <div class="box-body">
             <div class="table-responsive">
             
             <table id="example" class="table table-bordered table-hover table-striped display example" style="width:100%">
                <thead>
                 <tr>
                  <th style="text-align:center;width:145px;">GRN Date</th>
                  <th style="text-align:center;width:145px">GRN Number</th>
				  <th style="text-align:center;width:105px;">Sales Person</th>
                  <th style="text-align:center;width:145px">Customer Name</th>
				  <th style="text-align:center;width:145px">Status</th>
				  <th style="text-align:center;width:145px">Action</th>
                </tr>
                </thead>
                <tbody style="text-align:center;">
				
				 <?php
                  foreach ($grnlist_table->result() as $row)
                     {
              
                 $ol_grnNo=$row->grnNo;
				 $ol_username=$row->UserName;
				 $ol_dealername=$row->DealerName;
				 $ol_grnstatus= $row->GrnStatus;
				 $time = strtotime($row->grnDate); 
				 $ol_grndate = date('d-m-Y',$time); 
				 $ol_grnid =$row->grnID;
                 
                ?>

                <tr>
                  <td style="text-align:center;"><?php echo  $ol_grndate;?></td>
                  <td><?php echo $ol_grnNo;?></td>
				  <td><?php echo $ol_username;?></td>
                  <td><?php echo $ol_dealername;?></td>
				  <td <?php if($ol_grnstatus=='Open') {?> style="color:blue;font-weight:bold;" <?php }?>
				  <?php if($ol_grnstatus=='Approved') {?> style="color:green;font-weight:bold;" <?php }?>
				  <?php if($ol_grnstatus=='Cancelled'){?> style="color:red;font-weight:bold;" <?php }?>><?php echo $ol_grnstatus;?></td>
				  <td><a href=#><i class="fa fa-fw fa-eye" style="font-size:23px;padding-right:10px" onclick="editgrnbutton('<?php echo $baseurl;?>','<?php echo $ol_grnid;?>','<?php echo $ol_grnNo;?>','<?php echo $ol_username;?>','<?php echo $ol_dealername;?>','<?php echo $ol_grnstatus;?>','<?php echo $ol_grndate;?>');"></i></a></td>
                </tr>				
              <?php
					 }
			  ?>
				
                </tbody>
				
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
         
             <div class="tab-pane" id="timeline">
             <div class="box box-info">
				<div class="box-header with-border" style="color: #fff">
				  <h3 class="box-title">GRN Viewer Details</h3>
				  <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse" style="color:#fff"><i class="fa fa-minus"></i></button>
                 </div>
				</div>
				
				<div class="row form-horizontal">
				<div class="box-body">
					<div class="col-sm-12">
					<div class="form-group  col-sm-4">
					  <label  class="col-sm-5 control-label">GRN Date:</label>
					  <div class="col-sm-7">
						<div class='input-group date' id='datepicker2'>
							<input type='text' class="form-control" id="selectedGrnDate" name="selectedGrnDate" />
							<span class="input-group-addon">
							<span class="glyphicon glyphicon-calendar"></span>
							</span>
						</div>
					  </div>
					</div>
					
					<div class="form-group col-sm-4">
					  <label  class="col-sm-5 control-label">GRN Number:</label>
						<div class="col-sm-7">
						<input class="form-control input-sm"  type="textbox" id="selectedGrnNumber" name="selectedGrnNumber" readonly>
					  </div>
					</div>
					<div class="form-group col-sm-4">
					  <label  class="col-sm-5 control-label">Sales Person:</label>
						<div class="col-sm-7">
						 <select class="form-control" id="selectedUser" name="selectedUser" >
							  
							</select>
					  </div>
					</div>
					</div>
					<div class="col-sm-12" style="margin-bottom:9px;">
					<div class="form-group col-sm-4">
					  <label  class="col-sm-5 control-label">Customer Name:</label>
						<div class="col-sm-7">
						 <select class="form-control" id="selectedCustomer" name="selectedCustomer">
							  
							</select>
					  </div>
					</div>
					<div class="form-group col-sm-4">
					  <label  class="col-sm-5 control-label">Status:</label>
						<div class="col-sm-7">
						<select class="form-control" id="selectedStatus" name="selectedStatus">
						
						 <?php
                  foreach ($status_table->result() as $row)
                     {

                
                 
                ?>
				<option  value="<?php echo $row->PK_StatusID; ?>" ><?php echo $row->StatusName; ?></option>
				<?php
				
				 }
				 
				 ?>
							  
							</select>
					   </div>
					</div>
					
					</div>

				</div>
					
				<div class="box-body">
					<div class="table-responsive"> 
						<table id="details" class="table table-bordered table-hover table-striped details">
						<thead>
							<tr>
							  <th style="text-align:center;width:145px;">Brand Name</th>
							  <th style="text-align:center;width:145px;">Product Category</th>
							  <th style="text-align:center;width:145px">Product Sub Category</th>
							  <th style="text-align:center;width:105px;">Item Name</th>
							  <th style="text-align:center;width:145px">Item Qty.</th>
							  <th style="text-align:center;width:105px;">Defect</th>
							  <th style="text-align:center;width:105px;">Feedback</th>
							</tr>
						</thead>
					<tbody style="text-align:center;" id="items" name="items" >
											
						</tbody>
							
						</table>
					
					</div>
						<!-- <div class="box-footer"> -->
					<div  class="text-center">
					<button class="btn btn-primary" type="Submit" onclick="savegrndata('<?php echo $baseurl;?>')" data-toggle="modal" data-target="#modal-default-Submit">Save</button>
					<button class="btn btn-danger" type="Cancel">Cancel</button>
					<button class="btn btn-warning" type="Exit" onclick="returnbutton();">Return</button>
					</div>
                </div>
				
				
				</div>
				<!-- row end -->
			</div>
			<!-- box -->
            </div>
			
		
            </div>
          <!-- /.tab-content -->
          
     </section>     
          
	</div>
 <!--  Order Wrapper End -->
 
  <!-- Footer Start -->
  <?php
$this->load->view('footersection');
?>
<!-- Footer End -->

 <!-- Right Control Sidebar -->
 <?php
$this->load->view('rightsidebar');
?>
<!-- Right Control Sidbar End -->
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




<script src="dist/js/dataTables.buttons.min.js"></script>
<script src="dist/js/buttons.flash.min.js"></script>
<script src="dist/js/jszip.min.js"></script>
<script src="dist/js/pdfmake.min.js"></script>
<script src="dist/js/vfs_fonts.js"></script>
<script src="dist/js/buttons.html5.min.js"></script>
<script src="dist/js/buttons.print.min.js"></script>


<!--Alertify js--->
<!-- include the script -->
<script src="dist/alertify/alertify.min.js"></script>
<!-- include the style -->
<link rel="stylesheet" href="dist/alertify/alertify.min.css" />
<!-- include a theme -->
<link rel="stylesheet" href="dist/alertify/themes/default.min.css" />



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
        //CKEDITOR.replace('editor1')
        //bootstrap WYSIHTML5 - text editor
        $('.textarea').wysihtml5()
    })
	  $(function () {
	 
	  var exportTitle = "GRN Report";
	  $('.example').dataTable({
        dom: 'Bfrtip',
        	"columnDefs": [    
	{"targets": 5,"orderable": false}
  ],
        buttons: [
             {
            extend: 'excel',
			title: exportTitle, 
            text: 'Export',
			exportOptions: {
                columns: [0,1,2,3,4]
            }
        }
        ]
    });
	if($(".dataTables_empty"). length){
	$('.buttons-excel').remove();
	}
	

    	$('.details').dataTable({
         "bFilter": false,
		 "bPaginate": false,
         "bLengthChange": false,
         "bInfo": false,
         "oLanguage": {
         "sEmptyTable": '',
         "sInfoEmpty": '',
	     "sZeroRecords":''
   },
   "sEmptyTable": "",
   "sZeroRecords":''
    
	});
    // $('#example2').DataTable({
      // 'paging'      : true,
      // 'lengthChange': false,
      // 'searching'   : false,
      // 'ordering'    : true,
      // 'info'        : true,
      // 'autoWidth'   : true,
	  // "columnDefs": [
        // {"className": "text-center", "targets":[0,1,2,4,5]},
		// {"className": "text-right", "targets":[3]}
      // ]
    // })
	
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

