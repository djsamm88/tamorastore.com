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
		$this->load->model('m_pelanggan');

		
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
