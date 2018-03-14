<?php
die();
require "inc/db.php"; 
/* try{
$mongo = new Mongo(); //create a connection to MongoDB
$databases = $mongo->listDBs(); //List all databases
echo '<pre>';
print_r($databases);
$mongo->close();
} catch(MongoConnectionException $e) {
//handle connection error
die($e->getMessage());
} */
$m = new MongoClient();
$coll = $m->recipes->recipes;

/* $cursor = $coll->find(['postby'=>'Staff Mike'],['_id'=>1,'title'=>1])->limit(10);
while($cursor->hasNext()){
	$res = $cursor->getNext();
	echo "<p>".$res['_id']."</p>";
	echo "<p>".$res['title']."</p>";
} */

/* 
$json = '{"title":"Marketing Report 2017"}'; //不能嵌入时间对象
$ary = json_decode($json);
//$cursor = $coll->findOne($ary);

$timestamp = new MongoDate(strtotime('2018/02/01'));
//$cursor = $coll->findOne(["title"=>"Marketing Report 2017","postdate"=>["\$gt"=>$timestamp]]);
//print_r($cursor); */


/*** IMPORT ALL DATA***/
/* $cursor = $coll->find();
while($cursor->hasNext()){
	$res = $cursor->getNext();
	$directions = inputCheck(implode('^',$res['directions']));
	$ingredients = inputCheck(implode('^',$res['ingredients']));
	$title = inputCheck($res['title']);
	$sql = "INSERT recipes VALUES ('','$directions','".$res['calories']."','$title','".$res['rating']."','$ingredients')";
	$mysql->query($sql);
	echo "suc"."<br/>";
}  */





?>