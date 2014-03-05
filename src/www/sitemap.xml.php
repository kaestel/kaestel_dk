<?php
	include_once($_SERVER["FRAMEWORK_PATH"]."/config/init.php");
	$query = new Query();
	$IC = new Item();

	print '<?xml version="1.0" encoding="UTF-8"?>';

	$items = $IC->getCompleteItem("combined-curated");
?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
	<url>
		<loc>http://e-types.com/</loc>
		<lastmod><?= date("Y-m-d", strtotime($items["modified_at"])) ?></lastmod>
		<changefreq>weekly</changefreq>
		<priority>1</priority>
	</url>
<?


	// NEWS ITEMS
	$items = $IC->getItems(array("itemtype" => "news", "status" => 1)); ?>
	<url>
		<loc>http://e-types.com/journal/</loc>
		<lastmod><?= date("Y-m-d", strtotime($items[0]["modified_at"])) ?></lastmod>
		<changefreq>daily</changefreq>
		<priority>1</priority>
	</url>
<? foreach($items as $item): ?>
	<url>
		<loc>http://e-types.com/article/<?= $item["sindex"] ?></loc>
		<lastmod><?= date("Y-m-d", strtotime($item["modified_at"])) ?></lastmod>
		<changefreq>weekly</changefreq>
		<priority>0.9</priority>
	</url>
<? endforeach; 



	// STATIC PAGES
?>
	<url>
		<loc>http://e-types.com/about</loc>
		<lastmod><?= date("Y-m-d", filemtime(LOCAL_PATH."/templates/e-types/about.php")) ?></lastmod>
		<changefreq>weekly</changefreq>
		<priority>0.7</priority>
	</url>
	<url>
		<loc>http://e-types.com/competences</loc>
		<lastmod><?= date("Y-m-d", filemtime(LOCAL_PATH."/templates/e-types/competences.php")) ?></lastmod>
		<changefreq>weekly</changefreq>
		<priority>0.7</priority>
	</url>
	<url>
		<loc>http://e-types.com/daily/about</loc>
		<lastmod><?= date("Y-m-d", filemtime(LOCAL_PATH."/templates/daily/about.php")) ?></lastmod>
		<changefreq>weekly</changefreq>
		<priority>0.7</priority>
	</url>
	<url>
		<loc>http://e-types.com/daily/services</loc>
		<lastmod><?= date("Y-m-d", filemtime(LOCAL_PATH."/templates/daily/services.php")) ?></lastmod>
		<changefreq>weekly</changefreq>
		<priority>0.7</priority>
	</url>
	<url>
		<loc>http://e-types.com/playtype</loc>
		<lastmod><?= date("Y-m-d", filemtime(LOCAL_PATH."/templates/pages/playtype.php")) ?></lastmod>
		<changefreq>weekly</changefreq>
		<priority>0.7</priority>
	</url>
	<url>
		<loc>http://e-types.com/contact</loc>
		<lastmod><?= date("Y-m-d", filemtime(LOCAL_PATH."/templates/pages/contact.php")) ?></lastmod>
		<changefreq>weekly</changefreq>
		<priority>0.7</priority>
	</url>
</urlset>