<div>
	<ul class="nav nav-tabs">
		<li class="active">
			<a href="#panel-account" data-toggle="tab" id='account'><i class="fa fa-user"></i>&nbsp;Account</a>
		</li>
		<li>
			<a href="#panel-preferences" data-toggle="tab" id='preferences'><i class="fa fa-gear"></i>&nbsp;Preferences</a>
		</li>
	</ul>
<!-- Manage Food -->		
	<div class="tab-content">
		<div class="tab-pane active" id="panel-account" style="padding-top:15px">
			<fieldset class="col-sm-8 col-sm-offset-2">
			<legend>Login Password</legend>
				<form method='post'>
					<div>
						<div class="form-group">
							 <label>Current Password </label>
							 <input type="password" class="form-control" name='oldpwd' required/>
						</div>
						<div class="form-group">
							 <label>New Password </label>
							 <input type="password" class="form-control" onchange='checkpwd(0)' name='newpwd' required/>
							 <kbd class='seepwd' onmousedown="seepwd('newpwd')"><i class='fa fa-eye'></i></kbd>
						</div>
						<div class="form-group">
							<label>New Password Confirm </label>
							<input type="password" class="form-control" onchange='checkpwd(0)' name='newpwdconf' required/>
							<kbd class='seepwd' onmousedown="seepwd('newpwdconf')" onclick='checkpwd(0)'><i class='fa fa-eye'></i></kbd>
						</div>
						<div class="form-group col-md-4 col-md-offset-8 col-sm-12">
							 <button type="submit" class="btn btn-block btn-primary" name='signup' onmousedown='checkpwd(0)' disabled>Submit</button>
						</div>
					</div>
				</form>
			</fieldset>
<?php
	$sql_users = "SELECT * FROM user where id = ".$_SESSION['userid'];
	$res_user = $mysql->query($sql_users);
	$userinfo = $mysql->fetch($res_user); 
	$browser = md5($_SERVER['HTTP_USER_AGENT']);
	$isBrowserNoti = $mysql->oneQuery("SELECT COUNT(*) FROM user_token WHERE browser = '$browser' AND user_id = ".$_SESSION['userid']);
	$isNoti = $isBrowserNoti>0?true:false;
?>
			<fieldset class="col-sm-8 col-sm-offset-2">
			<legend>Profile</legend>
				<form method='post'>
					<div>
						<div class="form-group">
							 <label>Email </label>
							 <input type="email" name='email' class="form-control" value="<?php echo isset($userinfo['email'])?$userinfo['email']:'';?>" required/>
						</div>
						<div class="form-group">
							 <label>Birthday </label>
							 <input type="date" class="form-control" name='birth' value="<?php echo isset($userinfo['birth_date'])?$userinfo['birth_date']:'';?>"/>
						</div>
						<div class="form-group">
								<label>Gender </label>
								<select class="form-control" name='gender'>
									<option value="0">Unknown</option> 
									<option value="1">Male</option> 
									<option value="2">Female</option> 
								</select>
							<script>$("[name='gender']").val(<?php echo isset($userinfo['gender'])?$userinfo['gender']:'';?>)</script>
							</div>
						<div class="form-group col-md-4 col-md-offset-8 col-sm-12">
							 <button type="submit" class="btn btn-block btn-primary" name='profile'>Submit</button>
						</div>
					</div>
				</form>
			</fieldset>
		</div>
		<div class="tab-pane" id="panel-preferences" style="padding-top:15px">
			<fieldset class="col-sm-8 col-sm-offset-2">
			<legend>Notification</legend>
					<div>
						<div class="form-group col-sm-12">
							<div class="range switch">
								<label class="col-xs-6">Email: </label>
								<input type="range" min="0" max="100" onchange="dragbtn(this)" oninput="dragbtncolor(this)" name='msgemail'>
							</div>
						</div>
						<div class="form-group col-sm-12">
							<div class="range switch">
								<label class="col-xs-6">Chrome: </label>
								<input type="range" min="0" max="100" onchange="dragbtn(this)" oninput="dragbtncolor(this)" class="js-push-button" name='msgchrome'>
							</div>
							<div class='js-log'>
							</div>
						</div>
						<div class="form-group col-sm-12">
							<label>Notification Plan</label>
							<table class='table table-striped'>
								<tr>
									<th>Expired Day</th>
									<th>Method</th>
									<th>Available</th>
									<th>Remove</th>
								</tr>
								<tr v-for="(item, index) in notiplan">
									<td v-if='item.warnbefore==0'>Expired Today</td>
									<td v-else-if='item.warnbefore==1'>1 Day Before Expired</td>
									<td v-else>{{item.warnbefore}} Days Before Expired</td>
									<td>{{notitype[item.method]}}</td>
									<td><i :class="'fa '+notidiable[item.available]+' fa-2x'" @click="checknoti(this,item.id,item.available)" style='cursor:pointer'></i></td>
									<td><a class="label label-warning" href="####" @click="rmnoti(this,item.id)">X</a></td>
								</tr>
							</table>
						</div>
						<form class="form-group col-sm-8" method="post" method="index.php?page=setting">
							<label>Add a Notification</label>
								<select class="form-control" name='notiday' required>
									<option value=''> Time </option> 
									<option value='0'> Expired Today </option> 
									<option v-for="i in 7" :value="i">{{i}} Day Before Expired</option>
								</select>
								<br/>
								<select class="form-control" name='notiway' required>
									<option value=''> Method </option> 
									<option value="0">Chrome Notification</option> 
									<option value="1">Email</option> 
								</select>
								<br/>
								<button class="btn btn-primary btn-block" name='newnoti'>Add</button>
						</form>
					</div>
			</fieldset>
		</div>
	</div>
