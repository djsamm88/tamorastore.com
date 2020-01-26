<?php
require 'PHPMailerAutoload.php';



if(isset($_POST['dari']) && isset($_POST['kepada']) && isset($_POST['text']))
{

$dari 		= ($_POST['dari']);
$kepada 	= ($_POST['kepada']);
$text 		= ($_POST['text']);

	$mail = new PHPMailer;

	//$mail->SMTPDebug = 3;                               // Enable verbose debug output

	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->SMTPDebug = 0;
	$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
	//$mail->Host = gethostbyname('smtp.gmail.com');
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'humbahaskab@gmail.com';                 // SMTP username
	$mail->Password = 'AVENGED7X';                           // SMTP password
	//$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
	$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 587;                                    // TCP port to connect to
	//$mail->Port = 465;                                    // TCP port to connect to
	

	$mail->setFrom($dari, 'Balasan Kontak '.$_SERVER['SERVER_NAME']);
	//$mail->addAddress($emailnya, 'Limb');     // Add a recipient
	$mail->addAddress($kepada);     // Add a recipient
	//$mail->addAddress('ellen@example.com');               // Name is optional
	//$mail->addReplyTo('info@example.com', 'Information');
	//$mail->addCC('cc@example.com');
	//$mail->addBCC('bcc@example.com');

	//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
	//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
	$mail->isHTML(true);                                  // Set email format to HTML

	$mail->Subject = 'Balasan Kontak '.$_SERVER['SERVER_NAME'];
	$mail->Body    = $text;
	$mail->AltBody = $text;

	if(!$mail->send()) {
		echo 'Message could not be sent.';
		echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
		echo 'Message has been sent';
	}

}else{
	var_dump($_POST);
}