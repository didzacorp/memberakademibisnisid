<?php
class Base_model extends CI_Model 
{
	public $table = '';
	public $schema = 'public';
	public $pk_field = '';
	public $pk_field2 = '';
	public $pk_field3 = '';
	public $code_field = '';
	public $limit = 0;
	public $offset = 0;
	public $where = array();
	public $like = array();
	public $order_by = array();
	public $is_trap = true;
	public $message = '';
	public $last_query = '';
	
    function __construct() 
	{
        parent::__construct();

    }
	public function set_table($table)
	{
		$this->table = $table;
	}
	public function set_schema($schema_name='public')
	{
		$this->schema = $schema_name;
	}
	
	public function set_log($trap)
	{
		$this->is_trap = $trap;
	}
	
	public function set_pk($field,$field2=false,$field3=false,$field4=false,$field5=false)
	{
		$this->pk_field = $field;
		$this->pk_field2 = $field2;
		$this->pk_field3 = $field3;
		$this->pk_field4 = $field4;
		$this->pk_field5 = $field5;
	}
	
	public function set_code($table)
	{
		$this->code_field = $table;
	}
	
	public function set_limit($limit=0)
	{
		if ($limit > 0)
			$this->limit = $limit;
	}
	
	public function set_offset($offset=0)
	{
		if ($offset > 0)
			$this->offset = $offset;
	}
	
	public function set_where($where=array())
	{
		if ($where)
			$this->where = $where;
	}
	public function set_order($order=array())
	{
		if ($order)
			$this->order_by = $order;
	}
	public function set_group($group=array())
	{
		if ($group)
			$this->group_by = $group;
	}
	public function set_like($like=array())
	{
		if ($like)
		{
			$this->like = $like;
		}
	}
	
	function count() 
	{
		$data = array();
		$this->db->select('count(*) as num_rows');
		$this->db->where($this->where);
		$query = $this->db->get($this->schema.'.'.$this->table);
		$row = $query->row_array();
		return $row['num_rows'];
	}

	function get_list()
	{
		$this->db->select('tbl.*');
		$this->db->where($this->where);
		$this->db->like($this->like);
		
		if ($this->order_by)
		{
			foreach ($this->order_by as $key => $value)
			{
				$this->db->order_by($key, $value);
			}
		}else
		{
			$this->db->order_by($this->pk_field, 'asc');
		}
		$this->db->order_by($this->pk_field,'asc');
		
		if (!$this->limit AND !$this->offset)
			$query = $this->db->get($this->schema.'.'.$this->table.' tbl');
		else
			$query = $this->db->get($this->schema.'.'.$this->table.' tbl',$this->limit,$this->offset);

		$this->last_query = $this->db->last_query();
        if($query->num_rows()>0)
		{
			return $query;        
		}else
		{
			$query->free_result();
            return $query;
        }
	}	
	function get($where) 
	{
		$data = array();
	
		if ( is_array($where) )
		{
			foreach ($where as $key => $value)
			{
				$this->db->where($key, $value);
			}
		}else
		{
			$this->db->where($this->pk_field, $where?:null);
		}
		/*
		// $this->is_trap = false;
		if ($this->is_trap)
		{
			$pkData = array
			$this->db->select('lg."idTrDataLog"');
			$sql_log = '(SELECT "fidData",max(tr."idTrDataLog") as "idTrDataLog"
							FROM "terminal"."trDataLog" tr 
							WHERE tr."SchemaName" = \''.$this->schema.'\'
							    and tr."TableName" = \''.$this->table.'\'
								and 
							GROUP BY tr."fidData") lg';
			// $this->db->join($sql_log,'tbl."'.$this->pk_field.'" = lg."fidData"','left');
			$this->db->join($sql_log,'1=1','left');
		}
		*/
		// get array data
		$this->db->select('tbl.*');
		$this->db->order_by($this->pk_field);
		$query = $this->db->get($this->table.' tbl',1,null);
		
		$this->last_query = $this->db->last_query();	
		if ( $query->num_rows() == 1)
		{
            $data = $query->row_array();
			$query->free_result();
			
		}else
		{
			$data = $this->feed_blank();
			$data['idTrDataLog'] = 0;
		}
		
        return $data;
	}
	
