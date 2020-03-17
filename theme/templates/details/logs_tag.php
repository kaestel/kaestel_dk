<?php
global $IC;
global $action;

$itemtype = "log";
$selected_tag = urldecode($action[1]);

include("classes/items/taglist.class.php");
$TL = new TagList();
$tag_list = $TL->getTagList(["handle" => "logbooks"]);


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

if($page_item) {
	$this->sharingMetaData($page_item);
}
else {
	$this->sharingMetaData(["description" => "Something about $selected_tag"]);
}


// get content pagination
$items = $IC->getItems([
	"itemtype" => $itemtype, 
	"status" => 1, 
	"tags" => $itemtype.":".addslashes($selected_tag), 
	"order" => "published_at ASC", 
	"extend" => ["tags" => true, "user" => true, "mediae" => true]
]);

?>

<div class="scene details logs tag i:columns">

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
<? if($items): ?>
		<ul class="items logs articles i:articleList">
<?		foreach($items as $item):
			$media = $IC->sliceMediae($item, "mediae"); ?>
			<li class="item article log id:<?= $item["item_id"] ?>" itemscope itemtype="http://schema.org/BlogPosting">

<?			if($media): ?>
				<div class="image item_id:<?= $item["item_id"] ?> format:<?= $media["format"] ?> variant:<?= $media["variant"] ?>">
					<p>Image: <a href="/images/<?= $item["item_id"] ?>/<?= $media["variant"] ?>/500x.<?= $media["format"] ?>"><?= $media["name"] ?></a></p>
				</div>
<?			endif; ?>


				<h2 itemprop="headline"><?= $item["name"] ?></h2>


				<?= $HTML->articleInfo($item, "/details/logs/".$selected_tag, [
					"media" => $media, 
				]) ?>


				<div class="articlebody" itemprop="articleBody">
					<?= $item["html"] ?>
				</div>

				<?
				$mediae = $IC->filterMediae($item, "mediae");
				if($mediae): ?>
				<? foreach($mediae as $media): ?>
				<div class="image item_id:<?= $item["item_id"] ?> format:<?= $media["format"] ?> variant:<?= $media["variant"] ?>">
					<p>Image: <a href="/images/<?= $item["item_id"] ?>/<?= $media["variant"] ?>/500x.<?= $media["format"] ?>"><?= $media["name"] ?></a></p>
				</div>
				<? endforeach;
				endif; ?>

			</li>
<?		endforeach; ?>
		</ul>
<? endif; ?>
	</div>


<? 	if($tag_list && $tag_list["tags"]): ?>
	<div class="categories">
		<h2>Logbooks</h2>
		<ul class="tags">
<?		foreach($tag_list["tags"] as $tag): ?>
			<li<?= $tag["value"] === $selected_tag ? ' class="selected"' : '' ?>><a href="/details/logs/<?= urlencode($tag["value"]) ?>"><?= $tag["value"] ?></a></li>
<?		endforeach; ?>
		</ul>
	</div>
<?	endif; ?>

</div>
