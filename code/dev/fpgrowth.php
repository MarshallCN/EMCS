<pre>
<?php
require('../inc/db.php');
	class runtime{
		//to record execution time
        var $StartTime = 0;
        var $StopTime = 0;
        function get_microtime()
        {
            list($usec, $sec) = explode(' ', microtime());
            return ((float)$usec + (float)$sec);
        }

        function start()
        {
            $this->StartTime = $this->get_microtime();
        }

        function stop()
        {
            $this->StopTime = $this->get_microtime();
        }

        function spent()
        {
            return round(($this->StopTime - $this->StartTime), 10);
            //return $this->StopTime - $this->StartTime;
        }
	}
$runtime= new runtime;
$runtime->start();

/* Pre-processing, add tag to each recipe */
function preProcess(){
	global $mysql;
	$sql_allfood = "SELECT distinct name FROM allfood where name != 'uncategorized' group by url";
	$res_allfood = $mysql->query($sql_allfood);
	while($row = $mysql->fetch($res_allfood)){
		$node = $row['name'];
		//have to seperate recipes_tag tbl, due to it cannot update the table in from clause
		$mysql->query("UPDATE recipes_tag SET items = CONCAT(items,',','$node') WHERE recipes_id in (SELECT id FROM recipes WHERE ingredients like '%$node%')");
		//$nodePattern = str_replace(' - ',' ',$node);
		//$nodePattern = '+'.str_replace(' ',' +',$nodePattern);
		//$mysql->query("UPDATE recipes_tags1 SET items = IF(items='','$node',CONCAT(items,',','$node')) WHERE id in (SELECT id FROM recipes1 WHERE MATCH(ingredients) AGAINST ('$node' IN BOOLEAN MODE))");
	}
}
 //preProcess(); //Please do not re-insert

/* FP-Growth */
/* Scan data source, create header table */	
function creHeader(){
	global $mysql;
	global $head;
	$sql_scan1 = "SELECT * FROM recipes_tag";
	$res_scan = $mysql->query($sql_scan1);
	while($row = $mysql->fetch($res_scan)){
		$items = explode(",",$row['items']);
		for($i=1;$i<count($items);$i++){ //first is empty
			//if the item exists in header table, update num
			$node = $items[$i];
			if(isset($head[$node])){
				$head[$node]++;
			}else{
				$head[$node] = 1;
			}
			//The version of Storing in DB
			/* if($res_headers = $mysql->query("SELECT * FROM header WHERE node like '%$node%'")){
				if(mysqli_num_rows($res_headers) > 0){
					$headers = $mysql->fetch($res_headers);
					$hitem_id = $headers['id'];
					$mysql->query("UPDATE header SET num = num +1 WHERE id = '$hitem_id'");
				//else, add new item
				}else{
					$mysql->query("INSERT header(node,num) VALUE('$node','1')");
				}
			} */
		}
	}
}
 creHeader(); //Please do not re-create 

/* Order Header table */
$headers = [];
function ordHeader(){
	global $mysql;
	global $head;
	global $headers;
	arsort($head);
	foreach($head as $node=>$sup){
		if($sup >= 3){ //MIN SUPPORT is 3
			$headers[$node] = $sup;
		}
	}
	//DB Version
	/* $sql_headers = "SELECT * FROM header ORDER BY num DESC";
	$res_headers = $mysql->query($sql_headers);
	while($row = $mysql->fetch($res_headers)){
		if($row['num']>=3){ //MIN SUPPORT is 3
			$headers[$row['node']] = $row['num'];
		}
	} */
}

ordHeader();
//print_r($headers); // It will print all data from header table

/* Order item according to headers table */
function compareAB($a,$b){
	global $headers;
	if(isset($headers[$a])&&isset($headers[$b])){
		if($headers[$a]>=$headers[$b]){
			return -1;
		}else{
			return 1;
		}
	}
}

/* Second scan DB, Build FP-Tree */
/* function buildTree(){
	global $mysql;
	global $headers;
	$sql_scan2 = "SELECT * FROM recipes_tag";
	$res_scan = $mysql->query($sql_scan2);
	$mysql->query("INSERT fptree VALUE('','Root',' ','0')");
	while($row = $mysql->fetch($res_scan)){
		$items = explode(",",$row['items']);
		array_shift($items);
		//order data source according to the header table
		usort($items,"compareAB");
		$path = 'Root';	
		for($v=0;$v<count($items);$v++){ //all items in each transaction
			$node = $items[$v];
			if(isset($headers[$node])){
				$sql_search = "SELECT * FROM fptree WHERE path = '$path' AND node = '$node'";
				if($res_search = $mysql->query($sql_search)){
					if(mysqli_num_rows($res_search)>0){
					//Update exsiting node
						$nodeinfo = $mysql->fetch($res_search);
						$nodeid = $nodeinfo['id'];
						$sql_update = "UPDATE fptree SET num = num+1 WHERE id = $nodeid";
						$mysql->query($sql_update);
					}else{
					//Create new node from root
						$sql_add = "INSERT fptree(node,path,num) VALUES('$node','$path','1')";
						$mysql->query($sql_add);
					}
				}
				$path .= "/$node";
			} 
		}
		$cid = $row['id'];
	}
	echo 'Processed Record: '.$cid.'<br/>';
} */
function buildTreeInMemory(){
	global $mysql;
	global $headers;
	$sql_scan2 = "SELECT * FROM recipes_tag";
	$res_scan = $mysql->query($sql_scan2);
	global $fptree;
	$fptree = array('Root'=>[' '=>0]); //['node'=>['path'=>'num','path1'=>'num']]
	while($row = $mysql->fetch($res_scan)){
		$items = explode(",",$row['items']);
		array_shift($items);//delete ,
		//order data source according to the header table
		usort($items,"compareAB");
		$path = 'Root';	
		for($v=0;$v<count($items);$v++){ //all items in each transaction
			$node = $items[$v];
			//MIN SUPPORT is 3
			if(isset($headers[$node])){
				if(isset($fptree[$node])){
					if(isset($fptree[$node][$path])){
						//Update exsiting node
						$fptree[$node][$path]++;
					}else{
						//Create new node
						$fptree[$node][$path] = 1;
					}
				}else{
					//Create new node from root
						$fptree[$node][$path] = 1;
				}
				$path .= "/$node";
			}
		}
	}
}
//This will create in FP-Tree meory and not store in DB
buildTreeInMemory();
//echo count($fptree);
//print_r($fptree);


