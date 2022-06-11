<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_area extends CI_Controller {

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

	public function index()
	{
	    $this->load->view('admin_area/header');
	    $this->load->view('admin_area/main');
	}

		public function category_list()
	{
	     $category=$this->input->post('search');

		  $attach = "";
		  if($category!="")
		$attach= $attach." and c_category_name LIKE '%$category%'";

		$sql="select count(*) as cnt from shopping_category where c_status IN ('A','C') ".$attach;

		$result1 = $this->login_db->get_results($sql);

		  foreach($result1 as $row)
		  {
			  $cnt = $row->cnt;
		  }

			$config = array();
            $limit_per_page = 25;
            $total_records = $cnt;

            $config['base_url'] = base_url() . 'category_list';
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
         $sql1="select * from shopping_category where c_status IN ('A','C') ".$attach." limit $page,$limit_per_page";

		$result = $this->login_db->get_results($sql1);
		$data["result"]=$result;
        $this->pagination->initialize($config);

        $data["links"] = $this->pagination->create_links();
		if($this->input->post('ajax'))
		{
		 $this->load->view('admin_area/category_ajax',$data);
	    }
	    else
		{
			$this->load->view('admin_area/header');
			$this->load->view('admin_area/category_list',$data);

        }

	}

			public function add_category()
	{
	    $this->load->view('admin_area/header');
	    $this->load->view('admin_area/add_category');
	}

		   public function add_attribute()
	{
	    $this->load->view('admin_area/header');
	    $this->load->view('admin_area/add_attribute');
	}

		   public function add_filter()
	{
	    $this->load->view('admin_area/header');
	    $this->load->view('admin_area/add_filter');
	}


		public function category_insert()
	{

	   $values       = $this->input->post(NULL,TRUE);

	   if($this->input->post('c_category_name') == "")
	   {
		  echo "1";
		  exit;
	   }

	   else{
		 $c_name= $this->input->post('c_category_name');
		$sql="select count(*) as cnt from shopping_category where c_category_name ='$c_name'";
		$result1 = $this->login_db->get_results($sql);
		foreach($result1 as $row)
		  {
			  $cnt = $row->cnt;
		  }
		  if($cnt>0)
		  {
		 echo "2";
		  exit;
		  }

		if($_FILES['image']['error'] == 0){
				//upload and update the file

				$_FILES['image']['name'];
				$extarray = explode(".", $_FILES['image']['name']);
				$extension = end($extarray);
				$filename = rand().time().'.'.$extension;
				$config['upload_path'] = './assets/adminarea/images/category/';
				$config1['quality']         = '100%';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['overwrite'] = false;
				$config['remove_spaces'] = true;
				$config['file_name'] = $filename;

				$this->load->library('upload', $config);

				if ( ! $this->upload->do_upload('image'))
				{
					 //print_r($this->upload->display_errors('', ''));

					 $error = true;
		 	      echo "2";
		           exit;

				}

				else
				{

			   $folder[1] = '300X300';	$width[1] = '300';$height[1] = '300';
                $status = $this->fetch_model->image_creation('./assets/adminarea/images/category/'.$filename,'./assets/adminarea/images/category/'.$folder[1],$width[1],$height[1],'ratio');

				}

				$values['image'] = $filename;
			}
			if($this->input->post('n_parent_id') == "Blank")
			{
			   $values['c_display'] =  $this->input->post('c_category_name',true);
			}
		    else
			{

			  $parent  =   explode('*',$this->input->post('n_parent_id'));

			  $values['n_parent_id'] = $parent[0];

			  $values['c_display'] =  $parent[1].'/'.$this->input->post('c_category_name');

			}
		   $this->db->trans_begin();
		   $status = $this->action_model->InsertQuery('shopping_category',$values);
           $insert_id = $this->db->insert_id();

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

		public function edit_category($id)
	{

		$data['id'] = $id;
		$this->load->view('admin_area/header');
		$this->load->view('admin_area/edit_category',$data);
	}

		public function attribute_insert()
	{

	   $c_attribute_name = $this->input->post('c_attribute_name');
	   $n_attribute_group = $this->input->post('n_attribute_group');
	   if( $this->input->post('c_attribute_name') == '' && $this->input->post('n_attribute_group') == '')
	   {

		  echo "1";
		  exit;
	   }
	   
	     for($i=0;$i<sizeof($c_attribute_name);$i++)
	     {
     
         $sql="select count(*) as cnt from shopping_attribute where c_attribute_name='$c_attribute_name[$i]' and n_attribute_group='$n_attribute_group'";

	   	$result1 = $this->login_db->get_results($sql);

		  foreach($result1 as $row)
		  {
			  $cnt = $row->cnt;
		  }
        if($cnt>0)
         {
        echo "2";
        exit;
          }
	     }


		   $this->db->trans_begin();

          for($i=0;$i<sizeof($c_attribute_name);$i++){
		   $query="insert into shopping_attribute (c_attribute_name,n_attribute_group,c_status) values ('$c_attribute_name[$i]','$n_attribute_group','A')";
		   $query1=$this->db->query($query);
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


		public function attribute_list()
	{
	     $category=$this->input->post('search');

		  $attach = "";
		  if($category!="")
			$attach= $attach." and c_attribute_name LIKE '%$category%'";


		 $sql="select count(*) as cnt from shopping_attribute where c_status IN ('A','C') ".$attach;

		$result1 = $this->login_db->get_results($sql);

		  foreach($result1 as $row)
		  {
			  $cnt = $row->cnt;
		  }

			$config = array();
            $limit_per_page = 25;
            $total_records = $cnt;

            $config['base_url'] = base_url() . 'attribute_list';
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
         $sql1="select * from shopping_attribute where c_status IN ('A','C') ".$attach." order by n_attribute_group limit $page,$limit_per_page";

		$result = $this->login_db->get_results($sql1);
		$data["result"]=$result;
        $this->pagination->initialize($config);

        $data["links"] = $this->pagination->create_links();
		if($this->input->post('ajax'))
		{
		 $this->load->view('admin_area/attribute_ajax',$data);
	    }
	    else
		{
			$this->load->view('admin_area/header');
			$this->load->view('admin_area/attribute_list',$data);

        }

	}

			public function edit_attribute($id)
	{

		$data['id'] = $id;
		$this->load->view('admin_area/header');
		$this->load->view('admin_area/edit_attribute',$data);

	}

	public function update_attribute()
	{
		 $values       = $this->input->post(NULL,TRUE);
		 $c_attribute_name=$this->input->post('c_attribute_name');
		 $n_attribute_group=$this->input->post('n_attribute_group');
		   if($this->input->post('c_attribute_name') == '' )
	   {

		  echo "1";
		  exit;
	   }
	   

         $this->db->trans_begin();
         $sql="select count(*) as cnt from shopping_attribute where c_attribute_name='$c_attribute_name' and n_attribute_group='$n_attribute_group'";

	   	$result1 = $this->login_db->get_results($sql);

		  foreach($result1 as $row)
		  {
			  $cnt = $row->cnt;
		  }
        if($cnt>0)
         {
        echo "2";
        exit;
          }

		 $status = $this->action_model->UpdateQuery('shopping_attribute',$values,'n_id',$values['n_id']);

		if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
	              echo "error";
                exit;
			}
			else
			{
				$this->db->trans_commit();
			   echo "success";
                 exit;
			}

	}

		public function edit_filters($id)
	{

		$data['id'] = $id;
		$this->load->view('admin_area/header');
		$this->load->view('admin_area/edit_filter',$data);

	}

	  public function update_filters()
	{
		 $values       = $this->input->post(NULL,TRUE);
		 $c_f_name=$this->input->post('c_filter_name');
		 $n_parent_filter=$this->input->post('n_parent_filter');
		 	   if($this->input->post('c_filter_name') == '' )
	   {

		  echo "1";
		  exit;
	   }
	   

         $this->db->trans_begin();
         $sql="select count(*) as cnt from shopping_filter where c_filter_name='$c_f_name' and n_parent_filter='$n_parent_filter'";

	   	$result1 = $this->login_db->get_results($sql);

		  foreach($result1 as $row)
		  {
			  $cnt = $row->cnt;
		  }
        if($cnt>0)
         {
        echo "2";
        exit;
          }

		 $status = $this->action_model->UpdateQuery('shopping_filter',$values,'n_id',$values['n_id']);


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

	public function activate_category()
	{
		 $id = $this->input->post('id');
		 $update  = "update shopping_category set c_status = 'C' where n_id = '$id'";
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

		public function deactivate_category()
	{
		$id = $this->input->post('id');
		 $update  = "update shopping_category set c_status = 'A' where n_id = '$id'";
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


			public function activate_filters()
	{
		$id = $this->input->post('id');
		 $update  = "update shopping_filter set c_status = 'A' where n_id = '$id'";
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

			public function deactivate_filters()
	{
		 $id = $this->input->post('id');
		 $update  = "update shopping_filter set c_status = 'C' where n_id = '$id'";
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

		public function deactivate_attribute()
	{
		 $id = $this->input->post('id');
		 $update  = "update shopping_attribute set c_status = 'C' where n_id = '$id'";
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

		public function activate_attribute()
	{
		$id = $this->input->post('id');
		 $update  = "update shopping_attribute set c_status = 'A' where n_id = '$id'";
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


		public function filters_list()
	{
	     $search=$this->input->post('search');
		// $state=$this->input->post('state');

		  $attach = "";
		  if($search!="")
			$attach= $attach." and c_filter_name LIKE '%$search%'";
		//if($district !="")
			//$attach= $attach." and n_district='$district'";


		 $sql="select count(*) as cnt from shopping_filter where c_status IN ('A','C') ".$attach;

		$result1 = $this->login_db->get_results($sql);

		  foreach($result1 as $row)
		  {
			  $cnt = $row->cnt;
		  }

			$config = array();
            $limit_per_page = 25;
            $total_records = $cnt;

            $config['base_url'] = base_url() . 'filters_list';
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
         $sql1="select * from shopping_filter where c_status IN ('A','C') ".$attach." limit $page,$limit_per_page";

		$result = $this->login_db->get_results($sql1);
		$data["result"]=$result;
        $this->pagination->initialize($config);

        $data["links"] = $this->pagination->create_links();
		if($this->input->post('ajax'))
		{
		 $this->load->view('admin_area/filter_ajax',$data);
	    }
	    else
		{
			$this->load->view('admin_area/header');
			$this->load->view('admin_area/filter_list',$data);

        }

	}

		public function filters_insert()
	{

	 $c_filter_name=$this->input->post('c_filter_name');
		 $n_parent_filter=$this->input->post('n_parent_filter');
		 	   if($this->input->post('c_filter_name') == '' )
	   {

		  echo "1";
		  exit;
	   }
	   

         $this->db->trans_begin();
         for($i=0;$i<sizeof($c_filter_name);$i++){
         $sql="select count(*) as cnt from shopping_filter where c_filter_name='$c_filter_name[$i]' and n_parent_filter='$n_parent_filter'";

	   	$result1 = $this->login_db->get_results($sql);

		  foreach($result1 as $row)
		  {
			  $cnt = $row->cnt;
		  }
        if($cnt>0)
         {
        echo "2";
        exit;
          }
           }

		   for($i=0;$i<sizeof($c_filter_name);$i++){
		  $query1="insert into shopping_filter(c_filter_name,n_parent_filter,c_status)values('$c_filter_name[$i]','$n_parent_filter','A')";
           $this->db->query($query1);
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

			public function group_list()
	{
	     $category=$this->input->post('search');
		// $state=$this->input->post('state');

		  $attach = "";
		  if($category!="")
			$attach= $attach." and c_group_name LIKE '%$category%'";
		//if($district !="")
			//$attach= $attach." and n_district='$district'";


		 $sql="select count(*) as cnt from shopping_group_name where c_status IN ('A','C') ".$attach;

		$result1 = $this->login_db->get_results($sql);

		  foreach($result1 as $row)
		  {
			  $cnt = $row->cnt;
		  }

			$config = array();
            $limit_per_page = 25;
            $total_records = $cnt;

            $config['base_url'] = base_url() . 'group_list';
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
         $sql1="select * from shopping_group_name where c_status IN ('A','C') ".$attach." limit $page,$limit_per_page";

		$result = $this->login_db->get_results($sql1);
		$data["result"]=$result;
        $this->pagination->initialize($config);

        $data["links"] = $this->pagination->create_links();
		if($this->input->post('ajax'))
		{
		 $this->load->view('admin_area/group_ajax',$data);
	    }

	    else
		{
			$this->load->view('admin_area/header');
			$this->load->view('admin_area/group_list',$data);

        }

	}

		public function group_insert()
	{
		$c_group_name = $this->input->post('c_group_name');

	   if( $this->input->post('c_group_name') == '')
	   {

			    echo "1";
			     exit;
	   }
	   
	   $sql="select count(*) as cnt from shopping_group_name where c_group_name='$c_group_name'";

		$result1 = $this->login_db->get_results($sql);

		  foreach($result1 as $row)
		  {
			  $cnt = $row->cnt;
		  }
    if($cnt>0)
    {
        echo "2";
        exit;
    }

		   $this->db->trans_begin();

		   $query="insert into shopping_group_name (c_group_name,c_display,c_status) values ('$c_group_name','$c_group_name','A')";
		   $query1=$this->db->query($query);

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
			public function deactivate_group()
	{
		 $id = $this->input->post('id');
		 $update  = "update shopping_group_name set c_status = 'C' where n_id = '$id'";
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

		public function activate_group()
	{
		$id = $this->input->post('id');
		 $update  = "update shopping_group_name set c_status = 'A' where n_id = '$id'";
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

	public function edit_group($id)
	{

		$data['id'] = $id;
		$this->load->view('admin_area/header');
		$this->load->view('admin_area/edit_group',$data);
	}

		public function update_group()
	{
		 $values       = $this->input->post(NULL,TRUE);
		 $c_group_name=$this->input->post('c_group_name');
		 $n_id=$values['n_id'];
	   if( $this->input->post('c_group_name') == '')
	   {

			    echo "1";
			     exit;
	   }
	   
	    $sql="select count(*) as cnt from shopping_group_name where c_group_name='$c_group_name'";

		$result1 = $this->login_db->get_results($sql);

		  foreach($result1 as $row)
		  {
			  $cnt = $row->cnt;
		  }
   /* if($cnt>0)
    {
        echo "2";
        exit;
    }*/

		// $status = $this->action_model->UpdateQuery('shopping_group_name',$values,'n_id',$values['n_id']);
		 
		 $this->db->trans_begin();
			$gdata = array(
				 'c_group_name'      => $c_group_name,
				'c_display'      => $c_group_name);
					     $this->db->set($gdata); 
                         $this->db->where("n_id", $n_id); 
                         $this->db->update("shopping_group_name", $gdata); 	

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


				public function filter_group_list()
	{
	     $search=$this->input->post('search');
		// $state=$this->input->post('state');

		  $attach = "";
		  if($search!="")
			$attach= $attach." and c_f_name LIKE '%$search%'";
		//if($district !="")
			//$attach= $attach." and n_district='$district'";


		 $sql="select count(*) as cnt from shopping_f_group where c_status IN ('A','C') ".$attach;

		$result1 = $this->login_db->get_results($sql);

		  foreach($result1 as $row)
		  {
			  $cnt = $row->cnt;
		  }

			$config = array();
            $limit_per_page = 25;
            $total_records = $cnt;

            $config['base_url'] = base_url() . 'group_list';
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
         $sql1="select * from shopping_f_group where c_status IN ('A','C') ".$attach." limit $page,$limit_per_page";

		$result = $this->login_db->get_results($sql1);
		$data["result"]=$result;
        $this->pagination->initialize($config);

        $data["links"] = $this->pagination->create_links();
		if($this->input->post('ajax'))
		{
		 $this->load->view('admin_area/filter_group_ajax',$data);
	    }

	    else
		{
			$this->load->view('admin_area/header');
			$this->load->view('admin_area/filter_group_list',$data);

        }

	}


		public function deactivate_filter_group()
	{
		 $id = $this->input->post('id');
		 $update  = "update shopping_f_group set c_status = 'C' where n_id = '$id'";
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

		public function activate_filter_group()
	{
		$id = $this->input->post('id');
		 $update  = "update shopping_f_group set c_status = 'A' where n_id = '$id'";
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

	public function edit_filter_group($id)
	{

		$data['id'] = $id;
		$this->load->view('admin_area/header');
		$this->load->view('admin_area/edit_filter_group',$data);
	}

		public function update_filter_group()
	{
		 $values       = $this->input->post(NULL,TRUE);
		 $c_group_name=$this->input->post('c_f_name');
		 
		   if( $this->input->post('c_f_name') == "")
	   {

		 echo "1";
		 exit;
	   }


		   $this->db->trans_begin();
		   
	  $sql="select count(*) as cnt from shopping_f_group where c_f_name='$c_group_name'";

		$result1 = $this->login_db->get_results($sql);

		  foreach($result1 as $row)
		  {
			  $cnt = $row->cnt;
		  }
    if($cnt>0)
    {
        echo "2";
        exit;
    }


		 $status = $this->action_model->UpdateQuery('shopping_f_group',$values,'n_id',$values['n_id']);


		if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				echo "error";

			}
			else
			{
				$this->db->trans_commit();
				if(!isset($values['n_id']))
			    echo "success";

			}

	}

			public function filter_group_insert()
	{
		$c_group_name = $this->input->post('c_group_name');

	   if( $this->input->post('c_group_name') == "")
	   {

		 echo "1";
		 exit;
	   }


		   $this->db->trans_begin();
		   
	  $sql="select count(*) as cnt from shopping_f_group where c_f_name='$c_group_name'";

		$result1 = $this->login_db->get_results($sql);

		  foreach($result1 as $row)
		  {
			  $cnt = $row->cnt;
		  }
    if($cnt>0)
    {
        echo "2";
        exit;
    }

		   $query="insert into shopping_f_group (c_f_name,c_status) values ('$c_group_name','A')";
		   $query1=$this->db->query($query);

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


	public function brand_list()
	{
	     $search=$this->input->post('search');
		// $state=$this->input->post('state');

		  $attach = "";
		  if($search!="")
			$attach= $attach." and c_brand_name LIKE '%$search%'";
		//if($district !="")
			//$attach= $attach." and n_district='$district'";


		 $sql="select count(*) as cnt from shopping_brand where c_status IN ('A','C') ".$attach;

		$result1 = $this->login_db->get_results($sql);

		  foreach($result1 as $row)
		  {
			  $cnt = $row->cnt;
		  }

			$config = array();
            $limit_per_page = 25;
            $total_records = $cnt;

            $config['base_url'] = base_url() . 'brand_list';
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
         $sql1="select * from shopping_brand where c_status IN ('A','C') ".$attach." limit $page,$limit_per_page";

		$result = $this->login_db->get_results($sql1);
		$data["result"]=$result;
        $this->pagination->initialize($config);

        $data["links"] = $this->pagination->create_links();
		if($this->input->post('ajax'))
		{
		 $this->load->view('admin_area/brand_ajax',$data);
	    }

	    else
		{
			$this->load->view('admin_area/header');
			$this->load->view('admin_area/brand_list',$data);

        }

	}


			public function deactivate_brand()
	{
		 $id = $this->input->post('id');
		 $update  = "update shopping_brand set c_status = 'C' where n_id = '$id'";
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

		public function activate_brand()
	{
		$id = $this->input->post('id');
		 $update  = "update shopping_brand set c_status = 'A' where n_id = '$id'";
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

	public function edit_brand($id)
	{

		$data['id'] = $id;
		$this->load->view('admin_area/header');
		$this->load->view('admin_area/edit_brand',$data);
	}

		public function update_brand()
	{
		 $values       = $this->input->post(NULL,TRUE);
		 
		 $c_brand_name = $this->input->post('c_brand_name');
		 $n_id = $this->input->post('n_id');
		 $filename = $this->input->post('c_brand_image');

	   if( $this->input->post('c_brand_name') == "")
	   {

		  echo "1";
		  exit;
	   }



		if($_FILES['c_brand_image']['error'] == 0){
				//upload and update the file

				$_FILES['c_brand_image']['name'];
				$extarray = explode(".", $_FILES['c_brand_image']['name']);
				$extension = end($extarray);
				$filename = rand().time().'.'.$extension;
				$config['upload_path'] = './assets/adminarea/images/brand/';
				$config1['quality']         = '100%';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['overwrite'] = false;
				$config['remove_spaces'] = true;
				$config['file_name'] = $filename;

				$this->load->library('upload', $config);

				if ( ! $this->upload->do_upload('c_brand_image'))
				{
					 print_r($this->upload->display_errors('', ''));

					 $error = true;
		 	      echo "4";
		           exit;

				}

				else
				{

				$folder[1] = '300X300';	$width[1] = '300';$height[1] = '300';

                 $status = $this->fetch_model->image_creation('../assets/adminarea/images/brand/300X300/'.$filename,'../../assets/adminarea/images/brand/300X300/'.$folder[1],$width[1],$height[1],'ratio');

				}

					}
							   $this->db->trans_begin();
							   $branddata = array(
						       'c_brand_name'      => $c_brand_name,
						       'c_image'      => $filename);
					     $this->db->set($branddata); 
                         $this->db->where("n_id", $n_id); 
                         $this->db->update("shopping_brand", $branddata); 	
		 //$status = $this->action_model->UpdateQuery('shopping_brand',$values,'n_id',$values['n_id']);


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

			public function brand_insert()
	{
		$values       = $this->input->post(NULL,TRUE);
		$c_brand_name = $this->input->post('c_brand_name');

	   if( $this->input->post('c_brand_name') == "")
	   {

		  echo "1";
		  exit;
	   }
		if($_FILES['c_brand_image']['error'] == 0){
				//upload and update the file

				$_FILES['c_brand_image']['name'];
				$extarray = explode(".", $_FILES['c_brand_image']['name']);
				$extension = end($extarray);
				$filename = rand().time().'.'.$extension;
				$config['upload_path'] = './assets/adminarea/images/brand/';
				$config1['quality']         = '100%';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['overwrite'] = false;
				$config['remove_spaces'] = true;
				$config['file_name'] = $filename;

				$this->load->library('upload', $config);

				if ( ! $this->upload->do_upload('c_brand_image'))
				{
					 print_r($this->upload->display_errors('', ''));

					 $error = true;
		 	      echo "4";
		           exit;

				}

				else
				{

				$folder[1] = '300X300';	$width[1] = '300';$height[1] = '300';

                 $status = $this->fetch_model->image_creation('../assets/adminarea/images/brand/300X300/'.$filename,'../../assets/adminarea/images/brand/300X300/'.$folder[1],$width[1],$height[1],'ratio');

				}

					}


		   $this->db->trans_begin();
		   
		   $sql="select count(*) as cnt from shopping_brand where c_brand_name='$c_brand_name'";

		$result1 = $this->login_db->get_results($sql);

		  foreach($result1 as $row)
		  {
			  $cnt = $row->cnt;
		  }
		  if($cnt>0)
		  {
		      echo "2";
		      exit;
		  }
		  
		   $query="insert into shopping_brand (c_brand_name,c_image,c_status) values ('$c_brand_name','$filename','A')";
		   $query1=$this->db->query($query);

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
public function update_product_price_stock()
	{
	 /*   $inc=1;$dec=1;
		$k="47";             $l="68";
		for($i=0;$i<20;$i++){*/
		
		
								$productid2=22;       $productid1=37;
		
		echo $qry1   = "UPDATE product_master_copy SET n_product_id='$productid1' WHERE n_product_id='$productid2'";
        $this->db->query($qry1);
		echo "<br><br>";
		echo $qry2   = "UPDATE product_attribute SET n_product_id='$productid1' WHERE n_product_id='$productid2'";
        $this->db->query($qry2);
		echo "<br><br>";
		echo $qry3   = "UPDATE product_price SET n_product_id='$productid1' WHERE n_product_id='$productid2'";
        $this->db->query($qry3);
		echo "<br><br>";
		echo $qry4   = "UPDATE product_images SET n_product_id='$productid1' WHERE n_product_id='$productid2'";
        $this->db->query($qry4);
		echo "<br><br>";
		echo $qry5   = "UPDATE stock_master SET n_product_id='$productid1' WHERE n_product_id='$productid2'";
        $this->db->query($qry5);
		echo "<br><br>";
		echo $qry6   = "UPDATE stock_master_log SET n_product_id='$productid1' WHERE n_product_id='$productid2'";
        $this->db->query($qry6);
		echo "<br><br><br>";
		//$k--;$l--;
		//}
	}
	public function edit_purchased_list($n_bill_no)
	{

		$data['n_bill_no'] = $n_bill_no;

		
	    $this->load->view('admin_area/header',$data);
		$this->load->view('admin_area/edit_purchased_list',$data);
	}
	
/*	public function edit_purchased_list()
	{
	    
	    $n_bill_no = $this->input->post('id');
	  	$data['n_bill_no'] = $n_bill_no;

		
	    $this->load->view('admin_area/header',$data);
		$this->load->view('admin_area/edit_purchased_list',$data);
	}*/
	
	
	public function purchase_update()
	{



		$qnty=$this->input->post('qnty');
		$amnt=$this->input->post('amnt');
		$n_bill_numbr=$this->input->post('n_bill_numbr');
		$n_slno=$this->input->post('n_slno');
		$tax=$this->input->post('tax');

		$this->db->trans_begin();
		$i=0;
		foreach($qnty as $qty)
		{
		    
		    
		    $amount       = $amnt[$i];
		    $bill_number = $n_bill_numbr[$i];
		    $n_slno1      = $n_slno[$i];
		    $tax2      = $tax[$i];
		    
		    	$tax_amount  = ($tax2/100)*$amount;
		    
		    	$tax_amount_deml = number_format((float)$tax_amount, 2, '.', '');
		    		$total_amount = $amount+$tax_amount_deml;
		    
		 $update_status= "UPDATE product_bill_details SET d_mrp='$total_amount',n_stock='$qty',d_tax='$tax2' where n_slno='$n_slno1' and n_bill_numbr='$bill_number'";	

		$this->db->query($update_status);
		
		$i++;
		
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
