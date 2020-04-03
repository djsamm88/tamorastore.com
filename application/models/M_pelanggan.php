<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class M_pelanggan extends CI_Model {
		
	function __construct() {
		parent::__construct();
	
		$this->load->helper('custom_func');
	}

	public function m_data()
	{
		$q = $this->db->query("SELECT a.* FROM tbl_pelanggan a ");
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


}