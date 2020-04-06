<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

	class M_laporan_keuangan extends CI_Model {
		
		function __construct() {
			parent::__construct();
		
			$this->load->helper('custom_func');
		}


	public function m_chart()
	{
		$q = $this->db->query("
				SELECT 
						DATE(a.tanggal) AS tanggal,
						IFNULL(SUM(a.debet),0) AS debet,
						IFNULL(SUM(a.kredit),0) AS kredit
						FROM
						(

							SELECT a.*,
								IFNULL(a.debet,0)-IFNULL(a.kredit,0) AS saldo
								FROM
								(
									SELECT
									a.id,
									a.tanggal,
								    a.nama AS group_trx,
								    a.keterangan,
									a.debet,
									a.kredit
									FROM
									(
										SELECT a.*,
										CASE WHEN a.jenis='masuk' THEN a.jumlah  END AS debet,
										CASE WHEN a.jenis='keluar' THEN a.jumlah  END AS kredit
										FROM 
										(
										SELECT a.*,(a.tgl_update) AS tanggal,b.nama,b.jenis FROM `tbl_transaksi` a 
										INNER JOIN tbl_group_transaksi b 
										ON a.id_group=b.id
										)a
									)a 
								)a
						)a

					GROUP BY DATE(a.tanggal)
			");
		return $q->result();
	}


	public function m_sisa_kas()
	{
		$q = $this->db->query("
								SELECT SUM(a.jumlah) AS jumlah,a.jenis 
								FROM ( 
									SELECT a.*,b.nama AS nama_trx,b.jenis 
									FROM `tbl_transaksi` a 
									LEFT JOIN tbl_group_transaksi b 
									ON a.id_group=b.id 
									)a 

								GROUP BY a.jenis

							");
		return $q->result();
	}


	public function m_by_tgl($tgl)
	{
		$q = $this->db->query("
							SELECT a.*,
								IFNULL(a.debet,0)-IFNULL(a.kredit,0) AS saldo
								FROM
								(
									SELECT
									a.id,
									a.tanggal,
								    a.nama AS group_trx,
								    a.keterangan,
									a.debet,
									a.kredit,
									a.id_barang
									FROM
									(
										SELECT a.*,
										CASE WHEN a.jenis='masuk' THEN a.jumlah  END AS debet,
										CASE WHEN a.jenis='keluar' THEN a.jumlah  END AS kredit
										FROM 
										(
										SELECT a.*,(a.tgl_update) AS tanggal,b.nama,b.jenis 
										FROM `tbl_transaksi` a 
										INNER JOIN tbl_group_transaksi b 
										ON a.id_group=b.id
										)a
									)a 
								)a
							WHERE 
							DATE(a.tanggal)='$tgl'
							
						");

	
		return $q->result();
	}

	public function m_by_id($id)
	{
		$q = $this->db->query("
							SELECT a.*,
								IFNULL(a.debet,0)-IFNULL(a.kredit,0) AS saldo
								FROM
								(
									SELECT
									a.id,
									a.tanggal,
								    a.nama AS group_trx,
								    a.keterangan,
									a.debet,
									a.kredit,
									a.id_barang
									FROM
									(
										SELECT a.*,
										CASE WHEN a.jenis='masuk' THEN a.jumlah  END AS debet,
										CASE WHEN a.jenis='keluar' THEN a.jumlah  END AS kredit
										FROM 
										(
										SELECT a.*,(a.tgl_update) AS tanggal,b.nama,b.jenis 
										FROM `tbl_transaksi` a 
										INNER JOIN tbl_group_transaksi b 
										ON a.id_group=b.id
										)a
									)a 
								)a
							WHERE 
							(a.id)='$id'
							
						");

	
		return $q->result();
	}

	


	public function m_laporan_group()
	{
		$q = $this->db->query("
							SELECT a.nama,a.id_group,a.urutan,
								IFNULL(a.debet,0) AS debet,
								IFNULL(a.kredit,0) AS kredit,
								IFNULL(a.debet,0)-IFNULL(a.kredit,0) AS saldo
								FROM
								(								    
									SELECT a.nama,a.id AS id_group,a.urutan,
										CASE WHEN a.jenis='masuk' THEN a.jumlah  END AS debet,
										CASE WHEN a.jenis='keluar' THEN a.jumlah  END AS kredit
										FROM 
										(
										    
										SELECT a.*,IFNULL(b.jumlah,0) AS jumlah 
										FROM tbl_group_transaksi a 
										LEFT JOIN 
										(
											SELECT id_group,SUM(jumlah) AS jumlah FROM `tbl_transaksi`
												
												GROUP BY id_group
										)b 
										ON a.id=b.id_group
										
										    
									)a
								)a
								ORDER BY a.urutan ASC
							");
		return $q->result();
	}

	public function m_jurnal($tgl_awal,$tgl_akhir)
	{
		$q = $this->db->query("
							SELECT a.*,
								IFNULL(a.debet,0)-IFNULL(a.kredit,0) AS saldo
								FROM
								(
									SELECT
									a.id,
									a.tanggal,
								    a.nama AS group_trx,
								    a.keterangan,
									a.debet,
									a.kredit
									FROM
									(
										SELECT a.*,
										CASE WHEN a.jenis='masuk' THEN a.jumlah  END AS debet,
										CASE WHEN a.jenis='keluar' THEN a.jumlah  END AS kredit
										FROM 
										(
										SELECT a.*,(a.tgl_update) AS tanggal,b.nama,b.jenis FROM `tbl_transaksi` a 
										INNER JOIN tbl_group_transaksi b 
										ON a.id_group=b.id
										)a
										WHERE (a.jumlah*1)<>0
									)a 
								)a
							WHERE 
							a.tanggal BETWEEN '$tgl_awal' AND '$tgl_akhir'
							
							
						");
		return $q->result();
	}

	public function m_jurnal_pelanggan($id_pelanggan)
	{
		$q = $this->db->query("
							SELECT a.*,
								IFNULL(a.debet,0)-IFNULL(a.kredit,0) AS saldo
								FROM
								(
									SELECT
									a.id,
									a.tanggal,
								    a.nama AS group_trx,
								    a.keterangan,
									a.debet,
									a.kredit,
									a.id_pelanggan,
									a.id_group,
									a.url_bukti

									FROM
									(
										SELECT a.*,
										CASE WHEN a.jenis='masuk' THEN a.jumlah  END AS debet,
										CASE WHEN a.jenis='keluar' THEN a.jumlah  END AS kredit
										FROM 
										(
										SELECT a.*,(a.tgl_update) AS tanggal,b.nama,b.jenis FROM `tbl_transaksi` a 
										INNER JOIN tbl_group_transaksi b 
										ON a.id_group=b.id
										)a
										WHERE (a.jumlah*1)<>0
									)a 
								)a
							WHERE 
							a.id_pelanggan='$id_pelanggan'
							AND (a.id_group='17' OR a.id_group='18')
							
							
						");
		return $q->result();
	}


	public function m_laba($tgl_awal,$tgl_akhir)
	{
		$q = $this->db->query("
							SELECT a.*,
								IFNULL(a.debet,0)-IFNULL(a.kredit,0) AS saldo
								FROM
								(
									SELECT
									a.id,
									a.id_group,
									a.jumlah AS harga_jual,
									a.harga_beli,
									a.diskon,
									a.tanggal,
								    a.nama AS group_trx,
								    a.keterangan,
									a.debet,
									a.kredit
									FROM
									(
										SELECT a.*,
										CASE WHEN a.jenis='masuk' THEN a.jumlah  END AS debet,
										CASE WHEN a.jenis='keluar' THEN a.jumlah  END AS kredit
										FROM 
										(
										SELECT a.*,(a.tgl_update) AS tanggal,b.nama,b.jenis FROM `tbl_transaksi` a 
										INNER JOIN tbl_group_transaksi b 
										ON a.id_group=b.id
                                        WHERE b.id NOT IN(1,5,11,9)
										)a
										WHERE (a.jumlah*1)<>0
									)a 
								)a
							WHERE 
							a.tanggal BETWEEN '$tgl_awal' AND '$tgl_akhir'
							
							
						");
		return $q->result();
	}


	public function m_detail_arus_kas($id_group,$tgl_awal,$tgl_akhir)
	{
		$q = $this->db->query("
							SELECT a.*,
								IFNULL(a.debet,0)-IFNULL(a.kredit,0) AS saldo
								FROM
								(
									SELECT
									a.id,
									a.tanggal,
								    a.nama AS group_trx,
								    a.keterangan,
									a.debet,
									a.kredit,
									a.id_group
									FROM
									(
										SELECT a.*,
										CASE WHEN a.jenis='masuk' THEN a.jumlah  END AS debet,
										CASE WHEN a.jenis='keluar' THEN a.jumlah  END AS kredit
										FROM 
										(
										SELECT a.*,DATE(a.tgl_update) AS tanggal,b.nama,b.jenis FROM `tbl_transaksi` a 
										INNER JOIN tbl_group_transaksi b 
										ON a.id_group=b.id
										)a
										WHERE (a.jumlah*1)<>0
									)a 
								)a
							WHERE (a.tanggal BETWEEN '$tgl_awal' AND '$tgl_akhir') AND a.id_group='$id_group'
						");
		return $q->result();
	}





	public function m_saldo_per_paket()
	{
		$q = $this->db->query("

							SELECT
							    a.id,
							    a.nama_paket,
							    a.tgl_umroh,
							    a.kuota,
							    a.harga_paket,
							    (a.harga_paket * a.kuota) AS total_harga_paket,
							    c.jumlah_jamaah,
							    b.*,
							    (a.harga_paket * a.kuota)-b.saldo AS selisih
							    
							FROM
							    tbl_paket a
							INNER JOIN(
							    SELECT a.id_paket,
							        SUM(a.debet) AS debet,
							        SUM(a.kredit) AS kredit,
							        SUM(a.saldo) AS saldo
							    FROM
							        (
							        SELECT
							            a.*,
							            IFNULL(a.debet, 0) - IFNULL(a.kredit, 0) AS saldo
							        FROM
							            (
							            SELECT
							                a.id,
							                a.tanggal,
							                a.nama AS group_trx,
							                a.keterangan,
							                a.debet,
							                a.kredit,
							                a.id_group,
							                a.id_paket
							            FROM
							                (
							                SELECT
							                    a.*,
							                    CASE WHEN a.jenis = 'masuk' THEN a.jumlah
							            			END AS debet,
							            		CASE WHEN a.jenis = 'keluar' THEN a.jumlah
							        				END AS kredit
							    FROM
							        (
							        SELECT
							            a.*,
							            DATE(a.tgl_update) AS tanggal,
							            b.nama,
							            b.jenis
							        FROM
							            `tbl_transaksi` a
							        INNER JOIN tbl_group_transaksi b ON
							            a.id_group = b.id
							        WHERE
							            (
							                b.id = '1' OR b.id = '2' OR b.id = '5' OR b.id = '7' OR b.id = '8' OR b.id = '9' OR b.id = '10' OR b.id = '12'
							            )
							    ) a
							WHERE
							    (a.jumlah * 1) <> 0
							    ) a
							) a
							) a
							GROUP BY
							    a.id_paket
							) b
							ON
							    a.id = b.id_paket
							LEFT JOIN(
							    SELECT id_paket,
							        COUNT(*) AS jumlah_jamaah
							    FROM
							        `tbl_jamaah`
							    WHERE
							STATUS
							    = '1'
							GROUP BY
							    id_paket
							) c
							ON
							    a.id = c.id_paket
    					");

		return $q->result();

	}

	public function m_detail_arus_kas_paket($id_paket,$tgl_awal,$tgl_akhir)
	{
		$q = $this->db->query("
							SELECT a.*,
								IFNULL(a.debet,0)-IFNULL(a.kredit,0) AS saldo
								FROM
								(
									SELECT
									a.id,
									a.tanggal,
								    a.nama AS group_trx,
								    a.keterangan,
									a.debet,
									a.kredit,
									a.id_group,
									a.id_paket
									FROM
									(
										SELECT a.*,
										CASE WHEN a.jenis='masuk' THEN a.jumlah  END AS debet,
										CASE WHEN a.jenis='keluar' THEN a.jumlah  END AS kredit
										FROM 
										(
											SELECT a.*,DATE(a.tgl_update) AS tanggal,b.nama,b.jenis 
											FROM `tbl_transaksi` a 
											INNER JOIN tbl_group_transaksi b 
											ON a.id_group=b.id
											WHERE 
											(b.id='1' OR b.id='2' OR b.id='5' OR b.id='7' OR b.id = '8' OR b.id='9' OR b.id='10' OR b.id='12')
										)a
										WHERE (a.jumlah*1)<>0

									)a 
								)a
							WHERE (a.tanggal BETWEEN '$tgl_awal' AND '$tgl_akhir') AND a.id_paket='$id_paket'
						");
		return $q->result();
	}

	


}