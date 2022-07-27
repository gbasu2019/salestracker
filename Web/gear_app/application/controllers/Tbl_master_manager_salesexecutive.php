<?php

 
class Tbl_master_manager_salesexecutive extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Tbl_master_manager_salesexecutive_model');
    } 

    /*
     * Listing of tbl_master_manager_salesexecutive
     */
    function index()
    {
        $data['tbl_master_manager_salesexecutive'] = $this->Tbl_master_manager_salesexecutive_model->get_all_tbl_master_manager_salesexecutive_details();
        
       


        $baseurl= $this->config->item('base_url'); 
        $data['baseurl']=$baseurl; 
        

        $this->load->view('sales_manager_index',$data);
        // $this->load->view('commonFooterJs',$data);
        // $this->load->view('dataTableJs',$data);



    }

    /*
     * Adding a new tbl_master_manager_salesexecutive
     */
    function add()
    {   
        $baseurl= $this->config->item('base_url'); 
        $data['baseurl']=$baseurl;
        if(isset($_POST) && count($_POST) > 0)     
        {   
            $params = array(
				// 'FK_LocationID' => $this->input->post('FK_LocationID'),
                'FK_LocationID' => 1,
				'FK_CompanyID' => $this->input->post('FK_CompanyID'),
				'FK_USER_SalesExecutiveID' => $this->input->post('FK_USER_SalesExecutiveID'),
				'FK_User_MangerID' => $this->input->post('FK_User_MangerID'),
				'FK_CreatedBy' => 1,
				'CreatedDate' => date('Y-m-d H:i:sP'),
				
				
				'SalesExecutiveName' => $this->input->post('SalesExecutiveName'),
				'ManagerName' => $this->input->post('ManagerName'),
            );
            
            $tbl_master_manager_salesexecutive_id = $this->Tbl_master_manager_salesexecutive_model->add_tbl_master_manager_salesexecutive($params);
            // redirect('tbl_master_manager_salesexecutive/index');
            redirect($baseurl.'/salesmanager');
        }
        else
        {
			$this->load->model('Tbl_master_location_model');
			$data['all_tbl_master_location'] = $this->Tbl_master_location_model->get_all_tbl_master_location();

			$this->load->model('Tbl_master_company_model');
			$data['all_tbl_master_company'] = $this->Tbl_master_company_model->get_all_tbl_master_company();

			$this->load->model('Tbl_master_userinformation_model');
			$data['all_tbl_master_userinformation'] = $this->Tbl_master_userinformation_model->get_all_tbl_master_userinformation();
			$data['all_tbl_master_userinformation'] = $this->Tbl_master_userinformation_model->get_all_tbl_master_userinformation_details();
            
            $this->load->view('sales_manager_add',$data);
        }
    }  

    /*
     * Editing a tbl_master_manager_salesexecutive
     */
    function edit($PK_Manager_SalesExecutiveID)
    {   
        $baseurl= $this->config->item('base_url'); 
        $data['baseurl']=$baseurl;
        // check if the tbl_master_manager_salesexecutive exists before trying to edit it
        $data['tbl_master_manager_salesexecutive'] = $this->Tbl_master_manager_salesexecutive_model->get_tbl_master_manager_salesexecutive($PK_Manager_SalesExecutiveID);
        
        if(isset($data['tbl_master_manager_salesexecutive']['PK_Manager_SalesExecutiveID']))
        {
            if(isset($_POST) && count($_POST) > 0)     
            {   
                $params = array(
					// 'FK_LocationID' => $this->input->post('FK_LocationID'),
                    'FK_LocationID' => 1,
					'FK_CompanyID' => $this->input->post('FK_CompanyID'),
					'FK_USER_SalesExecutiveID' => $this->input->post('FK_USER_SalesExecutiveID'),
					'FK_User_MangerID' => $this->input->post('FK_User_MangerID'),
					'FK_CreatedBy' => $this->input->post('FK_CreatedBy'),
					'CreatedDate' => $this->input->post('CreatedDate'),
					'FK_ModifyBy' => $this->input->post('FK_ModifyBy'),
					'ModifyDate' => $this->input->post('ModifyDate'),
					'IsActive' => $this->input->post('IsActive'),
					'SalesExecutiveName' => $this->input->post('SalesExecutiveName'),
					'ManagerName' => $this->input->post('ManagerName'),
                );

                $this->Tbl_master_manager_salesexecutive_model->update_tbl_master_manager_salesexecutive($PK_Manager_SalesExecutiveID,$params);   
                redirect($baseurl.'salesmanager');         
                // redirect('tbl_master_manager_salesexecutive/index');
            }
            else
            {
				$this->load->model('Tbl_master_location_model');
				$data['all_tbl_master_location'] = $this->Tbl_master_location_model->get_all_tbl_master_location();

				$this->load->model('Tbl_master_company_model');
				$data['all_tbl_master_company'] = $this->Tbl_master_company_model->get_all_tbl_master_company();

				$this->load->model('Tbl_master_userinformation_model');
				$data['all_tbl_master_userinformation'] = $this->Tbl_master_userinformation_model->get_all_tbl_master_userinformation();
				$data['all_tbl_master_userinformation'] = $this->Tbl_master_userinformation_model->get_all_tbl_master_userinformation();

                // $data['_view'] = 'tbl_master_manager_salesexecutive/edit';
                // $this->load->view('layouts/main',$data);
                $this->load->view('sales_manager_edit',$data);
            }
        }
        else
            show_error('The tbl_master_manager_salesexecutive you are trying to edit does not exist.');
    } 

    /*
     * Deleting tbl_master_manager_salesexecutive
     */
    function remove($PK_Manager_SalesExecutiveID)
    {
        $tbl_master_manager_salesexecutive = $this->Tbl_master_manager_salesexecutive_model->get_tbl_master_manager_salesexecutive($PK_Manager_SalesExecutiveID);

        // check if the tbl_master_manager_salesexecutive exists before trying to delete it
        if(isset($tbl_master_manager_salesexecutive['PK_Manager_SalesExecutiveID']))
        {
            $this->Tbl_master_manager_salesexecutive_model->delete_tbl_master_manager_salesexecutive($PK_Manager_SalesExecutiveID);
            redirect($baseurl.'/salesmanager');
        }
        else
            show_error('The tbl_master_manager_salesexecutive you are trying to delete does not exist.');
    }
    
}
