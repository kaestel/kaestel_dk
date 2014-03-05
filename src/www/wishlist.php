<?php
$access_item = false;
if(isset($read_access) && $read_access) {
	return;
}

include_once($_SERVER["FRAMEWORK_PATH"]."/config/init.php");


$action = $page->actions();


$page->bodyClass("wishlist");
$page->pageTitle("Ønskesedler");

// mini
if(count($action) > 0 && $action[0] == "view") {

	$page->header();
	$page->template("wishlist/view.php");
	$page->footer();

}
else if(count($action) == 2 && $action[0] == "reserve") {

	// change reserve state
	$IC = new Item();
	if($IC->typeObject("wish")->reserve($action[1])) {
		print '{"cms_status":"success", "message":"Item is reserved"}';
	}
	else {
		print '{"cms_status":"error", "message":"An error occured. Please reload."}';
	}

}
else if(count($action) == 2 && $action[0] == "unreserve") {

	// change reserve state
	$IC = new Item();
	if($IC->typeObject("wish")->unreserve($action[1])) {
		print '{"cms_status":"success", "message":"Item is no longer reserved"}';
	}
	else {
		print '{"cms_status":"error", "message":"An error occured. Please reload."}';
	}

}
else {

	$page->header();
	$page->template("wishlist/list.php");
	$page->footer();

}

?>
 