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
		<?= $HTML->link("New wish", "/admin/".$itemtype."/new", array("class" => "button primary key:n", "wrapper" => "li.new")) ?>
	</ul>

	<div class="all_items i:defaultList taggable filters" 
		data-csrf-token="<?= session()->value("csrf") ?>"
		data-get-tags="<?= $this->validAction("/admin/cms/tags") ?>" 
		data-delete-tag="<?= $this->validAction("/admin/cms/tags/delete") ?>"
		data-add-tag="<?= $this->validAction("/admin/cms/tags/add") ?>"
		>
<?		if($all_items): ?>
		<ul class="items">
<?			foreach($all_items as $item): 
				$item = $IC->extendItem($item, array("tags" => true));
				$media = $item["mediae"] ? array_shift($item["mediae"]) : false; ?>
			<li class="item item_id:<?= $item["id"] ?><?= $media ? (" image:".$media["format"]." variant:".$media["variant"]) : "" ?> width:160">
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
					<?= $HTML->link("Edit", "/admin/".$itemtype."/edit/".$item["id"], array("class" => "button", "wrapper" => "li.edit")) ?>
					<?= $HTML->deleteButton("Delete", "/admin/cms/delete/".$item["id"], array("js" => true)) ?>
					<?= $HTML->statusButton("Enable", "Disable", "/admin/cms/status", $item, array("js" => true)) ?>
				</ul>
			 </li>
<?			endforeach; ?>
		</ul>
<?		else: ?>
		<p>No wishes.</p>
<?		endif; ?>
	</div>

</div>
