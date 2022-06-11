<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Fetch_model extends CI_Model
{
    
    function image_creation($filename, $folder, $width, $height,$type="")
    {
       $type="";
      /*if($type == "")
	  {
        $config['source_image']     = $folder . '/' . $filename;
        $config['wm_text']          = 'JDQ';
        $config['wm_type']          = 'text';
        $config['wm_font_path']     = './system/fonts/texb.ttf';
        $config['wm_font_size']     = '60';
        $config['wm_font_color']    = '969a99';
        $config['wm_vrt_alignment'] = 'middle';
        $config['wm_hor_alignment'] = 'center';
        $config['wm_padding']       = '20';
		$this->load->library('image_lib', $config);
        $this->image_lib->initialize($config);
        $this->image_lib->watermark();
		if (!$this->image_lib->watermark()) {
           
        } else {
           
            $this->image_lib->clear();
        }


	  }*/




	   $config1['source_image']   = $filename;
        $config1['new_image']      = $folder . '/';
		$config1['maintain_ratio'] = false;
        $config1['width']          = $width;
        $config1['height']         = $height;
		$config1['quality']         = '100%';
        $this->load->library('image_lib', $config1);
        $this->image_lib->initialize($config1);
		if (!$this->image_lib->resize()) {
            return 'error';
        } else {
            return 'success';
            $this->image_lib->clear();
			
        }
        
        
        
    }
	public function get_product_details($name)
	{
        
	
		 $name = addslashes($name);
		 
		 $query = $this->db->query("select n_id,c_product_title
		                            from  product_master where  c_product_title = '$name'
								    ");
		  return $query->result() ;
	}
	public function GetOrderById()
	{
        
	
		 $id = $this->session->userdata('id');
		 
		 $query = $this->db->query("select *,sum(n_grand_total) as sum
		                            from  cart_order_detail where  n_id = '$id' group by n_order_id order by n_slno  desc
								    ");
		  return $query->result() ;
	}
	
	
	public function auto_products($name)
	   {
		
		 $array = array();
		
		 $query = $this->db->query("select n_id,c_product_title
                                    from  product_master where c_status = 'A'
				                    and c_product_title like '%$name%' " 
								    );
		foreach( $query->result_array() as $row)
		{
		  $array[$row['n_id']] = $row['c_product_title'];
		  
		}
		 return $array;  
	  } 
    function select_max_id($tablename)
    {
        $qry   = "select max(id) as maxid  from $tablename ";
        $query = $this->db->query($qry);
        foreach ($query->result() as $row)
            return $row->maxid;
    }
    function otp_generation($phone)
    {
       // $rand = rand(1000, 9999);
	   
	   $rand = 2255;
        return $rand;
    }
	function GetRowCount($tablename, $Where_field, $id)
    {
        $qry   = "select count(*) as cnt  from $tablename where " . $Where_field . " = '$id' ";
        $query = $this->db->query($qry);
        foreach( $query->result() as $row)
		  return $row->cnt;
    }
	function GetActiveStatus($id)
    {
        $qry   = "select C_DISTRIBUTOR_ACTIVE  from bc_master where pn_id= '$id' ";
        $query = $this->db->query($qry);
        foreach( $query->result() as $row)
            return   $row->C_DISTRIBUTOR_ACTIVE;
		
		 
    }
	function GetDiscountPersantage($id)
    {
        
		$persantage = 0;
		$qry   = "select C_DISTRIBUTOR_ACTIVE  from bc_master where pn_id= '$id' ";
        $query = $this->db->query($qry);
		if($query->result())
		{
        foreach( $query->result() as $row)
           $status =    $row->C_DISTRIBUTOR_ACTIVE;
		   
		  $qry   = "select n_persantage  from user_discounts where value= '$status' ";
        $query = $this->db->query($qry);
        foreach( $query->result() as $row)
            $persantage =    $row->n_persantage;
		}
			
		return	$persantage;
			
			
		
		 
    }
	function GetDiscount($id,$price)
    {
       if($id !="")
	   {
		$qry   = "select C_DISTRIBUTOR_ACTIVE  from bc_master where pn_id= '$id' ";
        $query = $this->db->query($qry);
        foreach( $query->result() as $row)
           $status =    $row->C_DISTRIBUTOR_ACTIVE;
		   
		  $qry   = "select n_persantage  from user_discounts where value= '$status' ";
        $query = $this->db->query($qry);
        foreach( $query->result() as $row)
           $persantage =    $row->n_persantage;  
		   
		  
		      $amountRate = ($price*$persantage)/100;
			  $actualPrice = $price-$amountRate;
			  
			 return $actualPrice;
	   }
	   else
	   {
		   return $price;
	   }
		
		 
    }
    function GetShippingCharge($price)
    {
       if($price <= 999)
         $actualPrice = 150;
       elseif( $price <= 2999) 
		$actualPrice = 100;
			  
	else
	    $actualPrice = 0;		 
			 
			 return $actualPrice;
		
		 
    }
	function BulkDiscountPrice($price)
    {
           			
			$discount = ($price*25)/100;
			
			$actualPrice = $price-$discount;
			 return $actualPrice;
		
		 
    }
	
    function GetRowById($tablename, $Where_field, $id)
    {
        $qry   = "select *  from $tablename where " . $Where_field . " = '$id' ";
        $query = $this->db->query($qry);
        return $query->result();
    }
	 function Get_maxinum($tablename, $status, $value)
    {
        $qry   = "select max(id) as maxid  from $tablename where " . $status . " = '$value' ";
        $query = $this->db->query($qry);
        foreach( $query->result() as $row)
		{
			return $row->maxid;
		}
    }
	function Get_Single($tablename,$select, $field, $value)
    {
        $qry   = "select ".$select."   from $tablename where " . $field . " = '$value' ";
        $query = $this->db->query($qry);
        foreach( $query->result() as $row)
		{
			return $row->$select;
		}
    }
	function GetRelated($tablename, $id)
    {
       $array = explode(',',$id);
	   $att =" and ";
	   foreach($array as $val)
	   {
		  $att .= " FIND_IN_SET('$val',n_category ) or ";
	   }
	   $att.= " FIND_IN_SET('$val',n_category )";
	   
	   $qry   = "select *  from $tablename where c_status='A' ".$att. " limit 10";
        $query = $this->db->query($qry);
        return $query->result();
    }
	
    function GetRowByIdAll($tablename, $Where_field, $id, $statusfield, $statusvalue)
    {
        $qry   = "select *  from $tablename where " . $Where_field . " = '$id' and " . $statusfield . "='$statusvalue'  ";
        $query = $this->db->query($qry);
        return $query->result();
    }
    function GetRowByName($tablename, $name)
    {
        $qry   = "select *  from $tablename where name = '$name'";
        $query = $this->db->query($qry);
        return $query->result();
    }
    function GetRowByIdMultiple_Front_All($tablename, $data, $statusfield, $statusvalue, $orderbytype = '', $orderbyfield = "", $start = 0, $limit = "")
    {
        $attach = "";
        if (!empty($data)) {
            foreach ($data as $key => $val) {
                $attach .= " and " . $key . " = '" . $val . "'";
            }
        }
        if ($limit != "")
            $limit = 'limit ' . $start . ',' . $limit;
        else
            $limit = '';
        if ($orderbyfield != "")
            $orderbyfield = 'order by ' . $orderbyfield . ' ' . $orderbytype;
        else
            $orderbyfield = '';
        $qry   = "select *  from $tablename where " . $statusfield . "='$statusvalue'   " . $attach . " " . $orderbyfield . ' ' . $limit;
        $query = $this->db->query($qry);
        
        //print_r($query->result());
        return $query->result();
    }
	
	function GetRows_category_All_pagination($tablename, $data, $start = 0, $limit = "")
    {
        $attach = "";$orderbyfield = '';
        
			
			
        if($data['n_category'] != "")
        {
			 $array = explode(',',$data['n_category']);
			   $attach =" and ( ";
			   foreach($array as $val)
			   {
				  $attach .= " FIND_IN_SET('$val',n_category ) or ";
			   }
			   $attach.= " FIND_IN_SET('$val',n_category ) )";	





        }  
            
       
        if ($limit != "")
            $limit = 'limit ' . $start . ',' . $limit;
        else
          $limit = '';
            
        if ($data['sorting'] !="")
        {   
            if($data['sorting'] == 'name_asc')
              {
                 $orderby = 'c_product_title';
                 $orderbytype = 'asc';
              } 
             elseif($data['sorting'] == 'name_dsc')
              {
                 $orderby = 'c_product_title';
                 $orderbytype = 'desc';
              } 
             elseif($data['sorting'] == 'price_lh')
              {
                 $orderby = 'n_selling_price';
                 $orderbytype = 'asc';
              }
              elseif($data['sorting'] == 'price_hl')
              {
                 $orderby = 'n_selling_price';
                 $orderbytype = 'desc';
              }  

            $orderbyfield = 'order by ' . $orderby . ' ' . $orderbytype;

        }
        if ($data['max_price'] !="")
		{
           $attach .= "  and n_selling_price  between '".$data['min_price']."' and '".$data['max_price']."'  " ;
		}  
        if ($data['c_type'] !="")
		{
           $attach .= "  and c_type='".$data['c_type']."' " ;
		}  

        


          $qry   = "select *  from $tablename where c_status ='A'" . $attach . " " . $orderbyfield . ' ' . $limit;
        $query = $this->db->query($qry);
        return $query->result();
    }
	function GetRows_category_All_paginationCount($tablename, $data)
    {
        $attach = "";
        
			
			if($data['n_category'] != "")
            {
				 $array = explode(',',$data['n_category']);
			   $attach =" and (";
			   foreach($array as $val)
			   {
				  $attach .= " FIND_IN_SET('$val',n_category ) or ";
			   }
			   $attach.= " FIND_IN_SET('$val',n_category ) )";

            } 
            
       
         if ($data['max_price'] !="")
           $attach .= "  and n_selling_price between '".$data['min_price']."' and '".$data['max_price']."'  " ;
        
        $qry   = "select count(* ) as cnt from $tablename where c_status ='A'" . $attach ;
        $query = $this->db->query($qry);
        foreach( $query->result() as $row)
		  return $row->cnt;
    }
	
	
	
	
    public function GetSingledetails($table, $data)
    {
        $attach = "";
        if (!empty($data)) {
            foreach ($data as $key => $val) {
                $attach .= " and " . $key . " = '" . $val . "'";
            }
        }
        $qry   = "select *  from $table where 1=1 " . $attach;
        $query = $this->db->query($qry);
        return $query->result();
    }
    function GetPaginationPost($tablename, $category, $city, $statusfield, $statusvalue,$agefrom,$ageto, $orderbytype = '', $orderbyfield = "", $start = 0, $limit = "", $locs = "",$jobtype="")
    {
        $attach = "";
        if ($locs)
            $attach .= ' and location IN(' . $locs . ')';
		 if ($jobtype !="")
            $attach .= " and job_type ='$jobtype'";
        if ($limit != "")
            $limit = 'limit ' . $start . ',' . $limit;
        else
            $limit = '';
        if ($orderbyfield != "")
            $orderbyfield = 'order by ' . $orderbyfield . ' ' . $orderbytype;
        else
            $orderbyfield = '';
		
		$kmq ="";$kmwhere="";
		
		if($city !="")
		{
			$formattedAddr = str_replace(' ','+',$city);
        //Send request and receive json data by address
        $geocodeFromAddr = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddr.'&sensor=false&key=AIzaSyCUHAmfSyodUWJGyKqCFg7-G2LiTFWv5es'); 
        $output = json_decode($geocodeFromAddr);
		
		
        //Get latitude and longitute from json data
         $lat  = $output->results[0]->geometry->location->lat; 
         $lon = $output->results[0]->geometry->location->lng;
			
			
				$kmq .=' , (3959 * acos (cos ( radians('.$lat.') )* cos( radians( lat ) )* cos( radians( lon ) - radians('.$lon.') )+ sin ( radians('.$lat.') )* sin( radians( lat ) ))) AS distance';
			
			
			$kmwhere .= '  HAVING distance < 60 ';
			
		}
		
		
		if($agefrom != 0 || $ageto !=0)
		{
			  
			  $kmq .= ', YEAR(CURDATE()) - YEAR(dob) AS age ';
			  if($city =="")
			    $kmwhere .= " having age between '$agefrom' and '$ageto' ";
			  else 
			    $kmwhere .= " and age between '$agefrom' and '$ageto' ";
			
		}
		
		
		
		
		
		
        $qry   = "select * ".$kmq."  from $tablename  where " . $statusfield . "='$statusvalue' and (category IN ($category) or sub_category IN ($category) || category3 IN ($category) )  and otp_status = 'Y' " . $attach .$kmwhere. " " . $orderbyfield . ' ' . $limit;
        $query = $this->db->query($qry);
        return $query->result();
    }
    function GetPaginationPostcount($tablename, $category, $city, $statusfield, $statusvalue,$agefrom,$ageto, $orderbytype = '', $orderbyfield = "", $locs = "",$jobtype="")
    {
        $attach = "";
        if ($locs)
            $attach .= ' and location IN(' . $locs . ')';
		 if ($jobtype !="")
            $attach .= " and job_type ='$jobtype'";
		
		$kmq ="";$kmwhere="";
		
		if($city !="")
		{
			$formattedAddr = str_replace(' ','+',$city);
        //Send request and receive json data by address
        $geocodeFromAddr = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddr.'&sensor=false&key=AIzaSyCUHAmfSyodUWJGyKqCFg7-G2LiTFWv5es'); 
        $output = json_decode($geocodeFromAddr);
		
		
        //Get latitude and longitute from json data
         $lat  = $output->results[0]->geometry->location->lat; 
         $lon = $output->results[0]->geometry->location->lng;
			
			
				$kmq .=' , (3959 * acos (cos ( radians('.$lat.') )* cos( radians( lat ) )* cos( radians( lon ) - radians('.$lon.') )+ sin ( radians('.$lat.') )* sin( radians( lat ) ))) AS distance';
			
			
			$kmwhere .= '  HAVING distance < 60';
			
		}
		if($agefrom != 0 || $ageto !=0)
		{
			  
			 $kmq .= ', YEAR(CURDATE()) - YEAR(dob) AS age ';
			  if($city =="")
			    $kmwhere .= " having age between '$agefrom' and '$ageto' ";
			  else 
			    $kmwhere .= " and age between '$agefrom' and '$ageto' ";
 	
		}
		
		
         $qry   = "select count(*) as cnt ".$kmq ."  from $tablename  where " . $statusfield . "='$statusvalue' and (category IN ($category) or sub_category IN ($category) || category3 IN ($category) )  and otp_status = 'Y' " . $attach.$kmwhere;
        $query = $this->db->query($qry);
        foreach ($query->result() as $row)
            return $row->cnt;
    }
    function GetRowByIdMultiple_Front_Allcount($tablename, $data, $statusfield, $statusvalue, $orderbytype = '', $orderbyfield = "", $limit = "")
    {
        $attach = "";
        if (!empty($data)) {
            foreach ($data as $key => $val) {
                $attach .= " and " . $key . " = '" . $val . "'";
            }
        }
        if ($limit != "")
            $limit = 'limit ' . $limit;
        else
            $limit = '';
        if ($orderbyfield != "")
            $orderbyfield = 'order by ' . $orderbyfield . ' ' . $orderbytype;
        else
            $orderbyfield = '';
        $qry   = "select count(*) as cnt  from $tablename where " . $statusfield . "='$statusvalue'   " . $attach . " " . $orderbyfield . ' ' . $limit;
        $query = $this->db->query($qry);
        foreach ($query->result() as $row)
            return $row->cnt;
    }
    public function slugify($text, $id)
    {
        // replace non letter or digits by -        
        $text = $text . ' ' . $id;
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        // transliterate        
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text); // remove unwanted characters    
        $text = preg_replace('~[^-\w]+~', '', $text); // trim        
        $text = trim($text, '-'); // remove duplicated - symbols    
        $text = preg_replace('~-+~', '-', $text); // lowercase    
        $text = strtolower($text);
        if (empty($text)) {
            return 'n-a';
        }
        return $text;
    }
    public function auto_cat($name)
    {
        $array = array();
		
        $query = $this->db->query("select * from  classified_category where status = 'A' and name like '%$name%' and parent_id = 0");
        foreach ($query->result() as $row) {
            $array[$row->category_id] = $row->name;
        }
        return $array;
    }
	public function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}
