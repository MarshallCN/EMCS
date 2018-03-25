<div>
	<ul class="nav nav-tabs">
		<li>
			<a href="#panel-account" data-toggle="tab" id='account'><i class="fa fa-user"></i>&nbsp;Account</a>
		</li>
		<li class="active">
			<a href="#panel-preferences" data-toggle="tab" id='preferences'><i class="fa fa-gear"></i>&nbsp;Preferences</a>
		</li>
	</ul>
<!-- Manage Food -->		
	<div class="tab-content">
		<div class="tab-pane " id="panel-account" style="padding-top:15px">
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
			<fieldset class="col-sm-8 col-sm-offset-2">
			<legend>Profile</legend>
				<form method='post'>
					<div>
						<div class="form-group">
							 <label>Email </label>
							 <input type="email" name='email' class="form-control" required/>
						</div>
						<div class="form-group">
							 <label>Birthday </label>
							 <input type="date" class="form-control" name='birth'/>
						</div>
						<div class="form-group">
								<label>Gender </label>
								<select class="form-control" name='gender'>
									<option value="0">Unknown</option> 
									<option value="1">Male</option> 
									<option value="2">Female</option> 
								</select>
							</div>
						<div class="form-group col-md-4 col-md-offset-8 col-sm-12">
							 <button type="submit" class="btn btn-block btn-primary" name='accountinfo'>Submit</button>
						</div>
					</div>
				</form>
			</fieldset>
		</div>
		<div class="tab-pane active" id="panel-preferences" style="padding-top:15px">
			<fieldset class="col-sm-8 col-sm-offset-2">
			<legend>Notification</legend>
					<div>
						<div class="form-group col-sm-12">
							<div class="range switch">
								<label class="col-xs-6">Email: </label>
								<input type="range" class="" min="0" max="100" value='0' onchange="this.value=this.value>50?100:0" oninput="this.style.background=this.value>50?'#337ab7':'#ccc'" name='vol'>
							</div>
						</div>
						<div class="form-group col-sm-12">
							<div class="range switch">
								<label class="col-xs-6">Chrome: </label>
								<input type="range" class="" min="0" max="100" value='0' onchange="this.value=this.value>50?100:0" oninput="this.style.background=this.value>50?'#337ab7':'#ccc'" name='vol'>
							</div>
						</div>
						<div class="form-group col-sm-8">
							<label>Notification Plan</label>
							<table class='table table-striped'>
								<tr>
									<th>Expired Day</th>
									<th>Notification Method</th>
									<th></th>
								</tr>
								<tr>
									<td>Expired Today</td>
									<td>Email</td>
									<td><a class="label label-warning" href="####">X</a></td>
								</tr>
								<tr>
									<td>Expired Today</td>
									<td>Chrome</td>
									<td><a class="label label-warning" href="####">X</a></td>
								</tr>
								<tr>
									<td>3 Days Before</td>
									<td>Chrome</td>
									<td><a class="label label-warning" href="####">X</a></td>
								</tr>
								<tr>
									<td>5 Days Before</td>
									<td>Chrome</td>
									<td><a class="label label-warning" href="####">X</a></td>
								</tr>
							</table>
						</div>
						<div class="form-group col-sm-8">
							<label>Add a Notification</label>
								<select class="form-control" name='gender'>
									<option> - </option> 
									<option value="1">Expired Today</option> 
									<option value="2">1 days Before</option> 
									<option value="3">3 days Before</option> 
									<option value="4">5 days Before</option> 
								</select>
						</div>
					</div>
			</fieldset>
		</div>
	</div>
</div>
<?php
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
?>