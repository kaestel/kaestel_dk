#!/usr/bin/php
<?php
$access_item = false;
if(isset($read_access) && $read_access) {
	return;
}


	$output = shell_exec("cd /srv/sites/".$argv[1] . " && git pull && git submodule update");
	print ($output ? "$output\n" : "");

?>