<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_details extends CI_Controller {

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
	 
	 
	function __construct()
	{
	     parent::__construct();
	     $this->load->helper('url');
		 $this->load->helper('string');
		 $this->load->helper('security');
		 $this->load->helper('html');
	     $this->load->model('fetch_model');
		 $this->load->model('action_model');
		 $this->load->model('login_db');
         $this->load->helper(array('form', 'url'));
		 $this->load->library('form_validation');
		 $this->load->library("pagination");
		 
		 		if($this->session->userdata('admin_logged_in'))		
		{
			
		}
		else
		{
		    redirect('admin_login', 'refresh');
		}	
	} 

	
		public function add_stock_price()
	{
	    $this->load->view('admin_area/header');
	    $this->load->view('admin_area/add_stock_price');
	}
	
			public function edit_stock_price($id)
	{
		$data['id'] = $id;
	    $this->load->view('admin_area/header');
	    $this->load->view('admin_area/edit_stock_price',$data);
	}
	
		public function add_offer_category($id)
	{
		$data['id'] = $id;
	    $this->load->view('admin_area/header');
	    $this->load->view('admin_area/add_offers',$data);
	}
	 public function get_product()
	{
		 $count=0;$bb = array();
		 $selectcat = $_REQUEST['selectcat'];
		 $product_list=implode(",",$selectcat);
		 $sql1= "SELECT  n_product_id,c_product_name from product_master where n_category IN ($product_list) and c_status='A'";		
						$bb1= $this->login_db->get_results($sql1);
						if($bb1){
							 foreach($bb1 as $row)
						  {
							$bb[] = array(
							  'id' => $row->n_product_id,
							  'name' => $row->c_product_name
							);
						  }
						}
		 echo json_encode($bb);
	}
	
		 public function get_attributes()
	{
		 $count=0;$bb = array();
		 $selectcat = $_REQUEST['selectcat'];
		 $sql="select * from product_attribute where n_product_id='$selectcat'";	
         $results1 = $this->login_db->get_results($sql);
         if($results1)
				  {
		         foreach($results1 as $rows1)
		           {
                       $attra=array();
					   $n_attribute_id=$rows1->n_attribute_id;
					   $n_attributes=$rows1->n_attributes;
					   if($n_attributes==0)
					   {
						$c_name="no attribute";   
					   }
					   else{
        		  $sql33="select * from shopping_attribute where n_id IN ($n_attributes)";	
                  $result33 = $this->login_db->get_results($sql33);
                   if($result33)
				  {
		         foreach($result33 as $row33)
		           {
					   
				   $attra[] = $row33->c_attribute_name;			

				   }
				  }
           $c_name=implode(",",$attra);
					   }

							$bb[] = array(
							  'id' => $n_attribute_id,
							  'name' => $c_name
							);
	
				   }
				  }
		 echo json_encode($bb);
		 
	}
	
	 public function get_batchcode()
	{
		$count=0;$bb = array();
		 $selectcat = $_REQUEST['selectcat'];
		 $sql1= "SELECT c_batch_code from product_price where n_attribute_id ='$selectcat'";		
						$bb1= $this->login_db->get_results($sql1);
						if($bb1){
							 foreach($bb1 as $row)
						  {
							$bb[] = array(
							  'id' => $row->c_batch_code,
							  'name' => $row->c_batch_code
							);
						  }
						}
		 echo json_encode($bb);
	}
	
		 public function get_details()
	{
		 $count=0;$bb = array();
		 $selectcat = $_REQUEST['selectcat'];
	     $sql1= "SELECT a.c_batch_code,a.d_distributor_price,a.d_mrp,a.d_tax,a.d_expiry_date,b.n_stock from product_price a,stock_master b where a.c_batch_code=b.c_batch_code and a.c_batch_code ='$selectcat' and a.c_status='A'";		
						$bb1= $this->login_db->get_results($sql1);
						if($bb1){
							 foreach($bb1 as $row)
						  {
							$bb[] = array(
							  'batch_code' => $row->c_batch_code,
							  'distributor_price' => $row->d_distributor_price,
							  'mrp' => $row->d_mrp,
							  'tax' => $row->d_tax,
							  'expiry_date' => $row->d_expiry_date,
							  'stock' => $row->n_stock,
							);
						  }
						}
		 echo json_encode($bb);
	}

	 public function price_insert()
	{

	$this->form_validation->set_rules('products', 'products', 'trim|required|xss_clean');
    $this->form_validation->set_rules('attribute', 'attribute', 'trim|required|xss_clean');
	$this->form_validation->set_rules('mrp', 'MRP', 'trim|required|xss_clean');
	$this->form_validation->set_rules('distributor_price', 'distributor_price', 'trim|required|xss_clean');
	$this->form_validation->set_rules('tax', 'tax', 'trim|required|xss_clean');
	$this->form_validation->set_rules('stock', 'stock', 'trim|required|xss_clean');
	$this->form_validation->set_rules('expiry_date', 'expiry_date', 'trim|required|xss_clean');

                if ($this->form_validation->run() == FALSE)
                {
                        echo "1";
						//echo validation_errors(); 
						exit;
                }			
			else
			{
		                 $category  = $this->input->post('category');
						 $cat = implode(",", $category);						 
						 $products  = $this->input->post('products');
						 $attribute  = $this->input->post('attribute');
						 $mrp  = $this->input->post('mrp');
						 $distributor_price  = $this->input->post('distributor_price');
						 $tax  = $this->input->post('tax');
						 $expiry_date  = $this->input->post('expiry_date');
						 $batchcode  = $this->input->post('new_batchcode');
						 $stock  = $this->input->post('stock');
						 $userid=$this->session->userdata('userid');
						 $date=date('Y-m-d');
					
						 $newDate = date("Y-m-d", strtotime($expiry_date));
						 
						$query= "SELECT c_batch_code from product_price where c_batch_code ='$batchcode'";		
						$result= $this->login_db->get_results($query);
						if($result)
						{
							echo "2";
							exit;
						}
						 
						   $pricedata = array(
                               'n_product_id'      => $products,
                               'n_attribute_id'     => $attribute,
	                           'd_distributor_price'   => $distributor_price,
	                           'd_mrp'    => $mrp,
	                           'd_tax'    => $tax, 
	                           'd_date'    => $date, 
	                           'd_expiry_date'    => $newDate, 
	                           'c_batch_code'    => $batchcode, 
	                           'c_status'    => 'A');
							   
	                $this->db->trans_begin();
                    $this->db->insert('product_price',$pricedata);
                    $insert_id1 = $this->db->insert_id();
                            $stockdata = array(
                               'n_product_id'      => $products,
                               'n_attribute_id'     => $attribute,
                               'n_price_id'     => $insert_id1,
	                           'c_batch_code'   => $batchcode,
	                           'n_stock'    => $stock,
	                           'n_added_stock'    => $stock,
	                           'd_date'    => $date, 
	                           'n_creator'    => $userid,
	                           'c_status'    => 'A');

							$logdata = array(
                               'n_user_id'      => $userid,
                               'c_batch_code'     => $batchcode,
	                           'n_product_id'    => $products,
	                           'n_attribute_id'    => $attribute, 
	                           'n_stock'    => $stock,
							   'distributor_price'    => $distributor_price,
							   'd_mrp'    => $mrp,
	                           'tax'    => $tax,
	                           'date_added'    => $date);							   

                    $this->db->insert('stock_master',$stockdata);
                    $this->db->insert('stock_master_log',$logdata);
                    $insert_id = $this->db->insert_id();
					
					if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
			    echo "error";
				
			}
			else
			{
				$this->db->trans_commit();
				$this->session->unset_userdata('new_product_id');
			    echo "success";
				
			}
			}
	}



	 public function price_update()
	{
	//$this->form_validation->set_rules('category', 'category', 'trim|required|xss_clean');
	$this->form_validation->set_rules('products', 'products', 'trim|required|xss_clean');
    $this->form_validation->set_rules('attribute', 'attribute', 'trim|required|xss_clean');
	$this->form_validation->set_rules('mrp', 'prp', 'trim|required|xss_clean');
	$this->form_validation->set_rules('distributor_price', 'distributor_price', 'trim|required|xss_clean');
	$this->form_validation->set_rules('tax', 'tax', 'trim|required|xss_clean');
	$this->form_validation->set_rules('stock', 'stock', 'trim|required|xss_clean');
	$this->form_validation->set_rules('expiry_date', 'expiry_date', 'trim|required|xss_clean');

                if ($this->form_validation->run() == FALSE)
                {
                        echo "1";
						//echo validation_errors(); 
						exit;
                }			
			else
			{

              


		                 $category  = $this->input->post('category');
						 $cat = implode(",", $category);						 
						 $products  = $this->input->post('products');
						 $attribute  = $this->input->post('attribute');
						 $mrp  = $this->input->post('mrp');
						 $distributor_price  = $this->input->post('distributor_price');
						 $tax  = $this->input->post('tax');
						 $expiry_date  = $this->input->post('expiry_date');
						 $batchcode  = $this->input->post('new_batchcode');
						 $stock  = $this->input->post('stock');
					   	 $userid=$this->session->userdata('userid');
						 $date=date('Y-m-d');
						 $newDate = date("Y-m-d", strtotime($expiry_date));
						 
						  $sql="select n_stock,n_stock_id,n_price_id,n_attribute_id from stock_master where c_batch_code ='$batchcode'";
						  $query = $this->db->query($sql);
						  $result = $query->result();
						  if($result)
						  {
                                $old_stock  = $result[0]->n_stock;
                                $n_stock_id = $result[0]->n_stock_id;
                                $n_price_id = $result[0]->n_price_id;
                                $n_attribute_id = $result[0]->n_attribute_id;
						  }
						 
						   $this->db->trans_begin();
						 
						   $pricedata = array(
                               'n_product_id'      => $products,
                               'n_attribute_id'     => $attribute,
	                           'd_distributor_price'   => $distributor_price,
	                           'd_mrp'    => $mrp,
	                           'd_tax'    => $tax,
	                           'd_date'    => $date, 
	                           'd_expiry_date'    => $newDate, 
	                           'c_batch_code'    => $batchcode, 
	                           'c_status'    => 'A');

								 $this->db->set($pricedata); 
                                 $this->db->where("c_batch_code", $batchcode); 
                                 $this->db->update("product_price",$pricedata); 

                            $stockdata = array(
                               'n_product_id'      => $products,
                               'n_attribute_id'     => $attribute,
	                           'c_batch_code'   => $batchcode,
	                           'n_stock'    => $stock,
	                           'n_added_stock'    => $stock,
	                           'd_date'    => $date, 
	                           'n_creator'    => $userid,
	                           'c_status'    =>'A');
							   
							 $logdata = array(
                               'n_user_id'      => $userid,
                               'c_batch_code'     => $batchcode,
	                           'n_product_id'    => $products,
	                           'n_attribute_id'    => $attribute, 
	                           'n_stock'    => $stock,
	                           'date_added'    => $date);
  
                            	//// $this->db->set($stockdata); 
                               //  $this->db->where("c_batch_code", $batchcode); 
                                // $this->db->update("stock_master",$stockdata);  
								
							$logdata = array(
                               'n_user_id'      => $userid,
                               'c_batch_code'     => $batchcode,
	                           'n_product_id'    => $products,
	                           'n_attribute_id'    => $attribute, 
	                           'n_stock'    => $stock,
	                           'distributor_price'    => $distributor_price,
							   'd_mrp'    => $mrp,
	                           'tax'    => $tax,
	                           'date_added'    => $date);
							   
							   $this->db->insert('stock_master_log',$logdata);
							   
							   	$editlogdata = array(
                               'n_user_id'      => $userid,
                               'c_batch_code'     => $batchcode,
	                           'n_product_id'    => $products,
	                           'n_attribute_id'    => $attribute, 
	                           'n_stock'    => $stock,
	                           'distributor_price'    => $mrp,
	                           'mrp'    => $mrp,
	                           'tax'    => $tax,
	                           'date_added'    => $date,
	                           'c_type' =>$c_stock_type,
	                           'n_old_stock' =>$old_stock,
	                           'n_stock_id' =>$n_stock_id,
	                           'n_price_id' =>$n_price_id);
							   $this->db->insert('edit_stock_master_log',$editlogdata);
							   
							   
							   
							   

					
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
			    echo "error";
				
			}
			else
			{
				$this->db->trans_commit();
				$this->session->unset_userdata('new_product_id');
			    echo "success";
				
			}
			}
	}

		public function stock_price_list()
	{
	     $search=$this->input->post('search');
	  
		  $attach = "";
		  $attachs = "";
		  if($search!="")
		$attach= $attach." and (a.c_batch_code LIKE '%$search%' or c.c_product_name LIKE '%$search%')";
		$attachs= $attachs." and c_batch_code LIKE '%$search%'";
			
		$sql="select count(*) as cnt from product_price where c_status IN ('A') ".$attachs;
		
		$result1 = $this->login_db->get_results($sql);
		
		  foreach($result1 as $row)
		  {
			  $cnt = $row->cnt;
		  }
		         
			$config = array();
            $limit_per_page = 25;
            $total_records = $cnt;
     
            $config['base_url'] = base_url() . 'stock_price_list';
            $config['total_rows'] = $total_records;
            $config['per_page'] = 25;
            $config["uri_segment"] = 2;
            $page   = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
		
		    if($page !=0)
		    $page = ($page-1) * $limit_per_page;

            $config['full_tag_open'] = '<ul id="ajax_pagingsearc" class="tsc_pagination tsc_paginationA tsc_paginationA01">';
				$config['full_tag_close'] = '</ul>';
				$config['prev_link'] = '&lt;';
				$config['prev_tag_open'] = '<li>';
				$config['prev_tag_close'] = '</li>';
				$config['next_link'] = '&gt;';
				$config['next_tag_open'] = '<li>';
				$config['next_tag_close'] = '</li>';
				$config['cur_tag_open'] = '<li class="current"><a href="#">';
				$config['cur_tag_close'] = '</a></li>';
				$config['num_tag_open'] = '<li>';
				$config['num_tag_close'] = '</li>';

				$config['first_tag_open'] = '<li>';
				$config['first_tag_close'] = '</li>';
				$config['last_tag_open'] = '<li>';
				$config['last_tag_close'] = '</li>';

				$config['first_link'] = 'FIRST';
				$config['last_link'] = 'LAST';
				 $config['use_page_numbers'] = TRUE;
          $sql1="select a.n_price_id,a.n_product_id,a.n_attribute_id,a.d_distributor_price,a.d_mrp,a.d_tax,a.d_date,a.d_expiry_date,a.c_batch_code,b.n_stock,a.c_status,b.n_added_stock from product_price a,stock_master b,product_master c where a.c_batch_code=b.c_batch_code and a.n_product_id=c.n_product_id and a.c_status IN ('A') and b.n_stock>0  ".$attach." order by c.c_product_name ASC limit $page,$limit_per_page";
	
		
		$result = $this->login_db->get_results($sql1);
		$data["result"]=$result;
        $this->pagination->initialize($config);
			
        $data["links"] = $this->pagination->create_links();  
		if($this->input->post('ajax')) 
		{
		 $this->load->view('admin_area/stock_price_ajax',$data);
	    } 
	    else
		{	
			$this->load->view('admin_area/header');
			$this->load->view('admin_area/stock_price_list',$data);

        }
	
	}
	
				 public function save_offer_category()
	{
		 $offer_cat =    $this->input->post('offer_cat');
		 $expiry_date =    $this->input->post('expiry_dates');
		// $newDate = date("Y-m-d", strtotime($expiry_date));
		 $newDate = date("Y-m-d", strtotime($expiry_date));
		 $p_id =    $this->input->post('p_id');
		 $product_id =    $this->input->post('products');
		
	       		   $offerdata = array(
                               'n_product_id'     => $product_id,
                               'n_price_id'     => $p_id,
	                           'n_offer_category'    => $offer_cat,
	                           'd_expiry_date'    => $newDate, 
	                           'c_status'    => 'A');
							   
		  $this->db->trans_begin();
		  $this->db->insert('product_offers',$offerdata);
		  if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				echo "error";
				
			}
			else
			{
				$this->db->trans_commit();
				
			    echo "success";

			}	
	}
			 public function remove_offer_category()
	{
		$id = $this->input->post('id');
		 $removedata = array('c_status'    => 'C');
		 	  $this->db->trans_begin();
                         $this->db->set($removedata); 
                         $this->db->where("n_id", $id); 
                         $this->db->update("product_offers", $removedata); 	
				 
	
		  if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				echo "error";
				
			}
			else
			{
				$this->db->trans_commit();
				
			    echo "success";
				
			}	
	}
		public function view_offers()
	{
	$pid = $this->input->post('pid');
		?>
		    <table class="table table-hover table-bordered">
                <tr>
                  <th>Offer Category</th>
                  <th>Expiry</th>
                  <th>Action</th>
                </tr>
				<?php
      $sql="select * from product_offers where n_price_id='$pid' and c_status='A'";
		
		$result1 = $this->login_db->get_results($sql);
		if($result1)
		{
		  foreach($result1 as $row)
		  {
			 $n_id = $row->n_id;
			 $n_product_id = $row->n_product_id;
			 $n_offer_category = $row->n_offer_category;
			 $d_expiry_date = $row->d_expiry_date;
			 $c_status = $row->c_status;
			 
			 	 $sql1i="select c_offer_category from product_offer_category where offer_id='$n_offer_category'";	
	                 	 $resultsi = $this->login_db->get_results($sql1i);
						  if($resultsi)
				                {
		                        foreach($resultsi as $rowi)
		                          {
									  $c_offer_category=$rowi->c_offer_category;
				                  }
				                }

?> 
				  <tr>
                  <td><?php echo $c_offer_category; ?></td>
                  <td><?php echo $d_expiry_date; ?></td>
                  <td><button type="button" class="btn btn-default" onclick="remove_offer_category(<?php echo $n_id; ?>)">
              REMOVE OFFER
              </button></td>
				  </tr>
				  <?php	
		  }
		}
?>
	</table>
	<?php
	}
	
	public function stock_exchange()
	{
	    $this->load->view('admin_area/header');
	    $this->load->view('admin_area/stock_exchange');
	}
	
	
	
	public function stock_sale_list()
	{
	     $search=$this->input->post('search');
	  
		  $attach = "";
		  $attachs = "";
		  if($search!="")
		$attach= $attach." and (a.c_batch_code LIKE '%$search%' or c.c_product_name LIKE '%$search%')";
		$attachs= $attachs." and c_batch_code LIKE '%$search%'";
			
	 $sql="select a.n_price_id,a.n_product_id,a.n_attribute_id,a.d_distributor_price,a.d_mrp,a.d_tax,a.d_date,a.d_expiry_date,a.c_batch_code,sum(b.n_stock) n_stock,a.c_status,b.n_added_stock from product_price a,stock_master b,product_master c where a.c_batch_code=b.c_batch_code and a.n_product_id=c.n_product_id and a.c_status IN ('A') ".$attach." group by a.n_product_id,a.n_attribute_id order by c_product_name asc";
	 $q = $this->db->query($sql);
	  $cnt =  $q->num_rows();
		

		         
			$config = array();
            $limit_per_page = 50;
            $total_records = $cnt;
     
            $config['base_url'] = base_url() . 'stock_sale_list';
            $config['total_rows'] = $total_records;
            $config['per_page'] = 50;
            $config["uri_segment"] = 2;
            $page   = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
		
		    if($page !=0)
		    $page = ($page-1) * $limit_per_page;

            $config['full_tag_open'] = '<ul id="ajax_pagingsearc" class="tsc_pagination tsc_paginationA tsc_paginationA01">';
				$config['full_tag_close'] = '</ul>';
				$config['prev_link'] = '&lt;';
				$config['prev_tag_open'] = '<li>';
				$config['prev_tag_close'] = '</li>';
				$config['next_link'] = '&gt;';
				$config['next_tag_open'] = '<li>';
				$config['next_tag_close'] = '</li>';
				$config['cur_tag_open'] = '<li class="current"><a href="#">';
				$config['cur_tag_close'] = '</a></li>';
				$config['num_tag_open'] = '<li>';
				$config['num_tag_close'] = '</li>';

				$config['first_tag_open'] = '<li>';
				$config['first_tag_close'] = '</li>';
				$config['last_tag_open'] = '<li>';
				$config['last_tag_close'] = '</li>';

				$config['first_link'] = 'FIRST';
				$config['last_link'] = 'LAST';
				 $config['use_page_numbers'] = TRUE;
          $sql1="select a.n_price_id,a.n_product_id,a.n_attribute_id,a.d_distributor_price,a.d_mrp,a.d_tax,a.d_date,a.d_expiry_date,a.c_batch_code,sum(b.n_stock) n_stock,a.c_status,b.n_added_stock from product_price a,stock_master b,product_master c where a.c_batch_code=b.c_batch_code and a.n_product_id=c.n_product_id and a.c_status IN ('A') ".$attach." group by a.n_product_id,a.n_attribute_id order by c_product_name asc limit $page,$limit_per_page";
	
		
		$result = $this->login_db->get_results($sql1);
		$data["result"]=$result;
        $this->pagination->initialize($config);
			
        $data["links"] = $this->pagination->create_links();  
		if($this->input->post('ajax')) 
		{
		 $this->load->view('admin_area/stock_sale_list_ajax',$data);
	    } 
	    else
		{	
			$this->load->view('admin_area/header');
			$this->load->view('admin_area/stock_sale_list',$data);

        }
	
	}
	
	public function sales_stock_excel()
	{
	     $search=$this->input->post('search');
	  
		  $attach = "";
		  $attachs = "";
		  if($search!="")
		$attach= $attach." and (a.c_batch_code LIKE '%$search%' or c.c_product_name LIKE '%$search%')";
		$attachs= $attachs." and c_batch_code LIKE '%$search%'";
			

          $sql1="select a.n_price_id,a.n_product_id,a.n_attribute_id,a.d_distributor_price,a.d_mrp,a.d_tax,a.d_bv,a.d_date,a.d_expiry_date,a.c_batch_code,sum(b.n_stock) n_stock,a.c_status,c_product_type,b.n_added_stock from product_price a,stock_master b,product_master c where a.c_batch_code=b.c_batch_code and a.n_product_id=c.n_product_id and a.c_status IN ('A') ".$attach." group by a.n_product_id,a.n_attribute_id order by c_product_name asc";
	
		
		$result = $this->login_db->get_results($sql1);
		$data["result"]=$result;
       
			
       
		 $this->load->view('admin_area/sales_stock_excel',$data);
	    
	
	}
	

	
}
