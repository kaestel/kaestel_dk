<?php
$access_item = false;
if(isset($read_access) && $read_access) {
	return;
}

include_once($_SERVER["FRAMEWORK_PATH"]."/config/init.php");

$action = $page->actions();

$IC = new Item();
$model = $IC->typeObject("wish");

$item = $IC->getCompleteItem($action[0]);

?>
<? $page->header(array("type" => "admin")) ?>

<div class="scene defaultEdit">

	<h1>Edit wish</h1>
	<div class="item">
		<form action="/admin/cms/update/<?= $action[0] ?>" class="i:formDefaultEdit labelstyle:inject" method="post" enctype="multipart/form-data">
			<fieldset>
				<?= $model->input("name", array("value" => $item["name"])) ?>
				<?= $model->input("price", array("value" => $item["price"])) ?>
				<?= $model->input("link", array("value" => $item["link"])) ?>
				<?= $model->input("description", array("class" => "autoexpand", "value" => $item["description"])) ?>
				<?= $model->input("reserved", array("value" => $item["reserved"])) ?>
			</fieldset>

			<ul class="actions">
				<li class="cancel"><a href="/admin/wishes/list" class="button">Back</a></li>
				<li class="save"><input type="submit" value="Update" class="button primary" /></li>
			</ul>
		</form>
	</div>

	<h2>Tags</h2>
	<div class="tags">
		<form action="/admin/cms/update/<?= $action[0] ?>" class="i:formAddTags labelstyle:inject" method="post" enctype="multipart/form-data">
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
				<h3><?= $tag["context"].":".$tag["value"] ?></h3>
				<form action="/admin/cms/tags/delete/<?= $action[0] ?>/<?= $tag["id"] ?>" class="i:formDefaultDelete" method="post" enctype="multipart/form-data">
					<input type="submit" value="Delete" class="delete" />
				</form>
			</li>
<?			endforeach; ?>
<?		endif; ?>
		</ul>
	</div>

	<h2>Image</h2>
	<div class="images">
		<form action="/admin/cms/update/<?= $action[0] ?>" class="i:formAddImages labelstyle:inject" method="post" enctype="multipart/form-data">
			<fieldset>
				<?= $model->input("files") ?>
			</fieldset>

			<ul class="actions">
				<li class="save"><input type="submit" value="Add image" class="button primary" /></li>
			</ul>

		</form>

		<ul class="images">
<?		if(isset($item["files"])): ?>
			<li class="image">
				<img src="/images/<?= $action[0] ?>/x150.<?= $item["files"] ?>" />
			</li>
<?		endif; ?>
		</ul>
	</div>

</div>

<? $page->footer(array("type" => "admin")) ?>
