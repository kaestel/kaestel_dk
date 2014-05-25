<?php
global $IC;
global $action;

$tag = urldecode($action[2]);

$post_items = $IC->getItems(array("itemtype" => "post", "status" => 1, "tags" => "post:$tag"));
$post_tags = $IC->getTags(array("context" => "post"));

?>

<div class="scene geek posts tag i:generic">
	<h1><?= $tag ?></h1>

<? if($post_items): ?>

	<ul class="postings">
<?		foreach($post_items as $item):
			$item = $IC->extendItem($item, array("tags" => true)); ?>
		<li class="post id:<?= $item["item_id"] ?>" itemscope itemtype="http://schema.org/Article">
			<h2 itemprop="name"><?= $item["name"] ?></h2>

			<dl class="info">
				<dt class="published_at">Date published</dt>
				<dd class="published_at" itemprop="datePublished" content="2015-07-27"><?= date("Y-m-d, H:i", strtotime($item["published_at"])) ?></dd>
				<dt class="author">Author</dt>
				<dd class="author" itemprop="author">Martin Kæstel Nielsen</dd>
			</dl>

			<div class="description" itemprop="articleBody">
				<?= $item["html"] ?>
			</div>
		</li>
<?		endforeach; ?>
	</ul>
<? endif; ?>

<?	if($post_tags): ?>
	<h2>Categories</h2>
	<ul class="tags">
<?		foreach($post_tags as $tag): ?>
		<li><a href="/geek/posts/tag/<?= urlencode($tag["value"]) ?>"><?= $tag["value"] ?></a></li>
<?		endforeach; ?>
	</ul>
<?	endif; ?>

	<ul class="actions">
		<li class="more"><a href="/geek/posts">All postings</a></li>
	</ul>

</div>
