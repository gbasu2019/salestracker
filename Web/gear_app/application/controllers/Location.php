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

class Location extends CI_Controller {

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
		$this->load->view('location');
	}
	public function BrandEntry()
	{
		$this->load->model('JbCommon');
		$brand_name=$this->input->post('BrandName');
		$brand_description=$this->input->post('BrandDescription');
		
		$data1=array(
			        'IsActive' => 1,
					'BrandName' => $brand_name,
					'Description' => $brand_description		  
			          );
			   
	    $this->JbCommon->form_insert($data1,"tbl_master_brand");
		$data["status"]=1;
		$this->load->view('brand',$data);
	}
	public function getBrandSearchList()
	{
		$brand_name=$this->input->post('BrandName');
		$brand_id=$this->input->post('BrandID');
		$query="";
		$this -> db -> select('PK_BrandID,BrandName,Description,IsActive');	
		$this -> db -> from('tbl_master_brand');
		if(!empty($brand_id)&& empty($brand_name))
		{
		    $this -> db -> where('PK_BrandID', $brand_id);		         
		}
		elseif(empty($brand_id)&& !empty($brand_name))
		{
		  $this -> db -> where('BrandName', $brand_name);		  
		}
		elseif(!empty($brand_id)&& !empty($brand_name))
		{
			$this -> db -> where('PK_BrandID', $brand_id);
		    $this -> db -> where('BrandName', $brand_name);
		}
		$query = $this -> db -> get();
		$data['brandlist']=$query;
		$this->load->view('brand',$data);
		
	}
	public function getBrandList()
	{
		
		 $json = array(); 		  
		 $this -> db -> select('PK_BrandID,BrandName');	
		 $this -> db -> from('tbl_master_brand');
         $this -> db -> limit(30);
         $query = $this -> db -> get();
		 if($query -> num_rows() >= 1)
          {
		     foreach ($query->result() as $row)
             {
			 
				$brandid=$row->PK_BrandID;
			    $brandname=$row->BrandName;
			    $jsonarray = array(
                             'brandid' => $brandid,
                             'brandname' => $brandname,        
                                  );
		        array_push($json, $jsonarray);  
			 }
		 }
		 
		 $jsonstring = json_encode($json);
         echo $jsonstring;
         die();
		  
	}
	
	
}

?>