<?php
function humanize_date($date)
{
	$value = $date;
	if ($value)
	{
		$year = substr($value, 0,4);
		$month = substr($value, 5,2);
		$day = substr($value, 8,2);
		$value = $day.'-'.$month.'-'.$year;
	}
	return $value;
}
function get_themes(){
    $_this = & get_Instance();
	$conf = site_url('asset/themes');
	if($conf <> ''){
		return $conf;
	}else{
		return false;
	}
}

function get_myconf($var){
    $_this = & get_Instance();
	$conf = $_this->config->item($var);
	if($conf <> ''){
		return $conf;
	}else{
		return false;
	}
}

if ( ! function_exists('match_key'))
{
	function match_key($data,$key)
	{
		$data_upper = trim(strtoupper($data));
		$key_upper = trim(strtoupper($key));
		$pos_start = strrpos($data_upper,$key_upper);
		$result = $data;
		$mark_start = '<span class="filteredKey">';
		$mark_end = '</span>';
		if ($pos_start OR $key_upper == substr($data_upper,0,strlen($key_upper)) )
		{
			$pos_end = $pos_start + strlen($key_upper);
			$result = substr_replace($data,$mark_start,$pos_start,0);
			$result = substr_replace($result,$mark_end,$pos_end+strlen($mark_start),0);
		}
		
		return $result;
	}
}
if ( ! function_exists('text2num'))
{
	function text2num($text='0')
	{
		$result = str_replace(",", "", $text);
		$result = $result?$result:'0';
		return $result;
	}
}

//decode
if ( ! function_exists('encode'))
{
	function encode($str='')
	{
		$result = base64_encode($str);		
		$result = base64_encode($result);
		//$result = strtr($result, '+/', '-_');
		return $result;
	}
}
if ( ! function_exists('decode'))
{
	function decode($str='')
	{
		$result = base64_decode($str);		
		$result = base64_decode($result);		
		return $result;
	}
}

// check file poto is exist
if ( ! function_exists('check_profile_pict'))
{
	function check_profile_pict($id,$path=false)
	{
		$path = $path?$path.'/':'';
		$foto = 'files/foto/'.$path.$id.'.jpg';
		if (!file_exists($foto))
			$foto = base_url().'files/foto/nopict.jpg';
		else
			$foto = base_url().$foto;
		return $foto;
	}
}
// Thausand Sparator Numeric
if ( ! function_exists('thausand_spar'))
{
	/*
	$num = numeric value
	$dec_digit = Specifies how many decimals
	$decimal_spar= Specifies what string to use for decimal point
	$thausand_spar = Specifies what string to use for thousands separator
	*/
	function thausand_spar($num,$dec_digit = 0,$decimal_spar='.',$thausand_spar = ',')
	{
		return number_format($num,$dec_digit,$decimal_spar,$thausand_spar);
	}
}

function jml_minggu($tgl_awal, $tgl_akhir){
	$detik = 24 * 3600;
	$tgl_awal = strtotime($tgl_awal);
	$tgl_akhir = strtotime($tgl_akhir);

	$minggu = 0;
	for ($i=$tgl_awal; $i < $tgl_akhir; $i += $detik)
	{
		if (date("w", $i) == "0")
		{
			$minggu++;
		}
	}
	return $minggu;
}	

function str_proper($str)
{
	return ucwords(strtolower($str));
}

function bulan_str($str)
{
	switch ($str) {
		case '01': return 'I'; break;
		case '02': return 'II'; break;
		case '03': return 'III'; break;
		case '04': return 'IV'; break;
		case '05': return 'V'; break;
		case '06': return 'VI'; break;
		case '07': return 'VII'; break;
		case '08': return 'VIII'; break;
		case '09': return 'IX'; break;
		case '10': return 'X'; break;
		case '11': return 'XI'; break;
		case '12': return 'XII'; break;
	}
}

function bulan_name($str)
{
	switch ($str) {
		case '01': return 'Januari'; break;
		case '02': return 'Februari'; break;
		case '03': return 'Maret'; break;
		case '04': return 'April'; break;
		case '05': return 'Mei'; break;
		case '06': return 'Juni'; break;
		case '07': return 'Juli'; break;
		case '08': return 'Agustus'; break;
		case '09': return 'September'; break;
		case '10': return 'Oktober'; break;
		case '11': return 'November'; break;
		case '12': return 'Desember'; break;
	}
}

function set_fullDate($str){
	$old_date = $str; 
	$old_date_timestamp = strtotime($old_date);
	return date('d M Y | H:i', $old_date_timestamp);  
}

function get_client_ip_server() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP')){
    	$ipaddress = getenv('HTTP_CLIENT_IP');
        // $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    }else if(getenv('HTTP_X_FORWARDED_FOR')){
    	$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        // $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else if(getenv('HTTP_X_FORWARDED')){
    	 // else if($_SERVER['HTTP_X_FORWARDED'])
        $ipaddress = getenv('HTTP_X_FORWARDED');
    }else if(getenv('HTTP_FORWARDED_FOR')){
    	 $ipaddress = getenv('HTTP_FORWARDED_FOR');
        // $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    }else if(getenv('HTTP_FORWARDED')){
    	 $ipaddress = getenv('HTTP_FORWARDED');
        // $ipaddress = $_SERVER['HTTP_FORWARDED'];
    }else if(getenv('REMOTE_ADDR')){
    	$ipaddress = getenv('REMOTE_ADDR');
        // $ipaddress = $_SERVER['REMOTE_ADDR'];
    }else{
        $ipaddress = 'UNKNOWN';
    }
 	

    return $ipaddress;
}

function get_client_location($ipaddress) {
 	
 	if (!$ipaddress == 'UNKNOWN') {
 		$json     = file_get_contents("http://ipinfo.io/$ipaddress/geo");
		$json     = json_decode($json, true);
		$country  = $json['country'];
		$region   = $json['region'];
		$city     = $json['city'];

		 return $country.', '.$region.', '.$city;
 	}else{
 	 	 return 'UNKNOWN';
 	}

  
}

 
function custom_echo($x, $length)
	{
	  if(strlen($x)<=$length)
	  {
	    echo $x;
	  }
	  else
	  {
	    $y=substr($x,0,$length) . '...';
	    echo $y;
	  }
	}