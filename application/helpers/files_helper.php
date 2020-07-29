<?php


function get_profile_pict($id=0,$size='')
{
	$profile_pict = 'files/profile/';
	$CI =& get_instance();
	// get file name
	$where['Category'] = 'Profile';
	$where['fidData'] = $id;
	$CI->db->where($where);
	$query = $CI->db->get('public.fileUpload');
	$data = $query->row_array();
	$query->free_result();
	if ($data)
		$profile_pict .= 'thumbnails_'.$size.'/'.$data['FileName'].'-'.$size.'.'.$data['FileExtention'];
	else
		$profile_pict .= 'thumbnails_'.$size.'/avatar-'.$size.'.jpg';
	return base_url().$profile_pict;
}

?>