function GetRowByIdMultiple_Front_AllGroup($tablename,$id, $data, $statusfield, $statusvalue, $orderbytype = '', $orderbyfield = "", $start = 0, $limit = "")
    {
        $attach = "";
        if (!empty($data)) {
            foreach ($data as $key => $val) {
                $attach .= " and " . $key . " = '" . $val . "'";
            }
        }
        if ($limit != "")
            $limit = 'limit ' . $start . ',' . $limit;
        else
            $limit = '';
        if ($orderbyfield != "")
            $orderbyfield = 'order by ' . $orderbyfield . ' ' . $orderbytype;
        else
            $orderbyfield = '';
        $qry   = "select *  from $tablename where " . $statusfield . "='$statusvalue'   " . $attach . " 
           		group by $id " . $orderbyfield . ' ' . $limit;
        $query = $this->db->query($qry);
        return $query->result();
    }
	 function GetRowByIdMultiple_Front_AllcountGroup($tablename,$id, $data, $statusfield, $statusvalue, $orderbytype = '', $orderbyfield = "", $limit = "")
    {
        $attach = "";
        if (!empty($data)) {
            foreach ($data as $key => $val) {
                $attach .= " and " . $key . " = '" . $val . "'";
            }
        }
        if ($limit != "")
            $limit = 'limit ' . $limit;
        else
            $limit = '';
        if ($orderbyfield != "")
            $orderbyfield = 'order by ' . $orderbyfield . ' ' . $orderbytype;
        else
            $orderbyfield = '';
        $qry   = "select count(*) as cnt  from $tablename where " . $statusfield . "='$statusvalue'  group by $id  " . $attach . " " . $orderbyfield . ' ' . $limit;
        $query = $this->db->query($qry);
		
		return $query->num_rows();
        //foreach ($query->result() as $row)
       
     //return $row->cnt;
    }
	function Getchat($tablename, $data, $statusfield, $statusvalue, $orderbytype = '', $orderbyfield = "", $start = 0, $limit = "")
    {
        $attach = "";
        if (!empty($data)) {
			
			$message_from = $data['message_from'];
			$message_to = $data['message_to'];
			
          
                $attach .= " and ((message_from ='$message_from' or message_to = '$message_from') and (message_to ='$message_to' or message_from ='$message_to')) ";
            
        }
        if ($limit != "")
            $limit = 'limit ' . $start . ',' . $limit;
        else
            $limit = '';
        if ($orderbyfield != "")
            $orderbyfield = 'order by ' . $orderbyfield . ' ' . $orderbytype;
        else
            $orderbyfield = '';
        $qry   = "select *  from $tablename where " . $statusfield . "='$statusvalue'   " . $attach . " " . $orderbyfield . ' ' . $limit;
        $query = $this->db->query($qry);
        return $query->result();
    }
		public function GetWalletTransactions($table,$id)
	{
        
	
		
		 
		 $query = $this->db->query("select *
		                            from  ".$table. " where ( n_from_id = '$id' or n_to_id = '$id') order by d_transcation desc
								    ");
		  return $query->result() ;
	}
	
}