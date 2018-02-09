<?php
	require "inc/db.php";
	/*Check username uniqueness*/	
	if(isset($_POST['usercheck'])){
		$usercheck = inputCheck(strtolower(preg_replace("/\s/","",$_POST['usercheck'])));
		if(empty($usercheck)){
			$isNameUsed= 'empty';
		}else{
			$res = $mysql->query("SELECT * FROM user WHERE username = '$usercheck'");
			$isNameUsed = mysqli_num_rows($res)? 'used':'ok';
		}
		$resp = ['used'=>$isNameUsed];
		echo json_encode($resp);
	}else if(isset($_POST['delfoodid'])){
		//$sql= "DELETE FROM";
		//$mysql->query($sql);
		$resp = ['delid'=>$_POST['delfoodid']];
		echo json_encode($resp);
	}
?>
