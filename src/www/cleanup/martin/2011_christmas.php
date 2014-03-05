<?php include_once("../../includes/wishlist.php") ?>
<!DOCTYPE html>
<html>
<head>
	<!-- (c) & (p) think.dk 2009-2011 //-->
	<!-- All material protected by copyrightlaws, as if you didnt know //-->
	<title>Martins ønskeseddel, Jul 2011</title>
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
		<h1>Martins ønskeseddel, Jul 2011</h1>
	</div>

	<div id="navigation">
		<h2>Andre ønskesedler</h2>
		<ul>
			<li><h3><a href="/romeo/2011_christmas.php">Romeos ønskeseddel, Jul 2011</a></h3></li>
		</ul>
	</div>

	<form name="buy" id="buy" action="2011_christmas.php" method="post">
	<input type="hidden" value="" name="item" id="item" />
	<input type="hidden" value="" name="list_user" id="list_user" />

	<div id="content">
		<ul>


			<?= createItem("i1", "Creationary", "299,95", "3844.png", "http://shop.lego.com/en-DK/Creationary-3844")?>
			<?= createItem("i2", "Jens Smærup Sørensen: Phase", "299,-", "4852.jpg", "http://bog.guide.dk/Roman/Jens%20Smærup%20Sørensen/Samfund/Drama/Jens_Smærup_Sørensen_Phase_2203888")?>
			<?= createItem("i3", "Victor Klemperer: LTI - Lingua Tertii Imperii", "?", "bogen.jpg", "http://www.klemperer.dk/node/1")?>
			<?= createItem("i4", "Køkkenvægt", "357,-", "373010_x.jpg", "http://www.punkt1.dk/shop/Koekkenudstyr/Philips-KoekkenvaegtHvidTarafunktion3kg/p/163015")?>
			<?= createItem("i4", "Remington HC5550 Hårtrimmer", "360,-", "hc5550-prd4.png", "http://www.made4men.dk/remington-hc5550-hartrimmer.html")?>
			<?= createItem("i5", "Sini", "?", "sini.jpg")?>
		</ul>
	</div>
	</form>

	<div id="footer"></div>

</div>

</body>
</html>