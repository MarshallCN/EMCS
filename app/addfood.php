<form method="post">   
					<div class="form-group">
						<label>Food Name</label>
						<input type="text" class="form-control" name='fname' placeholder="Food Name" required>
					</div>
					<div class="form-group">
						<label>Food Category</label>
						<select class="form-control" name='fcate' required>
							<option>-</option>
							<option value='1'>1</option>
						</select>
					</div>
					<div class="form-group col-xs-6">
						<label>Expiration</label>
						<input type="date" class="form-control" name='exp' oninput="checkDate(this)" placeholder="exp">
					</div>
					<div class="form-group col-xs-6">
						<label>Exp. Type <a href='javascript:void(0);' onclick="$('#helptip').toggle()" class="glyphicon glyphicon-question-sign icon_ques"></a>
						</label>
						<select class="form-control" name='exptype'>
							<option value='0'>Used By</option>
							<option value='1'>Best Before</option>
						</select>
					</div>
					<div class="form-group">
						<label>Once Opened Used Within...</label>
						<div class="input-group">
							<input type="number" class="form-control" name='expopen'>
							<div class="input-group-btn">
								<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
									Days 
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu pull-right">
									<li><a>Days</a></li>
									<li><a>Weeks</a></li>
									<li><a>Months</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="form-group">
					<label for="minsup">Volume Rate: <span id="volrate">100</span>%</label>
					<div class="range">
						<span class="label label-primary">0%</span>
						<input type="range" id="minsup" min="0" max="100" value="100" oninput="volrange(this,'volrate')">
						<span class="label label-primary">100%</span>
					</div>
				</div>
					<div>	
						<button class='btn btn-primary btn-block'>Submit</button>
					</div>
				</form>