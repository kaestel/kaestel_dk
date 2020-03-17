<?php
$access_item = false;
if(isset($read_access) && $read_access) {
	return;
}

include_once($_SERVER["FRAMEWORK_PATH"]."/config/init.php");


$action = $page->actions();
$IC = new Items();


$page->bodyClass("details");
$page->pageTitle("Details");
$page->pageDescription("");


if(is_array($action) && count($action)) {

	# Blog posts
	if($action[0] === "posts") {

		# Search
		# /details/posts/search
		if(count($action) >= 2 && $action[1] === "search") {

			$page->page([
				"templates" => "details/search.php"
			]);
			exit();

		}

		# View specific post
		# /details/posts/#sindex#
		else if(count($action) === 2) {

			$page->page([
				"templates" => "details/post.php"
			]);
			exit();

		}

		# Tags
		else if(count($action) >= 2 && $action[1] === "tag") {

			# View specific post (tag listed)
			# /details/posts/tag/#tag#/#sindex#
			if(count($action) === 4) {

				$page->page([
					"templates" => "details/post_tag.php"
				]);
				exit();
			}

			# List by tag
			# /details/posts/tag/#tag#
			# /details/posts/tag/#tag#/page/#sindex#
			else if((count($action) === 3) || (count($action) === 5 && $action[3] === "page")) {

				$page->page([
					"templates" => "details/posts_tag.php"
				]);
				exit();

			}

		}

		# List
		# /details/posts
		# /details/posts/page/#page#
		else if(count($action) === 1 || (count($action) === 3 && $action[1] === "page")) {

			$page->page([
				"templates" => "details/posts.php"
			]);
			exit();

		}

	}

	# Travel logs
	else if($action[0] === "logs") {

		# List by tag
		# /details/logs/#tag#
		if((count($action) === 2)) {

			$page->page([
				"templates" => "details/logs_tag.php"
			]);
			exit();

		}

	}

}

# Category overview
$page->page([
	"templates" => "details/index.php"
]);

?>
 