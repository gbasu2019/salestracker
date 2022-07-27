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

class Login extends CI_Controller {

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
	  // echo $this->encryption->encrypt("123456");		
           $data["status"]="";
		
		$this->load->view('login',$data);
	}
	public function dashboard()
	{   
	    $this->load->library('session');
		$data=$this->session->all_userdata();
	    $enddate=date('Y-m-d H:i:s');
	    $startdate=$date = date("Y-m-d H:i:s", strtotime(" -1 months"));        
		$sql = "select count(PK_OrderID) as ordercount from tbl_trans_ordermaster where OrderDate>='".$startdate."' and OrderDate<='".$enddate."'";
        $query = $this->db->query($sql);		
		$row = $query->row();
		$monthlycount = $row->ordercount;
		$data["monthlycount"]=$monthlycount;
		$this->load->view('dashboard',$data);
	}
	
	public function check_login()//web app
	{
         $this->load->library('session');
		 $this -> db -> select('UserID,Name,Password');	
		 $userid=$this->input->post('userid');
         $password=$this->input->post('password');
         $username1="";
         $status=0;
         $password1="";
         $this -> db -> select('UserID,Name,Password');	
		 $this -> db -> from('tbl_master_userinformation');
         $this -> db -> where('UserID', $userid);
		 $this -> db -> where('IsActive', 1);
		 $this -> db -> where('FK_UserGroupId!=', 2);
		 $this -> db -> limit(1); 
         $query = $this -> db -> get();
		 if($query -> num_rows() == 1)
          {
		        $row = $query->row();
		        $password1=$this->encryption->decrypt($row->Password);	
		      //  $password1=$this->encryption->encrypt($password);
		      //  echo $password1;	 
		        if($password1==$password)
		         {
			        $row = $query->row();
                    $userid=$row->UserID;  
		            $status=1;
			        $username1=$row->Name;
					$this->session->set_userdata('username', $username1);
			     }
		  }	
          
          $msg="";
		  if($status==0) 
		  {
           
			$data["status"]="error-login";
			//echo "password=".$password1."-".$password;
            $this->load->view('login',$data);
		  }  

		 
		  

		  if($status==1)
		  {
            $data["username"]=$username1;
			
			 
			
			$enddate=date('Y-m-d H:i:s');
			$startdate=$date = date("Y-m-d H:i:s", strtotime(" -1 months")); 

            /*Order Count*/
			
			$sql = "select count(PK_OrderID) as monthlyordercount from tbl_trans_ordermaster where OrderDate>='".$startdate."' and OrderDate<='".$enddate."'";
			$query = $this->db->query($sql);		
			$row = $query->row();
			$monthlyordercount = $row->monthlyordercount;
			$data["monthlyordercount"]=$monthlyordercount;
			
			$sql1 = "select count(PK_OrderID) as todayordercount from tbl_trans_ordermaster where OrderDate='".$enddate."'";
			$query1 = $this->db->query($sql1);		
			$row1 = $query1->row();
			$todayordercount = $row1->todayordercount;
			$data["todayordercount"]=$todayordercount;
			
			
			$sql2 = "select count(PK_OrderID) as approvedordercount from tbl_trans_ordermaster where FK_StatusID='2' and OrderDate>='".$startdate."' and OrderDate<='".$enddate."'";
			$query2 = $this->db->query($sql2);		
			$row2 = $query2->row();
			$approvedordercount = $row2->approvedordercount;
			$data["approvedordercount"]=$approvedordercount;
			
			$sql3 = "select count(PK_OrderID) as pendingordercount from tbl_trans_ordermaster where FK_StatusID='1' and OrderDate>='".$startdate."' and OrderDate<='".$enddate."'";
			$query3 = $this->db->query($sql3);		
			$row3 = $query3->row();
			$pendingordercount = $row3->pendingordercount;
			$data["pendingordercount"]=$pendingordercount;
			
			/*Grn Count*/
			
			$sqlgrn = "select count(PK_grnID) as monthlygrncount from tbl_trans_grnmaster where grnDate>='".$startdate."' and grnDate<='".$enddate."'";
			$querygrn = $this->db->query($sqlgrn);		
			$rowgrn = $querygrn->row();
			$monthlygrncount = $rowgrn->monthlygrncount;
			$data["monthlygrncount"]=$monthlygrncount;
			
			$sqlgrn1 = "select count(PK_grnID) as todaygrncount from tbl_trans_grnmaster where grnDate='".$enddate."'";
			$querygrn1 = $this->db->query($sqlgrn1);		
			$rowgrn1 = $querygrn1->row();
			$todaygrncount = $rowgrn1->todaygrncount;
			$data["todaygrncount"]=$todaygrncount;
			
			
			$sqlgrn2 = "select count(PK_grnID) as approvedgrncount from tbl_trans_grnmaster where FK_StatusID='5' and grnDate>='".$startdate."' and grnDate<='".$enddate."'";
			$querygrn2 = $this->db->query($sqlgrn2);		
			$rowgrn2 = $querygrn2->row();
			$approvedgrncount = $rowgrn2->approvedgrncount;
			$data["approvedgrncount"]=$approvedgrncount;
			
			$sqlgrn3 = "select count(PK_grnID) as pendinggrncount from tbl_trans_grnmaster where  grnDate>='".$startdate."' and grnDate<='".$enddate."' and FK_StatusID='4'";
			$querygrn3 = $this->db->query($sqlgrn3);		
			$rowgrn3 = $querygrn3->row();
			$pendinggrncount = $rowgrn3->pendinggrncount ;
			$data["pendinggrncount"]=$pendinggrncount ;
			
			
			/*Visit Count*/
			
			$sqlvisit = "select count(PK_VisitID) as monthlyvisitcount from tbl_trans_visitentry where VisitDate>='".$startdate."' and VisitDate<='".$enddate."'";
			$queryvisit = $this->db->query($sqlvisit);		
			$rowvisit = $queryvisit->row();
			$monthlyvisitcount = $rowvisit->monthlyvisitcount;
			$data["monthlyvisitcount"]=$monthlyvisitcount;
			
			$sqlvisit1 = "select count(PK_VisitID) as todaygrncount from tbl_trans_visitentry where VisitDate='".$enddate."'";
			$queryvisit1 = $this->db->query($sqlvisit1);		
			$rowvisit1 = $queryvisit1->row();
			$todayvisitcount = $rowvisit1->todaygrncount;
			$data["todayvisitcount"]=$todayvisitcount;
			
			
			$sqlvisit2 = "select count(PK_VisitID) as approvedvisitcount from tbl_trans_visitentry where VisitStatus='Approved' and VisitDate>='".$startdate."' and VisitDate<='".$enddate."'";
			$queryvisit2 = $this->db->query($sqlvisit2);		
			$rowvisit2 = $queryvisit2->row();
			$approvedvisitcount = $rowvisit2->approvedvisitcount;
			$data["approvedvisitcount"]=$approvedvisitcount;
			
			$sqlvisit3 = "select count(PK_VisitID) as pendingvisitcount from tbl_trans_visitentry where  VisitDate>='".$startdate."' and VisitDate<='".$enddate."' and VisitStatus='Pending'";
			$queryvisit3 = $this->db->query($sqlvisit3);		
			$rowvisit3 = $queryvisit3->row();
			$pendingvisitcount = $rowvisit3->pendingvisitcount ;
			$data["pendingvisitcount"]=$pendingvisitcount ;
			
			
			
			
			/*Collection Count*/
			
			$sqlcollection = "select sum(amount) as monthlycollection from tbl_trans_dealercollection where CreatedDate>='".$startdate."' and CreatedDate<='".$enddate."'";
			$querycollection = $this->db->query($sqlcollection);		
			$rowcollection = $querycollection->row();
			$monthlycollection = $rowcollection->monthlycollection;
			$data["monthlycollection"]=$monthlycollection;
			
			
			
			
			$sqlcollection2 = "select sum(amount) as cashcollectioncount from tbl_trans_dealercollection where Collection_type='Cash' and CreatedDate>='".$startdate."' and CreatedDate<='".$enddate."'";
			$querycollection2 = $this->db->query($sqlcollection2);		
			$rowcollection2 = $querycollection2->row();
			$cashcollectioncount = $rowcollection2->cashcollectioncount;
			$data["cashcollectioncount"]=$cashcollectioncount;
			
			$sqlcollection3 = "select sum(amount) as bankcollectioncount from tbl_trans_dealercollection where  CreatedDate>='".$startdate."' and CreatedDate<='".$enddate."' and Collection_type='Bank'";
			$querycollection3 = $this->db->query($sqlcollection3);		
			$rowcollection3 = $querycollection3->row();
			$bankcollectioncount = $rowcollection3->bankcollectioncount ;
			$data["bankcollectioncount"]=$bankcollectioncount ;
			
			
			
			
			
			
			
			
			
            $this->load->view('dashboard',$data);
			
			/* $newdata = array(
              'userid'  => $userid,
              'username'  => $username1,
        
                            );
            $this->session->set_userdata($newdata); */

		  }

     


     
	}
	
	public function logout()
	{
		$data["status"]="";
		//$this->session->sess_destroy();
		//$this->load->view('login',$data);
		
		$this->session->sess_destroy();
		redirect('', 'refresh');
		//header('Location: http://45.114.141.121:90/jb_app/');
		//redirect('http://45.114.141.121:90/jb_app/', 'refresh');
		
	}
	public function checklogin()//mobile-app
	{
		
		$username = "";
        $password = ""; 
		$deviceid="Computer";
		$usergroupid=0;
		$postdata = file_get_contents("php://input");
	    if (isset($postdata))
			{
		      $request = json_decode($postdata);
		      $username = $request->username;
		      $password = $request->password;
			  //$devid=$request->DeviceID;
			  if(isset($request->deviceID))$deviceid=$request->deviceID;
			  //if(isset($devid))$deviceid=$request->DeviceID;
	        }
			
			
		 $status=0;
		 $username1="";
		 $userid=$username;
		 
		 $json = array();
         $jsonarray = array(
        'status' => $status,
        'username' => $username1,
		'usergroupid'=>$usergroupid,
		'userid' => $userid,
        
          );
		  
		 $this -> db -> select('PK_UserID,UserID,Name,Password,IMEI_No,FK_UserGroupId,FK_LocationID,FK_CompanyID,FK_AssignedBrandID');	
		 $this -> db -> from('tbl_master_userinformation');
         $this -> db -> where('UserID', $username);
		 $this -> db -> where('IsActive', 1);
		 $this -> db -> limit(1); 
		 
         $query = $this -> db -> get();
		 if($query -> num_rows() == 1)
          {
		 $row = $query->row();
		 $password1=$this->encryption->decrypt($row->Password);
		 
		   /*  if($password1==$password)
		   { */ 		    
	        $row = $query->row();
			$imei_no=$row->IMEI_No; 
			$userid=$row->UserID; 
            $pkuserid=$row->PK_UserID;
			$usergroupid=$row->FK_UserGroupId;
            $username1=$row->Name;	
			$locationid=$row->FK_LocationID;
			$companyid=$row->FK_CompanyID;
			$assignedBrandID=$row->FK_AssignedBrandID;
            //$checkimei=empty($imei_no);
			if($deviceid!="Computer")
			{
				$checkimei=empty($imei_no);
				if($checkimei==1)
				{
				
				 $this->db->query("update tbl_master_userinformation set IMEI_No='".$deviceid."' where PK_UserID=".$pkuserid);
				 $status=1;
				}
				else
				{
					if($imei_no==$deviceid)
					{
						$status=1;
					}
					else
					{
						$status=2;
					}
					
				}
			}
			else
			{
				$checkimei=empty($imei_no);
				
				$status=1;
			}
			
            			
		   
		   $userArray=array();
		   if($usergroupid==1)
		   {
		   $sql="Select PK_UserID as userid,Name as fullname from tbl_master_userinformation Where FK_UserGroupId=2";

           $query = $this->db->query($sql);
		   $i=0;
		   foreach ($query->result() as $row)
             {
			 
				$userid=$row->userid;
				$fullname=$row->fullname;
				
				
				$userArray[$i]["userid"]=$userid;
				$userArray[$i]["fullname"]=$fullname;
				
				$i++;
				
			 }
			 
		   }
		   
		$this -> db -> select('CurrentVersion,MobileAppPath');
        $this -> db -> from('tbl_master_mobileappversion');
        $query = $this -> db -> get();
        $row = $query->row();
        $CurrentVersion=$row->CurrentVersion;
        $MobileAppPath=	$row->MobileAppPath;
		/* 
		$CurrentVersion=1;
        $MobileAppPath=	"http://45.114.141.121:90/jalan_app/apk_05.06.18/jbApp.apk"; */
		  
		  
		$jsonarray = array(
        'status' => $status,
        'username' => $username1,
		'userid' => $userid,
		'usergroupid'=>$usergroupid,
		'pkuserid'=>$pkuserid,		
		'users'=>$userArray,
		'deviceid'=>$deviceid,
        'locationid'=>$locationid,
		'companyid'=>$companyid,
		'assignedBrandID'=>$assignedBrandID,
		'MobileAppPath'=>$MobileAppPath,
		'CurrentVersion'=>$CurrentVersion
          );
		  
			 
		// }
		 
		  }
		 
		 array_push($json, $jsonarray);   
         $jsonstring = json_encode($json);
         echo $jsonstring;
         die();
		  
	}
	
	function getTotalOrder()
	{
		 $enddate=date('Y-m-d H:i:s');
		 $startdate=$date = date("Y-m-d H:i:s", strtotime(" -1 months")); 
		 $json = array();
		 $sql = "select count(PK_OrderID) as monthlyordercount from tbl_trans_ordermaster where OrderDate>='".$startdate."' and OrderDate<='".$enddate."'";
		 $query = $this->db->query($sql);		
		 $row = $query->row();
		 $monthlyordercount = $row->monthlyordercount;
         $jsonarray = array(        
        'ordercount' => $monthlyordercount
		 );
		  array_push($json, $jsonarray);   
         $jsonstring = json_encode($json);
         echo $jsonstring;
         die();
	}
	function getDealerVisit()
	{
		 $enddate=date('Y-m-d H:i:s');
		 $startdate=$date = date("Y-m-d H:i:s", strtotime(" -1 months")); 
		 $json = array();
		 $sqlvisit = "select count(PK_VisitID) as monthlyvisitcount from tbl_trans_visitentry where VisitDate>='".$startdate."' and VisitDate<='".$enddate."'";
		 $queryvisit = $this->db->query($sqlvisit);		
		 $rowvisit = $queryvisit->row();
		 $monthlyvisitcount = $rowvisit->monthlyvisitcount;
         $jsonarray = array(        
        'visitcount' => $monthlyvisitcount
		 );
		  array_push($json, $jsonarray);   
         $jsonstring = json_encode($json);
         echo $jsonstring;
         die();
		  
	}
	function getTotalGRN()
	{
		$enddate=date('Y-m-d H:i:s');
		 $startdate=$date = date("Y-m-d H:i:s", strtotime(" -1 months")); 
		 $json = array();
		 $sqlgrn = "select count(PK_grnID) as monthlygrncount from tbl_trans_grnmaster where grnDate>='".$startdate."' and grnDate<='".$enddate."'";
			$querygrn = $this->db->query($sqlgrn);		
			$rowgrn = $querygrn->row();
			$monthlygrncount = $rowgrn->monthlygrncount;
         $jsonarray = array(        
        'grncount' => $monthlygrncount
		 );
		  array_push($json, $jsonarray);   
         $jsonstring = json_encode($json);
         echo $jsonstring;
         die();
	}
	function getTodayCollection()
	{
		$enddate=date('Y-m-d H:i:s');
		 $startdate=$date = date("Y-m-d H:i:s", strtotime(" -1 months")); 
		 $json = array();
		    $sqlcollection = "select count(amount) as todaycollection from tbl_trans_dealercollection where CreatedDate='".$enddate."'";
			$querycollection = $this->db->query($sqlcollection);		
			$rowcollection = $querycollection->row();
			$todaycollection = $rowcollection->todaycollection?$rowcollection->todaycollection:0;
         $jsonarray = array(        
        'todaycollectioncount' => $todaycollection
		 );
		  array_push($json, $jsonarray);   
         $jsonstring = json_encode($json);
         echo $jsonstring;
         die();
	}	
	function getMonthlyCollections()
	{
		$enddate=date('Y-m-d H:i:s');
		 $startdate=$date = date("Y-m-d H:i:s", strtotime(" -1 months")); 
		 $json = array();
		 $sqlcollection = "select count(amount) as monthlycollection from tbl_trans_dealercollection where CreatedDate>='".$startdate."' and CreatedDate<='".$enddate."'";
			$querycollection = $this->db->query($sqlcollection);		
			$rowcollection = $querycollection->row();
			$monthlycollection = $rowcollection->monthlycollection?$rowcollection->monthlycollection:0;
         $jsonarray = array(        
        'monthlycollectioncount' => $monthlycollection
		 );
		  array_push($json, $jsonarray);   
         $jsonstring = json_encode($json);
         echo $jsonstring;
         die();
	}
	
	function getUserListItems()
	{
	    $UserID=$this->input->post('UserID');
		$UserID=isset($UserID)?$UserID:'';
		$data["UserID"]=$UserID;
		
		$Name=$this->input->post('Name');
		$Name=isset($Name)?$Name:'';
		$data["Name"]=$Name;
		
		
		$UserGroupId=$this->input->post('UserGroupId');
		$UserGroupId=isset($UserGroupId)?$UserGroupId:0;
		$data["UserGroupId"]=$UserGroupId;
		
		
		$LocationID=$this->input->post('LocationID');
		$LocationID=isset($LocationID)?$LocationID:0;
		$data["LocationID"]=$LocationID;
		
		$companyid=$this->input->post('companyid');
		$companyid=isset($companyid)?$companyid:0;
		$data["companyid"]=$companyid;
		
		$sql_usergroup="select PK_UserGroupID,UserGroup_name from tbl_master_usergroup where IsActive=1 and PK_UserGroupID!=1";
		$query_usergroup = $this->db->query($sql_usergroup);
		$data["usergroup_table"]=$query_usergroup ;
		
		$sql_location="select PK_LocationID,Location_name from tbl_master_location where IsActive=1";
		$query_location = $this->db->query($sql_location);
		$data["location_table"]=$query_location ;
		
		$sql_company="select distinct Company_name,PK_CompanyID from tbl_master_company where IsActive=1";
		$query_company = $this->db->query($sql_company);
		$data["company_table"]=$query_company ;
		
		$sql_dealer="select PK_DealerID,DealerName from tbl_master_dealerinformation where IsActive=1";
		$query_dealer = $this->db->query($sql_dealer);
		$data["dealer_table"]=$query_dealer ;
		
		
	
	 //$sql="SELECT A.*, GROUP_CONCAT(B.CategoryName) as CategoryName,C.Location_name as Location,D.UserGroup_name as Groupname FROM tbl_master_userinformation A, tbl_master_productcategory B,tbl_master_location C ,tbl_master_usergroup D WHERE FIND_IN_SET(B.PK_CategoryID, A.FK_AssignedBrandID)  and A.FK_LocationID=C.PK_LocationID and A.FK_UserGroupId=D.PK_UserGroupID"; 
	 $sql="SELECT A.*, C.Location_name as Location,D.UserGroup_name as Groupname FROM tbl_master_userinformation A, tbl_master_productcategory B,tbl_master_location C ,tbl_master_usergroup D WHERE A.FK_LocationID=C.PK_LocationID and A.FK_UserGroupId=D.PK_UserGroupID";
	
	// $sql="SELECT A.*,C.Location_name as Location,D.UserGroup_name as Groupname FROM tbl_master_userinformation A, tbl_master_productcategory B,tbl_master_location C ,tbl_master_usergroup D WHERE  A.FK_LocationID=C.PK_LocationID and A.FK_UserGroupId=D.PK_UserGroupID";
	 
	
	 	 
	/* $sql="SELECT A.*, GROUP_CONCAT(B.CategoryName) as CategoryName,C.Location_name as Location,D.UserGroup_name as Groupname FROM tbl_master_userinformation A, tbl_master_productcategory B,tbl_master_location C ,tbl_master_usergroup D WHERE FIND_IN_SET(B.PK_CategoryID, (select distinct FK_CategoryID from tbl_master_dealerinformation where  A.Name LIKE '%".$Name."%' ))  and A.FK_LocationID=C.PK_LocationID and A.FK_UserGroupId=D.PK_UserGroupID"; */
	 
	            if($UserID!='')$sql.=" and A.UserID='".$UserID."' ";
			    if($Name!='')$sql.=" and A.Name LIKE '%".$Name."%' ";			 
			    if($UserGroupId!=0)$sql.=" and A.FK_UserGroupId=".$UserGroupId." ";
				if($LocationID!=0)$sql.=" and A.FK_LocationID=".$LocationID." ";
				if($companyid!=0)$sql.=" and A.FK_CompanyID=".$companyid." ";
				$sql.=" GROUP BY A.PK_UserID ORDER BY A.PK_UserID ASC";
				//echo $sql;
				
				$query_user = $this->db->query($sql);
			    $data["userlist_table"]=$query_user;	
				
				
	 
	 $this->load->view('userlist',$data);
	}
	
	function getUsers()
	{

        $userid=$this->input->post('userid');	   
		//$sql="Select PK_CategoryID as CategoryID,CategoryName as CategoryName from tbl_master_productcategory WHERE `CategoryName` LIKE '%brand%'";
	
	
	
	
	 $json=array();
	
	
	 $this -> db -> select('UserID,Name,IMEI_No,FK_CompanyID');	
     $this -> db -> from('tbl_master_userinformation');
     $this -> db -> where('PK_UserID='.$userid);
	 $query1 = $this -> db -> get();
     $i=0;
	 $userArray=array();	
	   foreach ($query1->result() as $row1)
	   {
	   
	         $this -> db -> select('PK_CategoryID,CategoryName');	
			 $this -> db -> from('tbl_master_productcategory');
			 $this -> db -> where('`CategoryName` LIKE "%brand%" and FK_ParentCategoryID!=0 and FK_CompanyID='.$row1->FK_CompanyID);
			 $query = $this -> db -> get();
			 $j=0;
			 $dealerArray=array();
			 foreach ($query->result() as $row)
			  {
				   $CategoryID=$row->PK_CategoryID;
				   $CategoryName=$row->CategoryName;				   
					$filtered_words = array(
								'Brand'
								);

							$zap ='';

				   $filtered_brand = trim(str_replace($filtered_words,$zap,$CategoryName));
				   $dealerArray[$j]["CategoryID"]=$CategoryID;
				   $dealerArray[$j]["CategoryName"]=$filtered_brand;
				   $j++;
			   }
			   
			   
			   
			   $this -> db -> select('PK_CategoryID,CategoryName');	
			 $this -> db -> from('tbl_master_productcategory');
			 $this -> db -> where('FK_ParentCategoryID=0 and `CategoryName` NOT LIKE "%brand%"  and FK_CompanyID='.$row1->FK_CompanyID);
			 $query = $this -> db -> get();
			 
			 foreach ($query->result() as $row)
			  {
				   $CategoryID=$row->PK_CategoryID;
				   $CategoryName=$row->CategoryName;				   
					
				   $dealerArray[$j]["CategoryID"]=$CategoryID;
				   $dealerArray[$j]["CategoryName"]= $CategoryName;
				   $j++;
			   }
	   
	   
	   
	   
	    $userArray[$i]["UserID"]= $row1->UserID;
	    $userArray[$i]["Name"]= $row1->Name;
		$userArray[$i]["IMEI_No"]= $row1->IMEI_No;
		$userArray[$i]["dealerArray"]= $dealerArray;
		$i++;
	   }
	  
		  $json = array();
			 $jsonarray = array(
        
		'userlist'=>$userArray 
        
          );
		   
		   array_push($json, $jsonarray);   
           $jsonstring = json_encode($json);
           echo $jsonstring;
           die();  
		   
		   
	}
	function addUsers()
	{
	
	   
	         $this -> db -> select('PK_CategoryID,CategoryName');	
			 $this -> db -> from('tbl_master_productcategory');
			 $this -> db -> where('`CategoryName` LIKE "%brand%" and FK_ParentCategoryID!=0');
			 $query = $this -> db -> get();
			 $j=0;
			 $dealerArray=array();
			 foreach ($query->result() as $row)
			  {
				   $CategoryID=$row->PK_CategoryID;
				   $CategoryName=$row->CategoryName;				   
					$filtered_words = array(
								'Brand'
								);

							$zap ='';

				   $filtered_brand = trim(str_replace($filtered_words,$zap,$CategoryName));
				   $dealerArray[$j]["CategoryID"]=$CategoryID;
				   $dealerArray[$j]["CategoryName"]=$filtered_brand;
				   $j++;
			   }
			   
			   
			 $this -> db -> select('PK_LocationID,Location_name');	
			 $this -> db -> from('tbl_master_location');			 
			 $query1 = $this -> db -> get();
			 $k=0;
			 $locationArray=array();
			 foreach ($query1->result() as $row1)
			  {
				   $LocationID=$row1->PK_LocationID;
				   $Location_name=$row1->Location_name;				   
				
				   $locationArray[$k]["LocationID"]=$LocationID;
				   $locationArray[$k]["Location_name"]=$Location_name;
				   $k++;
			   }
			   

			   
			 $this -> db -> select('PK_UserGroupID,UserGroup_name');	
			 $this -> db -> from('tbl_master_usergroup');			 
			 $query2 = $this -> db -> get();
			 $i=0;
			 $groupArray=array();
			 foreach ($query2->result() as $row2)
			  {
				   $UserGroupID=$row2->PK_UserGroupID;
				   $UserGroup_name=$row2->UserGroup_name;				   
				
				   $groupArray[$i]["UserGroupID"]=$UserGroupID;
				   $groupArray[$i]["UserGroup_name"]=$UserGroup_name;
				   $i++;
			   }
			   
			   
			 $this -> db -> select('PK_CompanyID,Company_name');	
			 $this -> db -> from('tbl_master_company');			 
			 $query3 = $this -> db -> get();
			 $l=0;
			 $companyArray=array();
			 foreach ($query3->result() as $row3)
			  {
				   $CompanyID=$row3->PK_CompanyID;
				   $Company_name=$row3->Company_name;				   
				
				   $companyArray[$l]["CompanyID"]=$CompanyID;
				   $companyArray[$l]["Company_name"]=$Company_name;
				   $l++;
			   }
			   
			   
			   
			   
			   
			   
			   
			   
			     $json = array();
			 $jsonarray = array(
        
				'dealerlist'=>$dealerArray ,
				'locationlist'=>$locationArray,
				'grouplist'=>$groupArray,
				'companylist'=>$companyArray
        
          );
		   
		   array_push($json, $jsonarray);   
           $jsonstring = json_encode($json);
           echo $jsonstring;
           die(); 
	
	}
	function addUserItems()
	{
	   //$this->load->model('JbCommon');
	   $userid=$this->input->post('userid');
	   $name=$this->input->post('name');
	   $title=$this->input->post('title');
	   $emailid=$this->input->post('emailid');
	   $company=$this->input->post('company');
	   $password=$this->input->post('password');
	   $passwordnew = $this->encryption->encrypt($password);
	   $validfrom=$this->input->post('validfrom');
	   $validto=$this->input->post('validto');
	   $location=$this->input->post('location');
	   $status=$this->input->post('status');	   
	   $IMEI_No=$this->input->post('IMEI_No');	
	   $branditem=$this->input->post('branditem');
	   $brandvalue=implode(",",$branditem);
	   $group=$this->input->post('groupid');

	 $data = array(
        'UserID'=>$userid,
        'Name'=>$name,
		'Title'=>$title,
		'EmailID'=>$emailid,
		'FK_CompanyID'=>$company,
		'Password'=>$passwordnew,
		'ValidFrom'=>$validfrom,
		'ValidTo'=>$validto,
		'FK_LocationID'=>$location,
		'IsActive'=>$status,
		'IMEI_No'=>$IMEI_No,
		//'AssignedBrands'=>$brandvalue,
		'FK_UserGroupId'=>$group
    );
	
	if($this->input->post('uid'))
	{
		$id=$this->input->post('uid');
		$this->db->where('PK_UserID', $id);
		$this->db->update('tbl_master_userinformation', $data);
	}
	else
	{
		$this->db->insert('tbl_master_userinformation',$data);
	}
	
	
	    $UserID=$this->input->post('UserID');
		$UserID=isset($UserID)?$UserID:'';
		$data["UserID"]=$UserID;
		
		$Name=$this->input->post('Name');
		$Name=isset($Name)?$Name:'';
		$data["Name"]=$Name;
		
		
		$UserGroupId=$this->input->post('UserGroupId');
		$UserGroupId=isset($UserGroupId)?$UserGroupId:0;
		$data["UserGroupId"]=$UserGroupId;
		
		
		$LocationID=$this->input->post('LocationID');
		$LocationID=isset($LocationID)?$LocationID:0;
		$data["LocationID"]=$LocationID;
		
		$companyid=$this->input->post('companyid');
		$companyid=isset($companyid)?$companyid:0;
		$data["companyid"]=$companyid;
		
		$sql_usergroup="select PK_UserGroupID,UserGroup_name from tbl_master_usergroup where IsActive=1 and PK_UserGroupID!=1";
		$query_usergroup = $this->db->query($sql_usergroup);
		$data["usergroup_table"]=$query_usergroup ;
		
		$sql_location="select PK_LocationID,Location_name from tbl_master_location where IsActive=1";
		$query_location = $this->db->query($sql_location);
		$data["location_table"]=$query_location ;
		
		$sql_company="select distinct Company_name,PK_CompanyID from tbl_master_company where IsActive=1";
		$query_company = $this->db->query($sql_company);
		$data["company_table"]=$query_company ;
		
		$sql_dealer="select PK_DealerID,DealerName from tbl_master_dealerinformation where IsActive=1";
		$query_dealer = $this->db->query($sql_dealer);
		$data["dealer_table"]=$query_dealer ;
		
		
	 
	$sql="SELECT A.*, GROUP_CONCAT(B.CategoryName) as CategoryName,C.Location_name as Location,D.UserGroup_name as Groupname FROM tbl_master_userinformation A, tbl_master_productcategory B,tbl_master_location C ,tbl_master_usergroup D WHERE FIND_IN_SET(B.PK_CategoryID, A.FK_AssignedBrandID)  and A.FK_LocationID=C.PK_LocationID and A.FK_UserGroupId=D.PK_UserGroupID";
	 
	            if($UserID!='')$sql.=" and A.UserID='".$UserID."' ";
			    if($Name!='')$sql.=" and A.Name LIKE '%".$Name."%' ";			 
			    if($UserGroupId!=0)$sql.=" and A.FK_UserGroupId=".$UserGroupId." ";
				if($LocationID!=0)$sql.=" and A.FK_LocationID=".$LocationID." ";
				if($companyid!=0)$sql.=" and A.FK_CompanyID=".$companyid." ";
				$sql.=" GROUP BY A.PK_UserID ORDER BY A.PK_UserID ASC";
				//echo $sql;
				
				$query_user = $this->db->query($sql);
			    $data["userlist_table"]=$query_user;	
	 
	 redirect('getUserListItems',$data); 
	
	
	
	}
}

?>
