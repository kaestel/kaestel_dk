<?php
global $IC;
global $action;

$itemtype = "post";
$selected_tag = urldecode($action[2]);


// List extension (page > 1)
if(count($action) === 5) {
	$page = $action[4];
	$page_item = false;
}
// Default list
else {
	$page = false;
	$page_item = $IC->getItem([
		"itemtype" => "blog",
		"tags" => "blog:".$selected_tag, 
		"status" => 1, 
		"extend" => [
			"user" => true, 
			"mediae" => true, 
			"tags" => true
		]
	]);
}


if($page_item) {
	$this->sharingMetaData($page_item);
}
else {
	$this->sharingMetaData(["description" => "Something about $selected_tag"]);
}




// get log tags for listing
$categories = $IC->getTags(array("context" => $itemtype));


$pagination_pattern = [
	"pattern" => [
		"itemtype" => $itemtype, 
		"status" => 1, 
		"extend" => [
			"tags" => true, 
			"user" => true, 
			"mediae" => true,
			"readstate" => true
		]
	],
	"page" => $page,
	"tags" => $itemtype.":".addslashes($selected_tag), 
	"limit" => 5
];

// Get posts
$items = $IC->paginate($pagination_pattern);


?>

<div class="scene details posts tag i:columns">

<? if($page_item): 
	$media = $IC->sliceMediae($page_item, "single_media"); ?>
	<div class="article i:article" itemscope itemtype="http://schema.org/Article">

		<? if($media): ?>
		<div class="image item_id:<?= $page_item["item_id"] ?> format:<?= $media["format"] ?> variant:<?= $media["variant"] ?>"></div>
		<? endif; ?>

		<h1 itemprop="headline"><?= $page_item["name"] ?></h1>

		<?= $HTML->articleInfo($page_item, "/details/posts/tag/".urlencode($selected_tag), [
			"media" => $media,
			"sharing" => true
		]) ?>


		<? if($page_item["html"]): ?>
		<div class="articlebody" itemprop="articleBody">
			<?= $page_item["html"] ?>
		</div>
		<? endif; ?>
	</div>

<? else: ?>

	<div class="article">
		<h1><?= $selected_tag ?></h1>
	</div>

<? endif; ?>


	<div class="articles">
<? if($items && $items["range_items"]): ?>

		<h2><?= $items["total"] ?> Posts</h2>

		<?= $HTML->pagination($items, [
			"base_url" => "/details/posts/tag/".urlencode($selected_tag), 
			"direction" => "prev",
			"show_total" => false,
			"labels" => ["prev" => "Previous posts"]
		]) ?>

		<ul class="items articles articlePreviewList i:articlePreviewList">
			<? foreach($items["range_items"] as $item):
				$media = $IC->sliceMediae($item, "mediae"); ?>
			<li class="item article id:<?= $item["item_id"] ?>" itemscope itemtype="http://schema.org/NewsArticle"
				data-readstate="<?= $item["readstate"] ?>"
				>

				<? if($media): ?>
				<div class="image item_id:<?= $item["item_id"] ?> format:<?= $media["format"] ?> variant:<?= $media["variant"] ?>">
					<p>Image: <a href="/images/<?= $item["item_id"] ?>/<?= $media["variant"] ?>/500x.<?= $media["format"] ?>"><?= $media["name"] ?></a></p>
				</div>
				<? endif; ?>


				<?= $HTML->articleTags($item, [
					"context" => ["post"],
					"url" => "/details/posts/tag",
					"default" => ["/details/posts", "Posts"]
				]) ?>


				<h3 itemprop="headline"><a href="/details/posts/tag/<?= urlencode($selected_tag) ?>/<?= $item["sindex"] ?>"><?= strip_tags($item["name"]) ?></a></h3>


				<?= $HTML->articleInfo($item, "/details/posts/".$item["sindex"], [
					"media" => $media
				]) ?>


				<? if($item["description"]): ?>
				<div class="description" itemprop="description">
					<p><?= nl2br($item["description"]) ?></p>
				</div>
				<? endif; ?>

			</li>
			<? endforeach; ?>
		</ul>


		<?= $HTML->pagination($items, [
			"base_url" => "/details/posts/tag/".urlencode($selected_tag),
			"direction" => "next",
			"show_total" => false,
			"labels" => ["next" => "Next posts"]
		]) ?>

<? else: ?>
		<p>No posts</p>
<? endif; ?>
	</div>


	<?= $HTML->searchBox("/details/posts/search", [
		"headline" => "Search posts",
		"pattern" => $pagination_pattern["pattern"],
		"tag" => $itemtype.":".$selected_tag
	]) ?>


<? if($categories): ?>
	<div class="categories">
		<h2>Categories</h2>
		<ul class="tags">
			<? foreach($categories as $tag): ?>
			<li<?= $tag["value"] === $selected_tag ? ' class="selected"' : '' ?>><a href="/details/posts/tag/<?= urlencode($tag["value"]) ?>"><?= $tag["value"] ?></a></li>
			<? endforeach; ?>
			<li class="all"><a href="/details/posts">All postings</a></li>
		</ul>
	</div>
<? endif; ?>

</div>
