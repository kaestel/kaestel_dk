<?php
$access_item = false;
if(isset($read_access) && $read_access) {
	return;
}

include_once($_SERVER["FRAMEWORK_PATH"]."/config/init.php");

$action = $page->actions();

$IC = new Item();
$enabled_items = $IC->getItems(array("itemtype" => "wish", "status" => 1));
$disabled_items = $IC->getItems(array("itemtype" => "wish", "status" => 0));
?>
<? $page->header(array("type" => "admin")) ?>
<div class="scene i:defaultList defaultList wishList">
	<h1>Wishes</h1>

	<ul class="actions">
		<li class="new"><a href="/admin/wishes/new" class="button primary">New wish</a></li>
	</ul>

	<div class="enabled_items">
		<h2>Enabled wishes</h2>
<?		if($enabled_items): ?>
		<ul class="items">
<?			foreach($enabled_items as $item): 
				$item = $IC->getCompleteItem($item["id"]); ?>
			<li class="item">
				<h3><?= $item["name"] ?></h3>

<?				if($item["tags"]): ?>
				<ul class="tags">
<?					foreach($item["tags"] as $tag): ?>
					<li><?= $tag["context"].":".$tag["value"] ?></li>
<?					endforeach; ?>
				</ul>
<?				endif; ?>

				<ul class="actions">
					<li class="edit"><a href="/admin/wishes/edit/<?= $item["id"] ?>" class="button">Edit</a></li>
					<li class="status">
						<form action="/admin/cms/<?= ($item["status"] == 1 ? "disable" : "enable") ?>/<?= $item["id"] ?>" class="i:formDefaultStatus" method="post" enctype="multipart/form-data">
							<input type="submit" value="<?= ($item["status"] == 1 ? "Disable" : "Enable") ?>" class="button status" />
						</form>
					</li>
					<li class="delete">
						<form action="/admin/cms/delete/<?= $item["id"] ?>" class="i:formDefaultDelete" method="post" enctype="multipart/form-data">
							<input type="submit" value="Delete" class="button delete" />
						</form>
					</li>
				</ul>
			 </li>
<?			endforeach; ?>
		</ul>
<?		else: ?>
		<p>No enabled wishes.</p>
<?		endif; ?>
	</div>

	<div class="disabled_items">
		<h2>Disabled wishes</h2>
<?		if($disabled_items): ?>
		<ul class="items">
<?			foreach($disabled_items as $item):
				$item = $IC->getCompleteItem($item["id"]); ?>
			<li class="item">
				<h3><?= $item["name"] ?></h3>

<?				if($item["tags"]): ?>
				<ul class="tags">
<?					foreach($item["tags"] as $tag): ?>
					<li><?= $tag["context"].":".$tag["value"] ?></li>
<?					endforeach; ?>
				</ul>
<?				endif; ?>

				<ul class="actions">
					<li class="edit"><a href="/admin/wishes/edit/<?= $item["id"] ?>" class="button">Edit</a></li>
					<li class="status">
						<form action="/admin/cms/<?= ($item["status"] == 1 ? "disable" : "enable") ?>/<?= $item["id"] ?>" class="i:formDefaultStatus" method="post" enctype="multipart/form-data">
							<input type="submit" value="<?= ($item["status"] == 1 ? "Disable" : "Enable") ?>" class="button status" />
						</form>
					</li>
					<li class="delete">
						<form action="/admin/cms/delete/<?= $item["id"] ?>" class="i:formDefaultDelete" method="post" enctype="multipart/form-data">
							<input type="submit" value="Delete" class="button delete" />
						</form>
					</li>
				</ul>
			 </li>
<?			endforeach; ?>
		</ul>
<?		else: ?>
		<p>No disabled wishes.</p>
<?		endif; ?>
	</div>

</div>
<? $page->footer(array("type" => "admin")) ?>