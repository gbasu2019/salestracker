<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class JbCommon extends CI_Model{
function __construct() {
parent::__construct();
}
function form_insert($data,$table){

$this->db->set($data);
$this->db->insert($table, $data);
}


}
?>