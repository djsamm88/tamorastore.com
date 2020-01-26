<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

	class M_pembayaran extends CI_Model {
		
		function __construct() {
			parent::__construct();
		
			$this->load->helper('custom_func');
		}


	public function m_data_by_id_paket($id_paket)
	{
		$q = $this->db->query("SELECT 
									a.*,
									b.nama AS nama_leader,
									c.total_modal,
									IFNULL(d.telah_dibayar, 0) AS telah_dibayar,
									((IFNULL(c.total_modal, 0)-IFNULL(e.diskon, 0))-IFNULL(d.telah_dibayar,0))*1 AS sisa,
									IFNULL(e.diskon, 0) AS diskon,
									IFNULL(f.jumlah_barang, 0) AS jumlah_barang,
									IFNULL(g.jumlah_pemasukan_lain, 0) AS jumlah_pemasukan_lain
									
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

										

								 WHERE a.status='1' AND a.id_paket='$id_paket'  ORDER BY (IFNULL(c.total_modal, 0)-IFNULL(d.telah_dibayar,0))*1  DESC
							");
		return $q->result();
	}

	public function m_manifest_by_id_paket($id_paket)
	{
		$q = $this->db->query("SELECT a.*,b.nama AS nama_leader,c.group_keluarga,c.keterangan FROM tbl_jamaah a
									LEFT JOIN tbl_leader b
									ON a.id_leader=b.id_leader
									LEFT JOIN 
									(
										SELECT a.id_jamaah,b.group_keluarga,CONCAT_WS(' : ',b.keterangan,b.semua) AS keterangan FROM `tbl_hubungan_jamaah` a 
											LEFT JOIN 
											(
											    SELECT a.keterangan,a.group_keluarga,GROUP_CONCAT(a.nama) AS semua
											    FROM (
											        SELECT a.*,b.nama FROM `tbl_hubungan_jamaah` a 
											        LEFT JOIN tbl_jamaah b 
											        ON a.id_jamaah=b.id_jamaah
											        WHERE b.status='1'
											      )a
											        GROUP BY group_keluarga    
											)b 
											ON a.group_keluarga=b.group_keluarga
									)c
									ON a.id_jamaah=c.id_jamaah
								 WHERE id_paket='$id_paket' ORDER BY c.group_keluarga DESC,id_jamaah DESC");
		return $q->result();
	}


	public function m_data_paket()
	{
		$q = $this->db->query("SELECT a.*,b.jumlah FROM tbl_paket a 
								LEFT JOIN 
								(
									SELECT id_paket,count(*) AS jumlah FROM `tbl_jamaah` WHERE status='1' GROUP BY id_paket
								)b
								ON a.id=b.id_paket								
								ORDER BY tgl_umroh DESC");
		return $q->result();
	}


	public function m_data_paket_pembatalan()
	{
		$x = date('Y-m-d', strtotime("+30 days"));

		$q = $this->db->query("SELECT a.*,b.jumlah FROM tbl_paket a 
								LEFT JOIN 
								(
									SELECT id_paket,count(*) AS jumlah FROM `tbl_jamaah` WHERE status='1' GROUP BY id_paket
								)b
								ON a.id=b.id_paket		
								WHERE a.tgl_umroh > '$x'
								ORDER BY tgl_umroh DESC");
		return $q->result();
	}


	public function m_pembayaran($id_jamaah,$id_paket)
	{
		$q = $this->db->query("SELECT * FROM tbl_pembayaran WHERE id_jamaah='$id_jamaah' AND id_paket='$id_paket' ORDER BY tgl_pembayaran ASC");
		return $q->result();
	}

	public function m_leader()
	{
		$q = $this->db->query("SELECT * FROM `tbl_leader` WHERE status='1'");
		return $q->result();
	}

	public function m_approve_diskon()
	{
		$q = $this->db->query("SELECT 
										a.*,
										b.total_modal,
										b.nama_paket,
										c.nama AS nama_jamaah,
										c.no_identitas
								FROM `tbl_diskon` a 
								LEFT JOIN 
									(
										SELECT 
											id,tgl_umroh,nama_paket,
										    (harga_paket) AS total_modal
										FROM `tbl_paket`
									)b
								ON a.id_paket=b.id 
								LEFT JOIN tbl_jamaah c 
								ON a.id_jamaah=c.id_jamaah
								WHERE c.status='1'

								ORDER BY (a.status*1) ASC,tgl_update DESC
		");
		return $q->result();	
	}

	public function m_by_id($id)
	{
		$q = $this->db->query("SELECT a.*,b.nama AS nama_leader FROM tbl_jamaah a
									LEFT JOIN tbl_leader b
									ON a.id_leader=b.id_leader
								 WHERE a.status='1' AND id_jamaah='$id' ORDER BY id_jamaah DESC");
		return $q->result();
	}


	public function tambah_data($serialize)
	{
		$this->db->set($serialize);
		$this->db->insert('tbl_pembayaran');

		return $this->db->insert_id();
	}


	public function update_data($serialize,$id)
	{
		$this->db->set($serialize);
		$this->db->where('id',$id);
		$this->db->update('tbl_pembayaran');
	}

	public function m_hapus_data($id)
	{		
		$this->db->where('id',$id);
		$this->db->delete('tbl_pembayaran');
	}


}