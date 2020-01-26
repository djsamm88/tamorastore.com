<?php
require 'PHPMailerAutoload.php';



if(isset($_GET['email']) && isset($_GET['text']) && isset($_GET['judul']))
{

$emailnya 	= urldecode($_GET['email']);
$text 		= urldecode($_GET['text']);
$judul 		= urldecode($_GET['judul']);

	$mail = new PHPMailer;

	//$mail->SMTPDebug = 3;                               // Enable verbose debug output

	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'medantechno.com';  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'lampid@medantechno.com';                 // SMTP username
	$mail->Password = 'AVENGED7x';                           // SMTP password
	$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 587;                                    // TCP port to connect to

	$mail->setFrom('lampid@medantechno.com', 'Lampid System ');
	//$mail->addAddress($emailnya, 'Limb');     // Add a recipient
	$mail->addAddress($emailnya);     // Add a recipient
	//$mail->addAddress('ellen@example.com');               // Name is optional
	//$mail->addReplyTo('info@example.com', 'Information');
	//$mail->addCC('cc@example.com');
	//$mail->addBCC('bcc@example.com');

	//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
	//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
	$mail->isHTML(true);                                  // Set email format to HTML

	$mail->Subject = 'Lampid -'.$judul;
	$mail->Body    = $text;
	$mail->AltBody = $text;

	if(!$mail->send()) {
		echo 'Message could not be sent.';
		echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
		echo 'Message has been sent';
	}

}