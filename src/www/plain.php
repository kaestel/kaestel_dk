<?php
$access_item = false;
if(isset($read_access) && $read_access) {
	return;
}

include_once($_SERVER["FRAMEWORK_PATH"]."/config/init.php");

// include the output class for output method support
include_once("class/system/output.class.php");

$action = $page->actions();

$IC = new Item();
$output = new Output();


$page->bodyClass("plain");
$page->pageTitle("Plain");


$page->header();
$page->template("pages/plain.php");
$page->footer();

?>
 