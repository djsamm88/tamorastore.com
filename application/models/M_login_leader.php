<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_login_leader extends CI_Model {

	public function cek_admin($data) {
		
		$query = $this->db->get_where('tbl_admin',$data);			
		return $query;
	}


	public function cek_user($user,$pass) {
		
		$query = $this->db->query("SELECT * FROM tbl_leader  WHERE (no_hp='$user' AND password='$pass')");			
		return $query;
	}

}

?>
