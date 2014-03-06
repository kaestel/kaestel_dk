<!DOCTYPE html>
<html lang="<?= $this->language() ?>">
<head>
	<!-- (c) & (p) think.dk 2011-2014 //-->
	<!-- All material protected by copyrightlaws, as if you didnt know //-->
	<title><?= $this->pageTitle() ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="language" content="<?= $this->language() ?>" />
	<meta name="keywords" content="" />
	<meta name="description" content="<?= $this->pageDescription() ?>" />
	<meta name="viewport" content="initial-scale=1, user-scalable=no" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<? if(Session::value("dev")) { ?>
	<link type="text/css" rel="stylesheet" media="all" href="/admin/css/lib/seg_<?= $this->segment() ?>_include.css" />
	<script type="text/javascript" src="/admin/js/lib/seg_<?= $this->segment() ?>_include.js"></script>
<? } else { ?>
	<link type="text/css" rel="stylesheet" media="all" href="/admin/css/seg_<?= $this->segment() ?>.css" />
	<script type="text/javascript" src="/admin/js/seg_<?= $this->segment() ?>.js"></script>
<? } ?>

</head>

<body<?= HTML::attribute("class", $this->bodyClass()) ?>>

<div id="page" class="i:page">
	<div id="header">
		<ul class="servicenavigation">
			<li class="keynav front"><a href="/admin">Kæstel Admin</a></li>
		</ul>
	</div>

	<div id="content"<?= HTML::attribute("class", $this->contentClass()) ?>>
