<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category   Mage
 * @package    Mage_Checkout
 * @copyright  Copyright (c) 2008 Irubin Consulting Inc. DBA Varien (http://www.varien.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

$installer = $this;
/* @var $installer Mage_Core_Model_Resource_Setup */

$installer->startSetup();


$installer->getConnection()->addColumn($installer->getTable('gallery'), 'photo_link',
    'VARCHAR( 255 ) NOT NULL AFTER content'
);

$installer->getConnection()->addColumn($installer->getTable('gallery'), 'url_rewrite_id',
    'int( 11 ) NOT NULL AFTER album_id'
);

$installer->getConnection()->addColumn($installer->getTable('gallery_album'), 'bottom_description',
    'text NOT NULL AFTER content'
);
$installer->getConnection()->addColumn($installer->getTable('gallery_album'), 'parent_id',
    'int( 11 ) NOT NULL AFTER content'
);

$installer->getConnection()->addColumn($installer->getTable('gallery_album'), 'store_id',
    'smallint( 6 ) NOT NULL AFTER parent_id'
);
$installer->getConnection()->addColumn($installer->getTable('gallery_album'), 'url_rewrite_id',
    'int( 11 ) NOT NULL AFTER store_id'
);
$installer->getConnection()->addColumn($installer->getTable('gallery_album'), 'featured',
    'tinyint( 4 ) NOT NULL AFTER store_id'
);
$installer->getConnection()->addColumn($installer->getTable('gallery_album'), 'thumbnail_size',
    'VARCHAR( 255 ) NOT NULL AFTER featured'
);
$installer->getConnection()->addColumn($installer->getTable('gallery_album'), 'show_photo_title',
    'tinyint( 4 ) NOT NULL AFTER thumbnail_size'
);
$installer->getConnection()->addColumn($installer->getTable('gallery_album'), 'show_photo_description',
    'tinyint( 4 ) NOT NULL AFTER show_photo_title'
);
$installer->getConnection()->addColumn($installer->getTable('gallery_album'), 'show_photo_link',
    'tinyint( 4 ) NOT NULL AFTER show_photo_description'
);
$installer->getConnection()->addColumn($installer->getTable('gallery_album'), 'default_config',
    'tinyint( 4 ) NOT NULL AFTER show_photo_link'
);

$installer->run("
-- DROP TABLE IF EXISTS {$this->getTable('gallery_store')};
CREATE TABLE {$this->getTable('gallery_store')} (
  `album_id` int(11) NOT NULL,
  `store_id` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE {$this->getTable('gallery_review')} (
  `review_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `gallery_id` int(11) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `rate` tinyint(4) NOT NULL,
  `create_time` datetime NOT NULL,
  PRIMARY KEY (`review_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

UPDATE {$this->getTable('gallery_album')} SET `album_id`= `album_id` + 1;

INSERT INTO {$this->getTable('gallery_album')} (`album_id`,`title`, `content`, `bottom_description`, `store_id`, `default_config`, `status`, `order`) 
VALUES (1,'Gallery', 'this is content of root album', 'this is bottom description of root album', '0', '1', '1', '0');

UPDATE {$this->getTable('gallery_album')} SET `parent_id`=1 WHERE `album_id`<>1 AND `parent_id` = 0;

INSERT INTO {$this->getTable('gallery_store')} (`album_id`, `store_id`) VALUES ('1', '0');
INSERT INTO {$this->getTable('core_url_rewrite')} (`id_path`, `request_path`, `target_path`, `is_system`) VALUES ('gallery/album/1', 'gallery/gallery.html','gallery/view/album/id/1',1);
UPDATE {$this->getTable('gallery_album')} SET `url_rewrite_id` = (SELECT `url_rewrite_id` FROM {$this->getTable('core_url_rewrite')} WHERE `id_path`='gallery/album/1') WHERE `album_id`=1
    ");

$installer->endSetup();
$installer = $this;

