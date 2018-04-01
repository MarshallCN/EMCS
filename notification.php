<?php
include "inc/db.php";
if(isset($_GET['userid'])){
	$url = "https://android.googleapis.com/gcm/send";
	$ch = curl_init($url);
	$headers = array();
	$headers[] = "Authorization: key=AIzaSyCfUTbrS9FIQUKvqecUXDytzriLIzve5f8";
	$headers[] = "Content-Type: application/json";
	$user_id = inputCheck($_GET['userid']);
	$tokens = array();
	//$token = "dcVvsmLYDAE:APA91bEav7dIcnoIa58DXkG-LQ38GJmLLdmaQI_MClsLhFrVQryvOIvZs-rjoAbjFCuPTCKO4Y0Tz9_HSse2IfhsfsyEcXjGtps_6cQLuKO7-AN0yRfR_ppyJ5LG2AGnO6vTdit3biKJ";
	$sql_token = "SELECT * FROM user_token WHERE user_id = '$user_id'";
	$res = $mysql->query($sql_token);
	if(mysqli_num_rows($res)>0){
		while($row = $mysql->fetch($res)){
			array_push($tokens,$row['token']);
		}
		$token = implode('\",\"',$tokens);
		$data_string = '{"registration_ids":[
				"'.$token.'"
			]}';
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
		//curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
		//curl_setopt($ch, CURLOPT_TIMEOUT_MS, 2000);
		$result = curl_exec($ch);
		curl_close($ch);
		echo 'curl --header "Authorization: key=AIzaSyCfUTbrS9FIQUKvqecUXDytzriLIzve5f8" 
	--header Content-Type:"application/json" https://android.googleapis.com/gcm/send
    -d "{\"registration_ids\":[\"'.$token.'\"]}"';;
	}
}
