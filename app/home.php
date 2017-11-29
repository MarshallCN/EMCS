<div class="tabbable" id="tabs-article" style='padding-top:10px;'>
	<ul class="nav nav-tabs">
		<li class="active">
			<a href="#panel-showcus" data-toggle="tab" id='showcus'>Manage Customer</a>
		</li>
		<li>
			<a href="#panel-request" data-toggle="tab" id='driverequ'><span class="fa fa-calendar-check-o"></span>&nbsp;Test Drive Request</a>
		</li>
	</ul>
<!-- Manage Customer -->		
	<div class="tab-content">
		<div class="tab-pane active" id="panel-showcus">
			<div class='helptip' id='helptip' style="display:none;">
					<a class='label label-danger'>X</a> Delete
			</div>	
			<table class='table table-striped'>
				<thead>
					<tr>
						<th>
							Username
						</th>
						<th>
							Email
						</th>
						<th>
							Phone
						</th>
						<th>
							Address
						</th>
						<th class='text-center'>
							Operation <a href='javascript:void(0);' onclick="$('#helptip').toggle()" class="glyphicon glyphicon-question-sign icon_ques"></a>
						</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>1</td><td>1</td><td>1</td><td>1</td><td>1</td>
					</tr>
				</tbody>
			</table>
		</div>
	<!-- Manage Test Drive Request -->
		<div class="tab-pane" id="panel-request">
			<div class='helptip' id='helptip1' style="display:none;">
				<a class='label label-success'>D</a> Done /
				<a class='label label-default'>D</a> Not Done /
				<a class='label label-danger'>X</a> Delete /
			</div>
			<table class='table table table-striped'>
				<thead>
					<tr>
						<th>
							Customer
						</th>
						<th>
							Car
						</th>
						<th>
							Appointment Time
						</th>
						<th>
							Contact Staff
						</th>
						<th>
							Operation <a href='javascript:void(0);' onclick="$('#helptip1').toggle()" class="glyphicon glyphicon-question-sign icona"></a>
						</th>
					</tr>
				</thead>
				<tbody>
				</tbody>	
			</table>
		</div>
	</div>