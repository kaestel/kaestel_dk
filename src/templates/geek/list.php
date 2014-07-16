<?php
global $IC;
global $action;

	
$log_items = $IC->getItems(array("itemtype" => "log", "limit" => 1, "status" => 1));
$post_items = $IC->getItems(array("itemtype" => "post", "limit" => 1, "status" => 1));

$post_tags = $IC->getTags(array("context" => "post"));
$log_tags = $IC->getTags(array("context" => "log"));

?>

<div class="scene geek lists i:generic">
	<h1>Geek is Good, <br />I am Geek.</h1>
	<p>
		I live to learn, I learn to live. One experience at the time. <br />This is a selected part of my story.
	</p>

<? 	if($log_items): ?>
	<div class="logbooks">
		<h2>Logbooks</h2>
<? 	if($log_tags): ?>
		<ul class="tags">
<?		foreach($log_tags as $tag): ?>
			<li><a href="/geek/logs/tag/<?= urlencode($tag["value"]) ?>"><?= $tag["value"] ?></a></li>
<?		endforeach; ?>
		</ul>

		<ul class="actions">
			<li class="more"><a href="/geek/logs">All logbook entries</a></li>
		</ul>
	</div>
<?	endif; ?>

<? 	if($post_items): ?>
	<div class="posts">
		<h2>Posts</h2>
<?	if($post_tags): ?>
		<ul class="tags">
<?		foreach($post_tags as $tag): ?>
			<li><a href="/geek/posts/tag/<?= urlencode($tag["value"]) ?>"><?= $tag["value"] ?></a></li>
<?		endforeach; ?>
		</ul>
<?	endif; ?>

		<ul class="actions">
			<li class="more"><a href="/geek/posts">All postings</a></li>
		</ul>
	</div>
<?	endif; ?>

</div>
