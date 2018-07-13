<?php
$this->startSetup()->run("
CREATE TABLE IF NOT EXISTS {$this->getTable('storelocator_country')} (
  `country_id` int(10) unsigned NOT NULL auto_increment,
  `country_code` varchar(255) NOT NULL,
  `ordinate_country` varchar(255) NOT NULL,
  `image_country` varchar(255) NOT NULL DEFAULT '',
  `website_url` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  PRIMARY KEY  (`country_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS {$this->getTable('storelocator_location')} (
  `location_id` int(10) unsigned NOT NULL auto_increment,
  `country_code` varchar(255) NOT NULL,
  `ordinate_country` varchar(255) NOT NULL,
  `ordinate_store` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image_store` varchar(255) NOT NULL DEFAULT '',
  `address_display` text NOT NULL,
  `notes` text NOT NULL,
  `website_url` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `open_hours` text,
  `ship_vendor` varchar(255) NOT NULL,
  `product_types` varchar(255) NOT NULL,
  PRIMARY KEY  (`location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8
")->endSetup();