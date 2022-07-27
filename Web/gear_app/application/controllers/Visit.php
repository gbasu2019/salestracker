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

class Visit extends CI_Controller {

	
	public function index()
	{
		$this->load->view('welcome_message');
	}
	
	public function getVisitList()
	{
		$postdata = file_get_contents("php://input");
		$status=0;
		$dealerid=0;
		if (isset($postdata))
			{
			
		       $request = json_decode($postdata);
			   $userid=$request->userid;
			   if(isset($request->dealerid))$dealerid=$request->dealerid;
			   $startdate=$request->startDate;
			   $enddate=$request->endDate;
			   $startdate=$startdate." "."00:00:00";
			   $enddate=$enddate." "."23:59:59";
			   $usergroupid=$request->usergroupid;
			   $sql="";
			   

               $sql="select A.PK_VisitID as VisitID,A.Location ,A.Country ,A.State ,A.City ,A.Latitude
               ,A.Longitute as Longitude,A.Visit_Image as VisitImage,B.DealerName,A.VisitDate,A.VisitStatus,D.Name as FullName  from tbl_trans_visitentry A ,tbl_master_dealerinformation B,tbl_master_userinformation D  
               where   A.VisitDate >= '".$startdate."' and A.VisitDate <= '".$enddate."'  and B.PK_DealerID=A.FK_DealerID and  A.FK_UserID=D.PK_UserID ";
			   
			   if($dealerid!=0)$sql.=" and A.FK_DealerID=".$dealerid." ";		       
			   if($userid!=0)$sql.=" and A.FK_UserID=".$userid." ";
			   $sql.=" order by A.VisitDate desc,B.DealerName asc ,D.Name asc ";
			   
			  // echo $sql;
			   
			   $query3 = $this->db->query($sql);
			   
			   $i=0;
		       $visitlistArray=array();
			   if($query3 ->num_rows() >= 1)$status=1;

		       foreach ($query3->result() as $row3)
             { 
    			$VisitID=$row3->VisitID;
				$Location=$row3->Location;
				$Country=$row3->Country;
				$State=$row3->State;
				$City=$row3->City;
				$Latitude=$row3->Latitude;
				$Longitude=$row3->Longitude;
				$VisitDate=$row3->VisitDate;
				$VisitStatus=$row3->VisitStatus;
				$VisitImage=$row3->VisitImage;
				$DealerName=$row3->DealerName;
				$FullName=$row3->FullName;
				$visitlistArray[$i]["VisitID"]=$VisitID;
				$visitlistArray[$i]["Location"]=$Location;
				$visitlistArray[$i]["Country"]=$Country;
				$visitlistArray[$i]["State"]=$State;
				$visitlistArray[$i]["City"]=$City;
				$visitlistArray[$i]["Latitude"]=$Latitude;
				$visitlistArray[$i]["Longitude"]=$Longitude;
				$visitlistArray[$i]["VisitDate"]=$VisitDate;
				$visitlistArray[$i]["VisitStatus"]=$VisitStatus;
				$visitlistArray[$i]["VisitImage"]=$VisitImage;
				$visitlistArray[$i]["DealerName"]=$DealerName;
				$visitlistArray[$i]["FullName"]=$FullName;
				$i++;
				
			 }
			 $visitarray=array();
			 if($status==1)
			 {
				$visitarray[0] ["status"]=$status;
				$visitarray[0] ["visitlist"]=$visitlistArray;
				
				 
			 }
			 else
			 {
				$visitarray[0] ["status"]=$status; 
				 
			 }
			    $json = array();
			 $jsonarray = array(
        
		'visitlist'=>$visitarray 
        
          );
		   
		   array_push($json, $jsonarray);   
           $jsonstring = json_encode($json);
           echo $jsonstring;
           die();

		
	}
	}
	
	
	
