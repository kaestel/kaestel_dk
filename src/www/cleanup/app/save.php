<?php

$access_item = false;

if(isset($read_access) && $read_access) {
	return;
}

include_once($_SERVER["PAGE_PATH"]."/page.class.php");
$page->addObject("items/item.class.php");

$name = getVar("name");
$html = getVar("html");

$timestamp = getVar("timestamp");
$latitude = getVar("latitude");
$longitude = getVar("longitude");


// attempt to save
if($id = $page->getObject("Item")->save("log", userid, 1, )) {

	// done
}
else {

	// error
}

?>