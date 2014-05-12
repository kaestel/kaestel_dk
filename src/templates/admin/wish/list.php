<?php
global $action;
global $IC;
global $model;
global $itemtype;

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
				$item = $IC->extendItem($item, array("tags" => true)); ?>
			<li class="item item_id:<?= $item["id"] ?> image:<?= $item["files"] ?> width:160">
				<h3><?= $item["name"] ?></h3>
				<dl>
					<dt class="reserved">Reserved</dt>
					<dd class="reserved"><?= $model->wish_reserved[$item["reserved"]] ?></dd>
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
					<li class="delete"></li>
					<li class="status <?= ($item["status"] == 1 ? "enabled" : "disabled") ?>"></li>
				</ul>
			 </li>
<?			endforeach; ?>
		</ul>
<?		else: ?>
		<p>No wishes.</p>
<?		endif; ?>
	</div>

</div>
