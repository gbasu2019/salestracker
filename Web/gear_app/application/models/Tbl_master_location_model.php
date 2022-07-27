<?php

 
class Tbl_master_location_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get tbl_master_location by PK_LocationID
     */
    function get_tbl_master_location($PK_LocationID)
    {
        return $this->db->get_where('tbl_master_location',array('PK_LocationID'=>$PK_LocationID))->row_array();
    }
        
    /*
     * Get all tbl_master_location
     */
    function get_all_tbl_master_location()
    {
        $this->db->order_by('PK_LocationID', 'desc');
        return $this->db->get('tbl_master_location')->result_array();
    }
        
    /*
     * function to add new tbl_master_location
     */
    function add_tbl_master_location($params)
    {
        $this->db->insert('tbl_master_location',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update tbl_master_location
     */
    function update_tbl_master_location($PK_LocationID,$params)
    {
        $this->db->where('PK_LocationID',$PK_LocationID);
        return $this->db->update('tbl_master_location',$params);
    }
    
    /*
     * function to delete tbl_master_location
     */
    function delete_tbl_master_location($PK_LocationID)
    {
        return $this->db->delete('tbl_master_location',array('PK_LocationID'=>$PK_LocationID));
    }
}
