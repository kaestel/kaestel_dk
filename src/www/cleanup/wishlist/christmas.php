<?php
$access_item = array();
$access_default = "page";


$access_item = false;

if(isset($read_access) && $read_access) {
	return;
}

include_once($_SERVER["PAGE_PATH"]."/page.class.php");
$object = $page->addObject("www/item.class.php");

// default view
if(!$page->getStatus()) {$page->setStatus($access_default);}

// header
if($page->getStatus("page")) {
	$page->header("Julegaver");

	?>
	
	<h2>Martin</h2>

	<ul>
		<li>
			2 x Iittala kopper - gerne forskellige<br />
			<a href="http://www.iittala.com/web/Iittalaweb.nsf/en/products_drinking_hot_drinks_origo">http://www.iittala.com/web/Iittalaweb.nsf/en/products_drinking_hot_drinks_origo</a>
		</li>
		<li>Toilet børste - ingen specifikke ønsker</li>
		<li>
			Bodum grillpande,<br />
			<a href="http://www.bodum.com/b2c/index.asp?shpId=6&id=0830-01&famId=12&famSubId=1212">http://www.bodum.com/b2c/index.asp?shpId=6&id=0830-01&famId=12&famSubId=1212</a>
		</li>
		<li>
			EvaSolo Kniv magneter (!! skal lige se om jeg har nogle i haven),<br />
			<a href="http://evasolo.dk/products-knifemagnets.html">http://evasolo.dk/products-knifemagnets.html</a>
		</li>
		<li>
			Siemens Porsche brødrister,<br />
			<a href="http://www.siemens-home.dk/produkter/småapparater/brødristere/TT911P2.html?source=browse">http://www.siemens-home.dk/produkter/småapparater/brødristere/TT911P2.html?source=browse</a>
		</li>
	</ul>

	<h2>Romeo</h2>

	<ul>
		<li>
			Barbapapas træ, Forlag: Apostrof<br />
			<a href="http://www.boghallen.dk/Billedboeger/Billedboeger_div/Barbapapas_trae(9788759105863).aspx">http://www.boghallen.dk/Billedboeger/Billedboeger_div/Barbapapas_trae(9788759105863).aspx</a>
		</li>
		<li>
			Pinocchio, Disney DVD<br />
			<a href="http://cdon.dk/film/disney's_klassiker_2%3a_pinocchio_-_specialudgave_(2_disc)-719951">http://cdon.dk/film/disney's_klassiker_2%3a_pinocchio_-_specialudgave_(2_disc)-719951</a>
		</li>
		<li>
			Bamse DVD<br />
			<a href="http://cdon.dk/film/bamse_%26_kylling_boks_(6_disc)-568286">http://cdon.dk/film/bamse_%26_kylling_boks_(6_disc)-568286</a>
		</li>
		<li>
			HotWheels (biler)
		</li>
	</ul>

	<?

	$page->footer();
	exit();
}

?>
