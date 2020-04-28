<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class M_pelanggan extends CI_Model {
		
	function __construct() {
		parent::__construct();
	
		$this->load->helper('custom_func');
	}



	public function cek_email_user($email)
	{
		$query = $this->db->query("SELECT * FROM tbl_pelanggan WHERE email_pembeli='$email'");
		return $query->num_rows();
	}

	public function m_data()
	{
		$q = $this->db->query("SELECT a.* FROM tbl_pelanggan a ");
		return $q->result();
	}

	public function m_data_autocomplete($cari)
	{
		$q = $this->db->query("SELECT a.* FROM tbl_pelanggan a WHERE nama_pembeli LIKE '%$cari%'");
		return $q->result();
	}
	

	public function m_by_id($id_pelanggan)
	{
		$q = $this->db->query("SELECT a.*
									FROM tbl_pelanggan a 
									
									WHERE a.id_pelanggan='$id_pelanggan'
							  ");
		return $q->result();
	}

	public function insert($serialize)
	{
		$this->db->set($serialize);
		$this->db->insert('tbl_pelanggan');
		return $this->db->insert_id();
	}

	public function update($serialize,$id_pelanggan)
	{
		$this->db->set($serialize);
		$this->db->where('id_pelanggan',$id_pelanggan);
		$this->db->update('tbl_pelanggan');
	}




	public function trx_by_pengguna($id_pelanggan)
	{
		$q = $this->db->query("SELECT * FROM `tbl_transaksi` WHERE id_group='8' AND id_pelanggan='$id_pelanggan'");
		return $q->result();
	}

	public function insert_trx($serialize)
	{
		$this->db->set($serialize);
		$this->db->insert('tbl_transaksi');
		return $this->db->insert_id();
	}


}