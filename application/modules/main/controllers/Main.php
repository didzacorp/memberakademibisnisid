<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends MY_Controller {

	function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		// $id_operator = $this->session->userdata('Operator')['idMsOperator'];
		$data = array();
		// $data['name'] = $this->session->userdata('Operator')['LoginName'];
		$data['content'] = 'main';

		$this->load('tpl_users', $data['content'], $data);
	}
}

