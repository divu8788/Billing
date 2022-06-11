<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start(); //we need to call PHP's session object to access it through CI
class Logout extends CI_Controller {

  function __construct()
  {
    parent::__construct();
	$this->load->library('session');			
	$this->load->helper(array('form', 'url'));
  }

  function index()
  {
			$this->logout();		  
  }
  
  function logout()
  {
    $this->session->unset_userdata('admin_logged_in');
	$this->session->unset_userdata('sess_array');
	$this->session->sess_destroy();
    redirect('admin_login', 'refresh');
  }


}

?>