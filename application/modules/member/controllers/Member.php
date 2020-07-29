<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		
	}
	
	public function index()
	{
	   	if (!$this->session->userdata('id'))
		{
			redirect(base_url());
		}else{
			
			$data['title'] = 'Login';
			$this->load->view('member/tpl_member',$data);

		}
	}
	
	function Logout()
	{
		$array_items = array(
				'id',
				'nama',
				'email',
				'nomor_telepon',
				'lisensi',
				'status'
			);

		$this->session->unset_userdata($array_items);
		$this->success('behasil');
	}
}

