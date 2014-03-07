
<?
global $action;
global $IC;
global $model;
global $itemtype;

$wishlist = $IC->getCompleteItem($action[1]);

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
			$item = $IC->getCompleteItem($item["id"]); ?>
		<li class="item id:<?= $item["id"] ?> format:<?= $item["files"] ?>">
			<h3><?= $item["name"] ?></h3>
			<div class="description">
				<p><?= $item["description"] ?></p>
			</div>
			<dl>
				<dt>Pris</dt>
				<dd><?= $item["price"] ?></dd>
			</dl>
			<ul class="actions <?= ($item["reserved"] == 1 ? "reserved" : "") ?>">
				<li class="reserve">
					<form action="/wishlist/reserve/<?= $item["id"] ?>" method="post" enctype="multipart/form-data">
						<input type="submit" value="Reserve" class="button primary" />
					</form>
				</li>
				<li class="unreserve">
					<form action="/wishlist/unreserve/<?= $item["id"] ?>" method="post" enctype="multipart/form-data">
						<input type="submit" value="Un-reserve" class="button secondary" />
					</form>
				</li>
			</ul>
		 </li>
<?		endforeach; ?>
	</ul>
<?	endif; ?>

</div>
