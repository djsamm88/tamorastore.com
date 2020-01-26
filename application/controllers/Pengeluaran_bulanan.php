<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengeluaran_bulanan extends CI_Controller {
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
		$this->load->model('m_pengeluaran_bulanan');
		$this->load->model('m_pembayaran');

	}


	public function data()
	{
		$data['all'] = $this->m_pengeluaran_bulanan->m_data();	
		$this->load->view('data_pengeluaran_bulanan',$data);
	}


	public function data_json()
	{
		header('Content-Type: application/json');
		$data['all'] = $this->m_pengeluaran_bulanan->m_data();	
		echo json_encode($data['all']);
	}


	public function by_id($id)
	{
		header('Content-Type: application/json');
		$data['all'] = $this->m_pengeluaran_bulanan->m_by_id($id);
		echo json_encode($data['all']);
	}



	public function trx_pengeluaran_bulanan()
	{
			
		$data['all'] = $this->m_pengeluaran_bulanan->m_trx_pengeluaran_bulanan();	
		$this->load->view('pengeluaran_bulanan_trx',$data);
	}

	public function form_pengeluaran_bulanan()
	{
		
		$data['all'] = $this->m_pengeluaran_bulanan->m_data();
		$this->load->view('form_pengeluaran_bulanan',$data);
	}

	public function simpan_pengeluaran_bulanan()
	{
		$data = $this->input->post();
		//var_dump($data);		
		$data['jumlah'] = hanya_nomor($data['jumlah']);

		$this->db->set($data);
		$this->db->insert('tbl_pengeluaran_bulanan_transaksi');
		$id_trx = $this->db->insert_id();

			$ket = $data['nama_pengeluaran']."- ".$data['keterangan']." : jumlah=".$data['jumlah'];

			/*********** insert ke transaksi **************/	
			$ser_trx = array(
							"id_group"=>"4",							
							"keterangan"=>$ket,
							"jumlah"=>($data['jumlah'])
						);				
			/* untuk id_referensi = id_group/id_table*/
			$ser_trx['id_referensi'] = $id_trx;	
			$this->db->set($ser_trx);
			$this->db->insert('tbl_transaksi');
			/*********** insert ke transaksi **************/
			

		die("1");

	}




	public function simpan_form()
	{
		$id = $this->input->post('id');
		
		$serialize = $this->input->post();

		if($id=='')
		{
			
			$this->m_pengeluaran_bulanan->tambah_data($serialize);
			die('1');
		}else{

			$this->m_pengeluaran_bulanan->update_data($serialize,$id);
			die('1');			

		}
		

	}

	public function hapus($id)
	{
		$this->m_pengeluaran_bulanan->m_hapus_data($id);
	}


}
