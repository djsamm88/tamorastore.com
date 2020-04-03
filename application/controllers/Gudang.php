<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gudang extends CI_Controller {
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
		$this->load->model('m_gudang');

		
	}


	public function data()
	{
		$data['all'] = $this->m_gudang->m_data();	
		$this->load->view('data_gudang',$data);
	}

	public function by_id($id_gudang)
	{
		header('Content-Type: application/json');
		$data['all'] = $this->m_gudang->m_by_id($id_gudang);
		echo json_encode($data['all']);
	}

	public function simpan()
	{
		$id_gudang = $this->input->post('id_gudang');		
		$serialize = $this->input->post();
		

		if($id_gudang=='')
		{
			$this->m_gudang->insert($serialize);
			die('1');
		}else{

			$this->m_gudang->update($serialize,$id_gudang);
		}

	}

	public function hapus($id_gudang)
	{
		$this->db->query("DELETE FROM tbl_gudang WHERE id_gudang='$id_gudang'");
	}


}
