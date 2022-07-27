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

class Collection extends CI_Controller {

	
	public function index()
	{
		
	}
	
	public function collectionEntry()
	{
		
		 $this->load->model('JbCommon');
		 $postdata = file_get_contents("php://input");
		  if (isset($postdata))
			{
		         $request = json_decode($postdata);	
				 
                 $userid=$request->userid;
			     $dealerid=$request->dealerid;				 
				 $collection_type=$request->collection_type;
			     $transactionID=isset($request->transactionID)?$request->transactionID:"";				  
				 $cheque=isset($request->cheque)?$request->cheque:"";
			     $bankid=isset($request->bankName)?$request->bankName:"";
			     $chequeNo=isset($request->chequeNo)?$request->chequeNo:"";
			     $amount=$request->amount;	
				 $locationid=$request->locationid;	
				 $companyid=$request->companyid;	
                 //$filename=$request->filename;
				 
				 
				 $filename="c.jpg";
				 $image_base_64_string=isset($request->filename_base64)?$request->filename_base64:"";
				 $output_file="";
				 $current_date=date(DATE_ATOM, time());
		        $current_date_str=explode("-",substr($current_date,0,10));
		 
		        $year=$current_date_str[0];
		        $month=$current_date_str[1];
		        $day=$current_date_str[2];
				 if(!isset($image_base_64_string))
				 {
				 $collectionid=$this->db->select_max('PK_CollectionID')->get('tbl_trans_dealercollection')->row();
				 $coll=$collectionid->PK_CollectionID + 1;		

               
				
		        $dir = $year;				
                if (!is_dir('/Referral_Image/'.$dir)) 
		         {
                   mkdir('./Referral_Image/' . $dir, 0777, TRUE);
	             }
				 
	            $dir = $dir."/".$month;
                if (!is_dir('/Referral_Image/'.$dir)) 
				{
                   mkdir('./Referral_Image/' . $dir, 0777, TRUE);
	            }
				$dir = $dir."/".$userid;
                if (!is_dir('/Referral_Image/'.$dir)) 
				{
                   @mkdir('./Referral_Image/' . $dir, 0777, TRUE);
	            }
	            $dir = $dir."/".$dealerid;
                if (!is_dir('/Referral_Image/'.$dir)) 
				{
                  mkdir('./Referral_Image/' . $dir, 0777, TRUE);
	            }
				$dir = $dir."/Collection";
                if (!is_dir('/Referral_Image/'.$dir)) 
				{
                  @mkdir('./Referral_Image/' . $dir, 0777, TRUE);
	            }
	            $extension=explode(".",$filename);
	            $file_save_name=$coll.".".$extension[1];	

                $pic=str_replace(" ", "+",$image_base_64_string);
                $output_file="./Referral_Image/".$dir."/".$file_save_name;
                $ifp = fopen( $output_file, 'wb' ); 
				
                $data = explode( ',', $pic );   
                fwrite( $ifp, base64_decode( $data[0] ) );    
                fclose( $ifp ); 				 
				 }
			  
			     $data1=array(
				    'FK_CreatedBy' => $userid,
				    'CreatedDate'=>$current_date,
				    'IsActive'=>"1",
			        'FK_UserID' => $userid,
					'FK_DealerID' => $dealerid,
					'Collection_type' => $collection_type,
					'transactionID' => $transactionID,
					'Cheque' => $cheque,
					'FK_BankID' => $bankid,
					'ChequeNo' => $chequeNo,
					'Referral_Image' => $output_file,
					'amount'=>$amount,
					'FK_LocationID'=>$locationid,
					'FK_CompanyID'=>$companyid
					
			   
			  
			          );
			   
			     $this->JbCommon->form_insert($data1,"tbl_trans_dealercollection");			  
			     $json = array();         
         			 
		         $jsonarray = array(
                             'status' => 1,
                              							 
                            );
		         array_push($json, $jsonarray);  
		 		 
		         $jsonstring = json_encode($json);
                 echo $jsonstring;
				 die();
				 
				 
			}
	}
	