	function log($type='',$old_value='',$fid_data=0)
	{
		$data['value_before'] = $old_value;
		$data['log_type'] = $type;
		$data['ip_comp'] = $this->input->ip_address();
		$data['fid_operator'] = $this->session->userdata('id_operator');
		$data['table_name'] = $this->table;
		$data['fid_data'] = $fid_data;
		$this->db->insert('tr_log', $data);
	}
	
	function create_log($type='',$logData=array(),$PKData=array())
	{
		$data = array();
		// $data['LogType'] = $type;
		$data['fidMsOperator'] = $this->session->userdata('Employee')['idMsEmployee'];
		$data['SchemaName'] = $this->schema;
		$data['TableName'] = $this->table;
		$data['PKData'] = json_encode($PKData);
		$data['LogData'] = json_encode($logData);
		// print_r($data);
		if ($this->is_trap){
			$this->db->insert('terminal.trDataLog', $data);
		}
	}
	function create_log_old($type='',$log_data='',$fid_data=0)
	{
		$data['LogData'] = $log_data;
		$data['LogType'] = $type;
		$data['fidMsOperator'] = $this->session->userdata('id_operator');
		$data['SchemaName'] = $this->schema;
		$data['TableName'] = $this->table;
		$data['fidData'] = $fid_data;
		if ($this->is_trap)
			$this->db->insert('terminal.trDataLog', $data);
	}
	
	function get_last_log($id)
	{
		$sql = 'SELECT *
				FROM "terminal"."trDataLog"
				WHERE  "SchemaName" = \''. $this->schema .'\'
				 	and  "TableName" = \''. $this->table .'\'
				 	and  "fidData" = '.$id.'
				ORDER BY "idTrDataLog" DESC
				LIMIT 1
				';
		$query = $this->db->query($sql);
		//return $query->result_array();
		$data = $query->row_array();
		$query->free_result();
		return $data;
	}
	function save($data,$act=null)
	{
		$return = 0;
		$action = '';
		$data = $this->clean_data($data);
		// setup PK
		if ($this->pk_field)
			$where[$this->pk_field] = $data[$this->pk_field];
		if ($this->pk_field2)
			$where[$this->pk_field2] = $data[$this->pk_field2]; 
		if ($this->pk_field3)
			$where[$this->pk_field3] = $data[$this->pk_field3]; 
		if ($this->pk_field4)
			$where[$this->pk_field4] = $data[$this->pk_field4]; 
		if ($this->pk_field5)
			$where[$this->pk_field5] = $data[$this->pk_field5]; 

		
		$this->db->select($this->pk_field);
		$this->db->where($where);
		$query = $this->db->get($this->table);
		//
		$num_rows = $query->num_rows();
		if($num_rows==0)
		{
			$action = 'New Data';
			// insert new row
			if (!$data[$this->pk_field])
				unset($data[$this->pk_field]);
			//insert 
			$new = $this->db->insert($this->table, $data);		
			$return = $new;
		}elseif($num_rows==1)
		{
			// get data old
			$value_old =  $this->get($where);
				
			$action = 'Edit Data';
			// update data
			$this->db->where($where);		
			$update = $this->db->update($this->table,$data);		
			// create log
			if ($update)
			{
				$var = '';
				$dataLog = array();
				foreach($data as $key => $value)
				{
					if ($value_old[$key]<>$value || ($value_old[$key] == false && $value)){
						$dataLog[$key]['old'] = $value_old[$key];
						$dataLog[$key]['new'] = $value;
					}
				}
				if (count($dataLog)>0){
					$PKData = $where ;
					$this->create_log('update',$dataLog,$PKData);
				}
			}
			if ($this->pk_field)
				$return .= $data[$this->pk_field];
			if ($this->pk_field2)
				$return .= $data[$this->pk_field2]; 
			if ($this->pk_field3)
				$return .= $data[$this->pk_field3]; 

		}elseif($num_rows>1)
		{
			$return = false;
			$this->message = 'Ditemukan data diserver lebih dari satu. [ '.$num_rows.' rows]'.chr(13)
							.$this->pk_field.' = '.$data[$this->pk_field].chr(13);
			if ($this->pk_field2)
				$this->message .= $this->pk_field2.' = '.$data[$this->pk_field2].chr(13);
			if ($this->pk_field3)
				$this->message .= $this->pk_field3.' = '.$data[$this->pk_field3]; 
		}
		return $return;
	}

