<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Funnel_model extends Base_Model {

	function __construct() {

        parent::__construct();
		// $this->set_schema('dataMaster');
		$this->set_table('funnel');
		$this->set_pk('id');
		// $this->set_log(true);
    }	
		
    function get_list()
	{
		$this->db->select('tbl.*');
		$this->db->select('(SELECT COUNT(id_member) AS jumlah from trafic 
			WHERE id_member =\''.$this->session->userdata('id').'\' AND
			id_funnel = tbl.id
		) AS "JumlahTrafic" ');
		// $this->db->join('trafic trf','tbl.id = trf.id_funnel','LEFT');

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
