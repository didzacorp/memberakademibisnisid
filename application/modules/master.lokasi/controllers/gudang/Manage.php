<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		
		// $this->load->model('cdb/cdb_model');
		$this->load->model('gudang/gudang_model');
		$this->load->model('master.mitra/dealer/dealer_model');
		
	}
	
	public function inner_info()
	{
		$count_all = $this->gudang_model->count();
		$progress = 100;
		$status = 'Master Gudang';
		// load
		$this->update['title'] = $count_all;
		// $this->update['status'] = $status;
		$this->update['progress'] = $progress;
		$this->success('Loaded');
	}	
	public function index()
	{	
		$data = array();
		$data['content'] = 'gudang/manage';
		// $data['ahass'] = $this->ahass_model->get_list();
		
		$this->load->view($data['content'],$data);
	}
	function page($pg=1)
	{		
		$filter['code'] = strtoupper ($this->input->post('t_Code'));
		$filter['description'] = strtoupper ($this->input->post('t_Description'));

		// $filter['date_start'] = getSQLDate($this->input->post('t_date_start'));
		// $filter['date_end'] = getSQLDate($this->input->post('t_date_end'));
		$filter['shortby'] =  $this->input->post('t_short_by');
		$filter['orderby'] =  $this->input->post('t_order_by');
		// $filter['status'] =  $this->input->post('t_status');
		$periode = $this->input->post('t_periode');
		$limit = $this->input->post('t_limit_rows')?:10;
		// set condition
		$where = array();
		
		if ($filter['code'])
		{
			$where['(
					UPPER(tbl."Code") ~* \''.$filter['code'].'\'
				)'] = null;
		}
		if ($filter['description'])
		{
			$where['(
					UPPER(tbl."Description") ~* \''.$filter['description'].'\'
				)'] = null;
		}
		// if ($filter['status']<>'ALL')
		// {
			// $where['Status'] = $filter['status'];
		// }
		$this->gudang_model->set_where($where);
		//
		// order by
		$orderBy = array();
		if($filter['shortby']){
			$orderBy[$filter['shortby']] = $filter['orderby'][0];
		}
		$this->gudang_model->set_order($orderBy);
		//
		$this->gudang_model->set_limit($limit);
		$this->gudang_model->set_offset($limit * ($pg - 1));
		//
		$page = array();
		$page['limit'] 		= $limit;
		$page['count_row'] 	= $this->gudang_model->get_count() ;
		$page['current'] 	= $pg;
		$page['load_func_name'] = 'pageLoadSalesPerson';
		$page['list'] 		= $this->gen_paging($page);
		//
		$data = array();
		$data['content'] = 'gudang/list';		
		$data['list'] = $this->gudang_model->get_list();		
		$data['key'] = $filter;		
		$data['paging'] = $page;		
		$this->load->view($data['content'],$data);
	}
	function input()
	{
		$Code = decode($this->input->post('t_Code'));
		$gudang =  $this->gudang_model->get($Code);		
		
		$title = 'New';
		if($Code){
			$title = 'Edit Gudang : '.$gudang['Description'];
		}
		//
		$data = array();
		$data['content'] = 'gudang/input';
		$data['code'] 	= $Code;
		$data['gudang'] = $gudang;
		$data['dealer'] = $this->dealer_model->get_list();
		$data['title'] = $title;
		$this->load->view($data['content'],$data);
	}
	
	function save()
	{
		$kodedealer_current = $this->input->post('t_KodeDealerCurrent');
		$code_current = $this->input->post('t_CodeCurrent');
		
		$data = array();
		$data['KodeDealer'] = $this->input->post('t_KodeDealer');
		$data['Code'] = $this->input->post('t_Code');
		$data['Description'] = $this->input->post('t_Description');
		if($code_current){
			if($code_current <> $data['Code'] && $kodedealer_current <> $data['KodeDealer'] ){
				$this->error('Kode tidak bisa dirubah');
			}
		}else{
			if(!$data['Code']){
				$this->error('Kode belum di isi');
			}
		}
		if(!$data['Description']){
			$this->error('Deskripsi belum di isi');
		}
		// proses
		$this->db->trans_start();
		
		// print_r($data);
		// exit;
		$save = $this->gudang_model->save($data);
		$this->db->trans_complete();
		if($this->db->trans_status())
		{
			$this->update['Code'] = $data['Code'];
			$this->success('Proses simpan berhasil');
		}else
		{
			$this->error('Proses simpan gagal.');
		}
	}
	function delete(){
		$Code = $this->input->post('t_Code');
		$this->db->trans_start();
		$this->gudang_model->delete($Code);
		$this->db->trans_complete();
		if($this->db->trans_status()==false)
		{
			$this->error('Proses gagal dijalankan. ');		
		}else{
			$this->success('Data telah dihapus ');
		}
	}
	
}

