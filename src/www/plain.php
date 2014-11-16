<?php
$access_item = false;
if(isset($read_access) && $read_access) {
	return;
}

include_once($_SERVER["FRAMEWORK_PATH"]."/config/init.php");


$action = $page->actions();
$IC = new Item();


$page->bodyClass("plain");
$page->pageTitle("Plain");


$page->page(array(
	"templates" => "pages/plain.php"
));

?>
 