<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('product_model');
		$this->load->model('kategori_model');
		$this->load->model('cart_model');
	}

	public function index()
	{
		$data = array();
		$data['content'] = 'manage';
		$data['title'] = 'Product';
		$data['funnel'] = $this->product_model->get_list();
		
		$this->load->view($data['content'],$data);
	}

	public function DetailProduk()
	{
		$id = $this->input->post('id');
		$data = array();
		$data['content'] = 'detailProduk';
		$data['title'] = 'Product';
		$data['produk'] = $this->product_model->get($id);
		
		$this->load->view($data['content'],$data);
	}

	function page($pg=1)
	{		
		$id = $this->input->post('KategoriProduk');
		$limit = 10;
		$where = array();
		$where['status'] = "AKTIF";
		$where['kategori'] = $id;
		$kategori = $this->kategori_model->get($id);
		$this->product_model->set_where($where);
		//
		// order by
		$orderBy = array();
		// if($filter['shortby']){
			// $orderBy[$filter['shortby']] = $filter['orderby'];
		// }
		// $orderBy['tbl.Lokasi'] = 'DESC';
		$this->product_model->set_order($orderBy);
		//
		$list = $this->product_model->get_list();
		$this->product_model->set_limit($limit);
		$this->product_model->set_offset($limit * ($pg - 1));
		// echo $this->db->last_query();exit;
		//
		$page = array();
		$page['limit'] 		= $limit;
		$page['count_row'] 	= $list->num_rows();
		$page['current'] 	= $pg;
		$page['load_func_name'] = 'pageLoadProduk';
		$page['list'] 		= $this->gen_paging($page);
		//
		$data = array();
		$data['content'] = 'listProduk';		
		$data['list'] = $this->product_model->get_list();		
		// $data['key'] = $filter;		
		$data['paging'] = $page;		
		$data['kategori'] = $kategori;		
		$this->load->view($data['content'],$data);
	}

	function page_kategori($pg=1)
	{		
		$limit = 10;
		$where = array();
		$this->kategori_model->set_where($where);
		//
		// order by
		$orderBy = array();
		// if($filter['shortby']){
			// $orderBy[$filter['shortby']] = $filter['orderby'];
		// }
		// $orderBy['tbl.Lokasi'] = 'DESC';
		$this->kategori_model->set_order($orderBy);
		//
		$list = $this->kategori_model->get_list();
		$this->kategori_model->set_limit($limit);
		$this->kategori_model->set_offset($limit * ($pg - 1));
		// echo $this->db->last_query();exit;
		//
		$page = array();
		$page['limit'] 		= $limit;
		$page['count_row'] 	= $list->num_rows();
		$page['current'] 	= $pg;
		$page['load_func_name'] = 'pageLoadKategori';
		$page['list'] 		= $this->gen_paging($page);
		//
		$data = array();
		$data['content'] = 'listKategori';		
		$data['list'] = $this->kategori_model->get_list();		
		// $data['key'] = $filter;		
		$data['paging'] = $page;		
		$this->load->view($data['content'],$data);
	}

	function refreshCart()
	{
		$totalCart = $this->cart_model->getSumCart($this->session->userdata('id'));
		// echo $totalCart;exit();
		if($totalCart){
			$this->update['totalCart'] = $totalCart;
			$this->success(' Produk Berhasil Ditambahkan');
 
		}else{
			$this->error('Produk Gagal Ditambahkan');
		}

	}

	function addToCart()
	{
		$id = $this->input->post('id');
		$qtyProduk = $this->input->post('qtyProduk');

		$getCart = $this->cart_model->get(array(
			'id_member' => $this->session->userdata('id'),
			'id_produk' =>  $id
		));
		$getProduk = $this->product_model->get($id);

		$data = array();
		if ($getProduk['id']) {
			$data["id"] = $getCart['id'] ? : 0;	
			$data["id_produk"] = $id;	
			$data["harga"] = $getProduk['harga'];	
			$data["jumlah"] = floatval($qtyProduk ? : 0 + $getCart['jumlah'] ? : 0);	
			$data["diskon"] = $getProduk['diskon'];	
			$data["sub_total"] = floatval(($getProduk['harga'])) * floatval($qtyProduk);	
			$data["total"] = floatval($data["sub_total"]) - floatval($data["diskon"]);	
			$data["id_member"] = $this->session->userdata('id');	
			$data["keterangan"] = '';		
			$data["tanggal"] = date('Y-m-d');		
			$data["jam"] = date('H::i:s');	

			$save = $this->cart_model->save($data);
		}
		

		if($save){
			$this->success(' Produk Berhasil Ditambahkan');
 
		}else{
			$this->error('Produk Gagal Ditambahkan');
		}
	}

}