<?php
$access_item = false;
if(isset($read_access) && $read_access) {
	return;
}

include_once($_SERVER["FRAMEWORK_PATH"]."/config/init.php");
$IC = new Item();

print '<?xml version="1.0" encoding="UTF-8"?>';
?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
	<url>
		<loc>http://kaestel.dk/</loc>
		<lastmod><?= date("Y-m-d", filemtime(LOCAL_PATH."/templates/pages/front.php")) ?></lastmod>
		<changefreq>weekly</changefreq>
		<priority>1</priority>
	</url>
	<url>
		<loc>http://kaestel.dk/plain</loc>
		<lastmod><?= date("Y-m-d", filemtime(LOCAL_PATH."/templates/pages/plain.php")) ?></lastmod>
		<changefreq>weekly</changefreq>
		<priority>1</priority>
	</url>
	<url>
		<loc>http://kaestel.dk/terms</loc>
		<lastmod><?= date("Y-m-d", filemtime(LOCAL_PATH."/templates/pages/terms.php")) ?></lastmod>
		<changefreq>monthly</changefreq>
		<priority>0.3</priority>
	</url>
<?


	// LOG ITEMS
	$items = $IC->getItems(array("itemtype" => "log", "status" => 1)); ?>
	<url>
		<loc>http://kaestel.dk/geek/logs</loc>
		<lastmod><?= date("Y-m-d", strtotime($items[0]["modified_at"])) ?></lastmod>
		<changefreq>daily</changefreq>
		<priority>1</priority>
	</url>
<? foreach($items as $item): ?>
	<url>
		<loc>http://kaestel.dk/geek/logs/<?= $item["sindex"] ?></loc>
		<lastmod><?= date("Y-m-d", strtotime($item["modified_at"])) ?></lastmod>
		<changefreq>weekly</changefreq>
		<priority>0.9</priority>
	</url>
<? endforeach;


	// POST ITEMS
	$items = $IC->getItems(array("itemtype" => "post", "status" => 1)); ?>
	<url>
		<loc>http://kaestel.dk/geek/posts</loc>
		<lastmod><?= date("Y-m-d", strtotime($items[0]["modified_at"])) ?></lastmod>
		<changefreq>daily</changefreq>
		<priority>1</priority>
	</url>
<? foreach($items as $item): ?>
	<url>
		<loc>http://kaestel.dk/geek/posts/<?= $item["sindex"] ?></loc>
		<lastmod><?= date("Y-m-d", strtotime($item["modified_at"])) ?></lastmod>
		<changefreq>weekly</changefreq>
		<priority>0.9</priority>
	</url>
<? endforeach; ?>

</urlset>