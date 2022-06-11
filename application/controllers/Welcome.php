<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Welcome extends CI_Controller {

	function __construct()

		{


			parent::__construct();

			$this->load->library('session');	
			$this->load->helper('date');
			$this->load->library('email');

			$this->load->helper('url');		

			$this->load->library('form_validation');	

			$this->load->model('login_db');

 if($this->session->userdata('admin_logged_in'))
		{

		}
		else
		{
		    redirect('admin_login', 'refresh');
		}

		}	

		public function billing_product_list()


		{
			$cmt=0;
	
			$count=0;
	
			$result = array();
	
			$n_quantity=0;
	
			$vicibfranchiseeuserid = $this->session->userdata('vicibfranchiseeuserid');
		   $n_order_id="";  $d_date="";  $n_product_id="";  $n_quantity=""; $n_sender_id=""; $c_billing_address=""; $n_bill_amt=""; $cmt=0;
	
	
		$searchcontent=$this->input->post('searchcontent');
		$pstokistid=$this->input->post('pstokistid');
	
			$selectedids=$this->input->post('selectedids');
	
			$prdquery="";
		$slcqry = "";
	
	
			?>
	
	   <input type="hidden" id="pstokistid" value="<?php echo $pstokistid;?>" />
	
	   <?php
	
			if($selectedids) $slcqry=' and n_price_productid not in('.$selectedids.')';
	
	
			if($searchcontent) $qry= "and productname like '%$searchcontent%' "; else $qry= "";
	
	$sql1= "SELECT b.n_price_id,b.n_product_id,n_stock,d_mrp,d_distributor_price FROM stock_master a,product_price b WHERE a.n_product_id=b.n_product_id
	
	
			  $prdquery $qry $slcqry  order by n_product_id";
	
			$result1 = $this->login_db->get_results($sql1);
	
			if($result1)
	
			{
			foreach($result1 as $row)
				{
	
					$cmt++;
					$productid=$row->n_product_id;
	
					$productname =  $this->login_db->get_product_name($productid);
	
					$itemcode =  $this->login_db->get_hsn_code($productid);
					$n_quantity=$row->n_stock;	
					$n_slno=$row->n_price_id;
					$unit_price=$row->d_mrp;
					$dp=$row->d_distributor_price;
			?>
	<tr id="p_<?php echo $n_slno;?>">
	
	 <td><?php echo $productname;?></td>
		   <td><?php echo $itemcode;?></td>
		   <td><?php echo $dp;?></td>
		   <td><?php echo $productbv;?></td>
	
		   <td><input type="hidden" id="prd_<?php echo $n_slno;?>" value="<?php echo $productid;?>" />
			<input readonly="readonly" value="<?php echo $n_quantity;?>" id="currentstock<?php echo $n_slno;?>" name="currentstock<?php echo $n_slno;?>" type="text" class="min form-control" placeholder="Current stock"/>
		   </td>
		<td >
	   <input placeholder="Required quantity" id="reqqnty<?php echo $n_slno;?>" name="reqqnty<?php echo $n_slno;?>" type="text" class="max form-control" data-linked="currentstock<?php echo $n_slno;?>" maxlength="5"/>
	   <span id="er<?php echo $n_slno;?>">
	
		</span>
		</td>
	
		<td >
	
			<?php if($n_quantity>0)
	
			{?>
	
			<button class="btn btn-success validate" type="button" id="<?php echo $n_slno;?>"><i class="fa fa-plus"></i> Add product </button><?php 
	
	   }
	 else
	
	   {?> 
	
		<button class="btn btn-danger " type="button" ><i class="fa fa-times"></i> Out of stock</button>
	
		<?php } ?>
	
		   <span id="l_<?php echo $n_slno;?>" class="marginleft">
	
		   </span>
	
		</td>
	
	  </tr><?php  }} else { ?>
		 <tr><td colspan="7">No product found</td></tr>
	<?php 
	
	
			}
	
	
		}
	

	
		public function customer_details_public()


		{
	
			$response_array=array();
	
			$stokist_id = $this->input->post('stokist_id');
	
	
					$sql8="SELECT c_fname,c_lname,c_address1,c_address2 FROM 
	
					address_dtl a,bc_master b where b.c_username='$stokist_id' and a.n_id=b.pn_id";
	
					$c_address1=$c_address2=$c_fname=$c_lname="";
	
					$result8 = $this->login_db->get_results($sql8);
	
					if($result8)
	
	
					{
	
						foreach($result8 as $row8)
	
						{			
	
	
							$c_address1 = $row8->c_address1;
	
							$c_address2 = $row8->c_address2;
	
							$c_fname = $row8->c_fname;
	
							$c_lname = $row8->c_lname;
							
							$response_array['c_address1'] = $c_address1; 
	
							$response_array['c_address2'] = $c_address2; 
	
							$response_array['c_fname'] = $c_fname; 
	
							$response_array['c_lname'] = $c_lname;
	
						}
	
					}	
	
	
			echo json_encode($response_array);
	
		}



		public function billing_franchisee_product_list()
	{

		$cmt=0;

		$count=0;
		$result = array();

		$n_quantity=0;

		$n_order_id="";  $d_date="";  $n_product_id="";  $n_quantity=""; $n_sender_id=""; $c_billing_address=""; $n_bill_amt=""; $cmt=0;

		$searchcontent=$this->input->post('searchcontent');


		$phno=$this->input->post('phno');
		
		
		$selectedids=$this->input->post('selectedids');


		$prdquery="";


		$slcqry = "";


		$itemcode="";



		?>

   <input type="hidden" id="phno" value="<?php echo $phno;?>" />

   <?php


		if($selectedids) $slcqry=' and a.n_price_id not in('.$selectedids.')';


		if($searchcontent) $qry= "and c_product_name like '%$searchcontent%' "; else $qry= "";


 $sql1= "SELECT b.n_price_id,b.n_product_id,n_stock,d_mrp,d_distributor_price,b.n_attribute_id FROM stock_master a,product_price b,product_master c WHERE a.n_product_id=c.n_product_id and a.n_price_id=b.n_price_id and a.c_status='A' and b.c_status='A' and a.n_stock>0 $prdquery $qry $slcqry  order by n_product_id";		

	
		$result1 = $this->login_db->get_results($sql1);
		

		if($result1)

		{


			foreach($result1 as $row)


	    	{


				$cmt++;

				$productid=$row->n_product_id;

				$productname =  $this->login_db->get_product_name($productid);
				$producttype =  $this->login_db->get_product_type($productid);
	
     
				$itemcode =  $this->login_db->get_product_code($productid);

				$n_slno=$row->n_price_id;


				$n_quantity=$row->n_stock;

				$unit_price=$row->d_mrp;

				$dp=$row->d_distributor_price;

				$n_attribute_id=$row->n_attribute_id;


			$attributesSingleArray=array();$n_attributes="";
			$query = "select  n_attributes  from  product_attribute a,product_price b,stock_master c ,product_master d
			where d.n_product_id = b.n_product_id and a.n_product_id = b.n_product_id and b.n_price_id=c.n_price_id and a.n_attribute_id=b.n_attribute_id 
			and c.n_stock>0   and a.n_product_id = '$productid' and a.c_status='A' and b.c_status='A' group by a.n_attribute_id order by b.n_price_id asc " ;
		 
		 		$query3 = $this ->db-> query($query);
	     		$result1=	$query3->result();
	     		
	     		if($result1)
				{
					foreach($result1 as $row1)
					{
						$n_attributes=$row1->n_attributes;
	    			}
	    		}



	    		$attributesSingleArray = explode(',',$n_attributes);
	    		



	?>

    	<tr id="p_<?php echo $n_slno;?>">

   	<!--<td><?php echo $cmt;?></td>-->

       <td><?php echo $productname;?><br>
       	
       	<?php 


       	foreach($attributesSingleArray as $attr)
				{
					$name = "";
		 			$query = "select  c_attribute_name from  shopping_attribute where n_id = '$attr'" ;
					$query3 = $this -> db -> query($query);
		 			$res =  $query3->result();
		 			if(!empty($res))
		   			$name =  $res[0]->c_attribute_name;	
		   			echo $name." " ;
	    		} 

	    		?>
       </td>
              <td><?php echo strtoupper($itemcode);?></td>
       <td><?php echo $unit_price; ?></td>
       <td><?php echo $dp;?></td>


       <td><input type="hidden" id="prd_<?php echo $n_slno;?>" value="<?php echo $productid;?>" />

    <input readonly="readonly" value="<?php echo $n_quantity;?>" id="currentstock<?php echo $n_slno;?>" name="currentstock<?php echo $n_slno;?>" type="text" class="min form-control" placeholder="Current stock"/>

   </td>

    <td >

 <input placeholder="Required quantity" id="reqqnty<?php echo $n_slno;?>" name="reqqnty<?php echo $n_slno;?>" type="text" class="max form-control" data-linked="currentstock<?php echo $n_slno;?>" maxlength="5"/>

 <span id="er<?php echo $n_slno;?>">


   		 </span>

    </td>



    <td >


		<?php if($n_quantity>0)

		{?>

      <button class="btn btn-success validate" type="button" id="<?php echo $n_slno;?>"><i class="fa fa-plus"></i> Add product </button><?php 


   }

    else

   {?> 

      <button class="btn btn-danger " type="button" ><i class="fa fa-times"></i> Out of stock</button>

    <?php } ?>

      <span id="l_<?php echo $n_slno;?>" class="marginleft">

  </span>


    </td>


  </tr><?php  }} else { ?>

     <tr><td colspan="7">No product found</td></tr>

    <?php 

}



	}	

	public function login_check()

	{


		$data = $this->input->post(NULL,TRUE);

		$data['filter_data'] =  $this->consult_model->filter($data); 


    	$details =  $this->consult_model->get_login_data($data['filter_data']);

		if(count($details) == 0)

		{

			$this->session->set_flashdata('msg', 'Invalid Username or Password');

		    redirect(base_url());

		}

	else

		{

			$newdata = array(

         'vicibfranchiseeuserid'  => $details[0]['n_id'],

				   'name'  => $details[0]['c_person_name'],
					 'username'  => $details[0]['c_store_name'],

				   'vicib_franchisee_logged_in' => TRUE

     );



       $this->session->set_userdata($newdata);


			redirect('/login_true');

		}			



	}




}
	
	
	


/* End of file welcome.php */


/* Location: ./application/controllers/welcome.php */