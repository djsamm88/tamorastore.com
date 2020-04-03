<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ekspedisi extends CI_Controller {
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
		$this->load->model('m_ekspedisi');

		
	}


	public function data()
	{
		$data['all'] = $this->m_ekspedisi->m_data();	
		$this->load->view('data_ekspedisi',$data);
	}

	public function by_id($id_ekspedisi)
	{
		header('Content-Type: application/json');
		$data['all'] = $this->m_ekspedisi->m_by_id($id_ekspedisi);
		echo json_encode($data['all']);
	}

	public function by_nama($nama_ekspedisi)
	{
		header('Content-Type: application/json');
		$data['all'] = $this->m_ekspedisi->m_by_nama(urldecode($nama_ekspedisi));
		echo json_encode($data['all']);
	}

	public function simpan()
	{
		$id_ekspedisi = $this->input->post('id_ekspedisi');		
		$serialize = $this->input->post();
		$serialize['harga_ekspedisi'] = str_replace(".", "", $serialize['harga_ekspedisi']);

		if($id_ekspedisi=='')
		{
			$this->m_ekspedisi->insert($serialize);
			die('1');
		}else{

			$this->m_ekspedisi->update($serialize,$id_ekspedisi);
		}

	}

	public function hapus($id_ekspedisi)
	{
		$this->db->query("DELETE FROM tbl_ekspedisi WHERE id_ekspedisi='$id_ekspedisi'");
	}


}
