<?php
/**
* This file contains definitions
*
* @package Config
*/
header("Content-type: text/html; charset=UTF-8");
error_reporting(E_ALL);

/**
* Required site information
*/
define("SITE_UID", "MAK");
define("SITE_NAME", "kaestel.dk");
define("SITE_URL", (isset($_SERVER["HTTPS"]) ? "https" : "http")."://".$_SERVER["SERVER_NAME"]);
define("SITE_EMAIL", "martin@kaestel.dk");

/**
* Optional constants
*/
define("DEFAULT_PAGE_DESCRIPTION", "Geek peotry");
define("DEFAULT_PAGE_IMAGE", "/img/logo-large.png");

define("DEFAULT_LANGUAGE_ISO", "EN");
define("DEFAULT_COUNTRY_ISO", "DK");
define("DEFAULT_CURRENCY_ISO", "DKK");


// Enable items model
define("SITE_ITEMS", true);
//define("SITE_SIGNUP", true);

// Enable shop model
//define("SITE_SHOP", true);


// Enable notifications (send collection email after N notifications)
define("SITE_COLLECT_NOTIFICATIONS", 50);
//define("SHOP_ORDER_NOTIFIES", "martin@think.dk");

//define("SITE_INSTALL", true);
?>
