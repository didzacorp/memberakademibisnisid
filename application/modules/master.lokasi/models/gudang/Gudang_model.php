<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gudang_model extends Base_Model {

	function __construct() {

        parent::__construct();
		$this->set_schema('h1');
		$this->set_table('msGudang');
		$this->set_pk('Code','KodeDealer');
		$this->set_log(true);
    }	
	
	function get_count()
	{
		$this->db->select('count(*) as row_count');
		$this->db->where($this->where);
		$query = $this->db->get($this->schema.'.'.$this->table.' tbl');
		$row = $query->row_array();
		return $row['row_count'];
	}
    function get_list()
	{
		$this->db->select('tbl.*');
		//
		$this->db->where($this->where);
		
		foreach ($this->order_by as $key => $value)
		{
			$this->db->order_by($key, $value);
		}
		$this->db->order_by('KodeDealer','ASC');
		$this->db->order_by('Code','ASC');
		if (!$this->limit AND !$this->offset)
			$query = $this->db->get($this->schema.'.'.$this->table.' tbl');
		else
			$query = $this->db->get($this->schema.'.'.$this->table.' tbl',$this->limit,$this->offset);
		
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