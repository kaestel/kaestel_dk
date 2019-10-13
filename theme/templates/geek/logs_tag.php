<?php
global $IC;
global $action;

$itemtype = "log";
$tag = urldecode($action[2]);

// get log tags for listing
$categories = $IC->getTags(array("context" => $itemtype));


// get content pagination
$limit = stringOr(getVar("limit"), 5);
$sindex = isset($action[3]) ? $action[3] : false;
$direction = isset($action[4]) ? $action[4] : false; 

$pattern = array("itemtype" => $itemtype, "status" => 1, "tags" => $itemtype.":".addslashes($tag), "order" => "published_at ASC", "extend" => array("tags" => true, "user" => true, "mediae" => true));
$pagination = $IC->paginate(array("pattern" => $pattern, "sindex" => $sindex, "limit" => $limit, "direction" => $direction));

if($pagination["range_items"]) {
	$this->sharingMetaData($pagination["range_items"][0]);
}
?>

<div class="scene geek logs tag i:scene">
	<h1><?= $tag ?></h1>

<? if($pagination["range_items"]): ?>
	<ul class="items postings i:articlelist">
<?		foreach($pagination["range_items"] as $item):
			$media = $IC->sliceMediae($item); ?>
		<li class="item log id:<?= $item["item_id"] ?>" itemscope itemtype="http://schema.org/BlogPosting">

<?			if($media): ?>
			<div class="image item_id:<?= $item["item_id"] ?> format:<?= $media["format"] ?> variant:<?= $media["variant"] ?>">
				<p>Image: <a href="/images/<?= $item["item_id"] ?>/<?= $media["variant"] ?>/500x.<?= $media["format"] ?>"><?= $media["name"] ?></a></p>
			</div>
<?			endif; ?>


			<?= $HTML->articleTags($item, [
				"context" => ["log"],
				"url" => "/geek/logs/tag",
				"default" => ["/geek/logs", "Logs"]
			]) ?>


			<h2 itemprop="headline"><?= $item["name"] ?></h2>


			<?= $HTML->articleInfo($item, "/geek/logs/".$item["sindex"], [
				"media" => $media, 
				"sharing" => true
			]) ?>


			<div class="articlebody" itemprop="articleBody">
				<?= $item["html"] ?>
			</div>

<?			if($item["mediae"]):
				foreach($item["mediae"] as $media): ?>
			<div class="image item_id:<?= $item["item_id"] ?> format:<?= $media["format"] ?> variant:<?= $media["variant"] ?>">
				<p>Image: <a href="/images/<?= $item["item_id"] ?>/<?= $media["variant"] ?>/500x.<?= $media["format"] ?>"><?= $media["name"] ?></a></p>
			</div>
<? 				endforeach;
			endif; ?>

		</li>
<?		endforeach; ?>
	</ul>
<? endif; ?>


<? if($pagination["next"] || $pagination["prev"]): ?>
	<div class="pagination">
		<ul class="actions">
<? if($pagination["prev"]): ?><li class="previous"><a href="/geek/logs/tag/<?= $action[2] ?>/<?= $pagination["first_sindex"] ?>/prev">Previous page</a></li><? endif; ?>
<? if($pagination["next"]): ?><li class="next"><a href="/geek/logs/tag/<?= $action[2] ?>/<?= $pagination["last_sindex"] ?>/next">Next page</a></li><? endif; ?>
		</ul>
	</div>
<? endif; ?>

	<div class="categories">
<?		if($categories): ?>
		<h2>Categories</h2>
		<ul class="tags">
<?			foreach($categories as $tag): ?>
			<li><a href="/geek/logs/tag/<?= urlencode($tag["value"]) ?>"><?= $tag["value"] ?></a></li>
<?			endforeach; ?>
		</ul>
<?		endif; ?>

		<ul class="actions">
			<li class="more"><a href="/geek/logs">All log entries</a></li>
		</ul>
	</div>
</div>
