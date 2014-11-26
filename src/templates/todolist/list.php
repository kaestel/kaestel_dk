<?
global $action;
global $IC;
global $model;
global $itemtype;

$items = $IC->getItems(array("status" => 1, "itemtype" => "todolist", "extend" => true));
$todos = $IC->getItems(array("status" => 1, "itemtype" => "todo", "order" => "todo.deadline DESC, todo.priority DESC", "limit" => 10, "extend" => true));
?>
<div class="scene todolist i:todolist">
	<h1>TODOs</h1>
	<p>Input for action.</p>

<?	if($items): ?>
	<ul class="actions">
<?		foreach($items as $item): ?>
		<li<?= $HTML->attribute("class", $item["class"]) ?>><a href="/todolist/view/<?= $item["sindex"] ?>" class="button primary"><?= $item["name"] ?></a></li>
<?		endforeach; ?>
	</ul>
<?	endif; ?>


<?	if($todos): ?>
	<ul class="items todos">
<?		foreach($todos as $item): ?>
		<li<?= $HTML->attribute("class", "item", "item_id:".$item["id"]) ?>>
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

			<ul class="actions <?= ($item["status"] == 0 ? "closed" : "") ?>">
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
