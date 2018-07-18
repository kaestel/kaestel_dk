CREATE TABLE `SITE_DB`.`item_log` (
  `id` int(11) NOT NULL auto_increment,
  `item_id` int(11) NOT NULL,

  `name` varchar(100) NOT NULL,
  `description` text NOT NULL DEFAULT '',
  `html` text NOT NULL DEFAULT '',

  `location` varchar(255) NOT NULL DEFAULT '',
  `latitude` double NOT NULL DEFAULT 0,
  `longitude` double NOT NULL DEFAULT 0,

  PRIMARY KEY  (`id`),
  KEY `item_id` (`item_id`),
  CONSTRAINT `item_log_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
