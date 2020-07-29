<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('copy_writing_model');
		
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
		$filter['search_key'] 	= strtoupper ($this->input->post('t_search_key'));
		$filter['shortby'] =  $this->input->post('t_short_by');
		$filter['orderby'] =  $this->input->post('t_order_by')[0];
		$periode = $this->input->post('t_periode');
		$limit = 10;
		// set condition
		$where = array();
		$where['status'] = 'AKTIF';
		// $this->training_model->set_where($where);
		//
		// order by
		$orderBy = array();
		// if($filter['shortby']){
			// $orderBy[$filter['shortby']] = $filter['orderby'];
		// }
		$orderBy['id'] = 'DESC';
		$this->copy_writing_model->set_order($orderBy);
		//
		$list = $this->copy_writing_model->get_list();
		$this->copy_writing_model->set_limit($limit);
		$this->copy_writing_model->set_offset($limit * ($pg - 1));
		
		//
		$page = array();
		$page['limit'] 		= $limit;
		$page['count_row'] 	= $list->num_rows();
		$page['current'] 	= $pg;
		$page['load_func_name'] = 'pageLoadCopy';
		$page['list'] 		= $this->gen_paging($page);
		//
		$data = array();
		$data['content'] = 'list';		
		$data['list'] = $this->copy_writing_model->get_list();		
		$data['key'] = $filter;		
		$data['paging'] = $page;		
		$this->load->view($data['content'],$data);
	}
	function copyDetail()
	{
		$id = $this->input->post('id');
		$data = array();
		$data['content'] = 'detailCopy';
		$data['copy'] = $this->copy_writing_model->get($id);
		
		$this->load->view($data['content'],$data);
	}
	
}