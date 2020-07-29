<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class Auth {

	var $CI = null;

	function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->database();
	}
	
	function do_login($login = NULL)
	{
		$result['login'] = false;
		$result['message'] = '';
	
		// A few safety checks
		// Our array has to be set
		if(!isset($login))
			return $result;
	
		// get user info
		$this->CI->db->select('*');
		// $this->CI->db->select('lastaktif as "CurDate"',false);
		$this->CI->db->from('users');
		if (isset($login['id']))
		{
			// untuk switch user
			$this->CI->db->where('id',$login['id']);
		}else{
			//Our array has to have 2 values
			//No more, no less!
			if(count($login) != 2)
				return $result;
			//
			$email = $login['email'];
			$password = $login['password'];
			$nChar = strlen($password)+1;
			$password = $password;
			// $x = 1; 
			// while($x <= $nChar) 
			// {
				$password = md5($password);
			// 	$x++;
			// } 

			$this->CI->db->where('email', $email);
			$this->CI->db->where('password',$password);
		}
		// execute
		$query = $this->CI->db->get();
		$operator = $query->row_array();

		// echo $this->CI->db->last_query();exit;
		if ($operator['id'])
		{
			// get dealer
			$this->CI->db->select('*');
			$this->CI->db->from('users');
			$this->CI->db->where('id',$operator['id']);
			$query = $this->CI->db->get();
			$users = $query->row_array();

			$newdata['User'] = $users;
			$this->CI->session->set_userdata($newdata);	  
			// done
			$result['login'] = true;
			$result['message'] = 'Login succes';
		}else{
			$result['message'] = 'username or password is incorrect';
		}
		return $result;

	}
	
	
	 /**
	 *
	 * This function restricts users from certain pages.
	 * use restrict(TRUE) if a user can't access a page when logged in
	 *
	 * @access	public
	 * @param	boolean	wether the page is viewable when logged in
	 * @return	void
	 */	
	function restrict($logged_out = FALSE)
	{
		// If the user is logged in and he's trying to access a page
		// he's not allowed to see when logged in,
		// redirect him to the index!
		if ($logged_out && is_logged_in())
		{
				redirect('');
				exit;
				//echo $this->CI->fungsi->warning('Maaf, sepertinya Anda sudah login...',site_url());
				//die();
		}
		
		// If the user isn' logged in and he's trying to access a page
		// he's not allowed to see when logged out,
		// redirect him to the login page!
		if ( ! $logged_out && !is_logged_in()) 
		{
				echo $this->CI->fungsi->warning('Anda diharuskan untuk Login bila ingin mengakses halaman ini.',site_url());
				die();
		}
	}
	
	function logout() 
	{
		$this->CI->session->sess_destroy();	
		return TRUE;
	}
	
	function cek($id,$ret=false)
	{
		$menu = array(
			'data_master'=>'+admin+',
			'manajemen_user'=>'+admin+'
		);
		$allowed = explode('+',$menu[$id]);
		if(!in_array(from_session('level'),$allowed))
		{
			if($ret) return false;
			echo $this->CI->fungsi->warning('Anda tidak diijinkan mengakses halaman ini.',site_url());
			die();
		}
		else
		{
			if($ret) return true;
		}
	}	
}
// End of library class
// Location: system/application/libraries/Auth.php
