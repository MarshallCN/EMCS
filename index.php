<?php
	session_start();
	require "inc/db.php";
	require_once("atrigger/ATrigger.php");
	ATrigger::init("4989200868836991246","f5lI15uo41pYL7aY5QNkYq7h5bC7Y6");
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
	include "inc/header.php";
	include "inc/nav.php";
	if($page=='food'){
		$storage = isset($_GET['storage']) ? $_GET['storage']:'all';
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
	include "inc/footer.php";
?>