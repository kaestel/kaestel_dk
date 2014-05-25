<?php
global $action;
global $IC;
global $model;
global $itemtype;

$item = $IC->getCompleteItem(array("id" => $action[1]));
$item_id = $item["item_id"];
?>
<div class="scene defaultEdit <?= $itemtype ?>Edit">
	<h1>Edit log entry</h1>

	<ul class="actions">
		<li class="cancel"><a href="/admin/<?= $itemtype ?>/list" class="button">Back</a></li>
	</ul>

	<div class="status i:defaultEditStatus item_id:<?= $item_id ?>">
		<ul class="actions">
			<li class="status <?= ($item["status"] == 1 ? "enabled" : "disabled") ?>"></li>
		</ul>
	</div>

	<div class="item i:defaultEdit">
		<form action="/admin/cms/update/<?= $item_id ?>" class="labelstyle:inject" method="post" enctype="multipart/form-data">
			<fieldset>
				<?= $model->input("published_at", array("value" => $item["published_at"])) ?>

				<?= $model->input("name", array("value" => $item["name"])) ?>
				<?= $model->input("description", array("class" => "autoexpand short", "value" => $item["description"])) ?>
				<?= $model->input("html", array("class" => "autoexpand", "value" => $item["html"])) ?>

				<?= $model->inputLocation("location", "latitude", "longitude", array("value_loc" => $item["location"], "value_lat" => $item["latitude"], "value_lon" => $item["longitude"])) ?>
			</fieldset>

			<ul class="actions">
				<li class="cancel"><a href="/admin/<?= $itemtype ?>/list" class="button key:esc">Back</a></li>
				<li class="save"><input type="submit" value="Update" class="button primary key:s" /></li>
			</ul>
		</form>
	</div>

	<h2>Tags</h2>
	<div class="tags i:defaultTags item_id:<?= $item_id ?>">
		<form action="/admin/cms/update/<?= $item_id ?>" class="labelstyle:inject" method="post" enctype="multipart/form-data">
			<fieldset>
				<?= $model->input("tags") ?>
			</fieldset>

			<ul class="actions">
				<li class="save"><input type="submit" value="Add tag" class="button primary" /></li>
			</ul>
		</form>

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
		<p>Image must be jpg or png.</p>

		<form action="/admin/cms/update/<?= $item_id ?>" class="upload labelstyle:inject" method="post" enctype="multipart/form-data">
			<fieldset>
				<?= $model->input("files") ?>
			</fieldset>

			<ul class="actions">
				<li class="save"><input type="submit" value="Add image" class="button primary" /></li>
			</ul>

		</form>

		<ul class="media">
			<li class="image">
				<h4>Image</h4>
<?		if($item["files"]): ?>
				<img src="/images/<?= $item["id"] ?>/160x.<?= $item["files"] ?>" alt="Current image" />
<?		else: ?>
				<img src="/images/0/missing/160x.png" alt="Missing image" />
<?		endif; ?>
			</li>
		</ul>

	</div>

</div>
