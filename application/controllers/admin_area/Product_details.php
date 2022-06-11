<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_details extends CI_Controller {

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

	
		public function add_product()
	{
	    $this->load->view('admin_area/header');
	    $this->load->view('admin_area/add_product');
	}
	
	public function product_insert()
	{
	$this->form_validation->set_rules('c_product_name', 'c_product_name', 'trim|required|xss_clean');
	$this->form_validation->set_rules('brand', 'brand', 'trim|required|xss_clean');
    $this->form_validation->set_rules('hsn_code', 'hsn_code', 'trim|required|xss_clean');
	$this->form_validation->set_rules('description', 'description', 'trim|required|xss_clean');
	$this->form_validation->set_rules('supplier_name', 'supplier_name', 'trim|required|xss_clean');

                if ($this->form_validation->run() == FALSE)
                {
                        echo "1";
						echo validation_errors(); 
						exit;
                }			
			else
			{
					     $selected_attributes=array();
					     $stock=array();
					     $price=array();
					     $mrp=array();
					     $tax=array();
		                 $c_product_name  = $this->input->post('c_product_name'); 
						 $category  = $this->input->post('category'); 
						 $cat = implode(",", $category);
						 $brand  = $this->input->post('brand'); 
						 $hsn_code  = $this->input->post('hsn_code'); 
						 $description  = $this->input->post('description'); 
						 $supplier_name  = $this->input->post('supplier_name');
						 $mainimage  = $this->input->post('mainimage');
						 $product_code  = $this->input->post('product_code');
						 $c_product_role  = $this->input->post('c_product_role');
				
						 if(sizeof($mainimage)==0)
						 {
							 echo "5";
						     exit;
						 }

						 $images  = $this->input->post('img');
						 $status='A';
						 $pcode=substr($c_product_name, 0, 3);
						 $selected_attributes  = $this->input->post('selected_attributes');
				
						 if(sizeof($selected_attributes)>0)
				            {
					     $selected_attributes=array_unique($selected_attributes);
							}	
							
											
						  $productdata = array(
                               'c_product_name'      => $c_product_name,
                               'n_category'     => $cat,
	                           'n_brand_id'   => $brand,
	                           'n_hsncode'    => $hsn_code,
	                           'c_description'    => $description, 
	                           'c_supplier_name'    => $supplier_name,
	                           'c_product_code'    => $product_code, 
		                           'c_status'    => $status);						   
							   
                    $this->db->trans_begin();
                    $this->db->insert('product_master',$productdata);
					//echo $this->db->last_query();
                    $insert_id = $this->db->insert_id();
					
							 for($i=0;$i<sizeof($mainimage);$i++)
					{
						$imagedata = array(
						       'c_image'      => $mainimage[$i],
						       'n_product_id'      => $insert_id,
						       'c_status'      => 'A');
						$this->db->insert('product_images',$imagedata);	  
						
					$rrr =	$this->db->last_query();
					//print_r($rrr);
					}
                
  
                
                 //////attribute insertion//////
                if(sizeof($selected_attributes)>0) 
                {
                foreach($selected_attributes as $field)
                {
                $attributes1[]  = $this->input->post($field);
                
                }
                
                    $images  = $this->input->post('img');
                    $j=0;
                    for($i=0;$i<sizeof($images);$i++)
                    {						
                        $m=0;
                        if(isset($attributes1[$m][$i]))
                        {
                            foreach($attributes1 as $row1)
                            {
                                $attributes2[$j][]=$attributes1[$m][$i];
                                $m++;
                            }
                            $j++;
                        }
                    
                    }
                
                    foreach($attributes2 as $attr)
                    {
                        $res[]=implode(",",$attr);
                    }
           
                    //print_r($images);
                    for($i=0;$i<sizeof($images);$i++)
                    {
                        $attributedata = array(
                        'n_product_id'      => $insert_id,
                        'n_attributes'      => $res[$i],
                        'c_image'    => $images[$i], 
                        'c_status'    => $status);
                        $this->db->insert('product_attribute',$attributedata);						 
                    }
                }
                else
                {
                
                    $attributedata = array(
                    'n_product_id'      => $insert_id,
                    'n_attributes'      => '0',
                    'c_status'    => $status);
                    $this->db->insert('product_attribute',$attributedata);	 
                
                }

		
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
			    echo "error";
				
			}
			else
			{
				$this->db->trans_commit();
				$newdata = array(
                   'new_product_id'  => $insert_id);
				$this->session->set_userdata($newdata);
			    echo "success";
				
			}

		 
		}
	}
	
	
			public function attributes_view()
	{
		$ids = $this->input->post('approve_users');
		$data['id'] = $ids;
	    $this->load->view('admin_area/attribute_view', $data);
	}
	
			public function attributes_views()
	{
		$ids = $this->input->post('approve_users');
		$data['id'] = $ids;
	    $this->load->view('admin_area/attribute_views', $data);
	}
	
	
	public function upload_photo()
	{
	   //	echo product_image_path;
	   		
	   			if($_FILES['file']['error'] == 0){
				//upload and update the file
				
				$_FILES['file']['name'];
				$extarray = explode(".", $_FILES['file']['name']);
				$extension = end($extarray);
				$filename = rand().time().'.'.$extension;
				$config['upload_path'] = product_image_path;
				$config1['quality']         = '100%';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['overwrite'] = false;
				$config['remove_spaces'] = true;
				$config['file_name'] = $filename;

				$this->load->library('upload', $config);

				if ( ! $this->upload->do_upload('file'))
				{
					 print_r($this->upload->display_errors('', ''));
					 
				$error = true;
		 	      echo "2";
		           exit;
					
				}
				
				else
				{
			
	            $folder[1] = '300X300';	$width[1] = '300';$height[1] = '300';
                $status = $this->fetch_model->image_creation(product_image_path.$filename,product_image_path.$folder[1],$width[1],$height[1],'ratio');
                $folder[1] = '600X600';	$width[1] = '600';$height[1] = '600';
                $status = $this->fetch_model->image_creation(product_image_path.$filename,product_image_path.$folder[1],$width[1],$height[1],'ratio');
			  	$folder[1] = '700X700';	$width[1] = '700';$height[1] = '700';
                $status = $this->fetch_model->image_creation(product_image_path.$filename,product_image_path.$folder[1],$width[1],$height[1],'ratio');
				echo $filename;
		    	}
	}
		
}


	public function upload_attr_photo()
	{
			$id = $this->input->post('id');
	   			if($_FILES['file']['error'] == 0){
				//upload and update the file
				
				$_FILES['file']['name'];
				$extarray = explode(".", $_FILES['file']['name']);
				$extension = end($extarray);
				$filename = rand().time().'.'.$extension;
				$config['upload_path'] = product_image_path;
				$config1['quality']         = '100%';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['overwrite'] = false;
				$config['remove_spaces'] = true;
				$config['file_name'] = $filename;

				$this->load->library('upload', $config);

				if ( ! $this->upload->do_upload('file'))
				{
					 //print_r($this->upload->display_errors('', ''));
					 
				$error = true;
		 	      echo "2";
		           exit;
					
				}
				
				else
				{
			
	            $folder[1] = '300X300';	$width[1] = '300';$height[1] = '300';
                $status = $this->fetch_model->image_creation(product_image_path.$filename,product_image_path.$folder[1],$width[1],$height[1],'ratio');				
			  	$folder[1] = '700X700';	$width[1] = '700';$height[1] = '700';
                $status = $this->fetch_model->image_creation(product_image_path.$filename,product_image_path.$folder[1],$width[1],$height[1],'ratio');
				
				
				  $this->db->trans_begin();
							   $attrdata = array(
						       'c_image'      => $filename);
					     $this->db->set($attrdata); 
                         $this->db->where("n_attribute_id", $id); 
                         $this->db->update("product_attribute", $attrdata); 	
		if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
			    echo "error";

			}
			else
			{
				$this->db->trans_commit();
			    echo $filename;

			}

		    	}
	}
		
}
		public function product_list()
	{
	      $search=$this->input->post('search');
	  
		  $attach = "";
		  if($search!="")
			$attach= $attach." and c_product_name LIKE '%$search%' or c_product_code LIKE '%$search%'";
			
		$sql="select count(*) as cnt from product_master where c_status IN ('A','C') ".$attach." order by n_product_id";
		
		$result1 = $this->login_db->get_results($sql);
		
		  foreach($result1 as $row)
		  {
			  $cnt = $row->cnt;
		  }
		         
			$config = array();
            $limit_per_page = 25;
            $total_records = $cnt;
     
            $config['base_url'] = base_url() . 'product_list';
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
         $sql1="select * from product_master where c_status IN ('A','C') ".$attach." order by c_product_name asc limit $page,$limit_per_page";
		
		$result = $this->login_db->get_results($sql1);
		$data["result"]=$result;
        $this->pagination->initialize($config);
			
        $data["links"] = $this->pagination->create_links();  
		if($this->input->post('ajax')) 
		{
		 $this->load->view('admin_area/product_ajax',$data);
	    } 
	    else
		{	
			$this->load->view('admin_area/header');
			$this->load->view('admin_area/product_list',$data);

        }
	
	}
	
	
			public function edit_product($id)
	{
		
		$data['id'] = $id;
		$this->load->view('admin_area/header');
		$this->load->view('admin_area/edit_product',$data);
	}
	public function product_update()
	{
	
	$this->form_validation->set_rules('c_product_name', 'c_product_name', 'trim|required|xss_clean');
	$this->form_validation->set_rules('c_product_type', 'c_product_type', 'trim|required|xss_clean');
	$this->form_validation->set_rules('brand', 'brand', 'trim|required|xss_clean');
	$this->form_validation->set_rules('hsn_code', 'hsn_code', 'trim|required|xss_clean');
	$this->form_validation->set_rules('description', 'description', 'trim|required|xss_clean');
	$this->form_validation->set_rules('supplier_name', 'supplier_name', 'trim|required|xss_clean');
		
		 if ($this->form_validation->run() == FALSE)
                {
                        echo "1";
						//echo validation_errors(); 
					
					
					
						exit;
                }			
			else
			{
					    
						date_default_timezone_set('Asia/Kolkata');	
		 				$today=date('Y-m-d H:i:s');
						 $selected_attributes=array();
					     $stock=array();
					     $price=array();
					     $mrp=array();
					     $tax=array();
						 $product_id  = $this->input->post('product_id');
						 $c_product_type  = $this->input->post('c_product_type');
		                 $c_product_name  = $this->input->post('c_product_name'); 
						 $category  = $this->input->post('category'); 
						 $cat = implode(",", $category);
						 $brand  = $this->input->post('brand'); 
						 $hsn_code  = $this->input->post('hsn_code'); 
						 $description  = $this->input->post('description'); 
						 $supplier_name  = $this->input->post('supplier_name');
						 $mainimage  = $this->input->post('mainimage');
						 $product_code  = $this->input->post('product_code');

						 $images  = $this->input->post('img');
						 $status='A';
						 $pcode=substr($c_product_name, 0, 3);
						 $selected_attributes  = $this->input->post('selected_attributes');
						
						 $selected_filters  = $this->input->post('selected_filters');
						 if(sizeof($selected_attributes)>0)
				            {
					        $selected_attributes=array_unique($selected_attributes);
					       
							}
						
						  $productdata = array(
                               'c_product_name'      => $c_product_name,
                               'n_category'     => $cat,
	                           'n_brand_id'   => $brand,
	                           'n_hsncode'    => $hsn_code,
	                           'c_description'    => $description, 
	                           'c_supplier_name'    => $supplier_name,
	                           'c_product_code'    => $product_code,
							   'c_product_type'    => $c_product_type, 
	                           'c_status'    => $status,
							   'd_edit'=>$today);						   
							   
                          $this->db->trans_begin();
                          $this->db->set($productdata); 
                          $this->db->where("n_product_id", $product_id); 
                          $this->db->update("product_master",$productdata); 
					
							 for($i=0;$i<sizeof($mainimage);$i++)
					{
						$imagedata = array(
						       'c_image'      => $mainimage[$i],
						       'n_product_id'      => $product_id,
						       'c_status'      => 'A');
						$this->db->insert('product_images',$imagedata);	   
						
					$ff = 	$this->db->last_query();
				
					}
					
					

			  if(!empty($selected_attributes))  //////attribute insertion//////
				   {
					 
					// echo "ggg";  
				   	 	 foreach($selected_attributes as $field)
					{
					    
					    
				
						$attributes1[]  = $this->input->post($field);
			//	print_r($attributes1);
					}
					$images  = $this->input->post('img');
					$j=0;
					
					 for($i=0;$i<sizeof($images);$i++)
					{						
						$m=0;
						if(isset($attributes1[$m][$i]))
						{
						foreach($attributes1 as $row1)
						{

							 $attributes2[$j][]=$attributes1[$m][$i];
							$m++;
						}
						   $j++;
						}
						
					}
//	print_r($attributes2);
					foreach($attributes2 as $attr)
					{
						$res[]=implode(",",$attr);

					}

					
					
					
				//	print_r($res);
					for($i=0;$i<sizeof($images);$i++)
					{
						$attributedata = array(
						       'n_product_id'      => $product_id,
						       'n_attributes'      => $res[$i],
	                           'c_image'    => $images[$i], 
	                           'c_status'    => $status);

					 $this->db->insert('product_attribute',$attributedata);						 
					}
				   }
				  
			
							
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
	}
	
	
	
		public function deactivate_product()
	{
		 $id = $this->input->post('id');
		 $update  = "update product_attribute set c_status = 'C' where n_attribute_id = '$id'";
         $this->db->query($update);
		 $update  = "update product_price set c_status = 'C' where n_attribute_id = '$id'";
         $this->db->query($update);
		 
		   $this->db->trans_begin();
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
	
		public function activate_product()
	{
		 $id = $this->input->post('id');
		 $update  = "update product_attribute set c_status = 'A' where n_attribute_id = '$id'";
		 $this->db->query($update);		
		 $update  = "update product_price set c_status = 'A' where n_attribute_id = '$id'";
		 $this->db->query($update);
		 
		   $this->db->trans_begin();
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
	
		public function product_deactivate()
	{
		 $id = $this->input->post('id');
		 $update  = "update product_master set c_status = 'C' where n_product_id = '$id'";
         $this->db->query($update);
		 $update1  = "update product_attribute set c_status = 'C' where n_product_id = '$id'";
         $this->db->query($update1);
		 $update2  = "update product_price set c_status = 'C' where n_product_id = '$id'";
         $this->db->query($update2);
		 $update21  = "update stock_master set c_status = 'C' where n_product_id = '$id'";
         $this->db->query($update21);
		 $update3  = "update product_images set c_status = 'C' where n_product_id = '$id'";
         $this->db->query($update3);
		 
		   $this->db->trans_begin();
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
	
		public function product_activate()
	{
	   	 $id = $this->input->post('id');
		 $update  = "update product_master set c_status = 'A' where n_product_id = '$id'";
         $this->db->query($update);
		 $update1  = "update product_attribute set c_status = 'A' where n_product_id = '$id'";
         $this->db->query($update1);
		 $update2  = "update product_price set c_status = 'A' where n_product_id = '$id'";
         $this->db->query($update2);
		 $update21  = "update stock_master set c_status = 'A' where n_product_id = '$id'";
         $this->db->query($update21);
		 $update3  = "update product_images set c_status = 'A' where n_product_id = '$id'";
         $this->db->query($update3);
		 
		   $this->db->trans_begin();
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
	
	
		 public function remove_image()
	{
		 $id =    $this->input->post('id');
		 $img =    $this->input->post('type');
		 
		 $qrwy = "update product_images set c_status='C' where n_id='$id'";
		 $this->db->query($qrwy);
	
		  $this->db->trans_begin();
		  
		  if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				echo "error";
				
			}
			else
			{
				$this->db->trans_commit();
                $path = product_image_path.$img;
                unlink($path);
                $path1 = product_image_path.'300X300'.$img;
                unlink($path1);
                $path2 = product_image_path.'700X700'.$img;
                unlink($path2);
			    echo "success";

			}	
	}
	
	
	
	
}
