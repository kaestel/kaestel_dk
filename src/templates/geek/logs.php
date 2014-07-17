<?php
global $IC;
global $action;


$log_items = $IC->getItems(array("itemtype" => "log", "status" => 1));
$log_tags = $IC->getTags(array("context" => "log"));

?>

<div class="scene geek logs i:generic">
	<h1>I'd stay home if I could <br />... but I can't</h1>

	<div class="categories">
<?	if($log_tags): ?>
		<h2>Categories</h2>
		<ul class="tags">
<?		foreach($log_tags as $tag): ?>
			<li><a href="/geek/logs/tag/<?= urlencode($tag["value"]) ?>"><?= $tag["value"] ?></a></li>
<?		endforeach; ?>
		</ul>
<?	endif; ?>
	</div>


<? if($log_items): ?>
	<ul class="logs">
<?		foreach($log_items as $item):
			$item = $IC->extendItem($item, array("tags" => true)); ?>
		<li class="log id:<?= $item["item_id"] ?>" itemscope itemtype="http://schema.org/blog">
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

			<div class="description" itemprop="description">
				<?= $item["html"] ?>
			</div>
		</li>
<?		endforeach; ?>
	</ul>
<? endif; ?>


</div>
