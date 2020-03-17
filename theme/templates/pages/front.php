<?php
global $IC;
global $action;

//$log_items = $IC->getItems(array("itemtype" => "log", "limit" => 2, "status" => 1, "extend" => array("tags" => true, "user" => true, "mediae" => true)));
//$post_items = $IC->getItems(array("itemtype" => "post", "limit" => 2, "status" => 1, "extend" => array("tags" => true, "user" => true, "mediae" => true)));

$log_items = $IC->getItems(array("itemtype" => "log", "limit" => 2, "status" => 1, "tags" => "on:frontpage", "extend" => array("tags" => true, "user" => true, "mediae" => true)));
$post_items = $IC->getItems(array("itemtype" => "post", "limit" => 2, "status" => 1, "tags" => "on:frontpage", "extend" => array("tags" => true, "user" => true, "mediae" => true)));

?>
<div class="scene front i:front">
	<h1>The plain details</h1>
	<p>
		
	</p>
	<p>No <a href="/details">detail</a> is <a href="/plain">plain</a>. Normal is weird. This is personal.</p>

<? if($post_items): ?>

	<h2>Recent postings <a href="/details/posts">(see all posts)</a></h2>
	<ul class="items articles postings articlePreviewList i:articlePreviewList">
<?		foreach($post_items as $item):
			$media = $IC->sliceMediae($item, "mediae"); ?>
		<li class="item post article id:<?= $item["item_id"] ?>" itemscope itemtype="http://schema.org/Article">

<?			if($media): ?>
			<div class="image item_id:<?= $item["item_id"] ?> format:<?= $media["format"] ?> variant:<?= $media["variant"] ?>"></div>
<?			endif; ?>


			<?= $HTML->articleTags($item, [
				"context" => ["post"],
				"url" => "/details/posts/tag",
				"default" => ["/details/posts", "Posts"]
			]) ?>


			<h3 itemprop="headline"><a href="/details/posts/<?= $item["sindex"] ?>"><?= $item["name"] ?></a></h3>


			<?= $HTML->articleInfo($item, "/", [
				"media" => $media
			]) ?>


<?			if($item["description"]): ?>
			<div class="description" itemprop="description">
				<p><?= nl2br($item["description"]) ?></p>
			</div>
<?			endif; ?>

		</li>
<?		endforeach; ?>
	</ul>

<? endif; ?>


<? if($log_items): ?>

	<h2>Recents log entries <a href="/details/logs">(see all logs)</a></h2>
	<ul class="items articles logs articlePreviewList i:articlePreviewList">
<?		foreach($log_items as $item):
			$media = $IC->sliceMediae($item, "mediae"); ?>
		<li class="item log article id:<?= $item["item_id"] ?>" itemscope itemtype="http://schema.org/BlogPosting">

<?			if($media): ?>
			<div class="image item_id:<?= $item["item_id"] ?> format:<?= $media["format"] ?> variant:<?= $media["variant"] ?>"></div>
<?			endif; ?>


			<?= $HTML->articleTags($item, [
				"context" => ["log"],
				"url" => "/details/logs/tag",
				"default" => ["/details/logs", "Logs"]
			]) ?>


			<h3 itemprop="headline"><a href="/details/logs/<?= $item["sindex"] ?>"><?= $item["name"] ?></a></h3>


			<?= $HTML->articleInfo($item, "/", [
				"media" => $media
			]) ?>


<?			if($item["description"]): ?>
			<div class="description" itemprop="description">
				<p><?= nl2br($item["description"]) ?></p>
			</div>
<?			endif; ?>

		</li>
<?		endforeach; ?>
	</ul>

<?	endif; ?>

</div>
