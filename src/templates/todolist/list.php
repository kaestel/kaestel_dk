<?
global $action;
global $IC;
global $model;
global $itemtype;

$items = $IC->getItems(array("status" => 1, "itemtype" => "todolist"));
$todos = $IC->getItems(array("status" => 1, "itemtype" => "todo", "order" => "todo.deadline DESC, todo.priority DESC"));
?>
<div class="scene todolist i:todolist">
	<h1>TODOs</h1>
	<p>Input for action.</p>

<?	if($items): ?>
	<ul class="actions">
<?		foreach($items as $item):
			$item = $IC->getCompleteItem($item["id"]); ?>
		<li<?= HTML::attribute("class", $item["class"]) ?>><a href="/todolist/view/<?= $item["sindex"] ?>" class="button primary"><?= $item["name"] ?></a></li>
<?		endforeach; ?>
	</ul>
<?	endif; ?>


<?	if($todos): ?>
	<ul class="todos">
<?		foreach($todos as $item):
			$item = $IC->getCompleteItem($item["id"]); ?>
		<li<?= HTML::attribute("class", "item", "item_id:".$item["id"]) ?>>
			<h3><?= $item["name"] ?></h3>
			<div class="description">
				<p><?= $item["description"] ?></p>
			</div>
			<dl>
				<dt>Priority</dt>
				<dd><?= $model->todo_priority[$item["priority"]] ?></dd>
				<dt>Deadline</dt>
				<dd><?= date("Y-m-d", strtotime($item["deadline"])) ?></dd>
			</dl>
			<ul class="actions <?= ($item["status"] == 0 ? "closed" : "") ?>">
				<li class="close">
					<form action="/todolist/close/<?= $item["id"] ?>" method="post" enctype="multipart/form-data">
						<input type="submit" value="Close" class="button primary" />
					</form>
				</li>
				<li class="open">
					<form action="/todolist/open/<?= $item["id"] ?>" method="post" enctype="multipart/form-data">
						<input type="submit" value="Open" class="button primary" />
					</form>
				</li>
			</ul>
		</li>
<?		endforeach; ?>
	</ul>
<?	endif; ?>

</div>
