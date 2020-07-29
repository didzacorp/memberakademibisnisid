<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('product.member/cart_model');
		$this->load->model('product.member/product_model');
		
	}

	public function index()
	{
		$data = array();
		$data['content'] = 'manage';
		$data['title'] = 'Cart';
		$data['funnel'] = $this->cart_model->get_list();
		
		$this->load->view($data['content'],$data);
	}

	function page($pg=1)
	{		
		$limit = 10;
		$where = array();
		$where['id_member'] = $this->session->userdata('id');
		$this->cart_model->set_where($where);
		//
		// order by
		$orderBy = array();
		// if($filter['shortby']){
			// $orderBy[$filter['shortby']] = $filter['orderby'];
		// }
		// $orderBy['tbl.Lokasi'] = 'DESC';
		$this->cart_model->set_order($orderBy);
		//
		$list = $this->cart_model->get_list();
		$this->cart_model->set_limit($limit);
		$this->cart_model->set_offset($limit * ($pg - 1));
		// echo $this->db->last_query();exit;
		//
		$page = array();
		$page['limit'] 		= $limit;
		$page['count_row'] 	= $list->num_rows();
		$page['current'] 	= $pg;
		$page['load_func_name'] = 'pageLoadCart';
		$page['list'] 		= $this->gen_paging($page);
		//
		$data = array();
		$data['content'] = 'list';		
		$data['list'] = $this->cart_model->get_list();		
		// $data['key'] = $filter;		
		$data['paging'] = $page;		
		$this->load->view($data['content'],$data);
	}

	function saveProduk()
	{
		$id = $this->input->post('id');
		$jumlahProduk = $this->input->post('jumlahProduk');

		$getCart = $this->cart_model->get($id);
		$getProduk = $this->product_model->get($getCart['id_produk']);

		$data = array();
		$data["id"] = $getCart['id'];	
		$data["jumlah"] = floatval($jumlahProduk ? : 0 + $getCart['jumlah'] ? : 0);	
		$data["diskon"] = $getProduk['diskon'];	
		$data["sub_total"] = floatval(($getProduk['harga'])) * floatval($jumlahProduk);	
		$data["total"] = floatval($data["sub_total"]) - floatval($data["diskon"]);	

		$save = $this->cart_model->save($data);
		

		if($save){
			$this->success(' Produk Berhasil Ditambahkan');
 
		}else{
			$this->error('Produk Gagal Ditambahkan');
		}
	}

	function deleteProduk()
	{
		$id = $this->input->post('id');
		$delete = $this->cart_model->delete($id);
		

		if($delete){
			$this->success(' Produk Berhasil diHapus');
 
		}else{
			$this->error('Produk Gagal diHapus');
		}
	}
	
}