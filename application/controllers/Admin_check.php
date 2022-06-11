<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_check extends CI_Controller {

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
         $this->load->helper(array('form', 'url'));
		 $this->load->library('form_validation');
	} 

	public function index()
	{
	    $this->load->view('admin_login');
	}
	

	public function login_check()
	{

		$data = $this->input->post(NULL,TRUE);
		$data['password']=md5($data['password']);

		$details =  $this->fetch_model->GetRowByIdMultiple_Front_All('admin',$data,'status','A');
		
		
		if(count($details) == 0)
		 echo "error";
		else
		{
		    
			$newdata = array(
                   'userid'  => $details[0]->id,
				   //'userid'  => $details[0]->id,
				   'name'  => $details[0]->username,
                   'usertype'     =>$details[0]->type,
				   
                   'admin_logged_in' => TRUE
               );

            $this->session->set_userdata($newdata);
			
			
			echo 1;
		}
		
	}

}
