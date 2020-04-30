<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {
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
		$this->load->model('m_barang');
		$this->load->model('m_ambil');
		$this->load->model('m_pelanggan');
		$this->load->model('m_ekspedisi');
		$this->load->model('m_gudang');

	}



	public function form_barang_sementara()
	{
		$data['all'] = $this->m_barang->m_data();	
		$data['gudang'] = $this->m_gudang->m_data();		
		$this->load->view('form_barang_sementara',$data);
		
	}

	public function go_simpan_sementara()
	{
		$serialize = $this->input->post();
		$this->db->set($serialize);
		$this->db->insert('tbl_barang_masuk_tanpa_harga');
	}


	public function barang_transaksi()
	{
		$data['all'] = $this->m_barang->m_barang_transaksi();			
		$this->load->view('barang_transaksi',$data);
	}


	public function kalkulasi_barang()
	{
		header('Content-Type: application/json');
		$serialize = $this->input->post();
		
		echo json_encode($serialize);
	}

	public function go_pending_jual()
	{
		$data = $this->input->post();

		/********* insert pelanggan ************/
		$arrPelanggan = array(
				"nama_pembeli" 	=>$data['nama_pembeli'],
				"hp_pembeli" 	=>$data['hp_pembeli'],
				"tgl_daftar" 	=>date('Y-m-d H:i:s')
		);
		if($data['id_pelanggan']=="")
		{
			$id_pelanggan = $this->m_pelanggan->insert($arrPelanggan);
		}else{
			$id_pelanggan 	= $data['id_pelanggan'];
			$arrUpdate 		= array(
								"tgl_trx_terakhir"=>date('Y-m-d H:i:s')
							  );
			$this->m_pelanggan->update($arrUpdate,$id_pelanggan);
		}
		/********* insert pelanggan ************/

		//var_dump($data);
		$total_tanpa_diskon =0; 
		$total_harga_beli 	=0; 
		$id_barang = $data['id_barang'];

		for($i=0;$i<count($id_barang);$i++) {
			//$data['harga_jual'] as $key => $harga_jual
			$key=$i;
			$id = $id_barang[$i];
			$harga_jual = $data['harga_jual'][$i];
			# code...
			//echo $key;
			/********** mengambil detail barang dari db***********/
			$q_detail_barang = $this->m_barang->m_by_id($id);
			$barang = $q_detail_barang[0];
			/********** mengambil detail barang dari db***********/


			$serialize['id_admin'] 		= $this->session->userdata('id_admin');
			$serialize['id_barang'] 	= $id;
			$serialize['harga_jual'] 	= hanya_nomor($harga_jual);
			$serialize['satuan_jual'] 	= $data['satuan_jual'][$key];
			$serialize['jenis'] 		= 'pending_keluar';
			$serialize['grup_penjualan'] = $data['grup_penjualan'];		

			$serialize['id_pelanggan'] 	= $id_pelanggan;
			$serialize['nama_pembeli'] 	= $data['nama_pembeli'];
			$serialize['hp_pembeli'] 	= $data['hp_pembeli'];
			
			$serialize['nama_packing'] 	= $data['nama_packing'];
			$serialize['tgl_trx_manual']= $data['tgl_trx_manual'];
			$serialize['keterangan']	= $data['keterangan'];

			$serialize['diskon'] 		= hanya_nomor($data['diskon']);
			$serialize['saldo'] 		= hanya_nomor($data['saldo']);

			$serialize['bayar'] 		= hanya_nomor($data['bayar']);
			$serialize['transport_ke_ekspedisi'] = hanya_nomor($data['transport_ke_ekspedisi']);
			$serialize['harga_ekspedisi'] 		 = hanya_nomor($data['harga_ekspedisi']);
			$serialize['nama_ekspedisi'] 		 = ($data['nama_ekspedisi']);
			
			$serialize['sub_total_jual']= $serialize['harga_jual']*$data['jumlah'][$key];
			$serialize['sub_total_beli']= $barang->harga_pokok*$data['jumlah'][$key];
			$serialize['qty_jual']		= $data['jumlah'][$key];
			$serialize['jum_per_koli']	= $barang->jum_per_koli;
			$serialize['harga_beli']	= $barang->harga_pokok;
			$serialize['id_gudang']		= '1';
			


			$serialize['jumlah'] = $data['jumlah'][$key];

			/************ insert ke tbl_barang_transaksi *************/
			$this->m_barang->insert_trx_barang($serialize);
			/************ insert ke tbl_barang_transaksi *************/

			$total_tanpa_diskon	+=$serialize['sub_total_jual'];
			$total_harga_beli	+=$serialize['sub_total_beli'];
		}


		echo $data['grup_penjualan'];
	}

	public function go_jual()
	{
		$data = $this->input->post();


		/********* insert pelanggan ************/
		$arrPelanggan = array(
				"nama_pembeli" 	=>$data['nama_pembeli'],
				"hp_pembeli" 	=>$data['hp_pembeli'],
				"tgl_daftar" 	=>date('Y-m-d H:i:s')
		);
		if($data['id_pelanggan']=="")
		{
			$id_pelanggan = $this->m_pelanggan->insert($arrPelanggan);
		}else{
			$id_pelanggan 	= $data['id_pelanggan'];
			$arrUpdate 		= array(
								"tgl_trx_terakhir"=>date('Y-m-d H:i:s')
							  );
			$this->m_pelanggan->update($arrUpdate,$id_pelanggan);
		}
		/********* insert pelanggan ************/

		//var_dump($data);
		$total_tanpa_diskon =0; 
		$total_harga_beli 	=0; 
		$id_barang = $data['id_barang'];

		for($i=0;$i<count($id_barang);$i++) {
			//$data['harga_jual'] as $key => $harga_jual
			$key=$i;
			$id = $id_barang[$i];
			$harga_jual = $data['harga_jual'][$i];
			# code...
			//echo $key;
			/********** mengambil detail barang dari db***********/
			$q_detail_barang = $this->m_barang->m_by_id($id);
			$barang = $q_detail_barang[0];
			/********** mengambil detail barang dari db***********/


			$serialize['id_admin'] 		= $this->session->userdata('id_admin');
			$serialize['id_barang'] 	= $id;
			$serialize['harga_jual'] 	= hanya_nomor($harga_jual);
			$serialize['satuan_jual'] 	= $data['satuan_jual'][$key];
			$serialize['jenis'] 		= 'keluar';
			$serialize['grup_penjualan'] = $data['grup_penjualan'];		

			$serialize['id_pelanggan'] 	= $id_pelanggan;
			$serialize['nama_pembeli'] 	= $data['nama_pembeli'];
			$serialize['hp_pembeli'] 	= $data['hp_pembeli'];
			
			$serialize['nama_packing'] 	= $data['nama_packing'];
			$serialize['tgl_trx_manual']= $data['tgl_trx_manual'];
			$serialize['keterangan']	= $data['keterangan'];

			$serialize['diskon'] 		= hanya_nomor($data['diskon']);
			$serialize['saldo'] 		= hanya_nomor($data['saldo']);

			$serialize['bayar'] 		= hanya_nomor($data['bayar']);
			$serialize['transport_ke_ekspedisi'] = hanya_nomor($data['transport_ke_ekspedisi']);
			$serialize['harga_ekspedisi'] 		 = hanya_nomor($data['harga_ekspedisi']);
			$serialize['nama_ekspedisi'] 		 = ($data['nama_ekspedisi']);
			
			$serialize['sub_total_jual']= $serialize['harga_jual']*$data['jumlah'][$key];
			$serialize['sub_total_beli']= $barang->harga_pokok*$data['jumlah'][$key];
			$serialize['qty_jual']		= $data['jumlah'][$key];
			$serialize['jum_per_koli']	= $barang->jum_per_koli;
			$serialize['harga_beli']	= $barang->harga_pokok;
			$serialize['id_gudang']		= '1';
			


			$serialize['jumlah'] = $data['jumlah'][$key];

			/************ insert ke tbl_barang_transaksi *************/
			$this->m_barang->insert_trx_barang($serialize);
			/************ insert ke tbl_barang_transaksi *************/

			$total_tanpa_diskon	+=$serialize['sub_total_jual'];
			$total_harga_beli	+=$serialize['sub_total_beli'];
		}


		

		$serialize['transport_ke_ekspedisi'] = hanya_nomor($data['transport_ke_ekspedisi']);
		$serialize['harga_ekspedisi'] 		 = hanya_nomor($data['harga_ekspedisi']);

		/*********** insert ke transaksi **************/	
		$ket = "Kpd: [".$data['nama_pembeli']."] - Kode TRX:[".$data['grup_penjualan']."] 
				Jumlah:[".rupiah($total_tanpa_diskon)."] 
				diskon:[".$data['diskon']."] 
				harga_ekspedisi:[".$data['harga_ekspedisi']."] 
				transport_ke_ekspedisi:[".$data['transport_ke_ekspedisi']."] 
				".$data['keterangan'];

		$ser_trx = array(
						"id_group"		=> "8",							
						"keterangan"	=> $ket,
						"jumlah"		=> ($total_tanpa_diskon),
						"harga_beli"	=> ($total_harga_beli),
						"diskon"		=> $serialize['diskon'],
						"harga_ekspedisi"			=> $serialize['harga_ekspedisi'],
						"transport_ke_ekspedisi"	=> $serialize['transport_ke_ekspedisi'],
						"id_referensi"	=> $data['grup_penjualan'],
						"id_pelanggan"	=> $id_pelanggan
					);				
		/* untuk id_referensi = id_group/id_table*/				
		$this->db->set($ser_trx);
		$this->db->insert('tbl_transaksi');
		/*********** insert ke transaksi **************/

		/********* insert diskon **********/
		if(hanya_nomor($data['diskon'])>0)
		{
			$ser_trx_diskon = array(
						"id_group"=>"9",							
						"keterangan"=>$ket,
						"jumlah"=>hanya_nomor($data['diskon']),
						"id_referensi"=>$data['grup_penjualan']
					);	
			$this->db->set($ser_trx_diskon);
			$this->db->insert('tbl_transaksi');

		}		
		/********* insert diskon **********/
		

		//utang/piutang
		if(hanya_nomor($data['saldo'])!=0)
		{
			if($data['saldo']<0)
			{
				$ser_saldo['id_group']='18';	
			}else{
				$ser_saldo['id_group']='17';	
			}
			
			
			
			$this->db->query("UPDATE tbl_pelanggan SET saldo=0 WHERE id_pelanggan='$id_pelanggan'");

			$jumlah = hanya_nomor($data['saldo']);			
			$ser_saldo['jumlah'] 		= str_replace("-", "", $jumlah);
			$ser_saldo['keterangan'] 	= "Saldo potong langsung saat belanja dengan ID TRX:"
										  .$data['grup_penjualan']." - A.n : "
										  .$data['nama_pembeli']." - ID :"
										  .$id_pelanggan;

			$ser_saldo['id_referensi'] = $data['grup_penjualan'];
			$ser_saldo['id_pelanggan'] = $id_pelanggan;

			$this->db->set($ser_saldo);
			$this->db->insert('tbl_transaksi');
		}
		//utang/piutang

		/********* insert transport_ke_ekspedisi **********/
		/*
		if(hanya_nomor($data['transport_ke_ekspedisi'])>0)
		{
			$ser_trx_diskon = array(
						"id_group"=>"14",							
						"keterangan"=>$ket,
						"jumlah"=>hanya_nomor($data['transport_ke_ekspedisi']),
						"id_referensi"=>$data['grup_penjualan']
					);	
			$this->db->set($ser_trx_diskon);
			$this->db->insert('tbl_transaksi');

		}		
		
		if(hanya_nomor($data['harga_ekspedisi'])>0)
		{
			$ser_trx_diskon = array(
						"id_group"=>"13",							
						"keterangan"=>$ket,
						"jumlah"=>hanya_nomor($data['transport_ke_ekspedisi']),
						"id_referensi"=>$data['grup_penjualan']
					);	
			$this->db->set($ser_trx_diskon);
			$this->db->insert('tbl_transaksi');

		}		

		if(hanya_nomor($data['transport_ke_ekspedisi'])>0)
		{
			$ser_trx_diskon = array(
						"id_group"=>"16",							
						"keterangan"=>$ket,
						"jumlah"=>hanya_nomor($data['transport_ke_ekspedisi']),
						"id_referensi"=>$data['grup_penjualan']
					);	
			$this->db->set($ser_trx_diskon);
			$this->db->insert('tbl_transaksi');

		}		
		
		if(hanya_nomor($data['harga_ekspedisi'])>0)
		{
			$ser_trx_diskon = array(
						"id_group"=>"15",							
						"keterangan"=>$ket,
						"jumlah"=>hanya_nomor($data['transport_ke_ekspedisi']),
						"id_referensi"=>$data['grup_penjualan']
					);	
			$this->db->set($ser_trx_diskon);
			$this->db->insert('tbl_transaksi');

		}		
		*/
		/********* insert harga_ekspedisi **********/
		

		echo $data['grup_penjualan'];
	}

	public function form_penjualan()
	{
		$data['all'] = $this->m_barang->m_data_gudang(1)->result();		
		$data['pelanggan'] = $this->m_pelanggan->m_data();	
		$data['eksepedisi'] = $this->m_ekspedisi->m_data();	

		$this->load->view('form_penjualan_barang',$data);
	}

	public function pesanan_by_group($grup_penjualan)
	{
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: *");
		header('Content-Type: application/json');
		$data = $this->m_barang->m_detail_penjualan($grup_penjualan);
		echo json_encode($data);	

	}
	public function json_pelanggan()
	{
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: *");
		header('Content-Type: application/json');	
		$query = $this->input->get('cari'); 
		$data['all'] = $this->m_pelanggan->m_data_autocomplete($query);
		echo json_encode($data['all']);	
	}

	public	function json_barang_toko()
	{
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: *");
		header('Content-Type: application/json');	
		$query = $this->input->get('cari'); 
		$data['all'] = $this->m_barang->m_data_gudang_autocomplete(1,$query)->result();
		echo json_encode($data['all']);
	}


	public function struk_penjualan($group_penjualan)
	{
		$data['data'] = $this->m_barang->m_detail_penjualan_struk($group_penjualan);		
		$this->load->view('struk',$data);
	}



	public function slip_barang()
	{
		
		
		
		$id_jamaah 	= $this->input->get('id_jamaah');
		$id_paket 	= $this->input->get('id_paket');
		$data['id_paket'] = $id_paket;
		$data['id_jamaah'] = $id_jamaah;		
		$data['trx'] = $this->m_barang->m_history($id_paket,$id_jamaah);


		$q = $this->db->query("SELECT * FROM tbl_jamaah WHERE id_jamaah='$id_jamaah'");
		$qq = $q->result();

		$data['jamaah'] = $qq[0];

		$q_p = $this->db->query("SELECT * FROM tbl_paket WHERE id='$id_paket'");
		$qq_p = $q_p->result();

		$data['paket'] = $qq_p[0];


		//var_dump($staff_arr);
		$filename = "slip_barang_".$this->router->fetch_class()."_".date('d_m_y_h_i_s');
		
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
			$html = $this->load->view('slip_barang.php',$data,true);
			
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



	public function data()
	{
		$data['all'] = $this->m_barang->m_data();	
		$this->load->view('data_barang',$data);

	}


	public function data_xl()
	{
		$file="Master_barang.xls";
		header("Content-type: application/octet-stream");
		header("Content-Disposition: attachment; filename=$file");
		header("Pragma: no-cache");
		header("Expires: 0");	
		$data['all'] = $this->m_barang->m_data();	
		$this->load->view('data_barang_xl',$data);
	}


	public function return_barang()
	{
		$data['all'] = $this->m_barang->m_return_barang();	
		$data['all_barang'] = $this->m_barang->m_data();	
		$this->load->view('return_barang',$data);
	}

	public function cetak_return_by_id($id)
	{
		$q = $this->db->query("SELECT a.*,a.id AS id_ret ,b.*,c.*,d.nama_gudang
								FROM tbl_barang_return a
								LEFT JOIN tbl_barang b ON a.id_barang=b.id
								LEFT JOIN tbl_pelanggan c ON a.id_pelanggan=c.id_pelanggan
								LEFT JOIN tbl_gudang d ON a.id_gudang=d.id_gudang
								WHERE a.id='$id' 
								ORDER BY a.id DESC
					");

		$data['all'] = $q->result();

		//var_dump($staff_arr);
		$filename = "return_barang_".$this->router->fetch_class()."_".date('d_m_y_h_i_s');
		
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
			$html = $this->load->view('print_return_barang_by_id.php',$data,true);
			
			$this->load->library('pdf_setengah'); 
			$pdf = $this->pdf_setengah->load();
			//$this->load->library('pdf');
			//$pdf = $this->pdf->load();

			$pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date("YmdHis")."_".$this->session->userdata('id_admin')); // Add a footer for good measure <img class="emoji" draggable="false" alt="" src="https://s.w.org/images/core/emoji/72x72/1f609.png">
			$pdf->WriteHTML($html); // write the HTML into the PDF
			$pdf->Output($pdfFilePath, 'F'); // save to file because we can
		}
		 
		redirect(base_url()."downloads/$filename.pdf","refresh");
	}

	public function return_barang_ke_suplier($id)
	{		
		$this->db->query("UPDATE tbl_barang_return SET status='suplier' WHERE id='$id'");
		echo "UPDATE tbl_barang_return SET status='suplier' WHERE id='$id'";
	}


	public function return_barang_xl($kondisi=null)
	{
		$file="Laporan_barang_return.xls";
		
		
		header("Content-type: application/octet-stream");
		header("Content-Disposition: attachment; filename=$file");
		header("Pragma: no-cache");
		header("Expires: 0");	


		$data['all'] = $this->m_barang->m_return_barang($kondisi);
		$this->load->view('print_return_barang',$data);
	}


	public function print_return_barang($kondisi=null)
	{
		
		
		$data['all'] = $this->m_barang->m_return_barang($kondisi);

		//var_dump($staff_arr);
		$filename = "return_barang_".$this->router->fetch_class()."_".date('d_m_y_h_i_s');
		
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
			$html = $this->load->view('print_return_barang.php',$data,true);
			
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

	public function go_return_barang()
	{
		$data = $this->input->post();
		$nama_barang = $data['nama_barang'];
		$uang_total = hanya_nomor($data['uang_kembali']);

		unset($data['nama_barang']);
		unset($data['uang_kembali']);

		$data['uang_kembali'] = $uang_total;

		$this->db->set($data);
		$this->db->insert('tbl_barang_return');
		$id_ret = $this->db->insert_id();


		/*********** insert ke transaksi **************/	
		$ket = "Kpd: [id_pelanggan:".$data['id_pelanggan']."] nama barang: [".$nama_barang."] id_barang:[".$data['id_barang']."] Jumlah:[".($data['jumlah'])."]  -".$data['ket'];

		$ser_trx = array(
						"id_group"=>"6",							
						"keterangan"=>$ket,
						"jumlah"=>($uang_total),
						"id_referensi"=>$data['id_barang']
					);				
		/* untuk id_referensi = id_group/id_table*/				
		$this->db->set($ser_trx);
		$this->db->insert('tbl_transaksi');
		/*********** insert ke transaksi **************/

		/********** jika kondisi=baik masuk ke barang ***************/
		if($data['kondisi']=='baik')
		{
			
			$qty 		= $data['jumlah'];
			$id_gudang	= $data['id_gudang'];
			$id_barang 	= $data['id_barang'];

			$this->db->query("INSERT INTO tbl_barang_transaksi 
								SET 
								jenis='masuk', 
								jumlah='$qty',								
								id_barang='$id_barang',
								id_gudang='$id_gudang'
							");
		}
		/********** jika kondisi=baik masuk ke barang ***************/

		echo $id_ret;
	}


	public function log_pindah_gudang()
	{
		$data['all'] = $this->m_barang->m_log_pindah_gudang();
		$this->load->view('log_pindah_gudang',$data);

	}

	public function pindah_gudang()
	{
		$data = $this->input->post();

		$qty 		= $data['jumlah'];
		$id_gudang	= $data['id_gudang'];		
		$id_barang 	= $data['id_barang'];
		$catatan	= $data['catatan'];

		//tambah ke gudang baru
		$this->db->query("INSERT INTO tbl_barang_transaksi 
							SET 
							jenis='masuk', 
							jumlah='$qty',								
							id_barang='$id_barang',
							id_gudang='$id_gudang'
						");

		//kurangi dari gudang lama
		$id_gudang_lama	= $data['id_gudang_lama'];
		$this->db->query("INSERT INTO tbl_barang_transaksi 
							SET 
							jenis='keluar', 
							jumlah='$qty',								
							id_barang='$id_barang',
							id_gudang='$id_gudang_lama'
						");
		
		//catat log
		$id_admin = $this->session->userdata('id_admin');
		$this->db->query("INSERT INTO tbl_log_pemindahan_gudang 
							SET 
							id_gudang_lama='$id_gudang_lama', 
							id_gudang_baru='$id_gudang',								
							id_barang='$id_barang',
							jumlah='$qty',
							catatan='$catatan',
							id_admin='$id_admin'

						");
		
			
	}


	public function lap_penjualan()
	{
		$mulai = $this->input->get('mulai');
		$selesai = $this->input->get('selesai');

		$id_admin 	= $this->session->userdata('id_admin');
		$level 		= $this->session->userdata('level');

		if($level=='1')
		{
			$id_admin="";
		}

		$data['mulai'] = $mulai;
		$data['selesai'] = $selesai;

		$data['all'] = $this->m_barang->m_lap_penjualan($mulai,$selesai,$id_admin);	
		$this->load->view('lap_penjualan',$data);
	}

	public function lap_penjualan_excel()
	{
		$mulai = $this->input->get('mulai');
		$selesai = $this->input->get('selesai');

		$file = "laporan_penjualan-$mulai-$selesai.xls";
		header("Content-type: application/octet-stream");
		header("Content-Disposition: attachment; filename=$file");
		header("Pragma: no-cache");
		header("Expires: 0");	

		$id_admin 	= $this->session->userdata('id_admin');
		$level 		= $this->session->userdata('level');

		if($level=='1')
		{
			$id_admin="";
		}

		$data['mulai'] = $mulai;
		$data['selesai'] = $selesai;

		$data['all'] = $this->m_barang->m_lap_penjualan($mulai,$selesai,$id_admin);	
		$this->load->view('lap_penjualan_xl',$data);
	}

	



	public function lap_pending()
	{
		$id_admin 	= $this->session->userdata('id_admin');
		$level 		= $this->session->userdata('level');

		if($level=='1')
		{
			$id_admin="";
		}

		$data['all'] = $this->m_barang->m_lap_pending($id_admin);	
		$this->load->view('lap_pending',$data);
	}



	public function pesanan_member()
	{
		
		$data['all'] = $this->m_barang->m_pesanan_member("");	
		$this->load->view('data_pesanan_member',$data);
	}


	public function hapus_pending($grup_penjualan)
	{
		$this->m_barang->m_hapus_pending($grup_penjualan);
	}

	public function form_penjualan_pending($group_penjualan)
	{

		$data['all'] = $this->m_barang->m_data_gudang(1)->result();		
		$data['pelanggan'] = $this->m_pelanggan->m_data();	
		$data['eksepedisi'] = $this->m_ekspedisi->m_data();	
		$data['group_penjualan'] = $group_penjualan;
		$this->load->view('form_penjualan_barang',$data);

	}

	
	public function penjualan_by_group($group_penjualan)
	{
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: *");
		header('Content-Type: application/json');	
		echo json_encode($this->m_barang->m_detail_penjualan($group_penjualan));		
		
	}


	public function data_beli()
	{
		$data['all'] = $this->m_barang->m_data_beli();	
		$data['gudang'] = $this->m_gudang->m_data();	
		$this->load->view('data_barang_beli',$data);
	}

	public function notif()
	{	
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: *");
		header('Content-Type: application/json');	
		$data['barang_baru'] = $this->m_barang->m_hitung_notif_barang_baru();

		/******* stok gudang *****/
		$rem = array();		
		$semu_stok_gudang = 0;
		foreach ($this->m_gudang->m_data() as $key) {
			$yg_warning = $this->m_barang->m_notif_stok($key->id_gudang)->num_rows();
			$arr['id_gudang'] = $key->id_gudang;
			$arr['warning'] = $yg_warning;
			array_push($rem, $arr);
			$semu_stok_gudang+=$yg_warning;
		}
		
		$data['stok_gudang'] = $rem;
		//$data['semu_stok_gudang'] = $semu_stok_gudang;
		$data['semu_stok_gudang'] = $this->m_barang->m_notif_stok(1)->num_rows();
		

		$id_admin 	= $this->session->userdata('id_admin');
		$level 		= $this->session->userdata('level');

		if($level=='1')
		{
			$id_admin="";
		}
		$data['jum_pending'] = ($this->m_barang->notif_pending($id_admin));	
		/******* stok gudang *****/
		$data['jum_pesanan_member'] = count($this->m_barang->m_pesanan_member(""));
		$data['jum_pesanan_ku'] = count($this->m_barang->m_pesanan_member($this->session->userdata('id_admin')));
		echo json_encode($data);


	}



	public function stok_gudang($id_gudang)
	{
		$data['stok'] = $this->m_barang->m_data_gudang($id_gudang);	
		$data['gudang'] = $this->m_gudang->m_data();

		/****** array gudang yg kosong *****/
		$q = $this->m_barang->m_notif_stok();
		$warning=array();
		foreach ($q->result() as $key) {
			
			if($key->reminder > $key->qty)
			{
				array_push($warning, $key->id_gudang);
			}
		}
		$data['warning'] = array_unique($warning);	
		/****** array gudang yg kosong *****/

		$this->load->view('stok_gudang',$data);
	}



	public function stok_gudang_xl($id_gudang)
	{
		$file = "Stok_gudang.xls";
		header("Content-type: application/octet-stream");
		header("Content-Disposition: attachment; filename=$file");
		header("Pragma: no-cache");
		header("Expires: 0");	
		$data['stok'] = $this->m_barang->m_data_gudang($id_gudang);	
		$data['gudang'] = $this->m_gudang->m_data();

		/****** array gudang yg kosong *****/
		$q = $this->m_barang->m_notif_stok();
		$warning=array();
		foreach ($q->result() as $key) {
			
			if($key->reminder > $key->qty)
			{
				array_push($warning, $key->id_gudang);
			}
		}
		$data['warning'] = array_unique($warning);	
		/****** array gudang yg kosong *****/

		$this->load->view('stok_gudang_xl',$data);
	}

	public function go_beli()
	{
		$qty = $this->input->post('qty');		
		
		$harga_beli = $this->input->post('harga_beli');
		$harga_retail = $this->input->post('harga_retail');
		$harga_lusin = $this->input->post('harga_lusin');
		$harga_koli = $this->input->post('harga_koli');

		$id_barang = $this->input->post('id_barang');
		$id_gudang = $this->input->post('id_gudang');
		


		if($harga_beli>0 && $harga_beli!='')
		{
		$this->db->query("INSERT INTO tbl_barang_transaksi 
								SET 
								jenis='masuk', 
								jumlah='$qty',
								harga_beli='$harga_beli',
								id_barang='$id_barang',
								id_gudang='$id_gudang'
							");			
		
		$this->db->query("UPDATE tbl_barang 
							SET 
							harga_pokok='$harga_beli', 
							harga_retail='$harga_retail', 
							harga_lusin='$harga_lusin', 
							harga_koli='$harga_koli'
							WHERE 
							id='$id_barang'
						");

		$ket = "Barang masuk id[$id_barang] qty=[$qty], harga[$harga_beli]";

		/*********** insert ke transaksi **************/	
		$ser_trx = array(
						"id_group"=>"1",							
						"keterangan"=>$ket,
						"jumlah"=>($harga_beli*$qty),
						"id_barang"=>$id_barang
					);				
		/* untuk id_referensi = id_group/id_table*/
		$qq = $this->db->query("SELECT id_transaksi FROM `tbl_barang_transaksi` ORDER BY id_transaksi DESC LIMIT 1");
		$qqq = $qq->result();
		$ser_trx['id_referensi'] = $qqq[0]->id_transaksi;	
		$this->db->set($ser_trx);
		$this->db->insert('tbl_transaksi');
		/*********** insert ke transaksi **************/

		/*hapus dari tbl_sementara*/
		$id_barang_masuk = $this->input->post('id_barang_masuk');
		$this->db->query("UPDATE tbl_barang_masuk_tanpa_harga SET status='sudah' WHERE id_barang_masuk='$id_barang_masuk'");
		/*hapus dari tbl_sementara*/

		
		}
		
	}

	public function data_json()
	{
		header('Content-Type: application/json');
		$data['all'] = $this->m_barang->m_data();	
		echo json_encode($data['all']);
	}


	public function by_id($id)
	{
		header('Content-Type: application/json');
		$data['all'] = $this->m_barang->m_by_id($id);
		echo json_encode($data['all']);
	}


	public function stok_gudang_by_id()
	{
		$id_barang = $this->input->get('id_barang');
		$id_gudang = $this->input->get('id_gudang');
		header('Content-Type: application/json');
		$data['all'] = $this->m_barang->m_stok_gudang_by_id($id_barang,$id_gudang)->result();
		echo json_encode($data['all']);

	}

	public function simpan_form()
	{
		$id = $this->input->post('id');
		
		$serialize = $this->input->post();

		
		$serialize['harga_retail'] = hanya_nomor($serialize['harga_retail']);
		$serialize['harga_lusin'] = hanya_nomor($serialize['harga_lusin']);
		$serialize['harga_koli'] = hanya_nomor($serialize['harga_koli']);
		$serialize['jum_per_koli'] = hanya_nomor($serialize['jum_per_koli']);
		$serialize['harga_pokok'] = hanya_nomor($serialize['harga_pokok']);

		if($id=='')
		{
			$serialize['gambar'] = upload_file('gambar');
			$this->m_barang->tambah_data($serialize);
			die('1');
		}else{
			if(upload_file('gambar')!=""){
				$serialize['gambar'] = upload_file('gambar');	
			}
			$this->m_barang->update_data($serialize,$id);
			die('1');			

		}
		

	}

	public function hapus($id)
	{
		$this->m_barang->m_hapus_data($id);
	}


}
