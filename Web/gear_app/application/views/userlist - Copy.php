<?php
  $this->load->helper('url');
    
    $baseurl= $this->config->item('base_url');
    ?>
<!DOCTYPE html>
<html>
<head>
<style>
body {font-family: Arial, Helvetica, sans-serif;}

.myImg {
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
}

.myImg:hover {opacity: 0.7;}

/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0)!important; /* Fallback color */
    background-color: rgba(0,0,0,0.9)!important; /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-content {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
}

/* Caption of Modal Image */
#caption {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
    text-align: center;
    color: #ccc;
    padding: 10px 0;
    height: 150px;
}

/* Add Animation */
.modal-content, #caption {    
    -webkit-animation-name: zoom;
    -webkit-animation-duration: 0.6s;
    animation-name: zoom;
    animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
    from {-webkit-transform:scale(0)} 
    to {-webkit-transform:scale(1)}
}

@keyframes zoom {
    from {transform:scale(0)} 
    to {transform:scale(1)}
}

/* The Close Button */
.closemodal {
    position: absolute;
    top: 15px;
    right: 35px;
    color: #f1f1f1;
    font-size: 40px;
    font-weight: bold;
    transition: 0.3s;
}

.close:hover,
.close:focus {
    color: #bbb;
    text-decoration: none;
    cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
    .modal-content {
        width: 100%;
    }
}
</style>
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

  <!-- Order Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  
    <!-- Content Header (Page header) -->
    <section class="content-header" style="padding-top:15px;">
      <h1>
        User Management
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb" style="padding-top:18px;">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">User Management</li>
      </ol>
    </section>

    <!-- Main content -->
    
    <section class="content" style="overflow-x:auto; max-height:750px;">
    
    <div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">User Management</a></li>
			  
            </ul>
			
			<div class="button-section" id="buttonsection">
			<button class="btn btn-twitter btn-sm" data-toggle="collapse" data-target="#smallform"><i class="fa fa-filter" style="padding:3px;"></i>Filter</button>
			
			</div>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                <div class="row">
        <div class="col-xs-12">
          <div class="box box-info">
            <div class="box-header" style="background-color: #337ab7; color: #fff">
              <h3 class="box-title">User Management</h3>
			  <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" style="color:#fff"><i class="fa fa-minus"></i></button>
              </div>
            </div>
			<div class="box-body collapse"style="background-color: #D1D3D4;"id="smallform">
			<form method="post" action="<?php echo $baseurl;?>/getUserListItems">
          <div class="row form-horizontal">
		  
		  <div class="col-sm-12">
		  <div class="col-md-4">
				   <div class="form-group">
						<label for="" class="col-sm-3 control-label">Login ID:</label>
						<div class="col-sm-9">
						   <input type="text" class="form-control" name="UserID" <?php if(!empty($UserID)){ ?> value="<?php echo $UserID?>" <?php }?>>
						</div>
				 </div>
              <!-- /.form-group -->
			</div>
			  <div class="col-md-4">
			<div class="form-group">
						<label for="" class="col-sm-3 control-label">Name:</label>
						<div class="col-sm-9">
						    <input type="text" class="form-control" name="Name" <?php if(!empty($Name)){ ?> value="<?php echo $Name?>" <?php }?>>
						</div>
				 </div>
              <!-- /.form-group -->
            </div>
          
		  
			  </div>
			  <div class="col-sm-12">
			  <div class="col-md-4">
					  <div class="form-group">
						<label for="" class="col-sm-3 control-label">Location:</label>
						<div class="col-sm-9">
						    <select class="form-control" id="LocationID" name="LocationID">
						    
									<option <?php if($LocationID==0)echo " selected ";else echo "";?> value="">Select</option>
							  <?php
						  foreach ($location_table->result() as $row)
							 {

									 if($LocationID==$row->PK_LocationID)
									 {
									 
									?>
									<option selected value="<?php echo $row->PK_LocationID; ?>" ><?php echo $row->Location_name; ?></option>
									<?php
									 }
									 else
									 {
									?>
									<option  value="<?php echo $row->PK_LocationID; ?>" ><?php echo $row->Location_name; ?></option>
									
									<?php
									 }
							 }
				?>
				
							</select>
						</div>
				 </div>
              <!-- /.form-group -->
			  </div>
			  <div class="col-md-4">
				 <div class="form-group">
						<label for="" class="col-sm-3 control-label">User Group:</label>
						<div class="col-sm-9">
						    <select class="form-control" id="UserGroupId" name="UserGroupId">
						    
							 <option <?php if($UserGroupId==0)echo " selected ";else echo "";?> value="">Select</option>
							  <?php
                  foreach ($usergroup_table->result() as $row)
                     {

                 if($UserGroupId==$row->PK_UserGroupID)
				 {
                 
                ?>
				<option selected value="<?php echo $row->PK_UserGroupID; ?>" ><?php echo $row->UserGroup_name; ?></option>
				<?php
				 }
				 else
				 {
				?>
				<option  value="<?php echo $row->PK_UserGroupID; ?>" ><?php echo $row->UserGroup_name; ?></option>
				
				<?php
				 }
					 }
				?>
				
							</select>
						</div>
				 </div>
              <!-- /.form-group -->
			  </div>
            
			  <div class="col-md-4">
				  <div class="form-group">
						<label for="" class="col-sm-5 control-label">Company Name:</label>
						<div class="col-sm-7">
						   <select class="form-control" id="companyid" name="companyid">
						    
							 <option <?php if($companyid==0)echo " selected ";else echo "";?> value="">Select</option>
							  <?php
                  foreach ($company_table->result() as $row)
                     {

                 if($companyid==$row->PK_CompanyID)
				 {
                 
                ?>
				<option selected value="<?php echo $row->PK_CompanyID; ?>" ><?php echo $row->Company_name; ?></option>
				<?php
				 }
				 else
				 {
				?>
				<option  value="<?php echo $row->PK_CompanyID; ?>" ><?php echo $row->Company_name; ?></option>
				
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
			
			
			
			<div class="col-md-12">
			<div class="form-group">
						<div class="col-sm-10 filter">
						   <!--- <button type="button" class="btn btn-google btn-inner" id="closebtn"><i class="fa fa-close"style="margin-right: 4px;"></i>Close</button>--->
							<a href="<?php echo $baseurl;?>/getUserListItems">
							<button type="button"class="btn btn-warning btn-inner">Reset<i class="fa fa-edit"style="margin-left: 4px;"></i></button>
							</a>
							<button type="submit"class="btn btn-success btn-inner">Submit</button>
						</div>
				 </div>
			</div>
            <!-- /.col -->
          </div>
		  </form>
          <!-- /.row -->
        </div>
            <!-- /.box-header -->
            <div class="box-body">
             <div class="table-responsive">
             
             <table id="userdetails" class="table table-bordered table-hover table-striped userdetails">
                <thead>
           
				 <tr>
                  <th style="text-align:center;width:105px;">Login Id</th>
                  <th style="text-align:center;width:145px">Name</th>				  
				  <th style="text-align:center;width:61.3px;">Location</th>
				  <th style="text-align:center;width:61.3px;">User Group</th>
				  <th style="text-align:center;width:61.3px;">Brand</th>				  
				  <th style="text-align:center;width:61.3px;">View and Update</th>
                </tr>
                </thead>
                <tbody style="text-align:center;">
					 <?php
                  foreach ($userlist_table->result() as $row)
                     {
				 $ol_ID=$row->PK_UserID;
                 $ol_userID=$row->UserID;
				 $ol_name=$row->Name;
				 $ol_location=$row->Location;
				 $ol_group=$row->Groupname;
				// $ol_brandname=$row->CategoryName;  //changed
				 $ol_brandname=$row->AssignedBrands;
					$filtered_words = array(
								'Brand'
								);

							$zap ='';

					$filtered_brand = trim(str_replace($filtered_words,$zap,$ol_brandname));


                ?>
				
				 <tr>
                  <td style="text-align:center;"><?php echo  $ol_userID;?></td>
                  <td><?php echo $ol_name;?></td>
				  <td><?php echo $ol_location;?></td>
                  <td><?php echo $ol_group;?></td>
				  <td><?php echo $filtered_brand;?></td>	
				  <td><a href=#><i class="fa fa-fw fa-eye" style="font-size:23px;padding-right:10px" onclick="edituserbutton('<?php echo $baseurl;?>','<?php echo $ol_userID;?>','<?php echo $ol_name;?>','<?php echo $ol_location;?>','<?php echo $ol_group;?>','<?php echo $filtered_brand;?>','<?php echo $ol_ID;?>');"></i></a></td>			  
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
				  <h3 class="box-title">User Details</h3>
				  <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse" style="color:#fff"><i class="fa fa-minus"></i></button>
                 </div>
				</div>
				
				<div class="row form-horizontal">
				<div class="box-body">
					 <div class="col-sm-12">
					
					<div class="form-group col-sm-6">
					  <label  class="col-sm-5 control-label">User ID:</label>
						<div class="col-sm-7">
						<input class="form-control input-sm"  type="textbox" name="userid" id="userid" readonly>
					  </div>
					</div>
					<div class="form-group  col-sm-6">
					  <label  class="col-sm-5 control-label"> Name:</label>
					  <div class="col-sm-7">
						<input class="form-control input-sm"  type="textbox" name="username" id="username" readonly>
					  </div>
					</div>
					
					</div>
					<div class="col-sm-12" style="margin-bottom:9px;">
					<div class="form-group col-sm-6">
					  <label  class="col-sm-5 control-label">Group Name:</label>
						<div class="col-sm-7">
						<input class="form-control input-sm"  type="textbox" name="userGroup" id="userGroup" readonly>
					  </div>
					</div>
					<div class="form-group col-sm-6">					
					<label  class="col-sm-5 control-label">Location:</label>
						<div class="col-sm-7">
						<input class="form-control input-sm"  type="textbox" name="location" id="location" readonly>
					  </div>
					</div>
					</div>
					<div class="col-sm-12" style="margin-bottom:9px;">
					
					  
					<div class="form-group col-sm-6">
					  <label  class="col-sm-5 control-label"> Assign Brand :</label>
						<div class="col-sm-7">
						<input class="form-control input-sm"  type="textbox" name="brand" id="brand" readonly>
					   </div>
					</div>
					</div>
					</div>
				</div>
				<!-- row end -->
			</div>
			<!-- box -->
            </div>
            
			
				<div class="tab-pane" id="timeline">
					 <div class="box box-info">
						<div class="box-header with-border" style="color: #fff">
						  <h3 class="box-title">User Item Details</h3>
						  <div class="box-tools pull-right">
						  <button type="button" class="btn btn-box-tool" data-widget="collapse" style="color:#fff"><i class="fa fa-minus"></i></button>
						 </div>
						</div>
						<form method="post" action="<?php echo $baseurl;?>/updateUserItems">
						<div class="box-body">
						<div class="table-responsive"> 
							<table id="details" class="table table-bordered table-hover table-striped details">
							<thead>
							
							</thead>
							<tbody style="text-align:center;" id="items" name="items" >
								
																	
						     </tbody>
						    </table> 
					
						</div>
						<div  class="text-center">
						<button class="btn btn-primary" type="Submit" >Update</button>
						<button class="btn btn-danger" type="button" onclick="returnbutton();">Cancel</button>
						<button class="btn btn-warning" type="button" onclick="returnbutton();">Return</button>
						</div>
						</div>
						</form>
            <!-- /.box-body -->
				</div>
				</div>
            </div>
            <!-- /.tab-content -->
          </div>
          
          
     </section>     
          
	</div>
	<!-- User Wrapper End -->
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
	  // $(function () {
		// $('.userdetails').DataTable(
		// {
		// columnDefs: [ { orderable: false, targets: [0] } ]
		// })
    // })
	$('.userdetails').dataTable( {

columnDefs: [ { orderable: false, targets: [5] } ]
}); 
  
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

