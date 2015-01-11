<?php
$access_item = false;
if(isset($read_access) && $read_access) {
	return;
}

include_once($_SERVER["FRAMEWORK_PATH"]."/config/init.php");


$action = $page->actions();
$model = new User();


$page->bodyClass("newsletter");
$page->pageTitle("Newsletter");


if(is_array($action) && count($action)) {

	// /newsletter/receipt (user just signed up)
	if($action[0] == "receipt") {

		$page->page(array(
			"templates" => "pages/newsletter_receipt.php"
		));
		exit();
	}

	// /newsletter/signup
	else if($action[0] == "subscribe" && $page->validateCsrfToken()) {

		$user = $model->newUser(array("newUser"));
		$newsletter = stringOr(getPost("newsletter"), "general");

		// successful creation
		if(isset($user["user_id"]) && $model->updateNewsletter(array("updateNewsletter", $newsletter, 1))) {

			// redirect to leave POST state
			header("Location: receipt");
			exit();

		}

		// user exists
		else if(isset($user["status"]) && $user["status"] == "USER_EXISTS") {
			message()->addMessage("Sorry, server says you either have a bad memory or a bad conscience!", array("type" => "error"));
		}
		// something went wrong
		else {
			message()->addMessage("Sorry, server says NO!", array("type" => "error"));
		}

	}

}

$page->page(array(
	"templates" => "pages/newsletter.php"
));

?>
