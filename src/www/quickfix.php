<?php

$access_item["/"] = true;
if(isset($read_access) && $read_access) {
	return;
}

include_once($_SERVER["FRAMEWORK_PATH"]."/config/init.php");


$IC = new Item();
$query = new Query();
$fs = new FileSystem();



// UPDATING WISH TABLE

$itemtype = "wish";
$model = $IC->typeObject($itemtype);
$query->checkDbExistance($model->db_mediae);
$query->sql("SELECT item_id FROM ".$model->db);
$results = $query->results();

//print_r($results);
foreach($results as $result) {

//	print $result["files"] . "<br>";
	if($result["item_id"]) {

		$item_id = $result["item_id"];

		$files = $fs->files(PRIVATE_FILE_PATH."/".$item_id);
		
		$variant = preg_replace("/\/jpg|\/png/", "", str_replace(PRIVATE_FILE_PATH."/".$item_id."/", "", $files[0]));

		$sql = "UPDATE ".$model->db_mediae." SET variant = '$variant' WHERE item_id = $item_id";
		print $sql."<br>";
		$query->sql($sql);

		$fs->removeDirRecursively(PUBLIC_FILE_PATH."/".$item_id);

	}
}

print "You can now delete 'files' column in ".$model->db."<br>";



?>