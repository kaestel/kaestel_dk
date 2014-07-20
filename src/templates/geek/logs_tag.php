<?php
global $IC;
global $action;

$tag = urldecode($action[2]);

$log_items = $IC->getItems(array("itemtype" => "log", "status" => 1, "tags" => "log:".addslashes($tag), "order" => "published_at ASC"));
$log_tags = $IC->getTags(array("context" => "log"));

?>

<div class="scene geek logs tag i:logbook">
	<h1><?= $tag ?></h1>

<? if($log_items): ?>
	<ul class="logs i:articlelist">
<?		foreach($log_items as $item):
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
