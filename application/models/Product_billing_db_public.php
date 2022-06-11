<?php 

Class Product_billing_db_public extends CI_Model

{

	public function customer_billing_save_public($phno,$productitems)	

	{

		if($this->session->userdata('we2welife_admin_logged_in'))		

		{

		
		date_default_timezone_set('Asia/Kolkata');

		$todaydatetime= date('Y-m-d H:i:s');

		$currentdateandtime=date('Y-m-d H:i:s');

		$currentdate = date("Y-m-d");

		$response_array=array();

		$attach="";

		$pstock=0;

		$new_total_sales=0;

		$n_total_purchase_amount=0;

		$customerstatus=false;
		
		$ChekPrice=0;
		
			$items=json_decode($productitems);
			//print_r($items);
			//echo "=====".count($items);
			//if(count($items)>0){
				
		function object_to_array($obj)

		{

			$_arr = is_object($obj) ? get_object_vars($obj) : $obj;

			foreach ($_arr as $key => $val)

			{

				$val = (is_array($val) || is_object($val)) ? object_to_array($val) : $val;

				$arr[$key] = $val;

			}

				return $arr;

		}

	$the_array = object_to_array($items);


	$commit_flag=true;

   foreach($the_array as $itemcheck)

					  {
								
						   	 $rqntitycheck=$itemcheck['rqntity'];

							 $n_slnocheck= $itemcheck['sid'];
							
							 $n_pdtcheck= $itemcheck['prdctid'];
							 
							 
				$sqlst="select n_stock_id,n_attribute_id from stock_master where n_price_id='$n_slnocheck' and n_product_id='$n_pdtcheck'";		 
						
				$queryst=$this->db->query($sqlst);
				$resultst=$queryst->result();
				if($resultst)
				{
				    
                 $stockid=$resultst[0]->n_stock_id;
				 $attrid=$resultst[0]->n_attribute_id;

				}					
						
							$sql288="SELECT n_product_id,n_stock from stock_master where n_stock_id='$stockid'";

							$result288 = $this->login_db->get_results($sql288);
							
							if($result288)

							{
								foreach($result288 as $row288)
								{

									 $qtycheck=$row288->n_stock;
									 $productid=$row288->n_product_id;
									
									 $productname= $this->login_db->get_product_name($productid);
														  
									if($qtycheck<1){
										$commit_flag=false;
										$product_error_array[] = array('errorproductname' => $productname);
									}
									else if($rqntitycheck>$qtycheck){
										$product_error_array[] = array('errorproductname' => $productname);
										$commit_flag=false;
									}
									else
										$commit_flag=true;
								}
					    	}
						

					  }
				
	 if(!$commit_flag){
					$response_array['status'] = 'error';
					$response_array['errorproductarray'] = $product_error_array;
					echo json_encode($response_array);
					exit;
	
					}
		
		//CHECKING FOR RESTRICT MULTIPLE BILLING WHEN NET OR SERVER IS SLOW
		//AFTER FIRST INSERT BILLING TIME WILL SET AS SESSION AND NEXT BILLING WILL
		// BE ALLOW ONLY AFTER 20 SECONDS. IF THIS CONDITION COMES PAGE WILL REFRESH AND
		// BILLING PROCESS HAS TO DO AGAIN
		
		    $billing_interval=21;
		
			$maxorderid=0;
			
			$orderMaster = "insert into order_master set n_id='$phno',d_date='$currentdateandtime'";
			$this->db->query($orderMaster);
				
			$orderId =  $this->db->insert_id();


			$InvMaster = "insert into invoice_master set n_order_id='$orderId',d_date='$currentdateandtime'";
				$this->db->query($InvMaster);
				
			$invoiceNo =  $this->db->insert_id();
			
			
			date_default_timezone_set('GMT');
			$temp= strtotime("+5 hours 30 minutes"); 
			$currentdateandtime = date("Y-m-d H:i:s",$temp);
			$currentdate = date("Y-m-d",$temp);	
			$total_n_subtotal = 0;

			$this->db->trans_begin();
			
	
		####################################
				
			$company_state = 'KL';
			
			$transactionid=0;
	 		$sql="SELECT val  FROM maxtab where id='TRANSCATIONID' ";
			$query = $this->db->query($sql);
			$query -> num_rows();
			if($query -> num_rows() >0)
			{			
			   foreach ($query->result() as $row)
			   {
					$transactionid = $row->val;
			   }
			}
            $transactionid = $transactionid+1;
			
			$total_mrp=0;$total_n_subtotal_checking1=0;$n_subtotal_checking1=0;
			
			foreach($the_array as $itemcheck) 
			{
			    

			$n_slnocheck= $itemcheck['sid'];
							 
			 $n_pdtcheck= $itemcheck['prdctid'];

			 $qty = $itemcheck['rqntity'];
			 
			 
			 $qry   = "select c_product_code  from product_master where n_product_id= '$n_pdtcheck' ";
			$query = $this->db->query($qry);
			foreach( $query->result() as $memrow)
			{

				$cproductcode    = $memrow->c_product_code;

			}

			$productname= $this->login_db->get_product_name($n_pdtcheck);
			
			$sqlst="select n_stock_id,n_attribute_id from stock_master where n_price_id='$n_slnocheck'";		 
					
			$queryst=$this->db->query($sqlst);
			$resultst=$queryst->result();
			if($resultst)
			{
			  $stockid=$resultst[0]->n_stock_id;
			  $attrid=$resultst[0]->n_attribute_id;

			}					
		$productName = $productname;
		$attribute   = $attrid;
		$price_id    = $n_slnocheck;

			$selectPrice[] = 'n_stock';
			$selectPrice[] = 'd_tax';
			$selectPrice[] = 'd_distributor_price';
			$selectPrice[] = 'd_mrp';
			$PriceArray = $this->common_db->GetUniquBatchForOffer($selectPrice,$n_pdtcheck,$n_slnocheck);
			 
			$n_subtotal = $PriceArray[0]->d_mrp * $qty;
			$total_n_subtotal = $total_n_subtotal+$n_subtotal;

			
            $productid2=$n_pdtcheck;
			
			$total_price=$PriceArray[0]->d_distributor_price;;
			
			$productqty=$qty;
			$total_qty_price=$productqty*$total_price;

			$n_cgst=0;$n_sgst=0;$n_igst=0;
			$producttax=$PriceArray[0]->d_tax;
			$n_cgst = $producttax/2; 
			$n_sgst = $n_cgst;
			$n_igst=$producttax;
			if($company_state=='KL')
			{
				$c_gst_type_val="gst";
			}
			else
			{
				$c_gst_type_val="igst";
			}

			$customer_details['n_mobile_no']            = $phno;
			$customer_details['c_place']           =  'KL';
			$customer_details['d_date']     = $currentdate;
			$customer_details['d_date_time'] = $currentdateandtime;

   
		   $status = $this->db->insert('customer_details',$customer_details);

		   $customer_id= $this->db->insert_id();


			###################  Cart Orfder Insert ################
			$cartOrder['n_order_id']   = $orderId;
			$cartOrder['n_customer_id']         = $customer_id;
			$cartOrder['n_product_id'] = $n_pdtcheck;
			$cartOrder['n_price_id']   = $price_id;
			$cartOrder['c_product']    = $productName;
			$cartOrder['n_quantity']    = $qty;
			$cartOrder['n_tax']         = $PriceArray[0]->d_tax;
			$cartOrder['n_discount']    = '';
			$cartOrder['n_subtotal']    = $n_subtotal;
			$cartOrder['n_attribute']   = $attribute;
			$cartOrder['n_grand_total'] = $n_subtotal;
			$cartOrder['d_date']        = $currentdateandtime;
			$cartOrder['product_code']  = $cproductcode;
			$cartOrder['c_mode_of_payment']     = 'Shop Purchase';
			$cartOrder['c_invoice_no']      = $invoiceNo;   
			$cartOrder['d_invoice']      = $currentdate;
			$cartOrder['c_order_status']    = 'DELIVERED';
			
	 
			$status = $this->db->insert('cart_order_detail',$cartOrder);
					
			//print_r($cartOrder);	
			
			#######################################################


			################  Update Stock master #############		   

			$qry2   = "update stock_master set n_stock = n_stock - $qty where n_product_id = '$n_pdtcheck' and n_price_id ='$price_id'";
			$this->db->query($qry2);
			###########################################################		   

			
				}

			}

						$totalShipCharge =  0;
                        $nGrandtot = $totalShipCharge+$total_n_subtotal;
                        $discount=0;
                        
                        //$discountPers = $this->common_db->GetDiscountPers($id);
                        
                        //$discount = $this->common_db->GetDiscountRate($nGrandtot,$id);
                        $FinalTotal = $nGrandtot-$discount;
			   
			            $cart_grand_total['n_order_id']            = $orderId;
						$cart_grand_total['n_sub_total']           =  $total_n_subtotal;
						$cart_grand_total['n_shipping_charge']     = $totalShipCharge;
						$cart_grand_total['n_discount_persantage'] = 0;
						$cart_grand_total['n_discount']     = $discount;
						$cart_grand_total['n_grand_total']         = $FinalTotal;
			   
			           $status = $this->db->insert('cart_grand_total',$cart_grand_total);
			      
		
		if ($this->db->trans_status() === FALSE)
				{
        				$this->db->trans_rollback();
        				$response_array['status'] = 'error'; 

				}
				else
				{
				    
        			 $this->db->trans_commit();
        				
        			  $response_array['status'] = 'success'; 
                      $response_array['order_id'] = $orderId; 
			   }


		echo json_encode($response_array);

	

	}

}

?>