<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembatalan extends CI_Controller {
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
		$this->load->model('m_pembayaran');

		
	}

	
	public function data_paket()
	{
		$data['all'] = $this->m_pembayaran->m_data_paket_pembatalan();	
		$this->load->view('data_pembatalan',$data);
	}


	public function table_jamaah($id_paket)
	{
		$data['id_paket'] = $id_paket;
		$data['all'] = $this->m_pembayaran->m_data_by_id_paket($id_paket);	
		$this->load->view('table_jamaah_pembatalan',$data);
	}

	public function form_pembatalan()
	{
		$data['id_paket'] = $this->input->get('id_paket');
		$data['id_jamaah'] = $this->input->get('id_jamaah');
		
		$this->load->view('form_pembatalan',$data);
	}

	public function form_pemindahan()
	{
		$data['id_paket'] = $this->input->get('id_paket');
		$data['id_jamaah'] = $this->input->get('id_jamaah');
		$data['all'] = $this->m_pembayaran->m_data_paket();	
		$this->load->view('form_pemindahan',$data);
	}

	public function go_pemindahan()
	{
		$serialize = $this->input->post();

		
		$this->db->query("UPDATE tbl_jamaah SET id_paket='".$serialize['id_paket_baru']."' WHERE id_jamaah='".$serialize['id_jamaah']."'");

		$this->db->query("UPDATE tbl_barang_transaksi SET id_paket='".$serialize['id_paket_baru']."' WHERE id_jamaah='".$serialize['id_jamaah']."'");

		$this->db->query("UPDATE tbl_diskon SET id_paket='".$serialize['id_paket_baru']."' WHERE id_jamaah='".$serialize['id_jamaah']."'");

		$this->db->query("UPDATE tbl_pemasukan_lain_transaksi SET id_paket='".$serialize['id_paket_baru']."' WHERE id_jamaah='".$serialize['id_jamaah']."'");

		$this->db->query("UPDATE tbl_pembayaran SET id_paket='".$serialize['id_paket_baru']."' WHERE id_jamaah='".$serialize['id_jamaah']."'");

		

		
		$serialize['jenis']='pemindahan';
		$this->db->set($serialize);
		$this->db->insert('tbl_pembatalan');

		die("1");
	}

	

	public function go_pembatalan()
	{
		$serialize = $this->input->post();

		$serialize['pengembalian_uang'] = hanya_nomor($serialize['pengembalian_uang']);

		$this->db->query("UPDATE tbl_jamaah SET status='3' WHERE id_jamaah='".$serialize['id_jamaah']."'");


		$this->db->set($serialize);
		$this->db->insert('tbl_pembatalan');
		$id_trx = $this->db->insert_id();

			$this->load->model('m_ambil');
			$jamaah = $this->m_ambil->ambil_jamaah($serialize['id_jamaah']);

			$ket = "Pembatalan [$jamaah->nama $jamaah->nama_tengah $jamaah->nama_belakang] id_jamaah ".$serialize['id_jamaah']." : jumlah=".$serialize['pengembalian_uang'];

			/*********** insert ke transaksi **************/	
			$ser_trx = array(
							"id_group"=>"6",							
							"keterangan"=>$ket,
							"jumlah"=>($serialize['pengembalian_uang']),
							"id_paket"=>$jamaah->id_paket
						);				
			/* untuk id_referensi = id_group/id_table*/
			$ser_trx['id_referensi'] = $id_trx;	
			$this->db->set($ser_trx);
			$this->db->insert('tbl_transaksi');
			/*********** insert ke transaksi **************/
			

		die("1");
	}

	


}
