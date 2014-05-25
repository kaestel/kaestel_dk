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


$page->bodyClass("geek");
$page->pageTitle("Geek");


if(is_array($action) && count($action)) {

	if(preg_match("/[a-zA-Z\\-_]+/", $action[0])) {
		if(is_array($action) && count($action)) {

			if(count($action) == 1) {

				$page->header();
				$page->template("geek/".$action[0].".php");
				$page->footer();
				exit();

			}
			else if(count($action) == 2 && $action[1] != "tag") {

				$page->header();
				$page->template("geek/".$action[0]."_view.php");
				$page->footer();
				exit();

			}
			else if(count($action) == 3 && $action[1] == "tag") {

				$page->header();
				$page->template("geek/".$action[0]."_tag.php");
				$page->footer();
				exit();

			}

		}

	}

}

$page->header();
$page->template("geek/list.php");
$page->footer();

?>
 