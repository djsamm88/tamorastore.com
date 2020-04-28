<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

	class M_chat extends CI_Model {
		
		function __construct() {
			parent::__construct();
		
			$this->load->helper('custom_func');
		}



	public function list_chat_kasir($id)
	{
		
		$q = $this->db->query("
								
								SELECT * FROM (
									SELECT MAX(id) AS id,
									CASE 
									WHEN kpd_id='$id' THEN dari_nama 
									WHEN dari_id='$id' THEN kpd_nama 
									END AS nama,
									CASE 
									WHEN kpd_id='$id' THEN dari_id 
									WHEN dari_id='$id' THEN kpd_id
									END AS id_fix

								FROM (
									SELECT a.* FROM tbl_chat a 
									INNER JOIN 
									(
									    SELECT MAX(id) AS id,kpd_id,dari_id  
									    FROM tbl_chat WHERE dari_id='$id' OR kpd_id='$id' 
									    GROUP BY dari_id,kpd_id
									    ORDER BY MAX(id) 
									)b 
									ON a.id=b.id
									ORDER BY a.id DESC
								)a 
								GROUP BY nama 
								ORDER BY id DESC
								)a INNER JOIN tbl_chat b ON a.id=b.id 
								ORDER BY a.id DESC

						");
		return $q;
	}

}