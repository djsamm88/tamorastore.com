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
		$q = $this->db->query("SELECT a.*,IFNULL(b.qty,0) AS qty,IFNULL(c.qty,0) AS masuk  
								FROM tbl_barang a
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
								LEFT JOIN (
									SELECT id_barang,SUM(qty) AS qty FROM `tbl_barang_masuk_tanpa_harga` WHERE status='belum' GROUP BY id_barang
								)c
								ON a.id=c.id_barang
								ORDER BY b.qty DESC
					");
		return $q->result();
	}


	public function m_data_barang_member()
	{
		$q = $this->db->query("SELECT a.*,IFNULL(b.qty,0) AS qty,IFNULL(c.qty,0) AS masuk  
								FROM tbl_barang a
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
								LEFT JOIN (
									SELECT id_barang,SUM(qty) AS qty FROM `tbl_barang_masuk_tanpa_harga` WHERE status='belum' GROUP BY id_barang
								)c
								ON a.id=c.id_barang
								WHERE IFNULL(b.qty,0)>0
								ORDER BY b.qty DESC
					");
		return $q->result();
	}

	
	public function m_data_barang_member_autocomplete($cari)
	{
		$q = $this->db->query("SELECT a.*,IFNULL(b.qty,0) AS qty,IFNULL(c.qty,0) AS masuk  
								FROM tbl_barang a
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
								LEFT JOIN (
									SELECT id_barang,SUM(qty) AS qty FROM `tbl_barang_masuk_tanpa_harga` WHERE status='belum' GROUP BY id_barang
								)c
								ON a.id=c.id_barang
								WHERE IFNULL(b.qty,0)>0 AND a.nama_barang LIKE '%$cari%'
								ORDER BY b.qty DESC
					");
		return $q;
	}

	


	public function m_data_gudang($id_gudang)
	{
		$q = $this->db->query("SELECT a.*,IFNULL(b.qty,0) AS qty,b.id_gudang,c.nama_gudang,a.reminder
								FROM tbl_barang a
								INNER JOIN(
										SELECT 
											a.id_barang,a.id_gudang, 
											IFNULL(a.qty,0)-IFNULL(b.qty,0) AS qty
											 FROM 
											(SELECT id_barang,SUM(jumlah) AS qty,id_gudang FROM `tbl_barang_transaksi` WHERE jenis='masuk' GROUP BY id_barang,id_gudang
											)a 
											LEFT JOIN 
											(SELECT id_barang,SUM(jumlah) AS qty,id_gudang FROM `tbl_barang_transaksi` WHERE jenis='keluar' GROUP BY id_barang,id_gudang
											)b 
											ON a.id_barang=b.id_barang AND a.id_gudang=b.id_gudang
								)b
								ON a.id =b.id_barang	
								LEFT JOIN tbl_gudang c ON b.id_gudang=c.id_gudang
								WHERE b.id_gudang='$id_gudang'
								ORDER BY b.qty ASC
					");
		return $q;
	}



	public function m_data_gudang_pelanggan()
	{
		$q = $this->db->query("SELECT a.*,IFNULL(b.qty,0) AS qty,b.id_gudang,c.nama_gudang,a.reminder
								FROM tbl_barang a
								INNER JOIN(
										SELECT 
											a.id_barang,a.id_gudang, 
											IFNULL(a.qty,0)-IFNULL(b.qty,0) AS qty
											 FROM 
											(SELECT id_barang,SUM(jumlah) AS qty,id_gudang FROM `tbl_barang_transaksi` WHERE jenis='masuk' GROUP BY id_barang,id_gudang
											)a 
											LEFT JOIN 
											(SELECT id_barang,SUM(jumlah) AS qty,id_gudang FROM `tbl_barang_transaksi` WHERE jenis='keluar' GROUP BY id_barang,id_gudang
											)b 
											ON a.id_barang=b.id_barang AND a.id_gudang=b.id_gudang
								)b
								ON a.id =b.id_barang	
								LEFT JOIN tbl_gudang c ON b.id_gudang=c.id_gudang
								WHERE IFNULL(b.qty,0) > 0
								ORDER BY b.qty ASC
					");
		return $q;
	}




	public function m_data_gudang_autocomplete($id_gudang,$cari)
	{
		$q = $this->db->query("SELECT a.*,IFNULL(b.qty,0) AS qty,b.id_gudang,c.nama_gudang,a.reminder
								FROM tbl_barang a
								INNER JOIN(
										SELECT 
											a.id_barang,a.id_gudang, 
											IFNULL(a.qty,0)-IFNULL(b.qty,0) AS qty
											 FROM 
											(SELECT id_barang,SUM(jumlah) AS qty,id_gudang FROM `tbl_barang_transaksi` WHERE jenis='masuk' GROUP BY id_barang,id_gudang
											)a 
											LEFT JOIN 
											(SELECT id_barang,SUM(jumlah) AS qty,id_gudang FROM `tbl_barang_transaksi` WHERE jenis='keluar' GROUP BY id_barang,id_gudang
											)b 
											ON a.id_barang=b.id_barang AND a.id_gudang=b.id_gudang
								)b
								ON a.id =b.id_barang	
								LEFT JOIN tbl_gudang c ON b.id_gudang=c.id_gudang
								WHERE b.id_gudang='$id_gudang' AND a.nama_barang LIKE '%$cari%' AND qty>0
								ORDER BY b.qty ASC
					");
		return $q;
	}


	public function m_stok_by_id_barang($id_gudang,$id_barang)
	{
		$q = $this->db->query("SELECT a.*,IFNULL(b.qty,0) AS qty,b.id_gudang,c.nama_gudang,a.reminder
								FROM tbl_barang a
								INNER JOIN(
										SELECT 
											a.id_barang,a.id_gudang, 
											IFNULL(a.qty,0)-IFNULL(b.qty,0) AS qty
											 FROM 
											(SELECT id_barang,SUM(jumlah) AS qty,id_gudang FROM `tbl_barang_transaksi` WHERE jenis='masuk' GROUP BY id_barang,id_gudang
											)a 
											LEFT JOIN 
											(SELECT id_barang,SUM(jumlah) AS qty,id_gudang FROM `tbl_barang_transaksi` WHERE jenis='keluar' GROUP BY id_barang,id_gudang
											)b 
											ON a.id_barang=b.id_barang AND a.id_gudang=b.id_gudang
								)b
								ON a.id =b.id_barang	
								LEFT JOIN tbl_gudang c ON b.id_gudang=c.id_gudang
								WHERE b.id_gudang='$id_gudang' AND a.id='$id_barang'
								ORDER BY b.qty ASC
					");
		return $q;
	}

	


	public function m_stok_gudang_by_id($id_barang,$id_gudang)
	{
		$q = $this->db->query("SELECT a.*,IFNULL(b.qty,0) AS qty,b.id_gudang,c.nama_gudang,a.reminder
								FROM tbl_barang a
								INNER JOIN(
										SELECT 
											a.id_barang,a.id_gudang, 
											IFNULL(a.qty,0)-IFNULL(b.qty,0) AS qty
											 FROM 
											(SELECT id_barang,SUM(jumlah) AS qty,id_gudang FROM `tbl_barang_transaksi` WHERE jenis='masuk' GROUP BY id_barang,id_gudang
											)a 
											LEFT JOIN 
											(SELECT id_barang,SUM(jumlah) AS qty,id_gudang FROM `tbl_barang_transaksi` WHERE jenis='keluar' GROUP BY id_barang,id_gudang
											)b 
											ON a.id_barang=b.id_barang AND a.id_gudang=b.id_gudang
								)b
								ON a.id =b.id_barang	
								LEFT JOIN tbl_gudang c ON b.id_gudang=c.id_gudang
								WHERE b.id_gudang='$id_gudang' AND a.id='$id_barang'
								ORDER BY b.qty ASC
					");
		return $q;
	}

	public function m_notif_stok($id_gudang=null)
	{
		if($id_gudang!=null)
		{
			$if = " AND b.id_gudang='$id_gudang'";
		}else{
			$if ="";
		}

		$q = $this->db->query("
							
								SELECT a.*,IFNULL(b.qty,0) AS qty,b.id_gudang,c.nama_gudang,a.reminder
								FROM tbl_barang a
								INNER JOIN(
										SELECT 
											a.id_barang,a.id_gudang, 
											IFNULL(a.qty,0)-IFNULL(b.qty,0) AS qty
											 FROM 
											(SELECT id_barang,SUM(jumlah) AS qty,id_gudang FROM `tbl_barang_transaksi` WHERE jenis='masuk' GROUP BY id_barang,id_gudang
											)a 
											LEFT JOIN 
											(SELECT id_barang,SUM(jumlah) AS qty,id_gudang FROM `tbl_barang_transaksi` WHERE jenis='keluar' GROUP BY id_barang,id_gudang
											)b 
											ON a.id_barang=b.id_barang AND a.id_gudang=b.id_gudang
								)b
								ON a.id =b.id_barang	
								LEFT JOIN tbl_gudang c ON b.id_gudang=c.id_gudang								
								
								WHERE a.reminder > b.qty $if

							
					");
		return $q;
	}


	public function m_data_beli()
	{
		$q = $this->db->query("

								SELECT a.*,b.*,c.nama_gudang,a.qty AS masuk,a.tgl AS tgl_masuk
								FROM tbl_barang_masuk_tanpa_harga a 
								LEFT JOIN 
								(
									SELECT 
									a.*,IFNULL(b.qty,0) AS qty								
									FROM tbl_barang a
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
									)b ON a.id =b.id_barang								
									ORDER BY b.qty DESC
								)b ON a.id_barang=b.id 
								LEFT JOIN tbl_gudang c ON a.id_gudang=c.id_gudang
								WHERE a.status='belum'							
					");
		return $q->result();
	}

	public function m_hitung_notif_barang_baru()
	{
		$q = $this->db->query("SELECT id_barang_masuk FROM tbl_barang_masuk_tanpa_harga WHERE status='belum'");
		return $q->num_rows();
	}

	public function m_return_barang($kondisi=null)
	{
		if($kondisi==null)
		{
			$where = "";
		}else{
			$where = " AND a.kondisi='$kondisi'";
		}

		$q = $this->db->query("SELECT a.*,a.id AS id_ret ,b.*,c.*,d.nama_gudang
								FROM tbl_barang_return a
								LEFT JOIN tbl_barang b ON a.id_barang=b.id
								LEFT JOIN tbl_pelanggan c ON a.id_pelanggan=c.id_pelanggan
								LEFT JOIN tbl_gudang d ON a.id_gudang=d.id_gudang
								WHERE a.status='toko' $where
								ORDER BY a.id DESC
					");
		return $q->result();
	}


	public function m_return_ke_suplier()
	{

		$q = $this->db->query("SELECT a.*,b.*,c.*,d.nama_gudang
								FROM tbl_barang_return a
								LEFT JOIN tbl_barang b ON a.id_barang=b.id
								LEFT JOIN tbl_pelanggan c ON a.id_pelanggan=c.id_pelanggan
								LEFT JOIN tbl_gudang d ON a.id_gudang=d.id_gudang
								WHERE status='toko' 
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
											(SELECT id_barang,SUM(jumlah) AS qty FROM `tbl_barang_transaksi` WHERE jenis='masuk' GROUP BY id_barang,id_gudang
											)a 
											LEFT JOIN 
											(SELECT id_barang,SUM(jumlah) AS qty FROM `tbl_barang_transaksi` WHERE jenis='keluar' GROUP BY id_barang,id_gudang
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
					b.*,
					c.nama_admin,
					d.saldo
				FROM tbl_barang_transaksi a 
				LEFT JOIN tbl_barang b 
				ON a.id_barang=b.id 
				LEFT JOIN tbl_admin c 
				ON a.id_admin=c.id_admin
				LEFT JOIN tbl_pelanggan d 
				ON a.id_pelanggan=d.id_pelanggan
				WHERE a.grup_penjualan='$grup_penjualan'
			";

		$get = $this->db->query($q);
		return $get->result();
	}


	public function m_detail_penjualan_struk($grup_penjualan)
	{
		$q = "
				SELECT 
					a.*,
					b.*,
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

	public function m_lap_penjualan($mulai,$selesai,$id_admin='')
	{	
		$where="";
		if($id_admin!='')
		{
			$where=" AND a.id_admin='$id_admin'";
		}


		$q = $this->db->query("
				SELECT 
				a.grup_penjualan,
				SUM(a.sub_total_jual) AS total, 
				a.diskon,
				a.saldo,				
				a.nama_pembeli,
				a.hp_pembeli,
				a.nama_packing,
				a.tgl_transaksi,
				a.tgl_trx_manual,
				a.harga_ekspedisi,
				a.transport_ke_ekspedisi,
				a.id_pelanggan,
				b.nama_admin,
				b.email_admin 
			FROM tbl_barang_transaksi a
			LEFT JOIN tbl_admin b ON a.id_admin=b.id_admin
			WHERE a.jenis='keluar' AND (a.harga_beli <> 0 AND a.harga_jual <> 0) $where 
				AND a.tgl_transaksi BETWEEN '$mulai' AND '$selesai'
			GROUP BY grup_penjualan
			ORDER BY tgl_transaksi DESC
			");

		return $q->result();
	}


	public function m_lap_penjualan_member($mulai,$selesai,$id_pelanggan)
	{	
		
		$where=" AND a.id_pelanggan='$id_pelanggan'";
		
		$q = $this->db->query("
				SELECT 
				a.grup_penjualan,
				SUM(a.sub_total_jual) AS total, 
				a.diskon,
				a.saldo,				
				a.nama_pembeli,
				a.hp_pembeli,
				a.nama_packing,
				a.tgl_transaksi,
				a.tgl_trx_manual,
				a.harga_ekspedisi,
				a.transport_ke_ekspedisi,
				a.id_pelanggan,
				b.nama_admin,
				b.email_admin 
			FROM tbl_barang_transaksi a
			LEFT JOIN tbl_admin b ON a.id_admin=b.id_admin
			WHERE a.jenis='keluar' AND (a.harga_beli <> 0 AND a.harga_jual <> 0) $where
			 	 AND a.tgl_transaksi BETWEEN '$mulai' AND '$selesai'
			GROUP BY grup_penjualan
			ORDER BY tgl_transaksi DESC
			");
		return $q->result();
	}



public function m_pesanan_member($id_pelanggan='')
{	
	$where="";
	if($id_pelanggan!='')
	{
		$where=" AND a.id_pelanggan='$id_pelanggan'";
	}
	$q = $this->db->query("
			SELECT 
			a.grup_penjualan,
			SUM(a.sub_total_jual) AS total, 
			a.diskon,
			a.saldo,
			a.bukti_transfer,
			a.tgl_transaksi,
			a.nama_pembeli,
			a.hp_pembeli,
			a.nama_packing,
			a.tgl_transaksi,
			a.tgl_trx_manual,
			a.harga_ekspedisi,
			a.transport_ke_ekspedisi,
			a.id_pelanggan,
			b.nama_admin,
			b.email_admin 
		FROM tbl_barang_transaksi a
		LEFT JOIN tbl_admin b ON a.id_admin=b.id_admin
		WHERE a.jenis='pending_member' AND (a.harga_beli <> 0 AND a.harga_jual <> 0) $where
		GROUP BY grup_penjualan
		ORDER BY tgl_transaksi DESC
		");
	return $q->result();
}

	public function m_lap_pending($id_admin='')
	{	
		$where="";
		if($id_admin!='')
		{
			$where=" AND a.id_admin='$id_admin'";
		}


		$q = $this->db->query("
				SELECT 
				a.grup_penjualan,
				SUM(a.sub_total_jual) AS total, 
				a.diskon,
				a.tgl_transaksi,
				a.nama_pembeli,
				a.hp_pembeli,
				a.nama_packing,
				a.tgl_transaksi,
				a.tgl_trx_manual,
				a.harga_ekspedisi,
				a.transport_ke_ekspedisi,
				a.id_pelanggan,
				b.nama_admin,
				b.email_admin 
			FROM tbl_barang_transaksi a
			LEFT JOIN tbl_admin b ON a.id_admin=b.id_admin
			WHERE a.jenis='pending_keluar' AND (a.harga_beli <> 0 AND a.harga_jual <> 0) $where
			GROUP BY grup_penjualan
			ORDER BY tgl_transaksi DESC
			");
		return $q->result();
	}

	public function notif_pending($id_admin='')
	{	
		$where="";
		if($id_admin!='')
		{
			$where=" AND a.id_admin='$id_admin'";
		}


		$q = $this->db->query("
				SELECT 
				a.grup_penjualan,
				SUM(a.sub_total_jual) AS total, 
				a.diskon,
				a.tgl_transaksi,
				a.nama_pembeli,
				a.hp_pembeli,
				a.nama_packing,
				a.tgl_transaksi,
				a.tgl_trx_manual,
				a.harga_ekspedisi,
				a.transport_ke_ekspedisi,
				a.id_pelanggan,
				b.nama_admin,
				b.email_admin 
			FROM tbl_barang_transaksi a
			LEFT JOIN tbl_admin b ON a.id_admin=b.id_admin
			WHERE a.jenis='pending_keluar' AND (a.harga_beli <> 0 AND a.harga_jual <> 0) $where
			GROUP BY grup_penjualan
			ORDER BY tgl_transaksi DESC
			");
		return $q->num_rows();
	}


	public function m_log_pindah_gudang()
	{
		$q = $this->db->query("
							SELECT a.tgl,a.jumlah,a.catatan,
								   b.nama_gudang AS nama_gudang_lama,
								   c.nama_gudang AS nama_gudang_baru,
								   CONCAT(d.id,'#',d.nama_barang) AS nama_barang,
								   e.nama_admin
								FROM tbl_log_pemindahan_gudang a
								LEFT JOIN tbl_gudang b ON a.id_gudang_lama=b.id_gudang
								LEFT JOIN tbl_gudang c ON a.id_gudang_baru=c.id_gudang
								LEFT JOIN tbl_barang d ON a.id_barang=d.id 
								LEFT JOIN tbl_admin e ON a.id_admin=e.id_admin
							ORDER BY tgl DESC


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

	public function m_hapus_pending($grup_penjualan)
	{
		$this->db->where('grup_penjualan',$grup_penjualan);
		$this->db->delete('tbl_barang_transaksi');
	}


	public function insert_trx_barang($serialize)
	{
		$this->db->set($serialize);
		$this->db->insert('tbl_barang_transaksi');

	}

}