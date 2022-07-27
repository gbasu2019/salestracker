
<?php   

   $baseurl= $this->config->item('base_url');
    
  ?>


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
        </div>


        <div class="col-lg-2 campinselection" style="padding-top:2px;padding-right:40px">
          <input type="submit" class="btn btn-primary btn-md" name="submit" value="Export Excel">
        </div>
        </form>

      </div>
    </div>
    
    
	  <br>    
    <!-- /.content -->
</div>
	<!-- content-wrapper end -->
  







