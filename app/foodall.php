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
							<button class='btn btn-default'>Edit</button>
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