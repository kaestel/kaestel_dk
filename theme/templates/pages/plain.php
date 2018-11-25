<?
global $action;
global $IC;

$page_item = $IC->getItem(array("tags" => "page:plain", "extend" => array("mediae" => true, "tags" => true)));

if($page_item) {
	$this->sharingMetaData($page_item);
}
?>
<div class="scene plain i:scene">

<? if($page_item && $page_item["status"]): 
	$media = $IC->sliceMedia($page_item); ?>
	<div class="article i:article id:<?= $page_item["item_id"] ?>" itemscope itemtype="http://schema.org/Article">

		<? if($media): ?>
		<div class="image item_id:<?= $page_item["item_id"] ?> format:<?= $media["format"] ?> variant:<?= $media["variant"] ?>"></div>
		<? endif; ?>


		<?= $HTML->articleTags($page_item, [
			"context" => false
		]) ?>


		<h1 itemprop="headline"><?= $page_item["name"] ?></h1>

		<? if($page_item["subheader"]): ?>
		<h2 itemprop="alternativeHeadline"><?= $page_item["subheader"] ?></h2>
		<? endif; ?>


		<?= $HTML->articleInfo($page_item, "/terms", [
			"media" => $media,
			"sharing" => false
		]) ?>


		<? if($page_item["html"]): ?>
		<div class="articlebody" itemprop="articleBody">
			<?= $page_item["html"] ?>
		</div>
		<? endif; ?>

	</div>

	<div itemtype="http://schema.org/Person" itemscope class="vcard person">
		<h2>Contact info (for those who dare)</h2>
		<h3 class="name" itemprop="name">Martin Kæstel Nielsen</h3>

		<dl class="info contact">
			<dt class="contact">Contact</dt>
			<dd class="contact">
				<ul>
					<li class="tel" itemprop="telephone" content="+4520742819">+45 2074 2819</li>
					<li class="email"><a href="mailto:martin@kaestel.dk" itemprop="email" content="martin@kaestel.dk">martin@kaestel.dk</a></li>
				</ul>
			</dd>
			<dt class="social">Social media</dt>
			<dd class="social">
				<ul>
					<li class="facebook"><a href="https://facebook.com/kaestel">Facebook</a></li>
					<li class="linkedin"><a href="https://www.linkedin.com/in/kaestel">LinkedIn</a></li>
				</ul>
			</dd>
		</dl>
	</div>


<? else:?>

	<h1>Plain enough?</h1>
	<p>Shoot. You caught us in the middle of an update. Try again later.</p>

<? endif; ?>

</div>
