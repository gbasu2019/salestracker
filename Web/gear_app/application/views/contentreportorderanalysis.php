<div class="content-wrapper">
   <!-- Content Header (Page header) -->
    <section class="content-header" style="padding-top:15px;">
      <h1>
        Report
        <small>Order Analysis</small>
      </h1>
      <ol class="breadcrumb" style="padding-top:18px;">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li >Report</li><li class="active">Order Analysis</li>
      </ol>
    </section>
	<!-- Main content -->
    <section class="content">
     <?php
                  //echo var_dump($orderstatusarray);
				  $chartdata="";
				  foreach ($orderstatusarray as $key => $value)
                 { 
			       $chartdata.="['".$key."',".  $value."],";
                   //echo "<p>$key = $value</p>";
                  }
                  date_default_timezone_set("Asia/Kolkata");
                   
                  if(empty($todate))
                  {
                  $todate=date("d/m/Y");
                  $date1=date("Y-m-d");
                  $date = strtotime(date("Y-m-d", strtotime($date1)) . " -7 days");
                  $fromdate = date("d/m/Y",$date);
                 }
              ?>
              <div class="col-md-12 content-box" style="padding:5">
              <div class="">

              <form method="post" action="<?=$baseurl.'/Report/Report-Daily-Call-History';?>">
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

              <div class="col-lg-2 campinselection" style="padding-top:2px;padding-right:40px">
              <button type="submit" class="btn btn-primary btn-md" onclick="changeCampin();">Search</button>
              </div>
              </form>

              </div>
              </div>
			  
			  
			  
			  
			  
			  <div class="col-md-12 content-box" style="padding:5">
<div class="">
<div id="piechart" class="col-md-6" ></div>
<div id = "columnchart"  class="col-md-6">

      </div>
      </div>
      </div>
      
               

               <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
// Load google charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

// Draw the chart and set the chart values
function drawChart() {
  var data = google.visualization.arrayToDataTable([
  ['Order', 'Status'],
   <?php echo $chartdata;?>
]);

  // Optional; add a title and set the width and height of the chart
  var options = {'title':'Order', 'width':650, 'height':300,is3D: true,colors:['Lime','red','orange','purple','orange'],pieSliceText: 'value'};

  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  
  function selectHandler() 
     {
   var selectedItem = chart.getSelection()[0];

       if (selectedItem) 
       {
         var topping = data.getValue(selectedItem.row, 0);
         alert('The user selected ' + topping);
       }
     } 


    google.visualization.events.addListener(chart, 'select', selectHandler);    
  chart.draw(data, options);





         
}





</script>

               
               
               <div class="col-md-12 content-box" style="padding:0">
<div class="">
<table id="example1" name="example1" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style="text-align:center;">Column1
                        </th>
                        <th style="text-align:left;">Column2
                        </th> 
                        <th style="text-align:left;">Column3
                        </th>
                        <th style="text-align:center;">Column4
                        </th>    
                        <th style="text-align:center;">Column5
                        </th> 
                      </tr>
                    </thead>
                    <tbody style="text-align:center;">
                      
                      <tr>                
                        <td style="text-align:center;">
                          1
                        </td>
                        <td style="text-align:left;">
                          2
                        </td>
                        <td style="text-align:left;">
                          3
                        </td>
                        <td style="text-align:center;">
                         4
                        </td>
                        <td style="text-align:center;">
                         5
                        </td>
                      </tr>

                      <tr>                
                        <td style="text-align:center;">
                          1
                        </td>
                        <td style="text-align:left;">
                          2
                        </td>
                        <td style="text-align:left;">
                          3
                        </td>
                        <td style="text-align:center;">
                         4
                        </td>
                        <td style="text-align:center;">
                         5
                        </td>
                      </tr>
                      <tr>                
                        <td style="text-align:center;">
                          1
                        </td>
                        <td style="text-align:left;">
                          2
                        </td>
                        <td style="text-align:left;">
                          3
                        </td>
                        <td style="text-align:center;">
                         4
                        </td>
                        <td style="text-align:center;">
                         5
                        </td>
                      </tr>
                      <tr>                
                        <td style="text-align:center;">
                          1
                        </td>
                        <td style="text-align:left;">
                          2
                        </td>
                        <td style="text-align:left;">
                          3
                        </td>
                        <td style="text-align:center;">
                         4
                        </td>
                        <td style="text-align:center;">
                         5
                        </td>
                      </tr>
                      <tr>                
                        <td style="text-align:center;">
                          1
                        </td>
                        <td style="text-align:left;">
                          2
                        </td>
                        <td style="text-align:left;">
                          3
                        </td>
                        <td style="text-align:center;">
                         4
                        </td>
                        <td style="text-align:center;">
                         5
                        </td>
                      </tr>
                                  
                    </tbody>            
                  </table>             
</div>
</div>

 

	  

    </section>
    <!-- /.content -->
  </div>
	