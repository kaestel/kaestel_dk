<?php

$access_item["/"] = true;
if(isset($read_access) && $read_access) {
	return;
}

include_once($_SERVER["FRAMEWORK_PATH"]."/config/init.php");


$IC = new Item();
$query = new Query();
$fs = new FileSystem();


// UPDATING LOG TABLE

// $itemtype = "log";
// $model = $IC->typeObject($itemtype);
// $query->checkDbExistance($model->db_mediae);
// $query->sql("SELECT item_id, files FROM ".$model->db);
// $results = $query->results();
//
// foreach($results as $result) {
//
// //	print $result["files"] . "<br>";
// 	if($result["files"]) {
//
// 		$item_id = $result["item_id"];
// 		$format = $result["files"];
//
// 		$image = new Imagick(PRIVATE_FILE_PATH."/".$item_id."/".$format);
// 		//
// 		// // check if we can get relevant info about image
// 		$width = $image->getImageWidth();
// 		$height = $image->getImageHeight();
// 		$variant = randomKey(8);
// 		$name = $format;
//
// 		// insert into new table
// 		$sql = "INSERT INTO ".$model->db_mediae." VALUES(DEFAULT, $item_id, '$name', '$format', '$variant', '$width', '$height', 0)";
// 		$query->sql($sql);
//
// 		// move image to new folder
// 		$fs->makeDirRecursively(PRIVATE_FILE_PATH."/".$item_id."/".$variant);
//
// 		copy(PRIVATE_FILE_PATH."/".$item_id."/".$format, PRIVATE_FILE_PATH."/".$item_id."/".$variant."/".$format);
// 		unlink(PRIVATE_FILE_PATH."/".$item_id."/".$format);
// 		$fs->removeDirRecursively(PUBLIC_FILE_PATH."/".$item_id);
//
// 	}
// }
//
// print "You can now delete 'files' column in ".$model->db."<br>";



// UPDATING WISH TABLE

// $itemtype = "wish";
// $model = $IC->typeObject($itemtype);
// $query->checkDbExistance($model->db_mediae);
// $query->sql("SELECT item_id, files FROM ".$model->db);
// $results = $query->results();
//
// //print_r($results);
// foreach($results as $result) {
//
// //	print $result["files"] . "<br>";
// 	if($result["files"]) {
//
// 		$item_id = $result["item_id"];
// 		$format = $result["files"];
//
// 		$image = new Imagick($files[0]);
//
// 		// check if we can get relevant info about image
// 		$width = $image->getImageWidth();
// 		$height = $image->getImageHeight();
// 		$variant = randomKey(8);
// 		$name = $format;
//
// 		// insert into new table
// 		$sql = "INSERT INTO ".$model->db_mediae." VALUES(DEFAULT, $item_id, '$name', '$format', '$variant', '$width', '$height', 0)";
// 		print $sql."<br>";
//
// 		$query->sql($sql);
//
// 		// move image to new folder
// 		$fs->makeDirRecursively(PRIVATE_FILE_PATH."/".$item_id."/".$variant);
//
// 		copy(PRIVATE_FILE_PATH."/".$item_id."/".$format, PRIVATE_FILE_PATH."/".$item_id."/".$variant."/".$format);
// 		unlink(PRIVATE_FILE_PATH."/".$item_id."/".$format);
// 		$fs->removeDirRecursively(PUBLIC_FILE_PATH."/".$item_id);
//
// 	}
// }
//
// print "You can now delete 'files' column in ".$model->db."<br>";


// recreating lost items
$itemtype = "wishlist";
$model = $IC->typeObject($itemtype);
$query->sql("SELECT item_id, name FROM ".$model->db);
$results = $query->results();

//print_r($results);
foreach($results as $result) {

	$item_id = $result["item_id"];

	$sindex = $IC->sindex($item_id, $result["name"]);
	$sql = "INSERT INTO ".UT_ITEMS." VALUES($item_id, '$sindex', 1, 'wishlist', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
	print $sql."<br>";
	$query->sql($sql);

}

$itemtype = "todolist";
$model = $IC->typeObject($itemtype);
$query->sql("SELECT item_id, name FROM ".$model->db);
$results = $query->results();

//print_r($results);
foreach($results as $result) {

	$item_id = $result["item_id"];

	$sindex = $IC->sindex($item_id, $result["name"]);
	$sql = "INSERT INTO ".UT_ITEMS." VALUES($item_id, '$sindex', 1, 'todolist', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
	print $sql."<br>";
	$query->sql($sql);

}

$itemtype = "todo";
$model = $IC->typeObject($itemtype);
$query->sql("SELECT item_id, name FROM ".$model->db);
$results = $query->results();

//print_r($results);
foreach($results as $result) {

	$item_id = $result["item_id"];

	$sindex = $IC->sindex($item_id, $result["name"]);
	$sql = "INSERT INTO ".UT_ITEMS." VALUES($item_id, '$sindex', 1, 'todo', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
	print $sql."<br>";
	$query->sql($sql);

}


?>