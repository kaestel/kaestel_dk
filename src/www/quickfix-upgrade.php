<?php
$access_item = false;
if(isset($read_access) && $read_access) {
	return;
}

include_once($_SERVER["FRAMEWORK_PATH"]."/config/init.php");


include_once("classes/system/upgrade.class.php");
$upgrade = new Upgrade();


// $upgrade->moveMediaeToItems("log");
// $upgrade->moveMediaeToItems("wish");
// $upgrade->moveMediaeToItems("post");
// $upgrade->moveMediaeToItems("page");

?>