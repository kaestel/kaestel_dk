
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
	$items = $model_wishlist->getOrderedWishes($wishlist["item_id"], array("status" => 1));

}
else {
	$wishlist["name"] = "Unknown wishlist";
}

?>
<div class="scene wishes i:wishes">
	<h1><?= $wishlist["name"] ?></h1>

<?	if($items): ?>
	<ul class="items wishes images">
<?		foreach($items as $index => $item):
			$media = $item["mediae"] ? array_shift($item["mediae"]) : false; ?>
		<li class="item id:<?= $item["id"] ?> format:<?= $media["format"] ?> variant:<?= $media["variant"] ?>">
			<h3><?= $item["name"] ?></h3>

			<div class="priority"><?= ($index+1) ?></div>

<?			if($item["description"]): ?>
			<div class="description">
				<p><?= $item["description"] ?></p>

				<p class="<?= ($item["reserved"] ? "reserved" : "available") ?>">Reserved by: <span><?= $item["reserved"] ? ($item["reserved"] == 1 ? "Anonym" : $item["reserved"]) : "Dig?" ?></span></p>

			</div>
<?			endif; ?>

			<dl class="info">
				<dt class="price">Set til</dt>
				<dd class="price">DKK <?= $item["price"] ?></dd>
<?			if($item["link"]): ?>
				<dt class="link">Link</dt>
				<dd class="link"><a href="<?= $item["link"] ?>" target="_blank"><?= $item["link"] ?></a></dd>
<?			endif; ?>
			</dl>



			<ul class="actions <?= ($item["reserved"] == 1 ? "reserved" : "") ?>">
				<? if(!$item["reserved"]): ?>
				<li class="reserve">
					<?= $model->formStart("reserve/".$item["id"], array("class" => "labelstyle:inject")) ?>
						<?= $model->input("reserved", array("label" => "Your name?", "value" => ($item["reserved"] ? $item["reserved"] : ((session()->value("user_id") && session()->value("user_group_id") > 1) ? session()->value("user_nickname") : "")))) ?>
						<?= $model->submit("Reserve this item", array("class" => "primary", "name" => "reserve")) ?>
					<?= $model->formEnd() ?>
				</li>
				<? else: ?>
				<?= $HTML->oneButtonForm("Ups, I didn't mean it", "/elos-buffet/unreserve/".$item["id"], array(
					"confirm-value" => "Are you sure?",
					"class" => "secondary",
					"name" => "unreserve",
					"wrapper" => "li.unreserve",
				)) ?>
				<? endif; ?>
			</ul>
		 </li>
<?		endforeach; ?>
	</ul>
<?	endif; ?>

</div>
