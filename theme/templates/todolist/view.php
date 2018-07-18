
<?
global $action;
global $IC;
global $model;
global $itemtype;

$todolist = $IC->getItem(array("sindex" => $action[1], "extend" => true));

if($todolist && $todolist["tags"]):

	$tags = array();
	foreach($todolist["tags"] as $tag) {
		array_push($tags, $tag["context"].":".$tag["value"]);
	}
	$items = $IC->getItems(array("status" => 1, "itemtype" => "todo", "tags" => implode($tags, ";"), "order" => "todo.deadline DESC, todo.priority DESC", "extend" => true));

endif;

?>
<div class="scene todolist i:todolist">
	<h1><?= $todolist["name"] ?></h1>

<?	if($items): ?>
	<ul class="items todos">
<?		foreach($items as $item): ?>
		<li class="item id:<?= $item["id"] ?>">
			<h3><?= $item["name"] ?></h3>

			<dl class="info">
				<dt>Deadline</dt>
				<dd><?= date("Y-m-d", strtotime($item["deadline"])) ?></dd>
				<dt>Priority</dt>
				<dd><?= $model->todo_priority[$item["priority"]] ?></dd>
			</dl>

<?			if($item["description"]): ?>
			<div class="description">
				<p><?= $item["description"] ?></p>
			</div>
<?			endif; ?>

			<ul class="actions <?= ($item["status"] == 1 ? "open" : "closed") ?>">
				<li class="close">
					<?= $model->formStart("/todolist/close/".$item["id"], array("class" => "labelstyle:inject")) ?>
						<?= $model->submit("Close", array("class" => "primary")) ?>
					<?= $model->formEnd() ?>
				</li>
				<li class="open">
					<?= $model->formStart("/todolist/open/".$item["id"], array("class" => "labelstyle:inject")) ?>
						<?= $model->submit("Open", array("class" => "primary")) ?>
					<?= $model->formEnd() ?>
				</li>
			</ul>
		 </li>
<?		endforeach; ?>
	</ul>
<?	endif; ?>

</div>
