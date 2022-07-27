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

class Test extends CI_Controller {

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
	public function testresult3()
	{  $country_id=0;
		$query=$this->db->query("select PK_BrandID from tbl_master_brand where BrandName like 'LG'");
		$row=$query->row();
		if(!empty($row))
		$country_id=$query->row()->PK_BrandID;
		echo $country_id;
	}
	public function testresult1($keyword)
	{
		//$country_id=$this->db->query("select PK_BrandID from tbl_master_brand where BrandName like 'pp'")->row()->PK_BrandID;
		//echo $country_id;
		/*$brandid=12;
		$parentcategoryid=1;
		
		 $this -> db -> select('PK_CategoryID,CategoryName');	
		 $this -> db -> from('tbl_master_productcategory');
         $this -> db -> where('FK_BrandID', $brandid);
		 $this -> db -> where('FK_ParentCategoryID', $parentcategoryid);
		 $this -> db -> where('IsActive', 1);
         $query = $this -> db -> get();
		 
		 if($query -> num_rows() >= 1)
          {
		     $json = array();
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
			 
			 $myObj["status"] = 1;
            $myObj["productarray"] = $json;


             $myJSON = json_encode($myObj);

echo "2". var_dump($myJSON);
		  }
		*/
		
		$array1 = array(
 array("name"=>"Aa1","id"=>1),array("name"=>"Aab","id"=>2),array("name"=>"Aabc","id"=>3),array("name"=>"Aabd","id"=>4)
  
);

$array2 = array(
 array("name"=>"Afghanistan","id"=>5),array("name"=>"India","id"=>6),array("name"=>"Bangladesh","id"=>7),array("name"=>"srilanka","id"=>8)
  
);

$array3 = array(
 array("name"=>"c1","id"=>9),array("name"=>"c2","id"=>10),array("name"=>"c3","id"=>11),array("name"=>"c4","id"=>12)
  
);

if($keyword=="a")
	$array=$array1;
if($keyword=="b")
	$array=$array2;
if($keyword=="c")
	$array=$array3;

// array_values() removes the original keys and replaces
// with plain consecutive numbers
$out = array_values($array);
$t=json_encode($array);
echo $t;
die();
		
	}
	public function testresult()
	{  
	    
		
		 $dealerid="1";		
		 $current_date=date(DATE_ATOM, time());
		 $current_date_str=explode("-",substr($current_date,0,10));
		 
		 $year=$current_date_str[0];
		 $month=$current_date_str[1];
		 $day=$current_date_str[2];
		 
		 $dir = $year;
		 
         if (!is_dir('/Referral_Image/'.$dir)) 
		   {
             mkdir('./Referral_Image/' . $dir, 0777, TRUE);
	       }
	$dir = $dir."/".$month;
     if (!is_dir('/Referral_Image/'.$dir)) {
    mkdir('./Referral_Image/' . $dir, 0777, TRUE);
	 }
	$dir = $dir."/".$dealerid;
     if (!is_dir('/Referral_Image/'.$dir)) {
    mkdir('./Referral_Image/' . $dir, 0777, TRUE);
	 }
	$filename="employee.jpg";
	$extension=explode(".",$filename);
	$transactionID="12";
	$file_save_name=$transactionID.".".$extension[1];
	
	$image_base_64_string="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
7JGSmZHZJWaFEcyUdpthySlhp//Z";

$pic=str_replace(" ", "+",$image_base_64_string);
$output_file="./Referral_Image/".$dir."/".$file_save_name;
$ifp = fopen( $output_file, 'wb' ); 

    
    $data = explode( ',', $pic );

   
    fwrite( $ifp, base64_decode( $data[ 0] ) );

    
    fclose( $ifp ); 

	$collectionid=$this->db->select_max('PK_CollectionID')->get('tbl_collectiondata')->row();
				 $coll=$collectionid->PK_CollectionID+1;	
				 
				 echo $coll;

	
	


	}
	
	public function saveventry($userid,$dealerid,$latitude,$longitude)
	{
		$this->load->model('JbCommon');
		 $address=$this->Get_Address_From_Google_Maps($latitude, $longitude);	

if (empty($address)	) $this->saveventry($userid,$dealerid,$latitude,$longitude)	 ;

			else
			{				
			     $country=$address["country"];
			     $state=$address["province"];
			     $city=$address["city"];
			     $location=$address["formatted_address"];		  
			  
			     $data1=array(
			        'FK_UserID' => $userid,
					'FK_DealerID' => $dealerid,
					'Location' => $location,
					'Country' => $country,
					'State' => $state,
					'City' => $city,
					'Latitude' => $latitude,
					'Longitute' => $longitude
					
			   
			  
			          );
			   
			     $this->JbCommon->form_insert($data1,"tbl_visitentry");			  
			     $json = array();         
         			 
		         $jsonarray = array(
                             'status' => 1,
                              							 
                            );
		         array_push($json, $jsonarray);  
		 		 
		         $jsonstring = json_encode($json);
                 echo $jsonstring;
			}
		
	}
	
	
	public function saveVisitEntry()
	{
		
		  
		  /*$postdata = file_get_contents("php://input");
		  if (isset($postdata))
			{
		         $request = json_decode($postdata);	
				*/ 
                 $userid=1;
			     $dealerid=1;
				 
				 $latitude="22.5726";
			     $longitude="88.3639";

             $this->saveventry($userid,$dealerid,$latitude,$longitude)	;			 
				 
			    ;/**/
                // die();		  
		  
		  
	//}
	
	}
	public function Get_Address_From_Google_Maps($lat, $lon) 
	{

       $url = "http://maps.googleapis.com/maps/api/geocode/json?latlng=".$lat.",".$lon."&sensor=false";
       // Make the HTTP request
       $data = @file_get_contents($url);
       // Parse the json response
       $jsondata = json_decode($data,true);

       // If the json data is invalid, return empty array
       if (!$this->check_status($jsondata))   return array();

        $address = array(
         'country' =>$this->google_getCountry($jsondata),
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
	
	
}

?>




