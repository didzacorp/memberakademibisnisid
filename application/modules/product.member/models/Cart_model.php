<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cart_model extends Base_Model {

	function __construct() {

        parent::__construct();
		// $this->set_schema('dataMaster');
		$this->set_table('cart');
		$this->set_pk('id');
		// $this->set_log(true);
    }	

	function getSumCart($id_member='')
	{
		$this->db->select('sum(tbl.jumlah) as totalCart');
		$this->db->where(array('id_member' => $id_member));
		$query = $this->db->get($this->table.' tbl');
		
		// echo $this->db->last_query();
		// exit;

		$data = $query->row_array();
		return $data['totalCart'];
	}
		
    function get_list()
	{
		$this->db->select('tbl.*');
			$this->db->select('prod.nama_produk');
			$this->db->select('prod.berat');

		$this->db->join('produk prod','tbl.id_produk = prod.id','LEFT');
		
		$this->db->where($this->where);
		if($this->order_by){
			$this->db->order_by($this->pk_field.' DESC');
		}
		
		foreach ($this->order_by as $key => $value)
		{
			$this->db->order_by($key, $value);
		}

		if (!$this->limit AND !$this->offset)
			$query = $this->db->get($this->table.' tbl');
		else
			$query = $this->db->get($this->table.' tbl',$this->limit,$this->offset);
		// echo $this->db->last_query();
		// exit;
        if($query->num_rows()>0)
		{
			return $query;
        
		}else
		{
			$query->free_result();
            return $query;
        }
	}
}

/* End of file dealer_model.php */
/* Location: ./application/modules/master.mitra/models/dealer_model.php */
