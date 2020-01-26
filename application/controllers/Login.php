<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {


	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');		
		$this->load->model('m_login');		
		$this->load->helper('custom_func');				
		$this->load->helper('text');
		date_default_timezone_set("Asia/jakarta");
	}

	private function randomnya($length = 10) 
	{
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) 
		{
	        $randomString .= $characters[rand(0, strlen($characters) - 1)];
	    }
	    return $randomString;
	}

	public function index() {
		$data['title']="Login";
		/*---------------/random kontak/---------------*/
		$sess_data['random'] = $this->randomnya(5);
		$this->session->set_userdata($sess_data);
		/*---------------/random kontak/---------------*/				

		$data['random'] = $sess_data['random'];

		//var_dump($this->session->userdata('random'));
		$this->load->helper(array('form'));
		$this->load->view('form_login.php',$data);
	}

	public function new_rand()
	{
		$sess_data['random'] = $this->randomnya(5);
		$this->session->set_userdata($sess_data);

		die($sess_data['random']);
	}


	private function gas($x)
	{
		$a = stripslashes(strip_tags(htmlspecialchars($x,ENT_QUOTES)));
		$a = str_replace("'", "", $a);
		return $a;
	}
	public function cek_login() {
		
		if($this->session->userdata('random')!=$this->input->post('captcha'))
		{
			die("5");
		}

		$user = $this->gas($this->input->post('user_admin'));
		$pass = md5($this->input->post('pass_admin'));

		$bool = $this->m_login->cek_user($user,$pass);

		//var_dump($bool);	

		$ret='';
		
		if ($bool->num_rows() > 0) 
		{
			
			$z = $bool->result();
			$sess = $z[0];
				
				if($sess->status_admin=='0')
				{
					$ret= '2';
				}else{
					

					$sess_data['user_admin'] 	= $sess->user_admin;
					$sess_data['id_admin'] 		= $sess->id_admin;					
					$sess_data['level'] 		= $sess->level;		
					$sess_data['email_admin']	= $sess->email_admin;		
					//$sess_data['id_desa']		= $sess->id_desa;
					$sess_data['nama_admin']	= $sess->nama_admin;

					$this->session->set_userdata($sess_data);
					$ret= '1';

					//var_dump($sess);
				}
				
			

			//var_dump($bool->result()[0]->level);
			
			
		}
		else {
			$ret= $bool->num_rows();
		}
		//$this->load->view('form_login.php',$data);
		//echo $ret['info'];
		echo $ret;
	}


	public function cek_email()
	{
		$email = buang_single_quote($this->input->post('email'),TRUE);
		$data = $this->m_login->m_cek_email($email);
		echo $data;

		if($data !=0)
		{
			$this->send_email($email);
		}

	}


	public function send_email($email)
	{
		$code  		= str_replace("=", "",base64_encode(date('Y-m-d')));
		$en_email 	= str_replace("=", "",base64_encode($email));
		$text 		= str_replace("=", "",base64_encode(base_url()."index.php/login/reset/?x=".$en_email."&y=".$code));
		$fullurl 	= base_url()."assets/PHPMailer/gmail.php?text=".$text."&email=".$email;
		var_dump($this->exec_url($fullurl));

		$this->db->query("UPDATE tbl_admin SET request_status='1' WHERE email_admin='$email'");

	}


	public function reset()
	{

		$email = base64_decode($this->input->get('x'));
		$date  = base64_decode($this->input->get('y'));

		$new_pass = $this->randomnya(6);
		$new_pass_en = md5($new_pass);
		if($date != date('Y-m-d'))			
		{
			die('Url sudah kadaluarsa.[lewat 24 jam]');
		}else{
			
			$cek_request_sent = $this->m_login->cek_request_status($email);
			if($cek_request_sent=='1')
			{
				$this->db->query("UPDATE tbl_admin SET pass_admin='$new_pass_en',request_status='0' WHERE email_admin='$email'");
			}else{
				die('Url sudah kadaluarsa.[sudah pernah dipakai]');
			}
			
			die('<center>Password baru anda adalah: <b>'.$new_pass."</b>. Silahkan ganti ke yang lebih mudah diingat.</center>");
		}

	}


	

	private function exec_url($fullurl)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_FAILONERROR, 0);
		curl_setopt($ch, CURLOPT_URL, $fullurl);
		
		$returned =  curl_exec($ch);
	
		return ($returned);

	}


	public function logout() {
		$this->session->unset_userdata('id_admin');		
		session_destroy();
		redirect(base_url().'index.php/login');
	}
	
	
}