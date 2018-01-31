<?php
include "inc/db.php";
$sql = "INSERT tstbl VALUES ('','name1')";
$mysql->query($sql);
$con = $mysql->conn;
echo mysqli_insert_id($con);