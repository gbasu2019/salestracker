<?php

 
class Tbl_master_dealerinformation_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get tbl_master_dealerinformation by PK_DealerID
     */
    function get_tbl_master_dealerinformation($PK_DealerID)
    {
        return $this->db->get_where('tbl_master_dealerinformation',array('PK_DealerID'=>$PK_DealerID))->row_array();
    }
        
    /*
     * Get all tbl_master_dealerinformation
     */
    function get_all_tbl_master_dealerinformation()
    {
        $this->db->order_by('PK_DealerID', 'desc');
        return $this->db->get('tbl_master_dealerinformation')->result_array();
    }
        
    /*
     * function to add new tbl_master_dealerinformation
     */
    function add_tbl_master_dealerinformation($params)
    {
        $this->db->insert('tbl_master_dealerinformation',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update tbl_master_dealerinformation
     */
    function update_tbl_master_dealerinformation($PK_DealerID,$params)
    {
        $this->db->where('PK_DealerID',$PK_DealerID);
        return $this->db->update('tbl_master_dealerinformation',$params);
    }
    
    /*
     * function to delete tbl_master_dealerinformation
     */
    function delete_tbl_master_dealerinformation($PK_DealerID)
    {
        return $this->db->delete('tbl_master_dealerinformation',array('PK_DealerID'=>$PK_DealerID));
    }
}
