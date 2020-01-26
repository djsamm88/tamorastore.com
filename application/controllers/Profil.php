<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {
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
		$this->load->model('m_profil');

		
	}


	public function data_session_user()
	{			
		$data['admin']=$this->m_profil->data_session_user($this->session->userdata('id_admin'));
		$this->load->view('form_profil.php', $data);
		
	}


	public function simpan_form()
	{
		$id_admin = $this->input->post('id_admin');
		$nama_admin = $this->input->post('nama_admin');
		$user_admin = $this->input->post('user_admin');
		$email_admin = $this->input->post('email_admin');
		$pass_admin = $this->input->post('pass_admin');
		$telp_admin = $this->input->post('telp_admin');



		if($id_admin=='')
		{
			//cek dulu email atau username apakah sudah ada
			$cek = $this->m_profil->cek_email_user($user_admin,$email_admin);
			if($cek > 0)
			{
				die('0');//sudah ada email atau username
			}

			$serialize = array(
						"telp_admin"=>$telp_admin,
						"nama_admin"=>$nama_admin,
						"user_admin"=>$user_admin,
						"email_admin"=>$email_admin,
						"pass_admin"=>md5($pass_admin)
						);
			$this->m_ad->tambah_admin($serialize);
			die('1');
		}else{

			$cek_pass = $this->m_profil->cek_pass($id_admin);

			/************* cek apakah ganti password **************/
			if($cek_pass==$pass_admin)
			{				
				$serialize = array(
						"telp_admin"=>$telp_admin,
						"nama_admin"=>$nama_admin,
						"user_admin"=>$user_admin,
						"email_admin"=>$email_admin,
						"pass_admin"=>($pass_admin)
						);
				$this->m_profil->update_admin($serialize,$id_admin);
				die('1');
			}else{
				$serialize = array(
						"telp_admin"=>$telp_admin,
						"nama_admin"=>$nama_admin,
						"user_admin"=>$user_admin,
						"email_admin"=>$email_admin,
						"pass_admin"=>md5($pass_admin)
						);
				$this->m_profil->update_admin($serialize,$id_admin);
				die('1');
			}


		}
		

	}

}
