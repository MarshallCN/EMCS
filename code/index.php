<?php
	session_start();
	require "inc/db.php";
	require_once("atrigger/ATrigger.php");
	ATrigger::init("xxxxx","xxxxx");
	/*Log out*/
	if(isset($_GET['logout'])){
		unset($_SESSION['user']);
		unset($_SESSION['userid']);
		unset($_SESSION['role']);
		session_destroy();
		header("Location:login.php");
	}
	if(!isset($_SESSION['userid'])){
		header("Location:login.php");
	}
	$page = isset($_GET['page']) ? $_GET['page']:'food';
	
	/*Main Pages*/
	include "inc/header.html";
	include "inc/nav.php";
	if($page=='food'){
		include "app/foodall.php";
	}else if($page=='addfood'){
		include "app/addfood.php";
	}else if($page=='shopping'){
		include "app/shopping.php";
	}else if($page=='plan'){
		include "app/plan.php";
	}else if($page=='setting'){
		include "app/setting.php";
	}
	include "inc/footer.html";
?>