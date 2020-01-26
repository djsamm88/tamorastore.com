<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

	class M_leader extends CI_Model {
		
		function __construct() {
			parent::__construct();
		
			$this->load->helper('custom_func');
		}

	public function m_kelengkapan_jamaah($id_leader)
	{
		$q = $this->db->query("SELECT 
									a.*,
									b.nama AS nama_leader,
									c.total_modal,
									c.tgl_umroh,
									IFNULL(d.telah_dibayar, 0) AS telah_dibayar,
									((IFNULL(c.total_modal, 0)-IFNULL(e.diskon, 0))-IFNULL(d.telah_dibayar,0))*1 AS sisa,
									IFNULL(e.diskon, 0) AS diskon,
									IFNULL(f.jumlah_barang, 0) AS jumlah_barang,
									IFNULL(g.jumlah_pemasukan_lain, 0) AS jumlah_pemasukan_lain,
									h.tgl_umroh
									
									FROM tbl_jamaah a
									LEFT JOIN tbl_leader b
									ON a.id_leader=b.id_leader
									LEFT JOIN 
									(
										SELECT 
											id,tgl_umroh,
										    (harga_paket) AS total_modal
										FROM `tbl_paket`
									)c
									ON a.id_paket=c.id

									LEFT JOIN 
									(
										SELECT 
										id_paket,
										id_jamaah,
										SUM(jumlah_pembayaran) AS telah_dibayar
										FROM tbl_pembayaran
										GROUP BY 
										id_paket,id_jamaah
									)d
									ON a.id_paket=d.id_paket AND a.id_jamaah=d.id_jamaah

									LEFT JOIN 
									(
										SELECT * FROM tbl_diskon WHERE status='1'
									)e
									ON a.id_paket=e.id_paket AND a.id_jamaah=e.id_jamaah									

									LEFT JOIN 
									(
										SELECT id_paket,id_jamaah,SUM(jumlah) AS jumlah_barang
										FROM tbl_barang_transaksi
										WHERE id_jamaah<>0
										GROUP BY id_jamaah,id_paket
									)f
									ON a.id_paket=f.id_paket AND a.id_jamaah=f.id_jamaah									
									
									LEFT JOIN 
									(
										SELECT id_paket,id_jamaah,SUM(jumlah) AS jumlah_pemasukan_lain	
										FROM tbl_pemasukan_lain_transaksi
										GROUP BY id_jamaah,id_paket
									)g
									ON a.id_paket=g.id_paket AND a.id_jamaah=g.id_jamaah									

									LEFT JOIN 
									tbl_paket h 
									ON a.id_paket=h.id 

								 WHERE a.status='1' AND a.id_leader='$id_leader'
								 ORDER BY 
								 (IFNULL(c.total_modal, 0)-IFNULL(d.telah_dibayar,0))*1  DESC
							");
		return $q->result();
	}
	public function m_jamaah_by_leader($id_leader)
	{
		$q = $this->db->query("SELECT a.*,b.nama_paket,b.tgl_umroh,
										(b.harga_paket) AS harga_paket,
										b.fee_leader,
										b.tgl_akhir,
										c.nama AS nama_leader,
                                        IFNULL(d.jumlah,0) AS telah_bayar
									 FROM tbl_jamaah a 
									 LEFT JOIN 
									 tbl_paket b 
									 ON a.id_paket=b.id

									 LEFT JOIN 
									 tbl_leader c 
									 ON a.id_leader=c.id_leader
									 
                                     LEFT JOIN 
                                     tbl_leader_transaksi d 
                                     ON a.id_jamaah=d.id_jamaah AND a.id_paket=d.id_paket
									 WHERE a.status='1'
									 AND a.id_leader ='$id_leader'");
		return $q->result();
	}

	public function m_history_transaksi()
	{
		$q = $this->db->query("SELECT a.*,b.nama AS nama_jamaah,b.no_identitas,
									c.nama_paket,c.tgl_umroh,
									d.nama AS nama_leader 
									FROM `tbl_leader_transaksi` a 
								LEFT JOIN tbl_jamaah b 
								ON a.id_jamaah=b.id_jamaah
								LEFT JOIN tbl_paket c 
								ON a.id_paket=c.id
								LEFT JOIN tbl_leader d 
								ON a.id_leader=d.id_leader
								
								ORDER BY a.tgl_update DESC
								");
		return $q->result();
	}

	public function m_history_transaksi_by_id($id_paket,$id_jamaah)
	{
		$q = $this->db->query("SELECT a.*,b.nama AS nama_jamaah,b.no_identitas,
									c.nama_paket,c.tgl_umroh,
									d.nama AS nama_leader 
								FROM `tbl_leader_transaksi` a 
								LEFT JOIN tbl_jamaah b 
								ON a.id_jamaah=b.id_jamaah
								LEFT JOIN tbl_paket c 
								ON a.id_paket=c.id
								LEFT JOIN tbl_leader d 
								ON a.id_leader=d.id_leader
								WHERE a.id_paket='$id_paket' AND a.id_jamaah='$id_jamaah'
								ORDER BY a.tgl_update DESC
								");
		return $q->result();
	}

	public function m_leader_transaksi()
	{
		$q=$this->db->query("
						
						SELECT 
								a.*,
								CASE WHEN a.status='1' THEN 'aktif' ELSE 'tidak_aktif' END AS status_leader,				
								b.jumlah_jamaah_aktif,
								c.nama_bank
						 FROM `tbl_leader` a
						 LEFT JOIN 
						 (
						 	SELECT id_leader,nama,count(*) AS jumlah_jamaah_aktif FROM `tbl_jamaah` WHERE status='1' AND id_leader<>'0' GROUP BY id_leader
						 )b 
						 ON a.id_leader=b.id_leader
						 LEFT JOIN tbl_bank c 
						 ON a.id_bank=c.id_bank
						 ORDER BY 
						 b.jumlah_jamaah_aktif DESC

			");
		return $q->result();
	}

	public function m_data()
	{
		$q = $this->db->query("SELECT a.*,b.nama_bank  FROM tbl_leader a							
									LEFT JOIN tbl_bank b
									ON a.id_bank=b.id_bank
								ORDER BY a.id_leader DESC
					");
		return $q->result();
	}



	public function m_history($id_paket,$id_jamaah)
	{
		$q = $this->db->query("SELECT 
									a.id_transaksi,a.id_leader,a.tgl_transaksi,a.id_paket,a.id_jamaah, SUM(jumlah) AS jumlah,
									b.nama_leader,
									(SUM(a.jumlah)*b.harga) AS harga

								FROM `tbl_leader_transaksi` a 
								LEFT JOIN 
								tbl_leader b 
								ON a.id_leader=b.id 
							  WHERE id_paket='$id_paket' AND id_jamaah='$id_jamaah' AND jenis='keluar'
							  GROUP BY a.id_leader
								");

		return $q->result();
	}


	public function simpan_pembayaran($serialize)
	{
		$this->db->set($serialize);
		$this->db->insert('tbl_leader_transaksi');
		return $this->db->insert_id();
	}

	public function m_by_id($id)
	{
		$q = $this->db->query("SELECT * FROM tbl_leader WHERE id_leader='$id'");
		return $q->result();
	}


	public function tambah_data($serialize)
	{
		$this->db->set($serialize);
		$this->db->insert('tbl_leader');
	}


	public function update_data($serialize,$id)
	{
		$this->db->set($serialize);
		$this->db->where('id_leader',$id);
		$this->db->update('tbl_leader');
	}

	public function m_hapus_data($id)
	{		
		$this->db->where('id_leader',$id);
		$this->db->delete('tbl_leader');
	}


}