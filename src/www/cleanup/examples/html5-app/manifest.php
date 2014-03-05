<?php
$access_item = false;
$access_default = "page,list";

if(isset($read_access) && $read_access) {
	return;
}

include_once($_SERVER["PAGE_PATH"]."/page.class.php");



// default view
if(!$page->getStatus()) {$page->setStatus($access_default);}


// header
if($page->getStatus("page")) {
	$page->header();
}

// excluding each other
if($page->getStatus("list")) {
	$page->getTemplate("manifest.php");
}

// footer
if($page->getStatus("page")) {
	$page->footer();
	exit();
}

?>
