<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('news_model');
		
	}

	public function index()
	{
		$data = array();
		$data['content'] = 'manage';
		$data['title'] = 'Dashboard';
		$data['news'] = $this->news_model->get(array('kategori' => 'DASHBOARD','status' => 'AKTIF'));
		
		$this->load->view($data['content'],$data);
	}
	
}