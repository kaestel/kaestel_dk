<?php
$access_item["/"] = true;
$access_item["/view/"] = true;

if(isset($read_access) && $read_access) {
	return;
}

include_once($_SERVER["FRAMEWORK_PATH"]."/config/init.php");


$action = $page->actions();
$IC = new Items();
$itemtype = "todo";
$model = $IC->typeObject($itemtype);


$page->bodyClass("todolist plain");
$page->pageTitle("TODOs");


if(is_array($action) && count($action)) {

	// VIEW
	// /wishlist/view/[item_id]
	if(count($action) > 0 && $action[0] == "view") {

		$page->page(array(
			"templates" => "todolist/view.php"
		));
		exit();
	}

	// Class interface
	else if($page->validateCsrfToken() && preg_match("/[a-zA-Z]+/", $action[0])) {

		// check if custom function exists on User class
		if($model && method_exists($model, $action[0])) {

			$output = new Output();
			$output->screen($model->{$action[0]}($action));
			exit();
		}
	}

}

$page->page(array(
	"templates" => "todolist/list.php"
));

?>
 