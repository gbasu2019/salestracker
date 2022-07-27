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

class Category extends CI_Controller {

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
	public function getCategoryList()
	{
		
		 $json = array(); 		  
		 $this -> db -> select('PK_CategoryID,CategoryName');	
		 $this -> db -> from('tbl_master_category');
         $this -> db -> limit(30);
         $query = $this -> db -> get();
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
	
	
}

?>