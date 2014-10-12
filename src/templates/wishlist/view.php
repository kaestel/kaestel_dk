
<?
global $action;
global $IC;
global $model;
global $itemtype;

$wishlist = $IC->getCompleteItem(array("sindex" => $action[1]));

if($wishlist && $wishlist["tags"]):

	$tags = array();
	foreach($wishlist["tags"] as $tag) {
		array_push($tags, $tag["context"].":".$tag["value"]);
	}
	$items = $IC->getItems(array("status" => 1, "itemtype" => "wish", "tags" => implode($tags, ";"), "order" => "wish.name"));

endif;

?>
<div class="scene wishes i:wishes">
	<h1><?= $wishlist["name"] ?></h1>

<?	if($items): ?>
	<ul class="items">
<?		foreach($items as $item): 
			$item = $IC->extendItem($item);
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
					<?= $model->formStart("/wishlist/reserve/".$item["id"], array("class" => "labelstyle:inject")) ?>
						<?= $model->submit("Available", array("class" => "primary")) ?>
					<?= $model->formEnd() ?>
				</li>
				<li class="unreserve">
					<?= $model->formStart("/wishlist/unreserve/".$item["id"], array("class" => "labelstyle:inject")) ?>
						<?= $model->submit("Reserved", array("class" => "secondary")) ?>
					<?= $model->formEnd() ?>
				</li>
			</ul>
		 </li>
<?		endforeach; ?>
	</ul>
<?	endif; ?>

</div>
