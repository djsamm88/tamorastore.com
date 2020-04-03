<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

	class M_gudang extends CI_Model {
		
		function __construct() {
			parent::__construct();
		
			$this->load->helper('custom_func');
		}




	public function m_data()
	{
		$q = $this->db->query("SELECT a.* FROM tbl_gudang a ");
		return $q->result();
	}


	public function m_by_id($id_gudang)
	{
		$q = $this->db->query("SELECT a.*
									FROM tbl_gudang a 
									
									WHERE a.id_gudang='$id_gudang'
							  ");
		return $q->result();
	}


	public function insert($serialize)
	{
		$this->db->set($serialize);
		$this->db->insert('tbl_gudang');
	}

	public function update($serialize,$id_gudang)
	{
		$this->db->set($serialize);
		$this->db->where('id_gudang',$id_gudang);
		$this->db->update('tbl_gudang');
	}
}