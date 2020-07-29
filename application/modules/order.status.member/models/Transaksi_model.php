<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transaksi_model extends Base_Model {

	function __construct() {

        parent::__construct();
		// $this->set_schema('dataMaster');
		$this->set_table('transaksi');
		$this->set_pk('id');
		// $this->set_log(true);
    }	

    function getKodeUnik()
    {
		$this->db->select('id');
		$this->db->order_by('tanggal', 'DESC');
		$query = $this->db->get($this->table.' tbl',1,0);
		
		// echo $this->db->last_query();
		// exit;

		$data = $query->row_array();
		$kodeUnik = $data['id'] + 1000;
		// echo substr($kodeUnik, -3);exit;
		return substr($kodeUnik, -3);
    }

	function getLastID()
    {
		$this->db->select('id');
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get($this->table.' tbl',1,0);
		
		// echo $this->db->last_query();
		// exit;

		$data = $query->row_array();

		return $data['id'];
    }
		
    function get_list()
	{
		$this->db->select('tbl.*');

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
