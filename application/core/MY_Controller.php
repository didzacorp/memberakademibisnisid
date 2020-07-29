<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller 
{
	var $template_data = array();
	var $update = array();
	var $blocked_object = array();
	var $title = '..: APES  :..';
	var $secure = true;
	 public function __construct()
	{
		parent::__construct();
		// if($this->secure==false){
			
		// }else
		// {
		// 	if (!$this->is_logged_in())
		// 	{
		// 		redirect(get_language().'/login');
		// 	}
		// }
		
		
	}
	// function ini untuk mengConvert inputan tanggal dari jQuery ke format database
	function convert_date($value)
	{
		$value = trim($value);
		$year = substr($value, 6,4);
		$month = substr($value, 3,2);
		$day = substr($value, 0,2);
		$value = $year.$month.$day;
		if (!$value)
			$value = null;
		return $value;
	}
	// function ini berfungsi untuk memvalidasi data secara operator
	function validation_input($objName,$min=0,$max=0)
	{
		$value = $this->input->post($objName);
		$isBlocked = false;
		$msg = '';
		// value-nya empty / kosong
		if (!$value)
		{
			$isBlocked = true;
			$msg = 'Please enter';
		}else
		{
			// jumlah digit dibawah minimum
			if ($min)
			{
				if (strlen($value) < $min)
				{
					$isBlocked = true;
					$msg = 'Minimum lenght is '.$min;
				}	
			}
			// jumlah digit dibawah maximum
			if ($max)
			{
				if (strlen($value) > $max)
					$isBlocked = true;
			}
		}
		// here we goes
		if ($isBlocked)
		{
			// $obj_blocked['obj_name'] = $objName;
			// $obj_blocked['obj_msg'] = $msg;
			// $this->blocked_object[] = $obj_blocked;
			$this->set_blocked($objName,$msg);
		}

		return $value;
	}
	function set_blocked($objName='',$msg='')
	{
		$obj_blocked['obj_name'] = $objName;
		$obj_blocked['obj_msg'] = $msg;
		$this->blocked_object[] = $obj_blocked;
	}
	function set($name, $value)
	{
		$this->template_data[$name] = $value;
	}

	function load($template = '', $view = '' , $view_data = array(), $return = FALSE)
	{               
		if (!isset($view_data['title']))
			$view_data['title'] = $this->title;
			
		$this->CI =& get_instance();
		$this->set('contents', $this->CI->load->view($view, $view_data, TRUE));			
		return $this->CI->load->view($template, $this->template_data, $return);
	}
		
	public function is_logged_in()
	{
		return is_logged_in();
	}
	
	function success($msg='',$uri='')
	{
		$this->update['error']='';
		$this->update['message']=$msg;
		echo json_encode($this->update);
	}
	function error($err)
	{
		$this->update['blocked_object']=$this->blocked_object;
		$this->update['error']=$err;
		$this->update['message']='';
		echo json_encode($this->update);
		exit;
	}
	
	function success_redirect($msg='',$uri='')
	{
		redirect(get_language().'/'.$uri);
	}	
	
	
	function gen_paging($page_data=array())
	{
		$func_name = "pageLoad";
		if (isset($page_data['load_func_name']))
		{
			if ($page_data['load_func_name'])
				$func_name = $page_data['load_func_name'];
		}
		$limit = $page_data['limit'];
		$limit = $limit?$limit:1;
		$count = ceil($page_data['count_row'] / $limit) ;
		$last_row = $limit*$page_data['current'];
		if ($last_row > $page_data['count_row'])
			$last_row = $page_data['count_row'];
		$page_result = '<div class="row" style="margin-top:1%;">';
		$page_result .= '<div class="col-sm-5">
							Showing '.(($limit*($page_data['current']-1))+1)
								.' to '.$last_row.' of '.$page_data['count_row'].' rows
						</div>';
		
		$page_result .= '	<div class="col-sm-1" style="left:10%;right:0;width:10%">
								<input type="number" value="'.$page_data['current'].'" min="0" max="'.$last_row.'" class="form-control" placeholder="Page..." value="" onkeydown="if (event.keyCode == 13) '.$func_name.'(this.value)">	
							</div>
						
						';
		$page_result .= '<div class="col-sm-6" style="float: right;">
						';
		$page_result .= '<ul class="pagination d-flex justify-content-right pagination-success" style="float: right;"><li class="prev page-item '.($page_data['current']==1?'active':'').'"><a href="javascript:void(0)" '.($page_data['current']==1?'':'onclick="'.$func_name.'(1)"').' class="page-link">&lt; First</a></li>';
		
		$paging_show = 2;
		$page_start = $page_data['current'] - $paging_show;
		$page_start = $page_start<1?1:$page_start;
		//$page_end	= $count;
		$page_end = $page_data['current'] + $paging_show;
		$page_end = $count > $page_end ? $page_end : $count;
		$page_end = $count > 1 ? $page_end : 1;
		
		//
		if ($page_start > 1)
		{
			$page_result .= '<li class="active"><a href="javascript:void(0)" class="page-link">...</a></li>';
		}
		// before current
		for($i=$page_start; $i<=$page_end; $i++)
		{ 
			$page_result .= '<li class="page-item '.($page_data['current']==$i?'active':'').'" >'
							.'<a href="javascript:void(0)" '.($page_data['current']==$i?'':'onclick="'.$func_name.'('.$i.')"').' class="page-link">'.$i.'</a>'
							.'</li>';
		}
		// after current
		if ($page_end < $count)
		{
			$page_result .= '<li class="active" class="page-item"><a href="javascript:void(0)" class="page-link">...</a></li>';
		}
		
		$page_result .= '<li class="next page-item '.($page_data['current']==$page_end?'active':'').'"><a href="javascript:void(0)" onclick="'.$func_name.'('.$count.')" class="page-link">Last &gt; </a></li></ul>';
		$page_result .= '</div></div>';
		return $page_result;
	}
	
	function reject()
	{
		$this->load->view('rejected');
	}
	
	/*
	 * untuk mencari no transaksi yang baru	
	 */
	function _get_tr_no($pref=null,$model=null,$date=true)
	{
		if (!$pref)
			$pref = '';
		else
			$pref .= '.';			
		
		if ($date)
			$pref .= date('ym').'.';
			
		$pref_ln = strlen($pref);
		
		$tr_no = '';
		$no_last = $model->get_last_no($pref);
		$no_next = 1;
		if ($no_last)
		{
			$no_next = substr($no_last,$pref_ln,5)+1;
		}

		$tr_no = $pref.sprintf('%05s', $no_next);
		return $tr_no;
	}
	
		function getMonthList()
	{
		$month_list=array(
					1=>'Januari'
					,2=>'Februari'
					,3=>'Maret'
					,4=>'April'
					,5=>'Mei'
					,6=>'Juni'
					,7=>'Juli'
					,8=>'Agustus'
					,9=>'September'
					,10=>'Oktober'
					,11=>'November'
					,12=>'Desember'
					);
		return $month_list;
	}
	function getYearList($start=0,$end=0)
	{
		$year_list = array();
		for($x = $start; $x < $end; $x++) {
			$year_list[] = $x;
		}
		return $year_list;
	}
	
} 
