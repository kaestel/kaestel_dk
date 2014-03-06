<?php
	session_start();
	$user = time();

	// get reservations
	$reservations = file("reservations");
	$items = array();
	
	foreach($reservations as $reservation) {
		if($reservation) {
			list($f_item, $f_user) = explode(",", $reservation);
			$items[$f_item] = trim($f_user);
		}
	}

	$list_user = isset($_POST["list_user"]) ? $_POST["list_user"] : false;
	$item = isset($_POST["item"]) ? $_POST["item"] : false;

	// if state change
	if($list_user && $item) {

		// item already reserved
		if(isset($items[$item])) {
			$new_items = array();
			foreach($items as $r_item => $r_list_user) {
				if($r_item != $item) {
					$new_items[$r_item] = $r_list_user;
				}
			}
			$items = $new_items;

		}
		else {
			$items[$item] = $list_user;
		}

		// write new states
		$fp = fopen("reservations", "w+");
		foreach($items as $item => $list_user) {
			fwrite($fp, "$item,$list_user"."\n");
		}
		fclose($fp);

	}
?>
<!DOCTYPE html>
<html>
<head>
	<!-- (c) & (p) think.dk 2009-2011 //-->
	<!-- All material protected by copyrightlaws, as if you didnt know //-->
	<title>Romeos ønskeseddel</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width; initial-scale=1.0; minimum-scale=1.0; maximum-scale=1.0;" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	<script type="text/javascript" src="http://current.jes.wires.dk/u.js"></script>
	<script type="text/javascript" src="http://current.jes.wires.dk/u-cookie.js"></script>
	<script type="text/javascript" src="http://current.jes.wires.dk/u-dom.js"></script>
	<script type="text/javascript" src="http://current.jes.wires.dk/u-debug.js"></script>
	<script type="text/javascript">
		savePermCookie = function(name, value) {
			document.cookie = name + "=" + value +";expires=Mon, 04-Apr-2020 05:00:00 GMT;"
		}
		function changeState(item) {
			var user = u.getCookie("list_user");
			if(!user) {
				savePermCookie("list_user", <?= $user ?>);
				user = <?= $user ?>;
			}
			document.getElementById('item').value = item;
			document.getElementById('list_user').value = user;
			document.getElementById('buy').submit();
		}
