<div class="col-sm-3 left_wraps">
<nav class="navbar navbar-default nav mynav" role="navigation">
	<a href='index.php' style="text-decoration:none"><h1 class="hidden-xs">EMCS</h1></a>
	<div class="navbar-main"> 
		<div class="navbar-header">
			<a href='index.php' style="text-decoration:none"><h4 class='col-xs-3 visible-xs lil_header'>EMCS</h4></a>
			<button type="button" class="navbar-toggle" data-toggle="collapse"
					data-target="#navbar-collapse">
				<span class="sr-only"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
		<div class="collapse navbar-collapse" id="navbar-collapse">	
					<div class="panel-group" id="inner_menu">
						<div class="panel panel-default">
							<div class="panel-heading" onclick="$('#menu_addfood')[0].click()">
								<a class="panel-title menuLabel" href='index.php?page=addfood' id="menu_addfood">
								<span class="fa fa-plus"></span> Add Food
								</a>
							</div>
							<div class="panel-heading" onclick="$('#menu_storage')[0].click()">
								<a class="panel-title collapsed menuLabel" data-toggle="collapse" data-parent="#inner_menu" id="menu_storage" href="#panel-element-storage">
									Food Storage
								</a><span class="caret"></span>
								<span id='foodnotidot'><span class="icon_dot"></span></span>
							</div>
							<div id="panel-element-storage" class="panel-collapse collapse">
								<a href="####" onclick="activeclass(this);vm.place='1=1';vm.cid=this.id;vm.getall();" id='fp-All' class="menuLabel fplace">
									<div class="panel-body">All <span></span></div>
								</a>
								<a href="####" onclick="activeclass(this);vm.place='place=2';vm.cid=this.id;vm.getall();" id='fp-Refrigerator' class="menuLabel fplace">
									<div class="panel-body">Refrigerator <span></span>
										
									</div>
								</a>
								<a href="####" onclick="activeclass(this);vm.place='place=1';vm.cid=this.id;vm.getall();" id='fp-Freezing' class="menuLabel fplace">
									<div class="panel-body">Freezing Chamber <span></span></div>
								</a>
								<a href="####" onclick="activeclass(this);vm.place='place=3';vm.cid=this.id;vm.getall();" id='fp-Pantry' class="menuLabel fplace">
									<div class="panel-body">Pantry <span></span></div>
								</a>
								<a href="####" onclick="activeclass(this);vm.place='place=5';vm.cid=this.id;vm.getall();" id='fp-Other' class="menuLabel fplace">
									<div class="panel-body">Other <span></span></div>
								</a>
							</div>
							</span>
							<div class="panel-heading" onclick="$('#menu_shopping')[0].click()">
								<a class="panel-title menuLabel" href='index.php?page=shopping' id="menu_shopping">
									Shopping List
								</a>
							</div>
							<div class="panel-heading" onclick="$('#menu_plan')[0].click()">
								<a class="panel-title menuLabel" href='index.php?page=plan' id="menu_plan">
									Meal Plan
								</a>
							</div>
							<div class="panel-heading"  onclick="$('#menu_setting')[0].click()">
								<a class="panel-title menuLabel" href='index.php?page=setting' id="menu_setting" >
									<?php echo $_SESSION['user'];?>'s Setting
								</a>
							</div>
							<div class="panel-heading" onclick="if(confirm('Do you want to log out?')){location.href='index.php?logout'}">
								<a class="panel-title menuLabel" id="menu_logout">
									Log Out
								</a>
							</div>
						</div>
						
					</div>
		</div>
	</div>
</nav>
</div>
<i class="fa fa-3x fa-arrow-circle-left icona hidden-xs" onclick="hideMenu(this)"></i>

<div class='col-sm-8 col-sm-offset-3 main-contain main-contain_left'>
	<div class='col-sm-12' style="padding-bottom:10px">
<?php
	$curpage=($page=='setting')?ucwords($_SESSION['user'])."'s Setting":inputCheck($page);
	echo '<i class="fa fa-home"></i>&nbsp;>&nbsp;'.ucwords($curpage).'&nbsp;>&nbsp;';
	echo "<script>activelabel('$page')</script>";
?>
	</div>
</span>

