<div>
	<ul class="nav nav-tabs">
		<li class="active">
			<a href="#panel-byfood" data-toggle="tab" id='byfood'><i class="fa fa-window-maximize"></i>&nbsp;Blocks</a>
		</li>
		<li>
			<a href="#panel-request" data-toggle="tab" id='driverequ'><i class="fa fa-table"></i>&nbsp;Table</a>
		</li>
	</ul>
<!-- Manage Food -->		
	<div class="tab-content" id="foodinfo">
		<div class="tab-pane active" id="panel-byfood">
			<p class='emptystate'></p>
			<div class='col-sm-6 myfoodblock' v-for="(item, index) in fooddata" :id="'food'+item.id">
				<img class="col-xs-4" :src="'static/img/foodupload/'+ item.picpath" alt='no picture'>
				<div class="col-xs-8 myfoodtbl">
				<table class='table table-striped'>
					<tr>
						<th>
							Name
						</th>
						<td>
							{{item.name}}
						</td>
					</tr>
					<tr>
						<th>
							Expiration
						</th>
						<td>
							<span v-if="item.days<6" class='label label-danger'>{{item.days}}</span>
							<span v-else>{{item.days}}</span>
							Days
						</td>
					</tr>
					<tr>
						<th>
							Volume
						</th>
						<td>
							{{item.vol}} %
						</td>
					</tr>
					<tr>
						<td colspan=2 class='text-right'>
							<button class='btn btn-default' href="#modal-editfood"  role="button" data-toggle="modal" @click.prevent="editfood(item.id)">Edit</button>
							<button class='btn btn-warning' @click.prevent="removefood(item.id)" >Remove</button>
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
							Name
						</th>
						<th>
							Category
						</th>
						<th>
							Expiration (e.g. Best: 20 days(opened) )
						</th>
						<th>
							Status
						</th>
						<th>
							Volume
						</th>
						<th class='text-center'>
							Operation <a href='javascript:void(0);' onclick="$('#helptip').toggle()" class="glyphicon glyphicon-question-sign icon_ques"></a>
						</th>
					</tr>
				</thead>
				<tbody>
					<tr class='emptystate'></tr>
					<tr v-for="(item, index) in fooddata" :id="'food'+item.id">
						<td>{{item.name}}</td>
						<td>{{item.cate}}</td>
						<td>
							<span v-if="item.exp_type==0">Used By</span>
							<span v-else>Best Before</span>
							<span v-if="item.days<6" class='label label-danger'>{{item.days}}</span>
							<span v-else>{{item.days}}</span>
							days
						</td>
						<td>
							<span v-if="item.open_date!=null"  class='label label-warning'>{{foodstatus[0]}}</span>
							<span v-else>{{foodstatus[1]}}</span>
						</td>
						<td>{{item.vol}}</td>
						<td class='text-right'>
							<a class='label label-primary' href="#modal-editfood"  role="button" data-toggle="modal" @click.prevent="editfood(item.id)">E</a>
							<a class='label label-warning'  @click.prevent="removefood(item.id)">R</a>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	
<!-- Edit Food ModalDialog -->	
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
				<form method="post" id="foodeditform">   
					<div class="form-group">
						<label>Food Name</label>
						<input type="text" class="form-control" name='fname' placeholder="Food Name" required>
					</div>
					<div class="form-group">
						<label>Food Category</label>
						<select class="form-control" name='fcate' required>
							<option value=1>-</option>
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
						<label>Storage Place <a href='javascript:void(0);' class="glyphicon glyphicon-question-sign icon_ques"></a>
						</label>
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
					<div class="form-group col-xs-6">
						<label>Expiration</label>
						<input type="date" class="form-control" name='exp' oninput="checkDate(this)" placeholder="exp" required>
					</div>
					<div class="form-group col-xs-6">
						<label>Exp. Type <a href='javascript:void(0);' onclick="$('#helptip').toggle()" class="glyphicon glyphicon-question-sign icon_ques"></a>
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
						<input type="hidden" name='editfoodid'></input>
						<button type="button" class='btn btn-primary btn-block' onclick='submitform()'><span id='submitting'>Submit</span></button>
					</div>
				</form>
				
			</div>
		</div>					
	</div>				
