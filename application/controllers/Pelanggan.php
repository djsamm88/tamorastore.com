<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');				
		$this->load->helper('custom_func');
		if ($this->session->userdata('id_admin')=="") {
			redirect(base_url().'index.php/login');
		}
		$this->load->helper('text');
		date_default_timezone_set("Asia/jakarta");
		//$this->load->library('datatables');
		$this->load->model('m_laporan_keuangan');
		$this->load->model('m_pelanggan');
		$this->load->model('m_barang');
		$this->load->model('m_ambil');		
		$this->load->model('m_ekspedisi');
		$this->load->model('m_gudang');

		
	}


	public function pesanan_member()
	{
		
		$data['all'] = $this->m_barang->m_pesanan_member($this->session->userdata('id_admin'));	
		$this->load->view('data_pesanan',$data);

	}

	public function master_barang()
	{
		
		$data['all'] = $this->m_barang->m_data_barang_member();	
		$this->load->view('data_barang_member',$data);
	}

	public function go_upload_bukti()
	{
		$bukti_transfer = upload_file('gambar');
		$grup_penjualan = $this->input->post('grup_penjualan');
		$this->db->query("UPDATE tbl_barang_transaksi SET bukti_transfer='$bukti_transfer' WHERE grup_penjualan='$grup_penjualan'");
		echo "OK";
	}

	public function go_pesan()
	{
		$data = $this->input->post();

		/********* insert pelanggan ************/
		$arrPelanggan = array(				
				"tgl_daftar" 	=>date('Y-m-d H:i:s')
		);
		
		$id_pelanggan 	= $data['id_pelanggan'];
		$arrUpdate 		= array(
							"tgl_trx_terakhir"=>date('Y-m-d H:i:s')
						  );
		$this->m_pelanggan->update($arrUpdate,$id_pelanggan);
	
		/********* insert pelanggan ************/

		//var_dump($data);
		$total_tanpa_diskon =0; 
		$total_harga_beli 	=0; 
		$id_barang = $data['id_barang'];

		for($i=0;$i<count($id_barang);$i++) {
			//$data['harga_jual'] as $key => $harga_jual
			$key=$i;
			$id = $id_barang[$i];
			$harga_jual = $data['harga_jual'][$i];
			# code...
			//echo $key;
			/********** mengambil detail barang dari db***********/
			$q_detail_barang = $this->m_barang->m_by_id($id);
			$barang = $q_detail_barang[0];
			/********** mengambil detail barang dari db***********/


			
			$serialize['id_barang'] 	= $id;
			$serialize['harga_jual'] 	= hanya_nomor($harga_jual);
			$serialize['satuan_jual'] 	= $data['satuan_jual'][$key];
			$serialize['jenis'] 		= 'pending_member';
			$serialize['grup_penjualan'] = $data['grup_penjualan'];		

			$serialize['id_pelanggan'] 	= $id_pelanggan;
			$serialize['nama_pembeli'] 	= $data['nama_pembeli'];
			$serialize['hp_pembeli'] 	= $data['hp_pembeli'];
			
			
			$serialize['tgl_trx_manual']= $data['tgl_trx_manual'];
			$serialize['keterangan']	= $data['keterangan'];

			
			$serialize['saldo'] 		= hanya_nomor($data['saldo']);

			
			$serialize['sub_total_jual']= $serialize['harga_jual']*$data['jumlah'][$key];
			$serialize['sub_total_beli']= $barang->harga_pokok*$data['jumlah'][$key];
			$serialize['qty_jual']		= $data['jumlah'][$key];
			$serialize['jum_per_koli']	= $barang->jum_per_koli;
			$serialize['harga_beli']	= $barang->harga_pokok;
			$serialize['id_gudang']		= '1';
			


			$serialize['jumlah'] = $data['jumlah'][$key];

			/************ insert ke tbl_barang_transaksi *************/
			$this->m_barang->insert_trx_barang($serialize);
			/************ insert ke tbl_barang_transaksi *************/

			$total_tanpa_diskon	+=$serialize['sub_total_jual'];
			$total_harga_beli	+=$serialize['sub_total_beli'];
		}


		echo $data['grup_penjualan'];
	}

	public function kasir()
	{
		
		$data['pelanggan'] = $this->m_pelanggan->m_by_id($this->session->userdata('id_admin'))[0];
		$data['eksepedisi'] = $this->m_ekspedisi->m_data();	

		$this->load->view('form_penjualan_pelanggan',$data);
	}

	public function lap_penjualan_pelanggan()
	{
		$id_pelanggan = $this->session->userdata('id_admin');
		$mulai = $this->input->get('mulai');
		$selesai = $this->input->get('selesai');
		$data['mulai'] = $mulai;
		$data['selesai'] = $selesai;
		$data['all'] = $this->m_barang->m_lap_penjualan_member($mulai,$selesai,$id_pelanggan);	
		$this->load->view('lap_penjualan_member',$data);
	
	}


	public function lap_penjualan_pelanggan_excel()
	{
		$mulai = $this->input->get('mulai');
		$selesai = $this->input->get('selesai');

		$file = "laporan_penjualan-$mulai-$selesai.xls";
		header("Content-type: application/octet-stream");
		header("Content-Disposition: attachment; filename=$file");
		header("Pragma: no-cache");
		header("Expires: 0");	

		$id_pelanggan = $this->session->userdata('id_admin');

		$data['mulai'] = $mulai;
		$data['selesai'] = $selesai;

		$data['all'] = $this->m_barang->m_lap_penjualan_member($mulai,$selesai,$id_pelanggan);	
		$this->load->view('lap_penjualan_xl',$data);
	}


	public function data()
	{
		$data['all'] = $this->m_pelanggan->m_data();	
		$this->load->view('data_pelanggan',$data);
	}

	public function transaksi()
	{
		$data['all'] = $this->m_pelanggan->m_data();			
		$this->load->view('transaksi_pelanggan.php',$data);
	}

	public function jadikan_member($id_pelanggan)
	{
		$this->db->query("UPDATE tbl_pelanggan SET status='member' WHERE id_pelanggan='$id_pelanggan'");
	}
	public function trx_by_id($id_pelanggan)
	{		
		
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: *");
		header('Content-Type: application/json');	
		$data['all'] = $this->m_pelanggan->trx_by_pengguna($id_pelanggan);
		echo json_encode($data['all']);
	}

	public function simpan_trx()
	{
		$serialize = $this->input->post();
		$serialize['url_bukti'] = upload_file('url_bukti');

		//var_dump($serialize);
		$serialize['jumlah'] = hanya_nomor($serialize['jumlah']);
		$serialize['keterangan'] = $serialize['keterangan']." - A.n : ".$serialize['nama_pembeli']." - ID :".$serialize['id_pelanggan'];

		unset($serialize['nama_pembeli']);
		$this->m_pelanggan->insert_trx($serialize);

		$jumlah = $serialize['jumlah'];
		$id_pelanggan = $serialize['id_pelanggan'];
		if($serialize['id_group']=='17')
		{
			//tambah utang
			$this->db->query("UPDATE tbl_pelanggan SET saldo=saldo-$jumlah WHERE id_pelanggan='$id_pelanggan'");
		}

		if($serialize['id_group']=='18')
		{
			//bayar utang
			$this->db->query("UPDATE tbl_pelanggan SET saldo=saldo+$jumlah WHERE id_pelanggan='$id_pelanggan'");
		}

	}


	public function by_id($id_pelanggan)
	{
		header('Content-Type: application/json');
		$data['all'] = $this->m_pelanggan->m_by_id($id_pelanggan);
		echo json_encode($data['all']);
	}

	public function simpan()
	{
		$id_pelanggan = $this->input->post('id_pelanggan');		
		$serialize = $this->input->post();
		$serialize['tgl_daftar'] = date('Y-m-d H:i:s');
		if($id_pelanggan=='')
		{
			if($this->m_pelanggan->cek_email_user($serialize['email_pembeli'])>0)
			{
				echo "2";
				die();
			}

			$this->m_pelanggan->insert($serialize);
			die('1');
		}else{

			$this->m_pelanggan->update($serialize,$id_pelanggan);
		}

	}

	public function hapus($id_pelanggan)
	{
		$this->db->query("DELETE FROM tbl_pelanggan WHERE id_pelanggan='$id_pelanggan'");
	}


}
