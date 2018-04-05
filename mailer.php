<?php
use PHPMailer\PHPMailer\PHPMailer;
require '../vendor/autoload.php';
if(isset($_POST['email'])&&isset($_POST['subject'])&&isset($_POST['body'])&&isset($_POST['altbody'])){
	if(!empty($_POST['email'])&&!empty($_POST['subject'])&&!empty($_POST['body'])&&!empty($_POST['altbody'])){
		$email = $_POST['email'];
		$subject = $_POST['subject'];
		$body = $_POST['body'];
		$altbody = $_POST['altbody'];
		$mail = new PHPMailer;
		$mail->isSMTP();
		$mail->SMTPDebug = 0;
		$mail->Host = 'mx1.hostinger.com';
		$mail->Port = 587;
		$mail->SMTPAuth = true;
		$mail->Username = 'emcs@marshal1.tech';
		$mail->Password = '960618';
		$mail->setFrom('emcs@marshal1.tech', 'EMCS');
		$mail->addReplyTo('emcs@marshal1.tech', 'EMCS');
		$mail->addAddress($email);
		$mail->Subject = $subject;
		$mail->Body = $body;
		$mail->AltBody = $altbody;
		//$mail->addAttachment('test.txt');
		if (!$mail->send()) {
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
			echo 'Message sent!';
		}
	}else{
		echo "empty input";
	}
}else{
	echo "NO post data";
}
?>