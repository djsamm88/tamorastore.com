<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

	class M_barang extends CI_Model {
		
		function __construct() {
			parent::__construct();
		
			$this->load->helper('custom_func');
		}



	public function m_barang_transaksi()
	{
		$q=$this->db->query("SELECT 
				a.tanggal,
				a.id_barang,
				a.nama_barang,
				IFNULL(SUM(a.masuk),0) AS masuk,
				IFNULL(SUM(a.keluar),0) AS keluar
				FROM
				(						
					SELECT 
					a.tanggal,
					a.id_barang,
					a.nama_barang,
					CASE WHEN a.jenis='masuk' THEN a.jumlah END AS masuk,
					CASE WHEN a.jenis='keluar' THEN a.jumlah  END AS keluar
					FROM 
					(							
						SELECT 
						a.tanggal,
						a.id_barang,
						a.nama_barang,
						a.jenis,
						SUM(a.jumlah) AS jumlah
						FROM 
						(
							SELECT 
						    a.id_barang,
						    a.jumlah,
						    a.jenis,
						    DATE(a.tgl_transaksi) AS tanggal,
						    b.nama_barang
						    FROM `tbl_barang_transaksi` a 
						    LEFT JOIN 
						    tbl_barang b 
						    ON a.id_barang=b.id    
						)a
						GROUP BY a.id_barang,a.jenis,a.tanggal
					)a
				)a
				GROUP BY a.tanggal,a.id_barang
				ORDER BY a.tanggal DESC
			");
		return $q->result();
	}

	public function m_data()
	{
		$q = $this->db->query("SELECT a.*,IFNULL(b.qty,0) AS qty FROM tbl_barang a
								LEFT JOIN(
										SELECT 
											a.id_barang, 
											IFNULL(a.qty,0)-IFNULL(b.qty,0) AS qty
											 FROM 
											(SELECT id_barang,SUM(jumlah) AS qty FROM `tbl_barang_transaksi` WHERE jenis='masuk' GROUP BY id_barang
											)a 
											LEFT JOIN 
											(SELECT id_barang,SUM(jumlah) AS qty FROM `tbl_barang_transaksi` WHERE jenis='keluar' GROUP BY id_barang
											)b 
											ON a.id_barang=b.id_barang 
								)b
								ON a.id =b.id_barang								
								ORDER BY b.qty DESC
					");
		return $q->result();
	}


	public function m_return_barang()
	{
		$q = $this->db->query("SELECT a.*,b.* FROM tbl_barang_return a
								LEFT JOIN tbl_barang b 
								ON a.id_barang=b.id
								ORDER BY a.id DESC
					");
		return $q->result();
	}



	public function m_history($id_paket,$id_jamaah)
	{
		$q = $this->db->query("SELECT 
									a.id_transaksi,a.id_barang,a.tgl_transaksi,a.id_paket,a.id_jamaah, SUM(jumlah) AS jumlah,
									b.nama_barang,
									(SUM(a.jumlah)*b.harga) AS harga

								FROM `tbl_barang_transaksi` a 
								LEFT JOIN 
								tbl_barang b 
								ON a.id_barang=b.id 
							  WHERE id_paket='$id_paket' AND id_jamaah='$id_jamaah' AND jenis='keluar'
							  GROUP BY a.id_barang
								");

		return $q->result();
	}



	public function m_by_id($id)
	{
		$q = $this->db->query("SELECT a.*,IFNULL(b.qty,0) AS qty FROM tbl_barang a
								LEFT JOIN(
										SELECT 
											a.id_barang, 
											IFNULL(a.qty,0)-IFNULL(b.qty,0) AS qty
											 FROM 
											(SELECT id_barang,SUM(jumlah) AS qty FROM `tbl_barang_transaksi` WHERE jenis='masuk' GROUP BY id_barang
											)a 
											LEFT JOIN 
											(SELECT id_barang,SUM(jumlah) AS qty FROM `tbl_barang_transaksi` WHERE jenis='keluar' GROUP BY id_barang
											)b 
											ON a.id_barang=b.id_barang 
								)b
								ON a.id =b.id_barang								
								 WHERE a.id='$id'
								ORDER BY b.qty DESC");
		return $q->result();
	}

	public function m_detail_penjualan($grup_penjualan)
	{
		$q = "
				SELECT 
					a.*,
					b.nama_barang,
					c.nama_admin
				FROM tbl_barang_transaksi a 
				LEFT JOIN tbl_barang b 
				ON a.id_barang=b.id 
				LEFT JOIN tbl_admin c 
				ON a.id_admin=c.id_admin
				WHERE a.grup_penjualan='$grup_penjualan'
			";

		$get = $this->db->query($q);
		return $get->result();
	}

	public function m_lap_penjualan()
	{
		$q = $this->db->query("SELECT grup_penjualan,SUM(sub_total_jual) AS total, diskon,tgl_transaksi,nama_pembeli,hp_pembeli,nama_packing,tgl_transaksi,tgl_trx_manual,
			harga_ekspedisi,transport_ke_ekspedisi 
			FROM `tbl_barang_transaksi` 
			WHERE jenis='keluar'
			GROUP BY grup_penjualan
			ORDER BY tgl_transaksi DESC
			");
		return $q->result();
	}

	public function tambah_data($serialize)
	{
		$this->db->set($serialize);
		$this->db->insert('tbl_barang');
	}


	public function update_data($serialize,$id)
	{
		$this->db->set($serialize);
		$this->db->where('id',$id);
		$this->db->update('tbl_barang');
	}

	public function m_hapus_data($id)
	{		
		$this->db->where('id',$id);
		$this->db->delete('tbl_barang');
	}


	public function insert_trx_barang($serialize)
	{
		$this->db->set($serialize);
		$this->db->insert('tbl_barang_transaksi');

	}

}