<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		
	}

	public function index()
	{
		$data = array();
		$data['content'] = 'main';
		// 
		$this->load->view($data['content'],$data);
	}
}