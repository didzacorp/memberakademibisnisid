<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('getSQLDate'))
{
	function getSQLDate($inputDate) 
	{
		$return_value = 'NULL';
		if ($inputDate !='')
		{
			$date = null;
			$inputDate = date('d-m-Y',strtotime($inputDate));
			if (strlen($inputDate) > 10)
			{
				list($date, $time) = explode(' ', $inputDate);
			}
			else
			{
				$date = $inputDate;
				$time = '00:00:00';
			}
			// echo num2month($dt[1],2).'__'.$dt[1].'__'.$dt[0];
			list($day, $month, $year) = preg_split("/[\/.-]/", $date);
			if (strlen($year)==2)
				list($year, $month, $day) = preg_split("/[\/.-]/", $date);
			
			$day = strlen($day)==1?'0'.$day:$day;
			$month = strlen($month)==1?'0'.$month:$month;
			$return_value = "$year$month$day";
			
		}
		return $return_value;
	}
}


if ( ! function_exists('humanize_mdate'))
{
	function humanize_mdate($mdate, $datestr = '%d %M %Y',$str_rep='') 
	{
		if ($mdate != '' && $mdate != "0000-00-00")
		{
			$timestamp 	= strtotime($mdate);
			$datestr 	= str_replace('%\\', '', preg_replace("/([a-z]+?){1}/i", "\\\\\\1", $datestr));
				
			return date($datestr, $timestamp);
		}else
		{
			return $str_rep;
		}
	}
}

if ( ! function_exists('num2month'))
{
	function num2month($num=0,$type=1) 
	{
		$month[1]=array('Januari','Februari','Maret','April'
					,'Mei','Juni','Juli','Agustus','September'
					,'Oktober','November','Desember');
		$month[2]=array('Jan','Feb','Mar','Apr'
					,'May','Jun','Jul','Agust','Sep'
					,'Oct','Nov','Dec');
		$month[3]=array('I','II','III','IV'
					,'V','VI','VII','VIII'
					,'IX','X','XI','XII');
		$month[4]=array('January','February','March','April'
					,'May','June','July','August','September'
					,'October','November','December');
		
		
		return $month[$type][$num-1];
	}
}

if ( ! function_exists('month2num'))
{
	function month2num($num=0) 
	{
		$month['Januari'] = '1';
		$month['Februari'] = '2';
		$month['Maret'] = '3';
		$month['April'] = '4';
		$month['Mei'] = '5';
		$month['Juni'] = '6';
		$month['Juli'] = '7';
		$month['Agustus'] = '8';
		$month['September'] = '9';
		$month['Oktober'] = '10';
		$month['November'] = '11';
		$month['Desember'] = '12';
		
		$month['Jan'] = '1';
		$month['Feb'] = '2';
		$month['Mar'] = '3';
		$month['Apr'] = '4';
		$month['May'] = '5';
		$month['Jun'] = '6';
		$month['Jul'] = '7';
		$month['Agust'] = '8';
		$month['Sept'] = '9';
		$month['Oct'] = '10';
		$month['Nov'] = '11';
		$month['Dec'] = '12';
		
		// return $month[$num];
		// $month=array('1','2','3','4'
					// ,'5','6','7','8','9'
					// ,'10','11','12');
		return $month[$num];
	}
}

if ( ! function_exists('humanize_day'))
{
	function humanize_day($mdate) 
	{
		$day = array('Minggu','Senin','Selasa','Rabu','Kamis',"Jum'at",'Sabtu');
		$dt = strtotime($mdate);
		$dow = date('w',$dt);
		return $day[$dow];
	}
}
// convert integer to time
if ( ! function_exists('int2time'))
{
	function int2time($value)
	{
		
		$hour = floor($value/60);
		$minute = $value - ($hour * 60);
		$return = (strlen($hour)==1?'0':'').$hour.':'.(strlen($minute)==1?'0':'').$minute;
		return $return;
	}
}
// convert time to integer
if ( ! function_exists('time2int'))
{
	function time2int($value)
	{
		$return = $value;
		$time = explode(':',$return);
		$return = $time[0]*60+$time[1];
		return $return;
	}
}

//untuk mengetahui bulan bulan
if ( ! function_exists('month2bulan'))
{
    function month2bulan($bln,$tp=0)
    {
		if($tp==1){
			switch ($bln)
			{
				case 1:
					return "Jan";
					break;
				case 2:
					return "Feb";
					break;
				case 3:
					return "Mar";
					break;
				case 4:
					return "Apr";
					break;
				case 5:
					return "Mei";
					break;
				case 6:
					return "Jun";
					break;
				case 7:
					return "Jul";
					break;
				case 8:
					return "Ags";
					break;
				case 9:
					return "Sep";
					break;
				case 10:
					return "Okt";
					break;
				case 11:
					return "Nov";
					break;
				case 12:
					return "Des";
					break;
			}
		}else{
			switch ($bln)
			{
				case 1:
					return "Januari";
					break;
				case 2:
					return "Februari";
					break;
				case 3:
					return "Maret";
					break;
				case 4:
					return "April";
					break;
				case 5:
					return "Mei";
					break;
				case 6:
					return "Juni";
					break;
				case 7:
					return "Juli";
					break;
				case 8:
					return "Agustus";
					break;
				case 9:
					return "September";
					break;
				case 10:
					return "Oktober";
					break;
				case 11:
					return "November";
					break;
				case 12:
					return "Desember";
					break;
			}
        }
    }
}
 