//		window.onload = function() {
//			var items = u.qsa("li");
//		}
	</script>
	<style type="text/css">
		* {font-family: 'Lucida Sans Unicode', 'Lucida Grande'; color: #333333; font-size: 12px; line-height: 16px;
		/*	-moz-user-select: none;
			-webkit-user-select: none;*/
		}

		html {height: 100%;}
		body {margin: 0; height: 100%; background: #ffffff;}

		/* BASE */
		h1, h2, h3, h4, h5, h6, p, ul, li, dd, dl, dt {padding: 0; margin: 0;}
		a {text-decoration: none; cursor: pointer;}
		a:hover h3 {text-decoration: underline;}
		a:hover .price {text-decoration: underline;}
		img {border: 0; display: block;}
		form, fieldset, label, input, select, textarea {padding: 0; margin: 0;}

		h1 {font-size: 28px; line-height: 32px;}
		h2, h3, h4 {font-size: 20px; font-weight: normal; line-height: 18px;}
		p, label, dd, dt {}


		#page {position: relative; width: 960px; min-height: 100%; margin: 0 auto; text-align: left;}
		#header {padding: 30px 0;}

		#content ul {list-style: none;}
		#content li {overflow: hidden; border-top: 1px solid #cccccc; padding: 20px 0 0;}
		#content li img {float: left; padding: 0 20px 20px 0; width: 420px;}
		#content li h3 {padding: 0 0 10px;}
		#content li .price {font-size: 16px; display: block; padding: 0 0 20px;}
		#content li .price:before {content: "DKK ";}
		#content li .reserved {font-size: 16px; display: block; padding: 0 0 20px; color: #990000;}
		#content li input {cursor: pointer; padding: 1px 5px;}
	</style>
</head>

<body>

<div id="page">

	<div id="header">
		<h1>Romeos ønskeseddel, 5 år, 2011</h1>
	</div>

	<form name="buy" id="buy" action="2011.php" method="post">
	<input type="hidden" value="" name="item" id="item" />
	<input type="hidden" value="" name="list_user" id="list_user" />

	<div id="content">
		<ul>
			<li class="id:1">
				<img src="/img/romeo/2011/7305-0000-xx-12-1.jpg" />
				<a target="view" href="http://shop.lego.com/en-DK/Scarab-Attack-7305">
					<h3>Skarabæ-angreb</h3>
					<span class="price">39,95</span>
				</a>
				<?
				if(isset($items["i1"])) {
					print '<span class="reserved">Reserveret</span>';
					print '<input type="button" onclick="changeState(\'i1\');" value="Slet reservering" />';
				}
				else {
					print '<input type="button" onclick="changeState(\'i1\');" value="Resevér" />';
				}
				?>
			</li>
			<li class="id:2">
				<img src="/img/romeo/2011/5761-0000-xx-12-1.jpg" />
				<a target="view" href="http://shop.lego.com/en-DK/Mini-Digger-5761?p=5761">
					<h3>Minitipvogn</h3>
					<span class="price">49,95</span>
				</a>
				<?
				if(isset($items["i2"])) {
					print '<span class="reserved">Reserveret</span>';
					print '<input type="button" onclick="changeState(\'i2\');" value="Slet reservering" />';
				}
				else {
					print '<input type="button" onclick="changeState(\'i2\');" value="Resevér" />';
				}
				?>
			</li>
			<li class="id:3">
				<img src="/img/romeo/2011/5762-0000-xx-12-1.jpg" />
				<a href="http://shop.lego.com/en-DK/Mini-Plane-5762">
					<h3>Minifly</h3>
					<span class="price">49,95</span>
				</a>
				<?
				if(isset($items["i3"])) {
					print '<span class="reserved">Reserveret</span>';
					print '<input type="button" onclick="changeState(\'i3\');" value="Slet reservering" />';
				}
				else {
					print '<input type="button" onclick="changeState(\'i3\');" value="Resevér" />';
				}
				?>
			</li>
			<li class="id:4">
				<img src="/img/romeo/2011/7279-0000-xx-12-1.jpg" />
				<a href="http://shop.lego.com/en-DK/Police-Minifigure-Collection-7279">
					<h3>Politiminifigurer</h3>
					<span class="price">69.95</span>
				</a>
				<?
				if(isset($items["i4"])) {
					print '<span class="reserved">Reserveret</span>';
					print '<input type="button" onclick="changeState(\'i4\');" value="Slet reservering" />';
				}
				else {
					print '<input type="button" onclick="changeState(\'i4\');" value="Resevér" />';
				}
				?>
			</li>
			<li class="id:5">
				<img src="/img/romeo/2011/3178-0000-xx-12-1.jpg" />
				<a href="http://shop.lego.com/en-DK/Seaplane-3178">
					<h3>Vandflyver</h3>
					<span class="price">99,95</span>
				</a>
				<?
				if(isset($items["i5"])) {
					print '<span class="reserved">Reserveret</span>';
					print '<input type="button" onclick="changeState(\'i5\');" value="Slet reservering" />';
				}
				else {
					print '<input type="button" onclick="changeState(\'i5\');" value="Resevér" />';
				}
				?>
			</li>
			<li class="id:6">
				<img src="/img/romeo/2011/7949-0000-xx-12-1.jpg" />
				<a href="http://shop.lego.com/en-DK/Prison-Carriage-Rescue-7949">
					<h3>Befrielse fra fangevognen</h3>
					<span class="price">99,95</span>
				</a>
				<?
				if(isset($items["i6"])) {
					print '<span class="reserved">Reserveret</span>';
					print '<input type="button" onclick="changeState(\'i6\');" value="Slet reservering" />';
				}
				else {
					print '<input type="button" onclick="changeState(\'i6\');" value="Resevér" />';
				}
				?>
			</li>
			<li class="id:7">
				<img src="/img/romeo/2011/6918-0000-xx-12-1.jpg" />
				<a href="http://shop.lego.com/en-DK/Blacksmith-Attack-6918">
					<h3>Angreb på smedjen</h3>
					<span class="price">99,95</span>
				</a>
				<?
				if(isset($items["i7"])) {
					print '<span class="reserved">Reserveret</span>';
					print '<input type="button" onclick="changeState(\'i7\');" value="Slet reservering" />';
				}
				else {
					print '<input type="button" onclick="changeState(\'i7\');" value="Resevér" />';
				}
				?>
			</li>
			<li class="id:8">
				<img src="/img/romeo/2011/8231-0000-xx-12-1.jpg" />
				<a href="http://shop.lego.com/en-DK/Vicious-Viper-8231">
					<h3>Vicious viper</h3>
					<span class="price">99,95</span>
				</a>
				<?
				if(isset($items["i8"])) {
					print '<span class="reserved">Reserveret</span>';
					print '<input type="button" onclick="changeState(\'i8\');" value="Slet reservering" />';
				}
				else {
					print '<input type="button" onclick="changeState(\'i8\');" value="Resevér" />';
				}
				?>
			</li>
			<li class="id:9">
				<img src="/img/romeo/2011/5866-0000-xx-12-1.jpg" />
				<a href="http://shop.lego.com/en-DK/Rotor-Rescue-5866">
					<h3>Redningshelikopter</h3>
					<span class="price">99,95</span>
				</a>
				<?
				if(isset($items["i9"])) {
					print '<span class="reserved">Reserveret</span>';
					print '<input type="button" onclick="changeState(\'i9\');" value="Slet reservering" />';
				}
				else {
					print '<input type="button" onclick="changeState(\'i9\');" value="Resevér" />';
				}
				?>
			</li>
			<li class="id:10">
				<img src="/img/romeo/2011/7641-0000-xx-12-1.jpg" />
				<a href="http://shop.lego.com/en-DK/City-Corner-7641">
					<h3>Gadehjørne</h3>
					<span class="price">119,00</span>
				</a>
				<?
				if(isset($items["i10"])) {
					print '<span class="reserved">Reserveret</span>';
					print '<input type="button" onclick="changeState(\'i10\');" value="Slet reservering" />';
				}
				else {
					print '<input type="button" onclick="changeState(\'i10\');" value="Resevér" />';
				}
				?>
			</li>
			<li class="id:11">
				<img src="/img/romeo/2011/3366-0000-xx-12-1.jpg" />
				<a href="http://shop.lego.com/en-DK/Satellite-Launch-Pad-3366">
					<h3>Sattelitaffyring</h3>
					<span class="price">149,95</span>
				</a>
				<?
				if(isset($items["i11"])) {
					print '<span class="reserved">Reserveret</span>';
					print '<input type="button" onclick="changeState(\'i11\');" value="Slet reservering" />';
				}
				else {
					print '<input type="button" onclick="changeState(\'i11\');" value="Resevér" />';
				}
				?>
			</li>
			<li class="id:12">
				<img src="/img/romeo/2011/5867-0000-xx-12-1.jpg" />
				<a href="http://shop.lego.com/en-DK/Super-Speedster-5867">
					<h3>Superhurtig sportsvogn</h3>
					<span class="price">179,95</span>
				</a>
				<?
				if(isset($items["i12"])) {
					print '<span class="reserved">Reserveret</span>';
					print '<input type="button" onclick="changeState(\'i12\');" value="Slet reservering" />';
				}
				else {
					print '<input type="button" onclick="changeState(\'i12\');" value="Resevér" />';
				}
				?>
			</li>
			<li class="id:13">
				<img src="/img/romeo/2011/2254-0000-xx-12-1.jpg" />
				<a href="http://shop.lego.com/en-DK/Mountain-Shrine-2254">
					<h3>Bjergtemplet</h3>
					<span class="price">179,95</span>
				</a>
				<?
				if(isset($items["i13"])) {
					print '<span class="reserved">Reserveret</span>';
					print '<input type="button" onclick="changeState(\'i13\');" value="Slet reservering" />';
				}
				else {
					print '<input type="button" onclick="changeState(\'i13\');" value="Resevér" />';
				}
				?>
			</li>
			<li class="id:14">
				<img src="/img/romeo/2011/7239-0000-XX-12-1.jpg" />
				<a href="http://shop.lego.com/en-DK/Fire-Truck-7239">
					<h3>Brandbil</h3>
					<span class="price">199,95</span>
				</a>
				<?
				if(isset($items["i14"])) {
					print '<span class="reserved">Reserveret</span>';
					print '<input type="button" onclick="changeState(\'i14\');" value="Slet reservering" />';
				}
				else {
					print '<input type="button" onclick="changeState(\'i14\');" value="Resevér" />';
				}
				?>
			</li>
			<li class="id:15">
				<img src="/img/romeo/2011/7942-0000-xx-12-1.jpg" />
				<a href="http://shop.lego.com/en-DK/Off-Road-Fire-Rescue-7942">
					<h3>Pickup brandbil</h3>
					<span class="price">199,95</span>
				</a>
				<?
				if(isset($items["i15"])) {
					print '<span class="reserved">Reserveret</span>';
					print '<input type="button" onclick="changeState(\'i15\');" value="Slet reservering" />';
				}
				else {
					print '<input type="button" onclick="changeState(\'i15\');" value="Resevér" />';
				}
				?>
			</li>
			<li class="id:16">
				<img src="/img/romeo/2011/4643-0000-xx-12-1.jpg" />
				<a href="http://shop.lego.com/en-DK/Power-Boat-Transporter-4643">
					<h3>Motorbådstransport</h3>
					<span class="price">249,95</span>
				</a>
				<?
				if(isset($items["i16"])) {
					print '<span class="reserved">Reserveret</span>';
					print '<input type="button" onclick="changeState(\'i16\');" value="Slet reservering" />';
				}
				else {
					print '<input type="button" onclick="changeState(\'i16\');" value="Resevér" />';
				}
				?>
			</li>
			<li class="id:17">
				<img src="/img/romeo/2011/3367-0000-xx-12-1.jpg" />
				<a href="http://shop.lego.com/en-DK/Space-Shuttle-3367">
					<h3>Rumfærge</h3>
					<span class="price">249,95</span>
				</a>
				<?
				if(isset($items["i17"])) {
					print '<span class="reserved">Reserveret</span>';
					print '<input type="button" onclick="changeState(\'i17\');" value="Slet reservering" />';
				}
				else {
					print '<input type="button" onclick="changeState(\'i17\');" value="Resevér" />';
				}
				?>
			</li>
			<li class="id:18">
				<img src="/img/romeo/2011/2263-0000-xx-12-1.jpg" />
				<a href="http://shop.lego.com/en-DK/Turbo-Shredder-2263">
					<h3>Turborydder</h3>
					<span class="price">249,95</span>
				</a>
				<?
				if(isset($items["i18"])) {
					print '<span class="reserved">Reserveret</span>';
					print '<input type="button" onclick="changeState(\'i18\');" value="Slet reservering" />';
				}
				else {
					print '<input type="button" onclick="changeState(\'i18\');" value="Resevér" />';
				}
				?>
			</li>
			<li class="id:19">
				<img src="/img/romeo/2011/3658-0000-xx-12-1.jpg" />
				<a href="http://shop.lego.com/en-DK/Police-Helicopter-3658">
					<h3>Politihelikopterjagt</h3>
					<span class="price">299,95</span>
				</a>
				<?
				if(isset($items["i19"])) {
					print '<span class="reserved">Reserveret</span>';
					print '<input type="button" onclick="changeState(\'i19\');" value="Slet reservering" />';
				}
				else {
					print '<input type="button" onclick="changeState(\'i19\');" value="Resevér" />';
				}
				?>
			</li>
			<li class="id:20">
				<img src="/img/romeo/2011/7213-0000-xx-12-1.jpg" />
				<a href="http://shop.lego.com/en-DK/Off-Road-Fire-Truck-Fireboat-7213">
					<h3>Terrængående brandbil og sprøjtebåd</h3>
					<span class="price">349,00</span>
				</a>
				<?
				if(isset($items["i20"])) {
					print '<span class="reserved">Reserveret</span>';
					print '<input type="button" onclick="changeState(\'i20\');" value="Slet reservering" />';
				}
				else {
					print '<input type="button" onclick="changeState(\'i20\');" value="Resevér" />';
				}
				?>
			</li>
			<li class="id:21">
				<img src="/img/romeo/2011/5770-0000-xx-12-1.jpg" />
				<a href="http://shop.lego.com/en-DK/Lighthouse-Island-5770">
					<h3>Fyrtårnsøen</h3>
					<span class="price">349,00</span>
				</a>
				<?
				if(isset($items["i21"])) {
					print '<span class="reserved">Reserveret</span>';
					print '<input type="button" onclick="changeState(\'i21\');" value="Slet reservering" />';
				}
				else {
					print '<input type="button" onclick="changeState(\'i21\');" value="Resevér" />';
				}
				?>
			</li>
			<li class="id:22">
				<img src="/img/romeo/2011/7288-0000-xx-12-1.jpg" />
				<a href="http://shop.lego.com/en-DK/Mobile-Police-Unit-7288">
					<h3>Mobil politistation</h3>
					<span class="price">349,00</span>
				</a>
				<?
				if(isset($items["i22"])) {
					print '<span class="reserved">Reserveret</span>';
					print '<input type="button" onclick="changeState(\'i22\');" value="Slet reservering" />';
				}
				else {
					print '<input type="button" onclick="changeState(\'i22\');" value="Resevér" />';
				}
				?>
			</li>
			<li class="id:23">
				<img src="/img/romeo/2011/8486-0000-xx-12-1.jpg" />
				<a href="http://shop.lego.com/en-DK/Mack-s-Team-Truck-8486">
					<h3>Macks transporter'</h3>
					<span class="price">349,00</span>
				</a>
				<?
				if(isset($items["i23"])) {
					print '<span class="reserved">Reserveret</span>';
					print '<input type="button" onclick="changeState(\'i23\');" value="Slet reservering" />';
				}
				else {
					print '<input type="button" onclick="changeState(\'i23\');" value="Resevér" />';
				}
				?>
			</li>
			<li class="id:24">
				<img src="/img/romeo/2011/7188-0000-xx-12-1.jpg" />
				<a href="http://shop.lego.com/en-DK/King-s-Carriage-Ambush-7188">
					<h3>Bagholdsangreb</h3>
					<span class="price">349,00</span>
				</a>
				<?
				if(isset($items["i24"])) {
					print '<span class="reserved">Reserveret</span>';
					print '<input type="button" onclick="changeState(\'i24\');" value="Slet reservering" />';
				}
				else {
					print '<input type="button" onclick="changeState(\'i24\');" value="Resevér" />';
				}
				?>
			</li>
			<li class="id:25">
				<img src="/img/romeo/2011/4738-0000-xx-12-1.jpg" />
				<a href="http://shop.lego.com/en-DK/Hagrid-s-Hut-4738">
					<h3>Hagrids hytte</h3>
					<span class="price">449,00</span>
				</a>
				<?
				if(isset($items["i25"])) {
					print '<span class="reserved">Reserveret</span>';
					print '<input type="button" onclick="changeState(\'i25\');" value="Slet reservering" />';
				}
				else {
					print '<input type="button" onclick="changeState(\'i25\');" value="Resevér" />';
				}
				?>
			</li>
			<li class="id:26">
				<img src="/img/romeo/2011/4644-0000-xx-12-1.jpg" />
				<a href="http://shop.lego.com/en-DK/Marina-4644">
					<h3>Marina</h3>
					<span class="price">449,00</span>
				</a>
				<?
				if(isset($items["i26"])) {
					print '<span class="reserved">Reserveret</span>';
					print '<input type="button" onclick="changeState(\'i26\');" value="Slet reservering" />';
				}
				else {
					print '<input type="button" onclick="changeState(\'i26\');" value="Resevér" />';
				}
				?>
			</li>
			<li class="id:27">
				<img src="/img/romeo/2011/4193-0000-xx-12-1.jpg" />
				<a href="http://shop.lego.com/en-DK/The-London-Escape-4193">
					<h3>Flugten fra London</h3>
					<span class="price">549,00</span>
				</a>
				<?
				if(isset($items["i27"])) {
					print '<span class="reserved">Reserveret</span>';
					print '<input type="button" onclick="changeState(\'i27\');" value="Slet reservering" />';
				}
				else {
					print '<input type="button" onclick="changeState(\'i27\');" value="Resevér" />';
				}
				?>
			</li>
			<li class="id:28">
				<img src="/img/romeo/2011/5771-0000-xx-12-1.jpg" />
				<a href="http://shop.lego.com/en-DK/Hillside-House-5771">
					<h3>Bakkehuset</h3>
					<span class="price">549,00</span>
				</a>
				<?
				if(isset($items["i28"])) {
					print '<span class="reserved">Reserveret</span>';
					print '<input type="button" onclick="changeState(\'i28\');" value="Slet reservering" />';
				}
				else {
					print '<input type="button" onclick="changeState(\'i28\');" value="Resevér" />';
				}
				?>
			</li>
			<li class="id:29">
				<img src="/img/romeo/2011/7065-0000-xx-12-1.jpg" />
				<a href="http://shop.lego.com/en-DK/Alien-Mothership-7065">
					<h3>Rumvæsnernes moderskib</h3>
					<span class="price">549,00</span>
				</a>
				<?
				if(isset($items["i29"])) {
					print '<span class="reserved">Reserveret</span>';
					print '<input type="button" onclick="changeState(\'i29\');" value="Slet reservering" />';
				}
				else {
					print '<input type="button" onclick="changeState(\'i29\');" value="Resevér" />';
				}
				?>
			</li>
			<li class="id:30">
				<img src="/img/romeo/2011/2506-0000-xx-12-1.jpg" />
				<a href="http://shop.lego.com/en-DK/Skull-Truck-2506">
					<h3>Kranielastbil</h3>
					<span class="price">549,00</span>
				</a>
				<?
				if(isset($items["i30"])) {
					print '<span class="reserved">Reserveret</span>';
					print '<input type="button" onclick="changeState(\'i30\');" value="Slet reservering" />';
				}
				else {
					print '<input type="button" onclick="changeState(\'i30\');" value="Resevér" />';
				}
				?>
			</li>
			<li class="id:31">
				<img src="/img/romeo/2011/8639-0000-xx-12-1.jpg" />
				<a href="http://shop.lego.com/en-DK/Big-Bentley-Bust-Out-8639">
					<h3>Ballade i Big Bentley</h3>
					<span class="price">699,00</span>
				</a>
				<?
				if(isset($items["i31"])) {
					print '<span class="reserved">Reserveret</span>';
					print '<input type="button" onclick="changeState(\'i31\');" value="Slet reservering" />';
				}
				else {
					print '<input type="button" onclick="changeState(\'i31\');" value="Resevér" />';
				}
				?>
			</li>
			<li class="id:32">
				<img src="/img/romeo/2011/4194-0000-xx-12-1.jpg" />
				<a href="http://shop.lego.com/en-DK/Whitecap-Bay-4194">
					<h3>Skumsprøjtsbugten</h3>
					<span class="price">749,00</span>
				</a>
				<?
				if(isset($items["i32"])) {
					print '<span class="reserved">Reserveret</span>';
					print '<input type="button" onclick="changeState(\'i32\');" value="Slet reservering" />';
				}
				else {
					print '<input type="button" onclick="changeState(\'i32\');" value="Resevér" />';
				}
				?>
			</li>

		</ul>
	</div>
	</form>

	<div id="footer"></div>

</div>

</body>
</html>