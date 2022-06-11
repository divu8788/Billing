<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Updation_controller extends CI_Controller {

	function __construct()


		{

			parent::__construct();

			$this->load->library('session');	

			$this->load->helper('date');
			$this->load->library('email');

			$this->load->helper('url');		

			$this->load->library('form_validation');	

			$this->load->model('Product_billing_db_public','',TRUE);

			$this->load->model('fetch_model');
			
			$this->load->model('login_db');	
			
			$this->load->model('common_db');	
		 if($this->session->userdata('admin_logged_in'))
		{

		}
		else
		{			  
				$response_array['status']='session_expired';
				echo json_encode($response_array);
				exit;
		}



		}	 




public function customer_billing_save_public()
	{
		
		 $phno  = $this->input->post('phno');
		 
	     $productitems  = $this->input->post('productitems');
		 
		 
		
		 $status = $this->Product_billing_db_public->customer_billing_save_public($phno,$productitems);		
	}
}







/* End of file welcome.php */



/* Location: ./application/controllers/welcome.php */