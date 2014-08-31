<?php
global $IC;
global $action;

$itemtype = "post";
$tag = urldecode($action[2]);

// get log tags for listing
$post_tags = $IC->getTags(array("context" => "post"));


// get content pagination
include_once("class/items/pagination.class.php");
$PC = new Pagination();

$limit = stringOr(getVar("limit"), 5);
$sindex = isset($action[3]) ? $action[3] : false;
$direction = isset($action[4]) ? $action[4] : false; 

$pattern = array("itemtype" => $itemtype, "status" => 1, "tags" => $itemtype.":".addslashes($tag));
$pagination = $PC->paginate(array("pattern" => $pattern, "sindex" => $sindex, "limit" => $limit, "direction" => $direction));

?>

<div class="scene geek posts tag i:generic">
	<h1><?= $tag ?></h1>

<? if($pagination["range_items"]): ?>
	<ul class="postings i:articlelist">
<?		foreach($pagination["range_items"] as $item):
			$item = $IC->extendItem($item, array("tags" => true));
			$media = $item["mediae"] ? array_shift($item["mediae"]) : false; ?>
		<li class="item post id:<?= $item["item_id"] ?>" itemscope itemtype="http://schema.org/Article">

<?			if($media): ?>
			<div class="image image_id:<?= $item["item_id"] ?> format:<?= $media["format"] ?> variant:<?= $media["variant"] ?>"></div>
<?			endif; ?>

			<ul class="tags">
				<li><a href="/geek/posts">Posts</a></li>
<?			if($item["tags"]): ?>
<?				foreach($item["tags"] as $tag): ?>
				<li><a href="/geek/posts/tag/<?= urlencode($tag["value"]) ?>" itemprop="articleSection"><?= $tag["value"] ?></a></li>
<?				endforeach; ?>
<?			endif; ?>
			</ul>
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

<?			if(count($item["mediae"])):
				foreach($item["mediae"] as $media): ?>
			<div class="image image_id:<?= $item["item_id"] ?> format:<?= $media["format"] ?> variant:<?= $media["variant"] ?>"></div>
<? 				endforeach;
			endif; ?>

		</li>
<?		endforeach; ?>
	</ul>
<? endif; ?>


<? if($pagination["next"] || $pagination["prev"]): ?>
	<div class="pagination">
		<ul class="actions">
<? if($pagination["prev"]): ?><li class="previous"><a href="/geek/posts/tag/<?= $action[2] ?>/<?= $pagination["first_sindex"] ?>/prev">Previous page</a></li><? endif; ?>
<? if($pagination["next"]): ?><li class="next"><a href="/geek/posts/tag/<?= $action[2] ?>/<?= $pagination["last_sindex"] ?>/next">Next page</a></li><? endif; ?>
		</ul>
	</div>
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
