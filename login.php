<?php 
	session_start();
	require "inc/db.php";
	include 'inc/header.php';
?>
<dl>
	<dd class="clearfix">
		<h1 class='loginTit text-center'>
			<a class="fa fa-globe"></a>&nbsp;EMCS
		</h1>
		<div class="col-sm-8 col-sm-offset-2 logmain">
			<form method="post" class='col-sm-6 loginform' autocomplete='off'>
				<h2 class="text-center">Log In</h2>
				<div class="form-group">
					<label>Username</label>
					<input type="text" class="form-control" name='username' maxlength=20 placeholder='Marshall' required/>
				</div>
				<div class="form-group">
					 <label>Password </label>
					 <input type="password" class="form-control" name='pwd' maxlength=20 placeholder='1234' required/>
					 <kbd class='seepwd' onmousedown="seepwd('pwd')"><i class='fa fa-eye'></i></kbd>
				</div>
				<div class="form-group">
					<div class="col-sm-8 col-sm-offset-2">
						<button type='submit' class='btn btn-success btn-block btnlogin' name='login'>Log in</button>
					</div>
				</div>
			</form>
			<form method="post" class='col-sm-6' autocomplete='off'>
				<h2 class="text-center">Sign Up</h2>
				<div class="form-group">
					<label>Username</label>
					<input type="text" class="form-control" name='newusername' maxlength=20 placeholder='Username' oninput="checkNewName()" required/><kbd class='seepwd hidden'><i class=''></i>
				</div>
				<div class="form-group">
					 <label>Password </label>
					 <input type="password" class="form-control" name='newpwd' maxlength=20 placeholder='1234' required/>
					 <kbd class='seepwd' onmousedown="seepwd('newpwd')"><i class='fa fa-eye'></i></kbd>
				</div>
				<div class="form-group">
					 <label>Password Confirm</label>
					 <input type="password" class="form-control" name='newpwdconf' maxlength=20 placeholder='1234' onchange='checkpwd()' required/>
					 <kbd class='seepwd' onmousedown="seepwd('newpwdconf')" onclick='checkpwd()'><i class='fa fa-eye'></i></kbd>
				</div>
				<div class="form-group">
					<div class="col-sm-8 col-sm-offset-2">
						<button type='submit' class='btn btn-warning btn-block' name='signup'>Sign Up</button>
					</div>
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
		$res_pwd = $mysql->query("SELECT id,pwdhash,salt_code,username FROM user WHERE username = '$username'"); 
		$userInfo = $mysql->fetch($res_pwd);
		$pwdhash = MD5($pwd.$userInfo['salt_code']);
		if(mysqli_num_rows($res_pwd)){
			$rightpwd = $userInfo['pwdhash'];
			if($pwdhash == $rightpwd){
				$_SESSION['user'] = $userInfo['username'];
				$_SESSION['userid'] = $userInfo['id'];
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
		$password = inputCheck($_POST['newpwd']);
		$passwardconfirm = inputCheck($_POST['newpwdconf']);
		if($password !=$passwardconfirm){
			echo"<script type='text/javascript'>alert('Password is not the same');location='login.php'</script>";
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
				$sql_newcus = "INSERT INTO user (username, pwdhash, salt_code) VALUES('$username','$pwdhash','$salt')";
				$mysql->query($sql_newcus);
				$_SESSION['user'] = $username;
				$_SESSION['userid'] = mysqli_insert_id($mysql->conn);
				echo"<script type='text/javascript'>alert('Sign up Successfully".$_SESSION['userid']."');location='index.php'</script>";
			}
		}
	}  
	 
?>