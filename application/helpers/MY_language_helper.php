<?php

function get_language($id=false){
	$CI =& get_instance();
	$lang_result = '';
	if($id){
		$lang_value = lang(rtrim($id));
		if (!$lang_value)
		{
			$lang_value = '<b>'.$id.'</b> is not found';
		}
		$lang_result = $lang_value;
	}else{
		global $URI;		
		$lang_result =$URI->segment(1);
		if (!$lang_result)
		{
			//$lang_result = 'en';
			if ($CI->session->userdata('language'))
				$lang_result = $CI->session->userdata('language');
			else
				$lang_result = 'en';
		}else
		{
			
		}
		$CI->session->set_userdata('language',$lang_result);
	}
	return $lang_result;
}

