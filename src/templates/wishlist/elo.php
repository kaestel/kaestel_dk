
<?
global $action;
global $IC;
global $model;
global $itemtype;



$page_item = $IC->getItem(array("tags" => "page:elo-s-buffet", "extend" => array("user" => true, "mediae" => true, "tags" => true)));


$wishlist = $IC->getItem(array("sindex" => "elos-buffet", "extend" => true));
$items = false;

if($wishlist) {
	$model_wishlist = $IC->typeObject("wishlist");

	// get wishes order
	$items = $model_wishlist->getOrderedWishes($wishlist["item_id"], array("status" => 1));

}
else {
	$wishlist["name"] = "Unknown wishlist";
}

?>
<div class="scene wishes i:wishes elosbuffet">

<? if($page_item && $page_item["status"]): 
	$media = $IC->sliceMedia($page_item); ?>
	<div class="article i:article id:<?= $page_item["item_id"] ?>" itemscope itemtype="http://schema.org/Article">

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


		<?= $HTML->articleInfo($page_item, "/contact", [
			"media" => $media,
			"sharing" => false
		]) ?>


		<? if($page_item["html"]): ?>
		<div class="articlebody" itemprop="articleBody">
			<?= $page_item["html"] ?>
		</div>
		<? endif; ?>
	</div>
<? else:?>
	<h1>Elo's Buffet</h1>
<? endif; ?>



<? if($items): ?>
	<ul class="items wishes" data-confirm-reserve="Ja, jeg mener det">
		<? foreach($items as $item): ?>
		<li class="item id:<?= $item["id"] ?>">
			<h3><?= $item["name"] ?></h3>

			<? if($item["description"]): ?>
			<div class="description">
				<p><?= $item["description"] ?></p>
				<p class="<?= ($item["reserved"] ? "reserved" : "available") ?>">Medbringes af: <span><?= $item["reserved"] ? ($item["reserved"] == 1 ? "Anonym" : $item["reserved"]) : "Dig?" ?></span></p>
			</div>
			<? endif; ?>

			<ul class="actions <?= ($item["reserved"] ? "reserved" : "") ?>">
				<? if(!$item["reserved"]): ?>
				<li class="reserve">
					<?= $model->formStart("reserve/".$item["id"], array("class" => "labelstyle:inject")) ?>
						<?= $model->input("reserved", array("label" => "Skriv dit navn", "value" => ($item["reserved"] ? $item["reserved"] : ((session()->value("user_id") && session()->value("user_group_id") > 1) ? session()->value("user_nickname") : "")))) ?>
						<?= $model->submit("Ok, dén snupper jeg", array("class" => "primary", "name" => "reserve")) ?>
					<?= $model->formEnd() ?>
				</li>
				<? else: ?>
				<?= $JML->oneButtonForm("Jeg har fortrudt", "/elos-buffet/unreserve/".$item["id"], array(
					"confirm-value" => "Er du sikker?",
					"class" => "secondary",
					"name" => "unreserve",
					"wrapper" => "li.unreserve",
				)) ?>
				<? endif; ?>
			</ul>

		 </li>
	 	<? endforeach; ?>
	</ul>
<? endif; ?>

</div>
