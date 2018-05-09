<?php
	session_start();
	require "inc/db.php";
	require_once("atrigger/ATrigger.php");
	ATrigger::init("4989200868836991246","f5lI15uo41pYL7aY5QNkYq7h5bC7Y6");
	function curlGet($url,$get){
		$url = $url.'?'.$get;
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$res=curl_exec($ch);
		curl_close($ch);
		echo $res;
	}				
	/*Use get md5 value*/
	if(isset($_POST['getmd5'])){
		$data = MD5($_POST['getmd5']);
		echo $data;
	}
	/*Check username uniqueness*/	
	if(isset($_POST['usercheck'])){
		$usercheck = inputCheck(strtolower(preg_replace("/\s/","",$_POST['usercheck'])));
		if(empty($usercheck)){
			$isNameUsed= 'empty';
		}else{
			$res = $mysql->query("SELECT * FROM user WHERE username = '$usercheck'");
			$isNameUsed = mysqli_num_rows($res)>0? 'used':'ok';
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
			$isEmailUsed = mysqli_num_rows($res)>0? 'used':'ok';
		}
		$resp = ['used'=>$isEmailUsed];
		echo json_encode($resp);
	/*Search food category while input*/	
	}elseif(isset($_POST['searchfood'])){
		$searchfood = $_POST['searchfood'];
		if(!empty($searchfood)){
			$res = $mysql->query("SELECT a.id,c.category_name,name,html_id from allfood AS a INNER JOIN category AS c ON a.category_id=c.id WHERE name like '%".$searchfood."%' GROUP BY name ORDER BY name");
			$foodary = array();
			while($row = $mysql->fetch($res)){
				array_push($foodary,$row);
			}
			echo json_encode($foodary);
		}
	}
	/*Get food exp table*/
	elseif(isset($_POST['htmlid'])){
		$foodid = inputCheck($_POST['htmlid']);
		$sql_exptbl = "SELECT html FROM html AS h JOIN allfood as a ON h.id=a.html_id WHERE a.id='$foodid'";
		$htmls = $mysql->oneQuery($sql_exptbl);
		echo $htmls;
	}
	/*Delete food*/	
	elseif(isset($_POST['delfoodid'])){
		$delid = inputCheck($_POST['delfoodid']);
		$sql= "DELETE FROM food WHERE id = $delid";
		$mysql->query($sql);
		$tags = array();
		$tags['foodid']=$delid;
		ATrigger::doDelete($tags);
		$resp = ['delid'=>$delid];
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
				$before = $_SESSION['threshold'];
				$warndate = date("d/m/Y",strtotime("-$before day",strtotime($exp)));
				$setdate = $warndate.':09:00:00';
				$firstdate = date_create_from_format('d/m/Y:H:i:s', $setdate);
				$first = date("Y-m-d",strtotime("-$before day",strtotime($exp)))."T09:00:00Z";
				$msgres = $mysql->query("SELECT msg_chrome,msg_email FROM user WHERE id = ".$_SESSION['userid']);
				$msgSet = $mysql->fetch($msgres);
				//send email notification
				if($msgSet['msg_email']==1){
					$useremail = $mysql->oneQuery("SELECT email FROM user WHERE id =".$_SESSION['userid']);
					$html = htmlspecialchars("
					<div style='background:#1E3E57;width:100%;height:400px;border-radius:5px;padding:20px'>
					<h3 style='color:#fff'>Your Food $foodname will be expired at</h3>
					<h1 style='color:#FF6384'>$exp</h1><br/>
					<h3 style='color:#fff'>Please use it soon!</h3>
					<a href='https://marshal1.tech/FYP'>Go to EMCS now!</a>
					</div>");
					$postary = [
						"email"=>$useremail,
						"subject"=>"Your $foodname will be expired soon!",
						"body"=>$html,
						"altbody"=>"Your Food $foodname will be expired at $exp \r\n Please use it soon!"
					];
					ATrigger::doCreate("1day", "http://marshal1.tech/FYP/mailer.php", ['type'=>'email','userid'=>$_SESSION['userid'],'foodid'=>$editid],$firstdate,$_SESSION['reptimes'], 3,$postary);			
					echo 'email noti suc';
				}
				//send chrome notification
				if($msgSet['msg_chrome']==1){
					curlGet("https://api.atrigger.com/v1/tasks/create","key=4989200868836991246&secret=f5lI15uo41pYL7aY5QNkYq7h5bC7Y6&timeSlice=1day&first=$first&count=".$_SESSION['reptimes']."&retries=3&tag_chrome=chrome&tag_userid=".$_SESSION['userid']."&tag_foodid=$editid&url=http://marshal1.tech/FYP/notification.php?uid=".$_SESSION['userid']);
					echo 'chrome noti suc';
				}
				
			}
	}
	/*Get all food data */
	elseif(isset($_POST['foods'])){
		$place = inputCheck($_POST['place']);
		if($_POST['foods']=='all'){
		//	$sql= "SELECT f.*,c.category_name as cate,TIMESTAMPDIFF(DAY,NOW(),IF(f.open_date<f.exp,f.open_date,f.exp)) AS days FROM food AS f INNER JOIN allfood AS a ON f.allfood_id = a.id INNER JOIN category AS c ON c.id=a.category_id WHERE userid = ".$_SESSION['userid']." AND $place ORDER BY exp";
			$sql= "SELECT f.*,c.category_name as cate,TIMESTAMPDIFF(DAY,NOW(),f.exp) AS days FROM food AS f INNER JOIN allfood AS a ON f.allfood_id = a.id INNER JOIN category AS c ON c.id=a.category_id WHERE userid = ".$_SESSION['userid']." AND $place ORDER BY days";
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
	/*Get User's Expiration Warnign Threshold*/
	elseif(isset($_POST['threshold'])){
		$user = $mysql->fetch($mysql->query("SELECT * FROM user WHERE id = ".$_SESSION['userid']));
		$_SESSION['threshold']=$user['threshold'];
		$_SESSION['reptimes']=$user['retimes'];
		echo json_encode(['threshold'=>$user['threshold'],'reptimes'=>$user['retimes']]);
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
		if($type=='msg_email'){
			$sql_switch = "UPDATE user set msg_email='$status' WHERE id = ".$_SESSION['userid'];
			$mysql->query($sql_switch);
			if($status==0){
				ATrigger::doDelete(['userid'=>$_SESSION['userid'],'type'=>'email']);
			}
		}else{
			$curNoti = $mysql->oneQuery('SELECT COUNT(*) FROM user_token WHERE user_id = '.$_SESSION['userid']);
			//enable
			if($status==1){
				$sql_switch = "UPDATE user set msg_chrome='1' WHERE id = ".$_SESSION['userid'];
				$mysql->query($sql_switch);
			//disable
			}else{
				//last one, disable it
				if($curNoti==0){
					$sql_switch = "UPDATE user set msg_chrome=0 WHERE id = ".$_SESSION['userid'];
					$mysql->query($sql_switch);
					ATrigger::doDelete(['userid'=>$_SESSION['userid'],'type'=>'chrome']);
				}
			}
		}
		echo json_encode(['res'=>1]);
	}
	/*Get all noti rules table*/
	/* elseif(isset($_POST['notiplan'])){
		$sql_notiplan = "SELECT * FROM notiplan WHERE user_id = ".$_SESSION['userid']." ORDER BY warnbefore";
		$res = $mysql->query($sql_notiplan);
		$notiplan = array();
		while($row = $mysql->fetch($res)){
			array_push($notiplan,json_encode($row));
		}
		echo json_encode($notiplan);
	} */
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
	/*Push chrome messege setting*/
	elseif(isset($_POST['ispush'])){
		$res = 'No update noti';
		$browser = md5($_SERVER['HTTP_USER_AGENT']);
		if($_POST['ispush']=='add'){
			$subId = isset($_POST['token'])?$_POST['token']:'';
			if(!empty($subId)){
				$current = $mysql->oneQuery("SELECT COUNT(*) FROM user_token WHERE token = '$subId' AND user_id = ".$_SESSION['userid']);
			}
			if($current == 0){
				$sql_find = "SELECT count(*) FROM user_token WHERE browser = '$browser' AND user_id = ".$_SESSION['userid'];
				$num = $mysql->oneQuery($sql_find);
				if($num>0){
					$sql_del = "DELETE FROM user_token WHERE browser = '$browser' AND user_id = ".$_SESSION['userid'];
					$mysql->query($sql_del);
				}
					$sql_add = "INSERT user_token VALUES ('','".$_SESSION['userid']."','$subId','$browser')";
					$sql_upd = "UPDATE user_token SET token='$subId' WHERE browser = '$browser'";
					$mysql->query($sql_add);
					$mysql->query($sql_upd);
					$res = 'add new noti';
			}
		}else{
			$sql_del = "DELETE FROM user_token WHERE user_id = ".$_SESSION['userid']." AND browser = '$browser'";
			$mysql->query($sql_del);
			$res = 'Remove all chrome noti';
			ATrigger::doDelete(['userid'=>$_SESSION['userid'],'type'=>'chrome']);
		}
		echo json_encode(['res'=>$res]);
	//add atrigger task to push chrome notificaiton	
	}elseif(isset($_POST['atriggerChrome'])){
		$foodid = $_POST['foodid'];
		$exp = $_POST['exp'];
		//$before = isset($_POST['before'])?$_POST['before']:'-3';
		$before = $_SESSION['threshold'];
		$warndate = date("d/M/Y",strtotime("-$before day",strtotime($exp)));
		$setdate = $warndate.':09:00:00';
		$firstdate = date_create_from_format('d/M/Y:H:i:s', $setdate);
		ATrigger::doCreate("1day", "http://marshal1.tech/FYP/notification.php", ['type'=>'chrome','userid'=>$_SESSION['userid'],'foodid'=>$foodid],$firstdate,$_SESSION['reptimes'], 3,["userid"=>$_SESSION['userid']]);
		echo 'chrome noti suc';
	/* Search user's food in header table */
	}elseif(isset($_POST['searchfoodfeader'])){
		$searchFood = inputCheck($_POST['searchfoodfeader']);
		$sql_sheader = "SELECT id,node FROM header WHERE node like '%$searchFood%' AND num > 3";
		$res_sheader = $mysql->query($sql_sheader);
		$res = array('multiple'=>'','details'=>[]);
		$nums = mysqli_num_rows($res_sheader);
		if($nums==0){
			echo json_encode(['res'=>'empty']);
		}else{
			$res['multiple'] = $nums>1 ? true:false;
			while($row = $mysql->fetch($res_sheader)){
				array_push($res['details'],['id'=>$row['id'],'node'=>str_replace(' ','_',$row['node'])]);
			}
			echo json_encode($res);
		}
	}
	/* Find the assoc rules */
	elseif(isset($_POST['assocnode'])){
		$node = str_replace('_',' ',inputCheck($_POST['assocnode']));
		$total = $mysql->oneQuery("select count(*) from recipes");
		$rootv = $mysql->oneQuery("SELECT num FROM subtree WHERE node = '$node' AND assoc = 'Root'");
		//Confidence(X→Y) = P(Y | X) = P(X,Y)/ P(X) = P(consequent)/P(antecedent) = num/$rootv
		//Support(A)=$rootv, Support(C)=l.num, Support(A->C) = s.num
		$sql_assoc = "SELECT s.assoc,s.num/$rootv as conf,
			s.num/$rootv/(l.num/$total) AS lift, 
			($total-l.num)/$total / (($rootv-s.num)/$rootv) AS conv, 
			(s.num/$total) - (($rootv/$total) * (l.num/$total)) AS lev 
		FROM subtree AS s INNER JOIN 
		(SELECT node,num from subtree group by node) AS l ON s.assoc = l.node WHERE s.node = '$node' AND s.num/$rootv != 1 
		AND s.assoc!='root' AND s.num/$rootv > 0.1 AND s.num/$rootv/(l.num/$total) > 1 ORDER BY conf DESC LIMIT 20";
		$res_assoc = $mysql->query($sql_assoc);
		$res = ['assoc'=>[],'conf'=>[],'lift'=>[],'conv'=>[],'lev'=>[]];
		while($row = $mysql->fetch($res_assoc)){
			array_push($res['assoc'],$row['assoc']);
			array_push($res['conf'],$row['conf']);
			array_push($res['lift'],$row['lift']);
			array_push($res['conv'],$row['conv']);
			array_push($res['lev'],$row['lev']);
		}
		echo json_encode($res);
	}

	
?>
