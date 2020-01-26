<?php
require 'PHPMailerAutoload.php';



if(isset($_GET['email']) && isset($_GET['text']))
{

$emailnya 	= urldecode($_GET['email']);
$text 		= urldecode($_GET['text']);

	$mail = new PHPMailer;

	//$mail->SMTPDebug = 3;                               // Enable verbose debug output

	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->SMTPDebug = 2;
	$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
	//$mail->Host = gethostbyname('smtp.gmail.com');
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'djsamm88.web.id@gmail.com';                 // SMTP username
	$mail->Password = 'WENDLIMB';                           // SMTP password
	//$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
	$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 587;                                    // TCP port to connect to
	//$mail->Port = 465;                                    // TCP port to connect to
	

	$mail->setFrom('djsamm88.web.id@gmail.com', 'System E-Agenda');
	//$mail->addAddress($emailnya, 'Limb');     // Add a recipient
	$mail->addAddress($emailnya);     // Add a recipient
	//$mail->addAddress('ellen@example.com');               // Name is optional
	//$mail->addReplyTo('info@example.com', 'Information');
	//$mail->addCC('cc@example.com');
	//$mail->addBCC('bcc@example.com');

	//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
	//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
	$mail->isHTML(true);                                  // Set email format to HTML

	$mail->Subject = 'System e-Agenda';
	$mail->Body    = $text;
	$mail->AltBody = $text;

	if(!$mail->send()) {
		echo 'Message could not be sent.';
		echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
		echo 'Message has been sent';
	}

}