<?php
include "inc/db.php";
if(isset($_POST['userid'])||isset($_GET['uid'])){
	$user_id=isset($_GET['uid'])?inputCheck($_GET['uid']):inputCheck($_POST['userid']);
	$url = "https://android.googleapis.com/gcm/send";
	$ch = curl_init($url);
	$headers = array();
	$headers[] = "Authorization: key=xxxxxxxxxxxxx";
	$headers[] = "Content-Type: application/json";
	$tokens = array();
	$sql_token = "SELECT * FROM user_token WHERE user_id = '$user_id'";
	$res = $mysql->query($sql_token);
	$tokennum = mysqli_num_rows($res);
	if($tokennum>0){
		while($row = $mysql->fetch($res)){
			array_push($tokens,$row['token']);
		}
		if($tokennum==1){
			$token = $tokens[0];
		}else{
			$token = implode('","',$tokens);
			$esctoken = implode('\",\"',$tokens);
		}
		/* $data_string = array(
			'registration_ids' 	=> array($token)
		); */
		$data_string = '{"registration_ids":[
				"'.$token.'"
			]}'; 
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
		$result = curl_exec($ch);
		curl_close($ch);
		echo 'curl --header "Authorization: key=xxxxxxxxxx" 
	--header Content-Type:"application/json" https://android.googleapis.com/gcm/send
    -d "{\"registration_ids\":[\"'.$esctoken.'\"]}"';	
	}
}