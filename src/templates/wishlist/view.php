
<?
global $action;
global $IC;
global $model;
global $itemtype;

$wishlist = $IC->getItem(array("sindex" => $action[1], "extend" => true));
$items = false;

if($wishlist) {
	$model_wishlist = $IC->typeObject("wishlist");

	// get wishes order
	$items = $model_wishlist->getOrderedWishes($wishlist["item_id"]);

}
else {
	$wishlist["name"] = "Unknown wishlist";
}

?>
<div class="scene wishes i:wishes">
	<h1><?= $wishlist["name"] ?></h1>

<?	if($items): ?>
	<ul class="items wishes">
<?		foreach($items as $item):
			$media = $item["mediae"] ? array_shift($item["mediae"]) : false; ?>
		<li class="item id:<?= $item["id"] ?> format:<?= $media["format"] ?> variant:<?= $media["variant"] ?>">
			<h3><?= $item["name"] ?></h3>

<?			if($item["description"]): ?>
			<div class="description">
				<p><?= $item["description"] ?></p>
			</div>
<?			endif; ?>

			<dl class="info">
				<dt class="price">Pris</dt>
				<dd class="price">DKK <?= $item["price"] ?></dd>
<?			if($item["link"]): ?>
				<dt class="link">Link</dt>
				<dd class="link"><a href="<?= $item["link"] ?>" target="_blank"><?= $item["link"] ?></a></dd>
<?			endif; ?>
			</dl>

			<ul class="actions <?= ($item["reserved"] == 1 ? "reserved" : "") ?>">
				<li class="reserve">
					<?= $model->formStart("reserve/".$item["id"], array("class" => "labelstyle:inject")) ?>
						<?= $model->submit("Available", array("class" => "primary")) ?>
					<?= $model->formEnd() ?>
				</li>
				<li class="unreserve">
					<?= $model->formStart("unreserve/".$item["id"], array("class" => "labelstyle:inject")) ?>
						<?= $model->submit("Reserved", array("class" => "secondary")) ?>
					<?= $model->formEnd() ?>
				</li>
			</ul>
		 </li>
<?		endforeach; ?>
	</ul>
<?	endif; ?>

</div>
