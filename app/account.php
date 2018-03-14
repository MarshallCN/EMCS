	<dl class="container">
		<h1 class="text-center text-danger"><?php echo ucwords($_SESSION['user'])."'s Account";?></h1>
		<dd class="row clearfix">
			<form method='post' style='padding-top:20px;'>
				<div class='col-md-3 col-md-offset-1'>
					<label>Change Password</label>
					<input type="hidden" name="newusername" value='xxx'/>
				</div>
				<div class="form-group col-md-6 col-md-offset-1">
					
					<div class="form-group">
						 <label>Password </label>
						 <input type="password" class="form-control" name='oldpwd' required/>
					</div>
					<div class="form-group">
						 <label>Password </label>
						 <input type="password" class="form-control" onchange='checkpwd(0)' name='newpwd' required/>
						 <kbd class='seepwd' onmousedown="seepwd('newpwd')"><i class='fa fa-eye'></i></kbd>
					</div>
					<div class="form-group">
						<label>Password Confirm </label>
						<input type="password" class="form-control" onchange='checkpwd(0)' name='newpwdconf' required/>
						<kbd class='seepwd' onmousedown="seepwd('newpwdconf')" onclick='checkpwd(0)'><i class='fa fa-eye'></i></kbd>
					</div><hr/>
					<div class="form-group col-md-4 col-md-offset-4" style='padding:0'>
						 <button type="submit" class="btn btn-block btn-lg btn-warning" name='signup' onmousedown='checkpwd(0)' disabled>Submit</button>
					</div>
				</div>
			</form>
		</dd>
	</dl>
			
<?php
/**Edit Password*/
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
?>