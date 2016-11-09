<?php
$access_item = false;
if(isset($read_access) && $read_access) {
	return;
}

include_once($_SERVER["FRAMEWORK_PATH"]."/config/init.php");
$IC = new Items();

print '<?xml version="1.0" encoding="UTF-8"?>';
?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
	<url>
		<loc><?= SITE_URL ?>/</loc>
		<lastmod><?= date("Y-m-d", filemtime(LOCAL_PATH."/templates/pages/front.php")) ?></lastmod>
		<changefreq>weekly</changefreq>
		<priority>1</priority>
	</url>
	<url>
		<loc><?= SITE_URL ?>/plain</loc>
		<lastmod><?= date("Y-m-d", filemtime(LOCAL_PATH."/templates/pages/plain.php")) ?></lastmod>
		<changefreq>weekly</changefreq>
		<priority>1</priority>
	</url>
	<url>
		<loc><?= SITE_URL ?>/terms</loc>
		<lastmod><?= date("Y-m-d", filemtime(LOCAL_PATH."/templates/pages/terms.php")) ?></lastmod>
		<changefreq>monthly</changefreq>
		<priority>0.3</priority>
	</url>
<?


	// LOG ITEMS
	$items = $IC->getItems(array("itemtype" => "log", "status" => 1)); ?>
	<url>
		<loc><?= SITE_URL ?>/geek/logs</loc>
		<lastmod><?= date("Y-m-d", strtotime($items[0]["modified_at"])) ?></lastmod>
		<changefreq>daily</changefreq>
		<priority>1</priority>
	</url>
<? foreach($items as $item): ?>
	<url>
		<loc><?= SITE_URL ?>/geek/logs/<?= $item["sindex"] ?></loc>
		<lastmod><?= date("Y-m-d", strtotime($item["modified_at"])) ?></lastmod>
		<changefreq>weekly</changefreq>
		<priority>0.9</priority>
	</url>
<? endforeach;


	// POST ITEMS
	$items = $IC->getItems(array("itemtype" => "post", "status" => 1)); ?>
	<url>
		<loc><?= SITE_URL ?>/geek/posts</loc>
		<lastmod><?= date("Y-m-d", strtotime($items[0]["modified_at"])) ?></lastmod>
		<changefreq>daily</changefreq>
		<priority>1</priority>
	</url>
<? foreach($items as $item): ?>
	<url>
		<loc><?= SITE_URL ?>/geek/posts/<?= $item["sindex"] ?></loc>
		<lastmod><?= date("Y-m-d", strtotime($item["modified_at"])) ?></lastmod>
		<changefreq>weekly</changefreq>
		<priority>0.9</priority>
	</url>
<? endforeach; ?>

</urlset>