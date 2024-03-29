<!DOCTYPE html>
<html lang="<?= $this->language() ?>">
<head>
	<!-- (c) & (p) parentNode.dk 2009-2019 //-->
	<!-- All material protected by copyrightlaws, as if you didnt know //-->
	<!-- If you want to help build the ultimate frontend-centered platform, visit https://parentnode.dk -->
	<title><?= SITE_URL ?> - <?= $this->pageTitle() ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="keywords" content="think for yourself live free get in trouble" />
	<meta name="description" content="<?= $this->pageDescription() ?>" />
	<meta name="viewport" content="initial-scale=1" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />

	<?= $this->sharingMetaData() ?>

	<link rel="apple-touch-icon" href="/touchicon.png">
	<link rel="icon" href="/favicon.png">

<? if(session()->value("dev")) { ?>
	<link type="text/css" rel="stylesheet" media="all" href="/css/lib/seg_<?= $this->segment() ?>_include.css" />
	<script type="text/javascript" src="/js/lib/seg_<?= $this->segment() ?>_include.js"></script>
<? } else { ?>
	<link type="text/css" rel="stylesheet" media="all" href="/css/seg_<?= $this->segment() ?>.css?rev=20230627-075246" />
	<script type="text/javascript" src="/js/seg_<?= $this->segment() ?>.js?rev=20230627-075246"></script>
<? } ?>

	<?= $this->headerIncludes() ?>
</head>

<body<?= $HTML->attribute("class", $this->bodyClass()) ?>>

<div id="page" class="i:page">

	<div id="header">
		<ul class="servicenavigation">
			<li class="keynav navigation nofollow"><a href="#navigation">To navigation</a></li>
<? if(session()->value("user_id") && session()->value("user_group_id") == 2): ?>
			<li class="keynav admin nofollow"><a href="/janitor/admin/profile">Account</a></li>
<? elseif(session()->value("user_id") && session()->value("user_group_id") > 2): ?>
			<li class="keynav admin nofollow"><a href="/janitor">Janitor</a></li>
<? endif; ?>
<? if(session()->value("user_id") && session()->value("user_group_id") > 1): ?>
			<li class="keynav logoff nofollow"><a href="?logoff=true">Logoff</a></li>
<? else: ?>
			<li class="keynav login nofollow"><a href="/login">Login</a></li>
<? endif; ?>
		</ul>
	</div>

	<div id="content">
