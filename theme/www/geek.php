<?php
$access_item = false;
if(isset($read_access) && $read_access) {
	return;
}

include_once($_SERVER["FRAMEWORK_PATH"]."/config/init.php");


$action = $page->actions();
$IC = new Items();


$page->bodyClass("geek");
$page->pageTitle("Geek");


if(is_array($action) && count($action)) {

	if(preg_match("/^(posts|logs)$/", $action[0])) {

		# /geek/logs/tag/#tag#[/#sindex#/prev|next]
		# /geek/posts/tag/#tag#[/#sindex#/prev|next]
		if(count($action) > 2 && $action[1] == "tag") {

			$page->page(array(
				"templates" => "geek/".$action[0]."_tag.php"
			));
			exit();
		}
		# /geek/logs[/#sindex#/prev|next]
		# /geek/posts[/#sindex#/prev|next]
		else {

			$page->page(array(
				"templates" => "geek/".$action[0].".php"
			));
			exit();
		}
	}

}

$page->page(array(
	"templates" => "geek/list.php"
));

?>
 