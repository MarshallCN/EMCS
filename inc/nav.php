<div class="col-sm-3 left_wraps">
<nav class="navbar navbar-default nav mynav" role="navigation">
	<h1 class="hidden-xs">EMCS</h1>
	<div class="navbar-main"> 
		<div class="navbar-header">
			<h4 class='col-xs-3 visible-xs lil_header'>EMCS</h4>
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
							<div class="panel-heading" onclick="$('#menu1')[0].click()">
								<a class="panel-title collapsed menuLabel" data-toggle="collapse" data-parent="#inner_menu" id="menu1" href="#panel-element-ticket">
									Food Storage
								</a><span class="caret"></span>
								<span class="icon_dot"></span>
							</div>
							<div id="panel-element-ticket" class="panel-collapse collapse">
								<a href="index.php?page=ticket&action=new" class="menuLabel">
									<div class="panel-body">Refrigerator
										<span class="icon_notification" draggable="true" style="width: 28px;"><span class="icon_num">12</span></span>
									</div>
								</a>
								<a href="index.php?page=ticket&action=all" class="menuLabel">
									<div class="panel-body">Freezing Chamber</div>
								</a>
								<a href="index.php?page=ticket&action=day" class="menuLabel">
									<div class="panel-body">Pantry</div>
								</a>
							</div>
							<div class="panel-heading"  onclick="$('#menu2')[0].click()">
								<a class="panel-title menuLabel" data-toggle="collapse" data-parent="#inner_menu" id="menu2" href="#panel-element-setting">
									Setting
								</a><span class="caret"></span>
								<span class="icon_dot"></span>
							</div>
								<div id="panel-element-setting" class="panel-collapse collapse">
									<a href="####" class="menuLabel">
										<div class="panel-body">System Option</div>
									</a>
									<a href="####" class="menuLabel">
										<div class="panel-body">My Profile</div>
									</a>
								</div>
							
							<div class="panel-heading" onclick="$('#menu_logout')[0].click()">
								<a class="panel-title menuLabel" href='index.php?logout' id="menu_logout">
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
<script>
	function hideMenu(ele){
		/**$('.nav *').animate({width:'0px',opacity:'0'});$('.nav').animate({width:'0px',opacity:'0'},'fast','swing')**/
		//$('.menuLabel').hide()
		//$('.nav').hide(300,'swing')
		$('.left_wraps').hide();
		$(ele).attr('onclick','showMenu(this)');
		$(ele).attr('class','fa fa-3x fa-arrow-circle-right icona hidden-xs');
		$('.main-contain').attr('class','col-sm-10 col-sm-offset-1 main-contain')
		
	}
	function showMenu(ele){
		//$('.menuLabel').show()
		$('.left_wraps').show();
		$(ele).attr('onclick','hideMenu(this)');
		$(ele).attr('class','fa fa-3x fa-arrow-circle-left icona hidden-xs');
		$('.main-contain').attr('class','col-sm-8 main-contain main-contain_left')
	}
</script>
<div class='col-sm-8 main-contain main-contain_left'>

