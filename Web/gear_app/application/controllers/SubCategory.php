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

class SubCategory extends CI_Controller {

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
	public function getSubCategoryList()
	{
		 $postdata = file_get_contents("php://input");
		 $categoryid=0;
	    if (isset($postdata))
			{
		      $request = json_decode($postdata);
		      $categoryid = $request->categoryid;
		      
	        }
		 $json = array(); 		  
		 $this -> db -> select('PK_SubCategoryID,SubCategoryName');	
		 $this -> db -> from('tbl_master_subcategory');
		 $this -> db -> where('FK_Category_ID', $categoryid );
         //$this -> db -> limit(30);
         $query = $this -> db -> get();
		 if($query -> num_rows() >= 1)
          {
		     foreach ($query->result() as $row)
             {
			 
				$subcategoryid=$row->PK_SubCategoryID;
			    $subcategoryname=$row->SubCategoryName;
			    $jsonarray = array(
                             'subcategoryid' => $subcategoryid,
                             'subcategoryname' => $subcategoryname, 
                             'quantity'=>'0',							 
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