	public function saveVisitEntry()
	{
		
		  $this->load->model('JbCommon');
		  $postdata = file_get_contents("php://input");
		  if (isset($postdata))
			{
		         $request = json_decode($postdata);	
				 
                 $userid=$request->userid;
			     $dealerid=$request->dealerid;
				 
				 $latitude=$request->latitude;
			     $longitude=$request->longitude;
				 $image_base_64_string=isset($request->filename_base64)?$request->filename_base64:"";
				  $output_file="";
				if(!empty($image_base_64_string))
				{
				 $filename="c.jpg";
				 
				
				 $current_date=date(DATE_ATOM, time());
		         $current_date_str=explode("-",substr($current_date,0,10));
		 
		        $year=$current_date_str[0];
		        $month=$current_date_str[1];
		        $day=$current_date_str[2];
				 
					 $visitid=$this->db->select_max('PK_VisitID')->get('tbl_trans_visitentry')->row();
					 $coll=$visitid->PK_VisitID + 1;		

				   
					
					$dir = $year;				
					if (!is_dir('/Referral_Image/'.$dir)) 
					 {
					   mkdir('./Referral_Image/' . $dir, 0777, TRUE);
					 }
					 
					$dir = $dir."/".$month;
					if (!is_dir('/Referral_Image/'.$dir)) 
					{
					   mkdir('./Referral_Image/' . $dir, 0777, TRUE);
					}
					$dir = $dir."/".$userid;
					if (!is_dir('/Referral_Image/'.$dir)) 
					{
					   @mkdir('./Referral_Image/' . $dir, 0777, TRUE);
					}
					$dir = $dir."/".$dealerid;
					if (!is_dir('/Referral_Image/'.$dir)) 
					{
					  mkdir('./Referral_Image/' . $dir, 0777, TRUE);
					}
					$dir = $dir."/Visit";
					if (!is_dir('/Referral_Image/'.$dir)) 
					{
					  @mkdir('./Referral_Image/' . $dir, 0777, TRUE);
					}
					$extension=explode(".",$filename);
					$file_save_name=$coll.".".$extension[1];	

					$pic=str_replace(" ", "+",$image_base_64_string);
					$output_file="./Referral_Image/".$dir."/".$file_save_name;
					$ifp = fopen( $output_file, 'wb' ); 
					
					$data = explode( ',', $pic );   
					fwrite( $ifp, base64_decode( $data[1] ) );    
					fclose( $ifp ); 				 
				
				}
				
				
				 
			
		$address=$this->getAddressFromGoogleMaps($latitude, $longitude);
		
		if (!empty($address))
		{
			     $country=isset($address["country"])?$address["country"]:'';
			     $state=isset($address["province"])?$address["province"]:'';
			     $city=isset($address["city"])?$address["city"]:'';
			     $location=isset($address["formatted_address"])?$address["formatted_address"]:'';;
		}
	
				  date_default_timezone_set("Asia/Kolkata");
			     $data1=array(
			        'FK_UserID' => $userid,
					'FK_DealerID' => $dealerid,
					'Location' => $location,
					'Country' => $country,
					'State' => $state,
					'City' => $city,
					'Latitude' => $latitude,
					'Longitute' => $longitude,
					'Visit_Image' => $output_file,
					'VisitDate'=>date('Y-m-d H:i:s'),
					'VisitStatus'=>'Pending'	   
			  
			          );
			   
			     $this->JbCommon->form_insert($data1,"tbl_trans_visitentry");	
				 $json = array();        			 
		         $jsonarray = array(
                             'status' => 1,
                             'address'	=> $address						 
                            );
		         array_push($json, $jsonarray); 		 		 
		         $jsonstring = json_encode($json);
                 echo $jsonstring;
				 die();
				
				//$this->db->insert("tbl_trans_visitentry", $data1);	
			
 	 
			
			
		  
	}
	}	
	
	
	
