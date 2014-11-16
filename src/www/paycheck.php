<?php
$access_item = false;
if(isset($read_access) && $read_access) {
	return;
}

include_once($_SERVER["FRAMEWORK_PATH"]."/config/init.php");


$action = $page->actions();


$page->bodyClass("paycheck");
$page->pageTitle("Penge er kun et-taller og nuller");

$page->header();
$page->template("paycheck/index.php");
$page->footer();

?>
