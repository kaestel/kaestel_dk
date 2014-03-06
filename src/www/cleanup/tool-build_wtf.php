#!/usr/bin/php
<?php

$full = file_get_contents("http://jes.local/bundles/full/lib/include.php");
$medium = file_get_contents("http://jes.local/bundles/medium/lib/include.php");
$light = file_get_contents("http://jes.local/bundles/light/lib/include.php");

//system("svn commit -m 'bundles updated' /projects/www/jes/v6/bundles");

print "\n\nBundles merged, remember to commit!\n\n";

?>