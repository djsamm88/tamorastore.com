<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

	class M_pemasukan_lain extends CI_Model {
		
		function __construct() {
			parent::__construct();
		
			$this->load->helper('custom_func');
		}



	public function m_data()
	{
		$q = $this->db->query("SELECT * FROM tbl_pemasukan_lain 							
								ORDER BY id ASC
					");
		return $q->result();
	}

	public function m_data_telah_bayar($id_paket,$id_jamaah)
	{
		$q = $this->db->query("SELECT id,id_paket,id_jamaah,id_pemasukan_lain,SUM(jumlah) AS jumlah , nama_pemasukan,tgl_update
										FROM `tbl_pemasukan_lain_transaksi` 
										WHERE id_paket='$id_paket' AND id_jamaah='$id_jamaah' AND jumlah<>0
								GROUP BY id_pemasukan_lain
					");
		return $q->result();
	}

	


	public function m_by_id($id)
	{
		$q = $this->db->query("SELECT * FROM tbl_pemasukan_lain WHERE id='$id'");
		return $q->result();
	}


	public function tambah_data($serialize)
	{
		$this->db->set($serialize);
		$this->db->insert('tbl_pemasukan_lain');
	}


	public function update_data($serialize,$id)
	{
		$this->db->set($serialize);
		$this->db->where('id',$id);
		$this->db->update('tbl_pemasukan_lain');
	}

	public function m_hapus_data($id)
	{		
		$this->db->where('id',$id);
		$this->db->delete('tbl_pemasukan_lain');
	}


}