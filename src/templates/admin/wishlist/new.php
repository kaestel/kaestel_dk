<?php

$action = $this->actions();

$IC = new Item();
$itemtype = "wishlist";

$model = $IC->typeObject($itemtype);

?>
<div class="scene defaultNew">
	<h1>New wishlist</h1>

	<ul class="actions">
		<li class="cancel"><a href="/admin/<?= $itemtype ?>/list" class="button">Back</a></li>
	</ul>

	<form action="/admin/cms/save/<?= $itemtype ?>" class="i:formDefaultNew labelstyle:inject" method="post" enctype="multipart/form-data">

		<fieldset>
			<?= $model->input("name") ?>
			<?= $model->input("class") ?>
		</fieldset>

		<ul class="actions">
			<li class="cancel"><a href="/admin/<?= $itemtype ?>/list" class="button key:esc">Back</a></li>
			<li class="save"><input type="submit" value="Save" class="button primary key:s" /></li>
		</ul>

	</form>

</div>