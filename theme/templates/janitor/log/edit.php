<?php
global $action;
global $IC;
global $model;
global $itemtype;

$item_id = $action[1];
$item = $IC->getItem(array("id" => $item_id, "extend" => array("tags" => true, "mediae" => true)));
?>
<div class="scene defaultEdit <?= $itemtype ?>Edit">
	<h1>Edit log entry</h1>

	<?= $JML->editGlobalActions($item) ?>


	<div class="item i:defaultEdit">
		<h2>Log entry</h2>
		<?= $model->formStart("update/".$item["id"], array("class" => "labelstyle:inject")) ?>

			<fieldset>
				<?= $model->input("name", array("value" => $item["name"])) ?>
				<?= $model->input("published_at", array("value" => $item["published_at"])) ?>
				<?= $model->input("description", array("class" => "autoexpand short", "value" => $item["description"])) ?>
				<?= $model->inputLocation("location", "latitude", "longitude", array("value_loc" => $item["location"], "value_lat" => $item["latitude"], "value_lon" => $item["longitude"])) ?>

				<?= $model->input("html", array("value" => $item["html"])) ?>
			</fieldset>

			<?= $JML->editActions($item) ?>

		<?= $model->formEnd() ?>
	</div>


	<?= $JML->editTags($item) ?>

	<?= $JML->editMediae($item) ?>

	<?= $JML->editSindex($item) ?>

	<?= $JML->editOwner($item) ?>

</div>