	function saveGetLastID($data)
	{
		$data = $this->clean_data($data);
		if (!isset($data[$this->pk_field]))
		{
			$data[$this->pk_field] = 0;
		}

		if($data[$this->pk_field])
		{
			//get old value
			$value_old =  $this->get($data[$this->pk_field]);
			// update row
			$where[$this->pk_field] = $data[$this->pk_field];
			$this->db->where($where);
			
			$update = $this->db->update($this->table,$data);
			if ($update)
			{
				return $data[$this->pk_field];	
			}
			else
			{
				return false;
			}
		}else{
			// insert new row
			unset($data[$this->pk_field]);
			$insert = $this->db->insert($this->table, $data);
			if ($insert)
			{
				$new_id = $this->get_last_id();
				return $new_id;				
			}
			else
			{
				return false;
			}
		}
	}
	
	public function insert($data = null)
	{
		return $this->db->insert($this->schema.'.'.$this->table, $data);
	}
	
	public function delete($where = NULL, $table = FALSE)
	{
		$table = (FALSE !== $table) ? $table : $this->table;
		
		if ( is_array($where) )
		{
			$this->db->where($where);
		}
		else
		{
			$this->db->where($this->pk_field, $where);
		}
	
		return $this->db->delete($table);
				
		//return (int) $this->db->affected_rows();
	}
	
	function clean_data($value, $table = FALSE)
	{
		/* $data = $value;
		*/
		$data = array();
		foreach($value as $key => $val)
        {	
            if(!is_array($val))
            {
                $data[$key]     = $val;
                $data[$key]     = strip_image_tags($data[$key]);
                // $data[$key]     = quotes_to_entities($data[$key]);
                $data[$key]     = encode_php_tags($data[$key]);
                $data[$key]     = trim($data[$key]);
            }
        }		
       
		$cleaned_data = array();
	
		if ( ! empty($data))
		{
			$table = ($table !== FALSE) ? $table : $this->table;
			
			$fields = $this->db->list_fields($table);
			
			$fields = array_fill_keys($fields,'');
	
			$cleaned_data = array_intersect_key($data, $fields);
		}
		return $cleaned_data;
	}
	
	function feed_blank()
	{
		$template = array();
		$fields = $this->db->list_fields($this->table);

		$fields_data = $this->field_data($this->table);

		foreach ($fields as $field)
		{
			//$field_data = array_values(array_filter($fields_data, create_function('$row', 'return $row["Field"] == "'. $field .'";')));
			$field_data = (isset($field_data[0])) ? $field_data[0] : false;

			$template[$field] = (isset($field_data['Default'])) ? $field_data['Default'] : '';
		}
		return $template;
	}
	
	function field_data($table)
	{
		return $this->db->list_fields($table);
	}
	
	function get_last_id()
	{
		$query = 'SELECT max("'.$this->pk_field.'") as "maxid" 
					FROM '.$this->schema.'."'.$this->table.'"';
		$query = $this->db->query($query);
		$row = $query->row();
		return $row->maxid; 		
	}
	function get_last_no($pref)
	{
		// parshing
		$pref_ln = strlen($pref);
		$table = $this->table;
		$field = $this->code_field;
		// query
		$sql = "SELECT $field
				FROM $table
				WHERE LEFT($field,$pref_ln) = '$pref'
				ORDER BY $field DESC
				LIMIT 1
				";

		$query = $this->db->query($sql);
		$result = 0;
		if ($query->num_rows()==1)
		{
			$returns = $query->result_array();
			foreach($returns as $return):
				$result = $return[$field];
			endforeach;
		}
		return $result;
	}
}