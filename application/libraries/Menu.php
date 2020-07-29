<?php

class Menu
{
    private $lang = '';
    private $idMsOperator = '';
    private $baseUrl = '';
	
	function __construct()
    {
        $this->CI =& get_instance();
        $this->idMsOperator = $this->CI->session->userdata('Operator')['idMsOperator'];
		$this->lang = get_language();
		$this->baseUrl = base_url();
	}
	function build_short_cut($id=0)
	{
		$where['fidAppMenu'] = $id;
		$where['sk."idAppShortCut" IN 
				(SELECT "fidAppShortCut"
						FROM "public"."msOperatorAppShortCut" om
						WHERE om."Status" = 1 and
							om."fidMsOperator" = '.$this->idMsOperator.')'] = null;
		//
		$this->CI->db->where($where); 
		$this->CI->db->order_by('OrderBy','ASC');
		$short_key_list = $this->CI->db->get('public."AppShortCut" sk');
		// echo $this->CI->db->last_query();
		$data['list'] = $short_key_list;
		$data['content'] = 'tpl_short_cut';
		$this->CI->load->view($data['content'],$data);
	}
	function build()
	{
		// load header menu		
		$where['fidAppMenu'] = 0; // 0 = menu header
		// $where['AppType'] = 1; 
		$where['am."idAppMenu" IN 
				(SELECT "fidAppMenu"
						FROM "public"."msOperatorPrivilege" om
						WHERE om."fidMsOperator" = '.$this->idMsOperator.'
							AND om."Status" = 1)'] = null;
		$this->CI->db->where($where); 
		$this->CI->db->order_by('GroupMenu','ASC');
		$this->CI->db->order_by('OrderBy','ASC');
		$menu = $this->CI->db->get('public."AppMenus" am');
		$result = '';
		$grp_menu = '';
		$groupMenu = 0;
		foreach ($menu->result_array() as $mn)
		{
			if ($groupMenu <> $mn['GroupMenu'])
			{
				if($mn['GroupMenu']==1){
					$grp_menu = 'H1';
				}elseif($mn['GroupMenu']==2){
					$grp_menu = 'H2';
				}elseif($mn['GroupMenu']==3){
					$grp_menu = 'H3';
				}elseif($mn['GroupMenu']==4){
					$grp_menu = 'HC3';
				}elseif($mn['GroupMenu']==9){
					$grp_menu = 'Utilities';
				}else{
					$grp_menu = '';
				}
				// if ($mn['GroupMenu'] == 9)
				// {
					// $result .=' <li class="header">Utilities</li>';
				// }else
				// {
					// $result .=' <li class="header">'.$grp_menu.'</li>';
				// }
				$result .=' <li class="header">'.$grp_menu.'</li>';
			}
			$result .=' <li class="treeview">';
			$onclick = ($mn['URL']?'onclick="loadMainContent(\''.$mn['URL'].'\')"':'');
			$result .= '<a href="#" '.$onclick.' title="'.$mn['Description'].'">
							<i class="fa '.$mn['IconImg'].'"></i> 
							<span>'.$mn['Title'].'</span> ';
			// load sub menu
			$result_sub = $this->build_sub($mn['idAppMenu']);
			if ($result_sub)
			{
				$result .= 	'<i class="fa fa-angle-left pull-right"></i>';
			}
			$result .= 	'</a>';
			$result .= $result_sub;
			$result .='	</li>';
			//
			$groupMenu = $mn['GroupMenu'];
		}
		// $result .= '';
		echo $result;
		
	}
	
	private function  build_sub($idMenu)
	{
		$result = '';
		$this->CI->db->where('am."fidAppMenu" = '.$idMenu);
		$this->CI->db->where('am."idAppMenu" IN 
								(SELECT "fidAppMenu"
									FROM public."msOperatorPrivilege" om
									WHERE "om"."Status" = 1
										AND om."fidMsOperator" = '.$this->idMsOperator.')');
		$this->CI->db->order_by('OrderBy','ASC');
		$menu_sub = $this->CI->db->get('public."AppMenus" am');
		if ($menu_sub->num_rows() > 0)
		{
			$result .=' <ul class="treeview-menu">';
			foreach ($menu_sub->result_array() as $mn)
			{
				$result_sub = '';
				$result .='<li>';
				$onclick = ($mn['URL']?'loadMainContent(\''.$mn['URL'].'\')':'alert(\'menu '.$mn['Title'].' belum aktif\')');
				$result .= '<a href="#"  onclick="'.$onclick.'" title="'.$mn['Description'].'">';
				$icon = $mn['IconImg'];
				if (!$mn['IconImg']) $icon = 'fa-genderless'; // jika baris ini diaktikan, default icon akan diisi bulet
				$result .= '<i class="fa '.$icon.'"></i>'; 
				$result .= '<span>'.$mn['Title'].'</span>';
				// load sub menu
				$result_sub = $this->build_sub($mn['idAppMenu']);
				if ($result_sub)
				{
					$result .='<i class="fa fa-angle-left pull-right"></i>';
				}
				$result .= $result_sub;
				$result .='</a>';
				$result .='</li>';
			}
			$result .='</ul>';
		}
		return $result;
	}
	function build_dashboard($id)
	{
		// load dashboard		
		$where['fidAppMenu'] = $id;
		
		$where['am."idAppDashboard" IN 
				(SELECT "fidAppDashboard"
						FROM "public"."msOperatorDashboardPrivilege" om
						WHERE om."fidMsOperator" = '.$this->idMsOperator.'
							AND om."Status" = 1)'] = null;
		$this->CI->db->where($where); 
		$this->CI->db->order_by('GroupName','ASC');
		$this->CI->db->order_by('OrderBy','ASC');
		$dash = $this->CI->db->get('public."AppDashboard" am');
		$result = '';
		foreach ($dash->result_array() as $mn)
		{
			$result .= '<div class="row" id="'.$mn['IdResult'].'" hidden></div>';
		}
		// $result .= '';
		echo $result;
		
	}
}