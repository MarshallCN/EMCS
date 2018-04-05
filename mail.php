<?php
$email = isset($_GET['email'])?$_GET['email']:'';
$tit = isset($_GET['tit'])?$_GET['tit']:'';
$msg = isset($_GET['msg'])?$_GET['msg']:'';
$pwd = isset($_GET['pwd'])?md5($_GET['pwd']):'';
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