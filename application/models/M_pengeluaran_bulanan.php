<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

	class M_pengeluaran_bulanan extends CI_Model {
		
		function __construct() {
			parent::__construct();
		
			$this->load->helper('custom_func');
		}



	public function m_data()
	{
		$q = $this->db->query("SELECT * FROM tbl_pengeluaran_bulanan 							
								ORDER BY id ASC
					");
		return $q->result();
	}

	public function m_trx_pengeluaran_bulanan()
	{
		$q = $this->db->query("SELECT a.*
								FROM `tbl_pengeluaran_bulanan_transaksi` a 								
								ORDER BY tgl_update DESC
							 ");
		return $q->result();
	}

	


	public function m_by_id($id)
	{
		$q = $this->db->query("SELECT * FROM tbl_pengeluaran_bulanan WHERE id='$id'");
		return $q->result();
	}


	public function tambah_data($serialize)
	{
		$this->db->set($serialize);
		$this->db->insert('tbl_pengeluaran_bulanan');
	}


	public function update_data($serialize,$id)
	{
		$this->db->set($serialize);
		$this->db->where('id',$id);
		$this->db->update('tbl_pengeluaran_bulanan');
	}

	public function m_hapus_data($id)
	{		
		$this->db->where('id',$id);
		$this->db->delete('tbl_pengeluaran_bulanan');
	}


}