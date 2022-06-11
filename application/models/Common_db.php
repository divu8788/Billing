<?php
Class Common_db extends CI_Model
{
	

	
	//Prepiad coupon validity checking
	function get_joining_count_user($user,$month)
	{
		$query = "select count(*) as cnt from bc_master where N_REF_ID = '$user' and MONTH(D_JOIN) = '$month' 
  		          and  YEAR(D_JOIN) = '".date('Y')."'   ";
		$query3 = $this -> db -> query($query);
		$res =  $query3-> result();
		 
		 return $res[0]->cnt;

		
	}
	
    function GetSelectedAllData($tablename,$selectData, $wheredata, $orderbytype = '', $orderbyfield = "", $start = 0, $limit = "")
    {
        $attach = "";
        if (!empty($wheredata)) {
            foreach ($wheredata as $key => $val) {
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
		if (!empty($selectData)) {
           $select = implode(',',$selectData);
        }
		else
		{
			$select = '*';
		}
		
        $qry   = "select $select  from $tablename where 1=1 " . $attach . " " . $orderbyfield . ' ' . $limit;
        $query = $this->db->query($qry);
        return $query->result();
    }
	function CategoryByIn($data)
    {
        
		
        $qry   = "select n_id,c_category_name from shopping_category where n_id IN($data) and c_status='A' ";
        $query = $this->db->query($qry);
        return $query->result();
    }
	
	function GetProductsByCategory($id,$orderbytype = '', $orderbyfield = "", $start = 0, $limit = "")
	{
		
		  if ($limit != "")
            $limit = 'limit ' . $start . ',' . $limit;
        else
            $limit = '';
        if ($orderbyfield != "")
            $orderbyfield = 'order by ' . $orderbyfield . ' ' . $orderbytype;
        else
            $orderbyfield = '';
		
		 $query = "select  * from  product_master where c_status = 'A' and FIND_IN_SET(".$id.",n_category) ". $orderbyfield . ' ' . $limit;;
		$query3 = $this -> db -> query($query);
		return $query3->result();

		
	}
	function GetProductsByBrand($id,$orderbytype = '', $orderbyfield = "", $start = 0, $limit = "")
	{
		
		  if ($limit != "")
            $limit = 'limit ' . $start . ',' . $limit;
        else
            $limit = '';
        if ($orderbyfield != "")
            $orderbyfield = 'order by ' . $orderbyfield . ' ' . $orderbytype;
        else
            $orderbyfield = '';
		
		 $query = "select  * from  product_master where c_status = 'A' and n_brand_id ='$id' ". $orderbyfield . ' ' . $limit;;
		$query3 = $this -> db -> query($query);
		return $query3->result();

		
	}
	function GetProductsAll($selectData,$orderbytype = '', $orderbyfield = "", $start = 0, $limit = "")
	{
	    if (!empty($selectData)) {
           $select = implode(',',$selectData);
        }
		else
		{
			$select = '*';
		}
		  
		  
		  
		  if ($limit != "")
            $limit = 'limit ' . $start . ',' . $limit;
        else
            $limit = '';
        if ($orderbyfield != "")
            $orderbyfield = 'order by ' . $orderbyfield . ' ' . $orderbytype;
        else
            $orderbyfield = '';
		
		
		$query = "select ".$select." from product_master where c_status='A' " .$limit;
		$query3 = $this -> db -> query($query);
		return $query3->result();
		
	}
	function GetUniquBatch($selectData,$id)
	{
	    if (!empty($selectData)) {
           $select = implode(',',$selectData);
        }
		else
		{
			$select = '*';
		}
		
		 $query = "select ".$select." from product_price a,stock_master b where a.n_product_id=b.n_product_id
            		and a.c_status='A' and b.c_status='A' and a.n_price_id=b.n_price_id and b.n_stock>0
					 and a.n_product_id = '$id' 
					 group by a.n_product_id order by a.n_price_id asc  ";
		$query3 = $this -> db -> query($query);
		return $query3->result();
		
	}
	function GetUniquBatchForOffer($selectData,$id,$priceId)
	{
	    if (!empty($selectData)) 
	    {
           $select = implode(',',$selectData);
        }
		else
		{
			$select = '*';
		}
		
		$query = "select ".$select." from product_price a,stock_master b where a.n_product_id=b.n_product_id  and a.n_price_id=b.n_price_id
            		and a.c_status='A' and b.c_status='A' and b.c_batch_code = a.c_batch_code and b.n_stock>0
					 and a.n_product_id = '$id' and a.n_price_id='$priceId'
					 group by a.n_product_id order by a.n_price_id asc  ";
		$query3 = $this -> db -> query($query);
		return $query3->result();
		
	}
	function GetOffersAllData($type)
	{
		$query = "select a.n_product_id,c_product_name,d_expiry_date,n_price_id from product_master a,product_offers b where a.n_product_id=b.n_product_id and a.c_status ='A' and b.c_status ='A' and n_offer_category='$type' order by RAND() limit 12 ";
		$query3 = $this -> db -> query($query);
		return $query3->result();
		
	}
	function GetDataById($table,$wherefield,$id)
	{

		 $query = "select  * from  $table where $wherefield = '$id'" ;
		$query3 = $this -> db -> query($query);
		return $query3->result();
		
	}
	
	function GetDataByField($table,$field,$wherefield,$id)
	{

		$query = "select  $field from  $table where $wherefield = '$id'" ;
		$query3 = $this -> db -> query($query);
       foreach($query3->result() as $row)
		{
			return $row->$field;
		}	
	}
	function GetAttributesById($id)
	{

		 $query = "select  n_attributes,a.n_attribute_id,c_image,n_price_id from  product_attribute a,product_price b where a.n_product_id = b.n_product_id and a.n_attribute_id=b.n_attribute_id and a.n_product_id = '$id' and a.c_status='A' order by a.n_attribute_id asc " ;
		 $query3 = $this -> db -> query($query);
		 return $query3->result();
		
	}
	function GetAttributesCheck($id)
	{

		 $query = "select  n_attributes,a.n_attribute_id,c_image,n_price_id from  product_attribute a,product_price b where a.n_product_id = b.n_product_id and a.n_attribute_id=b.n_attribute_id and a.n_product_id = '$id'  order by a.n_attribute_id asc " ;
		 $query3 = $this -> db -> query($query);
		 return $query3->result();
		
	}
	
	function GetAttributesName($id)
	{
           $name = "";
		 $query = "select  c_attribute_name from  shopping_attribute where n_id = '$id'" ;
		 $query3 = $this -> db -> query($query);
		 $res =  $query3->result();
		 if(!empty($res))
		   $name =  $res[0]->c_attribute_name;
	     
			 
		 return  $name;
		 
		
	}
	function GetPricesByIds($Attrid,$ProductId)
	{

		 $query = "select  d_distributor_price,d_mrp,n_price_id from  product_price where n_product_id = '$ProductId' and n_attribute_id='$Attrid' " ;
		 $query3 = $this -> db -> query($query);
		 return $query3->result();
		
	}
	function GetStockByIds($priceId,$ProductId)
	{

		 $query = "select  n_stock from  stock_master where n_product_id = '$ProductId' and n_price_id='$priceId' " ;
		 $query3 = $this -> db -> query($query);
		 return $query3->result();
		
	}
	function GetAttributes($ids)
	{
         $array = array();
		 $query = "select  c_attribute_name from  shopping_attribute where n_id in ($ids) " ;
		 $query3 = $this -> db -> query($query);
		 foreach( $query3->result() as $row)
		 {
			$array[] = $row->c_attribute_name;
		 }
		 
		return implode(',',$array);
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
        return $query->result();
    }
	 function GetShippingCharge($price)
    {

	  
	  $amount = 0;
	  /*$qry   = "select amount   from shipping_charge where range_from <=$price and range_to >=$price  ";
        $query = $this->db->query($qry);
        foreach( $query->result() as $row)
		{
			$amount =  $row->amount;
		}*/
		 
			 return $amount;
		
		 
    }
	function GetAttributesImage($id)
	{
         
		 $query = "select  c_image from  product_attribute  where n_attribute_id = '$id' and c_status='A'" ;
		 $query3 = $this -> db -> query($query);
		 return $query3->result();
		
	}
	function GetAttributesSingle($ids)
	{
         $array = array();
		 $query = "select  n_attributes from  product_attribute where n_attribute_id ='$ids' " ;
		 $query3 = $this -> db -> query($query);
		 foreach( $query3->result() as $row)
		 {
			$n_attributes= $row->n_attributes;
		 }
		 $query = "select  c_attribute_name from  shopping_attribute where n_id in ($n_attributes) " ;
		 $query3 = $this -> db -> query($query);
		 foreach( $query3->result() as $row)
		 {
			$array[] = $row->c_attribute_name;
		 }
		 
		return implode(',',$array);
		
	}
	function GetRelatedProducts($id)
	{

		$array = explode(',',$id);
	   $att2 =" and (";
	   foreach($array as $val)
	   {
		  $att2 .= " FIND_IN_SET('$val',n_category ) or ";
	   }
	   $att2.= " FIND_IN_SET('$val',n_category ))";
		  $query = "select   a.n_product_id,c_product_name  from  product_master a  where a.c_status = 'A' ".$att2."   limit 10";
		$query3 = $this -> db -> query($query);
		return $query3->result();

		
	}

}
?>