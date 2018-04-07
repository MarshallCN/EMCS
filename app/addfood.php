				<form method="post" action="index.php?p=fp-All">   
					<div class="form-group">
						<label>Food Name</label>
						<input type="text" class="form-control" name='fname' placeholder="Food Name" required>
					</div>
					<div class="form-group">
						<label>Food Category</label>
						<select class="form-control" name='fcate' required>
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
								<button type="button" class="btn btn-default dropdown-toggle" id='expbtn' data-toggle="dropdown">
									Days 
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu pull-right expopen">
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
					<div class="form-group" style="margin-top:40px">	
						<button class='btn btn-primary btn-block' name="newfood" style="height:60px">Submit</button>
					</div>
				</form>