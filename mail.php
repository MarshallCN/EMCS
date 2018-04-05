<?php
$email = isset($_POST['email'])?$_POST['email']:'';
$tit = isset($_POST['tit'])?$_POST['tit']:'';
$msg = isset($_POST['msg'])?$_POST['msg']:'';
$pwd = isset($_POST['pwd'])?md5($_POST['pwd']):'';
$pwdhash = "ae23ccc3f30ee9bd82206aa1ba78a2f7";
if($pwd==$pwdhash){
	echo "PWD correct";
	if(!empty($email)&&!empty($tit)&&!empty($msg)){
		$to = "$email";
		$subject = $tit;
		$message = $msg;
		$from = '"EMCS" <l800730f@student.staffs.ac.uk>';
		$headers = "From: $from";
		mail($to,$subject,$message,$headers);
		echo "Email Send";
	}
}

?>