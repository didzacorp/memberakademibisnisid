<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Funnel extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		
		// $this->load->model('lokasi/lokasi_model');
		$this->load->model('users.login/member_model');
		$this->load->model('trafic.member/funnel_model');
		$this->load->model('trafic.member/trafic_model');
		
	}

	public function index($funnel='',$username='',$pixel='')
	{
		setcookie("SuryaDutaCookie",session_id(),mktime (0, 0, 0, 12, 31, 3019));
		$data = array();
		$data['content'] = 'manage';
		$data['funnel'] = $funnel;
		$data['username'] = $username;
		$data['pixel'] = $pixel;
		
		$this->load->view($data['content'],$data);
	}

	function saveTrafic()
	{
		$cookie = $this->input->post('cookie');
		$funnel = $this->input->post('funnel');
		$username = $this->input->post('username');
		$pixel = $this->input->post('pixel');
		$urlFunnel = $_SERVER['SERVER_NAME'].'/member.surya.duta/'.'funnel'.'/'.$funnel;
		$dataMember = $this->member_model->get(array("username" => $username));
		$dataFunnel = $this->funnel_model->get(array("link" => $urlFunnel));
		// $dataFunnel = $this->trafic_model->save($data);
		$dataTrafic = array();
		$setFunnel = array();
		if ($dataFunnel['id']) {
			if ($dataMember['id']) {
				$cekTrafic = $this->trafic_model->get(array(
					"id_member" => $dataMember['id'],
					"unique_id" => $cookie
				));
				if (!$cekTrafic['id']) {
					$dataTrafic['id'] = 0;
					$dataTrafic['id_member'] = $dataMember['id'];
					$dataTrafic['unique_id'] = $cookie;
					$dataTrafic['id_funnel'] = $dataFunnel['id'];
					$dataTrafic['tanggal'] = date('Y-m-d');
					$dataTrafic['jam'] = date('H:i:s');
					$dataTrafic['ip_address'] = get_client_ip_server() ? : '';
					$dataTrafic['lokasi'] = get_client_location($dataTrafic['ip_address']);
					$dataTrafic['user_agent'] = $_SERVER['HTTP_USER_AGENT'] ? : '';
					$dataTrafic['pixel'] = $pixel;
					// echo $this->db->last_query(); exit;
					$this->trafic_model->save($dataTrafic);

					$setFunnel['id'] = $dataFunnel['id'];
					$setFunnel['jumlah_trafic'] = ($dataFunnel['jumlah_trafic'] + 1);
					$this->funnel_model->save($setFunnel);
				}
				
			}
		}
		
	}
}