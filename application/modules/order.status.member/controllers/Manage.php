<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('transaksi_model');
		$this->load->model('detail_transaksi_model');
		
	}

	public function index()
	{
		$data = array();
		$data['content'] = 'manage';
		$data['title'] = 'Order Status';
		
		$this->load->view($data['content'],$data);
	}

	function page($pg=1)
	{		
		$limit = 10;
		$where = array();
		$where['id_member'] = $this->session->userdata('id');
		$where["jenis_transaksi IN('UPGRADE LISENSI AGEN','UPGRADE LISENSI STOKIS','PENJUALAN')"] = NULL;
		$this->transaksi_model->set_order(array('id' => 'ASC'));
		$this->transaksi_model->set_where($where);
		//
		// order by
		$orderBy = array();
		// if($filter['shortby']){
			// $orderBy[$filter['shortby']] = $filter['orderby'];
		// }
		// $orderBy['tbl.Lokasi'] = 'DESC';
		$this->transaksi_model->set_order($orderBy);
		//
		$list = $this->transaksi_model->get_list();
		$this->transaksi_model->set_limit($limit);
		$this->transaksi_model->set_offset($limit * ($pg - 1));
		// echo $this->db->last_query();exit;
		//
		$page = array();
		$page['limit'] 		= $limit;
		$page['count_row'] 	= $list->num_rows();
		$page['current'] 	= $pg;
		$page['load_func_name'] = 'pageLoadOrder';
		$page['list'] 		= $this->gen_paging($page);
		//
		$data = array();
		$data['content'] = 'list';		
		$data['list'] = $this->transaksi_model->get_list();		
		// $data['key'] = $filter;		
		$data['paging'] = $page;		
		$this->load->view($data['content'],$data);
	}

	function pageDetail($pg=1)
	{		
		$id = $this->input->post('idTransaksi');
		$limit = 10;
		$where = array();
		$where['id_transaksi'] = $id;
		$this->detail_transaksi_model->set_order(array('id' => 'ASC'));
		$this->detail_transaksi_model->set_where($where);
		//
		// order by
		$orderBy = array();
		// if($filter['shortby']){
			// $orderBy[$filter['shortby']] = $filter['orderby'];
		// }
		// $orderBy['tbl.Lokasi'] = 'DESC';
		$this->detail_transaksi_model->set_order($orderBy);
		//
		$list = $this->detail_transaksi_model->get_list();
		$this->detail_transaksi_model->set_limit($limit);
		$this->detail_transaksi_model->set_offset($limit * ($pg - 1));
		// echo $this->db->last_query();exit;
		//
		$page = array();
		$page['limit'] 		= $limit;
		$page['count_row'] 	= $list->num_rows();
		$page['current'] 	= $pg;
		$page['load_func_name'] = 'pageLoadOrderDetail';
		$page['list'] 		= $this->gen_paging($page);
		//
		$data = array();
		$data['content'] = 'listDetail';		
		$data['list'] = $this->detail_transaksi_model->get_list();		
		// $data['key'] = $filter;		
		$data['paging'] = $page;		
		$this->load->view($data['content'],$data);
	}

	function konfirmasiOrder($value='')
	{
		$id = $this->input->post('id');

		$data["id"] = $id;	
		$data["status"] = "MENUNGGU KONFIRMASI";	

		$save = $this->transaksi_model->save($data);

		if($save){
			$this->success('  Berhasil DiKonfirmasi');
 
		}else{
			$this->error(' Gagal DiKonfirmasi');
		}
	}

	function getDataOrder($value='')
	{
		$id = $this->input->post('id');

		$data["id"] = $id;	

		$dataTransaksi = $this->transaksi_model->get($data);

		if($dataTransaksi){
			$this->update['dataTransaksi'] = $dataTransaksi;
			$this->success('  Berhasil DiKonfirmasi');
		}else{
			$this->error(' Gagal DiKonfirmasi');
		}
	}	
	
}