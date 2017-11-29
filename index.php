<?php
	session_start();
	require "inc/db.php";
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
	$page = isset($_GET['page']) ? $_GET['page']:'home';
	
	/*Main Pages*/
	include "inc/header.php";
	include "inc/nav.php";
	if($page=='home'){
		include "app/home.php";
	}else if($page=='1'){
		//include "app/1.php";
	}else if($page=='test'){
		//include "app/test.php";
	}
	include "inc/footer.php";
?>