
<?
global $action;
global $IC;
global $model;
global $itemtype;

$todolist = $IC->getCompleteItem($action[1]);

if($todolist && $todolist["tags"]):

	$tags = array();
	foreach($todolist["tags"] as $tag) {
		array_push($tags, $tag["context"].":".$tag["value"]);
	}
	$items = $IC->getItems(array("status" => 1, "itemtype" => "todo", "tags" => implode($tags, ";"), "order" => "todo.deadline DESC, todo.priority DESC"));

endif;

?>
<div class="scene todolist i:todolist">
	<h1><?= $todolist["name"] ?></h1>

<?	if($items): ?>
	<ul class="todos">
<?		foreach($items as $item): 
			$item = $IC->getCompleteItem($item["id"]); ?>
		<li class="item id:<?= $item["id"] ?>">
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
			<ul class="actions <?= ($item["status"] == 1 ? "open" : "closed") ?>">
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
