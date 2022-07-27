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
class Ledger extends CI_Controller {
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
* map to /index.php/welcome/
<method_name>
* @see https://codeigniter.com/user_guide/general/urls.html
*/
public function index()
{
}

public function ledgerupload($msg="")
{

$data=$this->session->all_userdata();
$data["msg"]=$msg;
$this->load->view('excelupload',$data);
}

public function uploadexcel()
{

  date_default_timezone_set("Asia/Kolkata");

$target_dir = "./uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
$file = $target_file;

$objPHPExcel = PHPExcel_IOFactory::load($file);
//get only the Cell Collection
$cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
$records=array();
$rowcount=0;
$FK_CompanyID=0;

foreach ($cell_collection as $cell) {
$column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
$row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
$data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
$companyname="";

if($row==1){
$companyname=$data_value;
$companyname=trim($companyname);

$this -> db -> select('PK_CompanyID');     
$this -> db -> from('tbl_master_company');
$this -> db -> where('Company_name',$companyname);
$query = $this->db->get();
$ret = $query->row();
$FK_CompanyID=$ret->PK_CompanyID;
break;
}
}




$this -> db -> select('PK_DealerID,DealerName');     
$this -> db -> from('tbl_master_dealerinformation');
$this -> db -> where('FK_CompanyID',$FK_CompanyID);
$query = $this->db->get();
$dealer_array=array();

foreach ($query->result() as $row)
{
    $dealer_array["".$row->PK_DealerID]=$row->DealerName;
}



foreach ($cell_collection as $cell) {
$column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
$row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
$data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();


//echo $FK_CompanyID;
//exit;

if($row>=8)
{
$rowcount=$row-8;	
if($column=="A")
{
	$data_value=date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($data_value));
}
if($column=="C")
{
	$fk_dealerid=array_search(trim($data_value),$dealer_array);
	$records[$rowcount]["H"]=$fk_dealerid;
}

$records[$rowcount][$column]=$data_value;
}
}

$records_inserted=0;
for($i=0;$i<count($records);$i++)
{
$LedgerDate=$records[$i]["A"];

$Particulars=$records[$i]["C"];
$VoucherType=$records[$i]["D"];
$VoucherNo=$records[$i]["E"];
$DebitAmount=$records[$i]["F"];
$CreditAmount=$records[$i]["G"];
$FK_DealerID=$records[$i]["H"];
$IsActive=1;

if($FK_DealerID==0)continue;
if($VoucherType=="Contra")continue;
if($VoucherType=="Payment")continue;
if($Particulars=="(cancelled)")continue;

$this -> db -> select('PK_LedgerID');	
$this -> db -> from('tbl_trans_accountledger');
$this -> db -> where('LedgerDate',$LedgerDate);
$this -> db -> where('IsActive', 1);
$this -> db -> where('VoucherType', $VoucherType);
$this -> db -> where('VoucherNo', $VoucherNo);
$this -> db -> where('FK_DealerID', $FK_DealerID);

$this -> db -> limit(1); 
$query = $this -> db -> get();
// $sql="Select PK_LedgerID from tbl_trans_accountledger where LedgerDate='".$LedgerDate."' and IsActive=1 and VoucherType='".$VoucherType."' and VoucherNo='".$VoucherNo."' and FK_DealerID=".$FK_DealerID;
//$query=$this->db->query($sql);
if($query -> num_rows() >= 1)continue;
          
$data = array(
             'LedgerDate' => $LedgerDate ,
             'IsActive' => $IsActive ,
             'Particulars' => $Particulars ,
             'VoucherType' => $VoucherType ,
             'VoucherNo' => $VoucherNo ,
             'DebitAmount' => $DebitAmount==""?0:$DebitAmount ,
             'CreditAmount' => $CreditAmount==""?0:$CreditAmount ,
             'FK_DealerID' => $FK_DealerID ,
            
             );
                  $data['FK_CreatedBy'] = $this->session->userdata('userid');
                  $data['CreatedDate'] = date('Y-m-d H:i:sP'); 
                  $this->db->set($data);
                  $records_inserted+=$this->db->insert("tbl_trans_accountledger", $data);
                  
}
unlink($target_file);
$message="Ledger details[ ".$records_inserted." records of ".$rowcount."] uploaded successfully";
$this->ledgerupload($message);
}
}
