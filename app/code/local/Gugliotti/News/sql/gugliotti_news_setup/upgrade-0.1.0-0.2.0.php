<?php
/**
 * Gugliotti News Setup
 */

/**
 * Gugliotti News Installer
 *
 * Gugliotti News SQL Installer.
 * @author Andre Gugliotti <andre@gugliotti.com.br>
 * @version 0.2.0
 * @package Training Modules
 * @license GNU General Public License, version 3
 */

/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();

// prepare table for gugliotti_news_story
$tableStory = $installer->getConnection()->newTable($installer->getTable('gugliotti_news/story'));

try {
	$tableStory->addColumn(
		'story_id',
		Varien_Db_Ddl_Table::TYPE_INTEGER,
		null,
		array('nullable' => false, 'identity' => true, 'primary' => true),
		'News Story ID'
	)->addColumn(
		'title',
		Varien_Db_Ddl_Table::TYPE_TEXT,
		128,
		array('nullable' => false),
		'News Story Title'
	)->addColumn(
		'thumbnail_path',
		Varien_Db_Ddl_Table::TYPE_TEXT,
		128,
		array('nullable' => true),
		'News Story Thumbnail Path'
	)->addColumn(
		'content',
		Varien_Db_Ddl_Table::TYPE_TEXT,
		null,
		array('nullable' => false),
		'News Story Content'
	)->addColumn(
		'status',
		Varien_Db_Ddl_Table::TYPE_BOOLEAN,
		null,
		array('nullable' => false, 'default' => 0),
		'News Category Status'
	)->addColumn(
		'category_id',
		Varien_Db_Ddl_Table::TYPE_INTEGER,
		null,
		array('nullable' => true),
		'News Story Category'
	)->addColumn(
		'created_at',
		Varien_Db_Ddl_Table::TYPE_TIMESTAMP,
		null,
		array('default' => Varien_Db_Ddl_Table::TIMESTAMP_INIT),
		'News Story Created At'
	)->addColumn(
		'updated_at',
		Varien_Db_Ddl_Table::TYPE_TIMESTAMP,
		null,
		array('default' => Varien_Db_Ddl_Table::TIMESTAMP_INIT_UPDATE),
		'News Story Updated At'
	)->addForeignKey(
		$installer->getFkName(
			'gugliotti_news/story',
			'category_id',
			'gugliotti_news/category',
			'category_id'
		),
		'category_id',
		$installer->getTable('gugliotti_news/category'),
		'category_id'
	)->setComment('Gugliotti News Stories');
} catch (Exception $e) {
	Mage::logException($e);
}

// create table
try {
	$installer->getConnection()->createTable($tableStory);
} catch (Exception $e) {
	Mage::logException($e);
}

$installer->endSetup();
