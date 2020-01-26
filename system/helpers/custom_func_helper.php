<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function umur($tanggal)
{
	$today = new DateTime();
	$birthdate = new DateTime($tanggal);
	$interval = $today->diff($birthdate);
	return $interval->format('%y years');
}

function upload_file($name_field){
    $sourcePath = $_FILES[$name_field]['tmp_name'];
    $path = $_FILES[$name_field]['name'];
    $fileType = $_FILES[$name_field]["type"];
    $ext = pathinfo($path, PATHINFO_EXTENSION);
    $fName = $name_field."_".time();
    $fileName = $fName.'.'.$ext;
    $targetPath = "uploads/".$fileName;
    move_uploaded_file($sourcePath,$targetPath);
    if($sourcePath!=""){
        return $fileName;
    }else{
        return "";
    }
}

function level($int)
{
	$a = array(
			'1' => "Admin", 
			'2' => "Keuangan", 
			'3' => "Kasir", 
			);
	return $a[$int];
}

if ( ! function_exists('hanya_nomor'))
{
	function hanya_nomor($string) 
	{
		if (preg_match('/[0-9]+/', $string))
		{
			return preg_replace('/\D/', '', $string);
		}else{
			return (int)0;
		}
		
	}
}

function rupiah($nilai, $pecahan = 0) 
{
    return number_format($nilai, $pecahan, ',', '.');
}

function buang_spasi($string)
{
	$string = preg_replace('/\s+/', '', $string);
	return $string;
}


function tglindo($tanggal)
{
$taketgl = substr($tanggal, 0,10);
$tahun = substr($taketgl, 0,4);
$bulan = substr($taketgl, 5,2);
$tanggal = substr($taketgl, 8,2);

$tgl = $tanggal."-".$bulan."-".$tahun;

return $tgl;
}

function tanggalindo($tanggal)
{
$taketgl = substr($tanggal, 0,10);
$tahun = substr($taketgl, 0,4);
$bulan = substr($taketgl, 5,2);
$tanggal = substr($taketgl, 8,2);

if($bulan=="01") $bulan = "Januari";
if($bulan=="02") $bulan = "Februari";
if($bulan=="03") $bulan = "Maret";
if($bulan=="04") $bulan = "April";
if($bulan=="05") $bulan = "Mei";
if($bulan=="06") $bulan = "Juni";
if($bulan=="07") $bulan = "Juli";
if($bulan=="08") $bulan = "Agustus";
if($bulan=="09") $bulan = "September";
if($bulan=="10") $bulan = "Oktober";
if($bulan=="11") $bulan = "Novembe";
if($bulan=="12") $bulan = "Desember";

$tgl = $tanggal." ".$bulan." ".$tahun;

return $tgl;
}


function bulantahunromawi($tanggal)
{
$taketgl = substr($tanggal, 0,10);
$tahun = substr($taketgl, 0,4);
$bulan = substr($taketgl, 5,2);
$tanggal = substr($taketgl, 8,2);

if($bulan=="01") $bulan = "I";
if($bulan=="02") $bulan = "II";
if($bulan=="03") $bulan = "III";
if($bulan=="04") $bulan = "IV";
if($bulan=="05") $bulan = "V";
if($bulan=="06") $bulan = "VI";
if($bulan=="07") $bulan = "VII";
if($bulan=="08") $bulan = "VIII";
if($bulan=="09") $bulan = "IX";
if($bulan=="10") $bulan = "X";
if($bulan=="11") $bulan = "XI";
if($bulan=="12") $bulan = "XII";

$tgl = $bulan."/".$tahun;

return $tgl;
}



function bulantahunindo($bulan)
{
	
$taketgl = substr($bulan, 0,10);
$tahun = substr($taketgl, 0,4);
$bulan = substr($taketgl, 5,2);
$tanggal = substr($taketgl, 8,2);
	
if($bulan=="01") $bulan = "Jan";
if($bulan=="02") $bulan = "Feb";
if($bulan=="03") $bulan = "Mar";
if($bulan=="04") $bulan = "Apr";
if($bulan=="05") $bulan = "Mei";
if($bulan=="06") $bulan = "Jun";
if($bulan=="07") $bulan = "Jul";
if($bulan=="08") $bulan = "Agu";
if($bulan=="09") $bulan = "Sep";
if($bulan=="10") $bulan = "Okt";
if($bulan=="11") $bulan = "Nov";
if($bulan=="12") $bulan = "Des";
return $bulan." ".$tahun;
}



function tahunindo($bulan)
{
	
$taketgl = substr($bulan, 0,10);
$tahun = substr($taketgl, 0,4);
$bulan = substr($taketgl, 5,2);
$tanggal = substr($taketgl, 8,2);
	
if($bulan=="01") $bulan = "Jan";
if($bulan=="02") $bulan = "Feb";
if($bulan=="03") $bulan = "Mar";
if($bulan=="04") $bulan = "Apr";
if($bulan=="05") $bulan = "Mei";
if($bulan=="06") $bulan = "Jun";
if($bulan=="07") $bulan = "Jul";
if($bulan=="08") $bulan = "Agu";
if($bulan=="09") $bulan = "Sep";
if($bulan=="10") $bulan = "Okt";
if($bulan=="11") $bulan = "Nov";
if($bulan=="12") $bulan = "Des";
return $tahun;
}



function bulanindo($bulan)
{	
if($bulan=="01") $bulan = "Januari";
if($bulan=="02") $bulan = "Februari";
if($bulan=="03") $bulan = "Maret";
if($bulan=="04") $bulan = "April";
if($bulan=="05") $bulan = "Mei";
if($bulan=="06") $bulan = "Juni";
if($bulan=="07") $bulan = "Juli";
if($bulan=="08") $bulan = "Agustus";
if($bulan=="09") $bulan = "September";
if($bulan=="10") $bulan = "Oktober";
if($bulan=="11") $bulan = "November";
if($bulan=="12") $bulan = "Desember";
return $bulan;
}

function curl_file_exist($url){
    $ch = curl_init($url);    
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if($code == 200){
       $status = true;
    }else{
      $status = false;
    }
    curl_close($ch);
   return $status;
}


function buang_single_quote($string)
{
	return (str_replace("'","`",$string));
}



function ambil_thumbs($url)
{		
	if(strpos($url, 'user_image') !== false) {
	 	$url_images = explode("user_image",$url);
		$get_images = str_replace("/images/","user_image/_thumbs/Images/",$url_images[1]);	
			
		return $url_images[0].$get_images;
	} else {
		return $url;
	}

}



function buat_link($text)
{ 
  $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
  $text = trim($text, '-');
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
  $text = strtolower($text);
  $text = preg_replace('~[^-\w]+~', '', $text);
  if (empty($text))
  {
    return 'n-a';
  }
  return $text;
}

function randomnya($length = 10) 
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) 
	{
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}


function dapat_gambar($semua)
{				
		$frst_image = preg_match_all( '|<img.*?src=[\'"](.*?)[\'"].*?>|i', $semua, $matches );
		
		if(@$matches[ 1 ][ 0 ]){					
			return @$matches[ 1 ][ 0 ];
			
		}else{
			return "https://humbanghasundutankab.go.id/user_image/images/logo/logo_hum.png";
		}
		
	
}


function buat_desc($isi,$panjang=300)
{
	$out = substr(strip_tags($isi),0,$panjang).'...';
	return preg_replace('!\s+!', ' ', $out);
}
