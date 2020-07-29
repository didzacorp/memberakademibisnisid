<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('membership_model');
		$this->load->model('order.status.member/transaksi_model');
	}

	public function index()
	{
		$data = array();
		$data['content'] = 'manage';
		$data['title'] = 'MemberShip';
		// $data['profile'] = $this->profile_model->get($this->session->userdata('id'));
		
		$this->load->view($data['content'],$data);
	}
	
	function page($pg=1)
	{		
		$id_member =  $this->input->post('id_member') ? : $this->session->userdata('id');
		$filter['search_key'] 	= strtoupper ($this->input->post('t_search_key'));
		$filter['shortby'] =  $this->input->post('t_short_by');
		$filter['orderby'] =  $this->input->post('t_order_by')[0];
		$periode = $this->input->post('t_periode');
		$limit = 10;
		// set condition
		$where = array();
		$where['upline_level_1'] = $id_member;
		$this->membership_model->set_where($where);
		//
		// order by
		$orderBy = array();
		// if($filter['shortby']){
			// $orderBy[$filter['shortby']] = $filter['orderby'];
		// }
		$orderBy['id'] = 'DESC';
		$this->membership_model->set_order($orderBy);
		//
		$list = $this->membership_model->get_list();
		$this->membership_model->set_limit($limit);
		$this->membership_model->set_offset($limit * ($pg - 1));
		
		//
		$page = array();
		$page['limit'] 		= $limit;
		$page['count_row'] 	= $list->num_rows();
		$page['current'] 	= $pg;
		$page['load_func_name'] = 'resultContent';
		$page['list'] 		= $this->gen_paging($page);
		//
		$data = array();
		$data['content'] = 'list';		
		$data['list'] = $this->membership_model->get_list();		
		$data['komisi'] = $this->membership_model->getKomisi();		
		$data['key'] = $filter;		
		$data['paging'] = $page;		
		$this->load->view($data['content'],$data);
	}

	// function page($pg=1)
	// {		
	
	// 	$data = array();
	// 	$data['content'] = 'list';		
	// 	$data['Upline1'] = $this->membership_model->get(array('upline_level_1' => $this->session->userdata('id')));		
	// 	$data['Upline2'] = $this->membership_model->get(array('upline_level_2' => $this->session->userdata('id')));		
	// 	$data['Upline3'] = $this->membership_model->get(array('upline_level_3' => $this->session->userdata('id')));		
	// 	$data['Upline4'] = $this->membership_model->get(array('upline_level_4' => $this->session->userdata('id')));		
	// 	// $data['paging'] = $page;		
	// 	$this->load->view($data['content'],$data);
	// }

	// function DetailMember()
	// {		
	// 	$id_member =  $this->input->post('id_member');
			
	// 	$data = array();
	// 	$data['content'] = 'listDetail';		
	// 	$data['DataMember'] = $this->membership_model->get($id_member);		
	// 	$data['Upline1'] = $this->membership_model->get(array('upline_level_1' => $id_member));		
	// 	$data['Upline2'] = $this->membership_model->get(array('upline_level_2' => $id_member));		
	// 	$data['Upline3'] = $this->membership_model->get(array('upline_level_3' => $id_member));		
	// 	$data['Upline4'] = $this->membership_model->get(array('upline_level_4' => $id_member));		
	// 	// $data['paging'] = $page;		
	// 	$this->load->view($data['content'],$data);
	// }

	function DetailMember($pg)
	{		
		$id_member =  $this->input->post('id_member');
		$limit = 10;
		// set condition
		$where = array();
		$where['upline_level_1'] = $id_member;
		$this->membership_model->set_where($where);
		//
		// order by
		$orderBy = array();
		// if($filter['shortby']){
			// $orderBy[$filter['shortby']] = $filter['orderby'];
		// }
		$orderBy['id'] = 'DESC';
		$this->membership_model->set_order($orderBy);
		//
		$list = $this->membership_model->get_list();
		
		$this->membership_model->set_limit($limit);
		$this->membership_model->set_offset($limit * ($pg - 1));
		
		//
		$page = array();
		$page['limit'] 		= $limit;
		$page['count_row'] 	= $list->num_rows();
		$page['current'] 	= $pg;
		$page['load_func_name'] = 'resultContent';
		$page['list'] 		= $this->gen_paging($page);
		//
		$data = array();
		$data['content'] = 'list';		
		$data['list'] = $this->membership_model->get_list();		
		$data['key'] = $filter;		
		$data['paging'] = $page;		
		$this->load->view($data['content'],$data);
	}

	function pageHistory($pg)
	{
		$limit = 10;
		$where = array();
		$this->membership_model->set_where($where);
		//
		// order by
		$orderBy = array();
		// if($filter['shortby']){
			// $orderBy[$filter['shortby']] = $filter['orderby'];
		// }
		// $orderBy['tbl.Lokasi'] = 'DESC';
		$this->membership_model->set_order($orderBy);
		//
		$list = $this->membership_model->get_listHistory();
		$this->membership_model->set_limit($limit);
		$this->membership_model->set_offset($limit * ($pg - 1));
		// echo $this->db->last_query();exit;
		//
		$page = array();
		$page['limit'] 		= $limit;
		$page['count_row'] 	= $list->num_rows();
		$page['current'] 	= $pg;
		$page['load_func_name'] = 'pageHistory';
		$page['list'] 		= $this->gen_paging($page);
		//
		$data = array();
		$data['content'] = 'listHistory';		
		$data['listHistory'] = $this->membership_model->get_listHistory();		
		// $data['key'] = $filter;		
		$data['paging'] = $page;			
		$this->load->view($data['content'],$data);
	}

	function upgradeMember()
	{
		$data = array();
		$data['content'] = 'upgradeMember';
		$data['title'] = 'Upgrade Member';
		// $data['profile'] = $this->profile_model->get($this->session->userdata('id'));
		
		$this->load->view($data['content'],$data);
	}

	function UpgradeLisence()
	{		
		$id =  $this->input->post('id');

		if ($id == 1) {
			$jenis_transaksi = 'UPGRADE LISENSI AGEN';
			$total = '2500000';
		}else if ($id == 2) {
			$jenis_transaksi = 'UPGRADE LISENSI STOKIS';
			$total = '5000000';
		}else{
			$jenis_transaksi = '';
			$total = '';
		}

		$getKodeUnik =  $this->transaksi_model->getKodeUnik();

		$data = array();
		$data["id"] = 0;	
		$data["id_member"] = $this->session->userdata('id');	
		$data["tanggal"] = date('Y-m-d');	
		$data["sub_total"] = floatval($total) + floatval($getKodeUnik);	
		$data["total"] = $total;	
		$data["diskon"] = 0;	
		$data["cashback"] = NULL;	
		$data["status"] = 'BELUM BAYAR';	
		$data["jenis_transaksi"] = $jenis_transaksi;	
		$data["kode_unik"] = $getKodeUnik;	
		$data["update_time"] = date('Y-m-d H:i:s');	
		$save = $this->transaksi_model->save($data);		

		if($save){
			$this->update['idTrans'] = $this->transaksi_model->getLastID();
			$this->success(' Upgrade Lisence Berhasil');
 
		}else{
			$this->error('Upgrade Lisence Gagal');
		}
	}

	function upgradePayment()
	{
		$idTrans =  $this->input->post('idTrans');

		$data = array();
		$data['content'] = 'upgradePayment';
		$data['title'] = 'Upgrade Payment';
		$data['transaksi'] = $this->transaksi_model->get($idTrans);
		
		$this->load->view($data['content'],$data);
	}

}