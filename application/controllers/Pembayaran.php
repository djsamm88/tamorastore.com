<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran extends CI_Controller {
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
		$this->load->model('m_ambil');
		
	}

	public function ajukan_diskon()
	{
		$serialize = $this->input->post();
		$serialize['id_admin'] = $this->session->userdata('id_admin');
		$serialize['diskon'] = hanya_nomor($serialize['diskon']);

		$this->db->set($serialize);
		$this->db->insert('tbl_diskon');
	}
	
	public function data_paket()
	{
		$data['all'] = $this->m_pembayaran->m_data_paket();	
		$this->load->view('data_pembayaran',$data);
	}

	public function form_pembayaran()
	{
		$data['id_paket'] = $this->input->get('id_paket');
		$data['id_jamaah'] = $this->input->get('id_jamaah');
		$data['pembayaran'] = $this->m_pembayaran->m_pembayaran($data['id_jamaah'],$data['id_paket']);

		$id_paket = $data['id_paket'];
		$id_jamaah = $data['id_jamaah'];
		$q = $this->db->query("SELECT * FROM `tbl_paket` WHERE id='$id_paket'");

		$tot_tagihan=0;
		foreach ($q->result() as $x) {
			$total = $x->harga_paket;
			$tot_tagihan+=$total;
		}

		$data['tot_tagihan'] = $tot_tagihan;
		$data['tgl_umroh'] = $x->tgl_umroh;


		$q_diskon = $this->db->query("SELECT * FROM `tbl_diskon` WHERE id_paket='$id_paket' AND id_jamaah='$id_jamaah'");
		$diskon = 0;
		$int_diskon=0;
		foreach ($q_diskon->result() as $key) {
			if($key->status=='1')
			{
				$diskon+=$key->diskon;
			}
			$int_diskon++;
		}

		$data['diskon'] = $diskon;
		$data['int_diskon'] = $int_diskon;

		$this->load->view('form_pembayaran',$data);
	}


	public function slip_pembayaran()
	{
		
		
		$data['id_paket'] = $this->input->get('id_paket');
		$data['id_jamaah'] = $this->input->get('id_jamaah');
		$data['pembayaran'] = $this->m_pembayaran->m_pembayaran($data['id_jamaah'],$data['id_paket']);

		$id_jamaah = $data['id_jamaah'];
		$id_paket = $data['id_paket'];
		$q = $this->db->query("SELECT * FROM tbl_jamaah WHERE id_jamaah='$id_jamaah'");
		$qq = $q->result();

		$data['jamaah'] = $qq[0];

		$q_p = $this->db->query("SELECT * FROM tbl_paket WHERE id='$id_paket'");
		$qq_p = $q_p->result();

		$data['paket'] = $qq_p[0];
		

		$tot_tagihan=0;
		foreach ($q_p->result() as $x) {
			$total = $x->harga_paket;
			$tot_tagihan+=$total;
		}

		$data['tot_tagihan'] = $tot_tagihan;
		$data['tgl_umroh'] = $x->tgl_umroh;


		$q_diskon = $this->db->query("SELECT * FROM `tbl_diskon` WHERE id_paket='$id_paket' AND id_jamaah='$id_jamaah'");
		$diskon = 0;
		$int_diskon=0;
		foreach ($q_diskon->result() as $key) {
			if($key->status=='1')
			{
				$diskon+=$key->diskon;
			}
			$int_diskon++;
		}

		$data['diskon'] = $diskon;
		$data['int_diskon'] = $int_diskon;


		//var_dump($staff_arr);
		$filename = "slip_pembayaran_".$this->router->fetch_class()."_".date('d_m_y_h_i_s');
		
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
			$html = $this->load->view('slip_pembayaran.php',$data,true);
			
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



	public function simpan_pembayaran()
	{
		$serialize = $this->input->post();
		
		$serialize['bukti_pembayaran'] = upload_file('bukti_pembayaran');
		$serialize['id_admin'] = $this->session->userdata('id_admin');
		$serialize['jumlah_pembayaran'] = hanya_nomor($serialize['jumlah_pembayaran']);

		$total_bayar = hanya_nomor($serialize['total_bayar']);
		$sisa = hanya_nomor($serialize['sisa']);

		if(($serialize['jumlah_pembayaran']+$total_bayar)>=$sisa)
		{
			$this->db->where('id_jamaah',$serialize['id_jamaah']);
			$this->db->set('lunas','1');
			$this->db->update('tbl_jamaah');
		}
		unset($serialize['total_bayar']);
		unset($serialize['sisa']);



		$id_pembayaran = $this->m_pembayaran->tambah_data($serialize);

		$jamaah = $this->m_ambil->ambil_jamaah($serialize['id_jamaah']);

		$ser_trx = array(
					"id_group"=>'2',
					"id_referensi"=>$id_pembayaran,
					"keterangan"=>"Pembayaran cicilan jamaah [$jamaah->nama] - id_jamaah :".$serialize['id_jamaah'],
					"jumlah"=>$serialize['jumlah_pembayaran'],
					"id_paket"=>$serialize['id_paket']
					);

		$this->db->set($ser_trx);
		$this->db->insert('tbl_transaksi');
	}
	

	public function table_jamaah($id_paket)
	{
		$data['id_paket'] = $id_paket;
		$data['all'] = $this->m_pembayaran->m_data_by_id_paket($id_paket);	
		$this->load->view('table_jamaah_pembayaran',$data);
	}


	public function approve_diskon()
	{
		
		$data['all'] = $this->m_pembayaran->m_approve_diskon();	
		$this->load->view('aprove_diskon',$data);
	}


	public function go_approve_diskon()
	{

		$serialize = $this->input->post();

		$id = $this->input->post('id');
		
		if($this->db->query("UPDATE tbl_diskon SET status='1' WHERE id='$id'"))
		{

			$this->load->model('m_ambil');
			$jamaah = $this->m_ambil->ambil_jamaah($serialize['id_jamaah']);

			$ser_trx = array(
					"id_group"=>'9',
					"id_referensi"=>$serialize['id'],
					"keterangan"=>"Pemberian diskon ke jamaah [$jamaah->nama] id :".$serialize['id_jamaah'],
					"jumlah"=>$serialize['diskon'],
					"id_paket"=>$serialize['id_paket']
					);

			$this->db->set($ser_trx);
			$this->db->insert('tbl_transaksi');	
		}

		
	}



}