	public function getBankLists()
	{
		
		 $json = array();
		
 $sql="Select PK_BankId as bankid,Bankname as bankname from tbl_master_bank Where  IsActive=1 order by Bankname";


$query = $this->db->query($sql);
		   
		   $i=0;
		   $bankArray=array();
		   if($query -> num_rows() >= 1)
          {
			  $status=1;
		      foreach ($query->result() as $row)
             {
			 
				$bankid=$row->bankid;
				$bankname=$row->bankname;
				
				
				
				$bankArray[$i]["bankid"]=$bankid;
				$bankArray[$i]["bankname"]=$bankname;
				
				
				$i++;
				
			 }
		  }
			 
			 $jsonarray = array(
       
		'banklist'=>$bankArray ,
		'status'=>$status
		
        
          );
		  
		  
			 
		 
		 
		 array_push($json, $jsonarray);   
         $jsonstring = json_encode($json);
         echo $jsonstring;
         die();
	}
	
	public function getLedgerlist()
	{
		 $json = array();		
		 $postdata = file_get_contents("php://input");
		
		if (isset($postdata))
			{
		       $request = json_decode($postdata);
			   $dealerid = $request->dealerid;
		       $startDate = $request->startDate;
			   $endDate = $request->endDate;
			}

// $sql="select PK_Ledger as LedgerID,FK_DealerID as DealerID,LedgerDate as LedgerDate,VoucherType as VoucherType,VoucherNo as VoucherNo,Particulars as Particulars from tbl_trans_accountledger where LedgerDate>='".$startDate."' and LedgerDate<='".$endDate."' and FK_DealerID=".$dealerid;

		$sql="select PK_LedgerID as LedgerID,FK_DealerID as DealerID,LedgerDate as LedgerDate,VoucherType as VoucherType,VoucherNo as VoucherNo,Particulars as Particulars,DebitAmount as DebitAmount,CreditAmount as CreditAmount from tbl_trans_accountledger where LedgerDate>='".$startDate."' and LedgerDate<='".$endDate."' and FK_DealerID=".$dealerid; 
				//$DealerName=$row1->DealerName;	  
		      // echo $sql;   
		       $query = $this->db->query($sql);
		       $sql1="SELECT `DealerName` as DealerName,`OpeningBalance` as OpeningBalance,`ClosingBalance` as ClosingBalance  FROM `tbl_master_dealerinformation` WHERE PK_DealerID=".$dealerid;	
			   $query4 = $this->db->query($sql1);
			   $row1=$query4->row();
		   $i=0;
		   $LedgerArray=array();
		   if($query -> num_rows() >= 1)
          {
			  $status=1;
		      foreach ($query->result() as $row)
             {
			 
				$LedgerID=$row->LedgerID;
				$LedgerDate=$row->LedgerDate;
				$VoucherType=$row->VoucherType;
				$VoucherNo=$row->VoucherNo;
				$Particulars=$row->Particulars;
				$OpeningBalance=$row1->OpeningBalance;
				$ClosingBalance=$row1->ClosingBalance;
				$DealerName=$row1->DealerName;
				$DebitAmount=$row->DebitAmount;
				$CreditAmount=$row->CreditAmount;
				
				
				$LedgerArray[$i]["LedgerID"]=$LedgerID;
				$LedgerArray[$i]["LedgerDate"]=$LedgerDate;
				$LedgerArray[$i]["VoucherType"]=$VoucherType;
				$LedgerArray[$i]["VoucherNo"]=$VoucherNo;
				$LedgerArray[$i]["Particulars"]=$Particulars;
				$LedgerArray[$i]["OpeningBalance"]=$OpeningBalance;
				$LedgerArray[$i]["ClosingBalance"]=$ClosingBalance;
				$LedgerArray[$i]["DealerName"]=$DealerName;
				$LedgerArray[$i]["DebitAmount"]=$DebitAmount;
				$LedgerArray[$i]["CreditAmount"]=$CreditAmount;
				$i++;
				
			 }
		  }
		  else
		  {
			 $status=0; 
		  }
			 
			 $jsonarray = array(
       
		'Ledgerlist'=>$LedgerArray ,
		'status'=>$status
		
        
          );
		  
		  
			
		 
		 
		 array_push($json, $jsonarray);   
         $jsonstring = json_encode($json);
         echo $jsonstring;
         die();
	}
	public function collectionlist()
	{
	
		
		$postdata = file_get_contents("php://input");
		$sql="";
		
		 $request = json_decode($postdata);
			  
			   $userid=$request->userid;
			   $dealerid=$request->dealerid;
			   $startDate=$request->startDate;			   
			   $endDate=$request->endDate;
			   $usergroupid=$request->usergroupid;
			   
			   
			   
			   
			//  $sql="select A.PK_CollectionID as CollectionID,A.CreatedDate as CreatedDate,A.Collection_type as Collection_type,A.transactionID as transactionID,A.Cheque as Cheque,A.ChequeNo as ChequeNo,A.Referral_Image as Referral_Image,A.amount as amount,B.DealerName as DealerName,B.PK_DealerID as DealerID, C.Bankname as Bankname,C.PK_BankId as BankId,D.Name as FullName,D.PK_UserID as UserID from tbl_trans_dealercollection A,tbl_master_dealerinformation B ,tbl_master_bank C,tbl_master_userinformation D where A.CreatedDate>='".$startDate."' and A.CreatedDate<='".$endDate."' and A.FK_BankID = C.PK_BankId and A.FK_DealerID = B.PK_DealerID and A.FK_UserID = D.PK_UserID";
			   
			   /* $sql="select A.PK_CollectionID as CollectionID,A.CreatedDate as CreatedDate,A.Collection_type as Collection_type,A.FK_DealerID as DealerID,B.DealerName
               as DealerName,C.Bankname as Bankname ,D.Name as FullName from tbl_trans_dealercollection A,tbl_master_dealerinformation B ,tbl_master_bank C ,tbl_master_userinformation D 
                where A.FK_DealerID=B.PK_DealerID    and A.CreatedDate>='".$startDate."' and A.CreatedDate<='".$endDate."' and A.FK_BankID=C.PK_BankId  and  A.FK_CreatedBy=D.PK_UserID ";*/
				
			$sql="select A.PK_CollectionID as CollectionID,A.CreatedDate as CreatedDate,A.Collection_type as Collection_type,A.FK_DealerID as DealerID,A.FK_BankID as BankID,A.CreatedDate as CreatedDate,A.Collection_type as Collection_type,A.transactionID as transactionID,A.Cheque as Cheque,A.ChequeNo as ChequeNo,A.Referral_Image as Referral_Image,A.amount as amount,B.DealerName as DealerName,D.Name as FullName from tbl_trans_dealercollection A,tbl_master_dealerinformation B ,tbl_master_userinformation D where A.FK_DealerID=B.PK_DealerID and A.CreatedDate>='".$startDate."' and A.CreatedDate<='".$endDate."' and A.FK_UserID=D.PK_UserID";	
				
			   if($userid!=0){$sql.=" and A.FK_UserID=".$userid." ";}	 
			   if($dealerid!=0){$sql.=" and A.FK_DealerID=".$dealerid;}
			   
			   $sql.="  order by A.CreatedDate desc,B.DealerName asc";
			  // echo "sql=".$sql;
			   
			   $query3 = $this->db->query($sql);
			   
			   $i=0;
		       $collectionlistArray=array(); 
			   foreach ($query3->result() as $row3)
				{
				
					
			    $CreatedDate=$row3->CreatedDate;
				$CollectionID=$row3->CollectionID;
				$Collection_type=$row3->Collection_type;
				$transactionID=isset($row3->transactionID)?$row3->transactionID:"";
				$BankID=isset($row3->BankID)?$row3->BankID:"";
				$Cheque=isset($row3->Cheque)?$row3->Cheque:"";
				$ChequeNo=isset($row3->ChequeNo)?$row3->ChequeNo:"";
				$Referral_Image=isset($row3->Referral_Image)?$row3->Referral_Image:"";	
				$amount=isset($row3->amount)?$row3->amount:"";				
				$FullName=$row3->FullName;
				//$Bankname=$row3->Bankname;
				$DealerName=$row3->DealerName;
				if(!empty($BankID))
				{
					$sql2="select `Bankname`,`PK_BankId` from `tbl_master_bank` where PK_BankId=".$BankID." order by Bankname asc";
					$query5 = $this->db->query($sql2);
					$row5=$query5->row();
					$Bankname=$row5->Bankname;
				}
				else
				{
					$Bankname="";
				}
				//echo $sql2;
				
				
				$collectionlistArray[$i]["CreatedDate"]=$CreatedDate;
				$collectionlistArray[$i]["CollectionID"]=$CollectionID;
				$collectionlistArray[$i]["Collection_type"]=$Collection_type;
				$collectionlistArray[$i]["transactionID"]=$transactionID;
				$collectionlistArray[$i]["Cheque"]=$Cheque;
				$collectionlistArray[$i]["ChequeNo"]=$ChequeNo;
				$collectionlistArray[$i]["Referral_Image"]=$Referral_Image;
				$collectionlistArray[$i]["FullName"]=$FullName;
				$collectionlistArray[$i]["Bankname"]=$Bankname;
				$collectionlistArray[$i]["DealerName"]=$DealerName;
				$collectionlistArray[$i]["amount"]=$amount;
				$i++;
				
			 }
			 
			 $sql1="SELECT `PK_CollectionID` as CollectionID,sum(`amount`) as TotalCash FROM `tbl_trans_dealercollection` WHERE CreatedDate>='".$startDate."' and CreatedDate<='".$endDate."'"; 
			 if($dealerid!=0){$sql1.=" and FK_DealerID=".$dealerid;}
			 if($userid!=0){$sql1.=" and FK_UserID=".$userid." ";}	
			
				$query4 = $this->db->query($sql1);
				$row1=$query4->row();
				//$TotalCash=number_format($row1->TotalCash, 2, ',', ',');
				$TotalCash=$row1->TotalCash	;	

				
				$sql2="SELECT `PK_CollectionID` as CollectionID,sum(`amount`) as BankCash FROM `tbl_trans_dealercollection` WHERE Collection_type='Bank' and CreatedDate>='".$startDate."' and CreatedDate<='".$endDate."'";
				
				if($dealerid!=0){$sql2.=" and FK_DealerID=".$dealerid;}
			    if($userid!=0){$sql2.=" and FK_UserID=".$userid." ";}
				//echo $sql2;
				$query5 = $this->db->query($sql2);
				$row2=$query5->row();
				$BankCash=$row2->BankCash;
				
				$sql3="SELECT `PK_CollectionID` as CollectionID,sum(`amount`) as CashAmount FROM `tbl_trans_dealercollection` WHERE Collection_type='Cash' and CreatedDate>='".$startDate."' and CreatedDate<='".$endDate."'";
				if($dealerid!=0){$sql3.=" and FK_DealerID=".$dealerid;}
			    if($userid!=0){$sql3.=" and FK_UserID=".$userid." ";}
				$query6 = $this->db->query($sql3);
				$row3=$query6->row();
				$CashAmount=$row3->CashAmount;
			 $json = array();
			 $jsonarray = array(
        'TotalCash'=>$TotalCash,
		'BankCash'=>$BankCash,
		'CashAmount'=>$CashAmount,
		'collectionlist'=>$collectionlistArray 
        
          );
		   
		   array_push($json, $jsonarray);   
           $jsonstring = json_encode($json);
           echo $jsonstring;
           die();
	}
	function getCollectionItems()
	{
	    $userid=$this->input->post('userid');
		$userid=isset($userid)?$userid:0;
		$data["userid"]=$userid;
		
		$dealerid=$this->input->post('dealerid');
		$dealerid=isset($dealerid)?$dealerid:0;
		$data["dealerid"]=$dealerid;
		
		$companyid=$this->input->post('companyid');
		$companyid=isset($companyid)?$companyid:0;
		$data["companyid"]=$companyid;
		
		
		
		$collectionid=$this->input->post('collectionid');
		$collectionid=isset($collectionid)?$collectionid:0;
		$data["collectionid"]=$collectionid;
		
		
		$collectiontype=$this->input->post('collectiontype');
		$collectiontype=isset($collectiontype)?$collectiontype:'';
		$data["collectiontype"]=$collectiontype;
		
		$startDate=$this->input->post('startDate');
		$day_limit=3;
		$added_timestamp = strtotime('-'.$day_limit.' day', time());
        $startDate=isset($startDate)?$startDate:date('Y-m-d', $added_timestamp);
		$startDate_search = $startDate." 00:00:00";		
		$data["startDate"]=$startDate;
		
		
		$endDate=$this->input->post('endDate');
		$endDate=isset($endDate)?$endDate:date("Y-m-d");
		$endDate_search=$endDate." 23:59:59";		
		$data["endDate"]=$endDate;
		
		$sql_dealer="select PK_DealerID,DealerName from tbl_master_dealerinformation where IsActive=1";
		$query_dealer = $this->db->query($sql_dealer);
		$data["dealer_table"]=$query_dealer ;
		
		
		$sql_company="select distinct Company_name,PK_CompanyID from tbl_master_company where IsActive=1";
		$query_company = $this->db->query($sql_company);
		$data["company_table"]=$query_company ;
		
		$sql_user="select PK_UserID,Name from tbl_master_userinformation where IsActive=1 and FK_UserGroupId=2";
		$query_user = $this->db->query($sql_user);
		$data["user_table"]=$query_user ;
		
		      $sql="select A.PK_CollectionID as CollectionID,A.CreatedDate  as CreatedDate,A.FK_DealerID as DealerID,A.FK_LocationID  as LocationID ,A.Referral_Image as   			ReferralImage,A.transactionID as transactionID,A.FK_LocationID as LocationID,A.Collection_type as Type,A.amount as amount,A.ChequeNo as ChequeNo, B.DealerName as DealerName,0 as Quantity,D.Name as UserName,E.Location_name as Location,F.Bankname as Bankname from tbl_trans_dealercollection A,tbl_master_dealerinformation B ,tbl_master_userinformation D ,tbl_master_location E,tbl_master_bank F  where A.FK_DealerID=B.PK_DealerID  and A.CreatedDate >='".$startDate_search."' and A.CreatedDate <='".$endDate_search."'  and  D.PK_UserID=A.FK_UserID and A.FK_LocationID=E.PK_LocationID and ( A.FK_BankID is null or A.FK_BankID=0 or A.FK_BankID=F.PK_BankId )";
			   
		//$sql="select A.PK_CollectionID as CollectionID,A.CreatedDate  as CreatedDate,A.FK_DealerID as DealerID,A.FK_LocationID  as LocationID ,A.Referral_Image as    			ReferralImage,A.FK_LocationID as LocationID,A.Collection_type as Type,A.amount as amount, B.DealerName as DealerName,0 as Quantity,D.Name as UserName,E.Location_name as Location from tbl_trans_dealercollection A,tbl_master_dealerinformation B ,tbl_master_userinformation D ,tbl_master_location E  where A.FK_DealerID=B.PK_DealerID  and A.CreatedDate >='".$startDate_search."' and A.CreatedDate <='".$endDate_search."'  and  D.PK_UserID=A.FK_UserID and A.FK_LocationID=E.PK_LocationID ";
				
			    if($userid!=0)$sql.=" and A.FK_UserID=".$userid." ";			 
			    if($dealerid!=0)$sql.=" and A.FK_DealerID=".$dealerid;
				if($collectionid!=0)$sql.=" and A.PK_CollectionID=".$collectionid." ";	
				if($collectiontype!='')$sql.=" and A.Collection_type='".$collectiontype."' ";	
				
				$sql.=" group by CollectionID";
			   
			   //echo $sql;
			   
			   $query_visit = $this->db->query($sql);
			   $data["collectionlist_table"]=$query_visit;	
			   $this->load->view('collectionlist',$data);
	
	}
	function getCollections()
	{
	 $collectionid=$this->input->post('collectionid');
	 
	 $sql="select cwProductName from tbl_master_dealerinformation where PK_DealerID in( select FK_DealerID from tbl_trans_dealercollection where  PK_CollectionID =".$collectionid.")";
	  
	 $query=$this->db->query($sql);
	 $row=$query->row();
	 $brandname=$row->cwProductName;
	 $json=array();
	 $this -> db -> select('PK_CollectionID,transactionID,Cheque,FK_BankID,ChequeNo');	
     $this -> db -> from('tbl_trans_dealercollection');
     $this -> db -> where('PK_CollectionID', $collectionid);
	 $query = $this -> db -> get();
	 foreach ($query->result() as $row)
      {
		  $CollectionID=$row->PK_CollectionID;
		  $transactionID=isset($row->transactionID)?$row->transactionID:'';
		  $Cheque=isset($row->Cheque)?$row->Cheque:'';
		  $BankID=isset($row->FK_BankID)?$row->FK_BankID:0;
		  $ChequeNo=isset($row->ChequeNo)?$row->ChequeNo:'';
		  if($BankID!=0)
		  {
		    $this -> db -> select('Bankname');	
			$this -> db -> from('tbl_master_bank');
			$this -> db -> where('PK_BankId', $BankID);
			$query1 = $this -> db -> get();
			$row1=$query1->row();
			$bankname=$row1->Bankname;
		  }
		  else
		  {
		  $bankname='';
		  }
		  
	
	 
	 
		        
				
				$jsonarray = array(
                             'CollectionID'=>$CollectionID,
                             'transactionID' => $transactionID, 							 
                             'Cheque'=>$Cheque,
							 'ChequeNo'=>$ChequeNo,                             
                             'bankname'=>$bankname
                                  );
		        array_push($json, $jsonarray); 
				
	  }


	  
	        $myObj["collectionarray"] = $json;
            $jsonstring = json_encode($myObj);			 
            echo $jsonstring;
            die();
	}
}

?>