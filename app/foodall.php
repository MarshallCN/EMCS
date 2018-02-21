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
		<?php //include('inc/timecond.php');
			if(isset($_GET['storage'])){
				switch($_GET['storage']){
					case "all": 
						$storeplace="1=1";
						break;
					case "refrigerator":
						$storeplace="place=2";
						break;
					case "freezing":
						$storeplace="place=1";
						break;
					case "pantry":
						$storeplace="place=3";
						break;
					case "other":
						$storeplace="place=5";
						break;
				}
					
			}
			$sql_myfood = "SELECT *,TIMESTAMPDIFF(DAY,NOW(),exp) AS days FROM foodtest WHERE userid = ".$_SESSION['userid']." AND ".$storeplace;
			$res = $mysql->query($sql_myfood);
			while($row = $mysql->fetch($res)){
		?>
			<div class='col-sm-6 myfoodblock' id='food<?php echo $row['id'];?>'>
				<img class="col-xs-4" src="static/img/foodupload/<?php echo $row['picpath'];?>" alt='no picture'>
				<div class="col-xs-8 myfoodtbl">
				<table class='table table-striped'>
					<tr>
						<th>
							Name
						</th>
						<td>
							<?php echo $row['name'];?>
						</td>
					</tr>
					<tr>
						<th>
							Expiration
						</th>
						<td>
							<?php echo $row['days']<6 ? "<span class='label label-danger'>":"<span>";echo $row['days'];?> Days</span>
						</td>
					</tr>
					<tr>
						<th>
							Volume
						</th>
						<td>
							<?php echo $row['vol'];?>%
						</td>
					</tr>
					<tr>
						<td colspan=2 class='text-right'>
							<button class='btn btn-default' href="#modal-editfood"  role="button" data-toggle="modal" onclick="editfood(<?php echo $row['id'];?>)">Edit</button>
							<button class='btn btn-warning' onclick="removefood(<?php echo $row['id'];?>)" >Remove</button>
						</td>
					<tr>
				</table>
				</div>
				
			</div>
		<?php 
			}
		?>
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
				<form method="post" action="index.php?page=food&storage=all">   
					<div class="form-group">
						<label>Food Name</label>
						<input type="text" class="form-control" name='fname' placeholder="Food Name" required>
					</div>
					<div class="form-group">
						<label>Food Category</label>
						<select class="form-control" name='fcate' required>
							<option>-</option>
				<?php
					$sql_allfoodtype = 'SELECT a.id,c.category_name,name,htmlid from allfood AS a INNER JOIN category AS c ON a.category_id=c.id ORDER BY name';
					$res = $mysql->query($sql_allfoodtype);
					while($row = $mysql->fetch($res)){
						echo "<option value=".$row['id'].">".$row['name']."-".$row['category_name']."</option>";
					}
				?>
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
						<label>Storage Place <a href='javascript:void(0);' class="glyphicon glyphicon-question-sign icon_ques"></a>
						</label>
						<select class="form-control" name='place' required>
						<?php
							$sql_splace = "SELECT * FROM storage_method";
							$res = $mysql->query($sql_splace);
							while($row = $mysql->fetch($res)){
								echo "<option value='".$row['id']."'>".$row['place']." - ".$row['method']."</option>";
							}
						?>
						</select>
					</div>
					<div class="form-group">
						<label>Once Opened Used Within...</label>
						<div class="input-group">
							<input type="number" class="form-control" name='expopen' disabled>
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
					<label>Volume Rate: <span id="volrate">100</span>%</label>
					<div class="range">
						<span class="label label-primary">0%</span>
						<input type="range" min="0" max="100" value="100" oninput="volrange(this,'volrate')" name='vol'>
						<span class="label label-primary">100%</span>
					</div>
					</div>
					<div class="form-group">
						<label for="img">Upload a Cover Picture</label>
						<input type="file" id="img" class="form-control" onchange="fileSelected('addfood','foodupload','<?php echo $_SESSION['userid'];?>')"/>
						<div class='progress progress-striped active' id='upres' style="display:none"><label style="position:absolute;width:90%;text-align:center"></label>
							<div class="progress-bar progress-bar-success"></div>
						</div>
						<img src='' style='display:none;' id='thumbnail' height=100>
						<input type="hidden" name='imgname' id="imgname">
					</div>
					<div>	
						<input type="hidden" name='editfoodid'></input>
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
		if(isset($_POST['newfood'])){
			$sql_addfood = "INSERT foodtest VALUE ('','$foodname','$foodcate','$exptype','$exp','$vol',NOW(),'$place','$imgname','{$_SESSION['userid']}')";
			$mysql->query($sql_addfood);
			echo "<script>location.href= confirm('Add food to storage successfully!\\nDo you want to continue adding food?')?'index.php?page=addfood':'index.php?page=food&storage=all'</script>";
		}elseif(isset($_POST['editfoodid'])){
			$editid = inputCheck($_POST['editfoodid']);
			$sql_editfood = "UPDATE foodtest SET name='$foodname',foodcate='$foodcate',exp_type='$exptype',exp='$exp',vol='$vol',place='$place',picpath='$imgname' WHERE id = $editid";
			$mysql->query($sql_editfood);
			echo "<script>location.href='index.php?page=food&storage=all'</script>";
		}
	}
?>
