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



# /geek/logs[/count/N] - lists the latest 5 logs and prev button
# /geek/logs/#sindex#[/count/N] - Lists the latest 5 logs from sindex and prev+next button

# /geek/logs/#sindex#/prev[/count/N]
# /geek/logs/#sindex#/next[/count/N]

# /geek/logs/tag/#tag#[/count/N] - Lists latest 5 logs with tag and prev button

# /geek/logs/tag/#tag#/#sindex#[/count/N] - Lists latest 5 logs with tag from sindex and prev+next button

# /geek/logs/tag/#tag#/#sindex#/prev[/count/N]
# /geek/logs/tag/#tag#/#sindex#/next[/count/N]



if(is_array($action) && count($action)) {

	if(preg_match("/[a-zA-Z\\-_]+/", $action[0])) {
		if(is_array($action) && count($action)) {

			# /geek/logs/tag/#tag#[/#sindex#/prev|next]
			if(count($action) > 2 && $action[1] == "tag") {

				$page->header();
				$page->template("geek/".$action[0]."_tag.php");
				$page->footer();
				exit();

			}
			# /geek/logs[/#sindex#/prev|next]
			else {

				$page->header();
				$page->template("geek/".$action[0].".php");
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
 