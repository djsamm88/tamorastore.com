<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

	class M_ambil extends CI_Model {
		
		function __construct() {
			parent::__construct();
		
			$this->load->helper('custom_func');
		}




	public function ambil_jamaah($id_jamaah)
	{
		$q = $this->db->query("SELECT * FROM `tbl_jamaah` WHERE id_jamaah='$id_jamaah'");
		$x = $q->result();
		return $x[0];		
	}

	public function ambil_barang($id)
	{
		$q = $this->db->query("SELECT * FROM `tbl_barang` WHERE id='$id'");
		$x = $q->result();
		return $x[0];		
	}

	public function ambil_leader($id_leader)
	{
		$q = $this->db->query("SELECT * FROM `tbl_leader` WHERE id_leader='$id_leader'");
		$x = $q->result();
		return $x[0];		
	}

	

}