	public function getAddressFromGoogleMaps($lat, $lon) 
	{ 
	$url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=$lat,$lon&sensor=true&key=AIzaSyAPouu6Vfs23wM7Rla5xPpEShpFWx-OVFA"; 
	
       // $url = "https://google.com";
  // Make the HTTP request 
	$data = file_get_contents($url); // Parse the json response 
	$jsondata = json_decode($data, true); // If the json data is invalid, return empty array 







	if (!$this->check_status($jsondata)) {
			return array();
		}

		$address = array(
			'country' => $this->google_getCountry($jsondata),
			'province' => $this->google_getProvince($jsondata),
			'city' => $this->google_getCity($jsondata),
			'street' => $this->google_getStreet($jsondata),
			'postal_code' => $this->google_getPostalCode($jsondata),
			'country_code' => $this->google_getCountryCode($jsondata),
			'formatted_address' => $this->google_getAddress($jsondata),
		);

		return $address;
	}

/* 
* Check if the json data from Google Geo is valid 
*/

public function check_status($jsondata) {
    if ($jsondata["status"] == "OK") return true;
    return false;
}

/*
* Given Google Geocode json, return the value in the specified element of the array
*/

public function google_getCountry($jsondata) {
    return $this->Find_Long_Name_Given_Type("country", $jsondata["results"][0]["address_components"]);
}
public function google_getProvince($jsondata) {
    return $this->Find_Long_Name_Given_Type("administrative_area_level_1", $jsondata["results"][0]["address_components"], true);
}
public function google_getCity($jsondata) {
    return $this->Find_Long_Name_Given_Type("locality", $jsondata["results"][0]["address_components"]);
}
public function google_getStreet($jsondata) {
    return $this->Find_Long_Name_Given_Type("street_number", $jsondata["results"][0]["address_components"]) . ' ' . $this->Find_Long_Name_Given_Type("route", $jsondata["results"][0]["address_components"]);
}
public function google_getPostalCode($jsondata) {
    return $this->Find_Long_Name_Given_Type("postal_code", $jsondata["results"][0]["address_components"]);
}
public function google_getCountryCode($jsondata) {
    return $this->Find_Long_Name_Given_Type("country", $jsondata["results"][0]["address_components"], true);
}
public function google_getAddress($jsondata) {
    return $jsondata["results"][0]["formatted_address"];
}

/*
* Searching in Google Geo json, return the long name given the type. 
* (If short_name is true, return short name)
*/

public function Find_Long_Name_Given_Type($type, $array, $short_name = false) {
    foreach( $array as $value) {
        if (in_array($type, $value["types"])) {
            if ($short_name)    
                return $value["short_name"];
            return $value["long_name"];
        }
    }
}

public function updateVisit()
{
	 $this->load->model('JbCommon');
		  $postdata = file_get_contents("php://input");
		  
		  if (isset($postdata))
			{
		         $request = json_decode($postdata);	
				 
                 $VisitID=$request->VisitID;
				 $VisitStatus=$request->VisitStatus;
				 
			   
			}
		  
		$data=array('VisitStatus'=>$VisitStatus);
		$this->db->set('VisitStatus','VisitStatus');
		$this->db->where('PK_VisitID',$VisitID);
		$this->db->update('tbl_trans_visitentry',$data);
		 $json = array();         
         			 
		         $jsonarray = array(
                             'status' => 1,
                              							 
                            );
		         array_push($json, $jsonarray);  
		 		 
		         $jsonstring = json_encode($json);
                 echo $jsonstring;
				 die();
}
public function getVisitListItems()
	{
	     $userid=$this->input->post('userid');
		$userid=isset($userid)?$userid:0;
		$data["userid"]=$userid;
		
		$dealerid=$this->input->post('dealerid');
		$dealerid=isset($dealerid)?$dealerid:0;
		$data["dealerid"]=$dealerid;
		
		$companyid=$this->input->post('companyid');
		$companyid=isset($companyid)?$companyid:0;
		$data["companyid"]=$companyid;
		
		
		
		$visitid=$this->input->post('visitid');
		$visitid=isset($visitid)?$visitid:0;
		$data["visitid"]=$visitid;
		
		
		$visitstatus=$this->input->post('visitstatus');
		$visitstatus=isset($visitstatus)?$visitstatus:'';
		$data["visitstatus"]=$visitstatus;
		
		$startDate=$this->input->post('startDate');
		$day_limit=0;
		$added_timestamp = strtotime('-'.$day_limit.' day', time());
        $startDate=isset($startDate)?$startDate:date('Y-m-d', $added_timestamp);
		$startDate_search = $startDate." 00:00:00";		
		$data["startDate"]=$startDate;
		
		
		$endDate=$this->input->post('endDate');
		$endDate=isset($endDate)?$endDate:date("Y-m-d");
		$endDate_search=$endDate." 23:59:59";		
		$data["endDate"]=$endDate;
		
		$sql_dealer="select PK_DealerID,DealerName from tbl_master_dealerinformation where IsActive=1";
		$query_dealer = $this->db->query($sql_dealer);
		$data["dealer_table"]=$query_dealer ;
		
		
		$sql_company="select distinct Company_name,PK_CompanyID from tbl_master_company where IsActive=1";
		$query_company = $this->db->query($sql_company);
		$data["company_table"]=$query_company ;
		
		$sql_user="select PK_UserID,Name from tbl_master_userinformation where IsActive=1 and FK_UserGroupId=2";
		$query_user = $this->db->query($sql_user);
		$data["user_table"]=$query_user ;
		 
	   /*  $sql="select A.PK_VisitID as VisitID,A.VisitDate  as VisitDate,A.FK_DealerID as DealerID,A.VisitStatus  as VisitStatus ,A.Visit_Image as VisitImage,A.Location as Location,B.DealerName as DealerName,B.Address as dealeraddress,0 as Quantity,D.Name as UserName from tbl_trans_visitentry A,tbl_master_dealerinformation B ,tbl_master_userinformation D 
             where A.FK_DealerID=B.PK_DealerID  and A.VisitDate >='".$startDate_search."' and A.VisitDate <='".$endDate_search."'  and  D.PK_UserID=A.FK_UserID";  */
	
	$sql="select A.PK_VisitID as VisitID,A.VisitDate  as VisitDate,A.FK_DealerID as DealerID,A.VisitStatus  as VisitStatus ,A.Visit_Image as VisitImage,A.Location as Location,B.DealerName as DealerName,B.Address as dealeraddress,E.Company_name as Companyname,0 as Quantity,D.FK_CompanyID as CompanyID,D.Name as UserName from tbl_trans_visitentry A,tbl_master_dealerinformation B ,tbl_master_userinformation D,tbl_master_company E
             where A.FK_DealerID=B.PK_DealerID  and A.VisitDate >='".$startDate_search."' and A.VisitDate <='".$endDate_search."'  and  D.PK_UserID=A.FK_UserID and D.FK_CompanyID=E.PK_CompanyID"; 
			   
			
			    if($userid!=0)$sql.=" and A.FK_UserID=".$userid." ";			 
			    if($dealerid!=0)$sql.=" and A.FK_DealerID=".$dealerid;
				if($visitid!=0)$sql.=" and A.PK_VisitID=".$visitid." ";	
				if($visitstatus!='')$sql.=" and A.VisitStatus='".$visitstatus."' ";	
				if($companyid!='')$sql.=" and D.FK_CompanyID='".$companyid."' ";
			   
			 //echo $sql;
			   
			   $query_visit = $this->db->query($sql);
			   $data["visitlist_table"]=$query_visit;	

		
		$this->load->view('visitlist',$data);			
				
	}

public function updateVisitStatusBulk()
{
	   if(isset($_POST['approve']) && isset($_POST['selectItem']))
		{	
			/*for($i = 0; $i < count($_POST['selectItem']); $i++)
			{
	   			$selectItem = $_POST['selectItem'][$i];	  			
				$sql_update="update tbl_trans_visitentry set VisitStatus='Approved' where PK_VisitID='".$selectItem."'";
		        $this->db->query($sql_update);
		
   			}*/

   			$selecteditem=trim($_POST['checkvisititem'],":");
   			$selecteditem_array=explode(":", $selecteditem);

   			for($i=0;$i<count($selecteditem_array);$i++){
   				$selectItem =$selecteditem_array[$i];	  			
				$sql_update="update tbl_trans_visitentry set VisitStatus='Approved' where PK_VisitID='".$selectItem."'";
		        $this->db->query($sql_update);

   			}

 		 
}   
if(isset($_POST['reject'])&& isset($_POST['selectItem']))
{
	/*for($i = 0; $i < count($_POST['selectItem']); $i++)
			{
	   			$selectItem = $_POST['selectItem'][$i];
	  			$sql_update="update tbl_trans_visitentry set VisitStatus='Reject' where PK_VisitID='".$selectItem."'";
		        $this->db->query($sql_update);
				
   			}*/


$selecteditem=trim($_POST['uncheckvisititem'],":");
   			$selecteditem_array=explode(":", $selecteditem);
   			//echo var_dump($selecteditem_array);
   			

   			for($i=0;$i<count($selecteditem_array);$i++){
   				$selectItem =$selecteditem_array[$i];
$sql_update="update tbl_trans_visitentry set VisitStatus='Reject' where PK_VisitID='".$selectItem."'";
		        $this->db->query($sql_update);

}

   			
}
		$userid=$this->input->post('userid');
		$userid=isset($userid)?$userid:0;
		$data["userid"]=$userid;
		
		$dealerid=$this->input->post('dealerid');
		$dealerid=isset($dealerid)?$dealerid:0;
		$data["dealerid"]=$dealerid;
		
		$companyid=$this->input->post('companyid');
		$companyid=isset($companyid)?$companyid:0;
		$data["companyid"]=$companyid;
		
		
		
		$visitid=$this->input->post('visitid');
		$visitid=isset($visitid)?$visitid:0;
		$data["visitid"]=$visitid;
		
		
		$visitstatus=$this->input->post('statusVal');
		$visitstatus=isset($visitstatus)?$visitstatus:'';
		$data["visitstatus"]=$visitstatus;
		$data["status"]=$visitstatus;
		
		$startDate=$this->input->post('startDate');
		$day_limit=2;
		$added_timestamp = strtotime('-'.$day_limit.' day', time());
        $startDate=isset($startDate)?$startDate:date('Y-m-d', $added_timestamp);
		$startDate_search = $startDate." 00:00:00";		
		$data["startDate"]=$startDate;
		
		
		$endDate=$this->input->post('endDate');
		$endDate=isset($endDate)?$endDate:date("Y-m-d");
		$endDate_search=$endDate." 23:59:59";		
		$data["endDate"]=$endDate;
		
		$sql_dealer="select PK_DealerID,DealerName from tbl_master_dealerinformation where IsActive=1";
		$query_dealer = $this->db->query($sql_dealer);
		$data["dealer_table"]=$query_dealer ;
		
		
		$sql_company="select distinct Company_name,PK_CompanyID from tbl_master_company where IsActive=1";
		$query_company = $this->db->query($sql_company);
		$data["company_table"]=$query_company ;
		
		$sql_user="select PK_UserID,Name from tbl_master_userinformation where IsActive=1 and FK_UserGroupId=2";
		$query_user = $this->db->query($sql_user);
		$data["user_table"]=$query_user ;
		 
	    /* $sql="select A.PK_VisitID as VisitID,A.VisitDate  as VisitDate,A.FK_DealerID as DealerID,A.VisitStatus  as VisitStatus ,A.Visit_Image as VisitImage,A.Location as Location,B.DealerName as DealerName,B.Address as dealeraddress,0 as Quantity,D.Name as UserName from tbl_trans_visitentry A,tbl_master_dealerinformation B ,tbl_master_userinformation D 
             where A.FK_DealerID=B.PK_DealerID  and A.VisitDate >='".$startDate_search."' and A.VisitDate <='".$endDate_search."'  and  D.PK_UserID=A.FK_UserID";  */
	
			   $sql="select A.PK_VisitID as VisitID,A.VisitDate  as VisitDate,A.FK_DealerID as DealerID,A.VisitStatus  as VisitStatus ,A.Visit_Image as VisitImage,A.Location as Location,B.DealerName as DealerName,B.Address as dealeraddress,E.Company_name as Companyname,0 as Quantity,D.FK_CompanyID as CompanyID,D.Name as UserName from tbl_trans_visitentry A,tbl_master_dealerinformation B ,tbl_master_userinformation D,tbl_master_company E
             where A.FK_DealerID=B.PK_DealerID  and A.VisitDate >='".$startDate_search."' and A.VisitDate <='".$endDate_search."'  and  D.PK_UserID=A.FK_UserID and D.FK_CompanyID=E.PK_CompanyID"; 
			
			    if($userid!=0)$sql.=" and A.FK_UserID=".$userid." ";			 
			    if($dealerid!=0)$sql.=" and A.FK_DealerID=".$dealerid;
				//if($visitid!=0)$sql.=" and A.PK_VisitID=".$visitid." ";	
				if($visitstatus!='')$sql.=" and A.VisitStatus='".$visitstatus."' ";	
				if($companyid!=0)$sql.=" and E.PK_CompanyID=".$companyid." ";
			   
			 
			   
			   $query_visit = $this->db->query($sql);
			   $data["visitlist_table"]=$query_visit;	
			   $this->load->view('visitlist',$data);	

       

					
				
}
	public function updateVisitStatus()
	{
	    $id=$this->input->post('visitid');
		$status=$this->input->post('status');
		$visitstatus=$this->input->post('visitstatus');
		$data["status"]=$status;
		$data["visitstatus"]=$visitstatus;
		$sql_update="update tbl_trans_visitentry set VisitStatus='".$status."' where PK_VisitID='".$id."'";
		$this->db->query($sql_update);
		
		$userid=$this->input->post('userid');
		$userid=isset($userid)?$userid:0;
		$data["userid"]=$userid;
		
		$dealerid=$this->input->post('dealerid');
		$dealerid=isset($dealerid)?$dealerid:0;
		$data["dealerid"]=$dealerid;
		
		$companyid=$this->input->post('companyid');
		$companyid=isset($companyid)?$companyid:0;
		$data["companyid"]=$companyid;
		
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
		
		$sql_dealer="select PK_DealerID,DealerName from tbl_master_dealerinformation where IsActive=1";
		$query_dealer = $this->db->query($sql_dealer);
		$data["dealer_table"]=$query_dealer ;
		
		
		$sql_company="select distinct Company_name,PK_CompanyID from tbl_master_company where IsActive=1";
		$query_company = $this->db->query($sql_company);
		$data["company_table"]=$query_company ;
		
		$sql_user="select PK_UserID,Name from tbl_master_userinformation where IsActive=1 and FK_UserGroupId=2";
		$query_user = $this->db->query($sql_user);
		$data["user_table"]=$query_user ;
		
		/*  $sql="select A.PK_VisitID as VisitID,A.VisitDate  as VisitDate,A.FK_DealerID as DealerID,A.VisitStatus  as VisitStatus ,A.Location as Location,A.Visit_Image as VisitImage,B.DealerName
               as DealerName,B.Address as dealeraddress,0 as Quantity,D.Name as UserName from tbl_trans_visitentry A,tbl_master_dealerinformation B ,tbl_master_userinformation D 
               where A.FK_DealerID=B.PK_DealerID  and A.VisitDate >='".$startDate_search."' and A.VisitDate <='".$endDate_search."'  and  D.PK_UserID=A.FK_UserID"; */
			   
			   
			   $sql="select A.PK_VisitID as VisitID,A.VisitDate  as VisitDate,A.FK_DealerID as DealerID,A.VisitStatus  as VisitStatus ,A.Visit_Image as VisitImage,A.Location as Location,B.DealerName as DealerName,B.Address as dealeraddress,E.Company_name as Companyname,0 as Quantity,D.FK_CompanyID as CompanyID,D.Name as UserName from tbl_trans_visitentry A,tbl_master_dealerinformation B ,tbl_master_userinformation D,tbl_master_company E
             where A.FK_DealerID=B.PK_DealerID  and A.VisitDate >='".$startDate_search."' and A.VisitDate <='".$endDate_search."'  and  D.PK_UserID=A.FK_UserID and D.FK_CompanyID=E.PK_CompanyID and A.VisitStatus='".$visitstatus."' "; 
			    if($userid!=0)$sql.=" and A.FK_UserID=".$userid." ";			 
			    if($dealerid!=0)$sql.=" and A.FK_DealerID=".$dealerid;
		      // echo $sql;
			   $query_visit = $this->db->query($sql);
			   $data["visitlist_table"]=$query_visit;	
	
		
	 $this->load->view('visitlist',$data);
	}
	
