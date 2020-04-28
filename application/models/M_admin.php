<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

	class M_admin extends CI_Model {
		
		function __construct() {
			parent::__construct();
		
			$this->load->helper('custom_func');
		}


	public function m_data_admin()
	{
		$q = $this->db->query("SELECT a.* FROM tbl_admin a ");
		return $q->result();
	}


	public function m_data_admin_by_id($id_admin)
	{
		$q = $this->db->query("SELECT a.*
									FROM tbl_admin a 
									
									WHERE a.id_admin='$id_admin'
							  ");
		return $q->result();
	}


	public function cek_email_user($user,$email)
	{
		$query = $this->db->query("SELECT * FROM tbl_admin WHERE user_admin='$user' OR email_admin='$email'");
		return $query->num_rows();
	}


	public function tambah_admin($serialize)
	{
		$this->db->set($serialize);
		$this->db->insert('tbl_admin');
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

	public function m_data_desa()
	{
		$q = $this->db->query("SELECT a.*,b.id AS id_kecamatan,b.kecamatan FROM tbl_desa a LEFT JOIN tbl_kecamatan b ON a.id_kecamatan=b.id");
		return $q->result();
	}
}