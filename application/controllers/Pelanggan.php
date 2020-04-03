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
