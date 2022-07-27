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

  <script type="text/javascript">
function checkvisitall(n)
    {
    console.log(n.checked);
    var cboxes=document.getElementsByClassName('visitcheckbox');
    console.log(cboxes);
    for(var i=0;i<cboxes.length;i++)
    {
      //cboxes[i].checked=n.checked;
      cboxes[i].click();

    }

    }

  	function checkvisit(ckb,visitid){
//var cb=document.getElementsByClassName("visitcheckbox");
//alert(cb.length);
//alert(ckb.checked);
//alert(visitid);
try{


if(ckb.checked){
	document.getElementById("checkvisititem").value+=":"+visitid;
}
else{
	document.getElementById("checkvisititem").value=document.getElementById("checkvisititem").value.replace(":"+visitid, "");
}
}
catch(e){
alert(e);
}




try{


if(ckb.checked){
	document.getElementById("uncheckvisititem").value+=":"+visitid;
}
else{
	document.getElementById("uncheckvisititem").value=document.getElementById("uncheckvisititem").value.replace(":"+visitid, "");
}
}
catch(e){
alert(e);
}





  	}


  </script>
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
        Visit Management
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb" style="padding-top:18px;">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Visit Management</li>
      </ol>
    </section>

    <!-- Main content -->
    
    <section class="content" style="overflow-x:auto; max-height:750px;">
    
    <div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Visit Management</a></li>
			  <!--<li id="listTimeline" class="disabled"><a href="#timeline" id="timelinetab">View/Edit Visit</a></li>-->
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
              <h3 class="box-title">Visit Management</h3>
			  <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" style="color:#fff"><i class="fa fa-minus"></i></button>
              </div>
            </div>
			<div class="box-body collapse"style="background-color: #D1D3D4;"id="smallform">
			<form method="post" action="<?php echo $baseurl;?>/getVisitListItems">
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
						<label for="" class="col-sm-5 control-label">Status:</label>
						<div class="col-sm-7">
						    <select class="form-control" name="visitstatus">
							  <option value="">Select</option>
							  <option value="Approved"<?php if((!empty($visitstatus)) && ($visitstatus=='Approved')) { echo "selected";}?>>Approved</option>
							  <option value="Pending" <?php if((!empty($visitstatus)) && ($visitstatus=='Pending')) { echo "selected";}?>>Pending</option>							  
							  <option value="Reject" <?php if((!empty($visitstatus)) && ($visitstatus=='Reject')) { echo "selected";}?>>Reject</option>
							</select>
						</div>
				 </div>
              <!-- /.form-group -->
            </div>
		  
			  </div>
			  <div class="col-sm-12">
			
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
			<div class="col-sm-12">
			<div class="col-md-4">
			  <div class="form-group">
						<label for="" class="col-sm-5 control-label">Customer Name:</label>
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
			
			
			<div class="col-md-12">
			<div class="form-group">
						<div class="col-sm-10 filter">
						    <!---<button type="button" class="btn btn-google btn-inner" id="closebtn"><i class="fa fa-close" style="margin-right: 4px;"></i>Close</button>--->
							<a href="<?php echo $baseurl;?>/getVisitListItems">
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
            <form method="post" action="<?php echo $baseurl;?>/updateVisitStatusBulk">
			 <div class="col-sm-12" style="padding-bottom:10px;">
			 <input type="hidden" name="statusVal" value="<?php echo isset($visitstatus)?$visitstatus:'';?>" >
       <div class="col-sm-4">
                  <b>Select All</b>&nbsp;&nbsp;<input  type="checkbox"  name="visitall" onclick="checkvisitall(this)" />
                  
                  </div> 
             		<div class="col-sm-4">
             			<input type="hidden" name="checkvisititem" id="checkvisititem"/>
             			<input type="submit" value="Approve" name="approve" class="btn btn-success btn-sm btn-block">
             	    </div>
             	    <div class="col-sm-4">
             	    	<input type="hidden" name="uncheckvisititem" id="uncheckvisititem"/>
             			<input type="submit" value="Reject" name="reject" class="btn btn-danger btn-sm btn-block">
             		</div>
             	</div>
             <table id="example"  style="padding-top:10px;" class="table table-bordered table-hover table-striped display example" >
                <thead>
           
				 <tr>
				  <th style="text-align:center;">Select</th>
                  <th style="text-align:center;">Visit Date</th>
				  <th style="text-align:center;">Visit Time</th>
                  <th style="text-align:center;">Sales Person</th>
                  <th style="text-align:center;">Customer Name</th>
				  <th style="text-align:center;">Customer Address</th>				  				 
				  <th style="text-align:center;">Visited Address</th>
				  <th style="text-align:center;">Company</th>
				  <th style="text-align:center;">Status</th>
				  <th style="text-align:center;">Visit Image</th>
				  <th style="text-align:center;">Action</th>
                </tr>
                </thead>
                <tbody style="text-align:center;">
					 <?php
                  foreach ($visitlist_table->result() as $row)
                     {
              
                 $ol_visitid=$row->VisitID;
				 $ol_username=$row->UserName;
				 $ol_dealername=$row->DealerName;
				 $ol_dealeraddress=$row->dealeraddress;
				 $Companyname=$row->Companyname;
				 $ol_visitstatus= $row->VisitStatus;
				 $timestamp = strtotime($row->VisitDate); 
				 $time=date('h:i:sa', $timestamp);
				 $visitimage=$row->VisitImage;
				 $address=$row->Location;
				 $ol_visitdate = date('d-m-Y',$timestamp); 
				
                 
                ?>
				
				 <tr>
				   <td style="text-align:center;"><input class="visitcheckbox" type="checkbox" value="<?php echo $ol_visitid;?>" name="selectItem[]" onclick="checkvisit(this,'<?php echo $ol_visitid;?>')"></td>
                  <td style="text-align:center;"><?php echo  $ol_visitdate;?></td>
				  <td><?php echo $time;?></td>                 
				  <td><?php echo $ol_username;?></td>
                  <td><?php echo $ol_dealername;?></td>
				  <td><?php echo $ol_dealeraddress;?></td>
				  <td><?php echo $address;?></td>
				  <td><?php echo $Companyname;?></td>
				  <td <?php if($ol_visitstatus=='Pending') {?> style="color:blue;font-weight:bold;" <?php }?>
				  <?php if($ol_visitstatus=='Approved') {?> style="color:green;font-weight:bold;" <?php }?>
				  <?php if($ol_visitstatus=='Reject'){?> style="color:red;font-weight:bold;" <?php }?>><?php echo $ol_visitstatus;?></td>				  
				   <td>				   
				   <img src="<?php echo $visitimage;?>" width="50" height="50" id="myImg<?php echo $ol_visitid;?>" class="myImg" >				   
				   </td>				  
				  <td>
				<div id="myModal<?php echo $ol_visitid;?>" class="modal">
  <span class="closemodal" id="closemodal<?php echo $ol_visitid;?>" style="color:white;">&times;</span>
  <img class="modal-content" id="img<?php echo $ol_visitid;?>">
  
</div>
<script>

	document.getElementById('myImg<?php echo $ol_visitid;?>').onclick = function(){
    document.getElementById('myModal<?php echo $ol_visitid;?>').style.display = "block";	
    document.getElementById('img<?php echo $ol_visitid;?>').src = this.src;	
    
};

  document.getElementById('closemodal<?php echo $ol_visitid;?>').onclick = function() {
  document.getElementById('myModal<?php echo $ol_visitid;?>').style.display = "none";
}
</script>
				 <?php if($ol_visitstatus!="Approved"){?> 
				 <p>
				<form action="<?php echo $baseurl;?>/updateVisitStatus" method="post">
				<input type="hidden" value="<?php echo $ol_visitid;?>" name="visitid" >				
				<input type="hidden" value="Approved" name="status" >	
        <input type="hidden" value="<?php echo  $visitstatus;?>" name="visitstatus" >       
				<input type="hidden" value="<?php echo $startDate;?>" name="startDate" >
				<input type="hidden" value="<?php echo $endDate;?>" name="endDate" >
				<input type="hidden" value="<?php echo $userid;?>" name="userid" >
				<input type="hidden" value="<?php echo $dealerid;?>" name="dealerid" >
        <input type="hidden" value="<?php echo $companyid;?>" name="companyid" >
				<input type="submit" value="Approve" class="btn btn-success btn-sm btn-block" />
				</form>
				</p>
				
				 <?php }
				 if($ol_visitstatus!="Reject"){
				 ?>
				 <p>
				<form action="<?php echo $baseurl;?>/updateVisitStatus" method="post">
				<input type="hidden" value="<?php echo $ol_visitid;?>" name="visitid" >
				<input type="hidden" value="Reject" name="status" >
         <input type="hidden" value="<?php echo  $visitstatus;?>" name="visitstatus" >		
				<input type="hidden" value="<?php echo $startDate;?>" name="startDate" >
				<input type="hidden" value="<?php echo $endDate;?>" name="endDate" >
				<input type="hidden" value="<?php echo $userid;?>" name="userid" >
				<input type="hidden" value="<?php echo $dealerid;?>" name="dealerid" >	
        <input type="hidden" value="<?php echo $companyid;?>" name="companyid" >			
				<input type="submit" value="Reject" class="btn btn-danger btn-sm btn-block" />
				</form>				
				</p>				
				 <?php 
				  }
				  ?>
				  </td>
                </tr>				
              <?php
					 }
			  ?>
				
                </tbody>				
              </table> 
             </form>
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
				  <h3 class="box-title">Visit Details</h3>
				  <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse" style="color:#fff"><i class="fa fa-minus"></i></button>
                 </div>
				</div>
				
				<div class="row form-horizontal">
				<div class="box-body">
					 <div class="col-sm-12">
					
				<!--	<div class="form-group col-sm-4">
					  <label  class="col-sm-5 control-label">Visit Number:</label>
						<div class="col-sm-7">
						<input class="form-control input-sm"  type="textbox" required>
					  </div>
					</div>-->
					<div class="form-group  col-sm-4">
					  <label  class="col-sm-5 control-label">Visit Date:</label>
					  <div class="col-sm-7">
						<div class='input-group date' id='datepicker2'>
							<input type='text' class="form-control" />
							<span class="input-group-addon">
							<span class="glyphicon glyphicon-calendar"></span>
							</span>
						</div>
					  </div>
					</div>
					<div class="form-group col-sm-4">
					  <label  class="col-sm-5 control-label">Sales Person:</label>
						<div class="col-sm-7">
						<select class="form-control">
							  <option selected="selected">Select</option>
							  <option>Abhijit Ghosh</option>
							  <option>Amitava Ghosh</option>
							  <option>Babu Dey</option>
							</select>
					  </div>
					</div>
					</div>
					<div class="col-sm-12" style="margin-bottom:9px;">
					<div class="form-group col-sm-4">
					  <label  class="col-sm-5 control-label">Customer Name:</label>
						<div class="col-sm-7">
						<input class="form-control input-sm"  type="textbox" required>
					  </div>
					</div>
					<div class="form-group col-sm-4">
					  <label  class="col-sm-5 control-label">Status:</label>
						<div class="col-sm-7">
						<select class="form-control">
							  <option selected="selected">Select</option>
							  <option>Approved</option>
							  <option>Double Order</option>
							  <option>Open</option>  
							  <option>Rejected</option>
							</select>
					   </div>
					</div>
					
					</div>
					
					<!-- <div class="box-footer"> -->
					<div  class="text-center">
					<button class="btn btn-primary" type="Submit" onclick="return validation();" data-toggle="modal" data-target="#modal-default-Submit">Save</button>
					<button class="btn btn-danger" type="Cancel">Cancel</button>
					<button class="btn btn-warning" type="Exit" onclick="returnbutton();">Return</button>
					</div>
					</div>
				</div>
				<!-- row end -->
			</div>
			<!-- box -->
            </div>
            <!-- tab pan end -->
			
			<div class="tab-pane" id="timeline">
             <div class="box box-info">
				<div class="box-header with-border" style="color: #fff">
				  <h3 class="box-title">Audit Details</h3>
				  <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse" style="color:#fff"><i class="fa fa-minus"></i></button>
                 </div>
				</div>
				
				<div class="row form-horizontal">
				<div class="box-body">
					 <div class="col-sm-12">
					
					<div class="form-group col-sm-6">
					  <label  class="col-sm-5 control-label">Create User:</label>
						<div class="col-sm-7">
						<input class="form-control input-sm"  type="textbox" required>
					  </div>
					</div>
					<div class="form-group  col-sm-6">
					  <label  class="col-sm-5 control-label">Modify User:</label>
					  <div class="col-sm-7">
						<input class="form-control input-sm"  type="textbox" required>
					  </div>
					</div>
					</div>
					<div class="col-sm-12">
					<div class="form-group col-sm-6">
					  <label  class="col-sm-5 control-label">Create Time:</label>
						<div class="col-sm-7">
						<input class="form-control input-sm"  type="textbox" required>
					  </div>
					</div>
					
					<div class="form-group col-sm-6">
					  <label  class="col-sm-5 control-label">Modify Time:</label>
						<div class="col-sm-7">
						<input class="form-control input-sm"  type="textbox" required>
					  </div>
					</div>
					</div>
				
					</div>
					
				</div>
				<!-- row end -->
			</div>
			<!-- box -->
            </div>
            <!-- tab pan end -->
			
				<div class="tab-pane" id="timeline">
					 <div class="box box-info">
						<div class="box-header with-border" style="color: #fff">
						  <h3 class="box-title">Visit Item Details</h3>
						  <div class="box-tools pull-right">
						  <button type="button" class="btn btn-box-tool" data-widget="collapse" style="color:#fff"><i class="fa fa-minus"></i></button>
						 </div>
						</div>
						<div class="box-body">
						<div class="table-responsive"> 
						<!--	<table id="example1" class="table table-bordered table-hover table-striped">
							<thead>
								<tr>
								<th style="text-align:center;width:27px;">Brand Name</th>
								<th style="text-align:center;width:40px">Product Category</th>
								<th style="text-align:center;width:105px;">Product Sub Catogory</th>
								<th style="text-align:center;width:27px;">Item Name</th>
								<th style="text-align:center;width:27px;">Item Disp Stock</th>
								<th style="text-align:center;width:27px;">Item Whrh Stock</th>
								</tr>
							</thead>
							<tbody style="text-align:center;">
								<tr>
								<td>xyz</td>
								<td>Product category</td>
								<td>Product sub-category</td>
								<td>Item Name</td>
								<td>Item Disp Stock</td>
								<td>Item Whrh Stock</td>
                                </tr>								
							</tbody>
							
						    </table> -->
					
						</div>
						<div  class="text-center">
						<button class="btn btn-primary" type="Submit" onclick="return validation();" data-toggle="modal" data-target="#modal-default-Submit">Save</button>
						<button class="btn btn-danger" type="Cancel">Cancel</button>
						<button class="btn btn-warning" type="Exit" onclick="returnbutton();">Return</button>
						</div>
						</div>
            <!-- /.box-body -->
				</div>
				</div>
            </div>
            <!-- /.tab-content -->
          </div>
          
          
     </section>     
          
	</div>
	<!-- Visit Wrapper End -->
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
	   var exportTitle = "Visitreport";
    $('.example').DataTable({
      dom: 'lBfrtip',
      "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        
         
		"columnDefs": [
    { "width": "10%", "targets": 1 },
	{"targets": 0,"orderable": false},
	{"targets": 8,"orderable": false},
	{"targets": 9,"orderable": false}
  ],

        buttons: [
            {
            extend: 'excel',
			title: exportTitle, 
            text: 'Export',
            exportOptions: {
                modifier: {
                    page: 'all'
                }
            }
        }
        ]
    })
	if($(".dataTables_empty"). length){
	$('.buttons-excel').remove();
	}
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
	  "columnDefs": [
        {"className": "text-center", "targets":[0,1,2,4,5]},
		{"className": "text-right", "targets":[3]},
		 { width: 200, targets: 0 }
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

