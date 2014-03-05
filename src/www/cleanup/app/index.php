<?
$access_item = false;

if(isset($read_access) && $read_access) {
	return;
}

include_once($_SERVER["PAGE_PATH"]."/page.class.php");
?><!DOCTYPE html>
<html manifest="cache.php">
<head>
	<title>think.dk - App</title>
	<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />
	<link rel="apple-touch-icon" href="img/icon.png"/>
	<link rel="apple-touch-startup-image" href="img/startup.png" />
	<!--link type="text/css" rel="stylesheet" media="all" href="/css/seg_<?= Session::getDevice("segment") ?>.css" /-->
	<!--script type="text/javascript" src="/js/lib/seg_<?= Session::getDevice("segment") ?>_include.js"></script-->
	<script type="text/javascript" src="/app/js/seg_tablet.js"></script>
	<link type="text/css" rel="stylesheet" media="all" href="/app/css/seg_tablet.css" />
	<!--script type="text/javascript" src="/app/js/lib/seg_tablet_include.js"></script-->
</head>

<body class="i:app">

<div class="startup">Checking your browser ...</div>

</body>
</html>