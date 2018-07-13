<?php
$this->startSetup()->run("

DROP TABLE IF EXISTS {$this->getTable('storelocator_country')};
CREATE TABLE IF NOT EXISTS {$this->getTable('storelocator_country')} (
  `country_id` int(10) unsigned NOT NULL auto_increment,
  `country_code` varchar(255) NOT NULL,
  PRIMARY KEY  (`country_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS {$this->getTable('storelocator_location')};
CREATE TABLE IF NOT EXISTS {$this->getTable('storelocator_location')} (
  `location_id` int(10) unsigned NOT NULL auto_increment,
  `country_code` varchar(255) NOT NULL,
  `ordinate_store` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `address_display` text NOT NULL,
  `notes` text NOT NULL,
  `website_url` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `open_hours` text,
  `program_products` varchar(255) NOT NULL,
  `special_features` varchar(255) NOT NULL,
  `category_dealer` varchar(255) NOT NULL,
  `filter4` varchar(255) NOT NULL,
  `filter5` varchar(255) NOT NULL,
  `filter6` varchar(255) NOT NULL,
  PRIMARY KEY  (`location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8
")->endSetup();