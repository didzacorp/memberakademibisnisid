<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('profile_model');
		
	}

	public function index()
	{
		$data = array();
		$data['content'] = 'manage';
		$data['title'] = 'Profile';
		$data['profile'] = $this->profile_model->get($this->session->userdata('id'));
		
		$this->load->view($data['content'],$data);
	}
	
	
}