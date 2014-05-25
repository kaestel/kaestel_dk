<?php
global $action;
global $IC;
global $model;
global $itemtype;
?>
<div class="scene defaultNew">
	<h1>New log entry</h1>

	<ul class="actions">
		<li class="cancel"><a href="/admin/<?= $itemtype ?>/list" class="button">Back</a></li>
	</ul>

	<form action="/admin/cms/save/<?= $itemtype ?>" class="i:formDefaultNew labelstyle:inject" method="post" enctype="multipart/form-data">
		<fieldset>
			<?= $model->input("published_at", array("value" => date("Y-m-d H:i", time()))) ?>
			<?= $model->input("name") ?>
			<?= $model->input("description", array("class" => "autoexpand short")) ?>
			<?= $model->input("html", array("class" => "autoexpand")) ?>

			<?= $model->inputLocation("location", "latitude", "longitude") ?>
		</fieldset>

		<ul class="actions">
			<li class="cancel"><a href="/admin/<?= $itemtype ?>/list" class="button key:esc">Back</a></li>
			<li class="save"><input type="submit" value="Save" class="button primary key:s" /></li>
		</ul>
	</form>

</div>
