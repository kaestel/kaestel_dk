<?php
$action = $this->actions();

$IC = new Item();
$itemtype = "wish";

$all_items = $IC->getItems(array("itemtype" => $itemtype, "order" => "status DESC"));

?>
<div class="scene defaultList <?= $itemtype ?>List">
	<h1>Wishes</h1>

	<ul class="actions">
		<li class="new"><a href="/admin/<?= $itemtype ?>/new" class="button primary key:n">New wish</a></li>
	</ul>

	<div class="all_items i:defaultList taggable filters">
<?		if($all_items): ?>
		<ul class="items">
<?			foreach($all_items as $item): 
				$item = $IC->getCompleteItem($item["id"]);
				 ?>
			<li class="item item_id:<?= $item["id"] ?> image:<?= $item["files"] ?> width:160">
				<h3><?= $item["name"] ?></h3>
				<dl>
					<dt class="reserved">Reserved</dt>
					<dd class="reserved"><?= $item["reserved"] ? "Reserved" : "Available" ?></dd>
				</dl>
<?				if($item["tags"]): ?>
				<ul class="tags">
<?					foreach($item["tags"] as $tag): ?>
					<li><span class="context"><?= $tag["context"] ?></span>:<span class="value"><?= $tag["value"] ?></span></li>
<?					endforeach; ?>
				</ul>
<?				endif; ?>

				<ul class="actions">
					<li class="edit"><a href="/admin/<?= $itemtype ?>/edit/<?= $item["id"] ?>" class="button">Edit</a></li>
					<li class="delete">
						<form action="/admin/cms/delete/<?= $item["id"] ?>" class="i:formDefaultDelete" method="post" enctype="multipart/form-data">
							<input type="submit" value="Delete" class="button delete" />
						</form>
					</li>
					<li class="status">
						<form action="/admin/cms/<?= ($item["status"] == 1 ? "disable" : "enable") ?>/<?= $item["id"] ?>" class="i:formDefaultStatus" method="post" enctype="multipart/form-data">
							<input type="submit" value="<?= ($item["status"] == 1 ? "Disable" : "Enable") ?>" class="button status" />
						</form>
					</li>
				</ul>
			 </li>
<?			endforeach; ?>
		</ul>
<?		else: ?>
		<p>No wishes.</p>
<?		endif; ?>
	</div>

</div>
