<?php
global $action;
global $IC;

$itemtype = "post";


// List extension (page > 1)
if(count($action) === 4) {
	$page = $action[3];
	$query = session()->value("post-search-query");
	$selected_tag = session()->value("post-search-tag");
	$pattern = session()->value("post-search-pattern");
}
// Default list
else {
	$page = false;
	$query = getPost("query");
	session()->value("post-search-query", $query);

	$selected_tag = getPost("tag");
	session()->value("post-search-tag", $selected_tag);

	$pattern = json_decode(stripslashes(getPost("pattern")), true);
	session()->value("post-search-pattern", $pattern);
}


// Get post tags for listing
$categories = $IC->getTags(array("context" => $itemtype, "order" => "value"));

// perf()->add("Before");

$items = $IC->paginate(["pattern" => $pattern, "query" => $query, "tags" => $selected_tag]);

// $items = $IC->search(["pattern" => $pattern, "query" => $query]);
// debug([$items]);

// perf()->add("After");
// perf()->dump();

?>

<div class="scene details posts i:columns">


	<div class="article">
		<h1>Searching for:</h1>
		<h2><span class="query"><?= $query ?></span><?= $selected_tag ? " in '".preg_replace("/^[^:]+:/", "", $selected_tag)."'" : "" ?></h2>
	</div>


	<?= $HTML->searchBox("/details/posts/search", [
		"headline" => "Search posts",
		"pattern" => $pattern,
		"query" => $query
	]) ?>


	<div class="articles">

<? if($items["range_items"]): ?>

		<h2>Matching posts</h2>

		<ul class="items articles articlePreviewList i:articlePreviewList">
			<? foreach($items["range_items"] as $item): ?>
			<li class="item article id:<?= $item["item_id"] ?>" itemscope itemtype="http://schema.org/NewsArticle">

				<h3 itemprop="headline"><a href="/details/posts/<?= $item["sindex"] ?>"><?= strip_tags($item["name"]) ?></a></h3>

				<?= $HTML->articleInfo($item, "/details/posts/".$item["sindex"], [
					"media" => false
				]) ?>


				<? if($item["searchable_string"]):

				$searchable_string = preg_replace("/###/", " ", $item["searchable_string"]);

				$first_match = stripos($searchable_string, $query);
				if($first_match > 40) {
					$start_at = $first_match - 40;
					$end_at = ($first_match + 100) - $start_at;
				}
				else {
					$start_at = 0;
					$end_at = $first_match + 100 + (40 - $first_match);
					$matching_snippet = substr($searchable_string, $start_at, $end_at);
				}

				$matching_snippet = substr($searchable_string, $start_at, $end_at);

				if($start_at > 0) {
					$matching_snippet = "...".$matching_snippet;
				}
				if(strlen($searchable_string) > $end_at) {
					$matching_snippet = $matching_snippet."...";
				}

				$matching_snippet = str_ireplace($query, '<span class="match">'.$query.'</span>', $matching_snippet);

				?>
				<div class="description" itemprop="description">
					<p><?= $matching_snippet ?></p>
				</div>
				<? endif; ?>

			</li>
			<? endforeach; ?>
		</ul>

<? else: ?>
		<p>No posts</p>
<? endif; ?>
	</div>

<? if($categories): ?>
	<div class="categories">
		<h2>Categories</h2>
		<ul class="tags">
			<? foreach($categories as $tag): ?>
			<li<?= $tag["value"] === preg_replace("/^[^:]+:/", "", $selected_tag) ? ' class="selected"' : '' ?>><a href="/details/posts/tag/<?= urlencode($tag["value"]) ?>"><?= $tag["value"] ?></a></li>
		<? endforeach; ?>
			<li class="all"><a href="/details/posts">All postings</a></li>
		</ul>
	</div>
<? endif; ?>

</div>
