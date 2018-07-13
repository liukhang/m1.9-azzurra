<?php
/**
 * Gugliotti News Setup
 */

/**
 * Gugliotti News Installer
 *
 * Gugliotti News SQL Installer.
 * @author Andre Gugliotti <andre@gugliotti.com.br>
 * @version 0.1.0
 * @package Training Modules
 * @license GNU General Public License, version 3
 */

/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();

// prepare table for gugliotti_news_category
$tableCategory = $installer->getConnection()->newTable($installer->getTable('gugliotti_news/category'));

try {
    $tableCategory->addColumn(
        'category_id',
        Varien_Db_Ddl_Table::TYPE_INTEGER,
        null,
        array('nullable' => false, 'identity' => true, 'primary' => true),
        'News Category ID'
    )->addColumn(
        'code',
        Varien_Db_Ddl_Table::TYPE_TEXT,
        64,
        array('nullable' => false),
        'News Category Code'
    )->addColumn(
        'label',
        Varien_Db_Ddl_Table::TYPE_TEXT,
        128,
        array('nullable' => false),
        'News Category Label'
    )->addColumn(
        'status',
        Varien_Db_Ddl_Table::TYPE_BOOLEAN,
        null,
        array('nullable' => false, 'default' => 0),
        'News Category Status'
    )->addColumn(
        'created_at',
        Varien_Db_Ddl_Table::TYPE_TIMESTAMP,
        null,
        array('default' => Varien_Db_Ddl_Table::TIMESTAMP_INIT),
        'News Category Created At'
    )->addColumn(
        'updated_at',
        Varien_Db_Ddl_Table::TYPE_TIMESTAMP,
        null,
        array('default' => Varien_Db_Ddl_Table::TIMESTAMP_INIT_UPDATE),
        'News Category Updated At'
    )->setComment('Gugliotti News Categories');
} catch (Exception $e) {
    Mage::logException($e);
}

// create table
try {
    $installer->getConnection()->createTable($tableCategory);
} catch (Exception $e) {
    Mage::logException($e);
}

$installer->endSetup();
