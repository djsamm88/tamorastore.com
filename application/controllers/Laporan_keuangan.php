<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_keuangan extends CI_Controller {
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
		$this->load->model('m_laporan_keuangan');
		$this->load->model('m_pelanggan');


	}

	public function kas()
	{
		$data['kas'] = $this->m_laporan_keuangan->m_sisa_kas();
		$data['laporan_group'] = $this->m_laporan_keuangan->m_laporan_group();
		$this->load->view('table_sisa_kas',$data);
	}

	public function arus_kas()
	{
		
		$data['laporan_group'] = $this->m_laporan_keuangan->m_laporan_group();
		$this->load->view('tbl_arus_kas',$data);
	}

	public function arus_kas_paket()
	{
		
		$data['laporan_paket'] = $this->m_laporan_keuangan->m_saldo_per_paket();
		$this->load->view('tbl_arus_kas_paket',$data);
	}

	

	public function form_penambahan_saldo()
	{
		$this->load->view('form_penambahan_saldo');
	}

	public function form_penarikan_saldo()
	{
		$this->load->view('form_penarikan_saldo');
	}

	public function form_koreksi()
	{
		$this->load->view('form_koreksi');
	}

	

	public function go_tambah_kas()
	{
		$serialize = $this->input->post();
		$serialize['jumlah']=hanya_nomor($serialize['jumlah']);
		$serialize['id_group']='5';
		
		$this->db->set($serialize);
		$this->db->insert('tbl_transaksi');

	}



	public function by_tgl($tgl)
	{
		header('Content-Type: application/json');
		$data['all'] = $this->m_laporan_keuangan->m_by_tgl($tgl);
		echo json_encode($data['all']);
	}

	public function go_koreksi()
	{
		$serialize = $this->input->post();
		$serialize['jumlah']=($serialize['jumlah']);
		$serialize['id_group']='12';
		unset($serialize['tanggal_kesalahan']);
		
		
		$id = $serialize['trx_lama'];
		$q = $this->m_laporan_keuangan->m_by_id($id);

		$serialize['id_barang'] = @$q[0]->id_barang;
		$serialize['id_barang']= $serialize['id_barang']==''?'0':$serialize['id_barang'];
		unset($serialize['trx_lama']);
		$this->db->set($serialize);
		$this->db->insert('tbl_transaksi');


	}


	public function go_tarik_kas()
	{
		$serialize = $this->input->post();
		$serialize['jumlah']=hanya_nomor($serialize['jumlah']);
		$serialize['id_group']='11';
		
		$this->db->set($serialize);
		$this->db->insert('tbl_transaksi');

	}

	public function laporan_jurnal()
	{
		$tgl_awal = $this->input->get('tgl_awal');
		$tgl_akhir = $this->input->get('tgl_akhir');
		$data['all'] = $this->m_laporan_keuangan->m_jurnal($tgl_awal,$tgl_akhir);
		$data['tgl_awal'] = $tgl_awal;
		$data['tgl_akhir'] = $tgl_akhir;
		$this->load->view('table_jurnal',$data);
	}


	public function laporan_jurnal_pelanggan($id_pelanggan)
	{
		$data['all'] = $this->m_laporan_keuangan->m_jurnal_pelanggan($id_pelanggan);		
		$data['pelanggan'] = $this->m_pelanggan->m_by_id($id_pelanggan)[0];		
		$this->load->view('table_jurnal_pelanggan',$data);
	}


	public function laporan_laba()
	{
		$tgl_awal = $this->input->get('tgl_awal');
		$tgl_akhir = $this->input->get('tgl_akhir');
		$data['all'] = $this->m_laporan_keuangan->m_laba($tgl_awal,$tgl_akhir);
		$data['tgl_awal'] = $tgl_awal;
		$data['tgl_akhir'] = $tgl_akhir;
		$this->load->view('table_laba',$data);

	}



	public function laporan_laba_pdf()
	{
		$tgl_awal = $this->input->get('tgl_awal');
		$tgl_akhir = $this->input->get('tgl_akhir');
		$data['all'] = $this->m_laporan_keuangan->m_laba($tgl_awal,$tgl_akhir);
		$data['tgl_awal'] = $tgl_awal;
		$data['tgl_akhir'] = $tgl_akhir;
		//$this->load->view('table_laba',$data);



		//var_dump($staff_arr);
		$filename = "laba_rugi_".$this->router->fetch_class()."_".date('d_m_y_h_i_s');
		
		// As PDF creation takes a bit of memory, we're saving the created file in /downloads/reports/
		$pdfFilePath = FCPATH."downloads/$filename.pdf";
		
		 //$html = $this->load->view('slip_pembayaran.php',$data);
    
    	//echo json_encode($data);
    	//$this->load->view('template/part/laporan_pdf.php',$data);
    	
    	
		if (file_exists($pdfFilePath) == FALSE)
		{
			//ini_set('memory_limit','512M'); // boost the memory limit if it's low <img class="emoji" draggable="false" alt="" src="https://s.w.org/images/core/emoji/72x72/1f609.png">
        	ini_set('memory_limit', '2048M');
			//$html = $this->load->view('laporan_mpdf/pdf_report', $data, true); // render the view into HTML
			$html = $this->load->view('table_laba_pdf.php',$data,true);
			
			//$this->load->library('pdf_potrait'); 
			//$pdf = $this->pdf_potrait->load();
			$this->load->library('pdf');
			$pdf = $this->pdf->load();

			$pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date("YmdHis")."_".$this->session->userdata('id_admin')); // Add a footer for good measure <img class="emoji" draggable="false" alt="" src="https://s.w.org/images/core/emoji/72x72/1f609.png">
			$pdf->WriteHTML($html); // write the HTML into the PDF
			$pdf->Output($pdfFilePath, 'F'); // save to file because we can
		}
		 
		redirect(base_url()."downloads/$filename.pdf","refresh");
		

	}

	


	public function laporan_jurnal_pdf()
	{
		$tgl_awal = $this->input->get('tgl_awal');
		$tgl_akhir = $this->input->get('tgl_akhir');
		$data['all'] = $this->m_laporan_keuangan->m_jurnal($tgl_awal,$tgl_akhir);
		$data['tgl_awal'] = $tgl_awal;
		$data['tgl_akhir'] = $tgl_akhir;
		//$this->load->view('table_jurnal_pdf',$data);



		//var_dump($staff_arr);
		$filename = "jurnal_".$this->router->fetch_class()."_".date('d_m_y_h_i_s');
		
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
			$html = $this->load->view('table_jurnal_pdf.php',$data,true);
			
			//$this->load->library('pdf_potrait'); 
			//$pdf = $this->pdf_potrait->load();
			$this->load->library('pdf');
			$pdf = $this->pdf->load();

			$pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date("YmdHis")."_".$this->session->userdata('id_admin')); // Add a footer for good measure <img class="emoji" draggable="false" alt="" src="https://s.w.org/images/core/emoji/72x72/1f609.png">
			$pdf->WriteHTML($html); // write the HTML into the PDF
			$pdf->Output($pdfFilePath, 'F'); // save to file because we can
		}
		 
		redirect(base_url()."downloads/$filename.pdf","refresh");
		

	}

	
	public function detail_arus_kas()
	{
		$tgl_awal = $this->input->get('tgl_awal');
		$tgl_akhir = $this->input->get('tgl_akhir');
		$id_group = $this->input->get('id_group');
		$data['all'] = $this->m_laporan_keuangan->m_detail_arus_kas($id_group,$tgl_awal,$tgl_akhir);
		$data['tgl_awal'] = $tgl_awal;
		$data['tgl_akhir'] = $tgl_akhir;
		$this->load->view('detail_arus_kas',$data);
	}


	public function detail_arus_kas_paket()
	{
		$tgl_awal = $this->input->get('tgl_awal');
		$tgl_akhir = $this->input->get('tgl_akhir');
		$id_paket = $this->input->get('id_paket');
		$data['all'] = $this->m_laporan_keuangan->m_detail_arus_kas_paket($id_paket,$tgl_awal,$tgl_akhir);
		$data['tgl_awal'] = $tgl_awal;
		$data['tgl_akhir'] = $tgl_akhir;
		$this->load->view('detail_arus_kas',$data);
	}

	


	public function detail_arus_kas_paket_pdf()
	{
		$tgl_awal = $this->input->get('tgl_awal');
		$tgl_akhir = $this->input->get('tgl_akhir');
		$id_paket = $this->input->get('id_paket');
		$data['all'] = $this->m_laporan_keuangan->m_detail_arus_kas_paket($id_paket,$tgl_awal,$tgl_akhir);
		$data['tgl_awal'] = $tgl_awal;
		$data['tgl_akhir'] = $tgl_akhir;
		$data['nama_paket_input'] = urldecode($this->input->get('nama_paket_input'));
		//$this->load->view('detail_arus_kas_pdf',$data);


		//var_dump($staff_arr);
		$filename = "arus_kas_".$this->router->fetch_class()."_".date('d_m_y_h_i_s');
		
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
			$html = $this->load->view('detail_arus_kas_paket_pdf.php',$data,true);
			
			//$this->load->library('pdf_potrait'); 
			//$pdf = $this->pdf_potrait->load();
			$this->load->library('pdf');
			$pdf = $this->pdf->load();

			$pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date("YmdHis")."_".$this->session->userdata('id_admin')); // Add a footer for good measure <img class="emoji" draggable="false" alt="" src="https://s.w.org/images/core/emoji/72x72/1f609.png">
			$pdf->WriteHTML($html); // write the HTML into the PDF
			$pdf->Output($pdfFilePath, 'F'); // save to file because we can
		}
		 
		redirect(base_url()."downloads/$filename.pdf","refresh");
		
		
	}


	public function detail_arus_kas_pdf()
	{
		$tgl_awal = $this->input->get('tgl_awal');
		$tgl_akhir = $this->input->get('tgl_akhir');
		$id_group = $this->input->get('id_group');
		$data['all'] = $this->m_laporan_keuangan->m_detail_arus_kas($id_group,$tgl_awal,$tgl_akhir);
		$data['tgl_awal'] = $tgl_awal;
		$data['tgl_akhir'] = $tgl_akhir;
		//$this->load->view('detail_arus_kas_pdf',$data);


		//var_dump($staff_arr);
		$filename = "arus_kas_".$this->router->fetch_class()."_".date('d_m_y_h_i_s');
		
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
			$html = $this->load->view('detail_arus_kas_pdf.php',$data,true);
			
			//$this->load->library('pdf_potrait'); 
			//$pdf = $this->pdf_potrait->load();
			$this->load->library('pdf');
			$pdf = $this->pdf->load();

			$pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date("YmdHis")."_".$this->session->userdata('id_admin')); // Add a footer for good measure <img class="emoji" draggable="false" alt="" src="https://s.w.org/images/core/emoji/72x72/1f609.png">
			$pdf->WriteHTML($html); // write the HTML into the PDF
			$pdf->Output($pdfFilePath, 'F'); // save to file because we can
		}
		 
		redirect(base_url()."downloads/$filename.pdf","refresh");
		
		
	}

	

	
}
