<?php
global $action;
global $IC;
global $model;
global $itemtype;

$all_items = $IC->getItems(array("itemtype" => $itemtype, "order" => "position ASC"));
?>
<div class="scene defaultList <?= $itemtype ?>List">
	<h1>Wishlists</h1>

	<ul class="actions">
		<?= $HTML->link("New wishlist", "/admin/".$itemtype."/new", array("class" => "button primary key:n", "wrapper" => "li.new")) ?>
	</ul>


	<div class="all_items i:defaultList taggable filters sortable">
<?		if($all_items): ?>
		<ul class="items targets:draggable" data-save-order="/admin/<?= $itemtype ?>/updateOrder">
<?			foreach($all_items as $item): 
				$item = $IC->extendItem($item, array("tags" => true)); ?>
			<li class="item draggable id:<?= $item["item_id"] ?>">
				<div class="drag"></div>
				<h3><?= $item["name"] ?></h3>

<?				if($item["tags"]): ?>
				<ul class="tags">
<?					foreach($item["tags"] as $tag): ?>
					<li><span class="context"><?= $tag["context"] ?></span>:<span class="value"><?= $tag["value"] ?></span></li>
<?					endforeach; ?>
				</ul>
<?				endif; ?>

				<ul class="actions">
					<?= $HTML->link("Edit", "/admin/".$itemtype."/edit/".$item["id"], array("class" => "button", "wrapper" => "li.edit")) ?>
					<?= $HTML->delete("Delete", "/admin/cms/delete/".$item["id"], array("js" => true)) ?>
					<?= $HTML->status("Enable", "Disable", "/admin/cms/status", $item, array("js" => true)) ?>
				</ul>
			 </li>
<?			endforeach; ?>
		</ul>
<?		else: ?>
		<p>No wishlists.</p>
<?		endif; ?>
	</div>

</div>
