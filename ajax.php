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
	}
	/*Delete food*/	
	if(isset($_POST['delfoodid'])){
		$delid = inputCheck($_POST['delfoodid']);
		$sql= "DELETE FROM food WHERE id = $delid";
		$mysql->query($sql);
		$resp = ['delid'=>$_POST['delfoodid']];
		echo json_encode($resp);
	}
	/*Edit food*/	
	if(isset($_POST['editfoodid'])){
		$editid = inputCheck($_POST['editfoodid']);
		$sql= "SELECT * FROM food WHERE id = $editid";
		$res = $mysql->query($sql);
		$foodinfo = $mysql->fetch($res);
		echo json_encode($foodinfo);
	}
	/*Upload picture*/
	if(isset($_FILES['img'])&&isset($_POST['path'])){
		$filename = $_POST['uid'].'_file'.date('Y_m_d_h_i_s',time()).'.jpg';
		$path = $_POST['path'];
		if(is_uploaded_file($_FILES['img']['tmp_name'])){
			if(move_uploaded_file($_FILES['img']['tmp_name'], "./static/img/$path/$filename")){
				$status = 0;
			}else{
				$status = 1;
			}
		}else{
			$status = 2;
		}
		echo json_encode(['status'=>$status,'filename'=>$filename]);
	}
	/*Buy food in shopping list*/
	if(isset($_POST['splistid'])){
		$spitemid = inputCheck($_POST['splistid']);
		$newstatus = $_POST['ischeck']==1?0:1;
		$sql = "UPDATE shopping SET isbuy = $newstatus WHERE id = $spitemid";
		$mysql->query($sql);
		echo json_encode(['newstatus'=>$newstatus]);
	}
	/*Edit shopping list item*/
	if(isset($_POST['spitemid'])){
		$spitemid = inputCheck($_POST['spitemid']);
		$sql = "SELECT * FROM shopping WHERE id = $spitemid";
		$res = $mysql->fetch($mysql->query($sql));
		echo json_encode($res);	
	}
	/*Remove Shopping list item*/
	if(isset($_POST['rmitemid'])){
		$rmitemid = inputCheck($_POST['rmitemid']);
		$sql = "DELETE FROM shopping WHERE id = $rmitemid";
		$mysql->query($sql);
		echo json_encode(['suc'=>1]);
	}
?>
