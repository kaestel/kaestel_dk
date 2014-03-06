#!/usr/bin/php
<?php

	$output = shell_exec("cd /srv/sites/".$argv[1] . " && git pull && git submodule update");
	print ($output ? "$output\n" : "");

?>