	function lastVisitDate()
	{
		$sql_visit="SELECT MAX(VisitDate)as VisitDate FROM `tbl_trans_visitentry` ORDER BY `tbl_trans_visitentry`.`VisitDate` ASC limit 0,1";
		$query_visit = $this->db->query($sql_visit);

		 $query_visit_row=$query_visit->row();
		 $lastdate=$query_visit_row->VisitDate;		 
		 $enddate=date('Y-m-d',strtotime($lastdate));
		 $endDate_search=$enddate;
		 $json = array();
		 $jsonarray = array(        
        'enddate' => $endDate_search
		 );
		  array_push($json, $jsonarray);   
         $jsonstring = json_encode($json);
         echo $jsonstring;
         die();
	}
	function visitArray()
	{
		$sql_visit="SELECT MAX(VisitDate)as VisitDate FROM `tbl_trans_visitentry` ORDER BY `tbl_trans_visitentry`.`VisitDate` ASC limit 0,1";
		$query_visit = $this->db->query($sql_visit);

		 $query_visit_row=$query_visit->row();
		 $lastdate=$query_visit_row->VisitDate;		 
		 $enddate=date('Y-m-d',strtotime($lastdate));
		 $endDate_search=$enddate." 23:59:59";
		 $startdate = strtotime ( '-7 day' , strtotime ( $enddate ) ) ;
		 $startdate = date ( 'Y-m-d' , $startdate );
		 $startDate_search = $startdate." 00:00:00";
		 $json = array();
		 $sqlvisit = "select count(PK_VisitID) as weeklyvisitcount from tbl_trans_visitentry where VisitDate>='".$startDate_search."' and VisitDate<='".$endDate_search."'";
		 $queryvisit = $this->db->query($sqlvisit);		
		 $rowvisit = $queryvisit->row();
		 $weeklyvisitcount = $rowvisit->weeklyvisitcount;
         $jsonarray = array(        
        'visitcount' => $weeklyvisitcount
		 );
		  array_push($json, $jsonarray);   
         $jsonstring = json_encode($json);
         echo $jsonstring;
         die();
		
		
	}
	
