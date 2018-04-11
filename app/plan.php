<div>
	<ul class="nav nav-tabs">
		<li class="active">
			<a href="#panel-recipes" data-toggle="tab" id='recipes'><i class="fa fa-book"></i>&nbsp;Recipes</a>
		</li>
		<li>
			<a href="#panel-assoc" data-toggle="tab" id='assoc'><i class="fa fa-lightbulb-o"></i>&nbsp;Inspiration</a>
		</li>
	</ul>
<!-- Manage Food -->		
	<div class="tab-content" id="foodinfo">
	<div class="tab-pane active" id="panel-recipes">
		<div class="panel-group" id="panel-allrecipe">
			<div class="panel  panel-warning">
				<div class="panel-heading">
					<h4>
						<span>Recipes</span>
						<span class="hidden-xs col-sm-offset-8 text-center">Ingredients</span>
					</h4>
				</div>
			</div>
			<div class="panel panel-default" style='margin-top:0px;'>
		<?php
			//$sql_myfood = "SELECT name,TIMESTAMPDIFF(DAY,NOW(),IF(open_date<exp,open_date,exp)) AS days FROM food WHERE userid = ".$_SESSION['userid']." order by days";
			$sql_myfood = "SELECT name,TIMESTAMPDIFF(DAY,NOW(),exp) AS days FROM food WHERE userid = ".$_SESSION['userid']." order by days";
			//使用allfood的food category name 而不是用户自定义名字？
			$res_myfood = $mysql->query($sql_myfood);
			$myfoods = array();
			$cond = '';
			$conds = array();
			while($row_myfood = $mysql->fetch($res_myfood)){
				array_push($myfoods,['name'=>$row_myfood['name'],'days'=>$row_myfood['days']]);
				$cond .= " ingredients like '%".$row_myfood['name']."%' AND ";
			}
			$id_count = $mysql->oneQuery("SELECT count(*) FROM recipes WHERE $cond 1=1");
			if($id_count==0){
				$cond = '';
				//如何剔除条件？随机数？
				$myfoods[1]['name'] = '';
				for($i=0;$i<count($myfoods)-2;$i++){
					$cond .= " ingredients like '%".$myfoods[$i]['name']."%' AND ";
					
				}
				//循环排列组合条件
				/* for($i=0;$i<count($myfoods);$i++){	
				$cond .= " ingredients like '%".$myfoods[$i]['name']."%' AND ";
				} */
			}
			echo $cond;
			$sql_ids = "SELECT id FROM recipes WHERE $cond 1=1";
			//echo mysqli_num_rows($res_ids);
			$sql_recipes = "SELECT r.*,t.items FROM recipes AS r INNER JOIN recipes_tag AS t ON r.id=t.id WHERE r.id in ($sql_ids) ORDER BY r.rating DESC LIMIT 20";
			$res_recipes = $mysql->query($sql_recipes);
			while($row_recipes = $mysql->fetch($res_recipes)){	
		?>
			<div class="panel-heading" onclick="$('#recipe<?php echo $row_recipes['id'];?>')[0].click()" style="border-bottom: 1px solid #dca545">
				<a class="panel-title collapsed" data-toggle="collapse" data-parent="#panel-allrecipe" id="recipe<?php echo $row_recipes['id'];?>" href="#panel-details<?php echo $row_recipes['id'];?>" style="text-decoration:none;">
					<p>
					<span><?php echo strlen($row_recipes['title'])<=60?$row_recipes['title']:substr($row_recipes['title'],0,60).'...';?></span>
					<span class="hidden-xs pull-right"><?php echo strlen($row_recipes['items'])<50?$row_recipes['items']:substr($row_recipes['items'],0,50);?> ... </span>
					</p>
				</a>
			</div>
			<div id="panel-details<?php echo $row_recipes['id'];?>" class="panel-collapse collapse">
				<table class='table table-striped'>
					<tr>
						<th colspan=2>Ingredients: </th>
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
				</table>									
			</div>	
		<?php
			}
		?>
			</div>
		</div>
	</div>
	<!-- Table View -->
		<div class="tab-pane" id="panel-assoc">
			<div class="form-group">
				<div class="range">
					<span class="label label-primary">More Accurate</span>
						<input type="range" min="0" max="100" value="0" name='num'>
					<span class="label label-primary">More Options</span>
				</div>
			</div>
		</div>
	</div>