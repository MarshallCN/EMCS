<?php 
	session_start();
	require "inc/db.php";
	include 'inc/header.php';
?>
<dl>
	<dd class="clearfix">
		<h1 class='loginTit text-center'>
			<a class="fa fa-cutlery"></a>&nbsp;<span class="visible-xs">EMCS</span>
			<span class="hidden-xs">E<span class='muteText'>xpiration</span> M<span class='muteText'>anagement & </span>C<span class='muteText'>ooking</span> S<span class='muteText'>uggestion</span></span>
		</h1>
		<div class="col-sm-6 col-sm-offset-3 logmain">
			<form method="post" class='col-sm-12' autocomplete='off'>
				<h2 class="text-center">Log In</h2>
				<div class="form-group">
					<label>Username</label>
					<input type="text" class="form-control" name='username' maxlength=20 placeholder='' required/><kbd class='seepwd hidden'><i class=''></i>
				</div>
				<div class="form-group">
					 <label>Password </label>
					 <input type="password" class="form-control" name='pwd' maxlength=20 placeholder='1234' required/>
					 <kbd class='seepwd' onmousedown="seepwd('pwd')"><i class='fa fa-eye'></i></kbd>
				</div>
				<span id='signInput' style='display:none'>
				<div class="form-group">
					 <label>Password Confirm</label>
					 <input type="password" class="form-control" name='newpwdconf' maxlength=20 placeholder='1234' onchange='checkpwd()' />
					 <kbd class='seepwd' onmousedown="seepwd('newpwdconf')" onclick='checkpwd()'><i class='fa fa-eye'></i></kbd>
				</div>
				<div class="form-group">
					<label>Email</label>
					<input type="email" class="form-control" name='newemail' maxlength=100 placeholder='Email' oninput="checkNewEmail()" /><kbd class='seepwd hidden'><i class=''></i>
				</div>
				<div class="form-group">
					<label>Verify Code</label>
					<div class="input-group">
						<input type="number" class="form-control" name='verifycode' max=9999 oninput="checkNewName()" />
						<span class="input-group-btn">
							<button class="btn btn-default" type="button" id='sendemailbtn' onclick='sendverifyemail()' disabled>
								Send Verify Email
							</button>
						</span>
					</div>
				</div>
				</span>
				<div class="col-md-6 form-group" style='padding:0'>
					<button type='button' class='btn btn-block btn-lg btn-default' onclick='showSignForm()' name='formlabel'>New User</button>
				</div>
				<div class="col-md-6 form-group" style='padding:0'>
					<input type="hidden" id='v' name='vcodehash'>
					<button type='submit' class='btn btn-warning btn-lg btn-block' name='login'>Log in</button>
				</div>
			</form>
		</div>
	</dd>
</dl>
<?php
	include "inc/footer.php";
	if(isset($_POST['login'])){
		$username = strtolower(inputCheck($_POST['username']));
		$pwd = inputCheck($_POST['pwd']);
		$res_pwd = $mysql->query("SELECT id,pwdhash,salt_code,username,threshold,retimes FROM user WHERE username = '$username'"); 
		$userInfo = $mysql->fetch($res_pwd);
		$pwdhash = MD5($pwd.$userInfo['salt_code']);
		if(mysqli_num_rows($res_pwd)>0){
			$rightpwd = $userInfo['pwdhash'];
			if($pwdhash == $rightpwd){
				$_SESSION['user'] = $userInfo['username'];
				$_SESSION['userid'] = $userInfo['id'];
				$_SESSION['threshold']=$userInfo['threshold'];
				$_SESSION['reptimes']=$userInfo['retimes'];
				echo "<script>$('[name=\"username\"').addClass('alert-success');$('[name=\"pwd\"').addClass('alert-success');</script>";
				redirect('index.php');
			}else{
				echo "<script>$('[name=\"username\"').addClass('alert-success')
					$('[name=\"pwd\"').addClass('alert-danger')
					$('[name=\"username\"').val('$username')
					alert('Wrong Password');$('[name=\"pwd\"').focus();
				</script>";
			}
		}else{
			echo "<script>$('[name=\"username\"').addClass('alert-danger');$('[name=\"username\"').focus();alert('Username not found')</script>";
		}	
	}else if(isset($_POST['signup'])){
		$username = inputCheck($_POST['newusername']);
		$password = inputCheck($_POST['pwd']);
		$email = inputCheck($_POST['newemail']);
		$passwardconfirm = inputCheck($_POST['newpwdconf']);
		$vcodehash = $_POST['vcodehash'];
		$verifycode = md5($_POST['verifycode']);
		if($verifycode != $vcodehash){
			echo"<script>alert('Verify Code is Wrong!');</script>";
		}else{
			if($password !=$passwardconfirm){
				echo"<script>alert('Password are not same');location='login.php'</script>";
			}else{  
				$res = $mysql->query("SELECT * FROM user WHERE email = '$email'");
				if(mysqli_num_rows($res)>0){
					echo"<script>alert('Email has been used!');location='login.php'</script>";
				}else{
					$sql = "SELECT * FROM user WHERE username = '$username'";
					$query = $mysql->query("$sql");
					$rows = mysqli_num_rows($query);
					if($rows == 1){
						echo"<script type='text/javascript'>alert('Username have been Used');location='login.php';  
						</script>";
					}else{
						$salt=base64_encode(mcrypt_create_iv(6,MCRYPT_DEV_RANDOM)); //Add random salt
						$pwdhash = MD5($password.$salt); //MD5 of pwd+salt
						$sql_newcus = "INSERT INTO user (username, pwdhash, salt_code, email, msg_email, msg_chrome,threshold,retimes) VALUES('$username','$pwdhash','$salt','$email',0,0,3,3)";
						$mysql->query($sql_newcus);
						$_SESSION['user'] = $username;
						$_SESSION['userid'] = mysqli_insert_id($mysql->conn);
						$_SESSION['threshold']=3;
						$_SESSION['reptimes']=3;
						echo"<script>alert('Sign up Successfully ".$_SESSION['user']."');location='index.php'</script>";
					}
				}
			}
		}
	}  
	 
?>