<?
$access_item = false;
if(isset($read_access) && $read_access) {
	return;
}
	
?>
<? $page_title = "Blog" ?>
<? $body_class = "blog" ?>
<? include_once($_SERVER["LOCAL_PATH"]."/templates/shell.header.php") ?>

<div class="scene">

	<h1>Manipulator - sense and nonsense</h1>

	<div class="article">
		<h2>Why use a library/framework?</h2>
		<div class="info">
			<dl>
				<dt class="published_at"></dt>
				<dd class="published_at" itemprop="releaseDate">May 26th 2013</dd>
			</dl>
		</div>
		<p>
			When building websites, supporting deviating browsers will quickly become a time consuming task. Identifying 
			browser problems and finding solutions to these, slows down development speed drastically. More important, from
			a developer POV, it is one of the most frustrating tasks in our work. If only we could build
			websites for just one browser, life would be so much easier.
		</p>
		<p>
			To minimize these frustrations, we as developers turn to JavaScript libraries and frameworks. Any decent framework provides
			cross-browser safe functionality, hopefully allowing you to build faster and debug less. And today we have a wider range of
			libraries and frameworks available than ever before. jQuery, MooTools and YUI just to name a few. So do we really need more?
		</p>
		<p>
			When choosing a library/framework you will have to consider different aspects like:
		</p>
		<ul>
			<li>- Does it support the required browsers?</li>
			<li>- Does it perform well?</li>
			<li>- Can it handle my needs easily?</li>
			<li>- What is the download size?</li>
			<li>- It is maintained and updated frequently?</li>
			<li>- Do I like its syntax?</li>
		</ul>
	</div>

	<div class="article">
		<h2>Minification</h2>
	</div>

</div>

<? include_once($_SERVER["LOCAL_PATH"]."/templates/shell.footer.php") ?>
