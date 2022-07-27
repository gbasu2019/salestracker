<?php

 
class Tbl_master_userinformation_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get tbl_master_userinformation by PK_UserID
     */
    function get_tbl_master_userinformation($PK_UserID)
    {
        return $this->db->get_where('tbl_master_userinformation',array('PK_UserID'=>$PK_UserID))->row_array();
    }
        
    /*
     * Get all tbl_master_userinformation
     */
    function get_all_tbl_master_userinformation()
    {
        $this->db->order_by('Name', 'asc');
        return $this->db->get('tbl_master_userinformation')->result_array();
    }

    function get_all_tbl_master_userinformation_details()
    {
        // $this->db->order_by('Name', 'asc');
        // $this->$this->db->join('tbl_master_company', 'tbl_master_company.column = table.column', 'left');
        // return $this->db->get('tbl_master_userinformation')->result_array();

$this->db->order_by('Company_name', 'asc');
$this->db->order_by('Name', 'asc');
       $this->db->select('tbl_master_userinformation.*,tbl_master_company.*');
    $this->db->from('tbl_master_userinformation');
    $this->db->join('tbl_master_company', 'tbl_master_userinformation.FK_CompanyID = tbl_master_company.PK_CompanyID', 'inner'); 
    $query = $this->db->get();
    return $query->result_array();

    }
        
    /*
     * function to add new tbl_master_userinformation
     */
    function add_tbl_master_userinformation($params)
    {
        $this->db->insert('tbl_master_userinformation',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update tbl_master_userinformation
     */
    function update_tbl_master_userinformation($PK_UserID,$params)
    {
        $this->db->where('PK_UserID',$PK_UserID);
        return $this->db->update('tbl_master_userinformation',$params);
    }
    
    /*
     * function to delete tbl_master_userinformation
     */
    function delete_tbl_master_userinformation($PK_UserID)
    {
        return $this->db->delete('tbl_master_userinformation',array('PK_UserID'=>$PK_UserID));
    }
}
