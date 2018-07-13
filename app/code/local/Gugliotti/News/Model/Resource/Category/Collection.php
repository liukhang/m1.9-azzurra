<?php
/**
 * Gugliotti_News_Model_Resource_Category_Collection
 */

/**
 * Class Gugliotti_News_Model_Resource_Category_Collection
 *
 * Resource Collection for Category.
 * @author Andre Gugliotti <andre@gugliotti.com.br>
 * @version 0.1.0
 * @package Training Modules
 * @license GNU General Public License, version 3
 */
class Gugliotti_News_Model_Resource_Category_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
	/**
	 * Constructor
	 */
    protected function _construct()
    {
        $this->_init('gugliotti_news/category');
    }
}
