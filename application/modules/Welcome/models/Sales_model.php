<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sales_model extends Base_Model {

	function __construct() {

        parent::__construct();
    }	
		
    function get_item_in_period($per_start,$per_end)
	{
		$this->db->select('mp.SKU,mp.Description');
		$where['mp."SKU" in (select "SKU" from trade."trSalesDetail" where "TransDate" between \''.$per_start."' and '".$per_end."')"]=null;
		$this->db->where($where);
		$this->db->order_by('mp.SKU', 'asc');
		$query = $this->db->get('dataMaster.msProduct mp');
		echo $this->db->last_query();
		if($query->num_rows()>0)
		{
			return $query;
        
		}else
		{
			$query->free_result();
            return $query;
        }
	}
    function get_date_in_period($per_start,$per_end)
	{
		$this->db->select('tr.TransDate');
		$where['tr.TransDate >=']= $per_start;
		$where['tr.TransDate <=']= $per_end;
		$this->db->where($where);
		
		$this->db->order_by('tr.TransDate', 'asc');
		$this->db->group_by('tr.TransDate');
		$query = $this->db->get('trade.trSalesDetail tr');
		if($query->num_rows()>0)
		{
			return $query;
        
		}else
		{
			$query->free_result();
            return $query;
        }
	}
    function get_data($per_start,$per_end,$sku)
	{
		$this->db->select('tr.TransDate');
		$this->db->select_sum('tr.Quantity');
		$where['tr.TransDate >=']= $per_start;
		$where['tr.TransDate <=']= $per_end;
		$where['tr.SKU']= $sku;
		$this->db->where($where);
		
		$this->db->order_by('tr.TransDate', 'asc');
		$this->db->group_by('tr.TransDate');
		$query = $this->db->get('trade.trSalesDetail tr');
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
