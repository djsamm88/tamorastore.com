<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

	class M_pengeluaran extends CI_Model {
		
		function __construct() {
			parent::__construct();
		
			$this->load->helper('custom_func');
		}



	public function m_data()
	{
		$q = $this->db->query("SELECT * FROM tbl_pengeluaran 							
								ORDER BY id ASC
					");
		return $q->result();
	}

	public function m_trx_pengeluaran()
	{
		$q = $this->db->query("SELECT a.*,b.nama_paket,b.id AS id_paket,b.tgl_umroh 
								FROM `tbl_pengeluaran_transaksi` a 
								LEFT JOIN 
								tbl_paket b 
								ON a.id_paket=b.id
								ORDER BY tgl_update DESC
							 ");
		return $q->result();
	}

	


	public function m_by_id($id)
	{
		$q = $this->db->query("SELECT * FROM tbl_pengeluaran WHERE id='$id'");
		return $q->result();
	}


	public function tambah_data($serialize)
	{
		$this->db->set($serialize);
		$this->db->insert('tbl_pengeluaran');
	}


	public function update_data($serialize,$id)
	{
		$this->db->set($serialize);
		$this->db->where('id',$id);
		$this->db->update('tbl_pengeluaran');
	}

	public function m_hapus_data($id)
	{		
		$this->db->where('id',$id);
		$this->db->delete('tbl_pengeluaran');
	}


}