//format tanggal yyyy-mm-dd
if ( ! function_exists('bayssl_date_indo'))
{
    function bayssl_date_indo($tgl,$tp=0)
    {
        $ubah = gmdate($tgl, time()+60*60*8);
        $pecah = explode("-",$ubah);  //memecah variabel berdasarkan -
        $tanggal = $pecah[2];
        $bulan = month2bulan($pecah[1],$tp);
        $tahun = $pecah[0];
        return $tanggal.' '.$bulan.' '.$tahun; //hasil akhir
    }
}
 
//format tanggal timestamp
if( ! function_exists('bayssl_date_indo_timestamp')){
 
	function bayssl_date_indo_timestamp($tgl,$tp=0)
	{
		$inttime=date('Y-m-d H:i:s',$tgl); //mengubah format menjadi tanggal biasa
		$tglBaru=explode(" ",$inttime); //memecah berdasarkan spaasi
		 
		$tglBaru1=$tglBaru[0]; //mendapatkan variabel format yyyy-mm-dd
		$tglBaru2=$tglBaru[1]; //mendapatkan fotmat hh:ii:ss
		$tglBarua=explode("-",$tglBaru1); //lalu memecah variabel berdasarkan -
	 
		$tgl=$tglBarua[2];
		$bln=$tglBarua[1];
		$thn=$tglBarua[0];
	 
		$bln=month2bulan($bln,$tp); //mengganti bulan angka menjadi text dari fungsi bulan
		$ubahTanggal="$tgl $bln $thn | $tglBaru2 "; //hasil akhir tanggal
	 
		return $ubahTanggal;
	}
}
if ( ! function_exists('bulanid2no'))
{
    function bulanid2no($inputDate,$tp=0)
    {
		$newDate = explode(' ', $inputDate);
		$date	= $newDate[0];
		$month	= $newDate[1];
		$years	= $newDate[2];
        if($tp==1){
			switch ($month)
			{
				case "Januari":
					return $years."-01-".$date;
					break;
				case "Februari":
					return $years."-02-".$date;
					break;
				case "Maret":
					return $years."-03-".$date;
					break;
				case "April":
					return $years."-04-".$date;
					break;
				case "Mei":
					return $years."-05-".$date;
					break;
				case "Juni":
					return $years."-06-".$date;
					break;
				case "Juli":
					return $years."-07-".$date;
					break;
				case "Agustus":
					return $years."-08-".$date;
					break;
				case "September":
					return $years."-09-".$date;
					break;
				case "Oktober":
					return $years."-10-".$date;
					break;
				case "November":
					return $years."-11-".$date;
					break;
				case "Desember":
					return $years."-12-".$date;
					break;
			}
		}else{
			switch ($month)
			{
				case "Januari":
					return $years."01".$date;
					break;
				case "Februari":
					return $years."02".$date;
					break;
				case "Maret":
					return $years."03".$date;
					break;
				case "April":
					return $years."04".$date;
					break;
				case "Mei":
					return $years."05".$date;
					break;
				case "Juni":
					return $years."06".$date;
					break;
				case "Juli":
					return $years."07".$date;
					break;
				case "Agustus":
					return $years."08".$date;
					break;
				case "September":
					return $years."09".$date;
					break;
				case "Oktober":
					return $years."10".$date;
					break;
				case "November":
					return $years."11".$date;
					break;
				case "Desember":
					return $years."12".$date;
					break;
			}
		}
		
    }
}

if ( ! function_exists('setSQLDate'))
{
	function setSQLDate($inputDate) 
	{
		$return_value = 'NULL';
		if ($inputDate !='')
		{
			$date = null;
			$inputDate = date('d-m-Y',strtotime($inputDate));
			if (strlen($inputDate) > 10)
			{
				list($date, $time) = explode(' ', $inputDate);
			}
			else
			{
				$date = $inputDate;
				$time = '00:00:00';
			}
			// echo num2month($dt[1],2).'__'.$dt[1].'__'.$dt[0];
			list($day, $month, $year) = preg_split("/[\/.-]/", $date);
			if (strlen($year)==2)
				list($year, $month, $day) = preg_split("/[\/.-]/", $date);
			
			$day = strlen($day)==1?'0'.$day:$day;
			$month = strlen($month)==1?'0'.$month:$month;
			$return_value = $year.'-'.$month.'-'.$day;
			
		}
		return $return_value;
	}
}

/* End of file MY_url_helper.php */
/* Location: ./application/helpers/MY_url_helper.php */