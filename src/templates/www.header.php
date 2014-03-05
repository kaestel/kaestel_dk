<!DOCTYPE html>
<html>
<head>
	<!-- (c) & (p) think.dk 2009-2011 //-->
	<!-- All material protected by copyrightlaws, as if you didnt know //-->
	<title><?= SITE_URL ?> - <?= $this->pageTitle() ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="keywords" content="think for yourself live free get in trouble" />
	<meta name="language" content="<?= strtolower($this->language()) ?>" />
	<meta name="description" content="<?= $this->pageDescription() ?>" />
	<meta name="viewport" content="width=1024" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />
	<? if(Session::value("dev")) { ?>
		<link type="text/css" rel="stylesheet" media="all" href="/css/lib/seg_<?= $this->segment() ?>_include.css" />
		<script type="text/javascript" src="/js/lib/seg_<?= $this->segment() ?>_include.js"></script>
	<? } else { ?>
		<link type="text/css" rel="stylesheet" media="all" href="/css/seg_<?= $this->segment() ?>.css" />
		<script type="text/javascript" src="/js/seg_<?= $this->segment() ?>.js"></script>
	<? } ?>
</head>

<body<?= HTML::attribute("class", $this->bodyClass()) ?>>

<div id="page" class="i:page">

	<div id="header"></div>

	<div id="content">