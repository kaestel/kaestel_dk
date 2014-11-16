<?php
global $action;
global $IC;
global $model;
global $itemtype;

$item = $IC->getCompleteItem(array("id" => $action[1]));
$item_id = $item["item_id"];

// set page description
$this->pageDescription($item["description"]);
?>
<div class="scene defaultEdit <?= $itemtype ?>Edit">
	<h1>Edit log entry</h1>

	<ul class="actions i:defaultEditActions item_id:<?= $item_id ?>"
		data-csrf-token="<?= session()->value("csrf") ?>"
		>
		<?= $HTML->link("List", "/janitor/".$itemtype."/list", array("class" => "button", "wrapper" => "li.cancel")) ?>
		<?= $HTML->deleteButton("Delete", "/janitor/admin/items/delete/".$item["id"], array("js" => true)) ?>
	</ul>

	<div class="status i:defaultEditStatus item_id:<?= $item["id"] ?>"
		data-csrf-token="<?= session()->value("csrf") ?>"
		>
		<ul class="actions">
			<?= $HTML->statusButton("Enable", "Disable", "/janitor/admin/items/status", $item, array("js" => true)) ?>
		</ul>
	</div>

	<div class="item i:defaultEdit">
		<h2>Log entry</h2>
		<?= $model->formStart("/janitor/admin/items/update/".$item_id, array("class" => "labelstyle:inject")) ?>
			<fieldset>
				<?= $model->input("name", array("value" => $item["name"])) ?>
				<?= $model->input("published_at", array("value" => $item["published_at"])) ?>
				<?= $model->input("description", array("class" => "autoexpand short", "value" => $item["description"])) ?>
				<?= $model->inputLocation("location", "latitude", "longitude", array("value_loc" => $item["location"], "value_lat" => $item["latitude"], "value_lon" => $item["longitude"])) ?>

				<?= $model->input("html", array("value" => $item["html"])) ?>
			</fieldset>

			<ul class="actions">
				<?= $model->link("Back", "/janitor/".$itemtype."/list", array("class" => "button key:esc", "wrapper" => "li.cancel")) ?>
				<?= $model->submit("Update", array("class" => "primary key:s", "wrapper" => "li.save")) ?>
			</ul>
		<?= $model->formEnd() ?>
	</div>

	<div class="tags i:defaultTags item_id:<?= $item_id ?>"
		data-get-tags="<?= $this->validPath("/janitor/admin/items/tags") ?>" 
		data-delete-tag="<?= $this->validPath("/janitor/admin/items/tags/delete") ?>"
		>
		<h2>Tags</h2>
		<?= $model->formStart("/janitor/admin/items/tags/add/".$item_id, array("class" => "labelstyle:inject")) ?>
			<fieldset>
				<?= $model->input("tags") ?>
			</fieldset>

			<ul class="actions">
				<?= $model->submit("Add new tag", array("class" => "primary", "wrapper" => "li.save")) ?>
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

	<div class="media i:addMedia sortable item_id:<?= $item_id ?>"
		data-save-order="/janitor/<?= $itemtype ?>/updateMediaOrder" 
		data-delete-media="<?= $this->validPath("/janitor/".$itemtype."/deleteMedia") ?>"
		data-update-media-name="<?= $this->validPath("/janitor/".$itemtype."/updateMediaName") ?>"
		>
		<h2>Media</h2>
		<?= $model->formStart("/janitor/".$itemtype."/addMedia/".$item_id, array("class" => "upload labelstyle:inject")) ?>
			<fieldset>
				<?= $model->input("mediae") ?>
			</fieldset>

			<ul class="actions">
				<?= $model->submit("Add image", array("class" => "primary", "wrapper" => "li.save")) ?>
			</ul>
		<?= $model->formEnd() ?>

		<ul class="mediae">
<?		if($item["mediae"]): ?>
<?			foreach($item["mediae"] as $index => $media): ?>
			<li class="media image variant:<?= $index ?> media_id:<?= $media["id"] ?>">
				<img src="/images/<?= $item_id ?><?= ($index ? "/".$index : "") ?>/x150.<?= $media["format"] ?>" />
				<p><?= $media["name"] ?></p>
			</li>
<?			endforeach; ?>
<?		endif; ?>
		</ul>

	</div>

</div>
