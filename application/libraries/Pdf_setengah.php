<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Pdf_setengah {
    
    function __construct()
    {
        $CI = & get_instance();
        log_message('Debug', 'mPDF class is loaded.');
    }
 
    function load($param=NULL)
    {
        include_once APPPATH.'/third_party/mpdf/mpdf.php';
         
        if ($params == NULL)
        {
            $param = '"en-GB-x","A4","","",10,10,10,10,6,3';         
        }
         
        //	return new mPDF($param);
		return new mPDF("en-GB-x",[130,130],0,0,3,3,5,0);

	}
	
	
	/*
	--------keterangan------------
	return new mPDF("en-GB-x","Legal",0,0,30,10,6,3);
	return new mPDF("en-GB-x","Legal-L",Left,Right,Top,bottom,margin_header,margin_footer);
	
	jika Legal-L = legal Landscape
	jika Legal	 = legal Potret
	
	*/
	
}