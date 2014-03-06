<?php

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
$fs = new FileSystem();

// make sure folder exist
$fs->makeDirRecursively(PRIVATE_FILE_PATH);

$run_as_test = true;

$from_db = "`think_dk`";
$to_db = "`kaestel_dk`";

$from_files = LOCAL_PATH."/../../think_dk/src/library/private";
$to_files = PRIVATE_FILE_PATH;

// get all products
if($query->sql("SELECT * FROM $from_db.`item_wish`")) {
	$results = $query->results();
	foreach($results as $result) {
//		print_r($result);

		print "# " . $result["item_id"] ." - " . $result["name"] . " - " . $result["description"] . " - " . $result["link"] . " - " . $result["price"] . " - " . $result["reserved"] . " - " . $result["files"] . "<br>";


		// WISH
		$existing_id = $result["item_id"];
		$name = $result["name"];
		$description = $result["description"];
		$link = $result["link"];
		$price = $result["price"];
		$reserved = $result["reserved"];
		$files = $result["files"];

		if($run_as_test) {
			
			if($files && file_exists("$from_files/$existing_id/$files")) {
				print "copy $from_files/$existing_id/$files -> $to_files/NEW_ID/$files<br>";
			}
		}
		else {
			
			// INSERT
			// ITEM
			// create item
			if($query->sql("INSERT INTO $to_db.`items` VALUES(DEFAULT, DEFAULT, 1, 'wish', DEFAULT, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)")) {
				print "Item created<br>";

				$item_id = $query->lastInsertId();

				// create wish
				if($query->sql("INSERT INTO $to_db.`item_wish` VALUES(DEFAULT, $item_id, '$name', '$description', '$link', '$price', '$reserved', '$files')")) {
					print "Wish created<br>";

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
					print "Wish failed ($item_id, $name)<br>";
				
				}


			}
			else {
				print "Item failed (".$result["id"].", ".$result["name"].")<br>";
			}

		}

	}

}

?>