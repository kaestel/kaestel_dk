<?php
$access_item = false;
if(isset($read_access) && $read_access) {
	return;
}

//include_once($_SERVER["FRAMEWORK_PATH"]."/config/file_paths.php");
include_once($_SERVER["FRAMEWORK_PATH"]."/config/init.php");

@mysql_pconnect("localhost", "root", "c0nte9do") or header("Location: /404.php?error=DB");

// correct the database connection setting
mysql_query("SET NAMES utf8");
mysql_query("SET CHARACTER SET utf8");

include_once("include/functions.inc.php");

include_once("class/system/query.class.php");
include_once("class/system/filesystem.class.php");
include_once("class/items/item.class.php");


$query = new Query();
$IC = new Item();
$fs = new FileSystem();

// make sure folder exist
$fs->makeDirRecursively(PRIVATE_FILE_PATH);

$run_as_test = false;

$from_db = "`old_think`";
$to_db = "`kaestel_dk`";

$from_files = LOCAL_PATH."/../../think_dk/src/library/private";
$to_files = PRIVATE_FILE_PATH;

// get all products
if($query->sql("SELECT * FROM $from_db.`itemtype_log`")) {
	$results = $query->results();
	foreach($results as $result) {
//		print_r($result);

		print "# " . $result["item_id"] ." - " . $result["name"] . " - " . $result["html"] . " - " . $result["latitude"] . " - " . $result["longitude"] . " - " . $result["timestamp"] . "<br>";


		// WISH
		$existing_id = $result["item_id"];
		$name = prepareForDB($result["name"]);
		$html = prepareForDB($result["html"]);
		$latitude = $result["latitude"];
		$longitude = $result["longitude"];
		$timestamp = $result["timestamp"];
		$files = false;
//		$files = $result["files"];

		if($run_as_test) {
			
			if($files && file_exists("$from_files/$existing_id/$files")) {
				print "copy $from_files/$existing_id/$files -> $to_files/NEW_ID/$files<br>";
			}
		}
		else {
			
			// INSERT
			// ITEM
			// create item
			if($query->sql("INSERT INTO $to_db.`items` VALUES(DEFAULT, DEFAULT, 1, 'log', DEFAULT, '".$result["timestamp"]."', CURRENT_TIMESTAMP, '".$result["timestamp"]."')")) {
				print "Item created<br>";

				$item_id = $query->lastInsertId();

				// create wish
				$sql = "INSERT INTO $to_db.`item_log` VALUES(DEFAULT, $item_id, '$name', '$html', '', '$latitude', '$longitude', NULL)";
				print $sql;
				if($query->sql($sql)) {
					print "Log created<br>";

					// create sindex
					$IC->sindex($item_id);

					// add file
					if($files) {

						if(file_exists("$from_files/$existing_id/$files")) {
							// copy
							$fs->makeDirRecursively("$to_files/$item_id");

							if($cp = copy("$from_files/$existing_id/$files", "$to_files/$item_id/$files")) {
								print "file added<br>";
							}
							else {
								print "file failed ($item_id, ($from_files/$existing_id/$files) -> ($to_files/$item_id/$files))<br>";
							}
						}
						else {
							print "file missing ($item_id, ($from_files/$existing_id/$files) -> ($to_files/$item_id/$files))<br>";
						}

					}
				}
				else {
					print "Log failed ($item_id, $name)<br>";
				
				}


			}
			else {
				print "Item failed (".$result["id"].", ".$result["name"].")<br>";
			}

		}

	}

}

?>