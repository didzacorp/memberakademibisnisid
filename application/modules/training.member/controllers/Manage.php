<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('training_model');
		$this->load->model('watched_model');
	}

	public function index()
	{
		$data = array();
		$data['content'] = 'manage';
		$data['title'] = 'MemberShip';
		// $data['profile'] = $this->profile_model->get($this->session->userdata('id'));
		
		$this->load->view($data['content'],$data);
	}

	function tontonTraining()
	{
		$id = $this->input->post('id');
		$list =  $this->training_model->get($id);
		$userID				 = $this->session->userdata('id');
		$HitoryTraining = $this->watched_model->get(array("id_member" => $userID, "id_training" => $id));

		$str_time = $HitoryTraining['jam'];
		sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
		$time_seconds = isset($hours) ? $hours * 3600 + $minutes * 60 + $seconds : $minutes * 60 + $seconds;

		// echo $this->db->last_query();
		$data = array();
		$data['content'] = 'tontonTraining';
		$data['list'] = $list;
		$data['HitoryTraining'] = $HitoryTraining;
		$data['time_seconds'] = $time_seconds;
		$data['title'] ='';
		// $data['profile'] = $this->profile_model->get($this->session->userdata('id'));

		$this->load->view($data['content'],$data);
	}
	
	function page($pg=1)
	{		
		$limit = $this->input->post('t_limit_rows')?:10;
		$filter['search_key'] 	= strtoupper ($this->input->post('t_search_key'));
		$filter['shortby'] =  $this->input->post('t_short_by');
		$filter['orderby'] =  $this->input->post('t_order_by')[0];
		$periode = $this->input->post('t_periode');
		// set condition
		$where = array();
		if ($filter['search_key'])
		{
			$where['(
					UPPER(tbl."Lokasi") ~* \''.$filter['search_key'].'\'
				)'] = null;
		}
		// $this->training_model->set_where($where);
		//
		// order by
		$orderBy = array();
		// if($filter['shortby']){
			// $orderBy[$filter['shortby']] = $filter['orderby'];
		// }
		$orderBy['urutan'] = 'ASC';
		$this->training_model->set_order($orderBy);
		//
		$limitStep = $this->training_model->stepVideo();
		// $limit = ($limitStep->num_rows()+1);
		$list = $this->training_model->get_list();
		$this->training_model->set_limit($limit);
		$this->training_model->set_offset($limit * ($pg - 1));
		
		//
		$page = array();
		$page['limit'] 		= $limit;
		$page['count_row'] 	= $limitStep->num_rows();
		$page['current'] 	= $pg;
		$page['load_func_name'] = 'pageLoadLokasi';
		$page['list'] 		= $this->gen_paging($page);
		//
		$data = array();
		$data['content'] = 'list';		
		$data['list'] = $this->training_model->get_list();	
		$data['limitStep'] = $limitStep->num_rows();	
		// echo $this->db->last_query();exit;	
		$data['key'] = $filter;		
		$data['paging'] = $page;		
		$this->load->view($data['content'],$data);
	}

	function saveLastWatched()
	{
		$idTraining			 = $this->input->post('idTraining');
		$userID				 = $this->session->userdata('id');
		$currentTime		 = $this->input->post('currentTime');
		$seconds = $currentTime;
		$zero    = new DateTime("@0");
		$offset  = new DateTime("@$seconds");
		$diff    = $zero->diff($offset);
		$watched = sprintf("%02d:%02d:%02d", $diff->days * 24 + $diff->h, $diff->i, $diff->s);

		$HitoryTraining = $this->watched_model->get(array("id_member" => $userID, "id_training" => $idTraining));
		$dataTraining = $this->training_model->get($idTraining);

		if ($HitoryTraining['status'] != 'SELESAI') {
			$data = array();
			if ($HitoryTraining['id']) {
				$data['id'] = $HitoryTraining['id'];
			}else{
				$data['id'] = 0;
			}

			$data['id_member'] = $userID;
			$data['id_training'] = $idTraining;
			$data['tanggal'] = date('Y-m-d');
			$data['jam'] = $watched;

			if ($dataTraining['durasi_video'] == $watched) {
				$data['status'] = 'SELESAI';
			}else{
				$data['status'] = 'BELAJAR';
			}

			$this->watched_model->save($data);

		}

		$this->success(' Save Berhasil Success');
	}
}