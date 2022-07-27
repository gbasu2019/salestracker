<?php

 
class Tbl_master_dealerinformation extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Tbl_master_dealerinformation_model');
    } 

    /*
     * Listing of tbl_master_dealerinformation
     */
    function index()
    {
        $data['tbl_master_dealerinformation'] = $this->Tbl_master_dealerinformation_model->get_all_tbl_master_dealerinformation();
        
        $data['_view'] = 'tbl_master_dealerinformation/index';
        $baseurl= $this->config->item('base_url'); 
        $data['baseurl']=$baseurl; 
        

        $this->load->view('dealerindex',$data);
    }

    /*
     * Adding a new tbl_master_dealerinformation
     */
    function add()
    {   
        if(isset($_POST) && count($_POST) > 0)     
        {   
            $params = array(
				'FK_CreatedBy' => $this->input->post('FK_CreatedBy'),
				'CreatedDate' => $this->input->post('CreatedDate'),
				'FK_ModifyBy' => $this->input->post('FK_ModifyBy'),
				'ModifyDate' => $this->input->post('ModifyDate'),
				'IsActive' => $this->input->post('IsActive'),
				'FK_LocationID' => $this->input->post('FK_LocationID'),
				'FK_CompanyID' => $this->input->post('FK_CompanyID'),
				'DealerName' => $this->input->post('DealerName'),
				'GUID' => $this->input->post('GUID'),
				'cwCategory' => $this->input->post('cwCategory'),
				'cwExecutiveName' => $this->input->post('cwExecutiveName'),
				'cwProductName' => $this->input->post('cwProductName'),
				'FK_CategoryID' => $this->input->post('FK_CategoryID'),
				'DealerName_Alias' => $this->input->post('DealerName_Alias'),
				'Product' => $this->input->post('Product'),
				'Address' => $this->input->post('Address'),
				'Town_City_Village' => $this->input->post('Town_City_Village'),
				'District' => $this->input->post('District'),
				'Pin_Code' => $this->input->post('Pin_Code'),
				'Phone_Number' => $this->input->post('Phone_Number'),
				'Mobile_Number' => $this->input->post('Mobile_Number'),
				'Category' => $this->input->post('Category'),
				'Sales_Executive' => $this->input->post('Sales_Executive'),
				'State' => $this->input->post('State'),
				'Credit_Days' => $this->input->post('Credit_Days'),
				'Credit_Limit' => $this->input->post('Credit_Limit'),
				'Vat_No' => $this->input->post('Vat_No'),
				'PAN_IT_No' => $this->input->post('PAN_IT_No'),
				'GSTIN' => $this->input->post('GSTIN'),
				'E-Mail' => $this->input->post('E-Mail'),
				'Contact_Person' => $this->input->post('Contact_Person'),
				'Notes' => $this->input->post('Notes'),
				'Alias' => $this->input->post('Alias'),
				'Send_SMS' => $this->input->post('Send_SMS'),
				'Sync' => $this->input->post('Sync'),
				'OpeningBalance' => $this->input->post('OpeningBalance'),
				'ClosingBalance' => $this->input->post('ClosingBalance'),
            );
            
            $tbl_master_dealerinformation_id = $this->Tbl_master_dealerinformation_model->add_tbl_master_dealerinformation($params);
            redirect('tbl_master_dealerinformation/index');
        }
        else
        {            
            $data['_view'] = 'tbl_master_dealerinformation/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a tbl_master_dealerinformation
     */
    function edit($PK_DealerID)
    {   
    	$baseurl= $this->config->item('base_url'); 
        $data['baseurl']=$baseurl;
        // check if the tbl_master_dealerinformation exists before trying to edit it
        $data['tbl_master_dealerinformation'] = $this->Tbl_master_dealerinformation_model->get_tbl_master_dealerinformation($PK_DealerID);
        
        if(isset($data['tbl_master_dealerinformation']['PK_DealerID']))
        {
            if(isset($_POST) && count($_POST) > 0)     
            {   
                $params = array(
					// 'FK_CreatedBy' => $this->input->post('FK_CreatedBy'),
					// 'CreatedDate' => $this->input->post('CreatedDate'),
					// 'FK_ModifyBy' => $this->input->post('FK_ModifyBy'),
					// 'ModifyDate' => $this->input->post('ModifyDate'),
					// 'IsActive' => $this->input->post('IsActive'),
					// 'FK_LocationID' => $this->input->post('FK_LocationID'),
					// 'FK_CompanyID' => $this->input->post('FK_CompanyID'),
					// 'DealerName' => $this->input->post('DealerName'),
					// 'GUID' => $this->input->post('GUID'),
					// 'cwCategory' => $this->input->post('cwCategory'),
					'cwExecutiveName' => $this->input->post('cwExecutiveName')
					// 'cwProductName' => $this->input->post('cwProductName'),
					// 'FK_CategoryID' => $this->input->post('FK_CategoryID'),
					// 'DealerName_Alias' => $this->input->post('DealerName_Alias'),
					// 'Product' => $this->input->post('Product'),
					// 'Address' => $this->input->post('Address'),
					// 'Town_City_Village' => $this->input->post('Town_City_Village'),
					// 'District' => $this->input->post('District'),
					// 'Pin_Code' => $this->input->post('Pin_Code'),
					// 'Phone_Number' => $this->input->post('Phone_Number'),
					// 'Mobile_Number' => $this->input->post('Mobile_Number'),
					// 'Category' => $this->input->post('Category'),
					// 'Sales_Executive' => $this->input->post('Sales_Executive'),
					// 'State' => $this->input->post('State'),
					// 'Credit_Days' => $this->input->post('Credit_Days'),
					// 'Credit_Limit' => $this->input->post('Credit_Limit'),
					// 'Vat_No' => $this->input->post('Vat_No'),
					// 'PAN_IT_No' => $this->input->post('PAN_IT_No'),
					// 'GSTIN' => $this->input->post('GSTIN'),
					// 'E-Mail' => $this->input->post('E-Mail'),
					// 'Contact_Person' => $this->input->post('Contact_Person'),
					// 'Notes' => $this->input->post('Notes'),
					// 'Alias' => $this->input->post('Alias'),
					// 'Send_SMS' => $this->input->post('Send_SMS'),
					// 'Sync' => $this->input->post('Sync'),
					// 'OpeningBalance' => $this->input->post('OpeningBalance'),
					// 'ClosingBalance' => $this->input->post('ClosingBalance'),
                );

                $this->Tbl_master_dealerinformation_model->update_tbl_master_dealerinformation($PK_DealerID,$params);            
                // redirect('tbl_master_dealerinformation/index');
                 redirect($baseurl.'/dealers');  
            }
            else
            {
                $data['_view'] = 'tbl_master_dealerinformation/edit';
             
                 $this->load->view('dealeredit',$data);
            }
        }
        else
            show_error('The tbl_master_dealerinformation you are trying to edit does not exist.');
    } 

    /*
     * Deleting tbl_master_dealerinformation
     */
    function remove($PK_DealerID)
    {
        $tbl_master_dealerinformation = $this->Tbl_master_dealerinformation_model->get_tbl_master_dealerinformation($PK_DealerID);

        // check if the tbl_master_dealerinformation exists before trying to delete it
        if(isset($tbl_master_dealerinformation['PK_DealerID']))
        {
            $this->Tbl_master_dealerinformation_model->delete_tbl_master_dealerinformation($PK_DealerID);
            redirect('tbl_master_dealerinformation/index');
        }
        else
            show_error('The tbl_master_dealerinformation you are trying to delete does not exist.');
    }
    
}
