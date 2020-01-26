<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengeluaran extends CI_Controller {
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
		$this->load->model('m_pengeluaran');
		$this->load->model('m_pembayaran');

	}


	public function data()
	{
		$data['all'] = $this->m_pengeluaran->m_data();	
		$this->load->view('data_pengeluaran',$data);
	}


	public function data_json()
	{
		header('Content-Type: application/json');
		$data['all'] = $this->m_pengeluaran->m_data();	
		echo json_encode($data['all']);
	}


	public function by_id($id)
	{
		header('Content-Type: application/json');
		$data['all'] = $this->m_pengeluaran->m_by_id($id);
		echo json_encode($data['all']);
	}



	public function slip_pengeluaran()
	{
		
		
		
		$id_jamaah 	= $this->input->get('id_jamaah');
		$id_paket 	= $this->input->get('id_paket');
		$data['id_paket'] = $id_paket;
		$data['id_jamaah'] = $id_jamaah;		
		$data['trx'] = $this->m_pengeluaran->m_data_telah_bayar($id_paket,$id_jamaah);


		$q = $this->db->query("SELECT * FROM tbl_jamaah WHERE id_jamaah='$id_jamaah'");
		$qq = $q->result();

		$data['jamaah'] = $qq[0];

		$q_p = $this->db->query("SELECT * FROM tbl_paket WHERE id='$id_paket'");
		$qq_p = $q_p->result();

		$data['paket'] = $qq_p[0];


		//var_dump($staff_arr);
		$filename = "slip_pengeluaran_".$this->router->fetch_class()."_".date('d_m_y_h_i_s');
		
		// As PDF creation takes a bit of memory, we're saving the created file in /downloads/reports/
		$pdfFilePath = FCPATH."/downloads/$filename.pdf";
		
		 //$html = $this->load->view('slip_pembayaran.php',$data);
    
    	//echo json_encode($data);
    	//$this->load->view('template/part/laporan_pdf.php',$data);
    	
    	
		if (file_exists($pdfFilePath) == FALSE)
		{
			//ini_set('memory_limit','512M'); // boost the memory limit if it's low <img class="emoji" draggable="false" alt="" src="https://s.w.org/images/core/emoji/72x72/1f609.png">
        	ini_set('memory_limit', '2048M');
			//$html = $this->load->view('laporan_mpdf/pdf_report', $data, true); // render the view into HTML
			$html = $this->load->view('slip_pengeluaran.php',$data,true);
			
			$this->load->library('pdf_potrait'); 
			$pdf = $this->pdf_potrait->load();
			//$this->load->library('pdf');
			//$pdf = $this->pdf->load();

			$pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date("YmdHis")."_".$this->session->userdata('id_admin')); // Add a footer for good measure <img class="emoji" draggable="false" alt="" src="https://s.w.org/images/core/emoji/72x72/1f609.png">
			$pdf->WriteHTML($html); // write the HTML into the PDF
			$pdf->Output($pdfFilePath, 'F'); // save to file because we can
		}
		 
		redirect(base_url()."downloads/$filename.pdf","refresh");
		
		
	}

	public function trx_pengeluaran()
	{
			
		$data['all'] = $this->m_pengeluaran->m_trx_pengeluaran();	
		$this->load->view('pengeluaran_trx',$data);
	}

	public function data_paket()
	{
		$data['all'] = $this->m_pembayaran->m_data_paket();	
		$data['pengeluaran'] = $this->m_pengeluaran->m_data();
		$this->load->view('data_paket_pengeluaran',$data);
	}

	public function form_pengeluaran()
	{
		
		$id_paket 	= $this->input->get('id_paket');
		$data['id_paket'] = $id_paket;
		$data['id_jamaah'] = $id_jamaah;

		$data['trx'] = $this->m_pengeluaran->m_data_telah_bayar($id_paket,$id_jamaah);

		$data['all'] = $this->m_pengeluaran->m_data();
		$this->load->view('form_pengeluaran',$data);
	}

	public function simpan_pengeluaran()
	{
		$data = $this->input->post();
		//var_dump($data);
		$id_paket = $data['id_paket'];
		$data['jumlah'] = hanya_nomor($data['jumlah']);

		$this->db->set($data);
		$this->db->insert('tbl_pengeluaran_transaksi');
		$id_trx = $this->db->insert_id();

			$ket = "Pengeluaran [".$data['nama_pengeluaran']."] id_paket $id_paket : jumlah=".$data['jumlah'];

			/*********** insert ke transaksi **************/	
			$ser_trx = array(
							"id_group"=>"1",							
							"keterangan"=>$ket,
							"jumlah"=>($data['jumlah']),
							"id_paket"=>$id_paket
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
			
			$this->m_pengeluaran->tambah_data($serialize);
			die('1');
		}else{

			$this->m_pengeluaran->update_data($serialize,$id);
			die('1');			

		}
		

	}

	public function hapus($id)
	{
		$this->m_pengeluaran->m_hapus_data($id);
	}


}