//	buildTree(); //Do not re-create again please!


/* Mining FP-Tree，From the last item of header table, find each path，count nodes, delete node < min threshold */
 /* function mineTree($test){
	global $mysql;
	global $subTree;
	$sql_headers_trim = "SELECT * FROM header WHERE num>=3 ORDER BY num ASC";
	$res_headers_trim = $mysql->query($sql_headers_trim);
	while($row_fp = $mysql->fetch($res_headers_trim)){
		$mineNode = $row_fp['node'];
		//To Find CBP(conditional base pattern)
		$sql_conTree = "SELECT * FROM fptree WHERE node = '$mineNode'";
		$res_conTree = $mysql->query($sql_conTree);
		$subTree[$mineNode] = [];//Only shows the sub-tree, hard to manipulate
		while($row = $mysql->fetch($res_conTree)){
			$initNum = $row['num'];
			$sub_path = explode("/",$row['path']);
			for($i=0;$i<count($sub_path);$i++){ //$i=0 means the node->root, which is its own support value
				$sql_find = "SELECT COUNT(*) FROM subtree1 WHERE node = '$mineNode' AND assoc = '".$sub_path[$i]."'";
				if($test=='test'){
					if(array_key_exists($sub_path[$i],$subTree[$mineNode])){ //$subTree is only used for testing
						$subTree[$mineNode][$sub_path[$i]] += $initNum;
					}else{
						$subTree[$mineNode][$sub_path[$i]] = $initNum;
					}
				}elseif($test=='real'){
					if($mysql->oneQuery($sql_find) > 0){
						//Update existing node	
						$mysql->query("UPDATE subtree1 SET num = num+$initNum WHERE node = '$mineNode' AND assoc = '".$sub_path[$i]."'");
					}else{
						//New node	
						$mysql->query("INSERT subtree1 (node,assoc,num) VALUES ('$mineNode','".$sub_path[$i]."','$initNum')");
					}
				}
			}
		}
	}
}  */

function mineTreeInMemory($test){ //To Find CBP(conditional base pattern)
	global $mysql;
	global $fptree;
	global $subTree;
	global $headers;
	asort($headers);
	foreach($headers as $hnode=>$hnum){
		$mineNode = $hnode;
		$subTree[$mineNode] = [];//Only shows the sub-tree
		foreach($fptree[$mineNode] as $path=>$num){
			$initNum = $num;
			$sub_path = explode("/",$path);
			for($i=0;$i<count($sub_path);$i++){ //$i=0 means the node->root, which is its own support value
				$sql_find = "SELECT COUNT(*) FROM subtree1 WHERE node = '$mineNode' AND assoc = '".$sub_path[$i]."'";
				if($test=='test'){
					if(array_key_exists($sub_path[$i],$subTree[$mineNode])){ //$subTree is only used for testing
						$subTree[$mineNode][$sub_path[$i]] += $initNum;
					}else{
						$subTree[$mineNode][$sub_path[$i]] = $initNum;
					}
				}elseif($test=='real'){
					if($mysql->oneQuery($sql_find) > 0){
						//Update existing node	
						$mysql->query("UPDATE subtree1 SET num = num+$initNum WHERE node = '$mineNode' AND assoc = '".$sub_path[$i]."'");
					}else{
						//New node	
						$mysql->query("INSERT subtree1 (node,assoc,num) VALUES ('$mineNode','".$sub_path[$i]."','$initNum')");
					}
				}
			}
		}
	}
}

 // This will create in Subb-Tree meory and not store in DB
	mineTreeInMemory('test');

$s=0;
foreach($subTree as $k=>$v){
	foreach($v as $x=>$y){
		$s++;
	}
}
echo "Subtree record:". $s;

 //mineTree('test'); //Please do not re-create subtree table again, it may crack your browser due to your default max_execution time

$runtime->stop();
echo "<br/>Time: ".$runtime->spent()." s<br/>";

print_r($subTree);
?>
</pre>