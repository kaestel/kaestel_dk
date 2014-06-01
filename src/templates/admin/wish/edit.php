<?php
global $action;
global $IC;
global $model;
global $itemtype;

$item = $IC->getCompleteItem(array("id" => $action[1]));
$item_id = $item["item_id"];
?>
<div class="scene defaultEdit <?= $itemtype ?>Edit">
	<h1>Edit wish</h1>

	<ul class="actions i:defaultEditActions item_id:<?= $item_id ?>">
		<?= $HTML->link("Back", "/admin/".$itemtype."/list", array("class" => "button", "wrapper" => "li.cancel")) ?>
		<?= $HTML->delete("Delete", "/admin/cms/delete/".$item["id"], array("js" => true)) ?>
	</ul>

	<div class="status i:defaultEditStatus item_id:<?= $item["id"] ?>">
		<ul class="actions">
			<?= $HTML->status("Enable", "Disable", "/admin/cms/status", $item, array("js" => true)) ?>
		</ul>
	</div>

	<div class="item i:defaultEdit">
		<form action="/admin/cms/update/<?= $item_id ?>" class="labelstyle:inject" method="post" enctype="multipart/form-data">
			<fieldset>
				<?= $model->input("name", array("value" => $item["name"])) ?>
				<?= $model->input("price", array("value" => $item["price"])) ?>
				<?= $model->input("link", array("value" => $item["link"])) ?>
				<?= $model->input("description", array("class" => "autoexpand", "value" => $item["description"])) ?>
				<?= $model->input("reserved", array("value" => $item["reserved"])) ?>
			</fieldset>

			<ul class="actions">
				<?= $model->link("Back", "/admin/".$itemtype."/list", array("class" => "button key:esc", "wrapper" => "li.cancel")) ?>
				<?= $model->submit("Update", array("class" => "primary key:s", "wrapper" => "li.save")) ?>
			</ul>
		<?= $model->formEnd() ?>
	</div>

	<h2>Tags</h2>
	<div class="tags i:defaultTags item_id:<?= $item_id ?>">
		<?= $model->formStart("/admin/cms/update/".$item_id, array("class" => "labelstyle:inject")) ?>
			<fieldset>
				<?= $model->input("tags") ?>
			</fieldset>

			<ul class="actions">
				<?= $model->submit("Add tag", array("class" => "primary", "wrapper" => "li.save")) ?>
			</ul>
		<?= $model->formEnd() ?>

		<ul class="tags">
<?		if($item["tags"]): ?>
<?			foreach($item["tags"] as $index => $tag): ?>
			<li class="tag">
				<span class="context"><?= $tag["context"] ?></span>:<span class="value"><?= $tag["value"] ?></span>
			</li>
<?			endforeach; ?>
<?		endif; ?>
		</ul>
	</div>

	<h2>Media</h2>
	<div class="media i:addMedia">
		<p>Image must be 200x90 pixels, jpg or png.</p>

		<?= $model->formStart("/admin/cms/update/".$item_id, array("class" => "upload labelstyle:inject")) ?>
			<fieldset>
				<?= $model->input("files") ?>
			</fieldset>

			<ul class="actions">
				<?= $model->submit("Add image", array("class" => "primary", "wrapper" => "li.save")) ?>
			</ul>
		<?= $model->formEnd() ?>

		</form>

		<ul class="media">
			<li class="image">
				<h4>Image</h4>
<?		if($item["files"]): ?>
				<img src="/images/<?= $item["id"] ?>/160x.<?= $item["files"] ?>">
<?		else: ?>
				<img src="/images/0/missing/160x.png">
<?		endif; ?>
			</li>
		</ul>

	</div>

</div>
