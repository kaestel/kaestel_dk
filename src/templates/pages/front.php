<?php
global $IC;
global $action;

	
$log_items = $IC->getItems(array("itemtype" => "log", "limit" => 2, "status" => 1));
$post_items = $IC->getItems(array("itemtype" => "post", "limit" => 2, "status" => 1));

$post_tags = $IC->getTags(array("context" => "post"));
$log_tags = $IC->getTags(array("context" => "log"));

//$photo_item = $IC->getItems(array("itemtype" => "photo", "limit" => 1, "status" => 1));

?>

<div class="scene front i:generic">
	<h1>The plain geek</h1>
	<p>
		Geeks are passionate people. We are curious. We are having fun in our own way. Our excessive passion grants 
		us the geek label and our passion and curiosity drives us to dig further and further into our subjects, 
		whatever it might be without any concern for profit. 
		If you don't get it, perhaps you are just not smart enough and I urge you to try a little harder, because
		geeks will either save the world or destroy it. It all depends on how you treat them.
	</p>
	<p>No <a href="/geek">geek</a> is <a href="/plain">plain</a>. Normal is weird.</p>

<? if($log_items): ?>

	<h2>Recents log entries</h2>
	<ul class="logs">
<?		foreach($log_items as $item):
			$item = $IC->extendItem($item, array("tags" => true)); ?>
		<li class="log id:<?= $item["item_id"] ?>" itemscope itemtype="http://schema.org/blog">
<?			if($item["tags"]): ?>
			<ul class="tags">
<?				foreach($item["tags"] as $tag): ?>
				<li><a href="/geek/logs/tag/<?= urlencode($tag["value"]) ?>" itemprop="articleSection"><?= $tag["value"] ?></a></li>
<?				endforeach; ?>
			</ul>
<?			endif; ?>

			<h3 itemprop="name"><?= $item["name"] ?></h3>

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
				<?//= stringOr($item["description"], $item["html"]) ?>
				<?= $item["html"] ?>
			</div>

		</li>
<?		endforeach; ?>
	</ul>

	<ul class="actions">
		<li class="more"><a href="/geek">More log entries</a></li>
	</ul>
<?	endif; ?>


<? if($post_items): ?>

	<h2>Recent postings</h2>
	<ul class="postings">
<?		foreach($post_items as $item):
			$item = $IC->extendItem($item, array("tags" => true)); ?>
		<li class="post id:<?= $item["item_id"] ?>" itemscope itemtype="http://schema.org/Article">
<?			if($item["tags"]): ?>
			<ul class="tags">
<?				foreach($item["tags"] as $tag): ?>
				<li><a href="/geek/posts/tag/<?= urlencode($tag["value"]) ?>" itemprop="articleSection"><?= $tag["value"] ?></a></li>
<?				endforeach; ?>
			</ul>
<?			endif; ?>

			<h3 itemprop="name"><?= $item["name"] ?></h3>

			<dl class="info">
				<dt class="published_at">Date published</dt>
				<dd class="published_at" itemprop="datePublished" content="2015-07-27"><?= date("Y-m-d, H:i", strtotime($item["published_at"])) ?></dd>
				<dt class="author">Author</dt>
				<dd class="author" itemprop="author">Martin Kæstel Nielsen</dd>
			</dl>

			<div class="description" itemprop="description">
				<?= $item["html"] ?>
			</div>

		</li>
<?		endforeach; ?>
	</ul>

	<ul class="actions">
		<li class="more"><a href="/geek">More postings</a></li>
	</ul>
<? endif; ?>


</div>
