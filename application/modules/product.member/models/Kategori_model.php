<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kategori_model extends Base_Model {

	function __construct() {

        parent::__construct();
		// $this->set_schema('dataMaster');
		$this->set_table('ref_kategori');
		$this->set_pk('id');
		// $this->set_log(true);
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
