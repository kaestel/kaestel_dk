<?php
$access_item = false;
if(isset($read_access) && $read_access) {
	return;
}

include_once($_SERVER["FRAMEWORK_PATH"]."/config/init.php");

$action = $page->actions();

$IC = new Item();
$model = $IC->typeObject("wish");

?>
<? $page->header(array("type" => "admin")) ?>

<div class="scene defaultNew">

	<h1>New wish item</h1>

	<form action="/admin/cms/save/wish" class="i:formDefaultNew labelstyle:inject" method="post" enctype="multipart/form-data">

		<fieldset>
			<?= $model->input("name") ?>
			<?= $model->input("price") ?>
			<?= $model->input("link") ?>
			<?= $model->input("description", array("class" => "autoexpand")) ?>
		</fieldset>

		<ul class="actions">
			<li class="cancel"><a href="/admin/wishes/list" class="button">Back</a></li>
			<li class="save"><input type="submit" value="Save" class="button primary" /></li>
		</ul>

	</form>

</div>

<? $page->footer(array("type" => "admin")) ?>
