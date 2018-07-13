<?php
/**
 * Gugliotti_News_Model_Resource_Story
 */

/**
 * Class Gugliotti_News_Model_Resource_Story
 *
 * Resource Model for Story.
 * @author Andre Gugliotti <andre@gugliotti.com.br>
 * @version 0.1.0
 * @package Training Modules
 * @license GNU General Public License, version 3
 */
class Gugliotti_News_Model_Resource_Story extends Mage_Core_Model_Resource_Db_Abstract
{
	/**
	 * Constructor
	 */
    protected function _construct()
    {
        $this->_init('gugliotti_news/story', 'story_id');
    }
}
