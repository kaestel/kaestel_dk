<?php
global $IC;
global $action;

$itemtype = "log";
$tag = urldecode($action[2]);

$count = stringOr(getVar("count"), 5);

// get log tags for listing
$log_tags = $IC->getTags(array("context" => "log"));


// get all items as base
$items = $IC->getItems(array("itemtype" => $itemtype, "status" => 1, "tags" => $itemtype.":".addslashes($tag), "order" => "published_at ASC"));


# /geek/logs/tag/#tag# - Lists latest N logs with tag and prev button
if(!isset($action[3])) {

	$range_items = $IC->getItems(array("itemtype" => $itemtype, "status" => 1, "tags" => $itemtype.":".addslashes($tag), "order" => "published_at ASC", "limit" => $count));
}

# /geek/logs/tag/#tag#/#sindex#[/prev|next]
else if(isset($action[3])) {

	$item_id = $IC->getIdFromSindex($action[3]);

	# /geek/logs/tag/#tag#/#sindex#/next - Lists the next N logs after sindex
	if(isset($action[4]) && $action[4] == "next") {

		$range_items = $IC->getNext($item_id, array("items" => $items, "count" => $count));
	}
	# /geek/logs/tag/#tag#/#sindex#/prev - Lists the prev N logs before sindex
	else if(isset($action[4]) && $action[4] == "prev") {

		$range_items = $IC->getPrev($item_id, array("items" => $items, "count" => $count));
	}
	# /geek/logs/tag/#tag#/#sindex# - Lists the next N logs starting with sindex
	else {

		$item = $IC->getItem(array("id" => $item_id));
		$range_items = $IC->getNext($item_id, array("items" => $items, "count" => $count-1));

		array_unshift($range_items, $item);
	}

}

// find indexes and ids for next/prev
$first_id = isset($range_items[0]) ? $range_items[0]["id"] : false;
$first_sindex = isset($range_items[0]) ? $range_items[0]["sindex"] : false;
$last_id = isset($range_items[count($range_items)-1]) ? $range_items[count($range_items)-1]["id"] : false;
$last_sindex = isset($range_items[count($range_items)-1]) ? $range_items[count($range_items)-1]["sindex"] : false;

// look for next/prev item availability
$next = $last_id ? $IC->getNext($last_id, array("items" => $items)) : false;
$prev = $first_id ? $IC->getPrev($first_id, array("items" => $items)) : false;

?>

<div class="scene geek logs tag i:logbook">
	<h1><?= $tag ?></h1>

<? if($range_items): ?>
	<ul class="logs i:articlelist">
<?		foreach($range_items as $item):
			$item = $IC->extendItem($item, array("tags" => true)); ?>
		<li class="item log id:<?= $item["item_id"] ?>" itemscope itemtype="http://schema.org/blog">

<?			if($item["files"]): ?>
			<div class="image image_id:<?= $item["item_id"] ?> format:<?= $item["files"] ?>"></div>
<?			endif; ?>

			<ul class="tags">
				<li><a href="/geek/logs">Logs</a></li>
<?			if($item["tags"]): ?>
<?				foreach($item["tags"] as $tag): ?>
				<li><a href="/geek/logs/tag/<?= urlencode($tag["value"]) ?>" itemprop="articleSection"><?= $tag["value"] ?></a></li>
<?				endforeach; ?>
<?			endif; ?>
			</ul>
			<h2 itemprop="name"><?= $item["name"] ?></h2>

			<dl class="info">
				<dt class="published_at">Date published</dt>
				<dd class="published_at" itemprop="datePublished"><?= date("Y-m-d, H:i", strtotime($item["published_at"])) ?></dd>
				<dt class="author">Author</dt>
				<dd class="author" itemprop="author">Martin Kæstel Nielsen</dd>
			</dl>

			<dl class="geo" itemprop="contentLocation" itemscope itemtype="http://schema.org/GeoCoordinates">
<?			if($item["location"]): ?>
				<dt class="location">location</dt>
				<dd class="location" itemprop="name"><?= $item["location"] ?></dd>
<?			endif; ?>
				<dt class="latitude">&phi;</dt>
				<dd class="latitude" itemprop="latitude"><?= round($item["latitude"], 5) ?>°</dd>
				<dt class="longitude">&lambda;</dt>
				<dd class="longitude" itemprop="longitude"><?= round($item["longitude"], 5) ?>°</dd>
			</dl>

			<div class="description" itemprop="blogPost">
				<?= $item["html"] ?>
			</div>
		</li>
<?		endforeach; ?>
	</ul>
<? endif; ?>


<? if($next || $prev): ?>
	<div class="pagination">
		<ul class="actions">
<? if($prev): ?><li class="previous"><a href="/geek/logs/tag/<?= $action[2] ?>/<?= $first_sindex ?>/prev">Previous page</a></li><? endif; ?>
<? if($next): ?><li class="next"><a href="/geek/logs/tag/<?= $action[2] ?>/<?= $last_sindex ?>/next">Next page</a></li><? endif; ?>
		</ul>
	</div>
<? endif; ?>


<?	if($log_tags): ?>
	<h2>Categories</h2>
	<ul class="tags">
<?		foreach($log_tags as $tag): ?>
		<li><a href="/geek/logs/tag/<?= urlencode($tag["value"]) ?>"><?= $tag["value"] ?></a></li>
<?		endforeach; ?>
	</ul>
<?	endif; ?>

	<ul class="actions">
		<li class="more"><a href="/geek/logs">All log entries</a></li>
	</ul>

</div>
