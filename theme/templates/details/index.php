<?php
global $IC;
global $action;

include("classes/items/taglist.class.php");
$TL = new TagList();
$tag_list = $TL->getTagList(["handle" => "logbooks"]);

$post_tags = $IC->getTags(array("context" => "post"));

?>

<div class="scene details lists i:details">

	<div class="article">
		<h1>Self expression is a process</h1>
		<p>
			I live to learn, I learn to live. One experience at the time. <br />This is a selected part of my story.
		</p>
		<p>
			Journeys, stories, reflections, feelings, thoughts.
		</p>
		<p class="note">
			Everything is a process. This is my playground.
		</p>
	</div>

<? if($post_tags): ?>
	<div class="categories">
		<h2>Posts and pieces</h2>
		<ul class="tags">
<?		foreach($post_tags as $tag): ?>
			<li><a href="/details/posts/tag/<?= urlencode($tag["value"]) ?>"><?= $tag["value"] ?></a></li>
<?		endforeach; ?>
			<li class="all"><a href="/details/posts">All postings</a></li>
		</ul>
	</div>
<? endif; ?>


<? if($tag_list && $tag_list["tags"]): ?>
	<div class="logs categories">
		<h2>Travel logbooks</h2>
		<ul class="tags books">
<?		foreach($tag_list["tags"] as $tag): ?>
			<li class="">
				<a href="/details/logs/<?= urlencode($tag["value"]) ?>"><?= $tag["value"] ?></a>
<?
			$log_blog = $IC->getItem(["itemtype" => "blog", "tags" => "blog:".$tag["value"], "extend" => true]);
			if($log_blog): ?>
				<p><?= $log_blog["description"];?></p>
			<? endif; ?>
			</li>
<?		endforeach; ?>
		</ul>
	</div>
<?	endif; ?>

</div>
