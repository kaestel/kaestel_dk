<?php
global $action;
global $IC;

$itemtype = "post";

// List extension (page > 1)
if(count($action) === 3) {
	$page = $action[2];
	$page_item = false;
}
// Default list
else {
	$page = false;
	$page_item = $IC->getItem([
		"tags" => "page:Posts", 
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
	$this->sharingMetaData(["description" => "I'm not sure where it comes from and perhaps it shouldn't be shared – but here it is."]);
}

// Get post tags for listing
$categories = $IC->getTags(array("context" => $itemtype, "order" => "value"));

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
	"limit" => 5
];


// Get posts
$items = $IC->paginate($pagination_pattern);

?>

<div class="scene details posts i:columns">

<? if($page_item): 
	$media = $IC->sliceMediae($page_item, "single_media"); ?>
	<div class="article i:article" itemscope itemtype="http://schema.org/Article">

		<? if($media): ?>
		<div class="image item_id:<?= $page_item["item_id"] ?> format:<?= $media["format"] ?> variant:<?= $media["variant"] ?>"></div>
		<? endif; ?>


		<?= $HTML->articleTags($page_item, [
			"context" => false
		]) ?>


		<h1 itemprop="headline"><?= $page_item["name"] ?></h1>

		<? if($page_item["subheader"]): ?>
		<h2 itemprop="alternativeHeadline"><?= $page_item["subheader"] ?></h2>
		<? endif; ?>


		<?= $HTML->articleInfo($page_item, "/details/posts", [
			"media" => $media,
		]) ?>


		<? if($page_item["html"]): ?>
		<div class="articlebody" itemprop="articleBody">
			<?= $page_item["html"] ?>
		</div>
		<? endif; ?>
	</div>

<? else: ?>

	<div class="article">
		<h1>Postings from the void of Banausia</h1>
	</div>

<? endif; ?>


<? if($categories): ?>
	<div class="categories">
		<h2>Categories</h2>
		<ul class="tags">
			<? foreach($categories as $tag): ?>
			<li><a href="/details/posts/tag/<?= urlencode($tag["value"]) ?>"><?= $tag["value"] ?></a></li>
			<? endforeach; ?>
			<li class="all selected"><a href="/details/posts">All postings</a></li>
		</ul>
	</div>
<? endif; ?>


	<?= $HTML->searchBox("/details/posts/search", [
		"headline" => "Search posts",
		"pattern" => $pagination_pattern["pattern"]
	]) ?>


	<div class="articles">

<? if($items): ?>

		<h2>All posts</h2>

		<?= $HTML->pagination($items, [
			"base_url" => "/details/posts", 
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
					"context" => [$itemtype],
					"url" => "/details/posts/tag",
					"default" => ["/details/posts", "Posts"]
				]) ?>


				<h3 itemprop="headline"><a href="/details/posts/<?= $item["sindex"] ?>"><?= strip_tags($item["name"]) ?></a></h3>


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
			"base_url" => "/details/posts",
			"direction" => "next",
			"show_total" => false,
			"labels" => ["next" => "Next posts"]
		]) ?>

<? else: ?>
		<p>No posts</p>
<? endif; ?>
	</div>

</div>