</div>
<script src="static/js/myvue.js"></script>
<?php
//add/move food into storage	
	if(isset($_POST['fname'])){
		$foodname = inputCheck($_POST['fname']);
		$foodcate = inputCheck($_POST['fcate']);
		$exp = inputCheck($_POST['exp']);
		$exptype = inputCheck($_POST['exptype']);
		$vol = inputCheck($_POST['vol']);
		$place = inputCheck($_POST['place']);
		$expopen = inputCheck($_POST['expopen']);
		$expopenunit = inputCheck($_POST['expopenunit']);
		$imgname = inputCheck($_POST['imgname']);
		$opendate = $_POST['status']==1 ? 'NOW()':'NULL';
		switch($expopenunit){
			case "Days": $unit = 1;break;
			case "Weeks": $unit = 7;break;
			case "Months": $unit =  30;break;
		}
		$opendays = $unit * $expopen;
		if(isset($_POST['newfood'])){
			$sql_addfood = "INSERT food VALUE ('','$foodname','$foodcate','$exptype','$exp','$vol',NOW(),$opendate,'$opendays','$place','$imgname','{$_SESSION['userid']}')";
			$mysql->query($sql_addfood);
			$foodid = mysqli_insert_id($mysql->conn);
		$warndate = date("d/M/Y",strtotime("-3 day",strtotime($exp)));
		$setdate = $warndate.':09:00:00';
		$firstDate = date_create_from_format('d/M/Y:H:i:s', $setdate);
		$msgres = $mysql->query("SELECT msg_chrome,msg_email FROM user WHERE id = ".$_SESSION['userid']);
		$msgSet = $mysql->fetch($msgres);
		if($msgSet[0]==1){
			ATrigger::doCreate("1day", "http://marshal1.tech/FYP/notification.php", ['type'=>'chrome','userid'=>$_SESSION['userid'],'foodid'=>$foodid],$firstDate,3, 3,["userid"=>$_SESSION['userid']]);
		}
		if($msgSet[1]==1){
			$useremail = $mysql->oneQuery("SELECT email FROM user WHERE id =".$_SESSION['userid']);
			$html = htmlspecialchars("<div style='background:#1E3E57;width:100%;height:400px;border-radius:5px;padding:20px'>
			<h3 style='color:#fff'>Your Food $foodname will be expired at</h3>
			<h1 style='color:#FF6384'>$exp</h1><br/>
			<h3 style='color:#fff'>Please use it soon!</h3>
			<a href='https://marshal1.tech/FYP'>Go to EMCS now!</a>
			</div>");
			$postary = [
				"email"=>$useremail,
				"subject"=>"Your $foodname will be expired soon!",
				"body"=>$html,
				"altbody"=>"Your Food $foodname will be expired at $exp \r\n Please use it soon!"
			];
			ATrigger::doCreate("1day", "http://marshal1.tech/FYP/mailer.php", ['type'=>'email','userid'=>$_SESSION['userid'],'foodid'=>$foodid],$firstDate,3, 3,$postary);
		}
			if(isset($_POST['spitemid'])){
				$rmitemid = inputCheck($_POST['spitemid']);
				$sql = "DELETE FROM shopping WHERE id = $rmitemid";
				$mysql->query($sql);
				echo "<script>location.href= confirm('Move food to storage successfully!\\nDo you want to continue Editing Shopping List?')?'index.php?page=shopping':'index.php?page=food&storage=all'</script>";
			}else{
				echo "<script>location.href= confirm('Add food to storage successfully!\\nDo you want to continue adding food?')?'index.php?page=addfood':'index.php?page=food&storage=all'</script>";
			}
		}
		
	}
?>
<?php
	if($page=='food'){
		echo "<script>$('#menu_storage')[0].click();activeclass($('.fplace')[0])</script>";
		if(isset($_GET['p'])){
			echo "<script>$('#".$_GET['p']."').click()</script>";
		}
	}
?>