	function visitArrayApproved()
	{
		$sql_visit="SELECT MAX(VisitDate)as VisitDate FROM `tbl_trans_visitentry`  ORDER BY `tbl_trans_visitentry`.`VisitDate` ASC limit 0,1";
		$query_visit = $this->db->query($sql_visit);

		 $query_visit_row=$query_visit->row();
		 $lastdate=$query_visit_row->VisitDate;		 
		 $enddate=date('Y-m-d',strtotime($lastdate));
		 $endDate_search=$enddate." 23:59:59";
		 $startdate = strtotime ( '-7 day' , strtotime ( $enddate ) ) ;
		 $startdate = date ( 'Y-m-d' , $startdate );
		 $startDate_search = $startdate." 00:00:00";
		 $json = array();
		 $sqlvisit = "select count(PK_VisitID) as weeklyvisitcount from tbl_trans_visitentry where VisitDate>='".$startDate_search."' and VisitDate<='".$endDate_search."' and `VisitStatus`='Approved'";
		 $queryvisit = $this->db->query($sqlvisit);		
		 $rowvisit = $queryvisit->row();
		 $weeklyvisitcount = $rowvisit->weeklyvisitcount;
         $jsonarray = array(        
        'visitcount' => $weeklyvisitcount
		 );
		  array_push($json, $jsonarray);   
         $jsonstring = json_encode($json);
         echo $jsonstring;
         die();
		
		
	}
	
