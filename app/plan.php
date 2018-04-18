<style>
@media (max-width: 767px){
.main-contain{
	padding: 20px 1px 0 1px;
}}
</style>
<div>
	<ul class="nav nav-tabs">
		<li class="active">
			<a href="#panel-recipes" data-toggle="tab" id='recipes'><i class="fa fa-book"></i>&nbsp;Recipes</a>
		</li>
		<li>
			<a href="#panel-assoc" data-toggle="tab" id='assoc'><i class="fa fa-lightbulb-o"></i>&nbsp;Inspiration</a>
		</li>
	</ul>
<!-- Search Recipes -->		
<div class="tab-content" id="foodinfo">
	<div class="tab-pane active" id="panel-recipes">		
		<form action="index.php?page=plan#recipeslist" method="post">
		<div class="form-group col-sm-12" style="padding-top:10px">
		<?php
		//find all the user's food
			$sql_myfood = "SELECT id,name,TIMESTAMPDIFF(DAY,NOW(),exp) AS days FROM food WHERE userid = ".$_SESSION['userid']." order by days";
			$res_myfood = $mysql->query($sql_myfood);
			$myfoods = array();
			$cond = '';
			while($row_myfood = $mysql->fetch($res_myfood)){
				array_push($myfoods,['id'=>$row_myfood['id'],'name'=>$row_myfood['name'],'days'=>$row_myfood['days']]);
				$cond .= " ingredients like '%".$row_myfood['name']."%' AND ";
				echo "<div class='col-md-2 col-sm-4'>
				<label for='sfood_".$row_myfood['id']."' style='cursor:pointer'>".ucfirst(strtolower($row_myfood['name']))." (".$row_myfood['days']."Days): </label>
				<input type='checkbox' name='myfoods[]' id='sfood_".$row_myfood['id']."' value='".$row_myfood['id'].','.$row_myfood['name'].','.$row_myfood['days']."' checked/>
				</div>";
			}
		//collect post data, and create search condition
			if(isset($_POST['myfoods'])){
				$cond = '';
				$foodsinfo='';
				$myfoods = array();
				echo "<script>$('[type=\"checkbox\"]').attr('checked',false)</script>";
				for($i=0;$i<count($_POST['myfoods']);$i++){
					$foodsinfo = explode(",",$_POST['myfoods'][$i]);
					array_push($myfoods,['id'=>$foodsinfo[0],'name'=>$foodsinfo[1],'days'=>$foodsinfo[2]]);
					$cond .= " ingredients like '%".$foodsinfo[1]."%' AND ";
					echo "<script>$('#sfood_".$foodsinfo[0]."').attr('checked',true)</script>";
				}
			}
		?>
			<button type="submit" class="btn btn-warning center-block">Search Recipes</button>
		</div>
		</form>
		<div class="panel-group col-sm-12" id="panel-allrecipe">
			<div class="panel panel-warning" id='recipeslist'>
				<div class="panel-heading">
					<h4>
						<span>Recipes Title</span>
						<span class="hidden-xs col-sm-offset-8 text-center">Ingredients</span>
					</h4>
				</div>
			</div>
			<div class="panel panel-default" style='margin-top:0px;'>
		<?php
			$sql_ids = "SELECT id FROM recipes WHERE $cond 1=1";
		//	$startum = isset($_POST['num'])?$_POST['num']*20:0;
			$startum = 0;
			$sql_recipes = "SELECT r.*,t.items FROM recipes AS r INNER JOIN recipes_tag AS t ON r.id=t.id WHERE r.id in ($sql_ids) ORDER BY r.rating DESC LIMIT $startum,20";
			$res_recipes = $mysql->query($sql_recipes);
			while($row_recipes = $mysql->fetch($res_recipes)){	
		?>
			<div class="panel-heading" onclick="$('#recipe<?php echo $row_recipes['id'];?>')[0].click()" style="border-bottom: 1px solid #dca545;background:#fcf8e3">
				<a class="panel-title collapsed" data-toggle="collapse" data-parent="#panel-allrecipe" id="recipe<?php echo $row_recipes['id'];?>" href="#panel-details<?php echo $row_recipes['id'];?>" style="text-decoration:none;">
					<p>
					<span><?php echo strlen($row_recipes['title'])<=60?$row_recipes['title']:substr($row_recipes['title'],0,60).'...';?></span>
					<span class="hidden-xs pull-right"><?php echo strlen($row_recipes['items'])<50?$row_recipes['items']:substr($row_recipes['items'],0,50);?> ... </span>
					</p>
				</a>
			</div>
			<div id="panel-details<?php echo $row_recipes['id'];?>" class="panel-collapse collapse">
				<table class='table table-default'>
					<tr>
						<th colspan=2>Title: </th>
					</tr>
					<tr>
						<td><?php echo $row_recipes['title'];?></td>
					</tr>
					<tr>
						<th colspan=2>Ingredients: </th>
					</tr>
					<tr>
						<td colspan=2><li><?php echo implode('</li><li>',explode('^',$row_recipes['ingredients']));?></td>
					</tr>
					<tr>
						<th>Rating: </th>
						<td><?php echo $row_recipes['rating'];?></td>
					</tr>
					<tr>
						<th>Calories: </th>
						<td><?php echo $row_recipes['calories'];?></td>
					</tr>
					<tr>
						<th colspan=2>Directions: </th>
					</tr>
					<tr>
						<td colspan=2><li><?php echo implode('</li><li>',explode('^',$row_recipes['directions']));?></td>
					</tr>
					<tr>
						<td colspan=2><button type="submit" class="btn btn-block btn-warning consumefood">Consume Selected Foods</button></td>
					</tr>
				</table>									
			</div>	
		<?php
			}if(mysqli_num_rows($res_recipes)==0){
				echo "<h4>Cannot find recipes, please select few foods</h4>";
				$isempty = true;
			}else{
				echo "Data from <a href='https://www.kaggle.com/hugodarwood/epirecipes' target='_blank'>Epicurious - Kaggle.com</a>";
			}
		?>
			</div>
		</div>
	</div>
	<form method="post" action="index.php?page=plan#recipeslist">
		<input type="hidden" value='' id='removefoodid' name="removefoodid"/>
		<input type="submit" id='removefoods' style="display:none"/>
	</form>
	<?php
		$myfoodnames = '';
		$removefoodid = '';
		if(!isset($isempty)){
			for($i=0;$i<count($myfoods);$i++){
				$food = strtolower($myfoods[$i]['name']);
				$ufood = ucfirst(strtolower($myfoods[$i]['name']));
				$color = "rgba(255,".rand(0,255).",".rand(0,100).",1)";
				echo "<script>
					$(\"#panel-allrecipe:contains('$food')\").html($(\"#panel-allrecipe:contains('$food')\").html().replace(/$food/g, \"<span style='background:$color;'>$food</span>\"))
					$(\"#panel-allrecipe:contains('$ufood')\").html($(\"#panel-allrecipe:contains('$ufood')\").html().replace(/$ufood/g, \"<span style='background:$color;'>$ufood</span>\"))
				</script>";
				$removefoodid .= ','.$myfoods[$i]['id'];
				$myfoodnames .= ','.$myfoods[$i]['name'];
			}
			$removefoodid = substr($removefoodid,1);
			$myfoodnames = substr($myfoodnames,1);
			echo "<script>
			$('#removefoodid').val('$removefoodid');
			$('.consumefood').click(function(){
				if(confirm('Do you want to remove $myfoodnames ?')){
					$('#removefoods').click();
				}
			})</script>";
			if(isset($_POST['removefoodid'])){
				$sql_delfoods = "DELETE FROM food WHERE id in (".$_POST['removefoodid'].")";
				$mysql->query($sql_delfoods);
				for($i=0;$i<count($myfoods);$i++){
					$tags['foodid']=$myfoods[$i]['id'];
					ATrigger::doDelete($tags);
				}
				echo "<script>location.href='index.php'</script>";
			}
		}	
	?>
	<!-- Assoc Rules -->
		<div class="tab-pane" id="panel-assoc">
			<div class="form-group col-sm-6" style="padding-top:10px">
				<label for="#assocfood">Select Your Food to Explore</label>
				<select id="assocfood" class="form-control" @change="searchHeader">
				<?php
					$sql_myfood = "SELECT id,name FROM food WHERE userid = ".$_SESSION['userid']." order by exp";
					$res_myfood = $mysql->query($sql_myfood);
					while($row_myfood = $mysql->fetch($res_myfood)){
						$row_myfood['name'] = ucfirst(strtolower($row_myfood['name']));
						echo "<option value='".$row_myfood['name']."'>".$row_myfood['name']."</label></option>";
					}
				?>
				</select>
			</div>
			<div class="form-group col-sm-6" style="padding-top:10px">
				<label for="#assocfood">Select a Specific Categories</label>
				<select id="assocmore" class="form-control" @change="select2" @click="select2" disabled>
				</select>
			</div>
			<div class="form-group"><h4 id='emptystate'></h4></div>
			<div class="col-sm-10"><canvas id="assocfoodChart" height="300px"></canvas></div>
		</div>
		<script src="static/js/myplanvue.js"></script>
</div>