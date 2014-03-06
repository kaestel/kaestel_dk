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
$itemtype = "wish";

$model = $IC->typeObject($itemtype);
$output = new Output();


$page->bodyClass("wishlist plain");
$page->pageTitle("Wishes");


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
	if(count($action) > 0 && $action[0] == "view") {

		$page->header();
		$page->template("wishlist/view.php");
		$page->footer();
		exit();

	}

}

$page->header();
$page->template("wishlist/list.php");
$page->footer();

// 
// 
// else if(count($action) == 2 && $action[0] == "reserve") {
// 
// 	// change reserve state
// 	$IC = new Item();
// 	if($IC->typeObject("wish")->reserve($action[1])) {
// 		print '{"cms_status":"success", "message":"Item is reserved"}';
// 	}
// 	else {
// 		print '{"cms_status":"error", "message":"An error occured. Please reload."}';
// 	}
// 
// }
// else if(count($action) == 2 && $action[0] == "unreserve") {
// 
// 	// change reserve state
// 	$IC = new Item();
// 	if($IC->typeObject("wish")->unreserve($action[1])) {
// 		print '{"cms_status":"success", "message":"Item is no longer reserved"}';
// 	}
// 	else {
// 		print '{"cms_status":"error", "message":"An error occured. Please reload."}';
// 	}
// 
// }
// else {
// 
// 	$page->header();
// 	$page->template("wishlist/list.php");
// 	$page->footer();
// 
// }

?>
 