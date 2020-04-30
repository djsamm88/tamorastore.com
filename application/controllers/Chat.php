<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');				
		$this->load->helper('custom_func');		
		$this->load->helper('text');
		date_default_timezone_set("Asia/jakarta");		
		$this->load->model('m_chat');
		if ($this->session->userdata('id_admin')=="") {
			redirect(base_url().'index.php/login');
		}

		
	}

	public function index()	
	{
		$data['session'] = $this->session->userdata();
		$data['kpd_id'] 	= $this->input->get('kpd_id');
		$data['kpd_nama'] 	= $this->input->get('kpd_nama');
		$id = 'kasir';	
		$data['chat'] = $this->m_chat->list_chat_kasir('kasir');		
		$this->load->view('chat_kontainer.php',$data);
	}

	public function data_count_kasir()
	{
		$data['chat'] = $this->m_chat->list_chat_kasir('kasir');		
		$this->load->view('chat_data_count.php',$data);
	}

	public function data_count_kasir_notif()
	{
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: *");
		header('Content-Type: application/json');
		$q = $this->db->query("SELECT id FROM tbl_chat WHERE kpd_id='kasir' AND baca='belum'");
		$jit = $q->num_rows()==0?"":$q->num_rows();
		echo json_encode($jit);	
	}

	

	public function simpan_chat()
	{
		$data = $this->input->post();
		$this->db->insert('tbl_chat',$data);
	}

	public function update_chat($firebase_id)
	{
		$this->db->query("UPDATE tbl_chat SET baca='sudah' WHERE firebase_id='$firebase_id'");
	}


	public function chat_kasir()
	{
		$data['kpd_id'] 	= $this->input->get('kpd_id');
		$data['kpd_nama'] 	= $this->input->get('kpd_nama');
		$id = 'kasir';	
		$this->load->view('chat_kasir.php',$data);
	}


	public function chat_kontak_all()
	{
		$id = 'kasir';
		$data['list_chat'] = $this->m_chat->list_chat_kasir($id);

		$q = $this->db->query("SELECT * FROM `tbl_pelanggan` WHERE status='member'");
		$data['all'] = $q->result();
		$this->load->view('chat_kontak_all.php',$data);
	}

	public function chat_kontak()
	{
		$id = 'kasir';
		$data['list_chat'] = $this->m_chat->list_chat_kasir($id);
		$this->load->view('chat_kontak.php',$data);
	}

	public function chat_member()
	{
		$data['dari_id'] = $this->session->userdata('id_admin');
		$data['dari_nama'] = $this->session->userdata('nama_admin');
		$data['kpd_id'] = "kasir";
		$data['kpd_nama'] = "Kasir";
		$this->load->view('chat_member.php',$data);
	}
	

}
