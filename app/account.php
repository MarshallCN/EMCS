			<form method='post' style='padding-top:20px;'>
				<div class='col-md-3 col-md-offset-1'>
					<label>Change Password</label>
				</div>
				<div class="form-group col-md-6 col-md-offset-1">
					
					<div class="form-group">
						 <label>Password </label>
						 <input type="password" class="form-control" name='oldpwd' required/>
					</div>
					<div class="form-group">
						 <label>Password </label>
						 <input type="password" class="form-control" onchange='checkpwd()' name='newpwd' required/>
						 <kbd class='seepwd' onmousedown="seepwd('newpwd')"><i class='fa fa-eye'></i></kbd>
					</div>
					<div class="form-group">
						<label>Password Confirm </label>
						<input type="password" class="form-control" onchange='checkpwd()' name='newpwdconf' required/>
						<kbd class='seepwd' onmousedown="seepwd('newpwdconf')" onclick='checkpwd()'><i class='fa fa-eye'></i></kbd>
					</div><hr/>
					<div class="form-group col-md-4 col-md-offset-4" style='padding:0'>
						 <button type="submit" class="btn btn-block btn-lg btn-warning" name='signup' onmousedown='checkpwd()' disabled>Submit</button>
					</div>
				</div>
			</form>