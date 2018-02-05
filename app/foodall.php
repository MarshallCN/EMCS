<div class="tabbable" id="tabs-article" style='padding-top:10px;'>
	<ul class="nav nav-tabs">
		<li class="active">
			<a href="#panel-byfood" data-toggle="tab" id='byfood'>By Food</a>
		</li>
		<li>
			<a href="#panel-request" data-toggle="tab" id='driverequ'><span class="fa fa-calendar-check-o"></span>&nbsp;By Date</a>
		</li>
	</ul>
<!-- Manage Food -->		
	<div class="tab-content">
		<div class="tab-pane active" id="panel-byfood">
			<div class='col-sm-6 myfoodblock'>
				<div class="col-xs-4 myfoodpic"></div>
				<div class="col-xs-8 myfoodtbl">
				<table class='table table-striped'>
					<tr>
						<th>
							Name
						</th>
						<td>
							Potato
						</td>
					</tr>
					<tr>
						<th>
							Expiration
						</th>
						<td>
							10 Days
						</td>
					</tr>
					<tr>
						<th>
							Volume
						</th>
						<td>
							100%
						</td>
					</tr>
					<tr>
						<td colspan=2 class='text-right'>
							<button class='btn btn-default' href="#modal-editfood"  role="button" data-toggle="modal">Edit</button>
							<button class='btn btn-warning' >Consume</button>
						</td>
					<tr>
				</table>
				</div>
				
			</div>
			
			<div class='col-sm-6 myfoodblock'>
				<div class="col-xs-4 myfoodpic"></div>
				<div class="col-xs-8 myfoodtbl">
				<table class='table table-striped'>
					<tr>
						<th>
							Name
						</th>
						<td>
							Potato
						</td>
					</tr>
					<tr>
						<th>
							Expiration
						</th>
						<td>
							10 Days
						</td>
					</tr>
					<tr>
						<th>
							Volume
						</th>
						<td>
							100%
						</td>
					</tr>
					<tr>
						<td colspan=2 class='text-right'>
							<button class='btn btn-default'>Edit</button>
							<button class='btn btn-warning' >Consume</button>
						</td>
					</tr>
				</table>
				</div>
				
			</div>
			<div class='col-sm-6 myfoodblock'>
				<div class="col-xs-4 myfoodpic"></div>
				<div class="col-xs-8 myfoodtbl">
				<table class='table table-striped'>
					<tr>
						<th>
							Name
						</th>
						<td>
							Potato
						</td>
					</tr>
					<tr>
						<th>
							Expiration
						</th>
						<td>
							10 Days
						</td>
					</tr>
					<tr>
						<th>
							Volume
						</th>
						<td>
							100%
						</td>
					</tr>
					<tr>
						<td colspan=2 class='text-right'>
							<button class='btn btn-default'>Edit</button>
							<button class='btn btn-warning' >Consume</button>
						</td>
					<tr>
				</table>
				</div>
				
			</div>

		</div>
	<!--  -->
		<div class="tab-pane" id="panel-request">
			<div class='helptip' id='helptip1' style="display:none;">
				<a class='label label-success'>D</a> Done /
				<a class='label label-default'>D</a> Not Done /
				<a class='label label-danger'>X</a> Delete /
			</div>
			<table class='table table-striped'>
				<thead>
					<tr>
						<th>
							Food Name
						</th>
						<th>
							Food Category
						</th>
						<th>
							Expiration Date
						</th>
						<th class='text-center'>
							Operation <a href='javascript:void(0);' onclick="$('#helptip').toggle()" class="glyphicon glyphicon-question-sign icon_ques"></a>
						</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>1</td><td>1</td><td>1</td><td>1</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
<div class="modal" id="modal-editfood">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">
					Edit Food
				</h4>
			</div>
			<div class="modal-body">
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
						<label>Exp. Type</label>
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
				
			</div>
		</div>					
	</div>				
</div>