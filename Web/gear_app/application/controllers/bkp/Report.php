<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

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

	public function __construct()
{
 parent::__construct();
 
 $logged_in=$this->session->userdata('username');
 
if ( empty($logged_in))
 { 
 
  $this->load->view('login');
  redirect('', 'refresh');
  
 }
}


	public function visitreport()
	{

        $sql="SELECT `PK_CompanyID`,`Company_name` FROM `tbl_master_company`";

        $query_cmpy = $this->db->query($sql);
               $data["cmpylist_table"]=$query_cmpy;              
               
		$this->load->view('visitreport',$data);
	}

	public function index()
	{
		//$this->load->view('login');
	}
   
	public function getReportOrderAnalysis()
	{
		$baseurl=$this->config->item('base_url');
		$data['baseurl']=$baseurl;
		$sql="SELECT B.StatusName as StatusName,count(B.StatusName)as Total FROM `tbl_trans_ordermaster` A,tbl_status B where A.OrderDate >='2018-06-1 0:0:0' and A.OrderDate<='2018-07-11 23:59:59' and A.`FK_StatusID`=B.PK_StatusID  group by B.StatusName order by B.StatusName";
		$query = $this->db->query($sql);
		$orderstatusarray=array();
		foreach ($query->result() as $row)
             {
			 
		        $StatusName=$row->StatusName;
                $Total=$row->Total;
				$orderstatusarray["".$StatusName]=$Total;
			 }
			 $data['orderstatusarray']=$orderstatusarray;
$this->load->view('htmlstart',$data);
$this->load->view('commonheadercss',$data);
$this->load->view('bodystart',$data);
$this->load->view('headersection',$data);
$this->load->view('leftsidebar',$data);
$this->load->view('contentreportorderanalysis',$data);
$this->load->view('footer',$data);
$this->load->view('footerjs',$data);
$this->load->view('datePickerJs',$data);
$this->load->view('htmlend',$data);
	
	}

	public function reportexcel()
	{
		$this->excel->setActiveSheetIndex(0);
                //name the worksheet
                $this->excel->getActiveSheet()->setTitle('JB Report');
                //set cell A1 content with some text
                $this->excel->getActiveSheet()->setCellValue('A1', 'Company');
                $this->excel->getActiveSheet()->setCellValue('B1', 'Sales Person');
                $this->excel->getActiveSheet()->setCellValue('C1', 'Customer Name');
                $this->excel->getActiveSheet()->setCellValue('D1', 'Visit Date');
                $this->excel->getActiveSheet()->setCellValue('AI1', 'TOTAL MONTHLY VISIT');
                $this->excel->getActiveSheet()->setCellValue('D2', '1');
                $this->excel->getActiveSheet()->setCellValue('E2', '2');
                $this->excel->getActiveSheet()->setCellValue('F2', '3');
                $this->excel->getActiveSheet()->setCellValue('G2', '4');
                $this->excel->getActiveSheet()->setCellValue('H2', '5');
                $this->excel->getActiveSheet()->setCellValue('I2', '6');
                $this->excel->getActiveSheet()->setCellValue('J2', '7');
                $this->excel->getActiveSheet()->setCellValue('K2', '8');
                $this->excel->getActiveSheet()->setCellValue('L2', '9');
                $this->excel->getActiveSheet()->setCellValue('M2', '10');
                $this->excel->getActiveSheet()->setCellValue('N2', '11');
                $this->excel->getActiveSheet()->setCellValue('O2', '12');
                $this->excel->getActiveSheet()->setCellValue('P2', '13');
                $this->excel->getActiveSheet()->setCellValue('Q2', '14');
                $this->excel->getActiveSheet()->setCellValue('R2', '15');
                $this->excel->getActiveSheet()->setCellValue('S2', '16');
                $this->excel->getActiveSheet()->setCellValue('T2', '17');
                $this->excel->getActiveSheet()->setCellValue('U2', '18');
                $this->excel->getActiveSheet()->setCellValue('V2', '19');
                $this->excel->getActiveSheet()->setCellValue('W2', '20');
                $this->excel->getActiveSheet()->setCellValue('X2', '21');
                $this->excel->getActiveSheet()->setCellValue('Y2', '22');
                $this->excel->getActiveSheet()->setCellValue('Z2', '23');
                $this->excel->getActiveSheet()->setCellValue('AA2', '24');
                $this->excel->getActiveSheet()->setCellValue('AB2', '25');
                $this->excel->getActiveSheet()->setCellValue('AC2', '26');
                $this->excel->getActiveSheet()->setCellValue('AD2', '27');
                $this->excel->getActiveSheet()->setCellValue('AE2', '28');
                $this->excel->getActiveSheet()->setCellValue('AF2', '29');
                $this->excel->getActiveSheet()->setCellValue('AG2', '30');
                $this->excel->getActiveSheet()->setCellValue('AH2', '31');

                //merge cell 
                $this->excel->getActiveSheet()->mergeCells('A1:A2');
                $this->excel->getActiveSheet()->mergeCells('B1:B2');
                $this->excel->getActiveSheet()->mergeCells('C1:C2');
                $this->excel->getActiveSheet()->mergeCells('D1:AH1');
                $this->excel->getActiveSheet()->mergeCells('AI1:AI2');


                //set aligment to center for that merged cell (A1 to C1)
                $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                //make the font become bold
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(12);
                $this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('#333');
       

                $this->excel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('B1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(12);
                $this->excel->getActiveSheet()->getStyle('B1')->getFill()->getStartColor()->setARGB('#333');


                $this->excel->getActiveSheet()->getStyle('C1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('C1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(12);
                $this->excel->getActiveSheet()->getStyle('C1')->getFill()->getStartColor()->setARGB('#333');


                $this->excel->getActiveSheet()->getStyle('D1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('D1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(12);
                $this->excel->getActiveSheet()->getStyle('D1')->getFill()->getStartColor()->setARGB('#333');


                $this->excel->getActiveSheet()->getStyle('AI1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('AI1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('AI1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('AI1')->getFont()->setSize(12);
                $this->excel->getActiveSheet()->getStyle('AI1')->getFill()->getStartColor()->setARGB('#333');



                $startDate=$this->input->post('datefrom');
        
        $startDate=isset($startDate)?$startDate:date("Y-m-d");
        $startDate_search = $startDate." 00:00:00";
        
        //$data["startDate"]=$startDate;
        
        
        $endDate=$this->input->post('dateto');
        $endDate=isset($endDate)?$endDate:date("Y-m-d");
        $endDate_search=$endDate." 23:59:59";


        $companyID=$this->input->post('companyid');
        
        //$data["endDate"]=$endDate;


               $sql="SELECT c.Company_name,u.Name,d.DealerName, GROUP_CONCAT( DISTINCT convert(DAY(v.VisitDate),char(2)) SEPARATOR ',')as visited_date FROM `tbl_trans_visitentry` v ,`tbl_master_company` c,`tbl_master_userinformation` u,`tbl_master_dealerinformation` d where c.PK_CompanyID=u.FK_CompanyID and v.FK_UserID=u.PK_UserID and v.FK_DealerID=d.PK_DealerID and v.VisitDate>='".$startDate_search."' and v.VisitDate<='".$endDate_search."' ";
              if($companyID>0)
                 $sql.=" and u.FK_CompanyID=".$companyID;

               $sql.="  group by c.Company_name,u.Name,d.DealerName order by Company_name,Name,DealerName";
               //echo $sql;

               $rs=$this->db->query($sql);





                //$rs = $this->db->get('countries');
                $exceldata="";
        		foreach ($rs->result_array() as $row)
        		{
            	$row1=array();
                $row1['Company_name']=$row['Company_name'];
                $row1['Name']=$row['Name'];
                $row1['DealerName']=$row['DealerName'];
                	for($i=1;$i<=31;$i++)
                	{
                	$row1[''.$i]='N';
                	}

                $arr=explode(",",$row['visited_date']);
                $totalvisit=count($arr);
                $row1['total_visit']=$totalvisit;
                	for($i=0;$i<count($arr);$i++)
                 	{

                  	$row1[''.$arr[$i]]='Y'; 
                 	}
                $exceldata[] = $row1;
        		}
                //Fill data 
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A3');
                 
                
                //$this->excel->getActiveSheet()->getStyle('B4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                //$this->excel->getActiveSheet()->getStyle('C4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                 
                $filename='VisitReport.xls'; //save our workbook as this file name
                header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache
 
                //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
                //if you want to save it as .XLSX Excel 2007 format
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                //force user to download the Excel file without writing it to server's HD
                $objWriter->save('php://output');
                 
    }
	

}
?>