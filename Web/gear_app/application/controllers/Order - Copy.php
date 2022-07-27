<?php

if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }

    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

        exit(0);
    }


defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}
	
	public function getStatusDropDown()
	{
		$postdata = file_get_contents("php://input");
		if (isset($postdata))
			{
			
		       $request = json_decode($postdata);
			  
			   $statustype=$request->statustype;
		$sql="select PK_StatusID,StatusName,StatusDefault from  tbl_status where StatusType='".$statustype."' order by StatusDefault desc";
		
		$query = $this->db->query($sql);
		$orderstatusarray=array();
		$i=0;
		$orderstatusarray[$i]["PK_StatusID"]=0;
				$orderstatusarray[$i]["StatusName"]="All";
				$orderstatusarray[$i]["StatusDefault"]=1;
		$i=1;
		foreach ($query->result() as $row)
             {
			 
				$PK_StatusID=$row->PK_StatusID;
				$StatusName=$row->StatusName;
				$StatusDefault=$row->StatusDefault;
				
				$orderstatusarray[$i]["PK_StatusID"]=$PK_StatusID;
				$orderstatusarray[$i]["StatusName"]=$StatusName;
				$orderstatusarray[$i]["StatusDefault"]=0;
				
				
				
				$i++;
				
				
			 }
			 
			 $json = array();
			 $jsonarray = array(
        
		'orderstatuslist'=>$orderstatusarray 
        
          );
		 //  echo var_dump($jsonarray);
		   array_push($json, $jsonarray);   
           $jsonstring = json_encode($json);
           echo $jsonstring;
           die();
			}
		
	}
	public function viewOrderList()
	{
		$sql_status="select PK_StatusID,StatusName,StatusDefault from  tbl_status where StatusType='Order' order by StatusDefault desc";		
		$query_status = $this->db->query($sql_status);
		$data["status_table"]=$query_status ;
		
		$sql_dealer="select PK_DealerID,DealerName from tbl_master_dealerinformation where IsActive=1 and cwExecutiveName!='Not Applicable' order by       DealerName";
		$query_dealer = $this->db->query($sql_dealer);
		$data["dealer_table"]=$query_dealer ;
		
		$sql_user="select PK_UserID,Name from tbl_master_userinformation where IsActive=1 and  FK_UserGroupId=2 order by Name";
		$query_user = $this->db->query($sql_user);
		$data["user_table"]=$query_user ;
		
		
		$endDate=date('Y-m-d');
		
		$day_limit = 4; # No.of days

        $added_timestamp = strtotime('-'.$day_limit.' day', time());

        $startDate = date('Y-m-d', $added_timestamp);
		
		$day_limit=1;
		
		$added_timestamp = strtotime('+'.$day_limit.' day', time());

        $endDate = date('Y-m-d', $added_timestamp);
		
		$sql="select A.PK_OrderID as OrderID,A.OrderNo as OrderNo,A.OrderDate as OrderDate,A.FK_DealerID as DealerID,B.DealerName
               as DealerName,C.StatusName as OrderStatus ,0 as Quantity,D.Name as UserName from tbl_trans_ordermaster A,tbl_master_dealerinformation B ,tbl_status C ,tbl_master_userinformation D 
               where A.FK_DealerID=B.PK_DealerID  and OrderDate>='".$startDate."' and OrderDate<='".$endDate."'  and A.FK_StatusID=C.PK_StatusID and D.PK_UserID=A.FK_CreatedBy";
			  // echo $sql;
			   $query_order = $this->db->query($sql);
			   $data["orderlist_table"]=$query_order;
		
		
		$this->load->view('orderlist',$data);
		
	}
	public function getOrderListItems()
	{   
	    $userid=$this->input->post('userid');
		$userid=isset($userid)?$userid:0;
		$data["userid"]=$userid;
		
		$dealerid=$this->input->post('dealerid');
		$dealerid=isset($dealerid)?$dealerid:0;
		$data["dealerid"]=$dealerid;
		
		$startDate=$this->input->post('startDate');
		$day_limit=3;
		$added_timestamp = strtotime('-'.$day_limit.' day', time());
        $startDate=isset($startDate)?$startDate:date('Y-m-d', $added_timestamp);
		$startDate_search = $startDate." 00:00:00";
		
		$data["startDate"]=$startDate;
		
		
		$endDate=$this->input->post('endDate');
		$endDate=isset($endDate)?$endDate:date("Y-m-d");
		$endDate_search=$endDate." 23:59:59";
		
		$data["endDate"]=$endDate;
		
		
		$orderstatus=$this->input->post('orderstatus');
		$orderstatus=isset($orderstatus)?$orderstatus:0;
		$data["orderstatus"]=$orderstatus;
		
		
		$sql_status="select PK_StatusID,StatusName,StatusDefault from  tbl_status where StatusType='Order' order by StatusDefault desc";		
		$query_status = $this->db->query($sql_status);
		$data["status_table"]=$query_status ;
		
		$sql_dealer="select PK_DealerID,DealerName from tbl_master_dealerinformation where IsActive=1";
		$query_dealer = $this->db->query($sql_dealer);
		$data["dealer_table"]=$query_dealer ;
		
		$sql_user="select PK_UserID,Name from tbl_master_userinformation where IsActive=1 and FK_UserGroupId=2";
		$query_user = $this->db->query($sql_user);
		$data["user_table"]=$query_user ;
		
	
		
		      $sql="select A.PK_OrderID as OrderID,A.OrderNo as OrderNo,A.OrderDate as OrderDate,A.FK_DealerID as DealerID,B.DealerName
               as DealerName,C.StatusName as OrderStatus ,0 as Quantity,D.Name as UserName from tbl_trans_ordermaster A,tbl_master_dealerinformation B ,tbl_status C ,tbl_master_userinformation D 
               where A.FK_DealerID=B.PK_DealerID  and OrderDate>='".$startDate_search."' and OrderDate<='".$endDate_search."'  and A.FK_StatusID=C.PK_StatusID and D.PK_UserID=A.FK_CreatedBy";
			   
			  // echo $sql;
			   
			    if($orderstatus!=0)$sql.=" and A.FK_StatusID=".$orderstatus." ";
			    if($userid!=0)$sql.=" and A.FK_CreatedBy=".$userid." ";			 
			    if($dealerid!=0)$sql.=" and A.FK_DealerID=".$dealerid;
				
				 $orderno=$this->input->post('orderno');
		         $orderno=isset($orderno)?$orderno:"";
		         $data["orderno"]=$orderno;
				 if($orderno!="")
				 {
				$sql="select A.PK_OrderID as OrderID,A.OrderNo as OrderNo,A.OrderDate as OrderDate,A.FK_DealerID as DealerID,B.DealerName
               as DealerName,C.StatusName as OrderStatus ,0 as Quantity,D.Name as UserName from tbl_trans_ordermaster A,tbl_master_dealerinformation B ,tbl_status C ,tbl_master_userinformation D 
               where A.FK_DealerID=B.PK_DealerID    and A.FK_StatusID=C.PK_StatusID and D.PK_UserID=A.FK_CreatedBy and A.OrderNo='".$orderno."'";
				 }
			   
			   
			   
			   $query_order = $this->db->query($sql);
			   $data["orderlist_table"]=$query_order;			   
			   $this->load->view('orderlist',$data);
		
		
	}
	
	public function getDealerList()
	{
		$usergroupid=0;
		$username1="";
		$sql="";
		$status=0;
		 $json = array();
		$postdata = file_get_contents("php://input");
	    if (isset($postdata))
			{
		      $request = json_decode($postdata);
		      $username1 = $request->username;
			  $usergroupid=$request->usergroupid;
			  $locationid=$request->locationid;
			  $companyid=$request->companyid;
			}
		if($usergroupid==1)
$sql="Select PK_DealerID as dealerid,DealerName as dealername,cwProductName as brandname,FK_LocationID as LocationID,FK_CompanyID as CompanyID from tbl_master_dealerinformation Where cwExecutiveName !='Not Applicable' and IsActive=1 and FK_LocationID=".$locationid." and FK_CompanyID=".$companyid ." order by DealerName";
else
$sql="Select PK_DealerID as dealerid,DealerName as dealername,cwProductName as brandname,FK_LocationID as LocationID,FK_CompanyID as CompanyID from tbl_master_dealerinformation Where cwExecutiveName like '".$username1."' and FK_LocationID=".$locationid." and FK_CompanyID=".$companyid ."  and IsActive=1 order by DealerName";

$query = $this->db->query($sql);
		   
		   $i=0;
		   $dealerArray=array();
		   if($query -> num_rows() >= 1)
          {
			  $status=1;
		      foreach ($query->result() as $row)
             {
			 
				$dealerid=$row->dealerid;
				$dealername=$row->dealername;
				//$brandid=$row3->brandid;
				$brandname=$row->brandname;
				$CompanyID=$row->CompanyID;
				$LocationID=$row->LocationID;
				
				$dealerArray[$i]["dealerid"]=$dealerid;
				$dealerArray[$i]["dealername"]=$dealername;
				$dealerArray[$i]["brandname"]=$brandname;
				$dealerArray[$i]["CompanyID"]=$CompanyID;
				$dealerArray[$i]["LocationID"]=$LocationID;
				
				$i++;
				
			 }
		  }
			 
			 $jsonarray = array(
       
		'dealers'=>$dealerArray ,
		'status'=>$status
        
          );
		  
		  
			 
		 
		 
		 array_push($json, $jsonarray);   
         $jsonstring = json_encode($json);
         echo $jsonstring;
         die();
			 
			 
		
	}
	public function getOrderList()
	{
		$postdata = file_get_contents("php://input");
		$sql="";
		
		if (isset($postdata))
			{
			
		       $request = json_decode($postdata);
			  // echo "request=".var_dump($request);
			   $userid=$request->userid;
			   $dealerid=$request->dealerid;
			   $startDate=$request->startDate;			   
			   $endDate=$request->endDate;
			   $orderstatus=$request->orderstatus;
			   $usergroupid=$request->usergroupid;
			   $startDate=$startDate." "."00:00:00";
			   $endDate=$endDate." "."23:59:59";
			   
			   				   
				$sql="select A.PK_OrderID as OrderID,A.OrderNo as OrderNo,A.OrderDate as OrderDate,A.FK_DealerID as DealerID,B.DealerName
               as DealerName,C.StatusName as OrderStatus ,D.Name as FullName from tbl_trans_ordermaster A,tbl_master_dealerinformation B ,tbl_status C,tbl_master_userinformation D  
               where A.FK_DealerID=B.PK_DealerID   and OrderDate>='".$startDate."' and OrderDate<='".$endDate."'  and A.FK_StatusID=C.PK_StatusID and  A.FK_CreatedBy=D.PK_UserID ";
			   
			   if($orderstatus!=0)$sql.=" and A.FK_StatusID=".$orderstatus." ";
			   if($userid!=0)$sql.=" and A.FK_CreatedBy=".$userid." ";			 
			   if($dealerid!=0)$sql.=" and A.FK_DealerID=".$dealerid;
			   
			   $sql.="  order by A.OrderDate desc,B.DealerName asc";
			  //echo "sql=".$sql;
			   
			   $query3 = $this->db->query($sql);
			   
			   $i=0;
		       $orderlistArray=array();
			   
		       foreach ($query3->result() as $row3)
             {
			 
				$OrderID=$row3->OrderID;
				$OrderNo=$row3->OrderNo;
				$OrderDate=$row3->OrderDate;
				$DealerID=$row3->DealerID;
				$DealerName=$row3->DealerName;
				$OrderStatus=$row3->OrderStatus;				
				$FullName=$row3->FullName;
				
				$sql1="SELECT `FK_OrderID` as OrderID,count(`OrderQTY`) as Quantity FROM `tbl_trans_orderdetails` WHERE FK_OrderID=".$OrderID." group by FK_OrderID";
				$query4 = $this->db->query($sql1);
				$row1=$query4->row();
				$Quantity=$row1->Quantity;	
				$file = fopen("test.txt","a");
                echo fwrite($file,"isset=".$row1 );
                fclose($file);
				
				$sql2="select A.ProductName,B.CategoryName,C.OrderQTY,C.ApprovedQTY   from tbl_master_productcategory B,tbl_master_productitem A,tbl_trans_orderdetails C where C.FK_OrderID=".$OrderID." and C.FK_ProductID=A.PK_ProductID and C.FK_CategoryID=B.PK_CategoryID order by A.ProductName asc";
				//echo $sql2;
				$query5 = $this->db->query($sql2);
				$j=0;
				$orderlistDetailsArray=array();
				foreach ($query5->result() as $row5)
                {
					//if($row5->OrderQTY==0)continue;
					$orderlistDetailsArray[$j]["ProductName"]=$row5->ProductName;
					$orderlistDetailsArray[$j]["CategoryName"]=$row5->CategoryName;
					$orderlistDetailsArray[$j]["OrderQTY"]=$row5->OrderQTY;
					$orderlistDetailsArray[$j]["ApprovedQTY"]=$row5->ApprovedQTY;
					$j++;
					
			    }
				
				
				$orderlistArray[$i]["OrderID"]=$OrderID;
				$orderlistArray[$i]["OrderNo"]=$OrderNo;
				$orderlistArray[$i]["OrderDate"]=$OrderDate;
				$orderlistArray[$i]["DealerID"]=$DealerID;
				$orderlistArray[$i]["DealerName"]=$DealerName;
				$orderlistArray[$i]["OrderStatus"]=$OrderStatus;
				$orderlistArray[$i]["Quantity"]=$Quantity;
				$orderlistArray[$i]["FullName"]=$FullName;
				$orderlistArray[$i]["detaillist"]=$orderlistDetailsArray;
				$i++;
				
			 }
			 $json = array();
			 $jsonarray = array(
        
		'orderlist'=>$orderlistArray 
        
          );
		   
		   array_push($json, $jsonarray);   
           $jsonstring = json_encode($json);
           echo $jsonstring;
           die();
		  
           
			   
			   
			  
			}
		
		
	}
	
	public function getGrnList()
	{
		$postdata = file_get_contents("php://input");
		
		if (isset($postdata))
			{
			
		       $request = json_decode($postdata);
			   $userid=$request->userid;
			   $dealerid=$request->dealerid;
			   $startDate=$request->startDate;			   
			   $endDate=$request->endDate;
			   $grnstatus=$request->grnstatus;
			   $usergroupid=$request->usergroupid;
			   
			   
			   $startDate=$startDate." "."00:00:00";
			   $endDate=$endDate." "."23:59:59";
			  
				  
				  
				  $sql="select A.PK_grnID as grnID,A.grnNo as grnNo,A.grnDate as grnDate,A.FK_DealerID as DealerID,B.DealerName
               as DealerName,C.StatusName as grnStatus ,0 as Quantity,D.Name as FullName from tbl_trans_grnmaster A,tbl_master_dealerinformation B ,tbl_Status C ,tbl_master_userinformation D 
                where A.FK_DealerID=B.PK_DealerID    and A.grnDate>='".$startDate."' and A.grnDate<='".$endDate."' and A.FK_StatusID=C.PK_StatusID  and  A.FK_CreatedBy=D.PK_UserID ";
				if($grnstatus!=0)$sql.=" and A.FK_StatusID=".$grnstatus." ";
				if($userid!=0)$sql.=" and A.FK_CreatedBy=".$userid." ";
				if($dealerid!=0)$sql.=" and A.FK_DealerID=".$dealerid." "; 
				
				 $sql.="  order by A.grnDate desc,B.DealerName asc";
			//echo $sql;
			   
			   $query3 = $this->db->query($sql);
			   
			   $i=0;
		       $grnlistArray=array();
			   //$grnlistDetailsArray=array();
		       foreach ($query3->result() as $row3)
             {
			 
				$grnID=$row3->grnID;
				$grnNo=$row3->grnNo;
				$grnDate=$row3->grnDate;
				$DealerID=$row3->DealerID;
				$DealerName=$row3->DealerName;
				$grnStatus=$row3->grnStatus;
				$Quantity=$row3->Quantity;
				$FullName=$row3->FullName;
				
				$sql1="SELECT `FK_grnID` as grnID,sum(`grnQTY`) as Quantity FROM `tbl_trans_grndetails` WHERE FK_grnID=".$grnID." group by FK_grnID";
				//echo $sql1;
				$query4 = $this->db->query($sql1);
				$row1=$query4->row();
				$Quantity=$row1->Quantity;	
				
				
				$sql2="select A.ProductName,B.CategoryName,C.grnQTY,C.Feedback,C.Defect   from tbl_master_productcategory B,tbl_master_productitem A,tbl_trans_grndetails C where C.FK_grnID=".$grnID." and C.FK_ProductID=A.PK_ProductID and C.FK_CategoryID=B.PK_CategoryID";
				//echo $sql2;
				$query5 = $this->db->query($sql2);
				$j=0;
				$grnlistDetailsArray=array();
				foreach ($query5->result() as $row5)
                {
					$grnlistDetailsArray[$j]["ProductName"]=$row5->ProductName;
					$grnlistDetailsArray[$j]["CategoryName"]=$row5->CategoryName;
					$grnlistDetailsArray[$j]["grnQTY"]=$row5->grnQTY;
					$grnlistDetailsArray[$j]["Feedback"]=$row5->Feedback;
					$grnlistDetailsArray[$j]["Defect"]=$row5->Defect;
					$j++;
					
			    }
				
				
				
				$grnlistArray[$i]["grnID"]=$grnID;
				$grnlistArray[$i]["grnNo"]=$grnNo;
				$grnlistArray[$i]["grnDate"]=$grnDate;
				$grnlistArray[$i]["DealerID"]=$DealerID;
				$grnlistArray[$i]["DealerName"]=$DealerName;
				$grnlistArray[$i]["grnStatus"]=$grnStatus;
				$grnlistArray[$i]["Quantity"]=$Quantity;
				$grnlistArray[$i]["FullName"]=$FullName;
				$grnlistArray[$i]["detaillist"]=$grnlistDetailsArray;
				
				$i++;
				
			 }
			 $json = array();
			 $jsonarray = array(
        
		'grnlist'=>$grnlistArray 
        
          );
		   
		   array_push($json, $jsonarray);   
           $jsonstring = json_encode($json);
           echo $jsonstring;
           die();
		  
           
			   
			   
			  
			}
		
		
	}
	
	
	
	
	
	public function saveOrderDetails()
	{
	
       	   
	    $this->load->model('JbCommon');
		$postdata = file_get_contents("php://input");
		
		if (isset($postdata))
			{
			
		      $request = json_decode($postdata);
			  
			  date_default_timezone_set("Asia/Kolkata");
			  			  
              $now = new DateTime();
              $date1= $now->format('Y-m-d');
			  
			  $createdby=$request->createdby;
			  $created_date=date('Y-m-d H:i:s');
			  
			  $isactive=1;
			  $financialid=1;
			  $deviceid="Computer";
			  
			  
			  
			  if(isset($request->DeviceID))$deviceid=$request->DeviceID;
			 
			  $dealerid=$request->dealerid;
			  $locationid=$request->locationid;
			  
			  $sql1="SELECT `Location_name` as location FROM `tbl_master_location` WHERE PK_LocationID=".$locationid;	
			  $query4 = $this->db->query($sql1);
			  $row1=$query4->row();
			  $location=$row1->location;			  
			  $location=$location;
			  
			  
			  $companyid=$request->companyid;
			  $order_date=$date1;
			  $orderstatus=1;
			  $status_tbl_query=$this->db->query("select PK_StatusID from tbl_status where StatusDefault=1 and StatusType='Order'");
			  $status_tbl_row=$status_tbl_query->row();
			  $statusid=$status_tbl_row->PK_StatusID;
			  $orderstatus=$statusid;
			  
			  $financial_tbl_query=$this->db->query("select PK_FinancialID,YearCode from tbl_Master_FinancialYear where IsActive=1");
			  $financial_tbl_row=$financial_tbl_query->row();
			  $financialid=$financial_tbl_row->PK_FinancialID;
			  $financial_year_code=$financial_tbl_row->YearCode;
			  
			  $order_no="";
			  
			  
			  
			  $data1=array(
			        'FK_CreatedBy' => $createdby,
					'CreatedDate' => date('Y-m-d H:i:s'),
					'IsActive' => $isactive,
					'FK_FinancialID' => $financialid,
					'FK_LocationID' => $locationid,
					'FK_CompanyID' => $companyid,
					'DeviceID' => $deviceid,
					'Location' => $location,
					'FK_DealerID' => $dealerid,
					'OrderNo' => $order_no,
					'OrderDate' => date('Y-m-d H:i:s'),
					'FK_StatusID' => $orderstatus
			   
			  
			          );
			  
			  $this->JbCommon->form_insert($data1,"tbl_trans_ordermaster");
			  
			   $this->db->select_max('PK_OrderID');
               $result = $this->db->get('tbl_trans_ordermaster')->row();  
               $orderid=$result->PK_OrderID;
			   $order_no="".$financial_year_code."/ORD/".$orderid;
			   
			   $this->db->set('OrderNo',$order_no);
			   $this->db->where('PK_OrderID',$orderid);
			   $this->db->update('tbl_trans_ordermaster');
			   
			   
			   
			   
			   $orderitems= $request->orderitem;
			   foreach($orderitems as $orderitem)
			   
			         {
						 
						
						$orderitem=(array)$orderitem;
						
               if($orderitem["quantity"]<=0)continue;
			 $data1 = array(
			  'FK_CreatedBy' => $createdby,
			  'CreatedDate' => date('Y-m-d H:i:s'),
			  'IsActive' => 1,
			  'FK_OrderID' => $orderid,
			  'FK_CategoryID'=>$orderitem["categoryId"],//$categoryid,
			  'FK_ProductID'=>$orderitem["productid"],
			  'AvlQTY'=>$orderitem["availablequantity"],
			  'OrderQTY'=>$orderitem["quantity"],
			  'ApprovedQTY'=>$orderitem["quantity"]
			  );
			  
			  $this->JbCommon->form_insert($data1,"tbl_trans_orderdetails");
    
                     }
			  
			  }
			           $json = array(); 
			           $jsonarray = array(
                             'status' => 1,
							 'order_no'=>$order_no
                                     
                                  );
		               array_push($json, $jsonarray); 
					   $jsonstring = json_encode($json);
                       echo $jsonstring;
                       die();
		
		
	}
	
	
	public function saveGrnDetails()
	{
	
       	   
	    $this->load->model('JbCommon');
		$postdata = file_get_contents("php://input");
		
		if (isset($postdata))
			{
			
		      $request = json_decode($postdata);
			  date_default_timezone_set("Asia/Kolkata");
              $now = new DateTime();
              $date1= $now->format('Y-m-d');
			//  echo var_dump($request);
			  
			  $createdby=$request->createdby;
			  $created_date=date('Y-m-d H:i:s');
			  $isactive=1;
			  $financialid=1;
			  $deviceid="Computer";
			  if(isset($request->DeviceID))$deviceid=$request->DeviceID;
			  $location=$request->location;
			  $dealerid=$request->dealerid;
			  $grnNo=$request->grnNo;
			  $InvoiceNo=$request->InvoiceNo;			 
			  $order_date=$date1;
			  $status_tbl_query=$this->db->query("select PK_StatusID from tbl_status where StatusDefault=1 and StatusType='Grn'");
			  $status_tbl_row=$status_tbl_query->row();
			  $statusid=$status_tbl_row->PK_StatusID;
			  $grnstatus=$statusid;			  
			  $financial_tbl_query=$this->db->query("select PK_FinancialID,YearCode from tbl_Master_FinancialYear where IsActive=1");
			  $financial_tbl_row=$financial_tbl_query->row();
			  $financialid=$financial_tbl_row->PK_FinancialID;
			  $financial_year_code=$financial_tbl_row->YearCode;
			  
			  $data1=array(
			        'FK_CreatedBy' => $createdby,
					'CreatedDate' => date('Y-m-d H:i:s'),
					'IsActive' => $isactive,
					'FK_FinancialID' => $financialid,
					'DeviceID' => $deviceid,
					'Location' => $location,
					'FK_DealerID' => $dealerid,					
					'grnDate' => date('Y-m-d H:i:s'),
					'FK_StatusID' => $grnstatus,
					'grnNo'=>$grnNo,
					'InvoiceNo'=>$InvoiceNo
			   
			  
			          );
			  
			  $this->JbCommon->form_insert($data1,"tbl_trans_grnmaster");
			  
			   $this->db->select_max('PK_grnID');
               $result = $this->db->get('tbl_trans_grnmaster')->row();  
               $grnid=$result->PK_grnID;			   
			   $grnNo="".$financial_year_code."/GRN/".$grnid;			   
			   $this->db->set('grnNo',$grnNo);
			   $this->db->where('PK_grnID',$grnid);
			   $this->db->update('tbl_trans_grnmaster');  
			   
			   $grnitems= $request->grnlist;
			   //echo var_dump($request);
			 // echo var_dump($orderitems);
			   foreach($grnitems as $grnitem)
			   
			         {
						 
						//$createdby=;
						$grnitem=(array)$grnitem;
               if($grnitem["quantity"]<=0)continue;
			  $data1 = array(
			  'FK_CreatedBy' => $createdby,
			  'CreatedDate' => date('Y-m-d H:i:s'),
			  'IsActive' => 1,
			  'FK_grnID' => $grnid,
			  'FK_CategoryID'=>$grnitem["categoryId"],
			  
			  'grnQTY'=>$grnitem["quantity"],
			  'Feedback'=>$grnitem["feedback"],
			  'FK_ProductID'=>$grnitem["productid"],
			  'Defect'=>$grnitem["defect"]
			  
			  );
			  
			  $this->JbCommon->form_insert($data1,"tbl_trans_grndetails");
    
                     }
					 
			  
			  
			  
              
				
			
		
		

			
			
			
			
			  
			}
			           $json = array(); 
			           $jsonarray = array(
                             'status' => 1,
							 'grnNo'=>$grnNo
                                     
                                  );
		               array_push($json, $jsonarray); 
					   $jsonstring = json_encode($json);
                       echo $jsonstring;
                       die();
		
		
	}
	
	
	
	
	public function getOrderCategoryDropdownList()
	{
		 $json = array(); 
		 $postdata = file_get_contents("php://input");
		 if (isset($postdata))
			{
		      $request = json_decode($postdata);
			  $brandname=$request->assignedBrandID;
			}
		 
		  $query=$this->db->query("SELECT PK_CategoryID,CategoryName FROM `tbl_master_productcategory` where FK_ParentCategoryID in
		  ( SELECT PK_CategoryID FROM `tbl_master_productcategory` where PK_CategoryID in (".$brandname.") and IsActive=1 order by CategoryName)");
		 // // $query=$this->db->query("SELECT PK_CategoryID,CategoryName FROM `tbl_master_productcategory` where PK_CategoryID in
		 // // (".$brandname.") and IsActive=1 order by CategoryName");
		 
		 if($query -> num_rows() >= 1)
          {
		     foreach ($query->result() as $row)
             {
			 
				$categoryid=$row->PK_CategoryID;
			    $categoryname=$row->CategoryName;
			    $jsonarray = array(
                             'categoryid' => $categoryid,
                             'categoryname' => $categoryname,    
							                                  );
		        array_push($json, $jsonarray);  
			 }
		 }
		 
		 $jsonstring = json_encode($json);
         echo $jsonstring;
         die();
		

		
		
	}
	
	public function getGrnCategoryDropdownList()
	{
		 $json = array(); 
		 $postdata = file_get_contents("php://input");
		 if (isset($postdata))
			{
		      $request = json_decode($postdata);
			  $brandname=$request->assignedBrandID;
			}
		 
		 $query=$this->db->query("SELECT PK_CategoryID,CategoryName FROM `tbl_master_productcategory` where FK_ParentCategoryID in
		  ( SELECT PK_CategoryID FROM `tbl_master_productcategory` where PK_CategoryID in (".$brandname.") and IsActive=1 order by CategoryName)");
		 if($query -> num_rows() >= 1)
          {
		     foreach ($query->result() as $row)
             {
			 
				$categoryid=$row->PK_CategoryID;
			    $categoryname=$row->CategoryName;
			    $jsonarray = array(
                             'categoryid' => $categoryid,
                             'categoryname' => $categoryname,        
                                  );
		        array_push($json, $jsonarray);  
			 }
		 }
		 
		 $jsonstring = json_encode($json);
         echo $jsonstring;
         die();
		

		
		
	}
	
	
	public function getOrderSubCategoryDropdownList()
	{
		
		
		
		  
		 $postdata = file_get_contents("php://input");
		 $status=0;
		 if (isset($postdata))
			{
		      $request = json_decode($postdata);
			//  $brandid=$request->brandid;
			  $parentcategoryid=$request->parentcategoryid;
			}
		 
		 $this -> db -> select('PK_CategoryID,CategoryName');	
		 $this -> db -> from('tbl_master_productcategory');
        // $this -> db -> where('FK_BrandID', $brandid);
		 $this -> db -> where('FK_ParentCategoryID', $parentcategoryid);
		 $this -> db -> where('IsActive', 1);
		 $this->db->order_by('CategoryName', 'asc');
         $query = $this -> db -> get();
		  $json = array();
		 if($query -> num_rows() >= 1)
          {
		    $status=1;
			 foreach ($query->result() as $row)
             {
			 
				$categoryid=$row->PK_CategoryID;
			    $categoryname=$row->CategoryName;
			    $jsonarray = array(
                             'categoryid' => $categoryid,
                             'categoryname' => $categoryname,        
                                  );
		        array_push($json, $jsonarray);  
			 }
			 
			 
		 }
		 else
		 {
			 
			 
			 $this -> db -> select('PK_ProductID,ProductName,AvailableQuantity,FK_CategoryID');	
		     $this -> db -> from('tbl_master_productitem');
             $this -> db -> where('FK_CategoryID', $parentcategoryid);
		     $this -> db -> where('IsActive', 1);
			// $this -> db -> where('AvailableQuantity >', 0);
			  $this->db->order_by('ProductName', 'asc');
             $query = $this -> db -> get();
			 if($query -> num_rows() >= 1)
             {
				$status=2; 
				foreach ($query->result() as $row)
                 {
			 
				$productid=$row->PK_ProductID;
			    $productname=$row->ProductName;
				$availablequantity=$row->AvailableQuantity;
				$categoryId=$row->FK_CategoryID;
				$query=$this->db->query("select CategoryName from tbl_master_productcategory where PK_CategoryID=".$categoryId);
                $row=$query->row();
				$categoryname=$row->CategoryName;
			    $jsonarray = array(
                             'productid' => $productid,
                             'productname' => $productname, 
                             'quantity' =>0	,
							  
                             'availablequantity'=>$availablequantity ,
                              'categoryId'=>$categoryId		,
                               'categoryname'=>	$categoryname						  
                                  );
		        array_push($json, $jsonarray);  
			     }
				 
			 }
			 
			 
			 
		 }
		    
		    $myObj["status"] = $status;
			$myObj["lastCategoryID"]=$parentcategoryid;
            $myObj["productarray"] = $json;
            $jsonstring = json_encode($myObj);			 
            echo $jsonstring;
            die();

		
	}
	
	
	
	
	
	public function getGrnSubCategoryDropdownList()
	{
		
		
		
		  
		 $postdata = file_get_contents("php://input");
		 $status=0;
		 if (isset($postdata))
			{
		      $request = json_decode($postdata);
			//  $brandid=$request->brandid;
			  $parentcategoryid=$request->parentcategoryid;
			}
		 
		 $this -> db -> select('PK_CategoryID,CategoryName');	
		 $this -> db -> from('tbl_master_productcategory');
         //$this -> db -> where('FK_BrandID', $brandid);
		 $this -> db -> where('FK_ParentCategoryID', $parentcategoryid);
		 $this -> db -> where('IsActive', 1);
		 
		 $this->db->order_by('CategoryName', 'asc');
         $query = $this -> db -> get();
		  $json = array();
		 if($query -> num_rows() >= 1)
          {
		    $status=1;
			 foreach ($query->result() as $row)
             {
			 
				$categoryid=$row->PK_CategoryID;
			    $categoryname=$row->CategoryName;
			    $jsonarray = array(
                             'categoryid' => $categoryid,
                             'categoryname' => $categoryname,        
                                  );
		        array_push($json, $jsonarray);  
			 }
			 
			 
		 }
		 else
		 {
			 
			 
			 $this -> db -> select('PK_ProductID,ProductName,AvailableQuantity,FK_CategoryID');	
		     $this -> db -> from('tbl_master_productitem');
             $this -> db -> where('FK_CategoryID', $parentcategoryid);
		     $this -> db -> where('IsActive', 1);
			// $this -> db -> where('AvailableQuantity >', 0);
			 $this->db->order_by('ProductName', 'asc');
             $query = $this -> db -> get();
			 if($query -> num_rows() >= 1)
             {
				$status=2; 
				foreach ($query->result() as $row)
                 {
			 
				$productid=$row->PK_ProductID;
			    $productname=$row->ProductName;
				$availablequantity=$row->AvailableQuantity;
				$categoryId=$row->FK_CategoryID;
			    $query=$this->db->query("select CategoryName from tbl_master_productcategory where PK_CategoryID=".$categoryId);
                $row=$query->row();
				$categoryname=$row->CategoryName;
			    $jsonarray = array(
                             'productid' => $productid,
                             'productname' => $productname, 
                             'quantity' =>0	,
							  'defect'=>false,
                             'availablequantity'=>$availablequantity ,
                              'categoryId'=>$categoryId		,
                               'categoryname'=>	$categoryname						  
                                  );
		        array_push($json, $jsonarray);  
			     }
				 
			 }
			 
			 
			 
		 }
		    
		    $myObj["status"] = $status;
			$myObj["lastCategoryID"]=$parentcategoryid;
            $myObj["productarray"] = $json;
            $jsonstring = json_encode($myObj);			 
            echo $jsonstring;
            die();

		
	}
	
	
	
	public function getItemList($categoryId)
	{
		
		
	}
	public function saveOrderStatus()
	{
		$ordernumber=$this->input->post('ordernumber');
		$statusid=$this->input->post('statusid');
		$sql="update tbl_trans_ordermaster set FK_StatusID=".$statusid." where OrderNo='".$ordernumber."'";
		$this->db->query($sql);
		echo "updated ordernumber=".$ordernumber." statusid=".$statusid;
		
	}
	public function saveOrderedItems()
	{
		$orderdetailid=$this->input->post('orderdetailid');
		$approvedquantity=$this->input->post('approvedquantity');
		$sql="update tbl_trans_orderdetails set ApprovedQTY=".$approvedquantity." where PK_OrderDetailsID=".$orderdetailid;
		$this->db->query($sql);
		echo "updated orderdetailid=".$orderdetailid." approved quantity=".$approvedquantity;
		
	}
	public function getOrderedItems()
	{
		
	 $orderid=$this->input->post('orderid');
	 
	 $sql="select cwProductName from tbl_master_dealerinformation where PK_DealerID in( select FK_DealerID from tbl_trans_ordermaster where PK_OrderID=".$orderid.")";
	 $query=$this->db->query($sql);
	 $row=$query->row();
	 $brandname=$row->cwProductName;
	 $json=array();
	 $this -> db -> select('PK_OrderDetailsID,FK_ProductID,OrderQTY,ApprovedQTY');	
     $this -> db -> from('tbl_trans_orderdetails');
     $this -> db -> where('FK_OrderID', $orderid);
	 $query = $this -> db -> get();
	 foreach ($query->result() as $row)
      {
		  $productid=$row->FK_ProductID;
		  $orderedquantity=$row->OrderQTY;
		  $approvedquantity=$row->ApprovedQTY;
		  $orderdetailid=$row->PK_OrderDetailsID;
		  
	 $this -> db -> select('ProductName,FK_CategoryID,CategoryName');	
     $this -> db -> from('tbl_master_productitem');
     $this -> db -> where('PK_ProductID', $productid);
	 $query1 = $this -> db -> get();
	 $row1=$query1->row();
	 
	 
		        //$productid=$row->PK_ProductID;
			    $productname=$row1->ProductName;
				$orderedquantity=$row->OrderQTY;
				$categoryId=$row1->FK_CategoryID;
				$categoryname=$row1->CategoryName; 
			    $query2=$this->db->query("select FK_ParentCategoryID from tbl_master_productcategory where PK_CategoryID=".$categoryId);
                $row2=$query2->row();
					
				$parentcategoryid=$row2->FK_ParentCategoryID;
				$query3=$this->db->query("select CategoryName from tbl_master_productcategory where PK_CategoryID=".$parentcategoryid);
                $row3=$query3->row();
				
				$parentcategoryname=$row3->CategoryName;
				
				$jsonarray = array(
                             'orderdetailid'=>$orderdetailid,
                             'productname' => $productname, 							 
                             'orderedquantity'=>$orderedquantity ,
							 'approvedquantity'=>$approvedquantity ,
                             'categoryname'=>$categoryname		,
                             'parentcategoryname'=>	$parentcategoryname	,
                             'brandname'=>$brandname
                                  );
		        array_push($json, $jsonarray); 
				
	  }
	  
	        $myObj["productarray"] = $json;
            $jsonstring = json_encode($myObj);			 
            echo $jsonstring;
            die();
			 
			 
	 
	 
		
	}
	
	
}

?>