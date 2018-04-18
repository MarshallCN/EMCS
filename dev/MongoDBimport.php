<?php
require "../inc/db.php"; 
echo "Please check the source code of this file, import function is disabled by author.<br/><br/>";
//#############First attemp, use json_decode, it failed due to exceed memory size###############
function phpImport() {
	$jsonFile = 'full_format_recipes.json';
	$jsonData = json_decode(file_get_contents($jsonFile), true);
	for($i=0;$i<3;$i++){
		print_r($jsonData[$i]);
		$directions = inputCheck(implode('^',$jsonData['directions']));
		$ingredients = inputCheck(implode('^',$res['ingredients']));
		$title = inputCheck($res['title']);
		$sql = "INSERT recipes VALUES ('','$directions','".$res['calories']."','$title','".$res['rating']."','$ingredients')";
		echo $sql.'<br/><br/>';
	}
}
// phpImport(); //do not use it!

//#########Just test MongoDB Connection###############
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

//################# IF Mongo Connects well, following code can import data ##########################

/*** IMPORT ALL DATA ***/
function mongoImport(){
	$m = new MongoClient();
	$coll = $m->recipes->recipes;
	$cursor = $coll->find();
	while($cursor->hasNext()){
		$res = $cursor->getNext();
		$directions = inputCheck(implode('^',$res['directions']));
		$ingredients = inputCheck(implode('^',$res['ingredients']));
		$title = inputCheck($res['title']);
		$sql = "INSERT recipes VALUES ('','$directions','".$res['calories']."','$title','".$res['rating']."','$ingredients')";
		echo $sql.'<br/><br/>';
		//$mysql->query($sql); //Do not re-import again!
	}
}
//mongoImport(); //do not use it!
?>