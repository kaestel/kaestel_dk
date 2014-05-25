<?php
global $IC;
global $action;


$post_items = $IC->getItems(array("itemtype" => "post", "status" => 1));
$post_tags = $IC->getTags(array("context" => "post"));

?>

<div class="scene front i:generic">
	<h1>Postings from the void of the banausia</h1>


	<div class="posts">
<?	if($post_tags): ?>
		<h2>Categories</h2>
		<ul class="tags">
<?		foreach($post_tags as $tag): ?>
			<li><a href="/geek/posts/tag/<?= urlencode($tag["value"]) ?>"><?= $tag["value"] ?></a></li>
<?		endforeach; ?>
		</ul>
<?	endif; ?>
	</div>

<? if($post_items): ?>

	<ul class="postings">
<?		foreach($post_items as $item):
			$item = $IC->extendItem($item, array("tags" => true)); ?>
		<li class="post id:<?= $item["item_id"] ?>" itemscope itemtype="http://schema.org/Article">
			<h2 itemprop="name"><a href="/geek/post/<?= $item["sindex"] ?>"><?= $item["name"] ?></a></h2>

			<dl class="info">
				<dt class="date_published">Date published</dt>
				<dd class="date_published" itemprop="datePublished" content="2015-07-27"><?= date("Y-m-d, H:i", strtotime($item["published_at"])) ?></dd>
			</dl>

			<div class="description" itemprop="description">
				<?= $item["html"] ?>
			</div>
		</li>
<?		endforeach; ?>
	</ul>
<? endif; ?>


</div>
