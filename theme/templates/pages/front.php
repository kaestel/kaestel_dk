<?php
global $IC;
global $action;

//$log_items = $IC->getItems(array("itemtype" => "log", "limit" => 2, "status" => 1, "extend" => array("tags" => true, "user" => true, "mediae" => true)));
//$post_items = $IC->getItems(array("itemtype" => "post", "limit" => 2, "status" => 1, "extend" => array("tags" => true, "user" => true, "mediae" => true)));

$log_items = $IC->getItems(array("itemtype" => "log", "limit" => 2, "status" => 1, "tags" => "on:frontpage", "extend" => array("tags" => true, "user" => true, "mediae" => true)));
$post_items = $IC->getItems(array("itemtype" => "post", "limit" => 2, "status" => 1, "tags" => "on:frontpage", "extend" => array("tags" => true, "user" => true, "mediae" => true)));

?>
<div class="scene front i:front">
	<h1>The plain geek</h1>
	<p>
		Geeks are passionate people. We are curious. We are having fun in our own way. Our excessive passion grants 
		us the geek label and our passion and curiosity drives us to dig further and further into our subjects, 
		whatever it might be without any concern for profit. 
		If you don't get it, perhaps you are just not smart enough and I urge you to try a little harder, because
		geeks will either save the world or destroy it. It all depends on how you treat them.
	</p>
	<p>No <a href="/geek">geek</a> is <a href="/plain">plain</a>. Normal is weird. This is personal.</p>

<? if($post_items): ?>

	<h2>Recent postings</h2>
	<ul class="items postings i:articlelist">
<?		foreach($post_items as $item):
			$media = $IC->sliceMediae($item); ?>
		<li class="item post id:<?= $item["item_id"] ?>" itemscope itemtype="http://schema.org/Article">

<?			if($media): ?>
			<div class="image item_id:<?= $item["item_id"] ?> format:<?= $media["format"] ?> variant:<?= $media["variant"] ?>">
				<p>Image: <a href="/images/<?= $item["item_id"] ?>/<?= $media["variant"] ?>/500x.<?= $media["format"] ?>"><?= $media["name"] ?></a></p>
			</div>
<?			endif; ?>



			<?= $HTML->articleTags($item, [
				"context" => ["post"],
				"url" => "/geek/posts/tag",
				"default" => ["/geek/posts", "Posts"]
			]) ?>


			<h3 itemprop="headline"><a href="/geek/posts/<?= $item["sindex"] ?>"><?= $item["name"] ?></a></h3>


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

	<!--ul class="actions">
		<li class="more"><a href="/geek">More postings</a></li>
	</ul-->
<? endif; ?>


<? if($log_items): ?>

	<h2>Recents log entries</h2>
	<ul class="items logs i:articlelist">
<?		foreach($log_items as $item):
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


			<h3 itemprop="headline"><a href="/geek/logs/<?= $item["sindex"] ?>"><?= $item["name"] ?></a></h3>


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

	<!--ul class="actions">
		<li class="more"><a href="/geek">More log entries</a></li>
	</ul-->
<?	endif; ?>

</div>
