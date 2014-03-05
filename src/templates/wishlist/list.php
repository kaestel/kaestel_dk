
<?
$IC = new Item();
$enabled_items = $IC->getItems(array("itemtype" => "wish", "status" => 1, "order" => "reserved ASC, price ASC"));
?>
<div class="scene wishlist">
	<h1>Ønskesedler</h1>


	<div class="enabled_items">
		<h2>Romeo, Jul 2013</h2>
<?		if($enabled_items): ?>
		<ul class="items">
<?			foreach($enabled_items as $item): 
				$item = $IC->getCompleteItem($item["id"]); ?>
			<li class="item">
				<div class="image">
					<img src="/images/<?= $item["id"] ?>/200x.<?= $item["files"] ?>" />
				</div>
				<div class="text">
					<h3><?= $item["name"] ?></h3>
					<div class="price"><?= $item["price"] ?></div>
					<p><?= $item["description"] ?></p>
					<ul class="actions">
						<li class="status">
							<form action="/wishlist/<?= ($item["reserved"] == 1 ? "unreserve" : "reserve") ?>/<?= $item["id"] ?>" class="i:wishlist" method="post" enctype="multipart/form-data">
								<input type="submit" value="<?= ($item["reserved"] == 1 ? "un-reserve" : "reserve") ?>" class="button status" />
							</form>
						</li>
					</ul>
				</div>
			 </li>
<?			endforeach; ?>
		</ul>
<?		endif; ?>
	</div>


</div>
