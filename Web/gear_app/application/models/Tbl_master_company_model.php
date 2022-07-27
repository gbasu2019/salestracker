<?php

 
class Tbl_master_company_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get tbl_master_company by PK_CompanyID
     */
    function get_tbl_master_company($PK_CompanyID)
    {
        return $this->db->get_where('tbl_master_company',array('PK_CompanyID'=>$PK_CompanyID))->row_array();
    }
        
    /*
     * Get all tbl_master_company
     */
    function get_all_tbl_master_company()
    {
        $this->db->order_by('PK_CompanyID', 'desc');
        return $this->db->get('tbl_master_company')->result_array();
    }
        
    /*
     * function to add new tbl_master_company
     */
    function add_tbl_master_company($params)
    {
        $this->db->insert('tbl_master_company',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update tbl_master_company
     */
    function update_tbl_master_company($PK_CompanyID,$params)
    {
        $this->db->where('PK_CompanyID',$PK_CompanyID);
        return $this->db->update('tbl_master_company',$params);
    }
    
    /*
     * function to delete tbl_master_company
     */
    function delete_tbl_master_company($PK_CompanyID)
    {
        return $this->db->delete('tbl_master_company',array('PK_CompanyID'=>$PK_CompanyID));
    }
}
