<?php
global $IC;
global $action;

	
$log_item = $IC->getItems(array("itemtype" => "log", "limit" => 1, "status" => 1));
$post_item = $IC->getItems(array("itemtype" => "post", "limit" => 1, "status" => 1));
//$photo_item = $IC->getItems(array("itemtype" => "photo", "limit" => 1, "status" => 1));

?>

<div class="scene front i:generic">
	<h1>The plain geek</h1>
	<p>
		Geeks are passionate people. I am sorry to disrupt the common, but narrowminded, perception
		of geeks. We DO have a life and we are NOT wasting our time. Our excessive passion grants us the geek-label, 
		and that passion drives our curiosity to dig further and further into our subjects, whatever it might be. 
		If you don't get it, perhaps you are just not smart enough and I urge you to try a little harder, because
		geeks will either save the world or destroy it. It all depends on how you treat them.
	</p>
	<p>No geek is plain. Normal is weird.</p>

	<h2>Postings</h2>


	<h2>Logbook</h2>
	<ul class="stories">
		<li>
			<h2><a href="/story">List of stories</a></h2>
			<dl class="info">
				<dt>Type</dt>
				<dd>Plain</dd>
			</dl>
			<p>Brief summary</p>
		</li>
		<li>
			<h2><a href="/story">List of stories</a></h2>
			<dl class="info">
				<dt>Type</dt>
				<dd>Geek</dd>
			</dl>
			<p>Brief summary</p>
		</li>
		<li>
			<h2><a href="/story">List of stories</a></h2>
			<dl class="info">
				<dt>Type</dt>
				<dd>Geek</dd>
			</dl>
			<p>Brief summary</p>
		</li>
	</ul>

	<h2>Maybe tease other entrences</h2>
	<p>list or text with hints to ways of using site.</p>

</div>
