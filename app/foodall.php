<div class="tabbable" id="tabs-article" style='padding-top:10px;'>
	<ul class="nav nav-tabs">
		<li class="active">
			<a href="#panel-byfood" data-toggle="tab" id='byfood'>Blocks</a>
		</li>
		<li>
			<a href="#panel-request" data-toggle="tab" id='driverequ'><span class="fa fa-calendar-check-o"></span>&nbsp;Table</a>
		</li>
	</ul>
<!-- Manage Food -->		
	<div class="tab-content">
		<div class="tab-pane active" id="panel-byfood">
		<?php //include('inc/timecond.php');?>
			<div class='col-sm-6 myfoodblock' id='food1'>
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
							<span class="label label-danger">1 Days</span>
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
							<button class='btn btn-warning' onclick="removefood(1)" >Remove</button>
						</td>
					<tr>
				</table>
				</div>
			</div>
			
			<div class='col-sm-6 myfoodblock' id='food2'>
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
							<button class='btn btn-warning' onclick="removefood(2)" >Remove</button>
						</td>
					</tr>
				</table>
				</div>
			</div>
			
			<div class='col-sm-6 myfoodblock' id='food3'>
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
							<button class='btn btn-warning' onclick="removefood(3)" >Remove</button>
						</td>
					<tr>
				</table>
				</div>
				
			</div>

		</div>
	<!--  -->
		<div class="tab-pane" id="panel-request">
			<div class='helptip' id='helptip' style="display:none;">
				<a class='label label-primary'>E</a> Edit /
				<a class='label label-warning'>R</a> Remove
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
						<th>
							Exp. Date Type
						</th>
						<th class='text-center'>
							Operation <a href='javascript:void(0);' onclick="$('#helptip').toggle()" class="glyphicon glyphicon-question-sign icon_ques"></a>
						</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>1</td><td>1</td><td>1</td><td>1</td>
						<td class='text-right'>
							<a class='label label-primary' href="">E</a>
							<a class='label label-warning' href="">R</a>
						</td>
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
				
			</div>
		</div>					
	</div>				
</div>
<?php
//add new food into storage	
	if(isset($_POST['fname'])){
		$foodname = inputCheck($_POST['fname']);
		$foodcate = inputCheck($_POST['fcate']);
		$exp = inputCheck($_POST['exp']);
		$exptype = inputCheck($_POST['exptype']);
		$vol = inputCheck($_POST['vol']);
		$place = inputCheck($_POST['place']);
		$imgname = inputCheck($_POST['imgname']);
		$sql_addfood = "INSERT foodtest VALUE ('','$foodname','$foodcate','$exptype','$exp','$vol',NOW(),'$place','$imgname')";
		$mysql->query($sql_addfood);
		echo "<script>location.href= confirm('Add food to storage successfully!\\nDo you want to continue adding food?')?'index.php?page=addfood':'index.php?page=food&storage=all'</script>";
	}
?>
