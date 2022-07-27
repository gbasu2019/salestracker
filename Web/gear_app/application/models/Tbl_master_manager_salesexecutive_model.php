<?php

 
class Tbl_master_manager_salesexecutive_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get tbl_master_manager_salesexecutive by PK_Manager_SalesExecutiveID
     */
    function get_tbl_master_manager_salesexecutive($PK_Manager_SalesExecutiveID)
    {
        return $this->db->get_where('tbl_master_manager_salesexecutive',array('PK_Manager_SalesExecutiveID'=>$PK_Manager_SalesExecutiveID))->row_array();
    }
        
    /*
     * Get all tbl_master_manager_salesexecutive
     */
    function get_all_tbl_master_manager_salesexecutive()
    {
        $this->db->order_by('PK_Manager_SalesExecutiveID', 'desc');
        return $this->db->get('tbl_master_manager_salesexecutive')->result_array();
    }


    function get_all_tbl_master_manager_salesexecutive_details()
    {
        // $this->db->order_by('PK_Manager_SalesExecutiveID', 'desc');
        // return $this->db->get('tbl_master_manager_salesexecutive')->result_array();



        $this->db->order_by('Company_name', 'asc');
$this->db->order_by('ManagerName', 'asc');
$this->db->order_by('SalesExecutiveName', 'asc');
       $this->db->select('tbl_master_manager_salesexecutive.*,tbl_master_company.*');
    $this->db->from('tbl_master_manager_salesexecutive');
    $this->db->join('tbl_master_company', 'tbl_master_manager_salesexecutive.FK_CompanyID = tbl_master_company.PK_CompanyID', 'inner'); 
    $query = $this->db->get();
    return $query->result_array();
    }
        
    /*
     * function to add new tbl_master_manager_salesexecutive
     */
    function add_tbl_master_manager_salesexecutive($params)
    {
        $this->db->insert('tbl_master_manager_salesexecutive',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update tbl_master_manager_salesexecutive
     */
    function update_tbl_master_manager_salesexecutive($PK_Manager_SalesExecutiveID,$params)
    {
        $this->db->where('PK_Manager_SalesExecutiveID',$PK_Manager_SalesExecutiveID);
        return $this->db->update('tbl_master_manager_salesexecutive',$params);
    }
    
    /*
     * function to delete tbl_master_manager_salesexecutive
     */
    function delete_tbl_master_manager_salesexecutive($PK_Manager_SalesExecutiveID)
    {
        return $this->db->delete('tbl_master_manager_salesexecutive',array('PK_Manager_SalesExecutiveID'=>$PK_Manager_SalesExecutiveID));
    }
}
