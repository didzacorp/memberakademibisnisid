<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Membership_model extends Base_Model {

	function __construct() {

        parent::__construct();
		$this->set_table('member');
		$this->set_pk('id');
		$this->set_log(true);
    }	
		


	function get_list()
	{
		$this->db->select('(Select count(id) from member mbr where mbr.upline_level_1 = tbl.id ) AS total_upline1');
		$this->db->select('tbl.*');
		$this->db->where($this->where);
		if($this->order_by){
			$this->db->order_by($this->pk_field.' DESC');
		}
		
		foreach ($this->order_by as $key => $value)
		{
			$this->db->order_by($key, $value);
		}

		if (!$this->limit AND !$this->offset)
			$query = $this->db->get($this->table.' tbl');
		else
			$query = $this->db->get($this->table.' tbl',$this->limit,$this->offset);
		// echo $this->db->last_query();
		// exit;
        if($query->num_rows()>0)
		{
			return $query;
        
		}else
		{
			$query->free_result();
            return $query;
        }
	}

	function getKomisi()
	{
		$id_member = $this->session->userdata('id');
		$lisensi = $this->session->userdata('lisensi');
		$month = date('m');
		$year = date('Y');

		if ($lisensi == 'BASIC') {
			$memberUpline = "and id_member in(select id from member where (upline_level_1 = '$id_member'))";
		}else if ($lisensi == 'AGEN') {
			$memberUpline = "and id_member in(select id from member where (upline_level_1 = '$id_member' or upline_level_2 = '$id_member'))";
		}else if ($lisensi == 'STOKIS') {
			$memberUpline = "and id_member in(select id from member where (upline_level_1 = '$id_member' or upline_level_2 = '$id_member' or upline_level_3 = '$id_member'))";
		}else{
			$memberUpline = '';
		}

		$this->db->select("
			(select count(id) from komisi where id_member ='3' and year(tanggal) = '$year' and month(tanggal) = '$month' 
												and jenis_komisi in('PENDAFTARAN')) AS jumlah_member,

			(select sum(komisi) from komisi where id_member ='3' and year(tanggal) = '$year' and month(tanggal) = '$month' 
												  and jenis_komisi in('PENDAFTARAN','UPGRADE LISENSI AGEN','UPGRADE LISENSI STOKIS')) AS komisi_referal,

			(select sum(komisi) from komisi where  
												  jenis_komisi = 'PENJUALAN' and year(tanggal) = '$year' 
												  and month(tanggal) = '$month'  $memberUpline) AS komisi_penjualan,

			(select  (sum(sub_total) - sum(diskon)) as total_transaksi from transaksi where  jenis_transaksi= 'PENJUALAN' and year(tanggal) = '$year'
								    and month(tanggal) = '$month' $memberUpline) AS omset_penjualan
		");

		$this->db->where(array('id' => $id_member));
		$query = $this->db->get('member tbl');		
		// echo $this->db->last_query();
		// exit;
		$data = $query->row_array();
		return $data;
	}

	function get_listHistory()
	{

		$id_member = $this->session->userdata('id');
		$lisensi = $this->session->userdata('lisensi');
		$month = date('m');
		$year = date('Y');

		if ($lisensi == 'BASIC') {
			$memberUpline = "and id_member in(select id from member where (upline_level_1 = '$id_member'))";
		}else if ($lisensi == 'AGEN') {
			$memberUpline = "and id_member in(select id from member where (upline_level_1 = '$id_member' or upline_level_2 = '$id_member'))";
		}else if ($lisensi == 'STOKIS') {
			$memberUpline = "and id_member in(select id from member where (upline_level_1 = '$id_member' or upline_level_2 = '$id_member' or upline_level_3 = '$id_member'))";
		}else{
			$memberUpline = '';
		}

		$this->db->select("ID,id_member,tanggal,Concat(Year(tanggal),LPAD(Month(tanggal), 2, 0)),
		(SELECT Count(id) 
        FROM   komisi 
        WHERE  id_member = '3' 
               AND Concat(Year(tanggal),LPAD(Month(tanggal), 2, 0)) != '".date('Ym')."'
               AND jenis_komisi IN( 'PENDAFTARAN' ))                  AS 
       jumlah_member, 
       (SELECT Sum(komisi) 
        FROM   komisi 
        WHERE  id_member = '3' 
               AND Concat(Year(tanggal),LPAD(Month(tanggal), 2, 0)) != '".date('Ym')."'
               AND jenis_komisi IN( 'PENDAFTARAN', 'UPGRADE LISENSI AGEN', 
                                    'UPGRADE LISENSI STOKIS' 
                                  ))                                  AS 
       komisi_referal, 
       (SELECT Sum(komisi) 
        FROM   komisi 
        WHERE  jenis_komisi = 'PENJUALAN' 
                AND Concat(Year(tanggal),LPAD(Month(tanggal), 2, 0)) != '".date('Ym')."' 
               $memberUpline) AS 
       komisi_penjualan, 
       (SELECT ( Sum(sub_total) - Sum(diskon) ) AS total_transaksi 
        FROM   transaksi 
        WHERE  jenis_transaksi = 'PENJUALAN' 
               AND  Concat(Year(tanggal),LPAD(Month(tanggal), 2, 0)) != '".date('Ym')."'
               $memberUpline) AS 
       omset_penjualan 
		");
		$this->db->where(array(
			"id_member" => $id_member,
			"Concat(Year(tanggal),LPAD(Month(tanggal), 2, 0)) != '".date('Ym')."' " => NULL,

		));
		$this->db->where($this->where);
		if($this->order_by){
			$this->db->order_by($this->pk_field.' DESC');
		}

		$this->db->group_by('year(tbl.tanggal)');
		$this->db->group_by('LPAD(Month(tbl.tanggal), 2, 0)');
		
		foreach ($this->order_by as $key => $value)
		{
			$this->db->order_by($key, $value);
			
		}

		if (!$this->limit AND !$this->offset)
			$query = $this->db->get('komisi tbl');
		else
			$query = $this->db->get('komisi tbl',$this->limit,$this->offset);
		// echo $this->db->last_query();
		// exit;
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

/* End of file dealer_model.php */
/* Location: ./application/modules/master.mitra/models/dealer_model.php */
