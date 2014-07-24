<?php
$access_item = false;
if(isset($read_access) && $read_access) {
	return;
}

include_once($_SERVER["FRAMEWORK_PATH"]."/config/init.php");


$action = $page->actions();


$page->bodyClass("posts");
$page->pageTitle("Posts");

if(is_array($action) && count($action)) {

	if(count($action) == 1 && $action[0] == "posts") {

		$page->header();
		$page->template("posts/list.php");
		$page->footer();
		exit();

	}
	else if(count($action) > 1 && $action[0] == "posts") {

		$page->header();
		$page->template("posts/tags.php");
		$page->footer();
		exit();

	}
	else if(count($action) > 1 && $action[0] == "post") {

		$page->header();
		$page->template("pages/forgot_password.php");
		$page->footer();
		exit();

	}

}


$page->header();
$page->template("pages/403.php");
$page->footer();

?>