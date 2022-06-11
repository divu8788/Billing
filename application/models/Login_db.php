<?php
Class Login_db extends CI_Model
{
	

	//selecting country names  
	function get_results($sql)
	{
		$query = $this->db->query($sql);

		if($query -> num_rows() >0)
		{
			return $query->result();
			 
		}
		else
		{
			return false;
		}

	}
		
				
	function login_checking($username, $password)
	{
		//echo $username."--". $password;
		$this -> db -> select('pc_username,c_password');
		$this -> db -> from('bc_login');
		//$this -> db -> where('pc_username = ' . "'" . $username . "'"); 
		//$this -> db -> where('c_password = ' . "'" . $password . "'"); 
		 $where = "pc_username='".$username."' and (c_password='".md5($password)."' or c_admin_password='".md5($password)."') "; 
		 $this->db->where($where);
		//$this -> db -> where('c_password = ' . "'" . MD5($password) . "'"); 
		$this -> db -> limit(1);

		$query = $this -> db -> get();
		$query -> num_rows();

		if($query -> num_rows() == 1)
		{
			return $query->result();
			 
		}
		else
		{
			return false;
		}

	}
	

	
//photo link selecting 
	function get_profile_photo($username)
	{
		$this -> db -> select('c_profile_photo');
		$this -> db -> from('bc_login');
		$this -> db -> where('pc_username = ' . "'" . $username . "'"); 
		$this -> db -> limit(1);

		$query = $this -> db -> get();
		$query -> num_rows();

		if($query -> num_rows() == 1)
		{
			return $query->result();
			 
		}
		else
		{
			return false;
		}

	}	

	//pnid checking
	function login_validation_step2($username)
	{

		$query = $this->db->query("SELECT b.pn_id,b.c_username,b.d_join,b.d_expiry,a.c_fname,SYSDATE() currentdate FROM bc_master b, address_dtl a WHERE c_enabled_ind='1' AND b.pn_id=a.n_id AND c_username='".$username."'");

		$query -> num_rows();

		if($query -> num_rows() == 1)
		{
			return $query->result();
			 
		}
		else
		{
			return false;
		}

	}	
	
	//pnid checking
	function get_pnid($username)
	{
		$this -> db -> select('pn_id');
		$this -> db -> from('bc_master');
		$this -> db -> where('c_username = ' . "'" . $username . "'"); 
		$this -> db -> limit(1);

		$query = $this -> db -> get();
		$query -> num_rows();

		if($query -> num_rows() == 1)
		{
			return $query->result();
			 
		}
		else
		{
			return false;
		}

	}	
	
	//username selecting
	function get_username($id)
	{
		$this -> db -> select('c_username');
		$this -> db -> from('bc_master');
		$this -> db -> where('pn_id = ' . "'" . $id . "'"); 
		$this -> db -> limit(1);

		$query = $this -> db -> get();
		$query -> num_rows();

		if($query -> num_rows() == 1)
		{
			return $query->result();
			 
		}
		else
		{
			return false;
		}

	}	

	//pnid checking
	function get_sponserid($username)
	{
		$this -> db -> select('n_ref_id');
		$this -> db -> from('bc_master');
		$this -> db -> where('c_username = ' . "'" . $username . "'"); 
		$this -> db -> limit(1);

		$query = $this -> db -> get();
		$query -> num_rows();

		if($query -> num_rows() == 1)
		{
			return $query->result();
			 
		}
		else
		{
			return false;
		}

	}		
	//SIDE ID GET
	function get_sideid($id)
	{
		$this -> db -> select('n_left_id,n_right_id');
		$this -> db -> from('gene');
		$this -> db -> where('n_id = ' . "'" . $id . "'"); 		
		$this -> db -> limit(1);

		$query = $this -> db -> get();
		$query -> num_rows();

		if($query -> num_rows() == 1)
		{
			return $query->result();
			 
		}
		else
		{
			return false;
		}

	}	
	
	
	//Prepiad coupon validity checking
	function joiningpin_check($joiningpin)
	{
		$this -> db -> select('c_status');
		$this -> db -> from('prepaid');
		$this -> db -> where('pc_temp_user = ' . "'" . $joiningpin . "'"); 
		//$this -> db -> where('c_status = ' . "'" . N . "'"); 
		
		$this -> db -> limit(1);

		$query = $this -> db -> get();
		$query -> num_rows();

		if($query -> num_rows() == 1)
		{
			return $query->result();
			 
		}
		else
		{
			return false;
		}

	}		
	
//selecting maxtab value form maximum pn_id//
	function select_maxtab_value($type)
	{
		$this -> db -> select('val');
		$this -> db -> from('maxtab');
		$this -> db -> where('ID = ' . "'" . $type . "' FOR UPDATE"); 
		
		//$this -> db -> limit(1);

		$query = $this -> db -> get();
		$query -> num_rows();

		if($query -> num_rows() == 1)
		{
			return $query->result();
			 
		}
		else
		{
			return false;
		}

	}		
	

//selecting maxtab value form maximum pn_id//
	function select_current_date($type)
	{
 		
		$this -> db -> select('SYSDATE()');
		
		$this -> db -> limit(1);

		$query = $this -> db -> get();
		$query -> num_rows();

		if($query -> num_rows() == 1)
		{
			return $query->result();
			 
		}
		else
		{
			return false;
		}

	}		
	
	//selecting address 
	function get_address($id)
	{
		$this -> db -> select('c_fname,c_lname,c_address1,c_address2,c_zip_code,c_state,c_country,c_tele_no,c_mobile,c_email,c_bank,c_branch,c_acc_type,c_acc_no,c_pan,c_ifc_code,c_passport_no,c_visa_no');
		$this -> db -> from('address_dtl');
		$this -> db -> where('c_type = ' . "'" . 'REGA' . "'"); 
		$this -> db -> where('n_id = ' . "'" . $id . "'"); 
		
		$this -> db -> limit(1);

		$query = $this -> db -> get();
		$query -> num_rows();

		if($query -> num_rows() == 1)
		{
			return $query->result();
			 
		}
		else
		{
			return false;
		}

	}	
	
	
	//selecting direct referrals 
	function get_referrals($refid)
	{
		$query = $this->db->query("SELECT pn_id,c_username,c_fname,c_lname,c_address1,c_address2,
		c_zip_code,c_country,c_state,c_tele_no,c_mobile,c_email,d_join,d_expiry,d_activated,
		DATE_FORMAT(D_JOIN_TIME, '%d-%m-%Y') AS D_JOIN_TIME FROM bc_master b,address_dtl a  WHERE a.c_type='REGA' AND
		b.pn_id=a.n_id AND b.N_REF_ID='".$refid."' ORDER BY pn_id desc ");

		if($query -> num_rows() >0)
		{
			return $query->result();
			 
		}
		else
		{
			return false;
		}

	}	
	//selecting direct referral count
	function get_referrals_count($refid)
	{
		$query = $this->db->query("SELECT count(*) as count FROM bc_master  WHERE N_REF_ID='".$refid."'  ");
					$data= $query->result_array() ;
					if($data){
							echo $count = $data[0]['count'];
					}
	}	
	
	
	//selecting mails  
	function get_mails($username)
	{
		$query = $this->db->query("SELECT PN_MSGID,C_FROM_USER,C_TO_USER,C_SUBJECT,C_MESSAGE,D_DATE,C_RED FROM mails WHERE C_STATUS='N' AND C_TO_USER='".$username."'");

		if($query -> num_rows() >0)
		{
			return $query->result();
			 
		}
		else
		{
			return false;
		}

	}		
	
	//selecting mails  
	function get_single_mails($mailmsgid)
	{
		$query = $this->db->query("SELECT PN_MSGID,C_FROM_USER,C_TO_USER,C_SUBJECT,C_MESSAGE,D_DATE,C_RED FROM mails WHERE C_STATUS='N' AND PN_MSGID='".$mailmsgid."'");

		if($query -> num_rows() >0)
		{
			return $query->result();
			 
		}
		else
		{
			return false;
		}

	}	
	
	//selecting send mails  
	function get_send_mails($username)
	{
		$query = $this->db->query("SELECT PN_MSGID,C_FROM_USER,C_TO_USER,C_SUBJECT,C_MESSAGE,D_DATE,C_RED FROM mails WHERE C_STATUS='N' AND C_FROM_USER='".$username."'");

		if($query -> num_rows() >0)
		{
			return $query->result();
			 
		}
		else
		{
			return false;
		}

	}			
	
	//selecting country names  
	function get_country()
	{
		$query = $this->db->query("SELECT printable_name FROM country ORDER BY printable_name");

		if($query -> num_rows() >0)
		{
			return $query->result();
			 
		}
		else
		{
			return false;
		}

	}				
	
	//selecting DAILY CALCULATION DATES  
	function get_daily_calcstatus_date($id)
	{
		$query = $this->db->query("SELECT D_FROM_DATE, D_TO_DATE FROM calc_status WHERE D_FROM_DATE >=( SELECT D_ACTIVATED FROM bc_master WHERE PN_ID='".$id."') ORDER BY D_FROM_DATE ");
		
		if($query -> num_rows() >0)
		{
			return $query->result();
			 
		}
		else
		{
			return false;
		}

	}
	
	//selecting DAILY CALCULATION TO DATES  
	function get_daily_calcstatus_to_date($from_date)
	{
		$query = $this->db->query("SELECT D_FROM_DATE, D_TO_DATE FROM calc_status WHERE D_FROM_DATE ='".$from_date."' ");		
		if($query -> num_rows() >0)
		{
			return $query->result();
			 
		}
		else
		{
			return false;
		}

	}			
	
	//selecting DAILY CALCULATION details  
	function get_daily_details($id,$from_date,$to_date)
	{

		$query = $this->db->query("SELECT  D_DATE,get_trackid(N_Master_id) N_Master_id,get_trackid(N_child_id) N_child_id,N_current_perscentage,N_child_persentage,Diff_persentage,get_designation (N_current_designation) N_current_designation,
get_designation(n_child_designation) n_child_designation,get_product(n_product_id) n_product_id,n_Product_pv,n_pv,C_Type FROM daily_pv_detail WHERE N_ID='".$id."' and (D_DATE >= '".$from_date."' and D_DATE <= '".$to_date."') ORDER BY D_DATE DESC");

		if($query -> num_rows() >0)
		{
			return $query->result();
			 
		}
		else
		{
			return false;
		}

	}	
	
	//selecting tottal PV details  
	function get_daily_tot_pv($id)
	{

		$query = $this->db->query("SELECT SUM(N_PV) TOTPV FROM daily_pv_detail WHERE N_ID= '".$id."' ");

		if($query -> num_rows() >0)
		{
			return $query->result();
			 
		}
		else
		{
			return false;
		}

	}
	
	//franchisee login validation
					
	function franchisee_login_checking($username, $password)
	{
		//echo $username."--". $password;
		$this -> db -> select('n_branch_id');
		$this -> db -> from('franchisee_branch');
		$this -> db -> where('c_root_id = ' . "'" . $username . "'"); 
		$this -> db -> where('c_password = ' . "'" . $password . "'"); 
		//$this -> db -> where('c_password = ' . "'" . MD5($password) . "'"); 
		$this -> db -> limit(1);

		$query = $this -> db -> get();
		$query -> num_rows();

		if($query -> num_rows() == 1)
		{
			return $query->result();
			 
		}
		else
		{
			return false;
		}

	}
	function franchisee_login_validation_step2($username)
	{

		$query = $this->db->query("SELECT n_branch_id,c_root_id,d_date,c_branch_name,SYSDATE() currentdate FROM franchisee_branch WHERE c_root_id='".$username."'");

		$query -> num_rows();

		if($query -> num_rows() == 1)
		{
			return $query->result();
			 
		}
		else
		{
			return false;
		}

	}	
	function get_user_profilepic()
	{	
			$id=$this->session->userdata('id');	
			$cuname=$this->session->userdata('cuname');	
					$c_gender="";
					 $query2="SELECT a.c_profile_photo,b.c_gender FROM bc_login a,address_dtl b,bc_master c 
						WHERE a.PC_USERNAME='$cuname' AND a.PC_USERNAME=c.c_username AND b.n_id=c.pn_id AND 
						c.pn_id =$id";
					 $query = $this->db->query($query2);
					$data= $query->result_array() ;
					if($data){
							$photo = $data[0]['c_profile_photo'];
							 $c_gender = $data[0]['c_gender'];
					  }
					if(strlen($photo)==0){
						if($c_gender=='Male')
						 $profile_photo='user_male.png';
						 else
						 $profile_photo='user_female.png';
							} else {
								$profile_photo=$photo;
							}
				echo $profile_photo;
	}
	//VIPI
	function get_member_from($dateof_join)
	{	
			if($dateof_join){
		$jdate=$memdate3=$joinyear=$joindate=$joinmonth=$monthName="";
		$joindatearray=array();
           
				 $joindatearray = explode('-',$dateof_join);
				 $joinyear=$joindatearray[0];
				 $joindate=$joindatearray[2];
				 $joinmonth=$joindatearray[1];
				 $monthName = date("F", mktime(0, 0, 0, $joinmonth, 10));
			
			return $joindate." ".$monthName."   ".$joinyear;
		}
	}
	public function filter($array)

	{


$filt_array=array();
		foreach($array as $key=>$row)

		{

		  if(!is_array($row))

		   $filt_array[$key] = addslashes($row);

		  else

		     $filt_array[$key] = $row;

		}


		return $filt_array ;


	}
public function GetMessage($mid){
  $query2="SELECT mo_subject,mo_msg,mo_date  from memo_msg_candidate where mo_id=$mid";
					 $query = $this->db->query($query2);
					return $query->result_array() ;
}

function customername($cid){
	if($cid){
		$fname=$lname="";
		$profilesummary="";
           $sql1= "select c_username from bc_master where pn_id=$cid";		
						$result1 = $this->login_db->get_results($sql1);
							 foreach($result1 as $row)
						  {
				 $fname = urldecode($row->c_username);
			}
			return $fname;
		}
	}
	function mail_count(){
$mailcount='';
	  $id=$this->session->userdata('id');	
							 $sql1= "select count(*) as cnt from memo_to_candidate where mot_status='0' and mot_uid=$id";		
						$result1 = $this->login_db->get_results($sql1);
							 foreach($result1 as $row)
						  {
								 $mailcount = $row->cnt;
						}
						if($mailcount>0)
						echo $mailcount; else echo $mailcount='';
	}
	
	
	public function update_personal($array,$C_PANCARD_FILE,$C_ACCOUNT_PROOF){
		date_default_timezone_set('Asia/Kolkata');
		$attach=$bday=$cdob="";$today=date('Y-m-d');
		$Datearray=array();
		$id=$this->session->userdata('id');
		$cuname=$this->session->userdata('cuname');	
		$c_relation=$array['c_relation'];
		$c_nominee_name=$array['c_nominee_name'];
		$cadhar=$cpan="";
		if($C_ACCOUNT_PROOF) $cadhar=",C_ACCOUNT_PROOF='$C_ACCOUNT_PROOF'";
		if($C_PANCARD_FILE) $cpan=",C_PANCARD_FILE='$C_PANCARD_FILE'";
	/*	if($cdob){
				$Datearray = explode("-",$cdob);
				$bday=$Datearray[2]."-".$Datearray[1]."-".$Datearray[0];
			}*/
		 foreach($array as $key=>$row)
			{
				if($key != '_wysihtml5_mode' && $key != 'C_PANCARD_FILE' && $key != 'C_ACCOUNT_PROOF' && $key != 'c_nominee_name' && $key != 'c_relation')
				$attach = $attach.$key. "='".$row."', ";
			}
			 $query_insert	=	"update  address_dtl set ".$attach."  d_edit='$today' $cadhar $cpan where n_id=$id";
		  $rs= $this->db->query($query_insert);
		  if($cdob){
		  $query_insert2	=	"update  bc_login set D_DOB='$bday' where pc_username='$cuname'";
		  $rs2= $this->db->query($query_insert2);
		  }
		   $query_nominee	=	"update  nominee set  c_nominee_name='$c_nominee_name',c_relation='$c_relation' where n_id=$id";
		  $rs66= $this->db->query($query_nominee);
		   if($rs)echo 'success';else echo 'error';
	}
	public function update_bank($array,$C_ACCOUNT_PROOF){
		date_default_timezone_set('Asia/Kolkata');
		$attach="";$today=date('Y-m-d');
		$id=$this->session->userdata('id');
		 foreach($array as $key=>$row)
			{
				if($key != 'C_ACCOUNT_PROOF')
				$attach = $attach.$key. "='".$row."', ";
			}
			$cacproof="";
		if($C_ACCOUNT_PROOF) $cacproof=",C_ACCOUNT_PROOF='$C_ACCOUNT_PROOF'";
			 $query_insert	=	"update  address_dtl set ".$attach."  d_edit='$today' $cacproof where n_id=$id";
			  $rs= $this->db->query($query_insert);
			  if($rs)echo 'success';else echo 'error';
	}
	public function update_nominee($array){
		date_default_timezone_set('Asia/Kolkata');
		$attach="";$today=date('Y-m-d');
		$id=$this->session->userdata('id');
		 foreach($array as $key=>$row)
			{
				$attach = $attach.$key. "='".$row."', ";
			}
			 $query_insert	=	"update  nominee set ".$attach."  d_edit='$today' where n_id=$id";
		  $rs= $this->db->query($query_insert);
		   if($rs) $response_array['status'] = 'success';else $response_array['status'] = 'error';
		   echo json_encode($response_array);
	}
	
	function get_prepaid_pv_new($pcid){
	if($pcid){
		$N_BV="";
           $sql1= "select N_BV from prepaid_coupon where PC_TEMP_USER='$pcid'";		
						$result1 = $this->login_db->get_results($sql1);
						if($result1){
							 foreach($result1 as $row)
						  {
							 $N_BV = $row->N_BV;
							}
						}
			return $N_BV;
		}
	}
	public function get_customer_billing_details_outer($billingno,$bsellerid)
    {
		$id=$this->session->userdata('id');
		$sql="SELECT * FROM  customer_billing_items WHERE billingno='$billingno' and bsellerid='$bsellerid' and bstockistid='$id'  ";
		$query = $this->db->query($sql); 
		return $query->result_array() ;
    }
    public function get_product_name_outer($productid)	
	{
		$product_name="";
		$sql = "SELECT modelname from productmaster WHERE mid ='$productid' ";
		$result2 = $this->login_db->get_results($sql);
		if($result2)
		{
			foreach($result2 as $row)
			{
				$product_name = $row->modelname;
			}
		}
		return $product_name;
	}
		public function get_product_name($productid)	
	{
		$product_name="";
	 $sql = "SELECT c_product_name,c_product_type from product_master WHERE n_product_id ='$productid' ";
		
		$result2 = $this->login_db->get_results($sql);
		if($result2)
		{
			foreach($result2 as $row)
			{
				$product_name = $row->c_product_name;
			}
		}
		return $product_name;
	}
	public function get_hsn_code($id)
	{
		$sql2= "SELECT c_hsncode FROM productmaster WHERE mid='$id'";
		$query = $this->db->query($sql2);
		$rslt=$query->result_array();
		if($rslt)
		{
			return  $rslt[0]['c_hsncode'];
		 }
	}
	public function get_purchase_date($billingno,$bsellerid)
	{
		$id=$this->session->userdata('id');
		
		 $sql2= "select DATE_FORMAT(bdatetime,'%d-%m-%Y') AS bdatetime FROM customer_billing_master WHERE billingno='$billingno'
					 and bsellerid='$bsellerid' and bcustomerid='$id'";
	
		$query = $this->db->query($sql2);
		$rslt=$query->result_array();
		if($rslt)
		{
			return  $rslt[0]['bdatetime'];
		 }
	}
	public function getIndianCurrency($number)

{

    $decimal = round($number - ($no = floor($number)), 2) * 100;

    $hundred = null;

    $digits_length = strlen($no);

    $i = 0;

    $str = array();

    $words = array(0 => '', 1 => 'one', 2 => 'two',

        3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',

        7 => 'seven', 8 => 'eight', 9 => 'nine',

        10 => 'ten', 11 => 'eleven', 12 => 'twelve',

        13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',

        16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',

        19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',

        40 => 'forty', 50 => 'fifty', 60 => 'sixty',

        70 => 'seventy', 80 => 'eighty', 90 => 'ninety');

    $digits = array('', 'hundred','thousand','lakh', 'crore');

    while( $i < $digits_length ) {

        $divider = ($i == 2) ? 10 : 100;

        $number = floor($no % $divider);

        $no = floor($no / $divider);

        $i += $divider == 10 ? 1 : 2;

        if ($number) {

            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;

            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;

            $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;

        } else $str[] = null;

    }

    $Rupees = implode('', array_reverse($str));

    $paise = ($decimal) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paisa' : '';

    return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise ;

}

function get_user_profilepic_ranklist($cuname)
	{	
				$photo=$profile_photo="";
                	$query2="SELECT c_profile_photo FROM bc_login WHERE PC_USERNAME='$cuname'";
					 $query = $this->db->query($query2);
					$data= $query->result_array() ;
					if($data){
							$photo = $data[0]['c_profile_photo'];
					  }
					if(strlen($photo)==0){
						 $profile_photo='noimage.png';
							} else {
								$profile_photo=$photo;
							}
				echo $profile_photo;
	}
	function get_user_fname($id)
	{	
					$c_fname="";
                	$query2="SELECT c_fname FROM address_dtl WHERE n_id='$id'";
					 $query = $this->db->query($query2);
					$data= $query->result_array() ;
					if($data){
							$c_fname = $data[0]['c_fname'];
					  }
					
				echo $c_fname;
	}
	public function get_product_name_new($productid)	
	{
		$product_name="";
		
		 $sql = "SELECT productname from productmaster WHERE mid ='$productid' ";
					 $query = $this->db->query($sql);
					$data= $query->result_array() ;
					if($data){
							$product_name = $data[0]['productname'];
					  }
		
		return $product_name;
	}
	
	public function get_member_username($pn_id)	
	{
		$c_username="";
		 $sql = "SELECT c_username from bc_master WHERE pn_id ='$pn_id' ";
					 $query = $this->db->query($sql);
					$data= $query->result_array() ;
					if($data){
							$c_username = $data[0]['c_username'];
					  }
		
		return $c_username;
	}
function update_cart($rowid,$qty,$price,$amount,$totalbv,$totalpv) {
 		$data = array(
			'rowid'   => $rowid,
			'qty'     => $qty,
			'price'   => $price,
			'amount'   => $amount,
			'bv'   => $totalbv,
			'pv'   => $totalpv
		);

		return $this->cart->update($data);
	}
public function get_product_rate($productid)	
	{
		$price="";
		
		 $sql = "SELECT price from productmaster WHERE mid ='$productid' ";
					 $query = $this->db->query($sql);
					$data= $query->result_array() ;
					if($data){
							$price = $data[0]['price'];
					  }
		
		return $price;
	}
public function get_category_name($categoryid)	
	{
		$c_category_name="";
		
		 $sql = "SELECT c_category_name from category WHERE n_categoryid ='$categoryid' ";
					 $query = $this->db->query($sql);
					$data= $query->result_array() ;
					if($data){
							$c_category_name = $data[0]['c_category_name'];
					  }
		
		return $c_category_name;
	}
public function get_category_name_by_productid($productid)	
	{
		$c_category_name="";
		if($productid){
		 $sql2 = "SELECT n_category from productmaster WHERE mid ='$productid' ";
					 $query2 = $this->db->query($sql2);
					$data2= $query2->result_array() ;
					if($data2){
							$n_category = $data2[0]['n_category'];
					}
					if($n_category){
		 $sql = "SELECT c_category_name from category WHERE n_categoryid ='$n_category' ";
					 $query = $this->db->query($sql);
					$data= $query->result_array() ;
					if($data){
							$c_category_name = $data[0]['c_category_name'];
					  }
					}
		}
		return $c_category_name;
	}
	
	public function get_product_code($id)
	{
		$sql2= "SELECT c_product_code FROM product_master WHERE n_product_id='$id'";
		$query = $this->db->query($sql2);
		$rslt=$query->result_array();
		if($rslt)
		{
			return  $rslt[0]['c_product_code'];
		 }
	}
	
	public function get_product_type($productid)	
	{
		$product_name="";
	 $sql = "SELECT c_product_name,c_product_type from product_master WHERE n_product_id ='$productid' ";
		
		$result2 = $this->login_db->get_results($sql);
		if($result2)
		{
			foreach($result2 as $row)
			{
				$c_product_type = $row->c_product_type;
			}
		}
		return $c_product_type;
	}

	
	///
}
?>