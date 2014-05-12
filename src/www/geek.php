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

	if(preg_match("/[a-zA-Z]+/", $action[0])) {

		// check if custom function exists on User class
		if($model && method_exists($model, $action[0])) {

			$output->screen($model->$action[0]($action));
			exit();
		}
	}

	// VIEW
	// /wishlist/view/[item_id]
	if(count($action) > 1 && $action[0] == "view") {

		$page->header();
		$page->template("story/story.php");
		$page->footer();
		exit();

	}

}

$page->header();
$page->template("pages/list_geek.php");
$page->footer();

?>
 