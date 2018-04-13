<div class="tabbable" id="tabs-article" style='padding-top:10px;'>
	<ul class="nav nav-tabs">
		<li class="active">
			<a href="#panel-show" data-toggle="tab" id='show'><i class="fa fa-list-ul"></i>&nbsp;Shooping List</a>
		</li>
		<li>
			<a href="#panel-add" data-toggle="tab" id='add'><i class="fa fa-plus"></i>&nbsp;<span id='splabel'>Add New </span>Item</a>
		</li>
	</ul>
<!-- Manage Food -->		
	<div class="tab-content">
		<div class="tab-pane active" id="panel-show">
			<table class='table table-striped'>
				<thead>
					<tr>
						<th>#</th>
						<th>Food</th>
						<th>Amount</th>
						<th>Bought</th>
						<th>Operation</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$sql_splist = "SELECT * FROM shopping WHERE userid = ".$_SESSION['userid'];
					$res = $mysql->query($sql_splist);
					if(mysqli_num_rows($res)==0){
						echo "<tr><thd><p class='emptystate'>No items yet</p></th><tr>";
					}else{
						$itemid = 0;
						while($row = $mysql->fetch($res)){
							$itemid++;
							$isbuy = $row['isbuy']==1 ? 'fa-check-circle-o':'fa-circle-o';
							$isdisable = $row['isbuy']==1 ? '':'disabled';
							echo "<tr id='sptr".$row['id']."'>
								<td>$itemid</td>
								<td>".$row['name']."</td>
								<td>".$row['note']."</td>
								<td><i class='fa $isbuy fa-3x' style='cursor:pointer' onclick='checkshop(this,".$row['id'].",".$row['isbuy'].")'></i></td>
								<td>
									<button class='btn btn-info' href='#modal-movefood' role='button' data-toggle='modal' onclick='moveitem(".$row['id'].",\"".$row['name']."\")' $isdisable>Move</button>
									<button class='btn btn-primary' onclick='edititem(".$row['id'].")'>Edit</button>
									<button class='btn btn-warning' onclick='rmitem(".$row['id'].")'>Remove</button>
								</td></tr>";
						}
					}
				?>
				</tbody>
			</table>
			<div class="modal" id="modal-movefood">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h4 class="modal-title">
								Move To Storage
							</h4>
						</div>
						<div class="modal-body">
							<form method="post" action="index.php?page=food&storage=all">
								<div class="form-group">
									<label>Food Name</label>
									<input type="text" class="form-control" name='fname' oninput="searchfood();showexp()" placeholder="Food Name" required>
								</div>
								<div class="form-group">
									<label>Food Category</label>
									<select class="form-control" name='fcate' onchange='showexp()' onclick='showexp()' required>
										<option>-</option>
							<?php
								$sql_allfoodtype = 'SELECT a.id,c.category_name,name,html_id from allfood AS a INNER JOIN category AS c ON a.category_id=c.id ORDER BY name';
								$res = $mysql->query($sql_allfoodtype);
								while($row = $mysql->fetch($res)){
									echo "<option value=".$row['id'].">".$row['name']."-".$row['category_name']."</option>";
								}
							?>
									</select>
								</div>
								<div class="form-group">
									<label>Storage Place </label>
									<select class="form-control" name='place' required>
									<?php
										$sql_splace = "SELECT * FROM storage_method order by method";
										$res = $mysql->query($sql_splace);
										while($row = $mysql->fetch($res)){
											echo "<option value='".$row['id']."'>".$row['place']." - ".$row['method']."</option>";
										}
									?>
									</select>
								</div>
								<div class='helptip' id='helptip' onclick="$(this).hide()" style="display:none">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
									<table class='table table-bordered'></table>
									<div>Data From: <a href="http://www.eatbydate.com" target="_blank">EatByDate</a></div>
								</div>
								<div class='helptip' id='exptip' onclick="$(this).hide()" style="display:none">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
									<dl>
										<dt class="font-weight-bold">Best Before</dt>
										<dd>The date of the best quality, food may still be eatable after the date expires</dd>
										<dt class="font-weight-bold">Used By</dt>
										<dd>The real expiration date! Don't eat it after the date expires</dd>
									<dl>
								</div>
								<div class="form-group col-xs-6">
									<label>Expiration <a href='javascript:void(0);' onclick="$('#helptip').toggle();$('#exptip').hide()" class="glyphicon glyphicon-question-sign icon_ques"></a>
									</label>
									<input type="date" class="form-control" name='exp' oninput="checkDate(this)" placeholder="exp" required>
								</div>
								<div class="form-group col-xs-6">
									<label>Exp. Type <a href='javascript:void(0);' onclick="$('#helptip').toggle();$('#exptip').show()" class="glyphicon glyphicon-question-sign icon_ques"></a>
									</label>
									<select class="form-control" name='exptype'>
										<option value='0'>Used By</option>
										<option value='1'>Best Before</option>
									</select>
								</div>
								<div class="form-group col-xs-6">
									<label>Food Status
									</label>
									<select class="form-control" name='status'>
										<option value='0'>Unopened</option>
										<option value='1'>Opened</option>
									</select>
								</div>
								<div class="form-group col-xs-6">
									<label>Once Opened Used Within...</label>
									<div class="input-group">
										<input type="number" class="form-control" name='expopen' oninput="onlynum(this)">
										<input type="hidden" name='expopenunit' value="Days">
										<div class="input-group-btn">
											<button type="button" class="btn btn-default dropdown-toggle" id="expbtn" data-toggle="dropdown">
												Days 
												<span class="caret"></span>
											</button>
											<ul class="dropdown-menu pull-right">
												<li><a onclick="changeunit(this)">Days</a></li>
												<li><a onclick="changeunit(this)">Weeks</a></li>
												<li><a onclick="changeunit(this)">Months</a></li>
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
									<input type="hidden" name="spitemid">
									<button class='btn btn-primary btn-block' name="newfood">Submit</button>
								</div>
							</form>
						</div>
					</div>					
				</div>				
			</div>
		</div>
		<div class="tab-pane" id="panel-add">
			<form method="post">
				<div class="form-group">
					<label>Food Name</label>
					<input type="text" class="form-control" name='newname' placeholder="Food Name" maxlength=200 required>
				</div>
				<div class="form-group">
					<label>Shopping Notes</label>
					<input type="text" class="form-control" name='newnote' placeholder="Food Name" maxlength=200>
				</div>
				<div>	
					<button class='btn btn-primary btn-block' id='spsubmit'>Submit</button>
					<span id='editspbtns'>
						<input type="hidden" name='editspitemid'>
						<div class="col-sm-6"><button class='btn btn-primary btn-block' name="editsplist">Edit</button></div>
						<div class="col-sm-6"><button class='btn btn-danger btn-block' type='reset' onclick="location.href='index.php?page=shopping'">Cancel</button></div>
					</span>
				</div>
			</form>
		</div>
	</div>
<?php
	if(isset($_POST['newname'])){
		$newname = inputCheck($_POST['newname']);
		$newnote = inputCheck($_POST['newnote']);
		if(!isset($_POST['editsplist'])){
			$sql = "INSERT shopping VALUES ('','$newname','$newnote',0,'".$_SESSION['userid']."')";
			$mysql->query($sql);
			echo "<script>alert('add new item successfully');location.href='index.php?page=shopping'</script>";
		}else{
			$id = inputCheck($_POST['editspitemid']);
			$sql = "UPDATE shopping set name = '$newname', note = '$newnote' WHERE id = '$id'";
			$mysql->query($sql);
			echo "<script>alert('Edit item successfully');location.href='index.php?page=shopping'</script>";
		}	
	}
	if(isset($_POST['spitemid'])){
		$spitemid = inputCheck($_POST['spitemid']);
		$sql_del = "DELETE FROM shopping WHERE id = $spitemid";
		//$mysql->query($sql_del);

	}
?>