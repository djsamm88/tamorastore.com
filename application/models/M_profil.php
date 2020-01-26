<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

	class M_profil extends CI_Model {
		
		function __construct() {
			parent::__construct();
		
			$this->load->helper('custom_func');
		}


	//model data user
	public function data_session_user($id_admin) {			
		$query = $this->db->query("SELECT * FROM tbl_admin WHERE id_admin='$id_admin'");
		$data 	= $query->result();			
		$row 	= $data[0];
		return $row;
	}


	public function cek_email_user($user,$email)
	{
		$query = $this->db->query("SELECT * FROM tbl_admin WHERE user_admin='$user' OR email_admin='$email'");
		return $query->num_rows();
	}


	public function cek_pass($id_admin)
	{
		$query = $this->db->query("SELECT pass_admin FROM tbl_admin WHERE id_admin='$id_admin'");
		$x = $query->result();
		return $x[0]->pass_admin;
	}
	
	
	public function update_admin($serialize,$id_admin)
	{
		$this->db->set($serialize);
		$this->db->where('id_admin',$id_admin);
		$this->db->update('tbl_admin');
	}

}