	function visitArrayRejected()
	{
		$sql_visit="SELECT MAX(VisitDate)as VisitDate FROM `tbl_trans_visitentry` ORDER BY `tbl_trans_visitentry`.`VisitDate` ASC limit 0,1";
		$query_visit = $this->db->query($sql_visit);

		 $query_visit_row=$query_visit->row();
		 $lastdate=$query_visit_row->VisitDate;		 
		 $enddate=date('Y-m-d',strtotime($lastdate));
		 $endDate_search=$enddate." 23:59:59";
		 $startdate = strtotime ( '-7 day' , strtotime ( $enddate ) ) ;
		 $startdate = date ( 'Y-m-d' , $startdate );
		 $startDate_search = $startdate." 00:00:00";
		 $json = array();
		 $sqlvisit = "select count(PK_VisitID) as weeklyvisitcount from tbl_trans_visitentry where VisitDate>='".$startDate_search."' and VisitDate<='".$endDate_search."' and `VisitStatus`='Reject'";
		 $queryvisit = $this->db->query($sqlvisit);		
		 $rowvisit = $queryvisit->row();
		 $weeklyvisitcount = $rowvisit->weeklyvisitcount;
         $jsonarray = array(        
        'visitcount' => $weeklyvisitcount
		 );
		  array_push($json, $jsonarray);   
         $jsonstring = json_encode($json);
         echo $jsonstring;
         die();
		
		
	}
}

?>