<table>
<?php
include "inc/db.php";
$vege = array(
["categoty"=>'vegetables',"url"=>'http://www.eatbydate.com/vegetables/fresh-vegetables/asparagus/',"name"=>'Asparagus'],
["categoty"=>'vegetables',"url"=>'http://www.eatbydate.com/vegetables/fresh-vegetables/broccoli/',"name"=>'Broccoli'],
["categoty"=>'vegetables',"url"=>'http://www.eatbydate.com/how-long-do-carrots-last-shelf-life/',"name"=>'Carrots'],
["categoty"=>'vegetables',"url"=>'http://www.eatbydate.com/vegetables/canned-vegetables-shelf-life-expiration-date/',"name"=>'Canned Vegetables'],
["categoty"=>'vegetables',"url"=>'http://www.eatbydate.com/vegetables/canned-vegetables-shelf-life-expiration-date/',"name"=>'Canned Vegetable Soup'],
["categoty"=>'vegetables',"url"=>'http://www.eatbydate.com/vegetables/fresh-vegetables/cauliflower/',"name"=>'Cauliflower'],
["categoty"=>'vegetables',"url"=>'http://www.eatbydate.com/how-long-does-celery-last-shelf-life/',"name"=>'Celery'],
["categoty"=>'vegetables',"url"=>'http://www.eatbydate.com/vegetables/fresh-vegetables/corn/',"name"=>'Corn'],
["categoty"=>'vegetables',"url"=>'http://www.eatbydate.com/vegetables/canned-vegetables-shelf-life-expiration-date/',"name"=>'Corn - Canned '],
["categoty"=>'vegetables',"url"=>'http://www.eatbydate.com/frozen-vegetables-shelf-life-expiration-date/',"name"=>'Corn - Frozen '],
["categoty"=>'vegetables',"url"=>'http://www.eatbydate.com/how-long-do-cucumbers-last-shelf-life-expiration-date/',"name"=>'Cucumbers'],
["categoty"=>'vegetables',"url"=>'http://www.eatbydate.com/frozen-vegetables-shelf-life-expiration-date/',"name"=>'Frozen Vegetables'],
["categoty"=>'vegetables',"url"=>'http://www.eatbydate.com/frozen-vegetables-shelf-life-expiration-date/',"name"=>'Frozen Carrots'],
["categoty"=>'vegetables',"url"=>'http://www.eatbydate.com/frozen-vegetables-shelf-life-expiration-date/',"name"=>'Frozen Corn'],
["categoty"=>'vegetables',"url"=>'http://www.eatbydate.com/frozen-vegetables-shelf-life-expiration-date/',"name"=>'Frozen Peas'],
["categoty"=>'vegetables',"url"=>'http://www.eatbydate.com/frozen-vegetables-shelf-life-expiration-date/',"name"=>'Frozen String Beans'],
["categoty"=>'vegetables',"url"=>'http://www.eatbydate.com/how-long-does-garlic-last-shelf-life',"name"=>'Garlic'],
["categoty"=>'vegetables',"url"=>'http://www.eatbydate.com/vegetables/fresh-vegetables/green-beans/',"name"=>'Green Beans'],
["categoty"=>'vegetables',"url"=>'http://www.eatbydate.com/vegetables/fresh-vegetables/kale/',"name"=>'Kale'],
["categoty"=>'vegetables',"url"=>'http://www.eatbydate.com/how-long-does-lettuce-last',"name"=>'Lettuce'],
["categoty"=>'vegetables',"url"=>'http://www.eatbydate.com/vegetables/fresh-vegetables/mushrooms/',"name"=>'Mushrooms'],
["categoty"=>'vegetables',"url"=>'http://www.eatbydate.com/how-long-do-onions-last-shelf-life/',"name"=>'Onions'],
["categoty"=>'vegetables',"url"=>'http://www.eatbydate.com/vegetables/fresh-vegetables/bell-peppers/',"name"=>'Peppers'],
["categoty"=>'vegetables',"url"=>'http://www.eatbydate.com/other/condiments/how-long-do-pickles-last/',"name"=>'Pickles'],
["categoty"=>'vegetables',"url"=>'http://www.eatbydate.com/other/condiments/how-long-do-pickles-last/',"name"=>'Pickled Peppers'],
["categoty"=>'vegetables',"url"=>'http://www.eatbydate.com/other/condiments/how-long-do-pickles-last/',"name"=>'Pickled Corn'],
["categoty"=>'vegetables',"url"=>'http://www.eatbydate.com/potatoes-shelf-life-expiration-date/',"name"=>'Potatoes'],
["categoty"=>'vegetables',"url"=>'http://www.eatbydate.com/vegetables/fresh-vegetables/parsnips/',"name"=>'Parsnips'],
["categoty"=>'vegetables',"url"=>'http://www.eatbydate.com/how-long-does-pumpkin-last/',"name"=>'Pumpkin'],
["categoty"=>'vegetables',"url"=>'http://www.eatbydate.com/salad-shelf-life-expiration-date/',"name"=>'Salad'],
["categoty"=>'vegetables',"url"=>'http://www.eatbydate.com/vegetables/fresh-vegetables/salsa-shelf-life-expiration-date/',"name"=>'Salsa'],
["categoty"=>'vegetables',"url"=>'http://www.eatbydate.com/other/condiments/how-long-do-pickles-last/',"name"=>'Sauerkraut (Pickled Cabbage)'],
["categoty"=>'vegetables',"url"=>'http://www.eatbydate.com/how-long-does-nori-last-shelf-life/',"name"=>'Seaweed (Nori)'],
["categoty"=>'vegetables',"url"=>'http://www.eatbydate.com/spaghetti-sauce-shelf-life-expiration-date/',"name"=>'Spaghetti Sauce'],
["categoty"=>'vegetables',"url"=>'http://www.eatbydate.com/vegetables/fresh-vegetables/spinach/',"name"=>'Spinach'],
["categoty"=>'vegetables',"url"=>'http://www.eatbydate.com/how-long-does-summer-squash-last/',"name"=>'Summer Squash'],
["categoty"=>'vegetables',"url"=>'http://www.eatbydate.com/how-long-do-sweet-potatoes-or-yams-last/',"name"=>'Sweet Potatoes'],
["categoty"=>'vegetables',"url"=>'http://www.eatbydate.com/tomatoes-shelf-life-expiration-date',"name"=>'Tomatoes'],
["categoty"=>'vegetables',"url"=>'http://www.eatbydate.com/canned-vegetables-shelf-life-expiration-date/',"name"=>'Vegetables - Canned'],
["categoty"=>'vegetables',"url"=>'http://www.eatbydate.com/frozen-vegetables-shelf-life-expiration-date/',"name"=>'Vegetables - Frozen'],
["categoty"=>'vegetables',"url"=>'http://www.eatbydate.com/how-long-does-winter-squash-last/',"name"=>'Winter Squash']
);
function getHtml($url){
	ob_start(); 
	readfile($url);
	$output = ob_get_contents(); 
	ob_end_clean(); 	
	$start = stripos($output,'<table id="unopened">');
	$len = stripos($output,'</tbody></table>')-$start;
	return substr($output,$start+29,$len-29);
}
/* for ($i=0;$i<count($vege);$i++){
	$name = $vege[$i]["name"];
	$url = $vege[$i]["url"];
	$html = getHtml($url);
	$sql0 = "SELECT id,htmlid FROM datehtml WHERE url = '$url'";
	$res0 = $mysql->query($sql0);
	if(mysqli_num_rows($res0)>0){
		$id = $mysql->fetch($res0)[1];
	}else{
		$sql = "INSERT htmlcont VALUES ('','$html')";
		//$mysql->query($sql);
		$id = mysqli_insert_id($mysql->conn);
	}
	$sql1 = "INSERT datehtml VALUES ('',6,'$name','$url',$id)";
	//$mysql->query($sql1);
} */

echo $mysql->oneQuery("SELECT html from htmlcont where id = 4");
?>
</table>