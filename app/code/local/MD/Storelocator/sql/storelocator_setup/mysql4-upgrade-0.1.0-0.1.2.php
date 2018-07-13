<?php
$this->startSetup()->run("
ALTER TABLE {$this->getTable('storelocator_location')}
ADD COLUMN `finter4` varchar(512) NOT NULL default '' AFTER `category_dealer`,
ADD COLUMN `finter5` varchar(512) NOT NULL default '' AFTER `finter4`,
ADD COLUMN `finter6` varchar(512) NOT NULL default '' AFTER `finter5`,
")->endSetup();