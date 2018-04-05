<?php
	session_start();
	require "inc/db.php";
	require_once("atrigger/ATrigger.php");
	ATrigger::init("4989200868836991246","f5lI15uo41pYL7aY5QNkYq7h5bC7Y6");
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
	/*Check email uniqueness*/	
	if(isset($_POST['emailcheck'])){
		$emailcheck = inputCheck(strtolower(preg_replace("/\s/","",$_POST['emailcheck'])));
		if(empty($emailcheck)){
			$isEmailUsed= 'empty';
		}else{
			$res = $mysql->query("SELECT * FROM user WHERE email = '$emailcheck'");
			$isEmailUsed = mysqli_num_rows($res)? 'used':'ok';
		}
		$resp = ['used'=>$isEmailUsed];
		echo json_encode($resp);
	}
	/*Delete food*/	
	elseif(isset($_POST['delfoodid'])){
		$delid = inputCheck($_POST['delfoodid']);
		$sql= "DELETE FROM food WHERE id = $delid";
		$mysql->query($sql);
		$resp = ['delid'=>$_POST['delfoodid']];
		echo json_encode($resp);
	}
	/* Edit Food */
	elseif(isset($_POST['fname'])){
			$foodname = inputCheck($_POST['fname']);
			$foodcate = inputCheck($_POST['fcate']);
			$exp = inputCheck($_POST['exp']);
			$exptype = inputCheck($_POST['exptype']);
			$vol = inputCheck($_POST['vol']);
			$place = inputCheck($_POST['place']);
			$expopen = inputCheck($_POST['expopen']);
			$expopenunit = inputCheck($_POST['expopenunit']);
			$imgname = inputCheck($_POST['imgname']);
			$opendate = $_POST['status']==1 ? 'NOW()':'NULL';
			$res=3;
			switch($expopenunit){
				case "Days": $unit = 1;break;
				case "Weeks": $unit = 7;break;
				case "Months": $unit =  30;break;
			}
			$opendays = $unit * $expopen;
			if(isset($_POST['editfoodid'])){
				$editid = inputCheck($_POST['editfoodid']);
				$sql_editfood = "UPDATE food SET name='$foodname',allfood_id='$foodcate',exp_type='$exptype',exp='$exp',vol='$vol',open_date=$opendate,openday='$opendays',place='$place',picpath='$imgname' WHERE id = $editid";
				$mysql->query($sql_editfood);
			}
			/*Atrigger*/
			echo json_encode(['res'=>1]);
	}
	/*Get all food data */
	elseif(isset($_POST['foods'])){
		$place = inputCheck($_POST['place']);
		if($_POST['foods']=='all'){
			$sql= "SELECT f.*,c.category_name as cate,TIMESTAMPDIFF(DAY,NOW(),f.exp) AS days FROM food AS f INNER JOIN allfood AS a ON f.allfood_id = a.id INNER JOIN category AS c ON c.id=a.category_id WHERE userid = ".$_SESSION['userid']." AND $place ORDER BY exp";
			$res = $mysql->query($sql);
			$foodinfo = array();
			while($row = $mysql->fetch($res)){
				array_push($foodinfo,json_encode($row));
			}
			echo json_encode($foodinfo);
		}
	}
	/*Get all food data for Editing food*/	
	elseif(isset($_POST['editfoodid'])){
		$editid = inputCheck($_POST['editfoodid']);
		$sql= "SELECT * FROM food WHERE id = $editid";
		$res = $mysql->query($sql);
		$foodinfo = $mysql->fetch($res);
		echo json_encode($foodinfo);
	}
	/*Upload picture*/
	elseif(isset($_FILES['img'])&&isset($_POST['path'])){
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
	elseif(isset($_POST['splistid'])){
		$spitemid = inputCheck($_POST['splistid']);
		$newstatus = $_POST['ischeck']==1?0:1;
		$sql = "UPDATE shopping SET isbuy = $newstatus WHERE id = $spitemid";
		$mysql->query($sql);
		echo json_encode(['newstatus'=>$newstatus]);
	}
	/*Edit shopping list item*/
	elseif(isset($_POST['spitemid'])){
		$spitemid = inputCheck($_POST['spitemid']);
		$sql = "SELECT * FROM shopping WHERE id = $spitemid";
		$res = $mysql->fetch($mysql->query($sql));
		echo json_encode($res);	
	}
	/*Remove Shopping list item*/
	elseif(isset($_POST['rmitemid'])){
		$rmitemid = inputCheck($_POST['rmitemid']);
		$sql = "DELETE FROM shopping WHERE id = $rmitemid";
		$mysql->query($sql);
		echo json_encode(['suc'=>1]);
	}
	/*User preferences - noti switch*/
	elseif(isset($_POST['switchbtn'])){
		$type = $_POST['type']=='msgemail'?'msg_email':'msg_chrome';
		$method = $_POST['type']=='msgemail'?1:0;
		$status = $_POST['switchbtn']==100?1:0;
		$sql_switch = "UPDATE user set $type='$status' WHERE id = ".$_SESSION['userid'];
		$sql_rules = "UPDATE notiplan set available='$status' WHERE method = $method AND user_id = ".$_SESSION['userid'];
		$mysql->query($sql_switch);
		$mysql->query($sql_rules);
		/*ATrigger*/
		echo json_encode(['res'=>1]);
	}
	/*Get all noti rules table*/
	elseif(isset($_POST['notiplan'])){
		$sql_notiplan = "SELECT * FROM notiplan WHERE user_id = ".$_SESSION['userid']." ORDER BY warnbefore";
		$res = $mysql->query($sql_notiplan);
		$notiplan = array();
		while($row = $mysql->fetch($res)){
			array_push($notiplan,json_encode($row));
		}
		echo json_encode($notiplan);
	}
	/*Edit Noti rules availablity*/
	elseif(isset($_POST['notiplanid'])){
		$notiplanid = inputCheck($_POST['notiplanid']);
		$newstatus = $_POST['ischeck']==1?0:1;
		$sql = "UPDATE notiplan SET available = $newstatus WHERE id = $notiplanid";
		$mysql->query($sql);
		echo json_encode(['newstatus'=>$newstatus]);
	}
	/*Remove noti rules*/
	elseif(isset($_POST['rmnotiid'])){
		$rmnotiid = $_POST['rmnotiid'];
		$sql_rmnotiid = "DELETE FROM notiplan WHERE id = $rmnotiid";
		$mysql->query($sql_rmnotiid);
		echo json_encode(['res'=>$rmnotiid]);
	}
	//Push messege setting
	elseif(isset($_POST['ispush'])){
		$res = 'No update noti';
		if($_POST['ispush']=='add'){
			$subId = isset($_POST['token'])?$_POST['token']:'';
			if(!empty($subId)){
				$current = $mysql->oneQuery("SELECT COUNT(*) FROM user_token WHERE token = '$subId' AND user_id = ".$_SESSION['userid']);
			}
			if($current == 0){
				$browser = md5($_SERVER['HTTP_USER_AGENT']);
				$sql_find = "SELECT count(*) FROM user_token WHERE browser = '$browser' AND user_id = ".$_SESSION['userid'];
				$num = $mysql->oneQuery($sql_find);
				if($num>0){
					$sql_del = "DELETE FROM user_token WHERE browser = '$browser' AND user_id = ".$_SESSION['userid'];
					$mysql->query($sql_del);
				}
					$sql_add = "INSERT user_token VALUES ('','".$_SESSION['userid']."','$subId','$browser')";
					$mysql->query($sql_add);
					$res = 'add new noti';
			}
		}else{
			$sql_del = "DELETE FROM user_token WHERE user_id = ".$_SESSION['userid'];
			$mysql->query($sql_del);
			$res = 'Remove all chrome noti';
		}
		echo json_encode(['res'=>$res]);
		
	}

	
?>
