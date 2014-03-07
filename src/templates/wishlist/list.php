<?
global $action;
global $IC;
global $model;

$items = $IC->getItems(array("status" => 1, "itemtype" => "wishlist"));
?>
<div class="scene wishlist i:wishlist">
	<h1>Ønskesedler</h1>
	<p>Input til gavmildhed.</p>

<?	if($items): ?>
	<ul class="items">
<?		foreach($items as $item):
			$item = $IC->getCompleteItem($item["id"]); ?>
		<li<?= HTML::attribute("class") ?>><a href="/wishlist/view/<?= $item["sindex"] ?>"><?= $item["name"] ?></a></li>
<?		endforeach; ?>
	</ul>
<?	endif; ?>

</div>
