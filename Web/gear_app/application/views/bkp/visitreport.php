
<?php   

   $baseurl= $this->config->item('base_url');
    $this->load->view('htmlstart');
    $this->load->view('commonheadercss');
    $this->load->view('leftsidebar');
    $this->load->view('headersection');
  ?>
 
<body class="hold-transition skin-blue sidebar-mini"><!--skin-black-light-->
<div class="wrapper">
  <div class="content-wrapper">
   <!-- Content Header (Page header) -->
    <section class="content-header" style="padding-top:15px;">
      <h1>
        Report
        <small>Visit Analysis</small>
      </h1>
      <ol class="breadcrumb" style="padding-top:18px;">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Visit Analysis</li>
      </ol>
    </section>
	

  <?php
                   
                  if(empty($todate))
                  {
                  $todate=date("Y-m-d");
                  $date1=date("Y-m-1");
                  $date = strtotime(date("Y-m-d", strtotime($date1)));
                  $fromdate = date("Y-m-d",$date);
                 }
              ?>
              <div class="col-md-12 content-box" style="padding:5">
              <div class="">

              <form method="post" action="<?php echo $baseurl;?>/reportexcel?>">
              <div class="col-lg-3 campinselection" style="padding-top:2px;padding-right:40px">
                <label class="col-sm-2 col-md-2 col-lg-4 control-label right campin">From:</label>
                  <div class="input-group date col-lg-8" id="datefrompicker" data-date-format="yyyy-mm-dd">
                    <input type="text" class="form-control" value="<?php echo $fromdate;?>" id="datefrom" name="datefrom">
                    <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                  </div>
              </div>

              <div class="col-lg-3 campinselection" style="padding-top:2px;padding-right:40px">
                <label class="col-sm-2 col-md-2 col-lg-4 control-label right campin">To:</label>
                  <div class="input-group date col-lg-8" id="datetopicker" data-date-format="yyyy-mm-dd">
                    <input type="text" class="form-control" value="<?php echo $todate;?>" id="dateto" name="dateto">
                    <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                  </div>
              </div>


              <div class="col-md-4">
          <div class="form-group">
            <label for="" class="col-sm-5 control-label">Company Name:</label>
            <div class="col-sm-7">
               <select class="form-control" id="companyid" name="companyid">
                

                <option  value="0" >SELECT</option>
               
                <?php
                  foreach ($cmpylist_table->result() as $row)
                     {                
                 
               
                  ?>
                <option  value="<?php echo $row->PK_CompanyID; ?>" ><?php echo $row->Company_name; ?></option>
        
                <?php        
                      }
                  ?>
        
              </select>
            </div>
         </div>
              <!-- /.form-group -->
        </div>


              <div class="col-lg-2 campinselection" style="padding-top:2px;padding-right:40px">
                <input type="submit" class="btn btn-primary btn-md" name="submit" value="Export Excel">
              </div>
              </form>

              </div>
              </div>
    
<!-- <ul class="" style="padding-top:18px;">
<li class="active"><a href="<?php echo $baseurl;?>/reportexcel"><i class="glyphicon glyphicon-log-in"></i>&nbsp;&nbsp;Export Excel</a>
</li>
</ul>  -->     
	  <br>
    

    </section>
    <!-- /.content -->
  </div>
	<!-- content-wrapper end -->
  <?php 
  $this->load->view('footer');
  
  ?>

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
$('#datefrompicker').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd'
        });
    $('#datetopicker').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd'
        });
</script>
</body>
</html>


