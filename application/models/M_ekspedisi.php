<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

	class M_ekspedisi extends CI_Model {
		
		function __construct() {
			parent::__construct();
		
			$this->load->helper('custom_func');
		}




	public function m_data()
	{
		$q = $this->db->query("SELECT a.* FROM tbl_ekspedisi a ");
		return $q->result();
	}


	public function m_by_id($id_ekspedisi)
	{
		$q = $this->db->query("SELECT a.*
									FROM tbl_ekspedisi a 
									
									WHERE a.id_ekspedisi='$id_ekspedisi'
							  ");
		return $q->result();
	}


	public function m_by_nama($nama_ekspedisi)
	{
		$q = $this->db->query("SELECT a.*
									FROM tbl_ekspedisi a 
									
									WHERE a.nama_ekspedisi='$nama_ekspedisi'
							  ");
		return $q->result();
	}


	public function insert($serialize)
	{
		$this->db->set($serialize);
		$this->db->insert('tbl_ekspedisi');
	}

	public function update($serialize,$id_ekspedisi)
	{
		$this->db->set($serialize);
		$this->db->where('id_ekspedisi',$id_ekspedisi);
		$this->db->update('tbl_ekspedisi');
	}
}