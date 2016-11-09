<?php
global $IC;
global $action;

$itemtype = "log";

// get log tags for listing
$categories = $IC->getTags(array("context" => $itemtype));


// get content pagination
$limit = stringOr(getVar("limit"), 5);
$sindex = isset($action[1]) ? $action[1] : false;
$direction = isset($action[2]) ? $action[2] : false; 

$pattern = array("itemtype" => $itemtype, "status" => 1, "extend" => array("tags" => true, "user" => true, "mediae" => true));
$pagination = $IC->paginate(array("pattern" => $pattern, "sindex" => $sindex, "limit" => $limit, "direction" => $direction));

if($pagination["range_items"]) {
	$this->sharingMetaData($pagination["range_items"][0]);
}
?>

<div class="scene geek logs i:generic">
	<h1>I'd stay home if I could <br />... but I can't</h1>

	<div class="categories">
<?	if($categories): ?>
		<h2>Categories</h2>
		<ul class="tags">
<?		foreach($categories as $tag): ?>
			<li><a href="/geek/logs/tag/<?= urlencode($tag["value"]) ?>"><?= $tag["value"] ?></a></li>
<?		endforeach; ?>
		</ul>
<?	endif; ?>
	</div>


<? if($pagination["range_items"]): ?>
	<ul class="items postings i:articlelist">
<?		foreach($pagination["range_items"] as $item):
			$media = $IC->sliceMedia($item); ?>
		<li class="item log id:<?= $item["item_id"] ?>" itemscope itemtype="http://schema.org/BlogPosting">

<?			if($media): ?>
			<div class="image item_id:<?= $item["item_id"] ?> format:<?= $media["format"] ?> variant:<?= $media["variant"] ?>">
				<p>Image: <a href="/images/<?= $item["item_id"] ?>/<?= $media["variant"] ?>/500x.<?= $media["format"] ?>"><?= $media["name"] ?></a></p>
			</div>
<?			endif; ?>

			<ul class="tags">
<?			if($item["tags"]): ?>
<?				if(arrayKeyValue($item["tags"], "context", "editing")): ?>
					<li class="editing" title="This post is work in progress">Still editing</li>
<?				endif; ?>
<?			endif; ?>
				<li><a href="/geek/logs">Logs</a></li>
<?			if($item["tags"]): ?>
<?				foreach($item["tags"] as $item_tag): ?>
<?	 				if($item_tag["context"] == $itemtype): ?>
				<li><a href="/geek/logs/tag/<?= urlencode($item_tag["value"]) ?>" itemprop="articleSection"><?= $item_tag["value"] ?></a></li>
<?					endif; ?>
<?				endforeach; ?>
<?			endif; ?>
			</ul>

			<h2 itemprop="headline"><?= $item["name"] ?></h2>

			<?= $HTML->articleInfo($item, "/geek/logs/".$item["sindex"], $media, true) ?>


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

			<div class="articlebody" itemprop="articleBody">
				<?= $item["html"] ?>
			</div>

<?			if($item["mediae"]):
				foreach($item["mediae"] as $media): ?>
			<div class="image _id:<?= $item["item_id"] ?> format:<?= $media["format"] ?> variant:<?= $media["variant"] ?>">
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
<? if($pagination["prev"]): ?><li class="previous"><a href="/geek/logs/<?= $pagination["first_sindex"] ?>/prev">Previous page</a></li><? endif; ?>
<? if($pagination["next"]): ?><li class="next"><a href="/geek/logs/<?= $pagination["last_sindex"] ?>/next">Next page</a></li><? endif; ?>
		</ul>
	</div>
<? endif; ?>

</div>
