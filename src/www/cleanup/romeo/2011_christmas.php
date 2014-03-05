<?php include_once("../../includes/wishlist.php") ?>
<!DOCTYPE html>
<html>
<head>
	<!-- (c) & (p) think.dk 2009-2011 //-->
	<!-- All material protected by copyrightlaws, as if you didnt know //-->
	<title>Romeos ønskeseddel, Jul 2011</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width; initial-scale=1.0; minimum-scale=1.0; maximum-scale=1.0;" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	<script type="text/javascript" src="http://current.jes.wires.dk/u.js"></script>
	<script type="text/javascript" src="http://current.jes.wires.dk/u-cookie.js"></script>
	<script type="text/javascript" src="http://current.jes.wires.dk/u-dom.js"></script>
	<script type="text/javascript" src="http://current.jes.wires.dk/u-debug.js"></script>

	<script type="text/javascript" src="/js/wishlist.js"></script>
	<link type="text/css" rel="stylesheet" media="all" href="/css/wishlist.css" />
</head>

<body>

<div id="page">

	<div id="header">
		<h1>Romeos ønskeseddel, Jul 2011</h1>
	</div>

	<div id="navigation">
		<h2>Andre ønskesedler</h2>
		<ul>
			<li><h3><a href="/martin/2011_christmas.php">Martins ønskeseddel, Jul 2011</a></h3></li>
		</ul>
	</div>

	<form name="buy" id="buy" action="2011_christmas.php" method="post">
	<input type="hidden" value="" name="item" id="item" />
	<input type="hidden" value="" name="list_user" id="list_user" />

	<div id="content">
		<ul>
			<?= createItem("i1", "Tegne/skriveunderlag - helst A3 størrelse", "?", "27e42957d5a5f8a8e4b5bd4268e48c3f.jpg")?>
			<?= createItem("i2", "Små klistermærker", "?", "D8950.jpg")?>
			<?= createItem("i3", "Børnesaks", "?", "saks-maped-koopy-13cm.jpg")?>
			<?= createItem("i4", "Minitipvogn", "49,95", "5761.png", "http://shop.lego.com/en-DK/Mini-Digger-5761")?>
			<?= createItem("i5", "Minifly", "49,95", "5762.png", "http://shop.lego.com/en-DK/Mini-Plane-5762")?>
			<?= createItem("i6", "Minihelikopter", "49,95", "5864.png", "http://shop.lego.com/en-DK/Mini-Helicopter-5864")?>
			<?= createItem("i7", "Politiminifigurer", "69,95", "7279.png", "http://shop.lego.com/en-DK/Police-Minifigure-Collection-7279")?>
			<?= createItem("i8", "Banana Balance (Spil)", "89,95", "3853.png", "http://shop.lego.com/en-DK/Banana-Balance-3853")?>
			<?= createItem("i9", "Pirate Plank (Spil)", "99,95", "3848.png", "http://shop.lego.com/en-DK/Pirate-Plank-3848")?>
			<?= createItem("i10", "Pickup brandbil", "99,95", "7942.png", "http://shop.lego.com/en-DK/Off-Road-Fire-Rescue-7942")?>
			<?= createItem("i11", "Angreb på Smedjen", "99,95", "6918.png", "http://shop.lego.com/en-DK/Blacksmith-Attack-6918")?>
			<?= createItem("i12", "Fiskerbåd", "129,95", "4642.png", "http://shop.lego.com/en-DK/Fishing-Boat-4642")?>
			<?= createItem("i13", "Kaptajnens kahyt", "129,95", "4191.png", "http://shop.lego.com/en-DK/Captain-s-Cabin-4191")?>
			<?= createItem("i14", "Autocamper", "149,95", "7639.png", "http://shop.lego.com/en-DK/Camper-7639")?>
			<?= createItem("i15", "Satellitaffyring", "149,95", "3366.png", "http://shop.lego.com/en-DK/Satellite-Launch-Pad-3366")?>
			<?= createItem("i16", "Hoth Wampa Cave", "149,95", "8089.png", "http://shop.lego.com/en-DK/Hoth-Wampa-Cave-8089")?>
			<?= createItem("i17", "Flugten på havet", "179,95", "8426.png", "http://shop.lego.com/en-DK/Escape-at-Sea-8426")?>
			<?= createItem("i18", "Bjergtemplet", "179,95", "2254.png", "http://shop.lego.com/en-DK/Mountain-Shrine-2254")?>
			<?= createItem("i19", "LEGO Lastbil", "249,95", "3221.png", "http://shop.lego.com/en-DK/LEGO-City-Truck-3221")?>
			<?= createItem("i20", "Stjernekikkert", "299,-", "674536.png", "http://www.br.dk/Brands/Science%20Explorer/Stjernekikkert.aspx?id=623575&vid=063389")?>
			<?= createItem("i21", "Undie Wool Kids Set", "399,-", "19493_stort.jpg", "http://www.eventyrsport.dk/shop/visvare.aspx?varenummer=19493")?>
		</ul>
	</div>
	</form>

	<div id="footer"></div>

</div>

</body>
</html>