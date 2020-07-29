<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lokasi extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('lokasi/lokasi_model');
		
	}

	public function index()
	{
		echo 'end';
	}
	
	public function inner_info()
	{
		$count_all = $this->lokasi_model->get_count();
		$progress = 100;
		$status = 'Master Lokasi';
		// load
		$this->update['title'] = $count_all;
		// $this->update['status'] = $status;
		$this->update['progress'] = $progress;
		$this->success('Loaded');
	}	
	
	public function manage()
	{
		$data = array();
		$data['content'] = 'lokasi/manage';
		$data['title'] = 'Data Lokasi';
		
		$this->load->view($data['content'],$data);
	}
	
	function page($pg=1)
	{		
		$filter['search_key'] 	= strtoupper ($this->input->post('t_search_key'));
		$filter['shortby'] =  $this->input->post('t_short_by');
		$filter['orderby'] =  $this->input->post('t_order_by')[0];
		$periode = $this->input->post('t_periode');
		$limit = 10;
		// set condition
		$where = array();
		if ($filter['search_key'])
		{
			$where['(
					UPPER(tbl."Lokasi") ~* \''.$filter['search_key'].'\'
				)'] = null;
		}
		$this->lokasi_model->set_where($where);
		//
		// order by
		$orderBy = array();
		// if($filter['shortby']){
			// $orderBy[$filter['shortby']] = $filter['orderby'];
		// }
		$orderBy['tbl.Lokasi'] = 'DESC';
		$this->lokasi_model->set_order($orderBy);
		//
		$this->lokasi_model->set_limit($limit);
		$this->lokasi_model->set_offset($limit * ($pg - 1));
		
		//
		$page = array();
		$page['limit'] 		= $limit;
		$page['count_row'] 	= $this->lokasi_model->get_count() ;
		$page['current'] 	= $pg;
		$page['load_func_name'] = 'pageLoadLokasi';
		$page['list'] 		= $this->gen_paging($page);
		//
		$data = array();
		$data['content'] = 'lokasi/list';		
		$data['list'] = $this->lokasi_model->get_list();		
		$data['key'] = $filter;		
		$data['paging'] = $page;		
		$this->load->view($data['content'],$data);
	}
	
	function input()
	{
		$id = decode($this->input->post('t_lokasi'));
		$lokasi =  $this->lokasi_model->get($id);		
		$title = 'New';
		if($id){
			$title = 'Edit : '.$lokasi['Lokasi'];
		}
		//
		$data = array();
		$data['content'] = 'lokasi/input';
		$data['lokasi'] = $lokasi;
		$data['title'] = $title;
		$this->load->view($data['content'],$data);
	}
	
	function save()
	{
		$lokasi_current = decode($this->input->post('t_lokasi_current'));
		$data = array();
		$data['Lokasi'] 		= $this->input->post('t_lokasi');
		$data['Kapasitas'] 		= $this->input->post('t_kapasitas');
		if($lokasi_current){
			if($lokasi_current <> $data['Lokasi']){
				$this->error('Lokasi tidak bisa di ubah');
			}
		}else{
			$lokasi = $this->lokasi_model->get($data['Lokasi']);
			if($lokasi['Lokasi']){
				$this->error('Lokasi sudah ada');
			}
		}
		if(!$data['Lokasi']){
			$this->error('Lokasi tidak boleh kosong');
		}
		if(!$data['Kapasitas']){
			$this->error('Kapasitas tidak boleh kosong');
		}
		// proses
		$this->db->trans_start();
		// print_r($data);
		// exit;
		$save = $this->lokasi_model->save($data);
		$this->db->trans_complete();
		if($this->db->trans_status())
		{
			$this->update['Lokasi'] = encode($data['Lokasi']);
			$this->success('Proses simpan berhasil');
		}else
		{
			$this->error('Proses simpan gagal.');
		}
	}
	function delete(){
		$lokasi = $this->input->post('t_lokasi');
		$this->db->trans_start();
		$this->lokasi_model->delete($lokasi);
		$this->db->trans_complete();
		if($this->db->trans_status()==false)
		{
			$this->error('Proses gagal dijalankan. ');		
		}else{
			$this->success('Data telah dihapus ');
		}
	}
}