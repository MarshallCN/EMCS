<?php
 class Mysql{
	function __construct(){
		$this->conn=$this->getConn();
	}
	function getConn(){
        $conn =  mysqli_connect('localhost','root','',"train");
		mysqli_query($conn,"set names gbk");
        return $conn;
    }
	function fetch($result){
        $row = mysqli_fetch_array($result);
        return $row;
    }
	function query($sql){
        $res = mysqli_query($this->conn,$sql);
		return $res;
	}
	function oneQuery($sql){	//Get one value from db
		return $this->fetch($this->query($sql))[0];
	}
}
$mysql = new Mysql();
	function inputCheck($input){	//prevent some of SQL injection and XSS attack
		global $mysql;
		$input=mysql_real_escape_string(htmlspecialchars(strip_tags($input)));
		return $input;
	}
	function redirect($url,$msg=''){	//redirect and alert
		if(empty($msg)){
			echo "<script>location.href='$url';</script>";
		}else{
			echo "<script>alert('$msg');location.href='$url';</script>";
		}
	}
?>