</div>
<script src="static/js/mysettingvue.js"></script>
<script src="noti/config.js"></script>
<script src="noti/demo.js"></script>
<script src="noti/main.js"></script>
<script>
$("[name='msgemail']").val('<?php echo $userinfo['msg_email']==0?0:100;?>')
$("[name='msgchrome']").val('<?php echo $isNoti?0:100;?>')
$("[name='msgemail']").css('background','<?php echo $userinfo['msg_email']==0?'#ccc':'#337ab7';?>')
$("[name='msgchrome']").css('background','<?php echo $isNoti==0?'#ccc':'#337ab7';?>')
</script>
<?php
if($userinfo['msg_chrome']==0){
	echo "<script>unsubscribe()</script>";
}
/**Edit Password (it post 'signup' due to js function variable name is fixed)*/
	if(isset($_POST['signup'])){
		$oldpwd = inputCheck($_POST['oldpwd']);
		$res_pwd = $mysql->fetch($mysql->query("SELECT pwdhash,salt_code FROM user WHERE id = '{$_SESSION['userid']}'"));
		$oldpwdhash = MD5($oldpwd.$res_pwd['salt_code']);
		if($oldpwdhash == $res_pwd['pwdhash']){
			$newpwdhash = MD5($_POST['newpwd'].$res_pwd['salt_code']);
			if($newpwdhash==$oldpwdhash){
				echo "<script>
					$('[name=\"newpwd\"').addClass('alert-danger');
					$('[name=\"newpwd\"').focus();
					alert('New Password Cannot be same as original one!');
				</script>";
			}else{
				$sql_newPwd = "UPDATE user SET pwdhash = '$newpwdhash' WHERE id = '{$_SESSION['userid']}'";
				$mysql->query($sql_newPwd);
				unset($_SESSION['user']);
				unset($_SESSION['userid']);
				redirect('index.php','Change Password Successfully!\\nPlease Log in again!');
			}
		}else{
			echo "<script>
				$('[name=\"oldpwd\"').addClass('alert-danger');
				$('[name=\"oldpwd\"').focus();
				alert('Wrong Password');
			</script>";
		}
	} 
/**Edit user profile*/
	else if(isset($_POST['profile'])){
		$email = inputCheck($_POST['email']);
		$birth = inputCheck($_POST['birth']);
		$gender = inputCheck($_POST['gender']);
		$sql_editprofile = "UPDATE user SET email = '$email', birth_date = '$birth', gender = '$gender' WHERE id = ".$_SESSION['userid'];
		$mysql->query($sql_editprofile);
		redirect("http://localhost/EMCS/index.php?page=setting","Update profile successfully!");
	}
/**Add new noti plan*/
	else if(isset($_POST['newnoti'])){
		$notiday = inputCheck($_POST['notiday']);
		$notiway = inputCheck($_POST['notiway']);
		$sql_check = "SELECT * FROM notiplan WHERE user_id = '{$_SESSION['userid']}' AND warnbefore=$notiday AND method=$notiway";
		$res = $mysql->query($sql_check);
		$emails = $mysql->oneQuery("SELECT COUNT(*) FROM notiplan WHERE user_id = '{$_SESSION['userid']}' AND method =1");
		if($emails>5){
			echo "<script>alert('Each user could only has maximum 5 free emails notification')</script>";
		}else{
			if(mysqli_num_rows($res)>0){
				echo "<script>alert('Add Unsuccessfully: Same rule exists')</script>";
			}else{
				$sql_newnoti = "INSERT notiplan VALUES ('','{$_SESSION['userid']}',$notiday,$notiway,1)";
				$mysql->query($sql_newnoti);
				echo "<script>$('#preferences').click();vmsetting.getall()</script>";
			}
		}
	}
?>
