<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**/
function is_logged_in()
{
	$CI =& get_instance();
	$ss = $CI->session->userdata('LoggedIn');
	if($ss != '')
	{
	    return TRUE;
	}
	return FALSE;
}

if ( ! function_exists('log2file'))
{
	function log2file($msg)
	{
		$myFile = "log_file.txt";
		$fh = fopen($myFile, 'a') or die("can't open file");
		$stringData = date("Y-m-d h:m:s").chr(13);
		fwrite($fh, $stringData);
		
		fwrite($fh, $msg.chr(13).chr(13));
		fclose($fh);
	}
}
if ( ! function_exists('GUID'))
{
	function GUID()
	{
		 if (function_exists('com_create_guid') === true)
    {
        return trim(com_create_guid(), '{}');
    }

    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
	}
}